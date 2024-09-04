<?php
  if(isset($_POST['saveEvent' . date('dmY', strtotime($event['date']))])){
    $date       = $_POST['date'];
    $name       = $_POST['name'];
    $teilnehmer = $_POST['teilnehmer'] == null ? "[]" : json_encode($_POST['teilnehmer']);

    $TOOL->query("UPDATE list_uebungen SET date = '$date', name = '$name', members = '$teilnehmer' WHERE date = '".$event['date']."'");
    DLR_fnc_reload();
  }
?>
<form method="post">
  <div class="modal fade" id="uebung<?php echo date('dmY', strtotime($event['date'])); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title">Übungsdienst <?php echo date('d.m.Y', strtotime($event['date'])); ?><br>
              <small class="text-secondary"><?php echo str_replace("<br>", " / ", $event['name']) ?></small></h6>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Datum (01.MONAT.JAHR wird in xx.MONAT.JAHR umgewandelt)</label>
            <input type="date" class="form-control" name="date" value="<?php echo $event['date'] ?>">
          </div>
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Thema</label>
            <input type="text" class="form-control" name="name" value="<?php echo $event['name'] ?>">
          </div>
          <div class="input-group input-group-outline my-3">
            <select class="teilnehmer<?php echo $count ?> customSelect" name="teilnehmer[]" multiple="multiple" id="teilnehmer<?php echo $count ?>" readonly> </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="text-start btn btn-outline-warning" name="saveEvent<?php echo date('dmY', strtotime($event['date'])); ?>" style="float: left">Speichern</button>
          <button type="button" class="btn btn-link text-success ml-auto" data-bs-dismiss="modal">schließen</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(".teilnehmer<?php echo $count ?>").select2({
    placeholder: "Wähle einen oder mehrere Teilnehmer",
    theme: "classic",
    data: [
      <?php
        foreach ($users as $user){
      ?>
        {
          "id": <?php echo $user['uid'] ?>,
          "text": "<?php echo $user['vorname'] ?> <?php echo $user['nachname'] ?>"
        },
      <?php
        }
      ?>
    ]
  });
  $('#teilnehmer<?php echo $count ?>').val(<?php echo $event['members'] ?>).trigger('change');
</script>