

<?php

function sortFilters($list, $ok) {
  $res = array();

  if ($ok == true) {
    foreach($list["facet_groups"][0]["facets"] as $x) {
      array_push($res, $x["name"]);
    }
  } else {
    foreach($list["facet_groups"][1]["facets"] as $x) {
      array_push($res, $x["name"]);
    }
  }

  sort($res);

  return $res;
}



function bestFormation() {

  $list = array(0,0,0) ;
  $list2 = array("","","");

  $json = file_get_contents('save.json');
  $json = utf8_encode($json);
  $data = json_decode($json, true);


  foreach($data["formations"] as $x => $entry) {

    for($i = 0; $i < 3 ; $i++) {

      if($x["number"] > $list[$i]) {
        $list[$i] = $data["formations"][$x]["number"];
        $list2[$i] = $data["formations"][$x]["name"];
        
      }
    }
  }

  return $list2;

}

function numberOfView($check) {
  $json = file_get_contents('save.json');
  $json = utf8_encode($json);
  $data = json_decode($json, true);

  if ($check == false) {
    foreach($data["formations"] as $x => $entry) {
  		if($_GET["name"] == $entry["name"] && $_GET["forma"] == $entry["forma"] && $_GET["effect"] == $entry["effectif"] && $_GET["cursus"] == $entry["cursus"]) {
  			return $data["formations"][$x]["number"];
  		}
  	}
  } else {
    foreach($data["links"] as $x => $entry) {
      $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $content2 = file_get_contents($url2);
      $results2 = json_decode($content2, true);

  		if($results2["records"][0]["fields"]["url"] == $entry["url"]) {
  			return $data["links"][$x]["number"];
  		}
  	}
  }

  return null;
}

?>
