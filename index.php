
<?php

session_start();

if(!empty($_POST) OR !empty($_FILES))
{
$_SESSION['sauvegarde'] = $_POST ;
$_SESSION['sauvegardeFILES'] = $_FILES ;

$fichierActuel = $_SERVER['PHP_SELF'] ;
if(!empty($_SERVER['QUERY_STRING']))
{
$fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
}

header('Location: ' . $fichierActuel);
exit;
}

if(isset($_SESSION['sauvegarde']))
{
$_POST = $_SESSION['sauvegarde'] ;
$_FILES = $_SESSION['sauvegardeFILES'] ;

unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
}

  $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=diplome_lib&refine.rentree_lib=2017-18";
  $contents = file_get_contents($url);
  $results = json_decode($contents, true);

  $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=discipline_lib&refine.rentree_lib=2017-18";
  $contents2 = file_get_contents($url2);
  $results2 = json_decode($contents2, true);

  $url3 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=reg_etab_lib&refine.rentree_lib=2017-18";
  $contents3 = file_get_contents($url3);
  $results3= json_decode($contents3, true);

  $url4 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=dep_etab_lib&refine.rentree_lib=2017-18";
  $contents4 = file_get_contents($url4);
  $results4 = json_decode($contents4, true);

  $url5 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=com_etab_lib&refine.rentree_lib=2017-18";
  $contents5 = file_get_contents($url5);
  $results5 = json_decode($contents5, true);

  $url6 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=aca_etab_lib&refine.rentree_lib=2017-18";
  $contents6 = file_get_contents($url6);
  $results6 = json_decode($contents6, true);

  $url7 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=etablissement_lib&refine.rentree_lib=2017-18";
  $contents7 = file_get_contents($url7);
  $results7 = json_decode($contents7, true);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="MyStyles.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <link rel="stylesheet" type="text/css" href="Content.css">
    <link rel="stylesheet" type="text/css" href="forms.css">
    <link rel="stylesheet" type="text/css" href="Animations.css">

    <script type="text/javascript" src="js/MyScript.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>

    <title>Make Your Life Plans</title>
  </head>

  <body>
    <!--
    <video id="bgvid" playsinline autoplay muted loop>
      <source src="vid/1.mp4" type="video/mp4">
    </video>
    -->

    <headbanner>
      <h class="center1">MYLP</h>
    </headbanner>

    <div style="position:absolute; top:0; right:0; margin-top:50px;">
      <div class="svg-wrapper" style="float:left">
        <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
          <rect id="shape" height="40" width="150" />
          <div id="text">
            <a href="Propos.php" style="text-decoration:none">
              <input type="submit" name="submit" class="spot" value="A propos">
            </a>
          </div>
        </svg>
      </div>
      <div class="svg-wrapper">
        <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
          <rect id="shape" height="40" width="150" />
          <div id="text">
            <a href="Aide.php" style="text-decoration:none">
              <input type="submit" name="submit" class="spot" value="Aide">
            </a>
          </div>
        </svg>
      </div>
    </div>

    <div id="nav">
      <input type="text" placeholder="Rechercher votre établissement" name="search" id="searchbar" onkeyup="searchEtab()">

      <?php
      /*
        foreach ($results7["facet_groups"][0]["facets"] as $etablissement) {
          printf("<div class='etab'>\"%s\"</div>",$etablissement["name"]);
        }
        */
      ?>
    </div>


    <div id="home" >
      <div id="filters">
        <div id="container-1" class="tab">
          <div onclick="openFilter(event, 'diplome')" class="btn btn-two tablinks">
            <span>Diplome</span>
          </div>
          <div onclick="openFilter(event, 'formation')" class="btn btn-two-2 tablinks">
            <span>Formation</span>
          </div>
          <div onclick="openFilter(event, 'region')" class="btn btn-two tablinks">
            <span>Région</span>
          </div>
          <div onclick="openFilter(event, 'departement')" class="btn btn-two-2 tablinks">
            <span>Département</span>
          </div>
          <div onclick="openFilter(event, 'ville')" class="btn btn-two tablinks">
            <span>Ville</span>
          </div>
          <div onclick="openFilter(event, 'academie')" class="btn btn-two-2 tablinks">
            <span>Académie</span>
          </div>
          <div onclick="openFilter(event, 'etablissement')" class="btn btn-two-2 tablinks">
            <span>Etablissement</span>
          </div>
        </div>



        <div id="container-2">
          <form method="post" action="index.php">
            <div id="diplome" class="tabcontent">

                <?php
                foreach ($results["facet_groups"][0]["facets"] as $diplome) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxdiplome[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$diplome["name"],$diplome["name"],$diplome["name"]);
                }
                ?>

            </div>

            <div id="formation" class="tabcontent">

                <?php
                foreach ($results2["facet_groups"][0]["facets"] as $formation) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxformation[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$formation["name"],$formation["name"],$formation["name"]);
                }
                ?>

            </div>

            <div id="region" class="tabcontent">

                <?php
                foreach ($results3["facet_groups"][0]["facets"] as $region) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxregion[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$region["name"],$region["name"],$region["name"]);
                }
                ?>

            </div>

            <div id="departement" class="tabcontent">

                <?php
                foreach ($results4["facet_groups"][0]["facets"] as $departement) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxdepartement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$departement["name"],$departement["name"],$departement["name"]);
                }
                ?>

            </div>

            <div id="ville" class="tabcontent">

                <?php
                foreach ($results5["facet_groups"][0]["facets"] as $ville) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxville[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$ville["name"],$ville["name"],$ville["name"]);
                }
                ?>

            </div>

            <div id="academie" class="tabcontent">

                <?php
                foreach ($results6["facet_groups"][1]["facets"] as $academie) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxacademie[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$academie["name"],$academie["name"],$academie["name"]);
                }
                ?>

            </div>

            <div id="etablissement" class="tabcontent">

                <?php
                foreach ($results7["facet_groups"][0]["facets"] as $etablissement) {
                  printf("<div class='checkbox'><input type='checkbox' name='checkboxetablissement[]' value=\"%s\"><label for=\"%s\">%s</label></div>",$etablissement["name"],$etablissement["name"],$etablissement["name"]);
                }
                ?>

            </div>

            <div id="checkboxvalue">

              Votre sélection :
              <p></p>
            </div>

            <div class="svg-wrapper">
              <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                <rect id="shape" height="40" width="150" />
                <div id="text">
                  <input type="submit" name="submit" class="spot" value="Rechercher">
                </div>
              </svg>
            </div>

          </form>

        </div>

      </div>

      <div class="contents">
        <table>
          <tr id="head">
            <th>diplomes</th>
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

          if (isset($_POST["submit"])) {
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



          }



          $urltab1 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=100&sort=-rentree_lib".$eta.$dip.$for.$vil.$dep.$aca.$reg."&refine.rentree_lib=2017-18";
          $contentstab1 = file_get_contents($urltab1);
          $tab = json_decode($contentstab1, true);

          $color = true;
          foreach ($tab['records'] as $value) {
              if ($color == true) {
                echo "<form method='post' action='Etablissement.php'> ";
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
                    <a href='Etablissement.php'>
                    <div class="svg-wrapper">
                      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                        <rect id="shape" height="40" width="150"/>
                        <div id="text">
                          <?php echo "<input class='spot' type='submit' value='".$value['fields']['com_etab_lib']."' name='nomEtab'></input>";?>
                        </div>
                      </svg>
                    </div>
                    </a><?php
                    echo "</td>";
                  echo "</tr>";
                echo "</form>";
                $color = false;
              } else {
                echo "<form method='post' action='Etablissement.php'> ";
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
                    <a href='Etablissement.php'>
                    <div class="svg-wrapper" style="background-color: rgba(255, 255, 255, 0);">
                      <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
                        <rect id="shape" height="40" width="150" />
                        <div id="text">
                          <?php echo "<input class='spot' type='submit' value='".$value['fields']['com_etab_lib']."' name='nomEtab'></input>";?>
                        </div>
                      </svg>
                    </div>
                    </a><?php
                    echo "</td>";
                  echo "</tr>";
                echo "</form>";
                $color = true;
              }
          }

          ?>

        </table>
        <?php
        $count = 0;
        foreach ($tab['records'] as $value) {
          $count +=1;
        }
        if ($count == 0) {echo "<div id='aucunedonnee'>AUCUNE DONNÉES</div>";}
        ?>
      </div>
    </div>

    <footer>

    </footer>

  </body>

  <script>
    $(window).ready(function(){
    $(".boton").wrapInner('<div class=botontext></div>');

    $(".botontext").clone().appendTo( $(".boton") );

    $(".boton").append('<span class="twist"></span><span class="twist"></span><span class="twist"></span><span class="twist"></span>');

    $(".twist").css("width", "25%").css("width", "+=3px");
    });

    function openFilter(evt, filter) {
      document.getElementById("container-1").style.float="left";
      document.getElementById("container-2").style.display="block";
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(filter).style.display = "block";

      evt.currentTarget.className += " active";
    }

    $('input').on('click', function(){
      var tab = [];

      $.each($('input:checked'), function() {
        tab.push($(this).val());
      });

      $('p').text(tab.join(" ### "));

    });

    function searchEtab() {

      var input = document.getElementById('searchbar').valueinput=input.toLowerCase();
      var x = document.getElementsByClassName('etab');

      for (i = 0; i < x.length; i++) {
          if (!x[i].innerHTML.toLowerCase().includes(input)) {
              x[i].style.display="none";
          }
          else {
              x[i].style.display="list-item";
          }
      }
    }

  </script>
</html>
