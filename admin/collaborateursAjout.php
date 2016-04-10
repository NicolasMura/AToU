<?php
  include_once ("inc/include.inc.php");

  // Ajout collaborateur
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    $req= $bdd->prepare('INSERT INTO collaborateurs (nom, prenom) VALUES (:nom, :prenom)');

    $req->execute(array(

    'nom' => $nom,
    'prenom' => $prenom
    
    
    ));
    header("Location:cieAtouGestion.php");
    $req->closeCursor(); // Termine le traitement de la requête
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout d'un collaborateur</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('cieAtouGestion.php' => 'Gestion de la Cie Atou', 'final' => 'Ajout d\'un collaborateur'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Ajouter un collaborateur</h1>
      <fieldset>
      <legend> Nouveau collaborateur </legend>
      <form name="form1" method="post" action="collaborateursAjout.php">
      <ul>
        <li>
          <label for="nom">Entrez un nouveau nom : </label>
          <input type="text" name="nom" id="nom" required>
        </li>
         <li>
          <label for="nom">Entrez un nouveau prénom : </label>
          <input type="text" name="prenom" id="prenom" required>
        </li>
         <li>
          <input type="submit" name="button" id="button" value="Ajouter le collaborateur">
        </li>
        <li>
          <input type="hidden" name="flag" id="flag" value="1">
        </li>
      </ul>
      </form>
      </fieldset>
    </div>

  </div>
</body>
</html>