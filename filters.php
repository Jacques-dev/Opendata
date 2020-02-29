

<?php
$filter = array("Diplome","Formation","Région","Département","Ville","Académie","Etablissement");//Nom des filtres
$facet = array("diplome_lib","discipline_lib","reg_etab_lib","dep_etab_lib","com_etab_lib","aca_etab_lib","etablissement_lib");//facet de l'API de ces filtres
$checkbox = array("checkboxdiplome[]","checkboxformation[]","checkboxregion[]","checkboxdepartement[]","checkboxville[]","checkboxacademie[]","checkboxetablissement[]");//on liste l'ensemble des choix parmis les filtres afin de faire des recherches plus précises

for($x = 0 ; $x < 7 ; $x++) {?><!--7 filtres dominants donc 7 tours de boucle-->
<form action="home.php" method="post">
  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn"><?php echo $filter[$x]; ?></button><!--Bouton de filtre-->
    <div class="dropdown-content"><!--menu déroulant-->
      <?php
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=".$facet[$x]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents = file_get_contents($url);
      $results = json_decode($contents, true);

      $res = sortFilters($results, true);//tri par ordre alphabétique

      foreach ($res as $f) {//les choix
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name=\"%s\" value=\"%s\"><label for=\"%s\">%s</label></div>",$f,$checkbox[$x],$f,$f,$f);
      }
      ?>
    </div>
  </div>
<?php } ?>

  <div class="dropdown fade-in"><!--Bouton "Rechercher"-->
    <div class="svg-wrapper">
      <svg height="56" width="150" xmlns="http://www.w3.org/2000/svg">
        <rect id="shape" height="56" width="140"/>
        <div id="text">
          <input type="submit" name="submit" class="spot" value="Rechercher" onclick="reduceMap()">
        </div>
      </svg>
    </div>
  </div>

  <div class="dropdown fade-in">
    <h3>Votre sélection :</h3>
  </div>

  <div class="dropdown"><!--Affiche tous les choix coché par l'utilisateur-->
    <div id="checkboxvalue">
      <p></p>
    </div>
  </div>
</form>
