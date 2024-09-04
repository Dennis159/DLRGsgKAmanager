<?php
  if(isset($_POST['changeUnterweisugnGUV'])){
    $unterweisung_guv = $_POST['unterweisung_guv'];
    $TOOL->query("UPDATE mgmt_userfiles set guv_unterweisung = '$unterweisung_guv' WHERE uid = $uid");
    DLR_fnc_reload();
  }
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="unterweisungGUV" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">GUV-Unterweisung</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php if(DLR_getLastGUVStatus($PROFILE['guv_unterweisung']) != "text-danger"){ ?>
            Die letzte GUV-unterweisung fand am <b><?php echo DLR_getLastGUV($PROFILE['guv_unterweisung'], true); ?></b> statt.<br>
            Sie ist nun <?php echo DLR_getLastGUVDays($PROFILE['guv_unterweisung']); ?> Tage her und somit <?php echo DLR_getLastGUVStatus($PROFILE['guv_unterweisung']); ?>
          <?php } else { ?>
            <div class="input-group text-center">
              <span class="text-warning text-bold">Bei diesem Mitglied wurde <i><u class="text-danger" style="font-weight: 900!important;">noch nie</u></i>
                                                   eine GUV-Unterweisung durchgeführt!</span>
            </div>
          <?php } ?>
          <hr>
          <h6>Neue GUV-Unterweisung eintragen</h6>
          <div class="input-group input-group-static mb-4">
            <label>Datum</label>
            <input type="date" class="form-control" name="unterweisung_guv" value="<?php echo  date('Y-m-d') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeUnterweisugnGUV">Änderung speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
if(isset($_POST['changeunterweisung1911'])){
  $unterweisung_1911 = $_POST['unterweisung_1911'];
  $TOOL->query("UPDATE mgmt_userfiles set 1911_unterweisung = '$unterweisung_1911' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="unterweisung1911" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Pelikan Karlsruhe 1/91-1 (WRF-T)<br><small>Unterweisung</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>Datum</label>
            <input type="date" class="form-control" name="unterweisung_1911" value="<?php echo $PROFILE['1911_unterweisung'] != "" ? $PROFILE['1911_unterweisung'] : date('Y-m-d') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeunterweisung1911">Unterweisugn speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
if(isset($_POST['changeunterweisung1931'])){
  $unterweisung_1931 = $_POST['unterweisung_1931'];
  $TOOL->query("UPDATE mgmt_userfiles set 1931_unterweisung = '$unterweisung_1931' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="unterweisung1931" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Pelikan Karlsruhe 1/93-1 (WRF-B)<br><small>Unterweisung</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>Datum</label>
            <input type="date" class="form-control" name="unterweisung_1931" value="<?php echo $PROFILE['1931_unterweisung'] != "" ? $PROFILE['1931_unterweisung'] : date('Y-m-d') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeunterweisung1931">Unterweisugn speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>


<?php
if(isset($_POST['changeunterweisung1941'])){
  $unterweisung_1941 = $_POST['unterweisung_1941'];
  $TOOL->query("UPDATE mgmt_userfiles set 1941_unterweisung = '$unterweisung_1941' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="unterweisung1941" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Pelikan Karlsruhe 1/94-1 ("Oma Roth")<br><small>Unterweisung</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>Datum</label>
            <input type="date" class="form-control" name="unterweisung_1941" value="<?php echo $PROFILE['1941_unterweisung'] != "" ? $PROFILE['1941_unterweisung'] : date('Y-m-d') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeunterweisung1941">Unterweisugn speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
if(isset($_POST['changeunterweisung1942'])){
  $unterweisung_1942 = $_POST['unterweisung_1942'];
  $TOOL->query("UPDATE mgmt_userfiles set 1942_unterweisung = '$unterweisung_1942' WHERE uid = $uid");
  DLR_fnc_reload();
}
?>
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="unterweisung1942" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">Pelikan Karlsruhe 1/94-2 ("Wüstenrot")<br><small>Unterweisung</small></h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <label>Datum</label>
            <input type="date" class="form-control" name="unterweisung_1942" value="<?php echo $PROFILE['1942_unterweisung'] != "" ? $PROFILE['1942_unterweisung'] : date('Y-m-d') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeunterweisung1942">Unterweisugn speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>