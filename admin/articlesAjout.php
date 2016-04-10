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
  
  // Récupération en GET de l'ID de la création ou de l'action culturelle
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_POST['ID'])) $ID = $_POST['ID'];
  if(isset($_GET['creationsID'])) $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID'])) $actions_culturellesID = $_GET['actions_culturellesID'];

  /* ------------------------------------- Récupération infos création ou action culturelle ----------------------------- */

  // Insertion des données au clic du formulaire
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    // Récupération des infos présentes en bdd :
    if(isset($_POST["creationsID"])) $requete='SELECT ID, titre FROM creations WHERE ID = '.$ID;
    elseif(isset($_POST["actions_culturellesID"])) $requete='SELECT ID, titre FROM actions_culturelles WHERE ID = '.$ID;
    $reponse = $bdd->query($requete);
    $donneesPage = $reponse->fetch();
    
    $reponse->closeCursor();
    
    //############### Récupération dans des variables des données du formulaire ##############################
    $titre = $_POST["titre"];
    $dates = $_POST["dates"];
    if(isset($_POST["creationsID"])) $creationsID = $_POST["creationsID"];
    elseif(isset($_POST["actions_culturellesID"])) $actions_culturellesID = $_POST["actions_culturellesID"];
    
    if(isset($_FILES) )
    {
      // Raccourcis d'écriture pour le fichier reçu
      $pdf = $_FILES['pdf'];
      
      //  Si l'upload du fichier ne génère pas d'erreur, on la traite
      if($_FILES['pdf']['error'][0] == 0)
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
                // Récupération de l'ID du dernier article uploadé
              if(isset($creationsID)) $requeteID='SELECT MAX(ID) FROM articles WHERE creationsID = '.$ID;
              elseif(isset($actions_culturellesID)) $requeteID='SELECT MAX(ID) FROM articles WHERE actions_culturellesID = '.$ID;
              $reponseID = $bdd->query($requeteID);
              $donneesID = $reponseID->fetch();
              $lastIDpdf = intval($donneesID["MAX(ID)"]);
              if($lastIDpdf == 0) $IDpdf = 1; // 1er article uploadé (à améliorer)
              else $IDpdf = $lastIDpdf+1; // Articles suivantes
              $donneesPage['titre'] = nettoyerChaine($donneesPage['titre']); // Nettoyage du nom de la création ou action culturelle pour le fichier
              if(isset($creationsID)) $filenamePdf = "creation_" . $donneesPage['titre'] . "_article_presse_" . $IDpdf . ".pdf";
              elseif(isset($actions_culturellesID)) $filenamePdf = "action_" . $donneesPage['titre'] . "_article_presse_" . $IDpdf . ".pdf";
              
              // Déplacement depuis le répertoire temporaire vers le dossier "pdf"
              $transfert = move_uploaded_file($pdf['tmp_name'], '../pdf/' . $filenamePdf);
              
              // Vérification que le fichier a bien été déplacé
              if($transfert)
              {
                // Ecriture des informations en base de données
                if(isset($creationsID))
                {
                  $req = $bdd->prepare('INSERT INTO articles (titre, dates, urlArticle, creationsID, actions_culturellesID)
                              VALUES (:titre, :dates, :urlArticle, :creationsID, :actions_culturellesID)');
                                  
                  $req->execute(array(
                  'titre' => $titre,
                  'dates' => $dates,
                  'urlArticle' => $filenamePdf,
                  'creationsID' => $ID,
                  'actions_culturellesID' => 0
                  )) or die(print_r($bdd->errorInfo()));
                  $redirection="creationsModif.php?ID=".$ID;
                }
                elseif(isset($actions_culturellesID)) 
                {
                  $req = $bdd->prepare('INSERT INTO articles (titre, dates, urlArticle, creationsID, actions_culturellesID)
                              VALUES (:titre, :dates, :urlArticle, :creationsID, :actions_culturellesID)');
                                  
                  $req->execute(array(
                  'titre' => $titre,
                  'dates' => $dates,
                  'urlArticle' => $filenamePdf,
                  'creationsID' => 0,
                  'actions_culturellesID' => $ID
                  )) or die(print_r($bdd->errorInfo()));
                  $redirection="actionsCulModif.php?ID=".$ID;
                }
                
                // On réinitialise les variables $_POST et $_FILES et on clôt la connexion sql
                unset($_POST);
                unset($_FILES);
                
                $req->closeCursor(); // Termine le traitement de la requête
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
  <title>Ajouter un article</title>

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
  <?php
  if(!isset($_POST["button"]))
  {
  ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       
       if(isset($creationsID))
        {
          get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification d\'une création', 'final' => 'Ajout d\'un article'));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification d\'une action culturelle', 'final' => 'Ajout d\'un article'));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Ajouter un article</h1>
      <form name="form1" method="post" action="articlesAjout.php" enctype="multipart/form-data">
      <fieldset>
      <legend>Ajout d'un article</legend>
        <ul>
          <li>
            <label for="titre">Entrez un titre : </label>
            <input type="text" name="titre" id="titre" required>
          </li>
          <li>
            <label for="datepicker">Entrez une date : </label>
            <input type="date" name="dates" id="datepicker" required/>
          </li>
          <li>
            <label for="pdf" class="textLabel">Article de presse (format .pdf,<br><?php echo ($maxSizePdf/1048576)?> Mo max) :</label>
            <input type="file" name="pdf" id="pdf" accept="application/pdf" required class="button-parcourir">
          <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
          <br>
          <br>
          <li>
            <input type="submit" name="button" id="button" value="Ajouter l'article">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
          </li>
          <li>
            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">
          </li>
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