<?php if($USER['rank'] == 2){ ?>
<li class="nav-item ">
  <a class="nav-link <?php echo $page == "dashboard" ? "gg_active_element" : "text-white"; ?>" href="?dashboard">
    <i class="fa-solid fa-grid-horizontal"></i>
    <span class="nav-link-text ms-2 ps-1">Dashboard</span>
  </a>
</li>

<li class="nav-item ">
  <a class="nav-link <?php echo in_array($page, array("usermanagement", "userdetails"))  ? "gg_active_element" : "text-white"; ?>" href="?usermanagement">
    <i class="fa-solid fa-users"></i>
    <span class="nav-link-text ms-2 ps-1">Benutzerverwaltung</span>
  </a>
</li>

<li class="nav-item ">
  <a class="nav-link <?php echo in_array($page, array("poolkleidung", "poolkleidung-detail")) ? "gg_active_element" : "text-white"; ?>" href="?poolkleidung">
    <i class="fa-solid fa-shirt"></i>
    <span class="nav-link-text ms-2 ps-1">Poolkleidung</span>
  </a>
</li>

  <?php $support = array("uebungen", "atns", "einweisungen","rappenwoert"); ?>
  <a data-bs-toggle="collapse" href="#Support" class="nav-link text-white <?php echo in_array($page, $support) ? "gg_active_dropdown" : ""; ?>" aria-controls="Support" role="button" aria-expanded="false">
    <i class="fa-solid fa-list"></i>
    <span class="nav-link-text ms-2 ps-1">Listen</span>
  </a>
  <div class="collapse <?php echo in_array($page, $support) ? "show" : ""; ?>" id="Support">
    <ul class="nav ">
      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("uebungen", "")) ? "gg_active_element" : ""; ?>" href="?uebungen">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> ÜB </span>
          <span class="sidenav-normal  ms-2  ps-1"> Übungen </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("atns", "")) ? "gg_active_element" : ""; ?>" href="?ATNs">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> ATN </span>
          <span class="sidenav-normal  ms-2  ps-1"> ATN-Übersicht </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("einweisungen", "")) ? "gg_active_element" : ""; ?>" href="?Einweisungen">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> EW </span>
          <span class="sidenav-normal  ms-2  ps-1"> Einweisungen </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("rappenwoert", "")) ? "gg_active_element" : ""; ?>" href="?Rappenwoert">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> RW </span>
          <span class="sidenav-normal  ms-2  ps-1"> Rappenwört </span>
        </a>
      </li>

    </ul>
  </div>

  <?php $dienstplan = array("dienstplan-dashboard", "dienstplan-dienste"); ?>
  <a data-bs-toggle="collapse" href="#Dienstplan" class="nav-link text-white <?php echo in_array($page, $dienstplan) ? "gg_active_dropdown" : ""; ?>" aria-controls="Support" role="button" aria-expanded="false">
    <i class="fa-solid fa-list-tree"></i>
    <span class="nav-link-text ms-2 ps-1">Dienstplan</span>
  </a>
  <div class="collapse <?php echo in_array($page, $dienstplan) ? "show" : ""; ?>" id="Dienstplan">
    <ul class="nav ">
      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("dienstplan-dashboard", "")) ? "gg_active_element" : ""; ?>" href="?dienstplan-dashboard">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> DB </span>
          <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link navbar-dropdown-subelement <?php echo in_array($page, array("dienstplan-dienste", "")) ? "gg_active_element" : ""; ?>" href="?dienstplan-dienste">&nbsp;&nbsp;
          <span class="sidenav-mini-icon"> DP </span>
          <span class="sidenav-normal  ms-2  ps-1"> Dienste </span>
        </a>
      </li>

    </ul>
  </div>

<?php } ?>
