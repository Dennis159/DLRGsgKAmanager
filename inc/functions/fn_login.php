<?php
/**
 * <u><b><i>Überprüfe die vom Benutzer eingegebenen Logindaten.</i></b></u>
 * @Erfolg Bestätige den Login und setzte alle notwenidgen $_SESSION variablen
 * @Misserfolg Fehlermeldung "Benutzername oder Passwort ist falsch"
 * @Remember setze einen Cookie mit Benutzername und Passwort
 */
function GG_fnc_checkLoginData($username, $password, $remember = false): string
{
  global $TOOL;
  $result = $TOOL->query("SELECT * FROM mgmt_logindata WHERE username = '$username'")->fetch();

  if(!password_verify($password, $result['password'])){
    return false;
  }

  $_SESSION['valid_login'] = true;
  $_SESSION['uid']         = $result['uid'];
  $_SESSION['created_at']  = $result['created_at'];
  $_SESSION['allowed']     = $result['allowed'];
  $TOOL->query("UPDATE mgmt_logindata SET last_seen = NOW() WHERE uid = " . $result['uid']);

  if($remember){
    $array = json_encode(array($username, $password));
    setcookie("DLRKA_LOGIN", $array, time()+31556926);
  }

  return true;
}
