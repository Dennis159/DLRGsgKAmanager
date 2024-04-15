<?php
/**
 * @param$uid
 * @return  mixed
 * @decription  Hole dir alle Daten des Users aus seiner Akte
 */
function GG_fnc_getUserFile($uid): mixed
{
  global $TOOL;
  return $TOOL->query("SELECT * FROM mgmt_userfiles WHERE uid = $uid")->fetch();
}

/**
 * @param $rank
 * @return string
 * @Description Wandle die Rang-Ziffer in einen Text um
 */
function GG_fnc_getRankName($rank): string
{
  switch ($rank) {
    case 0: return "<span class='badge badge-danger'>wartet auf Freischaltung</span>";
    case 1: return "Nutzer";
    case 2: return "Verwalter";
    default: return "Rang $rank existiert nicht!";
  }
}