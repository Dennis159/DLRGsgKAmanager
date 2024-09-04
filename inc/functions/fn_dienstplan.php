<?php
function DLR_DP_dateFormat($format, $date) {
  $date = date($format, strtotime($date));
  // Wochentage ersetzen
    $date = str_replace('Mon', 'Mo', $date);
    $date = str_replace('Tue', 'Di', $date);
    $date = str_replace('Wed', 'Mi', $date);
    $date = str_replace('Thu', 'Do', $date);
    $date = str_replace('Fri', 'Fr', $date);
    $date = str_replace('Sat', 'Sa', $date);
    $date = str_replace('Sun', 'So', $date);

  // Monate ersetzen
    $date = str_replace('Mar', 'Mär', $date);
    $date = str_replace('May', 'Mai', $date);
    $date = str_replace('Oct', 'Okt', $date);
    $date = str_replace('Dec', 'Dez', $date);
  return $date;
}

function DLR_DP_dashb_getNextDuty($count = false)
{
  global $TOOL;
  $uid = $_SESSION['uid'];
  if(!$count){
    $res = $TOOL->query("SELECT d.id, d.titel, d.start, m.position FROM dp_meldungen m LEFT JOIN dp_dienste d ON d.id = m.dienst WHERE m.uid = $uid AND m.position != 'ABML' AND d.start > NOW() ORDER BY d.start LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $res = $TOOL->query("SELECT count(*) as count FROM dp_meldungen m LEFT JOIN dp_dienste d ON d.id = m.dienst WHERE m.uid = $uid AND m.position != 'ABML' AND d.start > NOW()")->fetchAll(PDO::FETCH_ASSOC);
    return $res[0]['count'];
  }
  $res = $res[0];

  if(empty($res)){
    return "<small class='text-muted'>für keinen weiteren Dienst angemeldet</small>";
  } else {
    return "<small>{$res['titel']}<br>".DLR_DP_dateFormat("D, d.m.Y H:i", $res['start'])." Uhr<br>" . DLR_DP_getPotsitionInfo($res['position'])['name']."</small>";
  }
}

function DLR_DP_dashb_getOpenDutys($vierzehnTage = "null")
{
  global $TOOL;
  if($vierzehnTage == "null"){
    $res = $TOOL->query("SELECT * FROM dp_dienste WHERE start > NOW()")->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $res = $TOOL->query("SELECT * FROM dp_dienste WHERE start > NOW() AND start < DATE_ADD(CURDATE(), INTERVAL 14 DAY);")->fetchAll(PDO::FETCH_ASSOC);
  }

  if (empty($res)) {
    return "<small class='text-muted text-md'>es sind keine Dienste geplant</small>";
  } else {
    $c_unbesetzt = 0;
    $c_teilweise = 0;
    foreach ($res as $d) {
      $positions = json_decode($d['positions'], true);

      if ($positions === null) {
        // Log the error and continue with the next record
        error_log("JSON decode failed for dienst ID: " . $d['id']);
        continue;
      }

      foreach ($positions as $pk => $pv) {
        $c = $TOOL->query("SELECT count(*) as count FROM dp_meldungen WHERE dienst = '".$d['id']."' AND position = '$pk'")->fetch(PDO::FETCH_ASSOC)['count'];
        if ($c == 0) {
          $c_unbesetzt++;
        } else if ($c > 0 && $c < $pv[0]) {
          $c_teilweise++;
        }
      }
    }
    return $c_unbesetzt . " <small class='text-muted'>({$c_teilweise})</small>";
  }
}

function DLR_DP_dashb_getDutyHours($type)
{
  global $TOOL;
  $uid = $_SESSION['uid'];
  if($type == "saison"){
    $res = $TOOL->query("SELECT * FROM dp_meldungen WHERE uid = '$uid' AND dienst LIKE CONCAT(YEAR(CURDATE()) % 100, '-%')")->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $res = $TOOL->query("SELECT * FROM dp_meldungen WHERE uid = '$uid'")->fetchAll(PDO::FETCH_ASSOC);
  }

  if (empty($res)) {
    return "0 Stunden 0 Minuten";
  } else {
    $hours   = 0;
    $minutes = 0;
    foreach ($res as $d) {
      $r = $TOOL->query("SELECT start, end FROM dp_dienste WHERE id = '".$d['dienst']."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
      $start = $d['start_abw'] == null ? $r['start'] : $d['start_abw'];
      $end   = $d['end_abw'] == null   ? $r['end']   : $d['end_abw'];

      if(strtotime($end) > time()){ continue; }

      $startTimestamp = strtotime($start);
      $endTimestamp = strtotime($end);

      $diffInSeconds = $endTimestamp - $startTimestamp;

      $hours   += floor($diffInSeconds / 3600);
      $minutes += floor(($diffInSeconds % 3600) / 60);

    }

    return "$hours Stunden $minutes Minuten";
  }

}

function TextSearch($search, $array) {
  $array = [
    "type"            => $array['type'],
    "titel"           => $array['titel'],
    "start"           => DLR_DP_dateFormat("D, d.m.Y H:i", $array['start']),
    "end"             => DLR_DP_dateFormat("D, d.m.Y H:i", $array['end']),
    "descr"           => $array['descr'],
    "organisator"     => $array['organisator'],
    "location_name"   => $array['location_name'],
    "location_adress" => $array['location_adress'],
  ];

  if (strlen($search) < 3) {
    return true;
  }

  foreach ($array as $value) {
    if (str_contains($value, $search)) {
      return true;
    }
  }

  return false;
}

function DLR_DP_getPositionsShort($json, $dienst)
{
  $array  = json_decode($json, true);
  $positions = [];
  foreach ($array as $key => $value) {
    $ist  = DLR_DP_getPositionCount($dienst, $key);
    $soll = $value[0];
    $str  = $key . " (".$ist."/".$soll.")";

    if($ist == 0 AND $soll != 0) {     $str = "<span class='text-dlrg-red'>"   . $str ."</span>"; }
    if($ist == 0 AND $soll == 0) {     $str = "<span class='text-success''>"   . $str ."</span>"; }
    if($ist < $soll) {                 $str = "<span class='text-dlrg-yellow'>". $str ."</span>"; }
    if($ist >= $soll) {                $str = "<span class='text-success'>"    . $str ."</span>"; }

    $positions[] = $str;
  }
  return implode(", ", $positions);
}

function DLR_DP_getStatusColor($json, $dienst,$type) {
  $array  = json_decode($json, true);
  $c_unbesetzt   = 0;
  $c_tlwbesetzt  = 0;
  $c_vollbesetzt = 0;
  foreach ($array as $key => $value) {
    $ist = DLR_DP_getPositionCount($dienst, $key);
    $soll = $value[0];

    if($ist == 0 AND $soll != 0) { $c_unbesetzt++; }
    if($ist == 0 AND $soll == 0) { $c_vollbesetzt++; }
    if($ist < $soll) {             $c_tlwbesetzt++; }
    if($ist >= $soll) {            $c_vollbesetzt++; }
  }

  if($type == "box"){
    if($c_unbesetzt > 0) { return "bs-red"; } else if($c_tlwbesetzt > 0) { return "bs-yellow"; } else { return "bs-green"; }
  } else {
    if($c_unbesetzt > 0) { return "bg-dlrg-red"; } else if($c_tlwbesetzt > 0) { return "bg-dlrg-yellow"; } else { return "bg-success"; }
  }

}

function DLR_DP_getPositionCount($dienst, $position)
{
  global $TOOL;
  $res = $TOOL->query("SELECT count(uid) as sum FROM dp_meldungen WHERE dienst = '$dienst' AND position = '$position'")->fetch();
  return $res['sum'];
}

function DLR_DP_getPositionNames($dienst, $position, $seperator, $msg)
{
  global $TOOL;
  $res = $TOOL->query("SELECT * FROM dp_meldungen WHERE dienst = '$dienst' AND position = '$position'")->fetchAll(PDO::FETCH_ASSOC);
  $names = [];
  foreach ($res as $n){
    $bemerkung = $n['bemerkung'] != "" ? "<i class='fa-solid fa-info-circle' title='{$n['bemerkung']}'></i>" : "";
    $start_abw = $n['start_abw'] != "" ? "ab " . date('d.m.Y H:i', strtotime($n['start_abw'])) . " Uhr" : "";
    $end_abw   = $n['end_abw']   != "" ? "bis " . date('d.m.Y H:i', strtotime($n['end_abw'])) . " Uhr" : "";
    $zeit      = ($n['start_abw'] != "" AND $n['end_abw'] != ")") ? implode(", ", array($start_abw, $end_abw)) : $start_abw.$end_abw;
    $zeit      = $zeit != "" ? "<i class='fa-solid fa-clock' title='{$zeit}'></i>" : "";
    $names[] = GG_fnc_getUserName($n['uid']) . " " . $zeit . " " . $bemerkung;
  }
  return !empty($names) ? implode($seperator, $names) : "<i class='text-muted'>{$msg}</i>";
}

function DLR_DP_getPotsitionInfo($position)
{
  global $TOOL;

  $res = $TOOL->query("SELECT * FROM dp_positions WHERE id = '$position' LIMIT 1")->fetch();

  return empty($res) ? array("id" => $position, "name" => "$position existiert nicht", "qualifikationen" => "{}") : $res;

}

function DLR_DP_getUserRegisterState($dienst, $short = false, $text = false)
{
  global $TOOL;
  $uid = $_SESSION['uid'];

  $res = $TOOL->query("SELECT position FROM dp_meldungen WHERE uid = $uid AND dienst = '$dienst'")->fetch();

  if($short){
    if(empty($res)){
      $res = "none";
    } else {
      if(!$text){
        $res = $res['position'] == "ABML" ? $res['position'] : "YES";
      } else {
        return $res['position'];
      }
    }
  } else {
    if(empty($res)){
      $res = "<i class='text-muted'>keine An-/Abmeldung</i>";
    } else {
      $res = $res['position'] == "ABML" ? "Abgemeldet" : DLR_DP_getPotsitionInfo($res['position'])['name'];
    }
  }

  return $res;
}

function DLR_DP_getTeilzeit($dienst, $uid, $boolean = true)
{
  global $TOOL;
  $res = $TOOL->query("SELECT start_abw, end_abw FROM dp_meldungen WHERE uid = $uid AND dienst = '$dienst'")->fetch();

  if($boolean){
    if(empty($res)){
      return false;
    } else {
      return $res['start_abw'] != null;
    }
  } else {
    if(empty($res)){
      return false;
    } else {
      return array("start_abw" => date('Y-m-d\TH:i', strtotime($res['start_abw'])), "end_abw" => date('Y-m-d\TH:i', strtotime($res['end_abw'])));
    }
  }
}

function DLR_DP_getBemerkung($dienst, $uid)
{
  global $TOOL;
  return $TOOL->query("SELECT bemerkung FROM dp_meldungen WHERE uid = $uid AND dienst = '$dienst'")->fetch()['bemerkung'];
}