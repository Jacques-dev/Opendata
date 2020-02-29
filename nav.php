<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="apropos.php">A propos</a>
  <br><br>
  <div id="feedback">
    <a id="like">Like</a>
    <a id="dislike">Dislike</a>
  </div>
</div>

<span id="burger" onclick="openNav()">&#9776;</span>

<a href="home.php" style="text-decoration: none"><h id="navTitle" class="fade-in">MYLP</h></a>

<div id="test" class="fade-in">
  <div id="slideshow">
    <?php
    $list = bestFormation();
    ?>
      <img src="" alt= <?php echo "1 : ".$list[0]; ?> >
      <img src="" alt= <?php echo "2 : ".$list[1]; ?> >
      <img src="" alt= <?php echo "3 : ".$list[2]; ?> >
  </div>
</div>
<script type="text/javascript">
  var slider1 = new jsSlide({
  id: 'slideshow',
  autoplay: true,
  });
</script>

<div id="topformation" class="fade-in">Top formations :</div>

<div class="container">
  <form method="POST" action="home.php">
    <input type="text" placeholder="Search..." name="search">
  </form>
  <div class="search roll-in-right"></div>
</div>





<?php
  if(isset($_POST["search"])) {
    $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=etablissement_lib&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
    $contents = file_get_contents($url);
    $results = json_decode($contents, true);

    foreach ($results["records"] as $x) {
      if ($_POST["search"] == $x["fields"]["etablissement_lib"]) {
        header("Location: home.php?code=" . $x["fields"]['etablissement']);
        exit();
      }
    }
  }
?>
