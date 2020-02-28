

<div class="contents">
  <?php
  if (isset($_POST["submit"])) {//Si on a lancé une recherche avec le bouton "Rechercher"
    ?>
    <table>
      <tr id="head">
        <th>Diplomes</th>
        <th>Formations</th>
        <th>Régions</th>
        <th>Départements</th>
        <th>Villes</th>
        <th>Académies</th>
        <th>Etablissements</th>
      </tr>

      <?php

      //En fonction de ce qui et coché, on va mofifier l'url de l'API avec des facet ou de refine
      //Dans un filtre, si rien n'est coché un laissera la variable assossié à ce filtre en facet
      //Sinon on la transforme en refine
      //on effectuera autant de refine que de choix coché(s)

      $dip = "&facet=diplome_lib";
      $for = "&facet=discipline_lib";
      $reg = "&facet=reg_etab_lib";
      $dep = "&facet=dep_etab_lib";
      $vil = "&facet=com_etab_lib";
      $aca = "&facet=aca_etab_lib";
      $eta = "&facet=etablissement_lib";

      if (isset($_POST['checkboxdiplome'])) {
        $dip = "";
        foreach ($_POST['checkboxdiplome'] as $x) {
          $dip = $dip."&refine.diplome_lib=".$x;
        }
      }

      if (isset($_POST['checkboxformation'])) {
        $for = "";
        foreach ($_POST['checkboxformation'] as $x) {
          $for = $for."&refine.discipline_lib=".$x;
        }
      }

      if (isset($_POST['checkboxregion'])) {
        $reg = "";
        foreach ($_POST['checkboxregion'] as $x) {
          $reg = $reg."&refine.reg_etab_lib=".$x;
        }
      }

      if (isset($_POST['checkboxdepartement'])) {
        $dep = "";
        foreach ($_POST['checkboxdepartement'] as $x) {
          $dep = $dep."&refine.dep_etab_lib=".$x;
        }
      }

      if (isset($_POST['checkboxville'])) {
        $vil = "";
        foreach ($_POST['checkboxville'] as $x) {
          $vil = $vil."&refine.com_etab_lib=".$x;
        }
      }

      if (isset($_POST['checkboxacademie'])) {
        $aca = "";
        foreach ($_POST['checkboxacademie'] as $x) {
          $aca = $aca."&refine.aca_etab_lib=".$x;
        }
      }

      if (isset($_POST['checkboxetablissement'])) {
        $eta = "";
        foreach ($_POST['checkboxetablissement'] as $x) {
          $eta = $eta."&refine.etablissement_lib=".$x;
        }
      }



      $urltab1 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&rows=100&sort=-rentree_lib".$eta.$dip.$for.$vil.$dep.$aca.$reg."&refine.rentree_lib=2017-18&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $contentstab1 = file_get_contents($urltab1);
      $tab = json_decode($contentstab1, true);

      $count = 0;
      foreach ($tab['records'] as $value) {
        $count +=1;
      }
      if ($count == 0) { // On affiche le nombre de résulat(s), si il n'y en a pas, on affiche un message
        echo "<div class='res'>AUCUNE DONNÉES</div>";
      } else {
        echo "<div class='res'>".$count." résultats trouvés.</div>";
      }

      $id = 'first';
      foreach ($tab['records'] as $value) {
        echo "<form method='post' action='home.php'> ";
          echo "<tr id='" . $id . "'>";
            echo "<td>";
            print($value["fields"]['diplome_lib']);
            echo "</td>";
            echo "<td>";
            print($value['fields']['discipline_lib']);
            echo "</td>";
            echo "<td>";
            print($value['fields']['reg_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value['fields']['dep_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value['fields']['com_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value['fields']['aca_etab_lib']);
            echo "</td>";
            echo "<td><a href='home.php?code=" . $value['fields']['etablissement'] . "'>";
            print($value['fields']['etablissement_lib']);
            echo "</a></td>";
          echo "</tr>";
        echo "</form>";
        if ($id == 'first') {
          $id = 'second';
        } else {
          $id = 'first';
        }
      }
      ?>
    </table>
    <?php
  } else {
    if(isset($_GET["forma"])) { //Si on fait une recherche
      $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.discipline_lib=".$_GET["forma"]."&refine.etablissement=".$_GET["code"]."&refine.effectif_total=".$_GET["effect"]."&refine.niveau_lib=".$_GET["cursus"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
      $content = file_get_contents($url);
      $results = json_decode($content, true);
      ?>
      <table>
        <tr id="head">
          <th>Formation</th>
          <th>Diplome</th>
          <th>Etablissement</th>
          <th>Niveau dans le diplome</th>
          <th>Secteur disciplinaire</th>
          <th>Région</th>
          <th>Département</th>
          <th>Académie</th>
          <th>Commune</th>
        </tr>
        <?php
        $id = 'first';
        foreach ($results['records'] as $value) {
          echo "<tr id='" . $id . "'>";
            echo "<td>";
            print($value["fields"]['discipline_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['diplome_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['etablissement_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['niveau_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['sect_disciplinaire_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['reg_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['dep_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['aca_etab_lib']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['com_etab_lib']);
            echo "</td>";
          echo "</tr>";
          if ($id == 'first') {
            $id = 'second';
          } else {
            $id = 'first';
          }
        }
        ?>
        <tr id="head">
          <th>Nombre d'étudiants</th>
          <th>Nombre de fille</th>
          <th>Nombre de garçon</th>
        </tr>
        <?php
        $id = 'first';
        foreach ($results['records'] as $value) {
          echo "<tr id='" . $id . "'>";
            echo "<td>";
            print($value["fields"]['effectif']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['femmes']);
            echo "</td>";
            echo "<td>";
            print($value["fields"]['hommes']);
            echo "</td>";
          echo "</tr>";
          if ($id == 'first') {
            $id = 'second';
          } else {
            $id = 'first';
          }
        }
        ?>
      </table>
      <?php
    } else {
      if(isset($_GET["code"])) {
        $url = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&refine.etablissement=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
        $content = file_get_contents($url);
        $results = json_decode($content, true);

        $url2 = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-etablissements-enseignement-superieur&refine.uai=".$_GET["code"]."&apikey=4235ff7e201928217f476ed0265010597e1bf22cae753cdbbacc9af3";
        $content2 = file_get_contents($url2);
        $results2 = json_decode($content2, true);
        ?>
        <table>
          <tr id="head">
            <th>Diplomes</th>
            <th>Formations</th>
            <th>Cycle</th>
            <th>Nombre d'élève</th>
          </tr>
          <?php

          $count = 0;
          foreach ($results['records'] as $value) {
            $count +=1;
          }
          if ($count == 0) {
            echo "<div class='res'>AUCUNE DONNÉES</div>";
          } else {
            echo "<div class='res'>".$count." résultats trouvés.</div>";
          }

          $id = 'first';
          foreach ($results['records'] as $value) {
            echo "<form method='post' action='home.php'> ";
              echo "<tr id='" . $id . "'>";
                echo "<td>";
                print($value["fields"]['diplome_lib']);
                echo "</td>";
                $urlred = "home.php?forma=" . $value['fields']['discipline_lib'] . "&name=" . $value['fields']['etablissement'] . "&effect=" . $value['fields']['effectif_total'] . "&cursus=" . $value['fields']['niveau_lib'];
                echo "<td><a href='click.php?url2=".$urlred."&forma=" . $value['fields']['discipline_lib'] . "&name=" . $value['fields']['etablissement_lib'] . "&effect=" . $value['fields']['effectif_total'] . "&cursus=" . $value['fields']['niveau_lib'] . "'>";
                print($value['fields']['discipline_lib']);
                echo "</a></td>";
                echo "<td>";
                print($value['fields']['cursus_lmd_lib']);
                echo "</td>";
                echo "<td>";
                print($value['fields']['effectif_total']);
                echo "</td>";
              echo "</tr>";
            echo "</form>";
            if ($id == 'first') {
              $id = 'second';
            } else {
              $id = 'first';
            }
          }
          ?>
        </table>
        <?php
      }
    }
  }
  ?>
</div>
