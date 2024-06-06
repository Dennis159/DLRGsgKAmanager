<?php
$PATHS = array();

/**
 * @Titel Sonstige Seiten
 * @Pfad module/misc/*.php
 */
$PATHS["login"]       = array("module/misc/login.php", "", "", "", "", "", 0);
$PATHS["register"]    = array("module/misc/register.php", "", "", "", "", "", 0);
$PATHS["not-allowed"] = array("module/misc/not-allowed.php", "Not-Allowed", "", "", "", "Not-Allowed", 0);
$PATHS["debug"]       = array("module/misc/debug.php", "Debug", "", "", "", "Debug", 2);
$PATHS["404"]         = array("module/misc/404.php", "Feheler 404", "", "", "", "Feher 404 - Seite nicht gefunden!", 0);
$PATHS["dashboard"]   = array("module/dashboard.php", "Dashboard", "", "", "", "Dashboard", 1);
$PATHS["passwort-vergessen"]   = array("module/misc/password_vergessen.php", "", "", "", "", "", 0);

/**
 * @Titel Benutzerverwaltung
 * @Pfad module/management/*.php
 */
$PATHS["usermanagement"] = array("module/management/usermanagement.php", "Benutzerverwaltung", "", "", "", "Benutzerverwaltung", 2);
$PATHS["userdetails"]    = array("module/management/userdetails.php",    "Benutzerverwaltung", "Benutzer", "", "", "Benutzer Details", 1);

/**
 * @Titel Poolkleidung
 * @Pfad module/storage/*.php
 */
$PATHS["poolkleidung"] = array("module/storage/poolkleidung.php", "Poolkleidung", "", "", "", "Poolkleidung Liste", 2);
$PATHS["poolkleidung-detail"] = array("module/storage/poolkleidungdetail.php", "Poolkleidung", "", "", "", "Poolkleidung Details", 2);

/**
 * @Titel Listen
 * @Pfad module/listen/*.php
 */
$PATHS["uebungen"] = array("module/listen/uebungen.php", "Listen", "Übungsdienste", "", "", "Übungsdienste Liste", 2);
$PATHS["atns"] = array("module/listen/atns.php", "Listen", "Ausbildungsnachweise", "", "", "Ausbildungsnachweise Übersicht", 2);
$PATHS["einweisungen"] = array("module/listen/einweisungen.php", "Listen", "Einweisugnen", "", "", "Einweisugnen Übersicht", 2);