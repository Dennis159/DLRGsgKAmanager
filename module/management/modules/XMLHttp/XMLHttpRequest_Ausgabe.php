<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/inc/Config_Master.php";
 $an  = $_GET['an'];

 $res   = $TOOL->query("SELECT * FROM `storage_artikel` WHERE artikelnummer = '$an' AND status = 0")->fetchAll(PDO::FETCH_ASSOC);

?>
   <select name="ausgabeid" class="customSelect" onchange="AusgabeStep3(this.value)">
     <option selected hidden style="text-align: center"># # # # # Artikel wählen # # # # #</option>
     <?php
     foreach ($res as $r){
       ?>
       <option value="<?php echo $r['id']; ?>">[ <?php echo $r['id']; ?> ] - Größe <?php echo $r['groesse']; ?> </option>
     <?php } ?>
   </select>

   <input type="hidden" name="groesse" value="<?php echo $r['groesse'] ?>">


