<style>
  td, th {
    padding-left: 0.5em!important;
    padding-top: 0.3em!important;
  }
</style>

<table>
<!-- Sanitätsausbildungen -->
  <tr><th colspan="10" class="text-centery text-center text-warning" style="padding-bottom: 0.5em!important;">Sanitätsausbildungen</th></tr>
    <tr>
      <th class="wem-3">331</th>
      <td class="wem-17">Sanitätslehrgang A</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("331", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("331", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">- - -</th>
      <td class="wem-19">Sonstige Ausbildung: <?php echo DLR_getSanAndere("san_andere", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("san_andere", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("san_andere", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">332</th>
      <td class="wem-17">Sanitätslehrgang B</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("332", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("332", $uid); ?></td>
    </tr>


<!-- Rettungsschwimmscheine -->
  <tr><th colspan="10" class="text-center text-center text-warning" style="padding-top: 1em!important; padding-bottom: 0.3em!important;">Rettungsschwimmscheine</th></tr>
    <tr>
      <th class="wem-3">152</th>
      <td class="wem-17">Rettungsschwimmer Silber</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("152", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("152", $uid); ?></td>
    </tr>

<!-- Einsatzdienst / Bootswesen -->
  <tr><th colspan="10" class="text-center text-warning" style="padding-top: 1em!important; padding-bottom: 0.3em!important;">Einsatzdienst / Bootswesen</th></tr>
    <tr>
      <th class="wem-3">411</th>
      <td class="wem-17">Wasserrettungshelfer</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("411", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("411", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">511</th>
      <td class="wem-17">Bootsführerschein A</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("511", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("511", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">812</th>
      <td class="wem-17">Fachhelfer-BW</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("812", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("812", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">712</th>
      <td class="wem-17">BOS Sprechfunkzeugnis - analog -</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("712", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("712", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">710</th>
      <td class="wem-17">DLRG Betriebsfunk</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("710", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("710", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">715</th>
      <td class="wem-17">BOS Sprechfunkzeugnis - digital -</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("715", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("715", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">641</th>
      <td class="wem-17">Signalmann</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("641", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("641", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">1011</th>
      <td class="wem-17">Strömungsretter Stufe 1</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("1011", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("1011", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">431</th>
      <td class="wem-17">Wachführer</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("431", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("431", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">1028</th>
      <td class="wem-17">Strömungsretter Stufe 2</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("1028", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("1028", $uid); ?></td>
    </tr>
    <tr>
      <th class="wem-3">652</th>
      <td class="wem-17">Gruppenführer</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("652", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("652", $uid); ?></td>
      <td class="wem-3"></td>
      <th class="wem-3">613</th>
      <td class="wem-17">Einsatztaucher Stufe 2</td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_getATNFile("613", $uid); ?></td>
      <td class="wem-2 text-center pl-0"><?php echo DLR_checkATN("613", $uid); ?></td>
    </tr>
</table>
<hr>
<table>
  <tr>
    <th colspan="2">Legende</th>
  </tr>
  <tr>
    <th class="wem-2 text-center"><i class="text-danger  fa-solid fa-x"></i></th><td class="wem-22">ATN nicht vorhanden</td>
    <td class="wem-1"></td>
    <th class="wem-2 text-center"><i class="text-danger fa-solid fa-file-circle-xmark"></i></th><td class="wem-23">Kein ATN-Dokument verfügbar</td>
  </tr>
  <tr>
    <th class="wem-2 text-center"><i class="text-warning fa-solid fa-hourglass-half"></i></th><td class="wem-22">Für Lehrgang angemeldet / Laufender Lehrgang</td>
    <td class="wem-1"></td>
    <th class="wem-2 text-center"><i class="text-white fa-solid fa-file-pdf"></i></th><td class="wem-23">ATN Dokument als PDF verfügbar</td>
  </tr>
  <tr>
    <th class="wem-2 text-center"><i class="text-gallina fa-solid fa-eye"></i></i></th><td class="wem-22">ATN hochgeladen, muss überpüft werden</td>
    <td class="wem-1"></td>
    <th class="wem-2 text-center"><i class="text-white fa-solid fa-file-image"></i></th><td class="wem-23">ATN Dokument als JPG oder PNG Bild verfügbar</td>
  </tr>
  <tr>
    <th class="wem-2 text-center"><i class="text-success fa-solid fa-check"></i></th><td class="wem-22">ATN vorhanden (nicht im ISC eingetragen)</td>
  </tr>
  <tr>
    <th class="wem-2 text-center"><i class="text-success fa-solid fa-check-double"></i></th><td class="wem-22">ATN vorhanden und im ISC eingetragen</td>
  </tr>
</table>