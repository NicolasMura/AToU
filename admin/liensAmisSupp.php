<?php
  include_once ("inc/include.inc.php");
  
  /* --------------------------------------------------- Suppression d'un lien ami ---------------------------------------------- */
  
  if(isset($_GET["lienID"]))
  {
    // On récupère l'ID du lien à supprimer
    $IdLien = $_GET["lienID"];
    
    
    // On récupère tout le contenu du lien
    $requete = "SELECT * FROM liens_amis WHERE ID=".$IdLien;
    $reponse = $bdd->query($requete);
    $donnees = $reponse->fetch();
    
    if(($IdLien != "") && (isset($_GET['supp'])) )
    {
      //Requete SQL pour supprimer le lien dans la base
      $req = $bdd->query("DELETE FROM liens_amis WHERE ID = ".$IdLien) or die(mysql_error());
      $req-> closeCursor();
      header("location:cieAtouGestion.php");
    }
  }
  else header("location:cieAtouGestion.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suppression d'un lien ami</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>

  <div id="container">
    
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('cieAtouGestion.php' => 'Cie AToU', 'final' => 'Suppression d\'un lien ami'));
      ?>
    </div><!-- fin du fil d'Arianne -->
    
        
    <div class="filaire">
      <h1>Suppression d'un lien ami</h1>
      
      <?php
        if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";
        else
        {
      ?>
      <p>Attention, vous allez supprimer le lien ami ci-dessous :</p>
      <p class="grosTitre"><?php echo $donnees['nom']; ?></p>
      <p>Pour supprimer ce lien définitivement, cliquez sur :</p>
      <p><a href="liensAmisSupp.php?lienID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
      <?php
        }
      ?>
    </div>
  </div>

</body>
</html>