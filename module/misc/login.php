
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
  if(isset($_POST['checkLogin'])){
    if(GG_fnc_checkLoginData($_POST['username'], $_POST['password'], isset($_POST['remember']))){
      header("LOCATION: /?dashboard");
    } else {
      $error = true;
    }
  }

  if(isset($_COOKIE['DLRKA_LOGIN'])){
    $elements = json_decode($_COOKIE['DLRKA_LOGIN'], true);
    if(GG_fnc_checkLoginData($elements[0], $elements[1], "false")){
      header("LOCATION: /?dashboard");
    } else {
      $error = true;
    }
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

  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.6" rel="stylesheet" />
  <link id="pagestyle" href="/assets/custom.css" rel="stylesheet" />
</head>
<body class="bg-gray-200">

<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('/assets/bg.jpg')!important;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="border-radius-lg py-3 pe-1 justify-content-center" style="background: #ffed00!important;">
                <img src="/assets/logo.png" alt="GallinaGroup Logo" style="display: block; margin: auto; width: 75%; margin-bottom: -1.7em!important;"><br>
              </div>
            </div>
            <div class="card-body">
              <p class="text-white-50 text-center">
                Logge dich ein, um unseren Manager zu verwenden.<br>
                <?php echo $error = true ? "<b class='text-warning'>Benutzername oder Password ist falsch!</b>" : ""; ?>
              </p>
              <form role="form" class="text-start" method="post">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Nutzername</label>
                  <input type="text" class="form-control" name="username">
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Passwort</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                  <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" checked>
                  <label class="form-check-label mb-0 ms-3" for="rememberMe">Login speichern</label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-dlrg-gelb w-100 my-4 mb-2" name="checkLogin">Einloggen</button><br>
                  <a href="?register" class="link-dlrg-gelb text-xs" style="float: left">noch kein Account? Jetzt registrieren!</a>
                  <a href="?Passwort-vergessen" class="link-danger text-xs float-end" style="float: right">Passwort vergessen?</a>
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