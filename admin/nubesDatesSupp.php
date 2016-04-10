<?php
  include_once ("inc/include.inc.php");
  
  /* --------------------------------------------------- Suppression d'une date ---------------------------------------------- */
  
  if(isset($_GET["dateIdNubes"]))
  {
    // On récupère l'ID de la date à supprimer
    $dateIdNubes = $_GET["dateIdNubes"];
    // On récupère tout le contenu de la table adhérent
    $requete = "SELECT * FROM nubes WHERE ID=".$dateIdNubes;
    $reponse = $bdd->query($requete);
    $donnees = $reponse->fetch();
    
    if((isset($dateIdNubes)) && ($dateIdNubes != "") && (isset($_GET['supp'])) )
    {
      //Requete SQL pour supprimer la date dans la base
      $req = $bdd->query("DELETE FROM nubes WHERE ID = ".$dateIdNubes) or die(mysql_error());
      $req-> closeCursor();
      header("Location:nubesGestion.php#form2");
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suppression d'une date de l'atelier Nubes</title>
  
  <?php include("inc/head.inc.php");?>

  <style>
    p.erreur{
    color:red;
    }
    p.success{
    color:green;
    }
    select.time{
    width:50px;
    }
  </style>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'ateliersGestion.php' => 'Gestion des ateliers', 'nubesGestion.php' => 'Gestion de l\'atelier Nubes', 'final' => 'Suppression d\'une date de l\'atelier Nubes'));
      ?>
    </div><!-- fin du fil d'Arianne -->

    <div class="filaire">
      <h1>Suppression d'une date de l'atelier Nubes</h1>
      
      <p>Attention, vous allez supprimer la date ci-dessous :</p>
      <p class="grosTitre"><?php echo $donnees['dates']; ?></p>
      <p>Pour supprimer cette date définitivement, cliquez sur :</p>
      <p><a href="nubesDatesSupp.php?dateIdNubes=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>
        
  </div>

</body>
</html>