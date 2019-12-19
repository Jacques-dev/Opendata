


<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="MyStyles.css">
    <link rel="stylesheet" type="text/css" href="Animations.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--map-->

    <script type="text/javascript" src="MyScript.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--map-->

    <title>Nom Etablissement</title>
  </head>

  <body>

    <headbanner>
      <h class="center">Nom Etablissement</h>
    </headbanner>

    <div id="mapid"></div>

    <div id="info">
      INFO
    </div>

  </body>

  <script>
    var mymap = map.on('2 Rue Albert Einstein, 77420 Champs-sur-Marne', function (result) {
        L.marker([result.x, result.y]).addTo(map)
    });
    /*
    var mymap = L.map('mapid').setView([48.837, 2.584], 12);

    var marker = L.marker([48.837, 2.584]).addTo(mymap);

    var popup = L.popup()
    .setLatLng([51.5, -0.09])
    .setContent("I am a standalone popup.")
    .openOn(mymap);

    marker.bindPopup("<b>IUT Marne La Vallée.").openPopup();
*/
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);
  </script>
</html>
