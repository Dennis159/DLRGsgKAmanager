<div class="container-fluid py-4 text-center">

  <style>
    a:hover {
      text-decoration: underline;
    }
  </style>

  <h2 style="color: orangered!important;">Fehler 404</h2>
  <p>
    Die seite " <?php echo $_GET['e'] ?> " konnte nicht gefunden werden.
    <br>

    Falls du hier über einen Link gelandet bist, dann melde dies bitte dem Webtechniker über dieses Formular:<br>
    <button class="btn btn-outline-light">Fehlermeldung (Verlinkung)</button>

    <br><br>
    <a href="?dashboard" style="color: #0dcaf0!important;">zurück zum Dashboard</a>
    &nbsp; | &nbsp;
    <a href="javascript:history.back()" style="color: #0dcaf0!important;">zurück zur vorherigen Seite</a>

    <br><br>
    <?php var_dump($_SESSION); ?>
  </p>

</div>