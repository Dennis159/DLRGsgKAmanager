<?php
  if($USER['rank'] == 1){
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
?>
<div class="container-fluid py-4">
  <div class="row mb-4">

    <div class="col-lg-3 col-md-6 col-6 mt-1">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-solid fa-users"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Registrierte Nutzer</p>
            <h4 class="mb-0">
              <?php
                echo ($TOOL->query("SELECT count(*) as count FROM mgmt_userfiles")->fetch()['count']) - 1;
              ?>
            </h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mt-1">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-sharp fa-solid fa-person-drowning"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Tauglich für Beckendienst</p>
            <h4 class="mb-0">
              <?php
                echo $TOOL->query("SELECT count(*) as count FROM mgmt_atns WHERE `152` >= 3")->fetch()['count'];
              ?>
            </h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mt-1">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-solid fa-suitcase-medical"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Tauglich für Sanitätsdienst</p>
            <h4 class="mb-0">
              <?php
                echo $TOOL->query("SELECT count(*) as count FROM mgmt_atns WHERE `331` >= 3 OR `332` >= 3 OR san_andere LIKE '\"3\"' OR san_andere LIKE '\"4\"'")->fetch()['count'];
              ?>
            </h4>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mt-1">
      <div class="card">
        <div class="card-body p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="fa-solid fa-light-emergency-on"></i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0">Tauglich für Mobiler-WRD</p>
            <h4 class="mb-0">
              <?php
              echo $TOOL->query("SELECT count(*) as count FROM mgmt_atns WHERE `812` >= 3")->fetch()['count'];
              ?>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-4">

      <div class="card">
        <div class="card-body">
          <h4 class="text-secondary">Anstehende GUV-Unterweisungen</h4>
          <table class="table table-striped" id="guvtable">
            <thead>
              <tr>
                <th>Mitglied</th>
                <th>Letzte Unterweisung</th>
                <th>Läuft ab in</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $guv = $TOOL->query("SELECT * FROM mgmt_userfiles")->fetchAll(PDO::FETCH_ASSOC);
                foreach($guv as $guv){
                 $anzeigen = false;
                 $days = intval(DLR_getLastGUVDays($guv['guv_unterweisung'], true));
                  if ($days >= 365) {
                    $badge = "badge-danger";
                    $daystext = "vor <b style='font-weight: 900'>" . ((365 - $days) * - 1) . " Tagen</b> abgelaufen";
                    $anzeigen = true;
                  } elseif ($days >= 335) {
                    $badge = "badge-warning";
                    $daystext = (365 - $days) . " Tagen";
                    $anzeigen = true;
                  } elseif ($days == 0 AND $guv['guv_unterweisung'] != date('Y-m-d')){
                    $badge = "badge-danger";
                    $daystext = "Hat noch nie eine bekommen!";
                    $anzeigen = true;
                  }
                  if($anzeigen){
              ?>
                <tr>
                  <td><?php echo $guv['vorname'] ?> <?php echo $guv['nachname'] ?></td>
                  <td><?php echo $guv['guv_unterweisung'] != null ? date('d.m.Y', strtotime($guv['guv_unterweisung'])) : "<span class='badge badge-danger'>niemals</span>" ?></td>
                  <td><span class="badge <?php echo $badge ?>"><?php echo $daystext ?></span></td>
                </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
      </div>

  </div>

  <div class="row mb-4">

    <div class="card">
      <div class="card-body">
        <h4 class="text-secondary">Offene Poolwäsche-Anträge</h4>
        <table class="table table-striped" id="pooltable">
          <thead>
          <tr>
            <th>Mitglied</th>
            <th>Kleidungsstück</th>
            <th>Größe</th>
            <th>Antragsdatum</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $res = $TOOL->query("SELECT * FROM storage_antraege")->fetchAll(PDO::FETCH_ASSOC);
          foreach($res as $row){
            ?>
            <tr>
              <td><?php echo GG_fnc_getUserFile($row['member'])['vorname'] ?> <?php echo GG_fnc_getUserFile($row['member'])['nachname'] ?></td>
              <td><?php echo DLR_getArtikelDaten($row['artikel'])['bezeichnung'] ?></td>
              <td><span class="badge badge-secondary"><?php echo $row['size'] ?></span></td>
              <td><?php echo date('d.m.Y', strtotime($row['request_date'])) ?></td>
              <td>
                <?php
                  if($row['order'] == 1 AND $row['order_date'] == NULL){
                    if($USER['rank'] == 2){
                      echo "<span class='badge badge-danger' style='cursor: pointer' data-bs-toggle='modal' data-bs-target='#bestellen".$row['id']."'>Bestellung notwendig</span>";
                    } else {
                      echo "<span class='badge badge-danger'>Bestellung notwendig</span>";
                    }
                  }
                  if($row['order'] == 1 AND $row['order_date'] != NULL AND $row['ordercomplete'] != 1){
                    echo "<span class='badge badge-warning'>Bestellung ausgelöst</span>";
                  }
                  if($row['order'] == 0){
                    echo "<span class='badge badge-success'>im Lager</span>";
                  }
                  if($row['ordercomplete'] == 1 AND $row['order'] == 1){
                    echo "<span class='badge badge-success'>Bestellung geliefert</span>";
                  }
                ?>
              </td>
            </tr>
          <?php
             include $_SERVER['DOCUMENT_ROOT'] . "/module/modal_bestellung.php";
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<script>
  let pooltable = new DataTable('#pooltable', {
    responsive: true
  });
  let poolbestellung = new DataTable('#poolbestellung', {
    responsive: true
  });
  let guvtable = new DataTable('#guvtable', {
    responsive: true
  });
</script>