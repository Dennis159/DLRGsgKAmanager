<?php
function GD_fnc_reload(){
  echo "<script>window.location.href = window.location.href;</script>";
}

function DLR_checkATN($atn, $uid, $truefalse = false) : string
{
  global $TOOL;
  $return = $TOOL->query("SELECT * FROM mgmt_atns WHERE uid = $uid")->fetch();
  if($atn != "san_andere"){
    $status = $return[$atn];
  } else {
    $return = json_decode($return[$atn], true);
    $status = $return[1];
  }
  if(!$truefalse){
    switch ($status) {
      case 0: $returnvalue = '<i class="text-danger fa-solid fa-x"></i>'; break;
      case 1: $returnvalue = '<i class="text-warning fa-solid fa-hourglass-half"></i>'; break;
      case 2: $returnvalue = '<i class="text-gallina fa-solid fa-eye"></i>'; break;
      case 3: $returnvalue = '<i class="text-success fa-solid fa-check"></i>'; break;
      case 4: $returnvalue = '<i class="text-success fa-solid fa-check-double"></i>'; break;
      default: $returnvalue = "error";
    }
  } else {
    $returnvalue = $status >= 3;
  }
  return $returnvalue;
}

function DLR_getATNFile($atn, $uid) : string
{
  $files = scandir($_SERVER['DOCUMENT_ROOT']."/atns/$uid/");
  foreach ($files as $file){
    $file = explode(".", $file);
    if($file[0] == $atn){
      switch ($file[1]) {
        case "pdf": return "<a href='https://dlrg-ka.de/atns/$uid/$file[0].$file[1]' target='_blank'><i class='text-white fa-solid fa-file-pdf'></i></a>"; break;
        case "png": case "jpg": case "jpeg": return "<a href='https://dlrg-ka.de/atns/$uid/$file[0].$file[1]' target='_blank'><i class='text-white fa-solid fa-file-image'></i></a>"; break;
      }
    }
  }

  return "<i class='text-danger fa-solid fa-file-circle-xmark'></i>";
}

function DLR_getSanAndere($atn, $uid, $truefalse = false) : string
{
  global $TOOL;
  $return = $TOOL->query("SELECT * FROM mgmt_atns WHERE uid = $uid")->fetch();
  if($return[$atn] != "[]"){
    $return = json_decode($return[$atn], true);
    if($truefalse){
      if($return[1] == "1"){ $color = "text-warning"; }
      if($return[1] == "2"){ $color = "text-yellow"; }
      if($return[1] == "3"){ $color = "text-success"; }
      return '<span class="'.$color.'">'.$return[0].'</span>';
    } else {
      return '<i class="text-success">'.$return[0].'</i>';
    }
  } else {
    return '<i class="text-muted">keine</i>';
  }
}

function DLR_getAmmountUebungen($uid) : string
{
  global $TOOL;
  return $TOOL->query("SELECT count(name) as count FROM list_uebungen WHERE members LIKE '%\"$uid\"%'")->fetch()['count'];
}

function DLR_getLastUebung($uid) : string
{
  global $TOOL;
  $date = $TOOL->query("SELECT date FROM list_uebungen WHERE members LIKE '%\"$uid\"%' ORDER BY date DESC")->fetch()['date'];
  return $date != "" ? date('d.m.Y', strtotime($date)) : "<i class='text-muted text-bold'>niemals</i>";
}

function DLR_getLastGUV($datum, $truefalse = false) : string
{
  if($datum == NULL){
    $datum = "<b>noch nie</b>";
    $class = "text-danger";
  } else {
    $today = new DateTime();
    $dateObj = DateTime::createFromFormat('Y-m-d', $datum);
    $interval = $dateObj->diff($today);
    $days = $interval->days;
    if ($days >= 365) {
      $class = "text-danger";
    } elseif ($days >= 335) {
      $class = "text-warning";
    } else {
      $class = "text-success";
    }
    $datum = date('d.m.Y', strtotime($datum));
  }
  return $truefalse ? '<span class="' . $class . '">' . $datum . '</span>' : '<span class="' . $class . '" style="float: right">' . $datum . '</span>';
}

function DLR_getLastGUVDays($datum, $blank = false) : string
{
  if($datum == NULL){
    $days = "<b>noch nie</b>";
    $class = "text-danger";
  } else {
    $today = new DateTime();
    $dateObj = DateTime::createFromFormat('Y-m-d', $datum);
    $interval = $dateObj->diff($today);
    $days = $interval->days;
    if ($days >= 365) {
      $class = "text-danger";
    } elseif ($days >= 335) {
      $class = "text-warning";
    } else {
      $class = "text-success";
    }
  }

  return !$blank ? "<b class='$class'>$days</b>" : $days;
}

function DLR_getLastGUVStatus($datum) : string
{
  if($datum == NULL){
    $days = "<b>noch nie</b>";
    $text = "text-danger";
  } else {
    $today = new DateTime();
    $dateObj = DateTime::createFromFormat('Y-m-d', $datum);
    $interval = $dateObj->diff($today);
    $days = $interval->days;
    if ($days >= 365) {
      $text = "<b class='text-danger'>ungültig!</b>";
    } elseif ($days >= 335) {
      $text = "<b class='text-warning'><span class='text-success'>gültig</span>, läuft aber in <i>".(365 - $days)."</i> Tagen ab!</b>";
    } else {
      $text = "<b class='text-success'>gültig.</b>";
    }
  }
  return $text;
}

function DLR_getBestand($aan, $gro = "") : int
{
  global $TOOL;
  $res = $TOOL->query("SELECT count(*) as bestand FROM storage_artikel WHERE artikelnummer = '$aan' AND groesse = '$gro' AND status = 0")->fetch();
  return $res['bestand'];
}

function DLR_getArtikelDaten($aan) : array
{
  global $TOOL;
  $res = $TOOL->query("SELECT * FROM storage_artikelliste WHERE artikelnummer = '$aan'")->fetch();
  return $res;
}

function DLR_checkPermissionPool($permissionGroup, $user, $anzeige)
{
  switch ($permissionGroup){
    case "SAN":
      $getSAN = (DLR_checkATN("331", $user, true) OR DLR_checkATN("332", $user, true) OR DLR_checkATN("san_andere", $user, true));
      if($getSAN AND $anzeige == "anzeige"){      return "success"; }
      elseif(!$getSAN AND $anzeige == "anzeige"){ return "danger"; }
      elseif($getSAN AND $anzeige == "bool"){     return true; }
      elseif(!$getSAN AND $anzeige == "bool"){    return false; }
    break;
    case "BEC":
      $getBEC = DLR_checkATN("152", $user, true);
      if($getBEC AND $anzeige == "anzeige"){      return "success"; }
      elseif(!$getBEC AND $anzeige == "anzeige"){ return "danger"; }
      elseif($getBEC AND $anzeige == "bool"){     return true; }
      elseif(!$getBEC AND $anzeige == "bool"){    return false; }
    break;
    case "WRD":
      $getWRD = DLR_checkATN("812", $user, true);
      if($getWRD AND $anzeige == "anzeige"){      return "success"; }
      elseif(!$getWRD AND $anzeige == "anzeige"){ return "danger"; }
      elseif($getWRD AND $anzeige == "bool"){     return true; }
      elseif(!$getWRD AND $anzeige == "bool"){    return false; }
    break;
  }
  return false;
}