<?php
  $seasons = $TOOL->query("SELECT DISTINCT YEAR(date) as season FROM list_rappenwoert WHERE uid = $uid")->fetchAll(PDO::FETCH_ASSOC);
  if(count($seasons) == 1){ $seasons[] = array("season" => NULL); }

 ?>
    <div class="nav-wrapper position-relative end-0">
      <ul class="nav nav-pills nav-fill nav-pills-vertical" role="tablist" style="background: transparent!important;">
        <?php foreach ($seasons as $s) {if($s['season'] == NULL){continue;}?>
        <li class="nav-item">
          <a class="nav-link <?= ($seasons[count($seasons) - 2]['season']== $s['season']) ? "active" : "" ?>" data-bs-toggle="tab" href="#season_<?= $s['season'] ?>" role="tab" aria-controls="atn" aria-selected="true"><?= $s['season'] ?></a>
        </li>
        <?php } ?>
      </ul>
    </div>
<br>
<div class="tab-content">
  <?php foreach ($seasons as $key => $season) { $season = $season['season']; if($season == NULL){continue;} ?>
  <div class="tab-pane <?= ($seasons[count($seasons) - 2]['season']== $season) ? "active" : "" ?>" id="season_<?= $season ?>">
    <?php if($USER['rank'] == 2){ ?>
      <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#newRappeleDienst<?= $season ?>"><i class="fa-solid fa-plus"></i> Neuer Dienst</a>
    <?php } ?>

    <a class="btn btn-outline-info" href="?pdf-rappele-single&season=<?= $season ?>&user=<?php echo $uid ?>"><i class="fa-solid fa-download"></i> Als PDF herunterladen</a>

    <table class="table align-items-center mb-0" style="width: 100%!important;" id="table_<?= $season ?>">
      <thead>
      <tr>
        <th style="width: 1em;"></th>
        <th class="text-center text-secondary">Datum</th>
        <th class="text-center text-secondary">Start</th>
        <th class="text-center text-secondary">Ende</th>
        <th style="width: 1em;" class="text-center text-secondary">Art</th>
        <th class="text-center text-secondary">Stunden</th>
        <?php if($USER['rank'] == 2){ ?>
          <th class="text-center text-secondary">Verdienst (EK)</th>
          <th class="text-center text-secondary">Verdienst (DLRG)</th>
        <?php } else { ?>
          <th class="text-center text-secondary">Verdienst</th>
        <?php } ?>
      </tr>
      </thead>
      <tbody>
      <?php
      $sanA = $TOOL->query("SELECT * FROM list_rappenwoert WHERE uid = $uid AND YEAR(date) = $season ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);
      $verdienstEK = 0;
      $verdienstDLR = 0;
      $verdienstEKges = 0;
      $verdienstSGges = 0;
      $hoursges = 0;
      $hoursPges = 0;
      $c = 0;
      foreach ($sanA as $san) {
        $c++;
        $season = explode("-", $san['date'])[0];
        ?>
        <tr>
          <td>#<?=$c?></td>
          <td class="text-center"><?= date('d.m.Y', strtotime($san['date'])) ?></td>
          <td class="text-center"><?= date('H:i', strtotime($san['start'])) ?> Uhr</td>
          <td class="text-center"><?= date('H:i', strtotime($san['end'])) ?> Uhr</td>
          <td class="text-center"><?= ($san['type']) == "S" ? '<i class="fa-solid fa-briefcase-medical"></i>' : '<i class="fa-solid fa-life-ring"></i>'; ?></td>
          <td class="text-center"><?php
            $hours = round((strtotime($san['end']) - strtotime($san['start'])) / 3600,  2);
            $hoursges += $hours;
            $hoursP = ($hours > 6) ? $hours - 0.5 : $hours;
            $hoursPges += $hoursP;
            echo str_replace(".", ",", $hoursP) . " Stunden";
            echo " <small class='text-secondary' title='Gesamtstunden ohne Pausenabzug'>(".str_replace(".", ",", $hours).")</small>";
            $verdienstEK    = $hoursP * $VERDIENST[$season]["EK"];
            $verdienstSG    = $hoursP * $VERDIENST[$season]["SG"];
            $verdienstEKges += $verdienstEK;
            $verdienstSGges += $verdienstSG;
            ?></td>
          <?php if($USER['rank'] == 2){ ?>
            <td class="text-center"><?= number_format($verdienstEK, 2, ",", "."); ?> €</td>
            <td class="text-center"><?= number_format($verdienstSG, 2, ",", "."); ?> €</td>
          <?php } else { ?>
            <td class="text-center"><?= number_format($verdienstEK, 2, ",", "."); ?> €</td>
          <?php } ?>
        </tr>
      <?php } ?>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="5" class="text-success text-bolder" style="text-align: right!important;">GESAMT</td>
        <td class="text-success text-bolder text-center"><?= str_replace(".", ",", $hoursPges) ?> Stunden</td>
        <?php if($USER['rank'] == 2){ ?>
          <td class="text-success text-bolder text-center"><?= number_format($verdienstEKges, 2, ',', '.') . ' €' ?></td>
          <td class="text-success text-bolder text-center"><?= number_format($verdienstSGges, 2, ',', '.') . ' €' ?></td>
        <?php } else { ?>
          <td class="text-success text-bolder text-center"><?= number_format($verdienstEKges, 2, ',', '.') . ' €' ?></td>
        <?php } ?>
      </tr>
      </tfoot>
    </table>

    <?php include $_SERVER['DOCUMENT_ROOT']."/module/management/modules/modals/modal_rappenwoert.php"; ?>

    <script>
      let table = new DataTable('#table_<?= $season ?>', {
        responsive: true
      });
    </script>
  </div>
  <?php } ?>
</div>
