<?php
  if($_SESSION['rank'] == 1){
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
?>
<div class="container-fluid py-4">
  <style>
    td {
      min-width: 3.5em!important;
    }
  </style>
  <div class="card mt-4">
    <div class="card-header p-3">
      <h5 class="mb-0"></h5>
    </div>
    <div class="card-body p-3 pb-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-info" style="width: 12em!important;">Name</th>
            <th class="text-info" style="width: 8em!important;">[ WRF-T ] PK KA 1/91-1<br><small class="text-muted font-weight-light">KA LR 914</small></th>
            <th class="text-info" style="width: 8em!important;">[ WRF-B ] PK KA 1/93-1<br><small class="text-muted font-weight-light">KA WR 911</small></th>
            <th class="text-info" style="width: 8em!important;">[ RTB 3 ] PK KA 1/94-1<br><small class="text-muted font-weight-light">Oma Roth</small></th>
            <th class="text-info" style="width: 8em!important;">[ RTB 1 ] PK KA 1/94-2<br><small class="text-muted font-weight-light">Wüstenrot</small></th>
            <th class="text-info" style="width: 8em!important;">[ RTB 2 ] PK KA 10/94-1<br><small class="text-muted font-weight-light">Nemo (Neureut)</small></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $users = $TOOL->query("SELECT * FROM mgmt_userfiles WHERE uid != 3 ORDER BY nachname")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user){
          ?>
            <tr>
              <td><?php echo $user['vorname'] . " " . $user['nachname'] ?></td>
              <td><?php echo $user['1911_unterweisung'] != null ? "<span class='text-success'>".date('d.m.Y', strtotime($user['1911_unterweisung']))."</span>" : "<span class='text-danger'>keine</span>" ?></td>
              <td><?php echo $user['1931_unterweisung'] != null ? "<span class='text-success'>".date('d.m.Y', strtotime($user['1931_unterweisung']))."</span>" : "<span class='text-danger'>keine</span>" ?></td>
              <td>
                <?php
                  if(DLR_checkATN("511", $user['uid'], "true")) {
                    echo $user['1941_unterweisung'] != null ? "<span class='text-success'>" . date('d.m.Y', strtotime($user['1941_unterweisung'])) . "</span>" : "<span class='text-danger'>keine</span>";
                  } else {
                    echo "<small class='text-muted'>kein Bootsführer</small>";
                  }
                ?>
              </td>
              <td>
                <?php
                  if(DLR_checkATN("511", $user['uid'], "true")) {
                    echo $user['1942_unterweisung'] != null ? "<span class='text-success'>" . date('d.m.Y', strtotime($user['1942_unterweisung'])) . "</span>" : "<span class='text-danger'>keine</span>";
                  } else {
                    echo "<small class='text-muted'>kein Bootsführer</small>";
                  }
                ?>
              </td>
              <td><i class="text-muted">coming soon...</i></td>
              <td></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>