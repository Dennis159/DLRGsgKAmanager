<?php
  if($_SESSION['rank'] == 1){
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
?>
<div class="container-fluid py-4">

  <div class="card mt-4">
    <div class="card-header p-3">
      <h5 class="mb-0"></h5>
    </div>
    <div class="card-body p-3 pb-0">
      <?php
        // Daten abrufen
        $users = $TOOL->query("SELECT * FROM mgmt_userfiles WHERE uid != 3 ORDER BY nachname")->fetchAll(PDO::FETCH_ASSOC);

        $events = $TOOL->query("SELECT * FROM list_uebungen")->fetchAll(PDO::FETCH_ASSOC);

        // Tabelle erstellen
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="border-right: 1px solid grey; width: 4em!important;" class="text-info" rowspan="2">Name</th>';

        foreach ($events as $event) {
          if(date('d', strtotime($event['date'])) == "01"){
            echo '<th class="text-center text-secondary" style="border-bottom: none!important;">' . date('\x\x.m.Y', strtotime($event['date'])) . '</th>';
          } else {
            echo '<th class="text-center text-info" style="border-bottom: none!important;">' . date('d.m.Y', strtotime($event['date'])) . '</th>';
          }
        }

        echo '</tr>';
        echo '<tr>';

        $count = 0;
        foreach ($events as $event) {
          if($event['name'] != ""){
            echo '<th class="text-center text-warning text-xs" data-bs-toggle="modal" data-bs-target="#uebung'.date('dmY', strtotime($event['date'])).'" 
                      style="border-top: none!important; cursor: pointer"><small>' . $event['name'] . '</small></th>';
          } else {
            echo '<th class="text-center text-secondary text-xs" data-bs-toggle="modal" data-bs-target="#uebung'.date('dmY', strtotime($event['date'])).'" 
                      style="border-top: none!important; cursor: pointer"><small><i>noch nicht<br>festgelegt</i></small></th>';
          }
          $count = $count +1;

          include "modal_uebung.php";
        }

        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($users as $user) {
          echo '<tr>';
          echo '<td style="border-right: 1px solid grey; width: 4em!important;">' . $user['vorname'] . ' ' . $user['nachname'] . '</td>';

          foreach ($events as $event) {
            $members = json_decode($event['members'], true);
            $status = in_array($user['uid'], $members) ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa-solid fa-x text-danger"></i>';
            echo '<td class="text-center">' . $status . '</td>';
          }

          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      ?>
    </div>
  </div>

</div>