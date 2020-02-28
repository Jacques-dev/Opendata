
<?php
  include("functions.php");//importation de méthodes
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!-- family-font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap"> <!-- family-font-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--carte css-->
    <link rel="stylesheet" type="text/css" href="css/Style.css"/>
    <link rel="stylesheet" type="text/css" href="css/Nav.css"/>
    <link rel="stylesheet" type="text/css" href="css/Menu.css"/>
    <link rel="stylesheet" type="text/css" href="css/SearchBox.css"/>
    <link rel="stylesheet" type="text/css" href="css/Filters.css"/>
    <link rel="stylesheet" type="text/css" href="css/Button.css"/>
    <link rel="stylesheet" type="text/css" href="css/List.css"/>
    <link rel="stylesheet" type="text/css" href="css/Info.css"/>
    <link rel="stylesheet" type="text/css" href="css/Footer.css"/>
    <link rel="stylesheet" type="text/css" href="css/Design_anim.css"/>

    <script type="text/javascript" src="js/Script.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://blog.niap3d.com/download/jsSlide/jsSlide_1.2_min.js"></script><!--Script du slider des 3 formations les plus vues-->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--script de la carte-->

    <title>Make Your Life Plans</title>
  </head>

  <body>

    <nav>
      <?php include("nav.php"); ?><!--Importation de la nav bar-->
    </nav>

    <main>
      <div id="filters">
        <?php include("filters.php"); ?><!--Importation des filtres-->
      </div>

      <div class="row" id="results">
        <div class="leftcolumn"><!--Colonne de gauche (les résultats des choix)-->
          <div class="card shadow puff-in-center" id="list">
            <?php include("list.php"); ?> <!--Importation des résultats sous forme de tableaux -->
          </div>
        </div>
        <div class="rightcolumn">
          <div class="card shadow puff-in-center" id="map">

            <div id='mapid'></div> <!--Affichage de la carte-->

          </div>
        </div>
      </div>

      <?php
      if(isset($_GET["code"]) || isset($_GET["forma"])) {
        include("info.php"); //Importtation des informations complémentaire en bas de page sur les établissements et formations
      }
      ?>

    </main>

    <footer class="puff-in-center"><!--Footer avce lien vers le dossier Git-->
      <a href="https://github.com/Jacques-dev/Opendata" target="_blank">
        https://github.com/Jacques-dev/Opendata
      </a>
    </footer>
  </body>

  <script>//Script de la carte
    <?php
    if(isset($_GET["code"])) { //Si on cherche des établissements
      //informations concernant l'établissments
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"];
      $content = file_get_contents($url);
      $results = json_decode($content, true);

      //localisation de l'établissement
      $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.etablissement=".$_GET["code"];
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
      var mymap = L.map('mapid').setView([lon, lat], zoom); //affichage de la carte centré la ville de l'établissment

      //marqueur afficher sur le lieu de l'établissement
      L.marker([lon, lat]).addTo(mymap).bindPopup('<?php echo $results2['records']['0']["fields"]["etablissement_lib"]; ?>').openPopup();
      <?php
    } else {
      $lon = 47.873972;
      $lat = 2.686132;
      $zoom = 6;

      ?>
      var lon = <?php echo json_encode($lon); ?>;
      var lat = <?php echo json_encode($lat); ?>;
      var zoom = <?php echo json_encode($zoom); ?>;
      var mymap = L.map('mapid').setView([lon, lat], zoom); //affichage de la carte centré sur la france
      <?php
    }
    ?>

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', { //importation de l'api de la carte
    attribution: '',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);

  </script>
  <script> //Script du menu latéral
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  <script> //Script d'affichage des choix coché par l'utilisateur dans les filtres
    function selectionView(choice) {
      document.getElementById("checkboxvalue").style.visibility = "visible";
      var tab = [];

      $.each($('input:checked'), function() {
        tab.push(choice);
      });

      $('p').text(tab.join(" ### "));
    }
  </script>

</html>
