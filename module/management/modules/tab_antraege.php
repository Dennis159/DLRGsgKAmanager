<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#beantrageKleidung">
  <i class="fa-solid fa-plus"></i> neues Wäschestück beantragen
</button>
<table class="table align-items-center mb-0" style="width: 100%!important;" id="tableAntrag">
  <thead>
  <tr>
    <th class="text-secondary">Kleidungsstück</th>
    <th class="text-secondary">Größe</th>
    <th class="text-secondary">beantragt am</th>
    <th class="text-secondary">bestellung</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $res = $TOOL->query("SELECT al.thumbnail, al.bezeichnung, sa.id, sa.artikel, sa.size, sa.request_date, sa.`order`, sa.order_date, sa.ordercomplete, sa.member
                              FROM storage_artikelliste al
                                       JOIN DLRKA.storage_antraege sa on al.artikelnummer = sa.artikel
                              WHERE sa.member = $uid
                             ")->fetchAll(PDO::FETCH_ASSOC);

  foreach($res as $row){
    $modal = false;
    ?>
    <tr>
      <td>
        <div class="d-flex">
          <img class="w-10 ms-3" src="<?php echo $row['thumbnail']; ?>" alt="hoodie">
          <h6 class="ms-3 my-auto"><span class="text-lighter">[<?php echo $row['artikel']; ?>]</span> <?php echo $row['bezeichnung']; ?></h6>
        </div>
      </td>
      <td class="text-center"><?php echo $row['size']; ?></td>
      <td class="text-center"><?php echo date('d.m.Y', strtotime($row['request_date'])); ?></td>
      <td>
          <?php
          if($row['order'] == 1 AND $row['order_date'] == NULL){
            if($USER['rank'] == 2){
              echo "<span class='badge badge-danger' style='cursor: pointer' data-bs-toggle='modal' data-bs-target='#bestellen".$row['id']."'>Bestellung notwendig</span>";
            } else {
              echo "<span class='badge badge-danger'>Bestellung notwendig</span>";
            }
          }
          if($row['order'] == 1 AND $row['order_date'] != NULL AND $row['ordercomplete'] != 1){
            echo "<span class='badge badge-warning'>Bestellung ausgelöst</span>";
            $modal = true;
          }
          if($row['order'] == 0){
            echo "<span class='badge badge-success'>im Lager</span>";
          }
          if($row['ordercomplete'] == 1 AND $row['order'] == 1){
            echo "<span class='badge badge-success'>Bestellung geliefert</span>";
          }
          ?>
      </td>
    </tr>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/module/modal_bestellung.php";
  }
  ?>
  </tbody>
</table>

<?php
  if(isset($_POST['beantragen'])){
    $gro      = $_POST['groesse'];
    $aan      = $_POST['kleidung'];
    $vorname  = $PROFILE['vorname'];
    $nachname = $PROFILE['nachname'];
    $kleidung = DLR_getArtikelDaten($aan)['bezeichnung'];
    $order    = DLR_getBestand($aan, $gro) == 0 ? 1 : 0;
    $status   = $order == 0 ? "<span style='color: green'>im Lager</span>" : "<span style='color: red'>Bestellung notwendig</span>";
    $TOOL->query("INSERT INTO storage_antraege (artikel, size, member, request_date, `order`) VALUES ('$aan', '$gro', '$uid', NOW(), $order)");
    GD_fnc_reload();
  }
?>

<form method="post">
  <div class="modal fade" id="beantrageKleidung" tabindex="-1" role="dialog" aria-labelledby="beantrageKleidungLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="modal-title-notification">Neues Kleidugnsstück beantragen</h5>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <select name="kleidung" class="customSelect" onchange="AntragStep2(this.value)">
              <option selected hidden style="text-align: center"># # # # # Kleidungsstück wählen # # # # #</option>
              <?php
                $SAN = DLR_checkPermissionPool("SAN", $uid, 'bool') ? "SAN" : "";
                $BEC = DLR_checkPermissionPool("BEC", $uid, 'bool') ? "BEC" : "";
                $WRD = DLR_checkPermissionPool("WRD", $uid, 'bool') ? "WRD" : "";
                $permissions_json = json_encode([$SAN, $BEC, $WRD]);

                // Baue die Abfrage dynamisch basierend auf den Elementen im $permissions-Array
                if($SAN == "" AND $BEC == "" AND $WRD == "") {
                  $query = "SELECT * FROM storage_artikelliste WHERE allowed = 'noperms'";
                } else {
                  $query = "SELECT * FROM storage_artikelliste WHERE ";
                }

                $conditions = [];
                foreach ([$SAN, $BEC, $WRD] as $permission) {
                  if (!empty($permission)) {
                    $conditions[] = "allowed LIKE '%".$permission."%'";
                  }
                }

                $query .= implode(" OR ", $conditions);
                $query .= " ORDER BY artikelnummer";
                // Führe die Abfrage aus
                $res = $TOOL->query($query)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($res as $r){
                  ?>
                  <option value="<?php echo $r['artikelnummer']; ?>">[<?php echo $r['artikelnummer']; ?>] <?php echo $r['bezeichnung']; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <br>
          <div class="input-group" id="AntragStep2">

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="beantragen" id="ausgabeAntrag" disabled>Beantragen</button>
          <button type="button" class="btn btn-link text-success ml-auto" data-bs-dismiss="modal">Abbrechen</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  function AntragStep2(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/module/management/modules/XMLHttpRequest_Antrag.php?an='+x, true);

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById("AntragStep2").innerHTML = xhr.responseText;
          console.log(xhr.responseText);
        } else {
          jsActionConsoleLog('Request failed: ' + xhr.status, "error");
        }
      }
    };

    xhr.send();
  }

  function AntragStep3(x){
    if(x != "" || x != null){
      document.getElementById('ausgabeAntrag').disabled = false;
    }
  }

  let tableAntrag = new DataTable('#tableAntrag', {
    responsive: true
  });
</script>
