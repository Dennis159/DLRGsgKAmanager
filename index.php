<?php
/** Hole dir die Functions und die Datenbanken */
include "inc/Config_Master.php";

/** Speichere die anzuzeigende Seite */
$page = !empty($_GET) ? strtolower(key($_GET)) : "login" ;

/** Logout Funktion */
if($page == "logout"){
  session_unset();
  session_destroy();
  setcookie("DLRKA_LOGIN", '', time() - 3600, '/');
  header('LOCATION: ?login');
}

$PAGE_bc1      = $PATHS[$page][1];
$PAGE_bc2      = $PATHS[$page][2];
$PAGE_bc3      = $PATHS[$page][3];
$PAGE_bc4      = $PATHS[$page][4];
$PAGE_pagtitle = $PATHS[$page][5];

/** Setze den Header wenn es sich nicht um die Login- oder not-allowed Seite handelt, wenn es sich um die Loginseite handelt, setze den ?login */
if($page != "login" AND $page != "not-allowed" AND $page != "register" AND $page != "passwort-vergessen" AND !(str_contains($page, "pdf"))){
  include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php";
} elseif($page != "not-allowed" AND $page != "register" AND $page != "passwort-vergessen" AND !(str_contains($page, "pdf"))) {
  echo '<script>var newURL = window.location.origin + "/?login"; window.history.pushState({ path: newURL }, "", window.location.origin + "?login");</script>';
}

if(!key_exists($page, $PATHS)){
  echo "<script>window.location.href = '?404&e=$page';</script>";
}

/** Hole dir den Dateipfad aus dem Path array ( inc/config/Config_Filepath.php ) */
$path = $PATHS[$page][0] ?? null;

/** Include dir die gewünschte seite */
include $path != null ? $path : "module/misc/404.php";

/** Setze den Footer wenn es sich nicht um die Login- oder not-allowed Seite handelt */
if($page != "login" AND $page != "not-allowed" AND $page != "register" AND $page != "passwort-vergessen" AND !(str_contains($page, "pdf"))){
 include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php";
}
