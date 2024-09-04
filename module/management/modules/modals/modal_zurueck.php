<?php
  if(isset($_POST['zurueck'])){
    $aid = $_POST['id'];
    $TOOL->query("UPDATE storage_verlauf SET abgegeben = NOW() WHERE id = '$aid' AND abgegeben is NULL");
    $TOOL->query("UPDATE storage_artikel SET status = 0, mitglied = null WHERE id = '$aid'");
    DLR_fnc_reload();
  }
?>
<div class="modal fade" id="abgeben<?php echo $idshort; ?>" tabindex="-1" role="dialog" aria-labelledby="abgeben_<?php echo $idshort; ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-normal" id="modal-title-notification">Deine Bestätigung ist erforderlich!</h6>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          <i class="fa-solid fa-triangle-exclamation text-warning text-9xl"></i>
          <h4 class="text-gradient text-danger mt-4 text-2xl">Möchtest du dieses Kleidungsstück wirklich in das Lager zurücklegen?</h4>
        </div>
        <div class="py-3">
          <div class="row">
            <div class="col-4 text-bolder">Bezeichnung</div>
            <div class="col-7 text-md"><?php echo $row['bezeichnung']; ?></div>
          </div>
          <div class="row">
            <div class="col-4 text-bolder">Größe</div>
            <div class="col-7 text-md"><?php echo $row['groesse']; ?></div>
          </div>
          <div class="row">
            <div class="col-4 text-bolder">Ausgegeben am</div>
            <div class="col-7 text-md"><?php echo date('d.m.Y', strtotime($row['ausgegeben'])); ?></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <button type="submit" class="btn btn-warning" name="zurueck">Ja, zurücklegen</button>
        </form>
        <button type="button" class="btn btn-link text-success ml-auto" data-bs-dismiss="modal">Abbrechen</button>
      </div>
    </div>
  </div>
</div>