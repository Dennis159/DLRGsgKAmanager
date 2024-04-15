<div class="modal fade" id="verlauf<?php echo $idshort; ?>" tabindex="-1" role="dialog" aria-labelledby="verlauf_<?php echo $idshort; ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="verlauf_<?php echo $idshort; ?>Label">Details von <?php echo $row['id']; ?></h5>
      </div>
      <div class="modal-body">
        <?php
          $res  = $TOOL->query("SELECT * FROM storage_verlauf WHERE id = '".$row['id']."' ORDER BY ausgegeben DESC")->fetchAll(PDO::FETCH_ASSOC);
          $days = 0;
          foreach ($res as $re) {
            $re['abgegeben'] = $re['abgegeben'] == null ? date('Y-m-d') : $re['abgegeben'];
            $date1 = new DateTime($re['ausgegeben']);
            $date2 = new DateTime($re['abgegeben']);

            $days1 = $date1->diff($date2);
            $days  = $days1->days + $days;
          }
        ?>
        Zeit im Umlauf: <?php echo $days; ?> Tage
      <hr>
        <h6>Zeitlicher Verlauf:</h6>
        <?php
          $c = 0;
          foreach ($res as $row){
            $c = $c + 1;
        ?>
          <div class="row">
            <div class="col-5"><?php echo GG_fnc_getUserFile($row['mitglied'])['nachname'] . ", " . GG_fnc_getUserFile($row['mitglied'])['vorname']; ?></div>
            <div class="col-6">
              <?php
                echo $row['abgegeben'] == null ? "<small class='text-muted'>seit</small> " . date('d.m.Y', strtotime($row['ausgegeben']))
                                               : date('d.m.Y', strtotime($row['ausgegeben']))." <small class='text-muted'>bis</small> " . date('d.m.Y', strtotime($row['abgegeben']));
              ?>
            </div>
          </div>
        <?php
          }
          echo $c == 0 ? "<i class='text-center text-muted'>Kleidungsstück war bisher noch nicht ausgegeben.</i>" : "";
        ?>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">schließen</button>
      </div>
    </div>
  </div>
</div>