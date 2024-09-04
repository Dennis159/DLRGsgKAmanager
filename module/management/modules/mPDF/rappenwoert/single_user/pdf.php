<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/Config_Master.php';

$season   = $_GET['season'];
$user     = $_GET['user'];
$userfile = GG_fnc_getUserFile($user);

$mpdf = new \Mpdf\Mpdf([
  'margin_top' => 35,    // Abstand vom oberen Rand zum Header
  'margin_bottom' => 15, // Abstand vom unteren Rand zum Footer
  'margin_left' => 15,   // Linke Seitenmarge
  'margin_right' => 15,  // Rechte Seitenmarge
  'default_font' => 'Arial'
]);

$mpdf->SetHTMLHeader('
            <table style="width: 100%; border-bottom: 1px solid grey;">
                <tr>
                    <td style="width: 70%">
                        <h3>Dienststundennachweis</h3>
                        <h4>'.$userfile['vorname'].' '.$userfile['nachname'].'</h4>
                        <h5>Saison '.$_GET['season'].'</h5>
                    </td>
                    <td style="width: 30%; text-align: right;">
                        <img src="https://upload.wikimedia.org/wikipedia/de/2/27/DLRG_Logo.svg" style="width: 7em; margin-top: -10px;">
                    </td>
                </tr>
            </table>');

$mpdf->SetHTMLFooter('
    <table style="width: 100%; border-collapse: collapse;">
      <tr style="background-color: #e30613; height: 30px; border: none;">
        <th style="width: 33.33%; color: #ffed00; font-size: 1.3em; vertical-align: middle; text-align: left; padding: 0; margin: 0; border: none;">karlsruhe.dlrg.de</th>
        <th style="width: 33.33%; color: #ffed00; font-size: 0.8em; text-align: center; vertical-align: middle; border: none;">{PAGENO} / {nbpg}</th>
        <th style="width: 33.33%; text-align: right; vertical-align: middle; border: none;"><img src="/assets/SG.png" alt="" style="width: 15em; vertical-align: middle;"></th>
      </tr>
    </table>

');

$mpdf->setTitle('Rappenwört Dienststunden ' . $season . ' - ' . $userfile['vorname'] . ' ' . $userfile['nachname']);
$mpdf->setAuthor('DLRG Stadtgruppe Karlsruhe');



//$mpdf->Bookmark('Start of the document');
$mpdf->AddPage('P');
ob_start(); // Output Buffering starten
include('content.php'); // Inhalt aus content_gesamt.php holen
$html = ob_get_clean(); // Bufferinhalt holen und Buffer le
$mpdf->WriteHTML($html);

$fileName = "Rappenwört Dienststunden Saison $season " . $userfile['vorname'] . " " . $userfile['nachname'].".pdf";
$mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD);