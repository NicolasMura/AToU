<?php
  include_once ("inc/include.inc.php");
  
  // -- debug -- Messages d'erreurs de chargement de fichiers
  $uploadErrors = array(
      0 => "There is no error, the file uploaded with success",
      1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
      2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
      3 => "The uploaded file was only partially uploaded",
      4 => "No file was uploaded",
      6 => "Missing a temporary folder"
  );
    
  $maxSizePdf = 5242880; // Taille max PDF (en octets), 5Mo (POST_MAX_SIZE/8)
  $extensionsValides = array('pdf', 'PDF');
  
  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['ID']))   $ID = $_GET['ID'];
  if(isset($_POST['ID']))   $ID = $_POST['ID'];
  if(isset($_GET['creationsID']))  $creationsID = $_GET['creationsID'];
  
  /* ------------------------------------------- Récupération infos création ----------------------------------- */
  
    // Récupération des infos présentes en bdd :
    $requete='SELECT ID, titre FROM creations WHERE ID = '.$ID;
    $reponse = $bdd->query($requete);
    $donneesPage = $reponse->fetch();
    
    $reponse->closeCursor();
  
  //############### Insertion des données au clic du formulaire#######################
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
  //############### Récupération dans des variables des données du formulaire ##############################
    $titre = $_POST["titre"];
    $creationsID = $_POST["creationsID"];
    
    if(isset($_FILES) )
    {
      // Raccourcis d'écriture pour le fichier reçu
      $pdf = $_FILES['pdf'];
      
      //  Si l'upload du fichier ne génère pas d'erreur, on la traite
      if($_FILES['pdf']['error'] == 0)
      {
        $sizePdf = filesize($pdf['tmp_name']);
        $infosPdf = pathinfo($pdf['name']);
        $extensionPdf = $infosPdf['extension']; // On récupère l'extension du fichier
        
        // On contrôle que le fichier uploadé est bien un fichier PDF et que son extension est valide, que sa taille 
        // ne dépasse pas $maxSizePdf
        if(in_array($extensionPdf, $extensionsValides))
        {
          // On contrôle que la taille du fichier uploadé est valide
          if($sizePdf <= $maxSizePdf)
          {
            
              // Renommage du nom du fichier
              $donneesPage['titre'] = nettoyerChaine($donneesPage['titre']); // Nettoyage du nom de la création pour le fichier
              $filenamePdf = "creation_" . $donneesPage['titre'] . "_fiche.pdf";
              
              // Déplacement depuis le répertoire temporaire vers le dossier "pdf"
              $transfert = move_uploaded_file($pdf['tmp_name'], '../pdf/' . $filenamePdf);
              echo "</p>";
              
              // Vérification que le fichier a bien été déplacé
              if($transfert)
              {
                // Ecriture des informations en base de données
                $req = $bdd->prepare('INSERT INTO fiche (titre, urlFiche, creationsID) VALUES (:titre, :urlFiche, :creationsID)');
                $req->execute(array(
                'titre' => $titre,
                'urlFiche' => $filenamePdf,
                'creationsID' => $ID
                )) or die(print_r($bdd->errorInfo()));
                
                // On réinitialise les variables $_POST et $_FILES et on clôt la connexion sql
                unset($_POST);
                unset($_FILES);
                
                $req->closeCursor(); // Termine le traitement de la requête
                $redirection="creationsModif.php?ID=".$ID;
                header("Location:$redirection");
              }
              else $erreur = "Erreur de transfert : le fichier n'a pas pu être ajouté !";
          }
          else $erreur = "Désolé, le poids du fichier dépasse le maximum autorisé (". ($maxSizePdf/1048576) ."Mo).";
        }
        else $erreur = "Désolé, le format du fichier n'est pas valide (seuls les fichiers .pdf sont autorisés).";
      }
      
      // Sinon, si l'upload du fichier génère une erreur, on l'affiche
      else
      {
        $numeroError = $_FILES['pdf']['error'][$i];
        echo "Problème sur l'upload du fichier : " .  $uploadErrors[$numeroError];
      }
    }
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajouter la fiche création</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>

  <div id="container">
  <!-- Fil d'Arianne -->
  <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);

      get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$ID => 'Modification d\'une création', 'final' => 'Ajout de la fiche création'));
    ?>
  </div> <!-- fin du fil d'Arianne -->

  <div class="halfPage filaire">
    <h1>Ajouter la fiche création</h1>
    <form name="form1" method="post" action="ficheAjout.php" enctype="multipart/form-data">
    <fieldset>
    <legend>Ajout de la fiche création</legend>
    <ul>
      <li>
        <label for="titre">Entrez un titre : </label>
        <input type="text" name="titre" id="titre" required>
      </li>
      <li>
        <label for="pdf" class="textLabel">Fiche création (format .pdf, <?php echo ($maxSizePdf/1048576)?> Mo max) :</label>
        <input type="file" name="pdf" id="pdf" accept="application/pdf" required class="button-parcourir">
      </li>
      <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
      <li>
        <input type="submit" name="button" id="button" value="Ajouter la fiche">
      </li>
      <li>
        <input type="hidden" name="flag" id="flag" value="1">
      </li>
      <li>
        <input type="hidden" name="creationsID" id="creationsID" value="<?php echo $creationsID;?>">
      </li>
      <li>
        <input type="hidden" name="ID" id="ID" value="<?php echo $ID;?>">
      </li>
    </ul>
    </fieldset>
    </form>
  </div>

  </div>
</body>
</html>