<?php
  include_once ("inc/include.inc.php");

  // récupère l'ID de l'adhérent
  $id = $_GET["ID"];
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM adherents WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();

  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requete SQL pour supprimer le contact dans la base
  $req= $bdd->query("DELETE FROM adherents WHERE id = ".$id )or die(mysql_error());
  $req-> closeCursor();
  header("Location:adherentsGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer un adhérent</title>

  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
  
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('adherentsGestion.php' => 'Adhérents', 'final' => 'Suppression d\'un adhérent'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <div class="halfPage filaire">
      <h1>Suppression d'un adhérent</h1>
      <p>Attention, vous allez supprimer l'adhérent :</p>
      <p class="grosTitre"><?php echo $donnees['nom']; ?> <?php echo $donnees['prenom']; ?></p>
      <p>Pour supprimer définitivement cet adhérent, cliquez sur :</p>
      <p><a href="adherentsSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>

  </div>
</body>
</html>