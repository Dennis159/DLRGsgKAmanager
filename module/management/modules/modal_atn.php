<?php
if(isset($_POST['changeATNstatus'])){
  $atn = $_POST['atn'];
  $sts = $_POST['status'];
  $san = $_POST['san_andere'] ?? false;

  if(!$san){
    $TOOL->query("UPDATE mgmt_atns SET `$atn` = $sts WHERE uid = $uid");
  } else {
    $sts = json_encode(array($san, $sts), JSON_UNESCAPED_UNICODE);
    $TOOL->query("UPDATE mgmt_atns SET `$atn` = '$sts' WHERE uid = $uid");
  }
}
?>
<!-- Modal -->
<form method="post" accept-charset="UTF-8">
  <div class="modal fade" id="atnEdit" tabindex="-1" role="dialog" aria-labelledby="atnEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="atnEditLabel">ATN-Status bearbeiten</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-static mb-4">
            <select class="customSelect" name="atn" id="exampleFormControlSelect1" onchange="getStatus(this.value)">
              <option disabled hidden selected># # # # # # # # # # ATN Auswählen # # # # # # # # # #</option>
              <option disabled>Sanitätsausbildungen</option>
              <option value="331">331 | Sanitätslehrgang A</option>
              <option value="332">332 | Sanitätslehrgang B</option>
              <option value="san_andere">Weitere med. Ausbildung (RH; RS; NFS; DRK-SanH; ...)</option>

              <option disabled>Rettungsschwimmscheine</option>
              <option value="152">152 | Rettungsschwimmer Silber</option>

              <option disabled>Einsatzdienst / Bootswesen</option>
              <option value="411">411 | Wasserretter</option>
              <option value="431">431 | Wachführer</option>
              <option value="511">511 | Bootsführerschein A</option>
              <option value="613">613 | Einsatztaucher Stufe 2</option>
              <option value="641">641 | Signalmann</option>
              <option value="652">652 | Gruppenführer</option>
              <option value="710">710 | DLRG Betriebsfunk</option>
              <option value="712">712 | BOS Sprechfunkzeugnis - analog -</option>
              <option value="715">715 | BS Sprechfunkzeignis - digital -</option>
              <option value="812">812 | Fachhelfer-BW</option>
              <option value="1011">1011 | Strömungsretter Stufe 1</option>
              <option value="1028">1028 | Strömungsretter Stufe 2</option>
            </select>
          </div>
          <div class="input-group" id="stati"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary" name="changeATNstatus">Änderung speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function getStatus(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/module/management/modules/XMLHttpRequest_ATN.php?atn='+x+'&user=<?php echo $uid ?>', true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById("stati").innerHTML = xhr.responseText;
        } else {
          jsActionConsoleLog('Request failed: ' + xhr.status, "error");
        }
      }
    };

    xhr.send();
  }
</script>