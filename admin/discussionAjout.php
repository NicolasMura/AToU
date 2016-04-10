<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["discussionTitre"]) AND $_POST["discussionTitre"]!=""
      AND isset($_POST["discussionTexte"]) AND $_POST["discussionTexte"]!=""
      AND isset($_POST["discussionAuteur"]) AND $_POST["discussionAuteur"]!="")
    {
      $titre = $_POST["discussionTitre"];
      $texte = $_POST["discussionTexte"];
      $auteur = $_POST["discussionAuteur"];
      
      $requete="INSERT INTO discussions (titre, texte, auteur) VALUES(?, ?, ?)";
      $req = $bdd->prepare($requete);
      $req->execute(array($titre, $texte, $auteur)) or die(print_r($req->errorInfo()));
      $req->closeCursor();
      header("Location:discussionGestion.php");
    }
    else
    {
      $erreurTexte = "Vous devez entrer un titre, une description et auteur avant de valider.";
    }
  }

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion du carnet de bord</title>
    
    <?php include("inc/head.inc.php");?>

    <style>
      textarea{
        width: 200px;
      }
    </style>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'discussionGestion.php' => 'Gestion du carnet de bord', 'final' => 'Création d\'une nouvelle discussion'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Création d'une nouvelle discussion</h1>
      
      <p>Attention, la création d'une nouvelle discussion ne sera activée qu'une fois le forumulaire validé.</p>
      
      <form id="form1" name="form1" method="post" action="discussionAjout.php">
      <fieldset>
      <legend>Création de la nouvelle discussion</legend>        
        <ul>
          <li>   
            <label for="discussionTitre">Titre</label>
            <input type="text" name="discussionTitre" id="discussionTitre"
                 value="<?php if(isset($_POST["discussionTitre"])) echo $_POST["discussionTitre"];?>" required>
          </li>
          <li>
            <label for="discussionTexte">Description</label>
            <textarea name="discussionTexte" class="jqte-test" id="discussionTexte"><?php if(isset($_POST["discussionTexte"])) echo $_POST["discussionTexte"];?></textarea>
          </li>
          <li>   
            <label for="discussionAuteur">Auteur</label>
            <input type="text" name="discussionAuteur" id="discussionAuteur"
                   value="<?php if(isset($_POST["discussionAuteur"])) echo $_POST["discussionAuteur"];?>" required>
          </li>
  
          <?php if(isset($messageTexteOK)) echo "<p class='success'>" . $messageTexteOK . "</p>";?>
                  <?php if(isset($messageAvertissement)) echo "<p class='success'>" . $messageAvertissement. "</p>";?>
          <?php if(isset($erreurTexte)) echo "<p class='erreur'>" . $erreurTexte . "</p>";?>
      
          <li>
            <input type="submit" name="button1" id="button1" value="Valider la discussion" />
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