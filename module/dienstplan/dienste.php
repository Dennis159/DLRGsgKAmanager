<div class="container-fluid py-4">
  <div class="card">
    <div class="card-body p-1 pb-0" style="vertical-align: middle">
     <div class="row">
       <div class="col-6" style="margin-bottom: -0.75em">
         <form>
           <label for="ausblenden">Ausblenden: </label>
           <select  id="ausblenden" class="customSelect" onchange="loadDienste()" style="width: 10em!important;">
             <option value="keine">Keine</option>
             <option value="abgeschlossene">Abgeschlossene</option>
             <option value="vergangene">Vergangene</option>
           </select>
           <label for="season">Jahr: </label>
           <select id="season" class="customSelect" onchange="loadDienste()" style="width: 5em!important;">
             <?php
              $res = $TOOL->query("SELECT DISTINCT YEAR(start) as year FROM dp_dienste ORDER BY start DESC")->fetchAll(PDO::FETCH_ASSOC);
              foreach ($res as $key => $year) {
             ?>
             <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
             <?php } ?>
           </select>
           <input type="search" id="search" class="customForm" placeholder="Suchen (Titel, Datum, Typ)" oninput="loadDienste()" style="width: 15em!important;">
         </form>
       </div>
       <div class="col-6" style="margin-bottom: -0.75em">
         <span class="float-end btn btn-success"><i class="fa-solid fa-plus"></i> Neu</span>
       </div>
     </div>
    </div>
  </div>
<hr>
  <div class="row" id="dienste"></div>
</div>

<script>
  loadDienste();

  function loadDienste(){

    let hide   = document.getElementById("ausblenden").value;
    let season = document.getElementById("season").value;
    let search = document.getElementById("search").value;

    let xhr = new XMLHttpRequest();
    let url = 'module/dienstplan/module/XMLHttp_dienste.php?hide='+hide+'&season='+season+'&search='+search;
    xhr.open('GET', url, true);

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        document.getElementById("dienste").innerHTML = xhr.responseText;
      } else {
        console.log('Request failed with status: ' + xhr.status);
      }
    };

    xhr.onerror = function () {
      console.log('Request failed');
    };

    xhr.send();
  }
</script>