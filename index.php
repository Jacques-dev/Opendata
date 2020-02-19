


<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--map-->
    <link rel="stylesheet" type="text/css" href="Style.css"/>
    <link rel="stylesheet" type="text/css" href="Nav.css"/>
    <link rel="stylesheet" type="text/css" href="Menu.css"/>
    <link rel="stylesheet" type="text/css" href="SearchBox.css"/>
    <link rel="stylesheet" type="text/css" href="Filters.css"/>
    <link rel="stylesheet" type="text/css" href="Button.css"/>
    <link rel="stylesheet" type="text/css" href="List.css"/>

    <script type="text/javascript" src="js/Script.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--map-->

    <title>Make Your Life Plans</title>
  </head>

  <body>
    
    <nav>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">A propos</a>
      </div>

      <span id="burger" onclick="openNav()">&#9776;</span>
      
      <h id="navTitle">MYLP</h>
      
      <div class="container">
        <input type="text" placeholder="Search...">
        <div class="search"></div>
      </div>
    </nav>  
  
    <main>
      <div id="filters">
        <div class="dropdown">
          <button class="dropbtn">Diplome</button>
          <div class="dropdown-content">
            <?php
            $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=diplome_lib&refine.rentree_lib=2017-18";
            $contents = file_get_contents($url);
            $results = json_decode($contents, true);
            foreach ($results["facet_groups"][0]["facets"] as $diplome) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxdiplome[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$diplome["name"],$diplome["name"],$diplome["name"],$diplome["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Formation</button>
          <div class="dropdown-content">
            <?php
            $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=discipline_lib&refine.rentree_lib=2017-18";
            $contents2 = file_get_contents($url2);
            $results2 = json_decode($contents2, true);
            foreach ($results2["facet_groups"][0]["facets"] as $formation) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxformation[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$formation["name"],$formation["name"],$formation["name"],$formation["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Région</button>
          <div class="dropdown-content">
            <?php
            $url3 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=reg_etab_lib&refine.rentree_lib=2017-18";
            $contents3 = file_get_contents($url3);
            $results3= json_decode($contents3, true);
            foreach ($results3["facet_groups"][0]["facets"] as $region) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxregion[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$region["name"],$region["name"],$region["name"],$region["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Département</button>
          <div class="dropdown-content">
            <?php
            $url4 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=dep_etab_lib&refine.rentree_lib=2017-18";
            $contents4 = file_get_contents($url4);
            $results4 = json_decode($contents4, true);
            foreach ($results4["facet_groups"][0]["facets"] as $departement) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxdepartement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$departement["name"],$departement["name"],$departement["name"],$departement["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Ville</button>
          <div class="dropdown-content">
            <?php
            $url5 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=com_etab_lib&refine.rentree_lib=2017-18";
            $contents5 = file_get_contents($url5);
            $results5 = json_decode($contents5, true);
            foreach ($results5["facet_groups"][0]["facets"] as $ville) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxville[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$ville["name"],$ville["name"],$ville["name"],$ville["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Académie</button>
          <div class="dropdown-content">
            <?php
            $url6 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=aca_etab_lib&refine.rentree_lib=2017-18";
            $contents6 = file_get_contents($url6);
            $results6 = json_decode($contents6, true);
            foreach ($results6["facet_groups"][1]["facets"] as $academie) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxacademie[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$academie["name"],$academie["name"],$academie["name"],$academie["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Etablissement</button>
          <div class="dropdown-content">
            <?php
            $url7 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=etablissement_lib&refine.rentree_lib=2017-18";
            $contents7 = file_get_contents($url7);
            $results7 = json_decode($contents7, true);
            foreach ($results7["facet_groups"][0]["facets"] as $etablissement) {
              printf("<div class='checkbox'><input onclick='selectionView(\"%s\")' type='checkbox' name='checkboxetablissement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$etablissement["name"],$etablissement["name"],$etablissement["name"],$etablissement["name"]);
            }
            ?>
          </div>
        </div>
        
        <div class="dropdown">
          <div class="svg-wrapper">
            <svg height="56" width="150" xmlns="http://www.w3.org/2000/svg">
              <rect id="shape" height="56" width="140"/>
              <div id="text">
                <form action="index.php" method="post">
                  <input type="submit" name="submit" class="spot" value="Rechercher">
                </form>
              </div>
            </svg>
          </div>
        </div>
        
        <div class="dropdown">
          <h3>Votre sélection :</h3>
        </div>
        
        <div class="dropdown">
          <div id="checkboxvalue">
            <p></p>
          </div>
        </div>
        
      </div>
      
      <div class="row" id="results">
        <div class="leftcolumn">
          <div class="card" id="list">
            <div class="contents">
              <?php
                if (isset($_POST["submit"])) {
              ?>
              <table>
                
                <tr id="head">
                  <th>Diplomes</th>
                  <th>Formations</th>
                  <th>Régions</th>
                  <th>Départements</th>
                  <th>Villes</th>
                  <th>Académies</th>
                  <th>Etablissements</th>
                  <th>Liens</th>
                </tr>
                
                <?php
                  
                  $dip = "&facet=diplome_lib";
                  $for = "&facet=discipline_lib";
                  $reg = "&facet=reg_etab_lib";
                  $dep = "&facet=dep_etab_lib";
                  $vil = "&facet=com_etab_lib";
                  $aca = "&facet=aca_etab_lib";
                  $eta = "&facet=etablissement_lib";

                  if (isset($_POST['checkboxdiplome'])) {
                    $dip = "";
                    foreach ($_POST['checkboxdiplome'] as $x) {
                      $dip = $dip."&refine.diplome_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxformation'])) {
                    $for = "";
                    foreach ($_POST['checkboxformation'] as $x) {
                      $for = $for."&refine.discipline_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxregion'])) {
                    $reg = "";
                    foreach ($_POST['checkboxregion'] as $x) {
                      $reg = $reg."&refine.reg_etab_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxdepartement'])) {
                    $dep = "";
                    foreach ($_POST['checkboxdepartement'] as $x) {
                      $dep = $dep."&refine.dep_etab_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxville'])) {
                    $vil = "";
                    foreach ($_POST['checkboxville'] as $x) {
                      $vil = $vil."&refine.com_etab_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxacademie'])) {
                    $aca = "";
                    foreach ($_POST['checkboxacademie'] as $x) {
                      $aca = $aca."&refine.aca_etab_lib=".$x;
                    }
                  }

                  if (isset($_POST['checkboxetablissement'])) {
                    $eta = "";
                    foreach ($_POST['checkboxetablissement'] as $x) {
                      $eta = $eta."&refine.etablissement_lib=".$x;
                    }
                  }



                  $urltab1 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=100&sort=-rentree_lib".$eta.$dip.$for.$vil.$dep.$aca.$reg."&refine.rentree_lib=2017-18";
                  $contentstab1 = file_get_contents($urltab1);
                  $tab = json_decode($contentstab1, true);

                  $color = true;
                  foreach ($tab['records'] as $value) {
                    if ($color == true) {
                      echo "<form method='post' action='index.php'> ";
                        echo "<tr id='first'>";
                          echo "<td>";
                          print($value["fields"]['diplome_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['discipline_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['reg_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['dep_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['com_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['aca_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['etablissement_lib']);
                          echo "</td>";
                          echo "<td>";?>
                          <div class="svg-wrapper">
                            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                              <rect id="shape" height="40" width="150"/>
                              <div id="text">
                                <?php echo "<input class='spot' type='submit' value='".$value['fields']['etablissement']."' name='code'></input>";?>
                              </div>
                            </svg>
                          </div>
                          <?php
                          echo "</td>";
                        echo "</tr>";
                      echo "</form>";
                      $color = false;
                    } else {
                      echo "<form method='post' action='index.php'> ";
                        echo "<tr id='second'>";
                          echo "<td>";
                          print($value['fields']['diplome_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['discipline_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['reg_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['dep_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['com_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['aca_etab_lib']);
                          echo "</td>";
                          echo "<td>";
                          print($value['fields']['etablissement_lib']);
                          echo "</td>";
                          echo "<td>";?>
                          <div class="svg-wrapper" style="background-color: rgba(255, 255, 255, 0);">
                            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                              <rect id="shape" height="40" width="150" />
                              <div id="text">
                                <?php echo "<input class='spot' type='submit' value='".$value['fields']['etablissement']."' name='code'></input>";?>
                              </div>
                            </svg>
                          </div>
                          <?php
                          echo "</td>";
                        echo "</tr>";
                      echo "</form>";
                      $color = true;
                    }
                  }

                  $count = 0;
                  foreach ($tab['records'] as $value) {
                    $count +=1;
                  }
                  if ($count == 0) {
                    echo "<div id='aucunedonnee'>AUCUNE DONNÉES</div>";
                  }
                  ?></table><?php
                }
              
                if (isset($_POST["code"])) {
                  $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.etablissement=".$_POST["code"];
                  $content = file_get_contents($url);
                  $results = json_decode($content, true);
                  ?>
                <table>
                  <tr id="head">
                    <th>Diplomes</th>
                    <th>Formations</th>
                    <th>Liens</th>
                  </tr>
                  <?php
                  $color = true;
                  $dip = array();
                  foreach ($results['records'] as $value) {
                    
                    if (!(in_array($value["fields"]['diplome_lib'],$dip))) {

                      array_push($dip,$value["fields"]['diplome_lib']);

                      if ($color == true) {
                        echo "<form method='post' action='index.php'> ";
                          echo "<tr id='first'>";
                            echo "<td>";
                            print($value["fields"]['diplome_lib']);
                            echo "</td>";
                            echo "<td>";
                            print($value['fields']['discipline_lib']);
                            echo "</td>";
                            echo "<td>";?>
                              <div class="svg-wrapper">
                                <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                  <rect id="shape" height="40" width="150"/>
                                  <div id="text">
                                    <?php echo "<input class='spot' type='submit' value='test' name='dipl'></input>";?>
                                  </div>
                                </svg>
                              </div>
                              <?php
                              echo "</td>";
                            echo "</tr>";
                          echo "</form>";
                          $color = false;
                        } else {
                          echo "<form method='post' action='index.php'> ";
                            echo "<tr id='second'>";
                              echo "<td>";
                              print($value['fields']['diplome_lib']);
                              echo "</td>";
                              echo "<td>";
                              print($value['fields']['discipline_lib']);
                              echo "</td>";
                              echo "<td>";?>
                                <div class="svg-wrapper">
                                  <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                                    <rect id="shape" height="40" width="150"/>
                                    <div id="text">
                                      <?php echo "<input class='spot' type='submit' value='test' name='dipl'></input>";?>
                                    </div>
                                  </svg>
                                </div>
                              <?php
                              echo "</td>";
                            echo "</tr>";
                          echo "</form>";
                          $color = true;
                        }
                      }
                    }
                  ?>
                </table>
                <?php
                }
                ?>
              
            </div>
          </div>
        </div>
        <div class="rightcolumn">
          <div class="card" id="map">
            
            <div id='mapid'></div>
            
          </div>
        </div>
      </div>
      
      <div id="info">
        info
      </div>
      
    </main>
    
    <footer>
      lien
    </footer>
  </body>
  
  <script>
    <?php
    if (isset($_POST["code"])) {
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_POST["code"];
      $content = file_get_contents($url);
      $results = json_decode($content, true);

      $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.etablissement=".$_POST["code"];
      $content2 = file_get_contents($url2);
      $results2 = json_decode($content2, true);

      foreach($results['records'] as $value) {
        $lat = $value["fields"]["coordonnees"][1];
        $lon = $value["fields"]["coordonnees"][0];
        $zoom = 14;
      }
      ?>
      var lon = <?php echo json_encode($lon); ?>;
      var lat = <?php echo json_encode($lat); ?>;
      var zoom = <?php echo json_encode($zoom); ?>;
      var mymap = L.map('mapid').setView([lon, lat], zoom);
      
      L.marker([lon, lat]).addTo(mymap).bindPopup('<?php echo $results2['records']['0']["fields"]["etablissement_lib"]; ?>').openPopup();
      <?php
    } 
    if (!(isset($_POST["code"]))) {
      $lon = 47.873972;
      $lat = 2.686132;
      $zoom = 6;

      ?>
      var lon = <?php echo json_encode($lon); ?>;
      var lat = <?php echo json_encode($lat); ?>;
      var zoom = <?php echo json_encode($zoom); ?>;
      var mymap = L.map('mapid').setView([lon, lat], zoom);
      <?php
    }
    ?>
    
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);
    
    
    
  </script>
  

  
</html>
