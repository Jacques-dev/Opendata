
<?php
  include("php/functions.php");
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--map-->
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
    <script src="https://blog.niap3d.com/download/jsSlide/jsSlide_1.2_min.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--map-->

    <title>Make Your Life Plans</title>
  </head>

  <body>

    <nav>
      <?php include("nav.php"); ?>
    </nav>

    <main>
      <div id="filters">
        <?php include("filters.php"); ?>
      </div>

      <div class="row" id="results">
        <div class="leftcolumn">
          <div class="card shadow puff-in-center" id="list">
            <?php include("list.php"); ?>
          </div>
        </div>
        <div class="rightcolumn">
          <div class="card shadow puff-in-center" id="map">

            <div id='mapid'></div>

          </div>
        </div>
      </div>

      <?php
      if(isset($_GET["code"]) || isset($_GET["forma"])) {
        include("info.php");
      }
      ?>

    </main>

    <footer class="puff-in-center">
      <a href="https://github.com/Jacques-dev/Opendata" target="_blank">
        https://github.com/Jacques-dev/Opendata
      </a>
    </footer>
  </body>

  <script>
    <?php
    if(isset($_GET["code"])) {
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"];
      $content = file_get_contents($url);
      $results = json_decode($content, true);

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
      var mymap = L.map('mapid').setView([lon, lat], zoom);

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
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  <script>
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
