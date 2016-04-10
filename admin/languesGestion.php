<?php
  include_once ("inc/include.inc.php");
  
  if(isset($_GET["statut"]) AND $_GET["statut"] == "ON")
  {
    $requete="UPDATE langues SET statut = ?";
    $req = $bdd->prepare($requete);
    $req->execute(array(1)) or die(print_r($req->errorInfo()));
    $req->closeCursor();
  }
  if(isset($_GET["statut"]) AND $_GET["statut"] == "OFF")
  {
    $requete="UPDATE langues SET statut = ?";
    $req = $bdd->prepare($requete);
    $req->execute(array(0)) or die(print_r($req->errorInfo()));
    $req->closeCursor();
  }
  
  $requete='SELECT statut FROM langues';
  $reponse = $bdd->query($requete);
  $donnees = $reponse->fetch();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion des langues</title>
    
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);
      get_fil_ariane(array('final' => 'Gestion des langues'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <h1>Gestion des langues</h1>
    <p>Statut de la gestion des langues : 
    <?php
          if($donnees["statut"] == 0)
      {
        echo "DESACTIV&Eacute;";
    ?>
    <p>Pour activer l'affichage des langues sur le site, <a href="languesGestion.php?statut=ON">cliquez ici</a></p>
    <?php
    }
      else
    {
      echo "ACTIV&Eacute;";
    ?>
    <p>Pour désactiver l'affichage des langues sur le site, <a href="languesGestion.php?statut=OFF">cliquez ici</a></p>
    <?php
      }
    ?>
  </div>

</body>
</html>