<div class="container-fluid py-4">
  <div class="row mb-4">

  <div class="col-lg-3 col-md-3 mb-3">
    <div class="card">
      <div class="card-body"></div>
    </div>
  </div>
  <div class="col-lg-9 col-md-9 mb-9">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-borderless" id="ant2">
          <thead>
            <tr>
              <th style="width: 1em!important;"  class="text-start">ATN</th>
              <th style="width: 15em!important;" class="text-start"></th>
              <th style="width: 3em!important;"  class="text-center">Status</th>
              <th style="width: 3em!important;"  class="text-center">Datei</th>
              <th style="width: 7em!important;"  class="text-start">Läuft ab</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $res = $TOOL->query("SELECT * FROM ants_dblist")->fetchAll(PDO::FETCH_ASSOC);
              foreach ($res as $atn) {
            ?>
            <tr>
              <td class="text-start"><?php echo $atn['id'] == "san_andere" ? "- - -" : $atn['id']; ?></td>
              <td class="text-start"><?php
                    if(is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"))){
                      echo $atn['id'] == "san_andere" ? "Höhere Qualifikation: <br>" . DLR_getSanAndere("san_andere", $_SESSION['uid']) : $atn['name_short'];
                    } else {
                      echo $atn['id'] == "san_andere" ? "Weitere med. Qualifikation: <br>" . DLR_getSanAndere("san_andere", $_SESSION['uid']) : $atn['name'];
                    }
                  ?></td>
              <td class="text-center"><?php echo DLR_checkATN($atn['id'], $_SESSION['uid']) ?></td>
              <td class="text-center"><?php echo DLR_getATNFile($atn['id'], $_SESSION['uid']) ?></td>
              <td>23.05.2025</td>
              <td><i class="fa-solid fa-pen"></i></td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  <script>
    <?php if(is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"))){ ?>
      let ant2 = new DataTable('#ant2', {
        responsive: true,
        ordering: false,
        paging: false,
        search: false
      });
    <?php } ?>
  </script>