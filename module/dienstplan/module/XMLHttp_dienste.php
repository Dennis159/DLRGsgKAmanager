<style>
  th, td {
    height: 1.75em!important;
    vertical-align: top!important;
  }

  td {
    color: lightgray!important;
  }
</style>
<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/inc/Config_Master.php';

  $hide   = $_GET['hide'];
  $season = $_GET['season'];
  $search = $_GET['search'];
  if($hide != "keine"){
    $hide = $hide == "vergangene" ? "AND end > NOW()" : "AND status != 3";
  } else {
    $hide = "AND true";
  }
  $plan = $TOOL->query("SELECT * FROM dp_dienste WHERE start LIKE '$season-%' $hide")->fetchAll(PDO::FETCH_ASSOC);
  foreach($plan as $d) {
    if(!TextSearch($search, $d)){ continue; };
?>
  <div class="col-lg-3 col-md-6 col-12">
    <div class="card <?= DLR_DP_getStatusColor($d['positions'], $d['id'], "box") ?>">
      <div class="card-body pb-0">
        <span class="text-bolder text-decoration-underline"><?= $d['titel'] ?></span>
        <table style="width: 100%" class="mt-1">
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-circle-info"></i></th>
            <th style="width: 7.5em;">Dienstart</th>
            <td style="font-size: 11pt"><?= $d['type'] ?></td>
          </tr>
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-map-location-dot"></i></th>
            <th style="width: 7.5em;">Location</th>
            <td style="font-size: 10pt"><a href="<?= $d['location_maps'] ?>" target="_blank" class="link-white"><?= $d['location_name'] ?></a></td>
          </tr>
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-clock"></i></th>
            <th style="width: 7.5em;">Dienstbeginn</th>
            <td style="font-size: 11pt"><?= DLR_DP_dateFormat("D, d.m.Y H:i", $d['start']) ?> Uhr</td>
          </tr>
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-clock"></i></th>
            <th style="width: 7.5em;">Dienstende</th>
            <td style="font-size: 11pt"><?= DLR_DP_dateFormat("D, d.m.Y H:i", $d['end']) ?> Uhr</td>
          </tr>
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-user"></i></th>
            <th style="width: 7.5em;"><small>Meine Meldung</small></th>
            <td><?= DLR_DP_getUserRegisterState($d['id']) ?></td>
          </tr>
          <tr>
            <th style="width: 0.5em" class="p-0"><i class="fa-solid fa-users"></i></th>
            <th style="width: 7.5em;">Positionen</th>
            <td><?= DLR_DP_getPositionsShort($d['positions'], $d['id']) ?></td>
          </tr>
        </table>
        <div class="text-center pt-1">
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>"><i class="fa-solid fa-info-circle"></i></button>
          <?php if(DLR_DP_getUserRegisterState($d['id'], true) == "none"){ ?>
            <button class="btn btn-success" title="Anmelden" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>-meldung"><i class="fa-solid fa-user-plus"></i></button>
            <button class="btn btn-danger" title ="Abmelden" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>-abmeldung"><i class="fa-solid fa-user-minus"></i></button>
          <?php } if(DLR_DP_getUserRegisterState($d['id'], true) == "ABML"){ ?>
            <button class="btn btn-success" title="Anmelden" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>-meldung"><i class="fa-solid fa-user-plus"></i></button>
          <?php } if(DLR_DP_getUserRegisterState($d['id'], true) == "YES"){ ?>
            <button class="btn btn-info" title ="Anmeldung bearbeiten" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>-meldung"><i class="fa-solid fa-user-pen"></i></button>
            <button class="btn btn-danger" title ="Abmelden" data-bs-toggle="modal" data-bs-target="#m<?= $d['id']; ?>-abmeldung"><i class="fa-solid fa-user-minus"></i></button>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php
      include "modal_dienst_info.php";
      include "modal_dienst_meldung.php";
      include "modal_dienst_abmeldung.php";
    ?>
  </div>
<?php }?>