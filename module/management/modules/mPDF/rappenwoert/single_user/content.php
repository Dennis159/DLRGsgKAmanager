<?php
session_start();
$res  = $TOOL->query("SELECT * FROM list_rappenwoert WHERE date LIKE '$season%' AND uid = '$user' ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);
$USER = GG_fnc_getUserFile($_SESSION['uid']);
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
    font-size: 10.5pt!important;
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
<table class="table">
  <thead>
  <tr>
    <th></th>
    <th>Datum</th>
    <th>Beginn</th>
    <th>Ende</th>
    <th style="padding-left: 8px; width: 1em">Art</th>
    <th>Stunden</th>
    <?php if($USER['rank'] == 2){ ?>
      <th>Verdienst (EK)</th>
      <th>Verdienst (SG)</th>
    <?php } else { ?>
      <th>Verdienst</th>
    <?php } ?>
  </tr>
  </thead>
  <tbody>
  <?php $c = 0; foreach ($res as $dienst){ ?>
    <tr>
      <td><?php $c++; echo "#".$c; ?></td>
      <td><?= date('d.m.Y', strtotime($dienst['date'])); ?></td>
      <td><?= date('H:i', strtotime($dienst['start'])); ?> Uhr</td>
      <td><?= date('H:i', strtotime($dienst['end'])); ?> Uhr</td>
      <td style="text-align: center"><?= $dienst['type']; ?></td>
      <td><?php
        $hours = (strtotime($dienst['end']) - strtotime($dienst['start'])) / 3600;
        $hoursges += $hours;
        $hoursP = ($hours > 6) ? $hours - 0.5 : $hours;
        $hoursPges += $hoursP;
        echo str_replace(".", ",", $hoursP) . " Std.";
        echo " <small>(".str_replace(".", ",", $hours).")</small>";
        $verdienstEK    = $hoursP * $VERDIENST[$season]["EK"];
        $verdienstSG    = $hoursP * $VERDIENST[$season]["SG"];
        $verdienstEKges += $verdienstEK;
        $verdienstSGges += $verdienstSG;
        ?></td>
      <?php if($USER['rank'] == 2){ ?>
        <td><?= number_format($verdienstEK, 2, ",", "."); ?> €</td>
        <td><?= number_format($verdienstSG, 2, ",", "."); ?> €</td>
      <?php } else { ?>
        <td><?= number_format($verdienstEK, 2, ",", "."); ?> €</td>
      <?php } ?>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="5" class="text-success text-bolder" style="text-align: right!important;">GESAMT</td>
    <td class="text-success text-bolder"><?php
      echo str_replace(".", ",", $hoursPges) . " Std.";
      echo " <small>(".str_replace(".", ",", $hoursges).")</small>";?>
    </td>
    <?php if($USER['rank'] == 2){ ?>
      <td class="text-success text-bolder"><?= number_format($verdienstEKges, 2, ',', '.') . ' €' ?></td>
      <td class="text-success text-bolder"><?= number_format($verdienstSGges, 2, ',', '.') . ' €' ?></td>
    <?php } else { ?>
      <td class="text-success text-bolder"><?= number_format($verdienstEKges, 2, ',', '.') . ' €' ?></td>
    <?php } ?>
  </tr>
  </tbody>
</table>
