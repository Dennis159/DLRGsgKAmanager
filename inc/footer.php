<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
                document.write(new Date().getFullYear())
          </script>,

          <a href="https://karlsruhe.dlrg.de" class="font-weight-bold" target="_blank">DLRG Stadtgruppe Karlsruhe</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="http://karlsruhe.dlrg.de" class="nav-link text-muted" target="_blank">Homepage</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const bMobile = navigator.userAgent.indexOf("Mobile") !== -1 ||
      navigator.userAgent.indexOf("iPhone") !== -1 ||
      navigator.userAgent.indexOf("Android") !== -1 ||
      navigator.userAgent.indexOf("Windows Phone") !== -1;

    if (bMobile) {
      document.getElementById("sidenav-main").classList.add("bg-gradient-dark");
      document.getElementById("sidenav-main").classList.remove("dlrg-background-transparent");
      jsActionConsoleLog("Mobiles Endgerät erkannt", "info");
    }
  });
</script>
</div>
</main>

<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="/assets/js/plugins/sweetalert.min.js"></script>

<script src="/assets/js/plugins/dragula/dragula.min.js"></script>
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script src="/assets/js/plugins/world.js"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.6"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>

<?php
// Überprüfen, ob eine Datei hochgeladen wurde
if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
  // Definieren des Upload-Verzeichnisses
  $uploadDir = 'atns/' . $_SESSION['uid'] . '/';

  // Überprüfen, ob das Upload-Verzeichnis vorhanden ist, andernfalls erstellen
  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  // Dateiname aus dem POST-Index "atn" und dem ursprünglichen Dateinamen generieren
  $temp = explode(".", $_FILES["file"]["name"]);
  $fileName = $_POST['atn'] . '.' . end($temp);

  // Dateipfad erstellen
  $filePath = $uploadDir . $fileName;

  // Versuche, die Datei zu verschieben
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
    echo "Die Datei wurde erfolgreich hochgeladen: $filePath";
  } else {
    echo "Fehler beim Hochladen der Datei.";
  }

  $ATN = $_POST['atn'];
  $TOOL->query("UPDATE mgmt_atns SET `$ATN` = 2 WHERE UID = " . $_SESSION['uid']);
  GD_fnc_reload();
}
?>

<!-- Modal -->
<form method="post" enctype="multipart/form-data">
  <div class="modal fade" id="antUpload" tabindex="-1" role="dialog" aria-labelledby="antUploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="antUploadLabel">Neue ATN hochlanden</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="input-group input-group-static mb-4">
              <select class="customSelect" name="atn" id="exampleFormControlSelect1">
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
            <div class="input-group">
              <input type="file" name="file" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary">Hochlanden</button>
        </div>
      </div>
    </div>
  </div>
</form>