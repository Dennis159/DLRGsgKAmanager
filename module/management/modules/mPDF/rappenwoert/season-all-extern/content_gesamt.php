<?php
session_start();
?>
<style>
  .table {
    width: 100%;
    border-collapse: collapse; /* Sorgt für ein einheitliches Erscheinungsbild der Grenzen */
  }

  /* Entfernen der Border für die Zellen */
  .table th, .table td {
    padding: 5px; /* Für etwas Abstand in den Zellen */
    text-align: left; /* Textausrichtung für die gesamte Tabelle */
    vertical-align: middle; /* Vertikale Ausrichtung der Inhalte */
    font-size: 11pt!important;
  }

  /* Alternierende Hintergrundfarbe für Zeilen */
  .table tbody tr:nth-child(odd) {
    background-color: #f9f9f9; /* Hellgrau für ungerade Zeilen */
  }

  .table tbody tr:nth-child(even) {
    background-color: #fff; /* Weiß für gerade Zeilen */
  }

  /* Stil für text-success (grüne Schrift) */
  .text-success {
    color: green;
  }

  /* Stil für text-bolder (fettgedruckter Text) */
  .text-bolder {
    font-weight: bold;
  }

  /* Optional: Stil für den Tabellenkopf (falls benötigt) */
  .table thead th {
    background-color: #f2f2f2; /* Leicht grauer Hintergrund für die Kopfzeile */
  }
</style>
<p style="border-left: 5px solid lightseagreen; padding-left: 0.5cm; font-size: 11pt">
  In diesem Dokument ist eine Gesamtübersicht über alle Einsatzkräfte, welche in der <b>Saison <?= $_GET['season'] ?></b>
  am Sanitäts- und Beckendienst in Rappenwört teilgenommen haben.<br>
  <b>Erklärung - Spalte "<i>Stunden</i>":</b><br>
  Bei der "großen" Zahl sind die Pausen der jeweiligen Dienste bereits abgezogen. Diese Zahl wird auch für die Kostenberechnung verwendet.<br>
  Die kleinere Zahl in Klammern, sind die tatsächlich anwesenden Stunden, also inklusive Pause.
</p>
<table class="table">
  <thead>
  <tr>
    <th>Einsatzkraft</th>
    <th style="width: 10em;">Anzahl Dienste</th>
    <th>Stunden</th>
    <th>Kosten</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sanA = $TOOL->query("SELECT uid, COUNT(*) AS row_count FROM list_rappenwoert WHERE YEAR(date) = $season GROUP BY uid ORDER BY row_count DESC")->fetchAll(PDO::FETCH_ASSOC);
  $c = 0;
  foreach ($sanA as $san) {
    $uid = $san['uid'];
    $hoursges       = 0;
    $hoursPges      = 0;
    $verdienstEKges = 0;
    $verdienstSGges = 0;
    $u = $TOOL->query("SELECT * FROM list_rappenwoert WHERE uid = $uid AND YEAR(date) = $season")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($u as $i){
      $hours = round((strtotime($i['end']) - strtotime($i['start'])) / 3600, 2);
      $hoursges += $hours;
      $hoursP = $hours - ($hours > 6 ? 0.5 : 0);
      $hoursPges += $hoursP;
      $verdienstEKges += $hoursP * $VERDIENST[$season]["EK"];
      $verdienstSGges += $hoursP * $VERDIENST[$season]["SG"];
    }
    ?>
    <tr>
      <td><?= GG_fnc_getUserName($uid) ?></td>
      <td><?= $san['row_count'] ?></td>
      <td><?= str_replace(".", ",", $hoursPges) . " Std." ?> <?= "<small class='text-secondary' title='Gesamtstunden ohne Pausenabzug'>(".str_replace(".", ",", $hoursges).")</small>" ?></td>
      <td><?= number_format($verdienstSGges+$verdienstEKges, 2, ',', '.') . ' €' ?></td>
    </tr>
    <?php
    $hoursgesGes += $hoursges;
    $hoursPgesGes += $hoursPges;
    $verdienstEKgesGes += $verdienstEKges;
    $verdienstSGgesGes += $verdienstSGges;
  }
  ?>
  <tr>
    <td colspan="2" class="text-success text-bolder" style="text-align: right!important;">GESAMT</td>
    <td class="text-success text-bolder"><?= str_replace(".", ",", $hoursPgesGes) ?> Std.</td>
    <td class="text-success text-bolder"><?= number_format($verdienstSGgesGes+$verdienstEKgesGes, 2, ',', '.') . ' €' ?></td>
  </tr>
  </tbody>
</table>
