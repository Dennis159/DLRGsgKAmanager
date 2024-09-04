<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/Config_Master.php';

$season   = $_GET['season'];

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
                        <h3>Dienststundennachweis (INTERN)</h3>
                        <h4>Gesamtübersicht</h4>
                        <h5>Saison '.$_GET['season'].'</h5>
                    </td>
                    <td style="width: 30%; text-align: right;">
                        <img src="https://upload.wikimedia.org/wikipedia/de/2/27/DLRG_Logo.svg" style="width: 7em; margin-top: -10px;">
                    </td>
                </tr>
            </table>');

$mpdf->SetHTMLFooter('
    <div style="text-align: right; width: 100%">Seite {PAGENO} / {nbpg}</div>
    <table style="width: 100%; border-collapse: collapse;">
      <tr style="background-color: #e30613; height: 30px; border: none;">
        <th style="width: 33.33%; color: #ffed00; font-size: 1.3em; vertical-align: middle; text-align: left; padding: 0; margin: 0; border: none;">&nbsp;karlsruhe.dlrg.de</th>
        <th style="width: 33.33%; color: #ffed00; font-size: 0.8em; text-align: center; vertical-align: middle; border: none;"></th>
        <th style="width: 33.33%; text-align: right; vertical-align: middle; border: none;"><img src="/assets/SG.png" alt="" style="width: 15em; vertical-align: middle;"></th>
      </tr>
    </table>

');

$mpdf->setTitle('Rappenwört Dienststunden ' . $season . ' -  Gesamtübesicht INTERN');
$mpdf->setAuthor('DLRG Stadtgruppe Karlsruhe');



  $mpdf->AddPage('P');
  $mpdf->Bookmark('Startseite / Gesamtübersicht');
  ob_start(); // Output Buffering starten
  include('content_gesamt.php'); // Inhalt aus content_gesamt.php holen
  $html = ob_get_clean(); // Bufferinhalt holen und Buffer le
  $mpdf->WriteHTML($html);


/**
 * Seite 2 bis x - Dynamisch, Detailansicht
 */
  $res = $TOOL->query("SELECT uid, COUNT(*) AS row_count FROM list_rappenwoert WHERE YEAR(date) = $season GROUP BY uid ORDER BY row_count DESC")->fetchAll(PDO::FETCH_ASSOC);
  foreach($res as $page){
    $user = $page['uid'];
    $mpdf->SetHTMLHeader('
            <table style="width: 100%; border-bottom: 1px solid grey;">
                <tr>
                    <td style="width: 70%">
                        <h3>Dienststundennachweis (INTERN)</h3>
                        <h4>'.GG_fnc_getUserName($user).'</h4>
                        <h5>Saison '.$_GET['season'].'</h5>
                    </td>
                    <td style="width: 30%; text-align: right;">
                        <img src="https://upload.wikimedia.org/wikipedia/de/2/27/DLRG_Logo.svg" style="width: 7em; margin-top: -10px;">
                    </td>
                </tr>
            </table>');
    $mpdf->AddPage('P');
    $mpdf->Bookmark(GG_fnc_getUserName($user));
    ob_start(); // Output Buffering starten
    include('content_detail.php'); // Inhalt aus content_gesamt.php holen
    $html = ob_get_clean(); // Bufferinhalt holen und Buffer le
    $mpdf->WriteHTML($html);
  }

$fileName = "Rappenwört Dienststunden Saison $season Gesamtübersicht INTERN.pdf";
$mpdf->Output($fileName, \Mpdf\Output\Destination::DOWNLOAD); //