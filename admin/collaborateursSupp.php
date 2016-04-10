<?php
  include_once ("inc/include.inc.php");
  
  // récupère l'ID du collaborateur
  if(isset($_GET['ID']))  $id = $_GET["ID"];
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM collaborateurs WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();

  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requete SQL pour supprimer le contact dans la base
  $req= $bdd->query("DELETE FROM collaborateurs WHERE id = ".$id )or die(mysql_error());
  $req-> closeCursor();
  header("Location:cieAtouGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer un collaborateur</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">

    <div class="filaire">

      <!-- Fil d'Arianne -->
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('cieAtouGestion.php' => 'Gestion de la Cie Atou','final' => 'Suppression d\'un collaborateur'));
      ?> <!-- fin du fil d'Arianne -->
    </div>

    <div class="filaire">
        <h1>Suppression d'un collaborateur</h1>
        <p>Attention, vous allez supprimer le collaborateur :</p>
        <p class="grosTitre"><?php echo $donnees['nom']; ?> <?php echo $donnees['prenom']; ?></p>
        <p>Pour supprimer définitivement ce collaborateur, cliquez sur :</p>
        <p><a href="collaborateursSupp.php?ID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>

  </div>
</body>
</html>