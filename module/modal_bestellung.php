<?php
if(isset($_POST['bestellen' . $row['id']])){
  $id = $row['id'];
  $TOOL->query("UPDATE storage_antraege SET order_date = NOW() WHERE id = $id");
  DLR_fnc_reload();
}
?>
<div class="modal fade" id="bestellen<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="bestellen<?php echo $row['id']; ?>Label" aria-hidden="true">
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
          <i class="fa-solid fa-cart-plus text-success text-9xl"></i>
          <h4 class="text-gradient text-info mt-4 text-2xl">Möchtest du diesen Artikel wirklich als "bestellt" markieren?</h4>
        </div>
        <div class="py-3">
          <div class="row">
            <div class="col-4 text-bolder">Bezeichnung</div>
            <div class="col-7 text-md"><?php echo $row['bezeichnung'] ?? DLR_getArtikelDaten($row['artikel'])['bezeichnung']; ?></div>
          </div>
          <div class="row">
            <div class="col-4 text-bolder">Größe</div>
            <div class="col-7 text-md"><?php echo $row['size']; ?></div>
          </div>
          <div class="row">
            <div class="col-4 text-bolder">Beantragt am</div>
            <div class="col-7 text-md"><?php echo date('d.m.Y', strtotime($row['request_date'])); ?></div>
          </div>
          <?php if($page = "dashboard"){
          ?>
            <div class="row">
              <div class="col-4 text-bolder">Beantragt durch</div>
              <div class="col-7 text-md"><?php echo GG_fnc_getUserFile($row['member'])['vorname'] ?> <?php echo GG_fnc_getUserFile($row['member'])['nachname'] ?></div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <form method="post">
          <button type="submit" class="btn btn-warning" name="bestellen<?php echo $row['id']; ?>">Ja, als bestellt markieren</button>
        </form>
        <button type="button" class="btn btn-link text-success ml-auto" data-bs-dismiss="modal">Abbrechen</button>
      </div>
    </div>
  </div>
</div>