<?php

$json = file_get_contents("save.json");
$json = utf8_encode($json);
$data = json_decode($json, true);
$ok = false;

if (isset($_GET["url"])) {
	$url = $_GET["url"];
	foreach($data["links"] as $x => $entry) {
		if($url == $entry["url"]) {
			$data["links"][$x]["number"] = $data["links"][$x]["number"] + 1;
			$ok = true;
		}
	}
	if ($ok == false) {
		array_push($data["links"], array("url" => $url, "number" => 1));
	}
	$new_json = json_encode($data);
	file_put_contents('save.json',$new_json);
	header("Location: ".$url);
}

if (isset($_GET["url2"])) {
	$name = $_GET["name"];
	$forma = $_GET["forma"];
	$effect = $_GET["effect"];
	$cursus = $_GET["cursus"];
	$url = $_GET["url2"]."&name=".$name."&forma=".$forma."&effect=".$effect."&cursus=".$cursus;

	foreach($data["formations"] as $x => $entry) {
		if($name == $entry["name"] && $forma == $entry["forma"] && $effect == $entry["effectif"] && $cursus == $entry["cursus"]) {
			$data["formations"][$x]["number"] = $data["formations"][$x]["number"] + 1;
			$ok = true;
		}
	}
	if ($ok == false) {
		array_push($data["formations"], array("name" => $name, "forma" => $forma, "cursus" => $cursus, "effectif" => $effect));
	}
	$new_json = json_encode($data);
	file_put_contents('save.json',$new_json);
	header("Location: ".$url);
}

if(isset($_GET["like"])) {
	$data["like"] = $data["like"] + 1;
}
if(isset($_GET["dislike"])) {
	$data["dislike"] = $data["dislike"] + 1;
}
?>
