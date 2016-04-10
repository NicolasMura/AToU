<?php
  include_once ("inc/include.inc.php");
  
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_GET['creationsID']))  $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID']))  $actions_culturellesID = $_GET['actions_culturellesID'];
  
  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['creationsID']) AND isset($_GET['representationsID']))  
  {
    $creationsID = $_GET['creationsID'];
    $representationsID = $_GET['representationsID'];
    $requete="SELECT * FROM representations WHERE ID=".$representationsID;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      //Requete SQL pour supprimer la représentation dans la base
      $req= $bdd->query("DELETE FROM representations WHERE ID = ".$representationsID) or die(mysql_error());
      $req-> closeCursor();
      header("Location:creationsModif.php?ID=".$creationsID);
    } // fin du if
  } // fin du if
  
  //############### Récupération en GET de l'ID de l'action culturelle #######################
  if(isset($_GET['actions_culturellesID']) AND isset($_GET['representationsID']))  
  {
    $actions_culturellesID = $_GET['actions_culturellesID'];
    $representationsID = $_GET['representationsID'];
    $requete="SELECT * FROM representations WHERE ID=".$representationsID;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      //Requete SQL pour supprimer la représentation dans la base
      $req= $bdd->query("DELETE FROM representations WHERE ID = ".$representationsID) or die(mysql_error());
      $req-> closeCursor();
      header("Location:actionsCulModif.php?ID=".$actions_culturellesID);
    } // fin du if
  } // fin du if
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
      if(isset($creationsID))
      {
        get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification d\'une création', 'final' => 'Suppression d\'une représentation'));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification d\'une action culturelle', 'final' => 'Suppression d\'une représentation'));
      }
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="filaire">
      <h1>Suppression d'une représentation</h1>
      <p>Attention, vous allez supprimer la réprésentation :</p>
      <p class="grosTitre"><?php echo $donnees['salle']; ?> <?php echo $donnees['ville']; ?> <?php echo $donnees['pays']; ?> <?php echo $donnees['dates']; ?></p>
      <p>Pour supprimer définitivement cette représentation, cliquez sur :</p>
      <?php
        if(isset($creationsID))
          {
      ?>
      <p><a href="representationsSupp.php?creationsID=<?php echo $donnees["creationsID"]?>&representationsID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
      <?php
        }
        elseif(isset($actions_culturellesID))
          {
      ?>
      <p><a href="representationsSupp.php?actions_culturellesID=<?php echo $donnees["actions_culturellesID"]?>&representationsID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
      <?php
        }
      ?>
    </div>
  </div>
</body>
</html>