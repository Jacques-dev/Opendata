<html>
  <head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> <!--map-->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script><!--map-->
    
  <style>
    #mapid {
      height: 500px;
    }  
  </style>
    
  </head>
  <body>
    <div id='mapid'></div>
  </body>
  
  <script>
    
  var lon = 47.873972;
  var lat = 2.686132;
  var zoom = 6;
    
  var mymap = L.map('mapid').setView([lon, lat], zoom);
    
  var marker = L.marker([lon, lat]).addTo(mymap);
    
  var popup = L.popup().setLatLng([lon, lat]).setContent("<p>bonjour</p>").openOn(mymap);
    
  marker.bindPopup().openPopup();
    
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);
  </script>
  
</html>