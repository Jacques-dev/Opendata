<?php
$file = "lien.txt";
$url=$_GET['url'];

$fp=fopen($file,"r+");
$lines = file($file);

foreach ($lines as $lineNumber => $lineContent) { //parcour des lignes
	fputs($fp,"0");
	if (strpos($lineContent , $url) == true) { //si le lien existe
    $tab= explode(" ", $lineContent);
    $nb = $tab[1]; //on prend le nombre
    $nb = $nb + 1;
    fputs($fp,$nb);
    fclose($fp);
  } else { //si le lien n'existe pas
    fputs($fp,"yes");
    fputs($fp, "\r\n".$url." "."1");
    fclose($fp);
  }
}




print("<html>
<head>
<meta http-equiv=\"refresh\" content=\"0; URL=$url\">
</head>
<body>
vous allez être redirigé vers la page souhaitée. Si la redirection ne fonctionne pas, cliquez
<a href=\"$url\">ici</a>
</body>
</html>
");
?>
