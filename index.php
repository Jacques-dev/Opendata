<?php

  $t1 = "&refine.diplome_lib=Doctorat";
  $t2 = "&refine.discipline_lib=Informatique";
  $t3 = "&refine.reg_etab_lib=Île-de-France";

  $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=diplome_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3".$t1.$t2.$t3;
  $content = file_get_contents($url);
  $results = json_decode($content, true);

  $count = 0;
  foreach ($results as $x) {
    $count ++;
  }
  if ($count == 0) {
    ?>
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      </head>
      <body style="font-size:50px; text-align: center; margin-top: 45%;">
        Site Web en maintenance...
      </body>
    </html>
    <?php
  } else {
    header("Location: home.php");
  }
?>
