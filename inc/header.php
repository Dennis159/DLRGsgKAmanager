<?php
  if(!isset($_SESSION['valid_login'])){
    header("LOCATION: ?login");
  }
  if($_SESSION['allowed'] == 0 AND isset($_SESSION['valid_login'])){
    header("LOCATION: ?not-allowed");
  }
  $USER = GG_fnc_getUserFile($_SESSION['uid']);
?>

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
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/83ac655303.js" crossorigin="anonymous"></script>
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.6" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link href="/assets/custom.css" rel="stylesheet" />
  <link href="/assets/checkboxen.css" rel="stylesheet" />
</head>
<body class="g-sidenav-show dark-version" style="background-color: #1A2035!important;">

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 dlrg-background-transparent" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="" target="_blank">
      <img src="/assets/icon.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">Stadtgruppen Manager</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item mb-2 mt-0">
        <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link" aria-controls="ProfileNav" role="button"
           aria-expanded="<?php echo ($page == "userdetails" AND $_GET['id'] == $USER['uid']) ? "true" : "false"; ?>">
          <img src="/assets/icon.png" class="avatar">
          <span class="nav-link-text ms-2 ps-1"><?php echo $USER['vorname'] . " " . $USER['nachname']; ?></span>
        </a>
        <div class="collapse <?php echo ($page == "userdetails" AND $_GET['id'] == $USER['uid']) ? "show" : ""; ?>" id="ProfileNav">
          <ul class="nav ">
            <li class="nav-item">
              <a class="nav-link <?php echo ($page == "userdetails" AND $_GET['id'] == $USER['uid']) ? "gg_active_element" : "text-white"; ?>" href="?userdetails&id=<?php echo $_SESSION['uid'] ?>">
                <span class="sidenav-mini-icon"> MP </span>
                <span class="sidenav-normal  ms-3  ps-1"> Mein Profil </span>
              </a>
            </li>
            <li class="nav-item" style="cursor: pointer">
              <a class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#logout">
                <i class="fa-solid fa-power-off text-danger"></i>
                <span class="sidenav-normal  ms-3  ps-1"> Ausloggen </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <hr class="horizontal light mt-0">
      <li class="nav-item">

      <?php
          include "headers/navbar.php";
      ?>

      </li>
    </ul>
  </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky dlrg-background-transparent" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3" id="navigationbar">
      <nav aria-label="breadcrumb">

        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
          <a href="javascript:;" class="nav-link text-body p-0">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </div>

        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm opacity-5"><i class="fa-solid fa-house"></i></li>
          <?php if($PAGE_bc1 != ""){ ?><li class="breadcrumb-item text-sm <?php echo $PAGE_bc2 == "" ? "text-bold" : "opacity-5"; ?>"><?php echo $PAGE_bc1; ?></li> <?php } ?>
          <?php if($PAGE_bc2 != ""){ ?><li class="breadcrumb-item text-sm <?php echo $PAGE_bc3 == "" ? "text-bold" : "opacity-5"; ?>"><?php echo $PAGE_bc2; ?></li> <?php } ?>
          <?php if($PAGE_bc3 != ""){ ?><li class="breadcrumb-item text-sm <?php echo $PAGE_bc4 == "" ? "text-bold" : "opacity-5"; ?>"><?php echo $PAGE_bc3; ?></li> <?php } ?>
          <?php if($PAGE_bc4 != ""){ ?><li class="breadcrumb-item text-sm text-dark text-bold"><?php echo $PAGE_bc4; ?></li>                                        <?php } ?>
        </ol>
        <h6 class="font-weight-bolder mb-0"><?php echo $PAGE_pagtitle ?></h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <?php
         include "headers/header.php";
        ?>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-dark" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title font-weight-normal" id="modal-title-notification">Möchtest du dich wirklich ausloggen?</h6>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-danger">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="py-3 text-center">
            <h1><i class="fa-solid fa-power-off text-danger"></i></h1>
            <p>
              Möchtest du dich wirklich aus unseren Panels ausloggen?<br>
              <small class="text-muted">Du kannst dich natürlich jederzeit wieder durch Verwendung deines Benutzernamen und Passwort einloggen.</small>
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <a href="?logout" class="btn btn-success">Ja, ausloggen</a>
          <button type="button" class="btn btn-link text-danger ml-auto" data-bs-dismiss="modal">Abbrechen</button>
        </div>
      </div>
    </div>
  </div>