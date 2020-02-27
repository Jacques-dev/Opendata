<form action="home.php" method="post">
  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Diplome</button>
    <div class="dropdown-content">
      <?php
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=diplome_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents = file_get_contents($url);
      $results = json_decode($contents, true);

      $res = sortFilters($results, true);

      foreach ($res as $diplome) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxdiplome[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$diplome,$diplome,$diplome,$diplome);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Formation</button>
    <div class="dropdown-content">
      <?php
      $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=discipline_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents2 = file_get_contents($url2);
      $results2 = json_decode($contents2, true);

      $res = sortFilters($results2, true);

      foreach ($res as $formation) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxformation[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$formation,$formation,$formation,$formation);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Région</button>
    <div class="dropdown-content">
      <?php
      $url3 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=reg_etab_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents3 = file_get_contents($url3);
      $results3= json_decode($contents3, true);

      $res = sortFilters($results3, true);

      foreach ($res as $region) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxregion[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$region,$region,$region,$region);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Département</button>
    <div class="dropdown-content">
      <?php
      $url4 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=dep_etab_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents4 = file_get_contents($url4);
      $results4 = json_decode($contents4, true);

      $res = sortFilters($results4, true);

      foreach ($res as $departement) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxdepartement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$departement,$departement,$departement,$departement);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Ville</button>
    <div class="dropdown-content">
      <?php
      $url5 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=com_etab_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents5 = file_get_contents($url5);
      $results5 = json_decode($contents5, true);

      $res = sortFilters($results5, true);

      foreach ($res as $ville) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxville[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$ville,$ville,$ville,$ville);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Académie</button>
    <div class="dropdown-content">
      <?php
      $url6 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=aca_etab_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents6 = file_get_contents($url6);
      $results6 = json_decode($contents6, true);

      $res = sortFilters($results6, false);

      foreach ($res as $academie) {
        printf("<div><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxacademie[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$academie,$academie,$academie,$academie);
      }
      ?>
    </div>
  </div>

  <div class="dropdown shadow slide-in-elliptic-top-fwd">
    <button class="dropbtn">Etablissement</button>
    <div class="dropdown-content">
      <?php
      $url7 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=etablissement_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contents7 = file_get_contents($url7);
      $results7 = json_decode($contents7, true);

      $res = sortFilters($results7, true);

      foreach ($res as $etablissement) {
        printf("<div><input id='etablissementID' onclick='selectionView(\"%s\")' type='checkbox' name='checkboxetablissement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$etablissement,$etablissement,$etablissement,$etablissement);
      }
      ?>
    </div>
  </div>

  <div class="dropdown fade-in">
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

  <div class="dropdown">
    <div id="checkboxvalue">
      <p></p>
    </div>
  </div>
</form>
