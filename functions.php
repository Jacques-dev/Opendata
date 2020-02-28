

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


  foreach($data["formations"] as $x) {

    for($i = 0; $i < 3 ; $i++) {
      if($x["number"] > $list[$i]) {
        $list[$i] = $x["number"];
        $list2[$i] = $x["name"];
        break;
      }
    }
  }
  return $list2;

}

?>
