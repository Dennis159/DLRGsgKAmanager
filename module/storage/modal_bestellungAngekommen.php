<?php
  if(isset($_POST['bestellung'])){
    foreach ($_POST['bestellung'] as $b){
      $TOOL->query("UPDATE storage_antraege SET ordercomplete = 1 WHERE id = $b");
    }
  }
?>
<form method="post">
  <div class="modal fade" id="bestellungAngekommen" tabindex="-1" role="dialog" aria-labelledby="bestellungAngekommenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="newArticleLabel">Angekommene Bestellungen</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-1"></div>
            <div class="col-2 text-bolder">Artikelnummer</div>
            <div class="col-1 text-bolder">Größe</div>
            <div class="col-6 text-bolder">Bezeichnung</div>
          </div>
          <?php
            $res = $TOOL->query("SELECT sa.id, sa.artikel, sa.size, sa.size, sl.bezeichnung FROM storage_antraege sa 
                                       JOIN storage_artikelliste sl on sa.artikel = sl.artikelnummer WHERE sa.order_date is not null and sa.ordercomplete = 0
                               ")->fetchAll(PDO::FETCH_ASSOC);
            $c = 0;
            foreach ($res as $row){
              $c++;
          ?>
          <div class="row">
            <div class="col-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="bestellung[]" value="<?php echo $row['id']; ?>" id="fcustomCheck1">
                <label class="custom-control-label" for="customCheck1"></label>
              </div>
            </div>
            <div class="col-2"><?php echo $row['artikel']; ?></div>
            <div class="col-1"><?php echo $row['size']; ?></div>
            <div class="col-6"><?php echo $row['bezeichnung']; ?></div>
          </div>
          <?php
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary">speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>