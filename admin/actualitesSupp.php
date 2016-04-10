<?php
  include_once ("inc/include.inc.php");

  // récupère l'ID de l'actualité
  $id = $_GET["ID"];
  
  // Impossibilité de supprimer la 1ère actu
  if($id == 1) header("location:actualitesGestion.php");
  
  // On récupère tout le contenu de la table actualite
  $requete="SELECT * FROM actualites WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();
  
  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requetes SQL pour supprimer l'actualité dans la base
    $req= $bdd->query("DELETE FROM actualites WHERE id = ".$id )or die(mysql_error());
    $req-> closeCursor();
    $reqEn= $bdd->query("DELETE FROM actualites_en WHERE id = ".$id )or die(mysql_error());
    $reqEn-> closeCursor();
    header("Location:actualitesGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer l'actualité</title>

  <?php include("inc/head.inc.php");?>
</head>
<body class="supp">
 
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
  <!-- Fil d'Arianne -->
  <div class="filaire">
  <?php
     define('Compagnie_ATou', 'Accueil', true);
     get_fil_ariane(array('actualitesGestion.php' => 'Gestion des actualités', 'final' => 'Suppression d\'une actualité'));
  ?>
  </div> <!-- fin du fil d'Arianne -->
  
  <div class="halfPage filaire">
    <h1>Suppression d'une actualité</h1>
    <p>Attention, vous allez supprimer l'actualité suivante :</p>
    <p class="grosTitre"><?php echo $donnees['titre'];?></p>
    <p>Pour la supprimer définitivement, cliquez sur :</p>
    <p><a href="actualitesSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
  </div>
</div>
</body>
</html>