<div class="container-fluid p-4">
  <div class="card">
    <?php
    $seasons = $TOOL->query("SELECT DISTINCT YEAR(date) as season FROM list_rappenwoert")->fetchAll(PDO::FETCH_ASSOC);
    if(count($seasons) == 1){ $seasons[] = array("season" => NULL); }
    ?>
    <style>
      td, th {
        text-align: left!important;
      }
    </style>
    <div class="card-header">
      <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill nav-pills-vertical" role="tablist" style="background: transparent!important;">
          <?php foreach ($seasons as $s) {if($s['season'] == NULL){continue;}?>
            <li class="nav-item">
              <a class="nav-link <?= ($seasons[count($seasons) - 2]['season']== $s['season']) ? "active" : "" ?>" data-bs-toggle="tab" href="#season_<?= $s['season'] ?>" role="tab" aria-controls="atn" aria-selected="true"><?= $s['season'] ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <?php foreach ($seasons as $key => $season) { $season = $season['season']; if($season == NULL){continue;} ?>
          <div class="tab-pane <?= ($seasons[count($seasons) - 2]['season']== $season) ? "active" : "" ?>" id="season_<?= $season ?>">
            <a class="btn btn-outline-info" href="?pdf-rappele-season-all-intern&season=<?= $season ?>"><i class="fa-solid fa-download"></i> Saison als PDF herunterladen (INTERNE Version)</a>
            <a class="btn btn-outline-info" href="?pdf-rappele-season-all-extern&season=<?= $season ?>"><i class="fa-solid fa-download"></i> Saison als PDF herunterladen (EXTERNE Version)</a>


            <table class="table align-items-center mb-0" style="width: 100%!important;" id="table_<?= $season ?>">
              <thead>
              <tr>
                <th class="text-secondary">Einsatzkraft</th>
                <th class="text-secondary">Anzahl Dienste</th>
                <th class="text-secondary">Stunden</th>
                <th class="text-secondary">Verdienst (EK)</th>
                <th class="text-secondary">Verdienst (SG)</th>
                <th class="text-secondary">Verdienst (Gesamt)</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $sanA = $TOOL->query("SELECT uid, COUNT(*) AS row_count FROM list_rappenwoert WHERE YEAR(date) = $season GROUP BY uid ORDER BY row_count DESC ")->fetchAll(PDO::FETCH_ASSOC);
              $c = 0;
              foreach ($sanA as $san) {
                $uid = $san['uid'];
                $hoursges       = 0;
                $hoursPges      = 0;
                $verdienstEKges = 0;
                $verdienstSGges = 0;
                $u = $TOOL->query("SELECT * FROM list_rappenwoert WHERE uid = $uid AND YEAR(date) = $season")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($u as $i){
                  $hours = round((strtotime($i['end']) - strtotime($i['start'])) / 3600, 2);
                  $hoursges += $hours;
                  $hoursP = $hours - ($hours > 6 ? 0.5 : 0);
                  $hoursPges += $hoursP;
                  $verdienstEKges += $hoursP * $VERDIENST[$season]["EK"];
                  $verdienstSGges += $hoursP * $VERDIENST[$season]["SG"];
                }
                ?>
                <tr>
                  <td><?= GG_fnc_getUserName($uid) ?></td>
                  <td><?= $san['row_count'] ?> Dienste</td>
                  <td><?= str_replace(".", ",", $hoursPges) . " Stunden" ?> <?= "<small class='text-secondary' title='Gesamtstunden ohne Pausenabzug'>(".str_replace(".", ",", $hoursges).")</small>" ?></td>
                  <td><?= number_format($verdienstEKges, 2, ',', '.') . ' €' ?></td>
                  <td><?= number_format($verdienstSGges, 2, ',', '.') . ' €' ?></td>
                  <td><?= number_format($verdienstSGges+$verdienstEKges, 2, ',', '.') . ' €' ?></td>
                </tr>
              <?php
                  $hoursgesGes += $hoursges;
                  $hoursPgesGes += $hoursPges;
                  $verdienstEKgesGes += $verdienstEKges;
                  $verdienstSGgesGes += $verdienstSGges;
                }
              ?>
              </tbody>
              <tfoot>
              <tr>
                <td colspan="2" class="text-success text-bolder" style="text-align: right!important;">GESAMT</td>
                <td class="text-success text-bolder"><?= str_replace(".", ",", $hoursPgesGes) ?> Stunden</td>
                <td class="text-success text-bolder"><?= number_format($verdienstEKgesGes, 2, ',', '.') . ' €' ?></td>
                <td class="text-success text-bolder"><?= number_format($verdienstSGgesGes, 2, ',', '.') . ' €' ?></td>
                <td class="text-success text-bolder"><?= number_format($verdienstSGgesGes+$verdienstEKgesGes, 2, ',', '.') . ' €' ?></td>
              </tr>
              </tfoot>
            </table>

            <?php include "modal_rappenwoert.php"; ?>

            <script>
              let table = new DataTable('#table_<?= $season ?>', {
                responsive: true,
                ordered: false;
              });
            </script>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

</div>