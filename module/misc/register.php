
<!--
=========================================================
* Material Dashboard 2 PRO - v3.0.6
=========================================================

* Product Page:  https://www.creative-tim.com/product/material-dashboard-pro
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
  $error = false;
  if(isset($_POST["register"])){
    $isc_user = $_POST['isc_user'];
    $vorname  = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email    = $_POST['email'];
    $telefon  = $_POST['telefon'] == "" ? NULL : $_POST['telefon'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $id = $TOOL->query("INSERT INTO mgmt_logindata (username, password) VALUES ('$isc_user', '$password')");
    $id = $TOOL->lastInsertId();
    $TOOL->query("INSERT INTO mgmt_userfiles (uid, vorname, nachname, email, telefon, isc_benutzer) VALUES ($id, '$vorname', '$nachname', '$email', '$telefon', '$isc_user')");
    $TOOL->query("INSERT INTO mgmt_atns (uid) VALUES ($id)");

    $_SESSION['valid_login'] = true;
    $_SESSION['uid']         = $id;
    $_SESSION['created_at']  = date('y-m-d H:i:s');
    $_SESSION['allowed']     = 0;
    $subject  = 'Neue Registrierung im DLRG Manager';
    $body     = "
                  Es gibt eine neue registrierung im DLRG-Manager.<br>
                  <table>
                    <tr>
                      <th style='text-align: left'>Name</th>
                      <td style='padding-left: 1em!important;'>$vorname $nachname</td>
                    </tr>
                    <tr>
                      <th style='text-align: left'>ISC-Benutzername</th>
                      <td style='padding-left: 1em!important;'>$isc_user</td>
                    </tr>
                    <tr>
                      <th style='text-align: left'>E-Mail Adresse</th>
                      <td style='padding-left: 1em!important;'>$email</td>
                    </tr>
                    <tr>
                      <th style='text-align: left'>Handynummer</th>
                      <td style='padding-left: 1em!important;'>$telefon</td>
                    </tr>
                  </table>
                 ";
    DLR_fnc_sendMail("wrd@karlsruhe.dlrg.de", $subject, $body);
  }

  if(isset($_SESSION['valid_login'])){
    header("LOCATION: /?dashboard");
  }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/icon.png">
  <link rel="icon" type="image/png" href="/assets/icon.png">
  <title>
    DLRG SG Karlsruhe | Manager
  </title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

  <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <link id="stylesheet" href="/assets/css/material-dashboard.css?v=3.0.6" rel="stylesheet" />
  <link id="stylesheet" href="/assets/custom.css" rel="stylesheet" />
</head>
<body class="bg-gray-200">

<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('/assets/bg.jpg');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="border-radius-lg py-3 pe-1 justify-content-center" style="background: #FCEC40!important;">
                <img src="/assets/logo.png" alt="GallinaGroup Logo" style="display: block; margin: auto; width: 50%;">
              </div>
            </div>
            <div class="card-body">
              <p class="text-muted text-center">
                Registriere dich, um unseren Manager zu verwenden.
              </p>
                  <h7>Mit <span class="text-danger">*</span> markierte Felder sind Pflichtfelder</h7>
                  <form role="form" class="text-start" method="post" autocomplete="off">
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">ISC-Benutzername<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="isc_user" required>
                    </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Vorname<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="vorname" required>
                    </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Nachname<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="nachname" required>
                    </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">E-Mail Adresse<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Handynummer</label>
                      <input type="tel" class="form-control" name="telefon">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Passwort<span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="password" id="password1" oninput="checkPw()" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Passwort erneut eingeben<span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="password" id="password2" oninput="checkPw()" required>
                    </div>
                    <div class="text-center">
                      <div id="notSame"></div>
                      <button type="submit" class="btn btn-dlrg-gelb w-100 my-4 mb-2" name="register" id="firstPW" disabled>Registrieren</button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-white text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              <a href="https://karlsruhe.dlrg.de" class="font-weight-bold" target="_blank">DLRG Stadtgruppe Karlsruhe e. V.</a>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://karlsruhe.dlrg.de" class="nav-link text-white-50" target="_blank">Homepage</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
</main>

<script src="../../../assets/js/core/popper.min.js"></script>
<script src="../../../assets/js/core/bootstrap.min.js"></script>
<script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    function checkPw(){
      let x = document.getElementById('password1').value;
      let y = document.getElementById('password2').value;

      if(x == y){
        document.getElementById('firstPW').disabled = false;
        document.getElementById('notSame').innerHTML = "";
      } else {
        document.getElementById('firstPW').disabled = true;
        document.getElementById('notSame').innerHTML = "<span class='text-warning'>Die Passwörter stimmen nicht überein!</span>";
      }
    }

</script>

<div style="display: none;">
  <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          document.getElementById("dark-version").click();
      });
  </script>
</div>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="../../../assets/js/material-dashboard.min.js?v=3.0.6"></script>
</body>
</html>