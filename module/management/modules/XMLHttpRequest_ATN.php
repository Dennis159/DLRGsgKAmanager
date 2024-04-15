<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/inc/Config_Master.php";
 $atn  = $_GET['atn'];
 $user = $_GET['user'];

 $res   = $TOOL->query("SELECT `$atn` FROM mgmt_atns WHERE uid = $user")->fetch();
 $value = $res[$atn];

 if($atn == "san_andere"){
   $value = json_decode($value, true);
  ?>
   <input type="text" name="san_andere" placeholder="Qualifikation" class="customForm" style="margin-bottom: 1em!important;" value="<?php echo $value[0] ?>"><br>
  <?php
   $value = $value[1];
 }
 ?>
<select class="customSelect" name="status">
  <option value="0" <?php if($value == 0){ echo "selected"; } ?> >ATN nicht vorhanden</option>
  <option value="1" <?php if($value == 1){ echo "selected"; } ?> >Für Lehrgang angemeldet / Laufender Lehrgang</option>
  <option value="2" <?php if($value == 2){ echo "selected"; } ?> >ATN hochgeladen, muss überprüft werden</option>
  <option value="3" <?php if($value == 3){ echo "selected"; } ?> >ATN vorhanden (nicht im ISC eingetragen)</option>
  <option value="4" <?php if($value == 4){ echo "selected"; } ?> >ATN vorhanden und im ISC eingetragen</option>
</select>
