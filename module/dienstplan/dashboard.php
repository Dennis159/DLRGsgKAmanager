<div class="container-fluid py-4">
  <div class="row mb-4">

    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-solid fa-list-check"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Offene Dienste (Allgemein)</p>
            <h4 class="mb-0"><?= DLR_DP_dashb_getOpenDutys() ?></h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-solid fa-list-check"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Offene Dienste (nächste 14 Tage)</p>
            <h4 class="mb-0"><?= DLR_DP_dashb_getOpenDutys("14") ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-sharp fa-solid fa-info-circle"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Für Dienste gemeldet</p>
            <h4 class="mb-0"><?= DLR_DP_dashb_getNextDuty(true) ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-sharp fa-solid fa-timer"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Geleistete Stunden (Saison)</p>
            <h4 class="mb-0"><?= DLR_DP_dashb_getDutyHours("saison") ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-sharp fa-solid fa-timer"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Geleistete Stunden (Gesamt)</p>
            <h4 class="mb-0"><?= DLR_DP_dashb_getDutyHours("jahr") ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mt-4">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-sharp fa-solid fa-info-circle"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Mein nächster Dienst</p>
            <h6 class="mb-0"><?= DLR_DP_dashb_getNextDuty() ?></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <h5>Die nächsten 4 Dienste</h5>

  <div class="row">
    <?php
      $plan = $TOOL->query("SELECT * FROM dp_dienste WHERE start > NOW() LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
      echo empty($plan) ? "<h6 class='bg-gradient-info' style='width: 20em!important; margin-left: 0.8em'><i class='fa-solid fa-info-circle'></i> <i>Keine Dienst in der Zukunft geplant</i></h6>" : "";
      foreach($plan as $d) {
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
              <button class="btn btn-success" title="Anmelden"><i class="fa-solid fa-user-plus"></i></button>
              <button class="btn btn-danger" title ="Abmelden"><i class="fa-solid fa-user-minus"></i></button>
            <?php } if(DLR_DP_getUserRegisterState($d['id'], true) == "ABML"){ ?>
              <button class="btn btn-success" title="Anmelden"><i class="fa-solid fa-user-plus"></i></button>
            <?php } if(DLR_DP_getUserRegisterState($d['id'], true) == "YES"){ ?>
              <button class="btn btn-info" title ="Anmeldung bearbeiten"><i class="fa-solid fa-user-pen"></i></button>
              <button class="btn btn-danger" title ="Abmelden"><i class="fa-solid fa-user-minus"></i></button>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php include "module/modal_dienst_info.php"; ?>
    </div>
    <?php }?>

  </div>

</div>

<script>
  let dienstplan = new DataTable('#dienstplan', {
    responsive: true
  });
</script>