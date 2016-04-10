<?php
  include_once ("inc/include.inc.php");
  
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_GET['creationsID']))  $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID']))  $actions_culturellesID = $_GET['actions_culturellesID'];
  
  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['creationsID']) AND isset($_GET['dossierPresseID']))  
  {
    $creationsID = $_GET['creationsID'];
    $dossierPresseID = $_GET['dossierPresseID'];
    if(isset($_GET["version"]) AND $_GET["version"] == "en") $requete="SELECT * FROM dossier_presse_en WHERE ID=".$dossierPresseID;
    else $requete="SELECT * FROM dossier_presse WHERE ID=".$dossierPresseID;;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
        {
        $fichierAsupprimer = "../pdf/" . $donnees["urlDossier"];
        if(file_exists($fichierAsupprimer)) unlink($fichierAsupprimer);
      
        //Requete SQL pour supprimer le dossier de presse dans la base
        if(isset($_GET["version"]) AND $_GET["version"] == "en") $req= $bdd->query("DELETE FROM dossier_presse_en WHERE ID = ".$dossierPresseID) or die(mysql_error());
        else $req= $bdd->query("DELETE FROM dossier_presse WHERE ID = ".$dossierPresseID) or die(mysql_error());
        $req-> closeCursor();
        header("Location:creationsModif.php?ID=".$creationsID);
      }
    } // fin du if
  } // fin du if
  
  //############### Récupération en GET de l'ID de l'action culturelle #######################
  if(isset($_GET['actions_culturellesID']) AND isset($_GET['dossierPresseID']))  
  {
    $actions_culturellesID = $_GET['actions_culturellesID'];
    $dossierPresseID = $_GET['dossierPresseID'];
    if(isset($_GET["version"]) AND $_GET["version"] == "en") $requete="SELECT * FROM dossier_presse_en WHERE ID=".$dossierPresseID;
    else $requete="SELECT * FROM dossier_presse WHERE ID=".$dossierPresseID;
    $reponse = $bdd->query($requete);
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    
    if(isset($_GET['supp']) AND $_GET['supp'] == "ok")
    {

      if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
        {
        $fichierAsupprimer = "../pdf/" . $donnees["urlDossier"];
        if(file_exists($fichierAsupprimer)) unlink($fichierAsupprimer);
      
        //Requete SQL pour supprimer l'article dans la base
        if(isset($_GET["version"]) AND $_GET["version"] == "en") $req= $bdd->query("DELETE FROM dossier_presse_en WHERE ID = ".$dossierPresseID) or die(mysql_error());
        else $req= $bdd->query("DELETE FROM dossier_presse WHERE ID = ".$dossierPresseID) or die(mysql_error());
        $req-> closeCursor();
        header("Location:actionsCulModif.php?ID=".$actions_culturellesID);
      }
    } // fin du if
  } // fin du if
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supprimer le dossier de presse</title>
  
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
        get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification d\'une création', 'final' => 'Suppression du dossier de presse'));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification d\'une action culturelle', 'final' => 'Suppression du dossier de presse'));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="filaire">
      <h1>Suppression du dossier de presse</h1>
      <p>Attention, vous allez supprimer le dossier de presse :</p>
      <p class="grosTitre">
        <?php echo $donnees['titre'];?>
        <?php
          if(isset($_GET['version']) AND $_GET['version'] == "en") echo "(version anglaise)";
          else echo "(version française)";
        ?>
      </p>
      <p>Pour le supprimer définitivement, cliquez sur :</p>
      
      <?php
        if(isset($creationsID))
        {
      ?>
          <p>
            <?php
              if(isset($_GET['version']) AND $_GET['version'] == "en")
              {
            ?>
                <a href="dossierPresseSupp.php?ID=<?php echo $_GET["ID"];?>&creationsID=<?php echo $donnees["creationsID"];?>&dossierPresseID=<?php echo $donnees['ID'];?>&amp;supp=ok&version=en" class="ahref">SUPPRIMER</a>
            <?php
              }
              else
              {
            ?>
                <a href="dossierPresseSupp.php?ID=<?php echo $_GET["ID"];?>&creationsID=<?php echo $donnees["creationsID"];?>&dossierPresseID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a>
            <?php
              }
            ?>
          </p>
      <?php
        }

        elseif(isset($actions_culturellesID))
        {
      ?>
          <p>
            <?php
              if(isset($_GET['version']) AND $_GET['version'] == "en")
              {
            ?>
                <a href="dossierPresseSupp.php?ID=<?php echo $_GET["ID"];?>&actions_culturellesID=<?php echo $donnees["actions_culturellesID"];?>&dossierPresseID=<?php echo $donnees['ID'];?>&amp;supp=ok&version=en" class="ahref">SUPPRIMER</a>
            <?php
              }
              else
              {
            ?>
                <a href="dossierPresseSupp.php?ID=<?php echo $_GET["ID"];?>&actions_culturellesID=<?php echo $donnees["actions_culturellesID"];?>&dossierPresseID=<?php echo $donnees['ID'];?>&amp;supp=ok" class="ahref">SUPPRIMER</a>
            <?php
              }
            ?>
          </p>

      <?php
        }
      ?>
    </div>
  </div>
</body>
</html>