<?php

  if ($USER['rank'] == 1) {
    echo "<script>window.location.href = '?userdetails&id=" . $_SESSION['uid'] . "';</script>";
  }

if(isset($_POST['thumbnail'])){
    $artikelnummer = $_POST['atn'];
    $titel         = $_POST['titel'];
    $ep            = $_POST['ep'];
    $fp            = $_POST['fp'];
    $thumbnail     = $_POST['thumbnail'];
    $groessen      = str_replace(",", ";", $_POST['groessen']);
    $groessen      = str_replace(" ", "", $groessen);
    $groessen      = explode(";", $groessen);
    $groessen      = json_encode($groessen);

    $TOOL->query("INSERT INTO storage_artikelliste (artikelnummer, bezeichnung, thumbnail, einkaufspreis, foerderung, groessen) VALUES ('$artikelnummer', '$titel', '$thumbnail', '$ep', '$fp', '$groessen')");
  }

  function DLR_getAAmount($atn) : int
  {
    return 0;
  }

  function DLR_getAStatus($atn) : string
  {
    return '<span class="badge badge-secondary"><i>coming soon</i></span>';
  }
?>
<div class="container-fluid py-4">

  <div class="card mt-4">
    <div class="card-header pt-3" style="padding-bottom: 0!important; justify-content: space-between">
      <span style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#newArticle"           class="btn btn-outline-success float-start">Hinzufügen</span>
      <span style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#bestellungAngekommen" class="btn btn-outline-success float-end">Bestellung angekommen</span>
    </div>
    <div class="card-body p-3 pb-0">
      <table class="table align-items-center mb-0" id="poolkleidung">
        <thead>
        <tr>
          <th class="text-secondary">Kleidungsstück</th>
          <th class="text-secondary">Einkaufspreis</th>
          <th class="text-secondary">Artikelnummer</th>
          <th class="text-secondary">Menge</th>
          <th class="text-secondary">Status</th>
          <th class="text-secondary">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
          $res = $TOOL->query("SELECT * FROM storage_artikelliste")->fetchAll(PDO::FETCH_ASSOC);
          foreach($res as $row){
        ?>
            <tr>
              <td>
                <div class="d-flex">
                  <img class="w-10 ms-3" src="<?php echo $row['thumbnail']; ?>" alt="hoodie">
                  <h6 class="ms-3 my-auto"><?php echo $row['bezeichnung']; ?></h6>
                </div>
              </td>
              <td><?php echo number_format($row['einkaufspreis'] - $row['foerderung'], 2, ","); ?> €</td>
              <td><?php echo $row['artikelnummer']; ?></td>
              <td><?php echo DLR_getAAmount($row['artikelnummer']); ?></td>
              <td><?php echo DLR_getAStatus($row['artikelnummer']); ?></td>
              <td>
                <a href="?poolkleidung-detail&an=<?php echo $row['artikelnummer']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Details anzeigen" class="badge">
                  <i class="fa-solid fa-folder-open text-dlrg-yellow text-2xl"></i>
                </a>
              </td>
            </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<form method="post">
  <div class="modal fade" id="newArticle" tabindex="-1" role="dialog" aria-labelledby="newArticleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="newArticleLabel">Neuer Artikel</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Artikelnummer</label>
            <input type="text" class="form-control" name="atn">
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Bezeichnung</label>
            <input type="text" class="form-control" name="titel">
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Einkaufspreis</label>
            <input type="number" class="form-control" name="ep" step="any">
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Förderung</label>
            <input type="number" class="form-control" name="fp" step="any">
          </div>
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="url" class="form-control" name="thumbnail">
          </div>
          <div class="input-group input-group-outline mb-3">
            <textarea name="groessen" class="form-control" cols="30" rows="3" placeholder="Größen, durch ; ohne Leerzeichen getrennt"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn bg-gradient-primary">speichern</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  let table = new DataTable('#poolkleidung', {
    responsive: true
  });
</script>

<?php
 include "modal_bestellungAngekommen.php";
?>