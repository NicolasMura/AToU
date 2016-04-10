<?php
  include_once ("inc/include.inc.php");
  
  //############### Récupération en GET de l'ID de la création  #######################
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_POST['ID'])) $ID = $_POST['ID'];
  if(isset($_GET['creationsID'])) $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID'])) $actions_culturellesID = $_GET['actions_culturellesID'];
  if(isset($_POST['creationsID'])) $creationsID = $_POST['creationsID'];
  if(isset($_POST['actions_culturellesID'])) $actions_culturellesID = $_POST['actions_culturellesID'];

  if(isset($_GET['articlesID'])) $articlesID = $_GET['articlesID'];
  if(isset($_POST['articlesID'])) $articlesID = $_POST['articlesID'];

  // On récupère tout le contenu de la table articles
  $requete="SELECT * FROM articles WHERE ID =".$articlesID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  // On affiche l' entrée
  $donnees = $reponse->fetch();

  // On récupère le titre de la création ou action culturelle en cours de modification (pour le fil d'ariane)
  $requeteTitreFilAriane= (isset($creationsID)) ? "SELECT titre FROM creations WHERE ID =".$ID : "SELECT titre FROM actions_culturelles WHERE ID =".$ID;
  $reponseTitreFilAriane = $bdd->query($requeteTitreFilAriane);
  // On affiche l' entrée
  $donneesTitreFilAriane = $reponseTitreFilAriane->fetch();

  //############### Insertion des données au clic du formulaire#######################
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    //############### Récupération dans des variables des données du formulaire ##############################
    $titre = $_POST["titre"];
    $dates = $_POST["dates"];
    $articleID = $_POST["articlesID"];
    //---------------------
    $creationsID = $_POST["creationsID"];
    //################# Insertion dans la base données ##############################################################
    $req= $bdd->prepare('UPDATE articles SET titre = :titre, dates = :dates WHERE ID= :articleID');

    $req->execute(array(

    'titre' => $titre,
    'dates' => $dates,
    'articleID' => $articleID
    ));
    
    //############### Récupération de la dernière creation ID #######################
    //$lastID = $bdd->lastInsertId();
    //echo "<br />ID est : ".$lastID; devient 14
    // envoi à accueil.php
    
    $req->closeCursor(); // Termine le traitement de la requête
    if(isset($_POST['creationsID'])) $redirection="creationsModif.php?ID=".$creationsID;
    elseif(isset($_POST['actions_culturellesID'])) $redirection="actionsCulModif.php?ID=".$actions_culturellesID;
    //header("Location:$redirection");
    header("Location:$redirection");
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>modifier un article</title>
    
  <?php include("inc/head.inc.php");?>
   
  <script>
    $(function() {
      $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
      $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
    });
  </script>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);
       
      if(isset($creationsID))
      {
        get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification de la création '.$donneesTitreFilAriane['titre'], 'final' => 'Modification de l\'article '.$donnees['titre']));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification de l\'action culturelle '.$donneesTitreFilAriane['titre'], 'final' => 'Modification de l\'article '.$donnees['titre']));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->
  
    <div class="halfPage filaire">
      <h1>Modifier un article</h1>
      <form name="form1" method="post" action="articlesModif.php">
      <fieldset>
      <legend>Modification d'un article</legend>
        <ul>
          <li>
            <label for="titre">Entrez un titre : </label>
            <input type="text" name="titre" id="titre" value="<?php echo $donnees['titre'];?>">
          </li>
          <li>
            <label for="datepicker">Entrez une date : </label>
            <input type="date" name="dates" id="datepicker"  value="<?php echo $donnees['dates'];?>" required/>
          </li>
          <li>
            <input type="submit" name="button" id="button" value="Modifier l'article">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">
            <input type="hidden" name="articlesID" id="articlesID" value="<?php echo $articlesID; ?>">
            <li>
            <?php
              if(isset($creationsID))
              {
            ?>
              <input type="hidden" name="creationsID" id="creationsID" value="<?php echo $creationsID; ?>">
            <?php
              }
              elseif(isset($actions_culturellesID))
              {
            ?>
              <input type="hidden" name="actions_culturellesID" id="actions_culturellesID" value="<?php echo $actions_culturellesID; ?>">
            <?php
              }
            ?>
            </li>
          </li>
        </ul>
      </form>
    </div>
  </div>
  
</body>
</html>