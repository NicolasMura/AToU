<?php
  include_once ("inc/include.inc.php");
  
  // Ajout fonction
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    $metiers = $_POST["metiers"];

    $req= $bdd->prepare('INSERT INTO fonctions (metiers) VALUES (:metiers)');
    $req->execute(array(
      'metiers' => $metiers
    ));
    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn= $bdd->prepare('INSERT INTO fonctions_en (metiers) VALUES (:metiers)');
    $reqEn->execute(array(
      'metiers' => $metiers
    ));
    $reqEn->closeCursor(); // Termine le traitement de la requête

    header("Location:cieAtouGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout d'une fonction</title>
  
  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('cieAtouGestion.php' => 'Cie Atou', 'final' => 'Ajout d\' une fonction'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Ajouter une fonction</h1>
      <p>Une fois votre fonction ajoutée, vous pourrez par la suite ajouter la version anglaise.<br><br>Il vous suffira pour cela de modifier la fonction que vous venez juste d'ajouter.</p>
      <fieldset>
      <legend> Nouvelle fonction </legend>
      <form name="form1" method="post" action="fonctionsAjout.php">
      <ul>
        <li>
          <label for="nom">Entrez une nouvelle fonction : </label>
          <input type="text" name="metiers" id="metiers">
        </li>
         <li>
          <input type="submit" name="button" id="button" value="Ajouter la fonction">
        </p>
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