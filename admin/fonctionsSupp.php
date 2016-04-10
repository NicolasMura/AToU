<?php
  include_once ("inc/include.inc.php");

  // récupère l'ID de la fonction
  if(isset($_GET['ID']))  $id = $_GET["ID"];
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM fonctions WHERE ID=".$id;
  $reponse = $bdd->query($requete);
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();

  if ((isset($id)) && ($id != "") && (isset($_GET['supp'])) ) {
    //Requete SQL pour supprimer le contact dans la base
  $req= $bdd->query("DELETE FROM fonctions WHERE id = ".$id )or die(mysql_error());
  $req-> closeCursor();
  $reqEn= $bdd->query("DELETE FROM fonctions_en WHERE id = ".$id )or die(mysql_error());
  $reqEn-> closeCursor();
  header("Location:cieAtouGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suppression d'une fonction</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">

  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
        define('Compagnie_ATou', 'Accueil', true);
        get_fil_ariane(array('cieAtouGestion.php' => 'Cie Atou', 'final' => 'Suppression d\' une fonction'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="filaire">
      <h1>Suppression d'une fonction</h1>
      <p>Attention, vous allez supprimer la fonction :</p>
      <p class="grosTitre"><?php echo $donnees['metiers']; ?></p>
      <p>Pour supprimer définitivement cette fonction, cliquez sur :</p>
      <p><a href="fonctionsSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>
  </div>
</body>
</html>