<?php
  include_once ("inc/include.inc.php");
  
  // On récupère tout le contenu de la table actualités
  $requete="SELECT * FROM actualites" or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  
  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();
    
  if(isset($_POST['flag']) AND $_POST['flag']==1) 
  {
    $titre = $_POST["titre"];
    $texte = $_POST["texte"];
    
    $req = $bdd->prepare("INSERT INTO actualites (titre, texte) VALUES(:titre, :texte)");
    $req->execute(array(
  
    'titre' => $titre,
    'texte' => $texte
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête
    $reponse->closeCursor();

    $reqEn = $bdd->prepare("INSERT INTO actualites_en (titre, texte) VALUES(:titre, :texte)");
    $reqEn->execute(array(
  
    'titre' => $titre,
    'texte' => $texte
    ));
    
    $reqEn->closeCursor(); // Termine le traitement de la requête

    // envoi à la page gestion.php
    header("Location:actualitesGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout actualité</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
  <!-- Fil d'Arianne -->
  <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('actualitesGestion.php' => 'Gestion des actualités', 'final' => 'Ajout d\'une actualité'));
      ?>
  </div> <!-- fin du fil d'Arianne -->
  
  <?php
  if(!isset($_POST["button"]))
  {
  ?>

  <div class="halfPage filaire">
  <h1>Ajouter la 2ème actualité</h1>
  <p>Une fois votre actualité ajoutée, vous pourrez par la suite ajouter la version anglaise.<br><br>Il vous suffira pour cela de modifier l'actualité que vous venez juste d'ajouter.</p>
  <p>Astuce : ajoutez la balise &lt;br&gt; dans le texte de l'actualité pour simuler un retour à la ligne.</p>
  <form id="form1" name="form1" method="post" action="actualitesAjout.php">
  <fieldset>
  <legend>Informations de l'actualité</legend>
    <ul>
      <li>
        <label for="nom">Entrez un titre : </label>
        <input type="text" name="titre" id="titre" value="<?php if(isset($_POST['titre'])) echo $_POST['titre'];?>" required>
      </li>
      <li>
        <p>Entrez un texte : </p>
        <textarea name="texte" rows="8" cols="45" required><?php if(isset($_POST['titre'])) echo $_POST['texte'];?></textarea>
        </li> 
        <li>  
        <input type="submit" name="button" id="button" value="Ajouter l'actualité">
        </li>
      <li>
        <input type="hidden" name="flag" id="flag" value="1">
        <input type="hidden" name="ID" id="ID" value="<?php if(isset($_POST['ID'])) echo $_POST['ID'];?>">
        </li>
    </ul>
  </fieldset>
  </form>
  </div>
  <?php
  }

  ?>
  </div>
</body>
</html>