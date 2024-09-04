<!-- Modal -->
<div class="modal fade" id="m<?= $d['id']; ?>-meldung" tabindex="-1" role="dialog" aria-labelledby="<?= $d['id']; ?>Label" aria-hidden="true">
  <form method="get" action="/module/dienstplan/module/formulare.php">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="<?= $d['id']; ?>Label"><?= $d['titel'] ?><br>Helfermeldung
            <?= (DLR_DP_getUserRegisterState($d['id'], true) == "YES") ? "bearbeiten" : "";  ?></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <style>
          .line-heigth-1 {
            line-height: 3em!important;
            vertical-align: middle!important;
          }
        </style>
        <div class="modal-body">
          <table style="width: 100%">
            <tr>
              <th class="line-heigth-1" style="width: 8em;">Position</th>
              <td class="line-heigth-1">
                <input type="hidden" name="dienst" value="<?= $d['id']?>">
                <select name="position" id="position" class="customSelect">
                  <?php foreach (json_decode($d['positions'], true) as $key => $arr){ ?>
                    <option value="<?= $key ?>" <?= (DLR_DP_getUserRegisterState($d['id'], true, true) == $key) ? "selected" : ""; ?>><?= DLR_DP_getPotsitionInfo($key)['name'] ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <th class="line-heigth-1">Teilzeit</th>
              <td class="line-heigth-1" style="vertical-align: middle;">
                <div class="form-check p-0">
                  <input type="checkbox" class="form-check-input" id="checkTeilzeit" name="teilzeit" style="vertical-align: middle!important;" onclick="
                         if(this.checked){
                           document.getElementById('Start-<?=$d['id']?>').disabled = false;
                           document.getElementById('End-<?=$d['id']?>').disabled = false;
                         } else {
                           document.getElementById('Start-<?=$d['id']?>').disabled = true;
                           document.getElementById('End-<?=$d['id']?>').disabled = true;
                           document.getElementById('Start-<?=$d['id']?>').value = '<?= $d['start'] ?>';
                           document.getElementById('End-<?=$d['id']?>').value = '<?= $d['end'] ?>';
                         }
                       " <?= (DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'])) ? "checked" : "";?>>
                  <label class="custom-control-label" for="checkTeilzeit">Eingeschränkt verfügbar wie folgt:</label>
                </div>
              </td>
            </tr>
            <tr>
              <th class="line-heigth-1">Von</th>
              <td class="line-heigth-1">
                <input type="datetime-local" name="start" id="Start-<?=$d['id']?>" class="form-control"
                       value="<?= (DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'])) ? DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'], false)['start_abw'] : date('Y-m-d\TH:i', strtotime($d['start'])); ?>"
                       min="<?= date('Y-m-d\TH:i', strtotime($d['start'])); ?>"
                       max="<?= date('Y-m-d\TH:i', strtotime($d['end'])); ?>" style="padding: 0"
                     <?= (DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'])) ? "" : "disabled"?>>
              </td>
            </tr>
            <tr>
              <th class="line-heigth-1">Bis</th>
              <td class="line-heigth-1">
                <input type="datetime-local" name="end" id="End-<?=$d['id']?>" class="form-control"
                       value="<?= (DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'])) ? DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'], false)['end_abw'] : date('Y-m-d\TH:i', strtotime($d['end'])); ?>"
                       min="<?= date('Y-m-d\TH:i', strtotime($d['start'])); ?>"
                       max="<?= date('Y-m-d\TH:i', strtotime($d['end'])); ?>" style="padding: 0"
                     <?= (DLR_DP_getTeilzeit($d['id'], $_SESSION['uid'])) ? "" : "disabled"?>>
              </td>
            </tr>
            <tr>
              <th class="pt-3">Bemerkung</th>
              <td class="line-heigth-1 pt-3">
                <textarea name="bemerkung" id="" cols="30" rows="5" class="form-control"
                          style="border: 1px solid grey; padding: 1em" placeholder="Wenn du eine Bemerkung zu deiner Meldung hast, ist hier Platz dafür."><?= DLR_DP_getBemerkung($d['id'], $_SESSION['uid'])?></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Schließen</button>
          <button type="submit" class="btn btn-success" name="SaveMeldung">Meldung absenden</button>
        </div>
      </div>
    </div>
  </form>
</div>