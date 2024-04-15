
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
session_unset();
session_destroy();
setcookie("DLRKA_LOGIN", '', time() - 3600, '/');
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

  <link id="pagestyle" href="../../../assets/css/material-dashboard.css?v=3.0.6" rel="stylesheet" />
</head>
<body class="error-page">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://www.simmerath.de/news/2023/okt/sperrung-im-schilsbachtal/sperrung-schilsbachstrasse.jpg?cid=g9v.1dxm');">

    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-12 m-auto text-center">
          <h1 class="display-1 text-bolder text-danger">Warte auf Freischaltung!</h1>
          <h2 class="text-white">Du wurdest für die Nutzung des <span class="text-warning">DLRG SG Karlsruhe Manager</span> gesperrt!</h2> <!-- [Aller Tools / des Admin Panels / des User-Panels] -->
          <p class="lead text-white">Falls du dich gerade erst registriert hast, musst du warten bis die Ressortleitung "Einsatz" dich freischaltet.</p> <!-- [im Support / bei einem Administrator / bei einem Projektleiter] -->
          <i class="text-xs text-white opacity-8">Du wurdest automatisch ausgeloggt. Falls du einen Cookie zum speichern der Login-Daten hattest, wurde dieser automatisch gelöscht!</i><br>
          <a href="?login" class="btn btn-outline-white mt-4">zurück zur Loginseite</a>
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
              <a href="https://karlsruhe.dlrg.de" class="font-weight-bold text-white" target="_blank">DLRG Stadtgruppe Karlsruhe e. V.</a>
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

<script src="../../../assets/js/plugins/dragula/dragula.min.js"></script>
<script src="../../../assets/js/plugins/jkanban/jkanban.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="../../../assets/js/material-dashboard.min.js?v=3.0.6"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"82d4c6502a913a9a","version":"2023.10.0","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>
</html>