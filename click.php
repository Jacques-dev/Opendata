<?php

$json = file_get_contents("save.json");
$json = utf8_encode($json);
$data = json_decode($json, true);


if (isset($_GET["url"])) {
	$url = $_GET["url"];

	foreach($data["links"] as $x) {
		if($url == $x["url"]) {
			$x["number"] = $x["number"] + 1;
			header("Location : ".$url);
		}
	}
	$newtab = array();
	array_push($newtab, array("url" => $url, "number" => 0));

	$content_json = json_encode($newtab);
	$file = "save.json";
	$file = fopen($file, "a+"); //ouvre le fichier
	$line = fgets($file); //lit la 1ere ligne du fichier
	fseek($file, 0); //le curseur se remet au debut du fichier
	fputs($file, $content_json);
	fclose($file);  //ferme le fichier
	header("Location : ".$url);
}

if (isset($_GET["url2"])) {
	$name = $_GET["name"];
	$forma = $_GET["forma"];
	$effect = $_GET["effect"];
	$cursus = $_GET["cursus"];

	foreach($data["formations"] as $x) {
		if($name == $x["name"] && $forma == $x["forma"] && $effect == $x["effectif"] && $cursus == $x["cursus"]) {
			$x["number"] = $x["number"] + 1;
		} else {
			$newtab = array();
			array_push($newtab, array("name" => $name, "forma" => $forma, "cursus" => $cursus, "effectif" => $effect));

			$content_json = json_encode($newtab);
			$file = "save.json";
			$file = fopen($file, "a+"); //ouvre le fichier
			$line = fgets($file); //lit la 1ere ligne du fichier
			fseek($file, 0); //le curseur se remet au debut du fichier
			fputs($file, $content_json);
			fclose($file);  //ferme le fichier
			echo $_GET["url2"];
			header("Location : ".$_GET["url2"]);
		}
	}
}

if(isset($_GET["like"])) {
	$opinion["like"] = $opinion["like"] + 1;
}
if(isset($_GET["dislike"])) {
	$opinion["dislike"] = $opinion["dislike"] + 1;
}
?>
