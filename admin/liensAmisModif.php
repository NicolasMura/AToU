<?php
  include_once ("inc/include.inc.php");
  
  // On récupère l'ID du lien à modifier
  if(isset($_GET["lienID"])) $lienID = $_GET["lienID"];
  
  // S'il n'y a rien à récupérer, on redirige vers la gestion de la Cie AToU
  else header("Location:cieAtouGestion.php");
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["nom"]) AND $_POST["nom"]!="" AND isset($_POST["url"]) AND $_POST["url"]!="")
    {
        $nom = $_POST["nom"];
        $url = $_POST["url"];
        
        $requete="UPDATE liens_amis SET nom = ?,url = ? WHERE ID = ".$lienID;
        $req = $bdd->prepare($requete);
        $req->execute(
          array($nom, $url))
           or die(print_r($req->errorInfo()));
        $req->closeCursor();
        header("Location:cieAtouGestion.php");
        
        
    }
    else
    {
      $erreur = "Tous les champs sont obligatoires.";
    }
  }
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  $requeteLien = "SELECT * FROM liens_amis WHERE ID = ".$lienID;
  $reponseLien = $bdd->query($requeteLien);
  
  // Initialisation du tableau contenant les données à afficher sur la page
  $donneesPage = array("nom", "url");
  
  $donneesLien = $reponseLien->fetch();
  $donneesPage["lienID"] = $donneesLien["ID"];
  $donneesPage["nom"] = $donneesLien["nom"];
  $donneesPage["url"] = $donneesLien["url"];
  
  $reponseLien->closeCursor();
  
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification d'un lien ami</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('cieAtouGestion.php' => 'Cie AToU', 'final' => 'Modification d\'un lien ami'));
      ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <div class="halfPage filaire">
      <h1>Modification d'un lien ami</h1>
        
      <form id="form1" name="form1" method="post" action="liensAmisModif.php?lienID=<?php echo $donneesPage["lienID"];?>">
      <fieldset>
      <legend>Informations du lien</legend>        
        <ul>
          <li>   
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?php echo $donneesPage["nom"];?>" required>
          </li>
          <li>   
            <label for="url">URL complète</label>
            <input type="text" name="url" id="url" value="<?php echo $donneesPage["url"];?>" required>
          </li>
          
          <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
      
          <li>
            <input type="submit" name="button1" id="button1" value="Enregistrer les modifications" class="button-grand"/>
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
            <input type="hidden" name="lienID" id="lienID" value="<?php echo $donneesPage["lienID"];?>">
          </li>
        </ul>
      </fieldset>
      </form>
    </div>
        
  </div>

</body>
</html>