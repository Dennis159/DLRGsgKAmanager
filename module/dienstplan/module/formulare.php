<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/Config_Master.php';

if (isset($_GET['SaveMeldung'])) {
  // Nutzen Sie PDO::quote, um die Benutzereingaben zu escapen
  $uid      = $_SESSION['uid'];
  $position = $TOOL->quote($_GET['position']);
  $dienst   = $TOOL->quote($_GET['dienst']);
  $start    = isset($_GET['teilzeit']) ? $TOOL->quote($_GET['start']) : 'NULL';
  $end      = isset($_GET['teilzeit']) ? $TOOL->quote($_GET['end']) : 'NULL';
  $bemerk   = !empty($_GET['bemerkung']) ? $TOOL->quote($_GET['bemerkung']) : 'NULL';

  // Erstellen Sie die SQL-Abfrage
  if(DLR_DP_getUserRegisterState($_GET['dienst'], true) != "none") {
    $query = "UPDATE dp_meldungen SET 
                                        position  = $position, 
                                        bemerkung = " . ($bemerk === 'NULL' ? 'NULL' : $bemerk) . ", 
                                        start_abw = " . ($start === 'NULL' ? 'NULL' : $start) . ", 
                                        end_abw   = " . ($end === 'NULL' ? 'NULL' : $end) . " 
                                  WHERE uid = $uid AND dienst = $dienst";
  } else {
    $query = "INSERT INTO dp_meldungen (uid, dienst, position, bemerkung, start_abw, end_abw) 
              VALUES ($uid, $dienst, $position, " . ($bemerk === 'NULL' ? 'NULL' : $bemerk) . ", " . ($start === 'NULL' ? 'NULL' : $start) . ", " . ($end === 'NULL' ? 'NULL' : $end) . ")";
  }

  // Führen Sie die Abfrage aus
  $TOOL->exec($query);
}

header("LOCATION: /?dienstplan-dienste");
exit();
?>
