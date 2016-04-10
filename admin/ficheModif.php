<?php
  include_once ("inc/include.inc.php");

  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_POST['ID'])) $ID = $_POST['ID'];
  if(isset($_GET['creationsID'])) $creationsID = $_GET['creationsID'];
  if(isset($_POST['creationsID'])) $creationsID = $_POST['creationsID'];

  if(isset($_GET['ficheID'])) $ficheID = $_GET['ficheID'];
  if(isset($_POST['ficheID'])) $ficheID = $_POST['ficheID'];

  // On récupère tout le contenu de la table fiche
  $requete="SELECT * FROM fiche WHERE ID =".$ficheID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  // On affiche l' entrée
  $donnees = $reponse->fetch();

  // On récupère le titre de la création ou action culturelle en cours de modification (pour le fil d'ariane)
  $requeteTitreFilAriane="SELECT titre FROM creations WHERE ID =".$ID;
  $reponseTitreFilAriane = $bdd->query($requeteTitreFilAriane);
  // On affiche l' entrée
  $donneesTitreFilAriane = $reponseTitreFilAriane->fetch();

  //############### Insertion des données au clic du formulaire#######################
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
  //############### Récupération dans des variables des données du formulaire ##############################
    $titre = $_POST["titre"];
    $ID = $_POST["ficheID"];
    //---------------------
    $creationsID = $_POST["creationsID"];
  //################# Insertion dans la base données ##############################################################
    $req= $bdd->prepare('UPDATE fiche SET titre = :titre WHERE ID= :ID');

    $req->execute(array(

    'titre' => $titre,
    'ID' => $ID
    ));
    
  //############### Récupération de la dernière creation ID #######################
    //$lastID = $bdd->lastInsertId();
    //echo "<br />ID est : ".$lastID; devient 14
    // envoi à accueil.php
    
    $req->closeCursor(); // Termine le traitement de la requête
    $redirection="creationsModif.php?ID=".$creationsID;
    //header("Location:$redirection");
    header("Location:$redirection");
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>modifier la fiche création</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
        define('Compagnie_ATou', 'Accueil', true);
        get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification de la création '.$donneesTitreFilAriane['titre'], 'final' => 'Modification de la fiche création'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Modifier la fiche création</h1>
      <form name="form1" method="post" action="ficheModif.php">
      <fieldset>
      <legend>Modification de la fiche création</legend>
        <ul>
          <li>
            <label for="titre">Entrez un titre : </label>
            <input type="text" name="titre" id="titre" value="<?php echo $donnees['titre'];?>">
          </li>
          <li>
            <input type="submit" name="button" id="button" value="Modifier la fiche">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
            <input type="hidden" name="creationsID" id="creationsID" value="<?php echo $creationsID; ?>">
            <input type="hidden" name="ficheID" id="ficheID" value="<?php echo $ficheID; ?>">
          </li>
        </ul>
      </form>
    </div>
  </div>
</body>
</html>