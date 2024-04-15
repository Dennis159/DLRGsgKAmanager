<?php
/**
 * Predefine
 */
  session_start();
  date_default_timezone_set('Europe/Berlin');
  include "config/Config_PreDefine.php";
  include "config/Config_Filepaths.php";

/**
 * Datenbankverbindung
 */
  try {
    $TOOL = new PDO('mysql:host=localhost:3306;dbname=DLRKA', 'dlrgka', 'CHX45Europa5');
    phpActionJSLog("Datenbankverbindung erfolgreich!", "success");
  } catch (PDOException $e) {
    phpActionJSLog("Datenbankverbindung fehlgeschlagen!", "error");
    phpActionJSLog(str_replace('\'', "\"", "SQL-Fehlermeldung: " .  $e->getMessage()), "warning");
  }

/**
 * Inkludiere alle Dateien aus dem Functions Ordner
 */
  include "functions/fn_login.php";
  include "functions/fn_namefinder.php";
  include "functions/fn_misc.php";
  include "functions/fn_mailer.php";

