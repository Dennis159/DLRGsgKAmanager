<?php
$PATHS = array();

/**
 * @Titel Sonstige Seiten
 * @Pfad module/misc/*.php
 */
$PATHS["login"]       = array("module/misc/login.php", "", "", "", "", "");
$PATHS["register"]    = array("module/misc/register.php", "", "", "", "", "");
$PATHS["not-allowed"] = array("module/misc/not-allowed.php", "Not-Allowed", "", "", "", "Not-Allowed");
$PATHS["debug"]       = array("module/misc/debug.php", "Debug", "", "", "", "Debug");
$PATHS["404"]         = array("module/misc/404.php", "Feheler 404", "", "", "", "Feher 404 - Seite nicht gefunden!");
$PATHS["dashboard"]   = array("module/dashboard.php", "Dashboard", "", "", "", "Dashboard");
$PATHS["passwort-vergessen"] = array("module/misc/password_vergessen.php", "", "", "", "", "");

$PATHS["atn2_0"]   = array("module/misc/atn2-0.php", "Developement", "ATN System 2.0", "", "", "ATN System 2.0");

/**
 * @Titel Benutzerverwaltung
 * @Pfad module/management/*.php
 */
$PATHS["usermanagement"] = array("module/management/usermanagement.php", "Benutzerverwaltung", "", "", "", "Benutzerverwaltung");
$PATHS["userdetails"]    = array("module/management/userdetails.php",    "Benutzerverwaltung", "Benutzer", "", "", "Benutzer Details");
$PATHS["pdf-rappele-single"] = array("module/management/modules/mPDF/rappenwoert/single_user/pdf.php", "", "", "", "", "");
$PATHS["pdf-rappele-season-all-intern"] = array("module/management/modules/mPDF/rappenwoert/season-all-intern/pdf.php", "", "", "", "", "");
$PATHS["pdf-rappele-season-all-extern"] = array("module/management/modules/mPDF/rappenwoert/season-all-extern/pdf.php", "", "", "", "", "");

/**
 * @Titel Poolkleidung
 * @Pfad module/storage/*.php
 */
$PATHS["poolkleidung"]        = array("module/storage/poolkleidung.php", "Poolkleidung", "", "", "", "Poolkleidung Liste");
$PATHS["poolkleidung-detail"] = array("module/storage/poolkleidungdetail.php", "Poolkleidung", "", "", "", "Poolkleidung Details");

/**
 * @Titel Listen
 * @Pfad module/listen/*.php
 */
$PATHS["uebungen"]     = array("module/listen/uebungen.php", "Listen", "Übungsdienste", "", "", "Übungsdienste Liste");
$PATHS["atns"]         = array("module/listen/atns.php", "Listen", "Ausbildungsnachweise", "", "", "Ausbildungsnachweise Übersicht");
$PATHS["einweisungen"] = array("module/listen/einweisungen.php", "Listen", "Einweisugnen", "", "", "Einweisugnen Übersicht");
$PATHS["rappenwoert"] = array("module/listen/rappenwoert.php", "Listen", "Rappenwört Dienststunden", "", "", "Rappenwört Dienststunden");

/**
 * @Titel Dienstplan
 * @Pfad module/dienstplan/*.php
 */
$PATHS["dienstplan-dashboard"] = array("module/dienstplan/dashboard.php", "Dienstplan", "Dashboard", "", "", "Dienstplan Dashboard");
$PATHS["dienstplan-dienste"]   = array("module/dienstplan/dienste.php", "Dienstplan", "Dienste", "", "", "Dienstplan Dienste");

