<?php
  if($USER['rank'] == 2){
?>
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addKleidungToPerson">
      <i class="fa-solid fa-plus"></i> neues Wäschestück zuweisen
    </button>
<?php
  }
?>
<table class="table align-items-center mb-0" style="width: 100%!important;" id="pooltable">
  <thead>
  <tr>
    <th class="text-secondary">ID</th>
    <th class="text-secondary">Kleidungsstück</th>
    <th class="text-secondary">Größe</th>
    <th class="text-secondary">ausgegeben am</th>
    <?php if($USER['rank'] == 2){ ?> <th class="text-secondary">Action</th> <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php
  $res = $TOOL->query("SELECT al.thumbnail, al.bezeichnung, sa.id, sa.artikelnummer, sa.groesse, sv.ausgegeben
                              FROM storage_artikelliste al
                                       JOIN DLRKA.storage_artikel sa on al.artikelnummer = sa.artikelnummer
                                       JOIN DLRKA.storage_verlauf sv on sa.mitglied = sv.mitglied AND sv.abgegeben IS NULL
                              WHERE sa.mitglied = $uid
                                AND sa.status = 1
                             ")->fetchAll(PDO::FETCH_ASSOC);

  foreach($res as $row){
    $idshort = str_replace("-", "", $row['id']);
    ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td>
        <div class="d-flex">
          <img class="w-10 ms-3" src="<?php echo $row['thumbnail']; ?>" alt="hoodie">
          <h6 class="ms-3 my-auto"><?php echo $row['bezeichnung']; ?></h6>
        </div>
      </td>
      <td class="text-center"><?php echo $row['groesse']; ?></td>
      <td class="text-center"><?php echo date('d.m.Y', strtotime($row['ausgegeben'])); ?></td>
      <?php if($USER['rank'] == 2){ ?><td>
        <a data-bs-toggle="modal" data-bs-target="#verlauf<?php echo $idshort ?>" class="badge" style="cursor: pointer">
          <i class="fa-solid fa-circle-info text-info text-2xl" data-bs-toggle="tooltip" data-bs-original-title="Details anzeigen"></i>
        </a>
        <a data-bs-toggle="modal" data-bs-target="#abgeben<?php echo $idshort; ?>" class="badge" style="cursor: pointer">
          <i class="fa-solid fa-cart-minus text-danger text-2xl" data-bs-toggle="tooltip" data-bs-original-title="Kleidungsstück zurücknehmen"></i>
        </a>
      </td><?php } ?>
    </tr>
    <?php
    include "modal_detail.php";
    include "modal_zurueck.php";
  }
  ?>
  </tbody>
</table>

<?php
if(isset($_POST['hinzufuegen'])){
  $aid      = $_POST['ausgabeid'];
  $aan      = $_POST['kleidung'];
  $groesse  = $_POST['groesse'];
  $TOOL->query("INSERT INTO storage_verlauf (id, mitglied, ausgegeben, abgegeben) values ('$aid', '$uid', NOW(), null)");
  $TOOL->query("UPDATE storage_artikel SET status = 1, mitglied = '$uid' WHERE id = '$aid'");
  $TOOL->query("DELETE FROM storage_antraege WHERE member = '$uid' AND artikel = '$aan' AND size = '$groesse'");
  GD_fnc_reload();
}
?>

<form method="post">
  <div class="modal fade" id="addKleidungToPerson" tabindex="-1" role="dialog" aria-labelledby="addKleidungToPersonLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="modal-title-notification">Neues Kleidugnsstück zuweisen</h5>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <select name="kleidung" class="customSelect" onchange="AusgabeStep2(this.value)">
              <option selected hidden style="text-align: center"># # # # # Kleidungsstück wählen # # # # #</option>
              <?php
                $res = $TOOL->query("SELECT * FROM storage_artikelliste");
                foreach ($res as $r){
              ?>
                  <option value="<?php echo $r['artikelnummer']; ?>">[<?php echo $r['artikelnummer']; ?>] <?php echo $r['bezeichnung']; ?></option>
              <?php
                }
              ?>
            </select>
          </div>
          <br>
          <div class="input-group" id="step2">

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="hinzufuegen" id="ausgabe" disabled>Ausgeben</button>
          <button type="button" class="btn btn-link text-success ml-auto" data-bs-dismiss="modal">Abbrechen</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function AusgabeStep2(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/module/management/modules/XMLHttpRequest_Ausgabe.php?an='+x, true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById("step2").innerHTML = xhr.responseText;
        } else {
          jsActionConsoleLog('Request failed: ' + xhr.status, "error");
        }
      }
    };

    xhr.send();
  }

  function AusgabeStep3(x){
    if(x != "" || x != null){
      document.getElementById('ausgabe').disabled = false;
    }
  }

  let table = new DataTable('#pooltable', {
    responsive: true
  });
</script>