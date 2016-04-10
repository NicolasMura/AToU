<?php
  include_once ("inc/include.inc.php");

  // récupère l'ID de l'adhérent
  if(isset($_GET['ID']))   $id = $_GET['ID'];
  else header("Location:creationsGestion.php");
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM creations WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();

  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requetes SQL pour supprimer la création dans la base
    $req= $bdd->query("DELETE FROM creations WHERE id = ".$id ) or die(mysql_error());
    $req-> closeCursor();
    $reqEn= $bdd->query("DELETE FROM creations_en WHERE id = ".$id ) or die(mysql_error());
    $reqEn-> closeCursor();
    //Requete SQL pour supprimer les distributions associées à la création dans la base
    $req2= $bdd->query("DELETE FROM fo_col WHERE creationsID = ".$id ) or die(mysql_error());
    $req2-> closeCursor();
    //Suppression les photos (= les fichiers) sur le serveur  
    $req3='SELECT filename FROM photos WHERE creationsID = ' . $id;
    $reponse = $bdd->query($req3);
    while($donnees = $reponse->fetch())
    {
      $fichierAsupprimer1 = "../photosOriginales/" . $donnees["filename"];
      $fichierAsupprimer2 = "../photosVignettes/" . $donnees["filename"];
      $fichierAsupprimer3 = "../photosVignettesLarges/" . $donnees["filename"];
      $fichierAsupprimer4 = "../photosMobiles/" . $donnees["filename"];
      $fichierAsupprimer5 = "../photosVignettesMini/" . $donnees["filename"];
      $fichierAsupprimer6 = "../photosFancybox/" . $donnees["filename"];
      /*$fichierAsupprimer7 = "../photosMobilesVignette/" . $donnees["filename"];*/
      if(file_exists($fichierAsupprimer1)) unlink($fichierAsupprimer1);
      if(file_exists($fichierAsupprimer2)) unlink($fichierAsupprimer2);
      if(file_exists($fichierAsupprimer3)) unlink($fichierAsupprimer3);
      if(file_exists($fichierAsupprimer4)) unlink($fichierAsupprimer4);
      if(file_exists($fichierAsupprimer5)) unlink($fichierAsupprimer5);
      if(file_exists($fichierAsupprimer6)) unlink($fichierAsupprimer6);
      /*if(file_exists($fichierAsupprimer7)) unlink($fichierAsupprimer7);*/
    }
    //Requete SQL pour supprimer les photos associées à la création dans la base
    $req4= $bdd->query("DELETE FROM photos WHERE creationsID = ".$id ) or die(mysql_error());
    $req4-> closeCursor();

    header("Location:creationsGestion.php?supp=creation");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer une création</title>
  
  <?php include("inc/head.inc.php");?>
</head>
<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('creationsGestion.php' => 'Créations', 'final' => 'Suppression d\' une création'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Suppression d'une création</h1>
      <p>Attention, vous allez supprimer la création :</p>
      <p class="grosTitre"><?php echo $donnees['titre']; ?></p>
      <p>Pour supprimer définitivement cette création, ainsi que toutes les photos qui y sont rattachées, cliquez sur :</p>
      <p><a href="creationsSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>
  </div>

</body>
</html>