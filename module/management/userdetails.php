<?php
  $uid     = $_GET['id'];
  if($uid != $_SESSION['uid'] AND $_SESSION['rank'] == 1){
    $uid = $_SESSION['uid'];
    echo "<script>window.location.href = '?userdetails&id=".$_SESSION['uid']."';</script>";
  }
  $PROFILE = $TOOL->query("SELECT * FROM mgmt_userfiles WHERE uid = $uid ORDER BY `rank`, nachname, vorname")->fetch();

  if(isset($_POST['freischalten'])){
    $TOOL->query("UPDATE mgmt_userfiles SET `rank` = 1 WHERE uid = $uid");
    $TOOL->query("UPDATE mgmt_logindata SET allowed = 1 WHERE uid = $uid");
    $subject  = 'Deine Registrierung im DLRG SG Karlsruhe Manager';
    $body     = "<b>".GG_fnc_getUserFile($_SESSION['uid'])['vorname']." ".GG_fnc_getUserFile($_SESSION['uid'])['nachname']."</b> hat dein Profil im DLRG SG Karlsruhe Manager freigeschaltet.";
    echo DLR_fnc_sendMail($PROFILE['email'], $subject, $body);

    GD_fnc_reload();
  }
?>
<div class="container-fluid py-4">

  <div class="row mb-4">

    <div class="col-lg-3 col-md-3 mb-3">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center"><?php echo $PROFILE['vorname'] . " " . $PROFILE['nachname']; ?></h4>
          <p class="text-muted text-center"><?php echo GG_fnc_getRankName($PROFILE['rank']); ?></p>
          <div class="text-center" style="margin-top: -0.8em!important;">
            <span class="badge badge-<?php echo DLR_checkPermissionPool("SAN", $uid, 'anzeige'); ?>">SAN</span>
            <span class="badge badge-<?php echo DLR_checkPermissionPool("BEC", $uid, 'anzeige'); ?>">Becken</span>
            <span class="badge badge-<?php echo DLR_checkPermissionPool("WRD", $uid, 'anzeige'); ?>">WRD</span>
          </div>
        <hr>
          <ul class="list-group">
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <span style="float: right; cursor: pointer" class="text-danger" data-bs-toggle="modal" data-bs-target="#editEmail">&nbsp;<i class="fa-solid fa-pen"></i></span>
              <strong>E-Mail Adresse:</strong>
              <?php echo $PROFILE['email'] != "" ? '<a class="link-dlrg-gelb" href="mailto:'.$PROFILE['email'].'" style="float: right!important;">'.$PROFILE['email'].'</a>' : '<i class="text-muted">nicht hinterlegt</i>'; ?>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <span style="float: right; cursor: pointer" class="text-danger" data-bs-toggle="modal" data-bs-target="#editPhone">&nbsp;<i class="fa-solid fa-pen"></i></span>
              <strong>Handynummer:</strong>
              <?php echo $PROFILE['telefon'] != "" ? '<a class="link-dlrg-gelb" href="phone:'.$PROFILE['telefon'].'" style="float: right!important;">'.$PROFILE['telefon'].'</a>' : '<i class="text-muted">nicht hinterlegt</i>'; ?>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <span style="float: right; cursor: pointer" class="text-danger" data-bs-toggle="modal" data-bs-target="#editISC">&nbsp;<i class="fa-solid fa-pen"></i></span>
              <strong>ISC-Benutzer:</strong>
              <?php echo $PROFILE['isc_benutzer'] != "" ? '<span style="float: right!important;">'.$PROFILE['isc_benutzer'].'</span>' : '<i class="text-muted" style="float: right!important;">nicht hinterlegt</i>'; ?>
            </li>
          <hr>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <strong>Übungsdienste:</strong>
              <span style="float: right"><?php echo DLR_getAmmountUebungen($uid); ?></span>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <strong>Letzter Übungsdienst:</strong>
              <span style="float: right"><?php echo DLR_getLastUebung($uid); ?></span>
            </li>
          <hr>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm text-center">
              <strong class="text-muted">Unterweisungen</strong>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <strong>Letzte GUV-Unterweisung</strong>
              <span style="float: right; cursor: pointer" <?php if($USER['rank'] == 2){ ?>data-bs-toggle="modal" data-bs-target="#unterweisungGUV" <?php } ?>><?php echo DLR_getLastGUV($PROFILE['guv_unterweisung']); ?></span>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <strong>Unterweisung 1/91-1 (WRF-T)</strong>
              <span style="float: right; cursor: pointer" <?php if($USER['rank'] == 2){ ?>data-bs-toggle="modal" data-bs-target="#unterweisung1911" <?php } ?>><?php echo $PROFILE['1911_unterweisung'] != NULL ?
                                               "<span class='text-success'>" . date('d.m.Y', strtotime($PROFILE['1911_unterweisung'])) . "</span>" :
                                               "<span class='text-danger'> keine </span>"; ?></span>
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
              <strong>Unterweisung 1/93-1 (WRF-B)</strong>
              <span style="float: right; cursor: pointer" <?php if($USER['rank'] == 2){ ?> data-bs-toggle="modal" data-bs-target="#unterweisung1931" <?php } ?>><?php echo $PROFILE['1931_unterweisung'] != NULL ?
                  "<span class='text-success'>" . date('d.m.Y', strtotime($PROFILE['1931_unterweisung'])) . "</span>" :
                  "<span class='text-danger'> keine </span>"; ?></span>
            </li>
            <?php
              if(DLR_checkATN("511", $uid, true)){
            ?>
                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                  <strong>Unterweisung 1/94-1 (Oma Roth)</strong>
                  <span style="float: right; cursor: pointer" <?php if($USER['rank'] == 2){ ?> data-bs-toggle="modal" data-bs-target="#unterweisung1941" <?php } ?>><?php echo $PROFILE['1941_unterweisung'] != NULL ?
                      "<span class='text-success'>" . date('d.m.Y', strtotime($PROFILE['1941_unterweisung'])) . "</span>" :
                      "<span class='text-danger'> keine </span>"; ?></span>
                </li>

                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                  <strong>Unterweisung 1/94-2 (Wüstenrot)</strong>
                  <span style="float: right; cursor: pointer" <?php if($USER['rank'] == 2){ ?> data-bs-toggle="modal" data-bs-target="#unterweisung1942" <?php } ?>><?php echo $PROFILE['1942_unterweisung'] != NULL ?
                      "<span class='text-success'>" . date('d.m.Y', strtotime($PROFILE['1942_unterweisung'])) . "</span>" :
                      "<span class='text-danger'> keine </span>"; ?></span>
                </li>
            <?php } ?>
          </ul>
       <?php if($PROFILE['rank'] == 0){ ?>
         <hr>
         <div class="row text-center">
           <form method="post">
             <button type="submit" class="btn btn-success btn-block" name="freischalten" style="margin-bottom: -2em">Benutzer freischalten</button>
           </form>
         </div>
       <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 mb-9">
      <div class="card">
        <div class="card-body">

          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill nav-pills-vertical" role="tablist" style="background: transparent!important;">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#atn" role="tab" aria-controls="atn" aria-selected="true">
                  Ausbildungs- und Tätigkeitennachweise
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#pool" role="tab" aria-controls="pool" aria-selected="false">
                  Poolwäsche
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#antraege" role="tab" aria-controls="antraege" aria-selected="false">
                  Anträge
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#uebungen" role="tab" aria-controls="antraege" aria-selected="false">
                  Übungsdienste
                </a>
              </li>
            </ul>
          </div>

          <br>

          <div class="tab-content">
            <div class="tab-pane active" id="atn">
              <?php if($USER['rank'] == 2){ ?><a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#atnEdit"><i class="fa-solid fa-pen-to-square"></i> ATN bearbeiten</a><?php } ?>
              <a class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#antUpload"><i class="fa-solid fa-upload"></i> ATN hochladen</a>
              <?php
                include "modules/modal_atn.php";
                include is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")) ? "modules/tab_atn_mobile.php" : "modules/tab_atn_computer.php";
              ?>
            </div>
            <div class="tab-pane" id="pool">
              <?php
                include "modules/tab_pool.php";
              ?>
            </div>
            <div class="tab-pane" id="antraege">
              <?php
                include "modules/tab_antraege.php";
              ?>
            </div>
            <div class="tab-pane" id="uebungen">
              <table>
                <?php
                  $events = $TOOL->query("SELECT * FROM list_uebungen")->fetchAll(PDO::FETCH_ASSOC);
                  $count = 0;
                foreach ($events as $event) {
                  $members = json_decode($event['members'], true);
                  if(in_array($uid, $members)){
                    $count = $count + 1;
                    $name = str_replace("-<br>", " ", $event['name']);
                    echo "<tr>
                            <th class='text-info col'>".date('d.m.Y', strtotime($event['date']))."</th>
                            <td class='text-white col'>".str_replace("<br>", " / ", $name)."</td>
                          </tr>";
                  }
                }
                if($count == 0){
                  echo '<p class="h7 text-center"><i>';
                  echo $uid == $_SESSION['uid'] ? "Du hast noch an keinen Übungsdiensten teilgenommen" : "Das Mitglied hat noch an keinen Übungsdiensten teilgenommen";
                  echo '</i></p>';
                }
                ?>
              </table>
            </div>
          </div>

        </div>
        </div>
      </div>
    </div>

  </div>

</div>
<?php
  include "modules/modal_unterweisungen.php";
  include "modules/modal_persdaten.php";