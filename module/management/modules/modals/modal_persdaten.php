<?php
if(isset($_POST['editEmail'])){
  $email = $_POST['email'];
  $TOOL->query("UPDATE mgmt_userfiles set email = '$email' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="editEmail" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Persönliche Daten bearbeiten<br><small>E-Mail Adresse</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>E-Mail</label>
            <input type="email" class="form-control" name="email" value="<?php echo $PROFILE['email'] != "" ? $PROFILE['email'] : ''; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="editEmail">Änderung speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
if(isset($_POST['editPhone'])){
  $phone = $_POST['phone'];
  $TOOL->query("UPDATE mgmt_userfiles set telefon = '$phone' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="editPhone" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Persönliche Daten bearbeiten<br><small>Handynummer</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>Handynummer</label>
            <input type="phone" class="form-control" name="phone" value="<?php echo $PROFILE['telefon'] != "" ? $PROFILE['telefon'] : ''; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="editPhone">Änderung speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
if(isset($_POST['editISC'])){
  $phone = $_POST['isc_benutzer'];
  $TOOL->query("UPDATE mgmt_userfiles set isc_benutzer = '$phone' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="editISC" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Persönliche Daten bearbeiten<br><small>ISC-Benutzername</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>ISC-Benutzername</label>
            <input type="text" class="form-control" name="isc_benutzer" value="<?php echo $PROFILE['isc_benutzer'] != "" ? $PROFILE['isc_benutzer'] : ''; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="editISC">Änderung speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>
