<?php
    include_once ("inc/include.inc.php");
    
    //On récupère l'ID dans la barre d'adresse
    if(isset($_GET['ID']))   $ID = $_GET['ID'];
    if(isset($_POST['ID']))   $ID = $_POST['ID'];
    
    // On récupère tout le contenu des tables actualites et actualites_en
    $requete="SELECT * FROM actualites WHERE ID = ".$ID;
    $reponse = $bdd->query($requete);
    $requeteEn="SELECT * FROM actualites_en WHERE ID = ".$ID;
    $reponseEn = $bdd->query($requeteEn);
    
    // On affiche chaque entrée une à une
    $donnees = $reponse->fetch();
    $donneesEn = $reponseEn->fetch();
        
    if(isset($_POST['flag']) AND $_POST['flag']==1 AND (isset($ID)) AND ($ID != "")) 
    {
      $titre = $_POST["titre-fr"];
      $titreEn = ($_POST["titre-en"] != "") ? $_POST["titre-en"] : $_POST["titre-fr"];
      $texte = $_POST["texte-fr"];
      $texteEn = ($_POST["texte-en"] != "") ? $_POST["texte-en"] : $_POST["texte-fr"];
      
      $req = $bdd->prepare("UPDATE actualites SET titre = :titre, texte = :texte WHERE ID = :ID");
      $req->execute(array(
    
        'titre' => $titre,
        'texte' => $texte,
        'ID' => $ID
        ));
        
      $req->closeCursor(); // Termine le traitement de la requête
      $reponse->closeCursor();

      $reqEn = $bdd->prepare("UPDATE actualites_en SET titre = :titreEn, texte = :texteEn WHERE ID = :ID");
      $reqEn->execute(array(
    
        'titreEn' => $titreEn,
        'texteEn' => $texteEn,
        'ID' => $ID
        ));
        
      $reqEn->closeCursor(); // Termine le traitement de la requête
      $reponseEn->closeCursor();

      // envoi à la page gestion.php
      header("Location:actualitesGestion.php");
    }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification actualité</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
        <?php
           define('Compagnie_ATou', 'Accueil', true);
           get_fil_ariane(array('actualitesGestion.php' => 'Gestion des actualités', 'final' => 'Modification d\'une actualité'));
        ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <?php
    if(!isset($_POST["button"]))
    {
    ?>
    <div class="halfPage filaire">
      <h1>Modifier l'actualité</h1>
      <p>Astuce : ajoutez la balise &lt;br&gt; dans le texte de l'actualité pour simuler un retour à la ligne.</p>
      <?php include('inc/choix-langue.php');?>
      <form id="form1" name="form1" method="post" action="actualitesModif.php">
      <fieldset>
      <legend>Informations de l'actualité</legend>
      <ul>
        <li>
          <label for="nom">Entrez un titre : </label>
          <input type="text" name="titre-fr" id="titre-fr" value="<?php echo $donnees['titre'];?>" required>
          <input type="text" name="titre-en" id="titre-en" value="<?php echo $donneesEn['titre'];?>">
        </li>
        <li>
          <p>Entrez un texte : </p>
          <textarea name="texte-fr" id="texte-fr" rows="8" cols="45" required><?php echo $donnees['texte'];?></textarea>
          <textarea name="texte-en" id="texte-en" rows="8" cols="45"><?php echo $donneesEn['texte'];?></textarea>
          </li>
          <li>  
          <input type="submit" name="button" id="button" value="Enregistrer les modifications" class="button-grand">
          </li>
          <li>
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID']; ?>">
          </li>
      </ul>
      </fieldset>
      </form>
    </div>
    <?php
    }

    ?>
  </div>

  <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/admin/tools/toolsLang.js" charset="utf-8"></script>

</body>
</html>