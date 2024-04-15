<style>
  td, th {
    vertical-align: middle!important;
    text-align: left!important;
    padding-left: 1em!important;
  }
  th {
    color: grey!important;
  }
  table {
    margin-left: -1em!important;
  }
  .badge-success {
    color: #339537;
    background-color: #bce2be;
  }
  .badge-danger {
    color: #f61200;
    background-color: #fcd3d0;
  }
  .badge-secondary {
    color: #575f8b;
    background-color: #d7d9e1;
  }
  .badge-warning {
    color: #c87000;
    background-color: #ffd59f;
  }
  .badge {
    padding: 0.55em 0.9em 0.55em 0.9em;
    font-size: 0.75em;
    font-weight: 700;
    border-radius: 0.45rem;
    display: inline-block;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
  }

  .text-muted {
    color: #6c757d !important;
  }
</style>
<p style="text-align: center">
  <b style="font-size: 16pt; color: #0069b4;">Information: Neue(r) Polwäsche Antrag / Anträge</b><br>
  <span style="font-size: 8pt;" class="text-muted"><?php echo date('d.m.Y H:i') ?> Uhr</span>
</p>

<table class='table table-striped'>
  <tr>
    <th>Name</th>
    <th>Artikelnummer</th>
    <th>Bezeichnung</th>
    <th>Größe</th>
    <th>Anforderungzeitpunkt</th>
    <th>Status</th>
  </tr>
  <?php
  $res = $TOOL->query("SELECT * FROM storage_antraege ORDER BY request_date DESC, `order` DESC")->fetchAll(PDO::FETCH_ASSOC);
  foreach($res as $row){
    $new = (strtotime($row['request_date']) == strtotime('yesterday'));
  ?>
    <tr>
      <td><?php echo GG_fnc_getUserFile($row['member'])['vorname'] ?> <?php echo GG_fnc_getUserFile($row['member'])['nachname'] ?></td>
      <td><?php echo $row['artikel'] ?></td>
      <td><?php echo DLR_getArtikelDaten($row['artikel'])['bezeichnung'] ?></td>
      <td><span class='badge badge-secondary'><?php echo $row['size'] ?></span></td>
      <td><?php echo date('d.m.Y', strtotime($row['request_date'])) ?></td>
      <td>
        <?php
        if($row['order'] == 1 AND $row['order_date'] == NULL){
          echo "<span class='badge badge-danger'>Bestellung notwendig</span>";
        }
        if($row['order'] == 1 AND $row['order_date'] != NULL AND $row['ordercomplete'] != 1){
          echo "<span class='badge badge-warning'>Bestellung ausgelöst</span>";
        }
        if($row['order'] == 0){
          echo "<span class='badge badge-success'>im Lager</span>";
        }
        if($row['ordercomplete'] == 1 AND $row['order'] == 1){
          echo "<span class='badge badge-success'>Bestellung geliefert</span>";
        }
        if($new){
          echo "&nbsp;<span class='badge badge-success'>Neu</span>";
        }
        ?>
      </td>
    </tr>
    <?php
  }
  ?>
</table>