<?php
  if(isset($_POST['saveRappeleDienst'])){
    $date = $_POST['date'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $type = $_POST['type'];

    $TOOL->query("INSERT INTO list_rappenwoert (uid, date, start, end, type) VALUES ($uid, '$date', '$start', '$end', '$type')");
    DLR_fnc_reload();
  }
?>
<!-- Modal -->
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="newRappeleDienst<?= $season ?>" tabindex="-1" role="dialog" aria-labelledby="newRappeleDienst<?= $season ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="newRappeleDienst<?= $season ?>Label">Neuer Rappenwört Dienst</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-4 justify-content-between">
            <div class="col-3">
              <span class="text-secondary">Datum</span>
              <input type="date" name="date" class="form-control col-2" value="<?= $season ?>-05-01">
            </div>
            <div class="col-3">
              <span class="text-secondary">Start</span>
              <input type="time" name="start" class="form-control col-2" value="12:00">
            </div>
            <div class="col-3">
              <span class="text-secondary">Ende</span>
              <input type="time" name="end" class="form-control col-2" value="19:00">
            </div>
          </div>
          <div class="input-group input-group-static mb-4">
            <select class="customSelect" name="type">
              <option value="S">Sanitätsdienst</option>
              <option value="B">Beckendienst</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="saveRappeleDienst">Dienst speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>