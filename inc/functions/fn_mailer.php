<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/inc/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/inc/vendor/phpmailer/phpmailer/src/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/inc/vendor/phpmailer/phpmailer/src/Exception.php';
function DLR_fnc_sendMail($address, $subject, $body)
{
  $subtitle = "<hr>
            <p style='color: grey'>
              Deutsche Lebens-Rettungs-Gesellschaft<br>
              DLRG Stadtgruppe Karlsruhe e.V.<br><br>
            
              Hermann-Schneider-Allee 53<br>
              76189 Karlsruhe (Baden)<br><br>
            
              URL: <a href='https://karlsruhe.dlrg.de'>https://karlsruhe.dlrg.de</a><br><br>
            
              Rechtsform: eingetragener Verein (e.V.) Amtsgericht Karlsruhe VR 17060000<br>
              Vertretungsberechtigung gemäß § 26 BGB: Sören Schmid | Marco Voges<br>
            
            </p>
            <hr>
            <p style='text-align: center'><i style='font-size: 10pt; color: grey'>Diese E-Mail wurde durch das Management Tool der DLRG Stadtgruppe Karlsruhe automatisch generiert und versendet.<br>
            Bitte sende keine Antworten an diese E-Mail-Adresse. Alle gegebenfalls notwendige Reaktionen bitte stets per Mail an
            <a href='mailto: wrd@karlsruhe.dlrg.de'>wrd@karlsruhe.dlrg.de</a>.</i></p>";
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'dlrg-ka.de';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@dlrg-ka.de';
    $mail->Password   = 'DLRKA#112';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet   = 'UTF-8';
    $mail->Encoding  = 'base64';

    //Recipients
    $mail->setFrom('info@dlrg-ka.de', 'DLRG Karlsruhe Manager');
    $mail->addAddress($address);
    $mail->addReplyTo('wrd@karlsruhe.dlrg.de', 'DLRG Karlsruhe | Ressort Einsatz');

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body . $subtitle;

    $mail->send();
    return true;
  } catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}