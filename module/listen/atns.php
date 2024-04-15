<?php
  if($_SESSION['rank'] == 1){
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
?>
<div class="container-fluid py-4">
  <style>
    td {
      min-width: 3.5em!important;
    }
  </style>
  <div class="card mt-4">
    <div class="card-header p-3">
      <h5 class="mb-0"></h5>
    </div>
    <div class="card-body p-3 pb-0">
      <?php
      // Daten abrufen
      $users = $TOOL->query("SELECT * FROM mgmt_userfiles WHERE uid != 3 ORDER BY nachname")->fetchAll(PDO::FETCH_ASSOC);

      $atns = $TOOL->query("SELECT * FROM ants_dblist ORDER BY `order`")->fetchAll(PDO::FETCH_ASSOC);

      // Tabelle erstellen
      echo '<table class="table table-striped">';
      echo '<thead>';
      echo '<tr>';
      echo '<th style="border-right: 1px solid grey; width: 4em!important;" class="text-info" rowspan="2">Name</th>';

      $BEC = 0;
      $SAN = 0;
      $WRD = 0;

      foreach ($atns as $atn){
        if($atn['category'] == "BEC"){ $BEC++; }
        if($atn['category'] == "SAN"){ $SAN++; }
        if($atn['category'] == "WRD"){ $WRD++; }
      }

        echo "<td colspan='".$SAN."' class='text-center text-warning pe-0 pl-0'>Sanitätswesen</td>";
        echo "<td colspan='".$BEC."' class='text-center text-warning pe-0 pl-0'>Beckendienst</td>";
        echo "<td colspan='".$WRD."' class='text-center text-warning pe-0 pl-0'>Einsatzdienst / Bootswesen</td>";
      echo "</tr>";

      echo "<tr>";
      foreach ($atns as $atn) {
        $atn_name   = $atn['id'] == "san_andere" ? "Höherwertige" : $atn['id'];
        $atn_text   = $atn['name_short'];
        $atn_namelg = $atn['name'];
        echo '<th class="text-center text-info" style="padding-left: 0.3em; padding-right: 0.3em" data-bs-toggle="tooltip" title="'.$atn_namelg.'">' . $atn_name . ' <br> 
                <small class="text-muted font-weight-normal">' . $atn_text . ' </small>
              </th>';
      }

      echo '</tr>';

      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      foreach ($users as $user) {
        echo '<tr>';
        echo '<td style="border-right: 1px solid grey; width: 4em!important;">' . $user['vorname'] . ' ' . $user['nachname'] . '</td>';

        foreach ($atns as $atn) {
          if($atn['id'] == "san_andere"){
            switch (json_decode($TOOL->query("SELECT * FROM mgmt_atns WHERE uid = '".$user['uid']."'")->fetch()[$atn['id']])[1]){
              case 0: $tooltip = "ATN nicht vorhanden"; break;
              case 1: $tooltip = "Für Lehrgang angemeldet / laufender Lehrgang"; break;
              case 2: $tooltip = "ATN hochgeladen, muss überpüft werden"; break;
              case 3: $tooltip = "ATN vorhanden (nicht im ISC eingetragen)"; break;
              case 4: $tooltip = "ATN vorhanden und im ISC eingetragen"; break;
            }
            echo "<td class='text-center' data-bs-toggle='tooltip' title='".$tooltip."'>".DLR_getSanAndere($atn['id'], $user['uid'], true)."</td>";
          } else {
            switch ($TOOL->query("SELECT * FROM mgmt_atns WHERE uid = '".$user['uid']."'")->fetch()[$atn['id']]){
              case 0: $tooltip = "ATN nicht vorhanden"; break;
              case 1: $tooltip = "Für Lehrgang angemeldet / laufender Lehrgang"; break;
              case 2: $tooltip = "ATN hochgeladen, muss überpüft werden"; break;
              case 3: $tooltip = "ATN vorhanden (nicht im ISC eingetragen)"; break;
              case 4: $tooltip = "ATN vorhanden und im ISC eingetragen"; break;
            }
            echo '<td class="text-center pe-0 pl-0" data-bs-toggle="tooltip" title="'.$tooltip.'">' . DLR_checkATN($atn['id'], $user['uid']) . '</td>';
          }
        }

        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
      ?>
    </div>
  </div>

</div>