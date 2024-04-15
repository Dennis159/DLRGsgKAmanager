<?php

  if ($_SESSION['rank'] == 1) {
    echo "<script>window.location.href = '?userdetails&id=" . $_SESSION['uid'] . "';</script>";
  }

$an = $_GET['an'];
  $PRD = $TOOL->query("SELECT * FROM storage_artikelliste WHERE artikelnummer = '$an'")->fetch();

  function DLR_getGroesseAmmount($groesse, $status): int
  {
    global $TOOL, $an;
    if($groesse == ""){
      $res = $TOOL->query("SELECT count(status) as count FROM storage_artikel WHERE artikelnummer = '$an' AND status = $status")->fetch()['count'];
    } else {
      $res = $TOOL->query("SELECT count(status) as count FROM storage_artikel WHERE artikelnummer = '$an' AND groesse = '$groesse' AND status = $status")->fetch()['count'];
    }
    return $res;
  }

  function DLR_getPoolAusgabe($member, $id): string
  {
    global $TOOL, $an;
    return $TOOL->query("SELECT ausgegeben FROM storage_verlauf WHERE id = '$id' AND mitglied = '$member'")->fetch()['ausgegeben'];
  }

  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $groesse = $_POST['groesse'];
    $TOOL->query("INSERT INTO storage_artikel (id, artikelnummer, groesse, status, mitglied, angelegt_am) VALUES ('$id', '$an', '$groesse', '0', null, NOW())");

    $antraege = $TOOL->query("SELECT * FROM storage_antraege WHERE  artikel = '$an' AND size = '$groesse' LIMIT 1")->fetch();
    if($antraege['id'] != "") {
      $aid = $antraege['id'];
      $TOOL->query("UPDATE storage_antraege SET `order` = 0 WHERE id = $aid");
    }
  }
?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-5 col-lg-6 text-center" style="padding-top: -10em!important;">
              <img src="<?php echo $PRD['thumbnail'] ?>" alt="chair" width="250" style="margin-top: 20%; transform: translateY(-20%); margin-bottom: -2em">
            </div>
            <div class="col-lg-5 mx-auto">
              <h3 class="mt-lg-0 mt-4"><?php echo $PRD['bezeichnung'] ?></h3>
              <table>
                <tr>
                  <td><h6 class="mb-0 mt-3">Einkaufspreis</h6></td>
                  <td class="ps-3"><h6 class="mb-0 mt-3">Artikelnummer</h6></td>
                  <td class="ps-3"><h6 class="mb-0 mt-3">Förderung</h6></td>
                </tr>
                <tr>
                  <td>
                    <h5 class="text-muted"><?php echo number_format($PRD['einkaufspreis'] - $PRD['foerderung'], 2, ","); ?> €
                      <?php
                        $ekp = $PRD['foerderung'] != 0 ? number_format($PRD['einkaufspreis'], 2, ",") . " € (ohne Förderung)" : "Wird nicht gefördert";
                      ?>
                      <small><i class="fa-solid fa-info-circle text-<?php echo $PRD['foerderung'] != 0 ? "success" : "danger"; ?>" data-bs-toggle="tooltip" title="<?php echo $ekp ?>"></i></small>
                    </h5>
                  </td>
                  <td class="ps-3">
                    <h5 class="text-muted"><?php echo $PRD['artikelnummer'] ?>
                      <a href="https://shop.dlrg.de/redirect_switcher?sku=<?php echo $PRD['artikelnummer'] ?>&type=product_autosuggest" target="_blank"><small><i class="fa-solid fa-shop link-dlrg-gelb" data-bs-toggle="tooltip" title="zur Materialstelle"></i></small></a>
                    </h5>
                  </td>
                  <td class="ps-3"><h5 class="text-<?php echo $PRD['foerderung'] != 0 ? "success" : "danger"; ?>"><?php echo number_format($PRD['foerderung'], 2, ","); ?> €</h5></td>
                </tr>
              </table>

              <h6 class="mb-0 mt-3">Bestände im Poolwäsche-Lager</h6>
                <?php
                $groessen = json_decode($PRD['groessen'], true);
                foreach ($groessen as $gr){
                  if(DLR_getGroesseAmmount($gr, 0) == 0){ $color = "danger"; }
                  if(DLR_getGroesseAmmount($gr, 0) == 1){ $color = "warning"; }
                  if(DLR_getGroesseAmmount($gr, 0) >= 2){ $color = "success"; }
                  ?>
                  <span class="badge badge-<?php echo $color; ?>" style="padding-top: 0.5em!important;">
                    <dlrg-lagersize><?php echo strlen($gr) == 2 ? "&nbsp;" . $gr . "&nbsp;" : $gr; ?></dlrg-lagersize><br>
                    <dlrg-lagerammount><?php echo DLR_getGroesseAmmount($gr, 0); ?></dlrg-lagerammount> <small>Stk</small>
                    </span>
                  <?php
                }
                ?>

              <h6 class="mb-0 mt-3">Bestände inklusiver ausgegebener Wäsche</h6>
                <?php
                  $groessen = json_decode($PRD['groessen'], true);
                  foreach ($groessen as $gr){
                    if((DLR_getGroesseAmmount($gr, 0) + DLR_getGroesseAmmount($gr, 1)) == 0){ $color = "danger"; }
                    if((DLR_getGroesseAmmount($gr, 0) + DLR_getGroesseAmmount($gr, 1)) == 1){ $color = "warning"; }
                    if((DLR_getGroesseAmmount($gr, 0) + DLR_getGroesseAmmount($gr, 1)) >= 2){ $color = "success"; }
                ?>
                  <span class="badge badge-<?php echo $color; ?>" style="padding-top: 0.5em!important;">
                    <dlrg-lagersize><?php echo strlen($gr) == 2 ? "&nbsp;" . $gr . "&nbsp;" : $gr; ?></dlrg-lagersize><br>
                    <dlrg-lagerammount><?php echo DLR_getGroesseAmmount($gr, 0) + DLR_getGroesseAmmount($gr, 1); ?></dlrg-lagerammount> <small>Stk</small>
                  </span>
                <?php
                  }
                ?>
            </div>
          </div>
          <div class="row">
            <hr>
            <div class="col-xl-5 col-lg-6">
              <h5 class="text-dlrg-yellow">Ausgegebene Wäsche</h5>
              <table class="table align-items-center mb-0" id="ausgegeben">
                <thead>
                  <tr>
                    <th>Wäsche-ID</th>
                    <th>Größe</th>
                    <th>Mitglied</th>
                    <th>Ausgegeben seit</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $res = $TOOL->query("SELECT * FROM storage_artikel WHERE artikelnummer = '$an' AND status = 1")->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($res as $row){
                    $idshort = str_replace("-", "", $row['id']);
                ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['groesse']; ?></td>
                      <td><?php echo GG_fnc_getUserFile($row['mitglied'])['nachname']; ?>, <?php echo GG_fnc_getUserFile($row['mitglied'])['vorname']; ?></td>
                      <td><?php echo date("d.m.Y", strtotime(DLR_getPoolAusgabe($row['mitglied'], $row['id']))) ?></td>
                      <td><i class="fa-solid fa-info-circle" data-bs-toggle="modal" data-bs-target="#verlauf<?php echo $idshort; ?>" style="cursor: pointer"></i></td>
                    </tr>
                <?php
                    include "modal_verlauf.php";
                  }
                ?>
                </tbody>
              </table>
            </div>
            <div class="col-lg-5 mx-auto">
              <h5 class="text-dlrg-yellow" style="vertical-align: middle!important;">
                Wäsche im Lager
                <a class="link-success" style="float: right; cursor: pointer" data-bs-toggle="modal" data-bs-target="#neuesWaeschestueck">
                  <i class="fa-solid fa-plus"></i> <small>neues Wäschestück</small>
                </a>
              </h5>
              <table class="table align-items-center mb-0" id="lager">
                <thead>
                  <tr>
                    <th>Wäsche-ID</th>
                    <th>Größe</th>
                    <th>angelegt am</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $res = $TOOL->query("SELECT * FROM storage_artikel WHERE artikelnummer = '$an' AND status = 0")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($res as $row){
                      $idshort = str_replace("-", "", $row['id']);
                  ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['groesse']; ?></td>
                      <td><?php echo date('d.m.Y', strtotime($row['angelegt_am'])); ?></td>
                      <td><i class="fa-solid fa-info-circle" data-bs-toggle="modal" data-bs-target="#verlauf<?php echo $idshort; ?>" style="cursor: pointer"></i></td>
                    </tr>
                  <?php
                      include "modal_verlauf.php";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<form method="post">
  <div class="modal fade" id="neuesWaeschestueck" tabindex="-1" role="dialog" aria-labelledby="neuesWaeschestueckLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="neuesWaeschestueckLabel">Neues Wäschestück</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">ID</label>
            <?php
              $anlast = $an[5] . $an[6] . $an[7];
              $number = strval((DLR_getGroesseAmmount("", 0) + DLR_getGroesseAmmount("", 1)) + 1);
              if(strlen($number) == 1){ $number = "00" . $number; }
              if(strlen($number) == 2){ $number = "0" . $number; }
              $newid  = "DLRKA-" . $anlast . "-" . $number;
            ?>
            <input type="text" class="form-control" name="id" value="<?php echo $newid ?>" readonly>
          </div>
          <div class="input-group input-group outline mb-3">
            <select name="groesse" class="customSelect">
              <option hidden selected># # # # # # Größe wählen # # # # # #</option>
              <?php
                $res = $TOOL->query("SELECT groessen FROM storage_artikelliste WHERE artikelnummer = '$an'")->fetch()['groessen'];
                $res = json_decode($res, true);
                foreach($res as $row){
              ?>
                  <option value="<?php echo $row ?>"><?php echo $row ?></option>
              <?php
                }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary">hinzufügen</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  let table = new DataTable('#ausgegeben', {
    responsive: true
  });
  let table2 = new DataTable('#lager', {
    responsive: true
  });
</script>