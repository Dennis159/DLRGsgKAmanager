<!-- Modal -->
<div class="modal fade" id="m<?= $d['id']; ?>-abmeldung" tabindex="-1" role="dialog" aria-labelledby="<?= $d['id']; ?>Label" aria-hidden="true">
  <form method="get" action="/module/dienstplan/module/formulare.php">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="<?= $d['id']; ?>Label"><?= $d['titel'] ?><br>Abmeldung</h5>
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
          <input type="hidden" name="dienst" value="<?= $d['id']?>">
          <input type="hidden" name="position" value="ABML">
          <table style="width: 100%">
            <?php if(DLR_DP_getUserRegisterState($d['id'], true) == "YES"){ ?>
              <tr>
                <th>Aktuelle Position</th>
                <td><?= DLR_DP_getUserRegisterState($d['id']) ?></td>
              </tr>
            <?php } ?>
            <tr>
              <th>Bemerkung</th>
              <td class="line-heigth-1">
                <textarea name="bemerkung" id="" cols="30" rows="5" class="form-control"
                          style="border: 1px solid grey; padding: 1em" placeholder="Wenn du eine Bemerkung zu deiner Abmeldung hast, ist hier Platz dafür."></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-danger" name="SaveMeldung">von Dienst abmelden</button>
        </div>
      </div>
    </div>
  </form>
</div>

