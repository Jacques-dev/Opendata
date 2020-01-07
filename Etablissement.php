
<?php

?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="MyStyles.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <link rel="stylesheet" type="text/css" href="Content.css">
    <link rel="stylesheet" type="text/css" href="forms.css">
    <link rel="stylesheet" type="text/css" href="Animations.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--map-->

    <script type="text/javascript" src="MyScript.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--map-->

   <title>Make Your Life Plans</title>

  </head>

  <body>

    <headbanner>
      <h class="center">MYLP</h>
    </headbanner>

    <?php
    $url = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre&refine.libelle_commune=".$_POST["nomEtab"];
    $content = file_get_contents($url);
    $results = json_decode($content, true);

    foreach($results['records'] as $value) {
      $lat = $value["fields"]["position"][0];
      $lon = $value["fields"]["position"][1];
    }
    ?>
    <div id="mapid"></div>

    <a href="index.php">
      <div class="svg-wrapper">
        <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
          <rect id="shape" height="40" width="150" />
          <div id="text">
            <input type="submit" name="submit" class="spot" value="Retour menu">
          </div>
        </svg>
      </div>
    </a>

    <div id="info">
      <?php if (isset($_POST["nomEtab"])) {

        echo "<h>";
        echo $_POST["nomEtab"];
        echo "</h>";


      }?>
      <div style="margin-top:50px;">
        Des infos...
      </div>
    </div>

  </body>

  <script>
    var lon = <?php echo json_encode($lon); ?>;
    var lat = <?php echo json_encode($lat); ?>;
    var mymap = L.map('mapid').setView([lat, lon], 12);

    var marker = L.marker([lat, lon]).addTo(mymap);

    var popup = L.popup()
    .setLatLng([lat, lon])
    .setContent("I am a standalone popup.")
    .openOn(mymap);

    marker.bindPopup(<?php echo json_encode($_POST["nomEtab"]); ?>).openPopup();

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);
  </script>
</html>
