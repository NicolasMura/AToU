<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["nom"]) AND $_POST["nom"]!="" AND isset($_POST["url"]) AND $_POST["url"]!="")
    {
      $nom = $_POST["nom"];
      $url = $_POST["url"];
      
      $requete="INSERT INTO liens_amis (nom, url) VALUES(?, ?)";
      $req = $bdd->prepare($requete);
      $req->execute(array($nom, $url)) 
        or die(print_r($req->errorInfo()));
      $req->closeCursor();
      header("Location:cieAtouGestion.php");
    }
    else
    {
      $erreur = "Tous les champs sont obligatoires.";
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout d'un lien ami</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('cieAtouGestion.php' => 'Cie AToU', 'final' => 'Ajout d\'un lien ami'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <div class="halfPage filaire">
      <h1>Ajout d'un lien ami</h1>
        
      <form id="form1" name="form1" method="post" action="liensAmisAjout.php">
      <fieldset>
      <legend>Informations sur le lien</legend>        
        <ul>
          <li>   
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?php if(isset($_POST["nom"])) echo $_POST["nom"];?>" required>
          </li>
          <li>   
            <label for="url">URL complète</label>
            <input type="text" name="url" id="url" value="<?php if(isset($_POST["url"])) echo $_POST["url"];?>" required>
          </li>
          
          <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
      
          <li>
            <input type="submit" name="button1" id="button1" value="Ajouter le lien" />
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
    </div>
        
  </div>

</body>
</html>