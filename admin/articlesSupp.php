<?php
  include_once ("inc/include.inc.php");
  
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_POST['ID'])) $ID = $_POST['ID'];
  if(isset($_GET['creationsID'])) $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID'])) $actions_culturellesID = $_GET['actions_culturellesID'];
  if(isset($_POST['creationsID'])) $creationsID = $_POST['creationsID'];
  if(isset($_POST['actions_culturellesID'])) $actions_culturellesID = $_POST['actions_culturellesID'];

  if(isset($_GET['articlesID'])) $articlesID = $_GET['articlesID'];
  if(isset($_POST['articlesID'])) $articlesID = $_POST['articlesID'];
  
  // On récupère le titre de la création ou action culturelle en cours de modification (pour le fil d'ariane)
  $requeteTitreFilAriane= (isset($creationsID)) ? "SELECT titre FROM creations WHERE ID =".$ID : "SELECT titre FROM actions_culturelles WHERE ID =".$ID;
  $reponseTitreFilAriane = $bdd->query($requeteTitreFilAriane);
  // On affiche l' entrée
  $donneesTitreFilAriane = $reponseTitreFilAriane->fetch();

  //############### Récupération en GET de l'ID de la création #######################
  
    $requete= "SELECT * FROM articles WHERE ID=".$articlesID;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
        {
        $fichierAsupprimer = "../pdf/" . $donnees["urlArticle"];
        if(file_exists($fichierAsupprimer)) unlink($fichierAsupprimer);
      
        //Requete SQL pour supprimer l'article dans la base
        $req= "DELETE FROM articles WHERE ID = ".$articlesID;    
        $rep= $bdd->query($req) or die(mysql_error());
        $rep-> closeCursor();
        $redirection= (isset($creationsID)) ? "creationsModif.php?ID=".$ID : "actionsCulModif.php?ID=".$ID;
        header("Location:$redirection");
      }
    } // fin du if
  
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer un article</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body class="supp">

  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);

      if(isset($creationsID))
      {
        get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification de la création '.$donneesTitreFilAriane['titre'], 'final' => 'Suppression d\'un article'));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification de l\'action culturelle '.$donneesTitreFilAriane['titre'], 'final' => 'Suppression d\'un article'));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Suppression d'un article</h1>
      <p>Attention, vous allez supprimer l'article de presse suivant :</p>
      <p class="grosTitre"><?php echo $donnees['titre']; ?> <?php echo $donnees['dates']; ?> </p>
      <p>Pour supprimer définitivement cet article, cliquez sur :</p>
      <?php
        if(isset($creationsID))
          {
      ?>
      <p><a href="articlesSupp.php?ID=<?php echo $_GET["ID"];?>&creationsID=<?php echo $donnees["creationsID"];?>&articlesID=<?php echo $donnees['ID'];?>&amp;supp=ok" 
        class="ahref">SUPPRIMER</a></p>
      <?php
        }
        elseif(isset($actions_culturellesID))
          {
      ?>
      <p><a href="articlesSupp.php?ID=<?php echo $_GET["ID"];?>&actions_culturellesID=<?php echo $donnees["actions_culturellesID"];?>&articlesID=<?php echo $donnees['ID'];?>&amp;supp=ok" 
        class="ahref">SUPPRIMER</a></p>
      <?php
        }
      ?>
    </div>
  </div>

</body>
</html>