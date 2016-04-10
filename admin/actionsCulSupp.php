<?php
  include_once ("inc/include.inc.php");

  // récupère l'ID de l'adhérent
  if(isset($_GET['ID'])) $id = $_GET['ID'];
  else header("Location:actionsCulGestion.php");
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM actions_culturelles WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();

  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requete SQL pour supprimer l'action culturelle dans la base
    $req= $bdd->query("DELETE FROM actions_culturelles WHERE id = ".$id ) or die(mysql_error());
    $req-> closeCursor();
    $reqEn= $bdd->query("DELETE FROM actions_culturelles_en WHERE id = ".$id ) or die(mysql_error());
    $reqEn-> closeCursor();
    //Suppression les photos (= les fichiers) sur le serveur  
    $req3='SELECT filename FROM photos WHERE actions_culturellesID = ' . $id;
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
    //Requete SQL pour supprimer les photos associées à l'action culturelle dans la base
    $req4= $bdd->query("DELETE FROM photos WHERE actions_culturellesID = ".$id ) or die(mysql_error());
    $req4-> closeCursor();
  
    header("Location:actionsCulGestion.php?supp=actionCulturelle");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer une action culturelle</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
<?php include('inc/menuAdmin.inc.php'); ?>
<div id="container">
  <!-- Fil d'Arianne -->
  <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'final' => 'Suppression d\'une action culturelle'));
    ?>
    <!-- fin du fil d'Arianne -->

    <div class="filaire">
      <h1>Suppression d'une action culturelle</h1>
      <p>Attention, vous allez supprimer :</p>
      <p class="grosTitre"><?php echo $donnees['titre']; ?></p>
      <p>Pour supprimer définitivement cette action culturelle, ainsi que toutes les photos qui y sont rattachées, cliquez sur :</p>
      <p><a href="actionsCulSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>
  </div>

  </div>
</body>
</html>