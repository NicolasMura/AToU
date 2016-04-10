<?php
  include_once ("inc/include.inc.php");
  
  /* --------------------------------------------------- Suppression d'un atelier ---------------------------------------------- */
  
  if(isset($_GET["atelierID"]))
  {
    // On récupère l'ID de l'atelier à supprimer
    $IdAtelier = $_GET["atelierID"];
    
    // Impossibilité de supprimer l'atelier Nubes
    if($IdAtelier == 1)
    {
      $erreur = "Vous ne pouvez pas supprimer l'atelier Nubes.";
    }
    else
    {
      // On récupère tout le contenu de l'atelier
      $requete = "SELECT * FROM ateliers WHERE ID=".$IdAtelier;
      $reponse = $bdd->query($requete);
      $donnees = $reponse->fetch();
      
      if(($IdAtelier != "") && (isset($_GET['supp'])) )
      {
        //Requete SQL pour supprimer l'atelier dans la base
        $req = $bdd->query("DELETE FROM ateliers WHERE ID = ".$IdAtelier) or die(mysql_error());
        $req-> closeCursor();
        header("Location:ateliersGestion.php");
      }
    }
  }else header("location:ateliersGestion.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suppression d'un atelier</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>

  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
        define('Compagnie_ATou', 'Accueil', true);
        get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'ateliersGestion.php' => 'Gestion des ateliers', 
        'final' => 'Suppression d\'un atelier'));
      ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <div class="halfPage filaire">
      <h1>Suppression d'un atelier</h1>
      
      <?php
        if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";
        else
        {
      ?>
      <p>Attention, vous allez supprimer l'atelier ci-dessous :</p>
      <p class="grosTitre"><?php echo $donnees['titre']; ?></p>
      <p>Pour supprimer cet atelier définitivement, cliquez sur :</p>
      <p><a href="ateliersSupp.php?atelierID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
      <?php
        }
      ?>
    </div>
  </div>
</body>
</html>