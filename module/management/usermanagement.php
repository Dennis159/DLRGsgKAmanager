<?php
  if($_SESSION['rank'] == 1){
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
?>
<div class="container-fluid py-4">

  <div class="card mt-4">
    <div class="card-header p-3">
      <a href="?userdetails&id=3" class="btn btn-outline-secondary float-end" style="margin-bottom: -2em!important;">Max Mustermann</a>
    </div>
    <div class="card-body p-3 pb-0">
      <div class="table-responsive">
        <table class="table align-items-center mb-0" id="usermanagement">
          <thead>
          <tr>
            <th class="text-secondary" style="width: 1em">#ID</th>
            <th class="text-secondary">Name</th>
            <th class="text-secondary">Status</th>
            <th class="text-secondary">ISC-Benutzername</th>
            <th class="text-secondary">E-Mail Adresse</th>
            <th class="text-secondary">Handynummer</th>
            <th class="text-muted">Einsetzbar</th>
            <th class="text-secondary"></th>
          </tr>
          </thead>
          <tbody>
          <?php
            $result = $TOOL->query("SELECT * FROM mgmt_userfiles")->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
              if($row['uid'] != 3){
          ?>
            <tr>
              <td style="width: 1em">#<?php echo $row['uid'] ?></td>
              <td><?php echo $row['nachname'] . ", " . $row['vorname']; ?></td>
              <td><?php echo GG_fnc_getRankName($row['rank']) ?></td>
              <td><?php echo $row['isc_benutzer']; ?></td>
              <td><?php echo $row['email'] == "" ? "<i class='text-muted'>keine E-Mail hinterlegt</i>" : "<a href='mailto:".$row['email']."'>".$row['email']."</a>" ?></td>
              <td><?php echo $row['telefon'] == "" ? "<i class='text-muted'>keine Handynummer hinterlegt</i>" : "<a href='tel:".$row['telefon']."'>".$row['telefon']."</a>" ?></td>
              <td>
                <span class="badge badge-<?php echo DLR_checkPermissionPool("SAN", $row['uid'], 'anzeige'); ?>">SAN</span>
                <span class="badge badge-<?php echo DLR_checkPermissionPool("BEC", $row['uid'], 'anzeige'); ?>">Becken</span>
                <span class="badge badge-<?php echo DLR_checkPermissionPool("WRD", $row['uid'], 'anzeige'); ?>">WRD</span>
              </td>
              <td>
                <a href="?userdetails&id=<?php echo $row['uid']; ?>" class="btn btn-outline-info">Akte</a>
              </td>
            </tr>
          <?php
            }}
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  let table = new DataTable('#usermanagement', {
    responsive: true
  });
</script>