<!-- Modal -->
<!-- <form method="post" enctype="multipart/form-data"> -->
  <div class="modal fade" id="m<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $d['id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="<?= $d['id']; ?>Label"><?= $d['titel'] ?></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width: 100%">
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-circle-info"></i></th>
              <th style="width: 7.5em;">Dienstart</th>
              <td><?= $d['type'] ?></td>
            </tr>
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-comments-question-check"></i></th>
              <th style="width: 7.5em;">Ansprechpartner</th>
              <td><?= $d['organisator'] ?></td>
            </tr>
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-map-location-dot"></i></th>
              <th style="width: 7.5em;">Location</th>
              <td class="pt-1 pb-2">
                  <b><?= $d['location_name'] ?></b><br>
                  <?= explode(", ", $d['location_adress'])[0] ?><br>
                  <?= explode(", ", $d['location_adress'])[1] ?><br>
                  <a href="<?= $d['location_maps'] ?>" target="_blank" class="link-success">zu Google Maps <i class="fa-regular fa-arrow-up-right-from-square"></i></a>
              </td>
            </tr>
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-clock"></i></th>
              <th style="width: 7.5em;">Dienstbeginn</th>
              <td><?= DLR_DP_dateFormat("D, d.m.Y H:i", $d['start']) ?> Uhr</td>
            </tr>
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-clock"></i></th>
              <th style="width: 7.5em;">Dienstende</th>
              <td><?= DLR_DP_dateFormat("D, d.m.Y H:i", $d['end']) ?> Uhr</td>
            </tr>
            <tr>
              <th style="width: 0.5em"><i class="fa-solid fa-text-size"></i></th>
              <th style="width: 7.5em;">Details</th>
              <td><?= $d['descr'] ?></td>
            </tr>
          </table>
        <hr>
          <table style="width: 100%;" class="table table-striped table-hover">
            <thead>
              <tr class="<?= DLR_DP_getStatusColor($d['positions'], $d['id'], "background") ?>">
                <th style="vertical-align: middle!important; width: 12em!important;">Position</th>
                <th class=" text-center" style="width: 2em!important;">Besetzung<br><small>Ist / Soll / Max</small></th>
                <th style="vertical-align: middle!important;">Helfer</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $positionen = json_decode($d['positions'], true);
              foreach ($positionen as $key => $value) {
            ?>
              <tr>
                <td class="pt-2"><?= DLR_DP_getPotsitionInfo($key)['name'] ?></td>
                <td class="pt-2 text-center"><?= DLR_DP_getPositionCount($d['id'], $key) ?> / <?= $value[0] ?> / <?= $value[1] ?></td>
                <td class="pt-2"><?= DLR_DP_getPositionNames($d['id'], $key, "<br>", "keine Anmeldungen für diese Position"); ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <hr>
          <h6>Abmeldungen</h6>
          <p class="ps-3">
            <?= DLR_DP_getPositionNames($d['id'], "ABML", ", ", "Keine Abmeldungen"); ?>
          </p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-bahbla btn-xs"></button>
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Schließen</button>
        </div>
      </div>
    </div>
  </div>
<!-- </form> -->