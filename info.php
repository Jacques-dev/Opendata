

<div id="info" class="shadow">
  <?php
  if(isset($_GET["forma"])) { //Si on recherche une formations spécifique
    $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
    $content2 = file_get_contents($url2);
    $results2 = json_decode($content2, true);

    echo "<b class='tab'><u>Site Web</u></b>  :  <a href='click.php?url=".$results2["records"][0]["fields"]["url"]."'>".$results2["records"][0]["fields"]["url"]."</a><br>";
    echo "<b class='tab'><u>Nombre de vu sur cette formation</u></b>  :  ";

  } else {
    if(isset($_GET["code"])) { //Si on recherche un établissement spécifique
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.etablissement=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $content = file_get_contents($url);
      $results = json_decode($content, true);
      $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $content2 = file_get_contents($url2);
      $results2 = json_decode($content2, true);


      echo "<b class='tab'><u>Site Web</u></b>  :  <a href='click.php?url=".$results2["records"][0]["fields"]["url"]."'>".$results2["records"][0]["fields"]["url"]."</a><br>";
      echo "<b class='tab'><u>Etablissement</u></b>  :  ".$results['records'][0]['fields']['etablissement_lib']."<br>";
      echo "<b class='tab'><u>Type d'établissement</u></b>  :  ".$results['records'][0]['fields']['etablissement_type_lib']."<br>";
      echo "<b class='tab'><u>Région</u></b> : ".$results['records'][0]['fields']['reg_etab_lib']."<br>";
      echo "<b class='tab'><u>Département</u></b>  :  ".$results['records'][0]['fields']['dep_etab_lib']."<br>";
      echo "<b class='tab'><u>Académie</u></b>  :  ".$results['records'][0]['fields']['aca_etab_lib']."<br>";
      echo "<b class='tab'><u>Commune</u></b>  :  ".$results['records'][0]['fields']['com_etab_lib']."<br>";

      $nb = 0;
      foreach ($results['records'] as $value) {//On compte le nombre d'élève par formation pour en faire un total
        $nb = $nb + $value['fields']['effectif_total'];
      }

      echo "<b class='tab'><u>Nombre total d'élèves</u></b>  :  ".$nb;
    }
  }


  ?>
</div>
