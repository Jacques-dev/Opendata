

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

?>