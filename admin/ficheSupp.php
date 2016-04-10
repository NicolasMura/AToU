<?php
  include_once ("inc/include.inc.php");
  
  //############### Récupération en GET de l'ID de la création #######################
  $ID = $_GET['ID'];

  if(isset($_GET['creationsID']) AND isset($_GET['ficheID']))  
  {
    $creationsID = $_GET['creationsID'];
    $ficheID = $_GET['ficheID'];
    $requete="SELECT * FROM fiche WHERE ID=".$ficheID;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();

    // On récupère le titre de la création ou action culturelle en cours de modification (pour le fil d'ariane)
    $requeteTitreFilAriane="SELECT titre FROM creations WHERE ID =".$ID;
    $reponseTitreFilAriane = $bdd->query($requeteTitreFilAriane);
    // On affiche l' entrée
    $donneesTitreFilAriane = $reponseTitreFilAriane->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
        {
        $fichierAsupprimer = "../pdf/" . $donnees["urlFiche"];
        echo $fichierAsupprimer;
        if(file_exists($fichierAsupprimer)) unlink($fichierAsupprimer);
      
        //Requete SQL pour supprimer la fiche création dans la base
        $req= $bdd->query("DELETE FROM fiche WHERE ID = ".$ficheID) or die(mysql_error());
        $req-> closeCursor();
        header("Location:creationsModif.php?ID=".$creationsID);
      }
    } // fin du if
  } // fin du if
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
  <meta charset="UTF-8">
  <title>Supprimer la fiche création</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification de la création '.$donneesTitreFilAriane['titre'], 'final' => 'Suppression de la fiche création'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Suppression de la fiche création</h1>
      <p>Attention, vous allez supprimer la fiche création :</p>
      <p class="grosTitre"><?php echo $donnees['titre'];?> </p>
      <p>Pour supprimer définitivement cette fiche, cliquez sur :</p>
      <p><a href="ficheSupp.php?creationsID=<?php echo $donnees["creationsID"]?>&ficheID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    </div>
  </div>
</body>
</html>