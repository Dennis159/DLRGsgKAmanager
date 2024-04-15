<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/inc/Config_Master.php";
 $an  = $_GET['an'];

 $res   = $TOOL->query("SELECT * FROM storage_artikelliste WHERE artikelnummer = '$an'")->fetch();
 $res   = json_decode($res['groessen'], true);
?>
   <select name="groesse" class="customSelect" onchange="AntragStep3(this.value)">
     <option selected hidden style="text-align: center"># # # # # Größe wählen # # # # #</option>
     <?php
     foreach ($res as $r){
       ?>
       <option value="<?php echo $r; ?>">Größe <?php echo $r; ?> </option>
     <?php } ?>
   </select>


