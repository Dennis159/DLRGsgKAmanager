<?php
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Config_Master.php";
/**
 * Wöchentlicher Statusbericht
 * <br><br>
 * Der Statusbericht wird in der Datei "<b>weeklystatus.php</b>" generiert
 */
if(date('N') == 1) {
  $email = "dennis.lemmermeier@karlsruhe.dlrg.de";
  $subject = "Wöchtentlicher Statusbericht DLRG SG KA Manager";

  ob_start();
  include "weeklystatus.php";
  $body = ob_get_clean();

  DLR_fnc_sendMail($email, $subject, $body);
  echo "Wöchentlicher Statusbericht versendet!<br><br>";
}

/**
 * Zwischenmeldung, nur bei Bedarf, im Falle einer neuen Poolwäsche-Anfordung am Vortag
 *  <br><br>
 *  Der Bericht wird in der Datei "<b>poolmessage.php</b>" generiert
 */
$res = $TOOL->query("SELECT * FROM storage_antraege")->fetchAll(PDO::FETCH_ASSOC);
$count = 0;
foreach($res as $row){
  if(strtotime($row['request_date']) == strtotime('yesterday')){
    $count++;
  }
}

if($count > 0){
  $email   = "dennis.lemmermeier@karlsruhe.dlrg.de";
  $subject = "Neuer Poolwösche-Antrag";

  ob_start();
  include "poolmessage.php";
  $body = ob_get_clean();

  DLR_fnc_sendMail($email, $subject, $body);
  echo "Zwischenmeldung versendet!";
}