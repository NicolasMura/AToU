<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération infos création ----------------------------------- */
  
  if(isset($_GET["ID"]))
  {
    $id = $_GET["ID"];
  }
  else
  {
    header("Location:creationsGestion.php");
  }
  // Récupération des infos présentes en bdd :
  $requete='SELECT ID, titre FROM creations WHERE ID = '.$id;
  $reponse = $bdd->query($requete);
  $donneesPage = $reponse->fetch();
  
  /* ------------------------------------------------- Upload photos pour création ------------------------------------------------- */
  
  // Reste à faire : jouer avec les variables php post_max_size et upload_max_filesize dans
  // le php.ini pour permettre l'upload de plusieurs photos en même temps
  
  // -- debug -- Messages d'erreurs de chargement de fichiers
  $uploadErrors = array(
      0 => "There is no error, the file uploaded with success",
      1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
      2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
      3 => "The uploaded file was only partially uploaded",
      4 => "No file was uploaded",
      6 => "Missing a temporary folder"
  );
  
  $maxSizePhoto = 8388608; // Taille max Photo (en octets), à priori 8Mo (POST_MAX_SIZE)
  $maxWidthPhoto = 5000; // Largeur max Photo (en px)
  $maxHeightPhoto = 5000; // Hauteur max Photo (en px)
  $extensionsValides = array('jpg', 'JPG', 'jpeg', 'JPEG');
  
  // Fonction pour récupérer les valeurs extraites du fichier de configuration PHP (php.ini)
  function return_bytes($val)
  {
    $val = trim($val);
    $unite = strtolower($val{strlen($val)-1});
    switch($unite)
    {
      case 'g':
      $val *= 1024;
      case 'm':
      $val *= 1024;
      case 'k':
      $val *= 1024;
    }
    
    return $val;
  }
  $PHPpostMaxSize = return_bytes(ini_get('post_max_size'))/1048576; // Détection de la taille max de l'upload permis en POST par le serveur PHP (en Mo)
    
  // Création des répertoires cibles si besoin
  /*if(!is_dir("../photosOriginales")) mkdir("../photosOriginales", 0777, true);
  if(!is_dir("../photosVignettes")) mkdir("../photosVignettes", 0777, true);
  if(!is_dir("../photosMobiles")) mkdir("../photosMobiles", 0777, true);
  if(!is_dir("../PhotosVignettesMini")) mkdir("../PhotosVignettesMini", 0777, true);*/ // En beta
  
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    if(isset($_FILES) AND is_array($_FILES) AND !(empty($_FILES['photos']['name']['0'])))
    {
      // Raccourcis d'écriture pour le tableau reçu
      $photos = $_FILES['photos'];
      
      // Boucle itérant sur chacune des photos
      $transfertOK = 0;
      for($i=0 ; $i<count($photos['name']) ; $i++)
      {
        //  Si l'upload de la photo ne génère pas d'erreur, on la traite
        if($_FILES['photos']['error'][$i] == 0)
        {
          $dimensionsPhoto = getimagesize($photos['tmp_name'][$i]);
          $sizePhoto = filesize($photos['tmp_name'][$i]);
          $infosPhoto = pathinfo($photos['name'][$i]);
          $extensionPhoto = $infosPhoto['extension']; // On récupère l'extension de la photo
          
          // On contrôle que le fichier uploadé est bien une photo et que son extension est valide, que sa taille et dimensions 
          // ne dépassent pas $maxSizePhoto et $maxWidthPhoto x $maxHeightPhoto
          if(in_array($extensionPhoto, $extensionsValides))
          {
            // On contrôle que la taille du fichier uploadé est valide
            if($sizePhoto <= $maxSizePhoto)
            {
              if(($dimensionsPhoto[0] <= $maxWidthPhoto) AND ($dimensionsPhoto[1] <= $maxHeightPhoto))
              {
                // Renommage du nom (attribut "alt" de la balise <img>) et du filename de la photo
                  // Récupération de l'ID de la dernière photo uploadée pour la création en cours d'ajout / modif
                $requeteID='SELECT MAX(ID) FROM photos WHERE creationsID = ' . $id;
                $reponseID = $bdd->query($requeteID);
                $donneesID = $reponseID->fetch();
                $lastIDphotos = intval($donneesID["MAX(ID)"]);
                if($lastIDphotos == 0) $IDphoto = 1; // Pour la 1ère photo uploadée pour la création (à améliorer)
                else $IDphoto = $lastIDphotos+1; // Pour les photos suivantes
                
                // On contraint la suite des opérations : si c'est la 1ère photo, on impose un format paysage
                if(($IDphoto == 1 AND $dimensionsPhoto[0] > $dimensionsPhoto[1]) OR $IDphoto > 1)
                {
                  $nomPhoto = "Photo de la création " . $donneesPage['titre'];
                  $donneesPage['titre'] = nettoyerChaine($donneesPage['titre']); // Nettoyage du nom de la création pour la photo
                  $filenamePhoto = "creation_" . $donneesPage['titre'] . "_" . $IDphoto . ".jpg";
                  
                  // Déplacement depuis le répertoire temporaire vers le dossier "photosOriginales"
                  $transfert = move_uploaded_file($photos['tmp_name'][$i], '../photosOriginales/' . $filenamePhoto);
                  echo "</p>";
                  
                  // Vérification que la photo a bien été déplacée
                  if($transfert)
                  {
                    // Ecriture du nom de la photo en base de données
                    $requete='INSERT INTO photos(nom, filename, creationsID) VALUES(?, ?, ?)';
                    $reponse = $bdd->prepare($requete);
                    $reponse->execute(array($nomPhoto, $filenamePhoto, $id)) or die(print_r($bdd->errorInfo()));
                    
                    // Conversion de la photo en version vignette large (champ "creationsID" à mettre à jour !)
                    imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettes/' . $filenamePhoto, 294);
                    
                    // Conversion de la photo en version vignette (champ "creationsID" à mettre à jour !)
                    imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettesLarges/' . $filenamePhoto, 780);
                    
                    // Conversion de la photo en version mobile (champ "creationsID" à mettre à jour !)
                    //imagethumb('../photosOriginales/' . $filenamePhoto, '../photosMobiles/' . $filenamePhoto, 640);
                    
                    // Conversion de la photo en version version vignette mini (champ "creationsID" à mettre à jour !)
                    imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettesMini/' . $filenamePhoto, 200);

                    // Conversion de la photo en version version HD pour Fancybox (champ "creationsID" à mettre à jour !)
                    imagethumb('../photosOriginales/' . $filenamePhoto, '../photosFancybox/' . $filenamePhoto, 1920);
                    
                    $transfertOK++;
                  }
                  else $erreur = "Erreur de transfert : la photo n'a pas pu être ajoutée !";
                }
                else $erreur = "Désolé, la 1ère photo enregistréé doit être au format paysage.";
              }
              else $erreur = "Désolé, les dimensions de la photo dépassent le maximum autorisé.";
            }
            else $erreur = "Désolé, le poids de la photo dépasse le maximum autorisé (". ($maxSizePhoto/1048576) ."Mo).";
          }
          else $erreur = "Désolé, le format du fichier n'est pas valide (seuls les fichiers .jpg sont autorisés).";
        }
        
        // Sinon, si l'upload de la photo génère une erreur, on l'affiche
        else
        {
          $numeroError = $_FILES['photos']['error'][$i];
          echo "Problème sur l'upload de la photo n°" . ($i+1) . " : " .  $uploadErrors[$numeroError];
        }
      }
      
      // Si au moins une photo a été correctement traitée, on réinitialise les variables $_POST et $_FILES et on clôt la connexion sql
      if($transfertOK > 0)
      {
        if($transfertOK == 1) $messageOK = "Vous avez ajouté 1 nouvelle photo.";
        if($transfertOK >= 2) $messageOK = "Vous avez ajouté " . $transfertOK . " nouvelles photos.";
        
        unset($_POST);
        unset($_FILES);
        $reponse->closeCursor();
      }
    }
    else $erreur = "Vous devez ajouter une création avant d'uploader une photo.";
  }
  
  // On avertit l'utilisateur que son upload ne doit pas dépasser un maximum (qui correspond à POST_MAX_SIZE)
  $avertissement = "Note importante : chaque upload ne peut excéder " . $PHPpostMaxSize . "Mo.";
  
  /* ------------------------------------------------- Suppression photos de la création -------------------------------------------- */
  
  // On vérifie l'envoi du formulaire... 
  if( isset($_POST["button2"]))
  {
    // ...et qu'il y au moins une photo de cochée
    if(count($_POST)>1)
    {
      // On récupère le tableau des photos à supprimer et on supprime la dernière ligne du tableau $photoAsupprimer  
      // (qui correspond à la clé [button2]) afin de ne pas générer une fausse requête SQL
      $IDsPhotoAsupprimer = $_POST;
      unset($IDsPhotoAsupprimer[array_search("Supprimer la sélection", $IDsPhotoAsupprimer)]);
      
      foreach($IDsPhotoAsupprimer as $element)
      {
        // Suppression des fichiers sur le serveur
        $requete='SELECT filename FROM photos WHERE ID = ' . $element;
        $reponse = $bdd->query($requete);
        $donnees = $reponse->fetch();
        if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
        {
          $fichierAsupprimer1 = "../photosOriginales/" . $donnees["filename"];
          $fichierAsupprimer2 = "../photosVignettes/" . $donnees["filename"];
          $fichierAsupprimer3 = "../photosVignettesLarges/" . $donnees["filename"];
          $fichierAsupprimer4 = "../photosVignettesMini/" . $donnees["filename"];
          $fichierAsupprimer5 = "../photosMobiles/" . $donnees["filename"];
          $fichierAsupprimer6 = "../photosMobilesVignette/" . $donnees["filename"];
          $fichierAsupprimer4 = "../photosFancybox/" . $donnees["filename"];
          if(file_exists($fichierAsupprimer1)) unlink($fichierAsupprimer1);
          if(file_exists($fichierAsupprimer2)) unlink($fichierAsupprimer2);
          if(file_exists($fichierAsupprimer3)) unlink($fichierAsupprimer3);
          if(file_exists($fichierAsupprimer4)) unlink($fichierAsupprimer4);
          if(file_exists($fichierAsupprimer5)) unlink($fichierAsupprimer5);
          if(file_exists($fichierAsupprimer6)) unlink($fichierAsupprimer6);
          if(file_exists($fichierAsupprimer7)) unlink($fichierAsupprimer7);
            
          // Suppression de l'entrée correspondante en base de données
          $requete='DELETE FROM photos WHERE photos.ID = ?';
          $suppression = $bdd->prepare($requete);
          $suppression->execute(array($element)) or die(print_r($bdd->errorInfo()));
        }
      }
    }
    else $erreur = "Vous devez sélectionner au moins une photo pour la supprimer.";
  }
  
  /* ------------------------------------------------- Recensement photos uploadées pour création ---------------------------------- */
  
  // Récupération des éventuelles photos présentes en bdd :
  $requete='SELECT ID, filename FROM photos WHERE creationsID = '.$id.' ORDER BY ID';
  $reponse = $bdd->query($requete);
  $nombrePhotos = $reponse->rowCount();
  
  if($nombrePhotos > 0)
  { 
    $requete="UPDATE creations SET active = ? WHERE ID = ".$id;
    $req = $bdd->prepare($requete);
    $req->execute(array(1)) or die(print_r($req->errorInfo()));
    $req->closeCursor();

    $requeteEn="UPDATE creations_en SET active = ? WHERE ID = ".$id;
    $reqEn = $bdd->prepare($requeteEn);
    $reqEn->execute(array(1)) or die(print_r($reqEn->errorInfo()));
    $reqEn->closeCursor();
    
    $i=0;
    $pathPhoto = array();
    $IDphoto = array();
    $numPhoto = array();
    while($donnees = $reponse->fetch())
    {
      $pathPhoto[$i] = "../photosVignettesMini/" . $donnees["filename"];
      $IDphoto[$i] = $donnees["ID"];
      $numPhoto[$i] = $i+1;
      $i++;
    }
  }
  else
  {
    $requete="UPDATE creations SET active = ? WHERE ID = ".$id;
    $req = $bdd->prepare($requete);
    $req->execute(array(0)) or die(print_r($req->errorInfo()));
    $req->closeCursor();

    $requeteEn="UPDATE creations SET active = ? WHERE ID = ".$id;
    $reqEn = $bdd->prepare($requeteEn);
    $reqEn->execute(array(0)) or die(print_r($reqEn->errorInfo()));
    $reqEn->closeCursor();
    
    $pasDePhoto = "</p>Vous n'avez pas encore de photos pour cette création.</p>";
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajouter des photos à la création</title>
    
  <?php include("inc/head.inc.php");?>
</head>

<body>
  
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('creationsGestion.php' => 'Créations', 'final' => 'Gestion des photos de '.$donneesPage["titre"]));
    ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <div class="halfPage filaire">
      <h1>Ajouter une photo à la création</h1>
      
      <?php //echo "memory_limit : ".ini_get('memory_limit');?>
      <p><b><?php echo $avertissement;?></b></p>
      <p>Pour chaque création, la 1ère photo uploadée doit être au format paysage.</p>
      <p>Pour un affichage optimal sur le site, le format des photos préconisé est de 2/3. </p>
      <form id="form1" action="creationsPhotosGestion.php?ID=<?php echo $donneesPage["ID"];?>" method="post" enctype="multipart/form-data" >
        <p>
          <!--<input type="hidden"> Restriction taille totale des fichiers uploadés à 10Mo : name="MAX_FILE_SIZE" value="10485760" -->
          <label for="photos" class="textLabel">Photos à uploader (format .jpg, résolution maximale 
                              <?php echo ($maxWidthPhoto)?> x <?php echo ($maxHeightPhoto)?>, <?php echo ($maxSizePhoto/1048576)?>Mo max) :</label>
          <input type="file" name="photos[]" id="photos" accept="image/jpg" multiple required class="button-parcourir">
        </p>
        <input type="submit" name="button" id="button" value="Ajouter à la création">
        <input type="hidden" name="flag" id="flag" value="1">
        <!--<input type="hidden" name="creationOK" id="creationOK" value="<?php //echo $creationOK;?>">-->
      </form>
      
      <?php if(isset($messageOK)) echo "<p class='success'>" . $messageOK . "</p>";?>
      <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
    </div>

    <form class="formCheckbox" id="form2" action="creationsPhotosGestion.php?ID=<?php echo $donneesPage["ID"];?>" method="post" enctype="multipart/form-data" >
      <?php
        // S'il existe des photos de la création en base de données, on les affiche
        if(isset($pathPhoto))
        {
          echo "<p>Vous avez " . $nombrePhotos . " photo(s) enregistrée(s) pour cette création :</p>";
          $k=0;
          foreach($pathPhoto as $element)
          {
        ?>
        <div>
            <label for="suppPhoto<?php echo $numPhoto[$k];?>"><img src="<?php echo $pathPhoto[$k];?>" /></label><br />
            <input type="checkbox" name="suppPhoto<?php echo $numPhoto[$k];?>" 
                   id="suppPhoto<?php echo $numPhoto[$k];?>" value="<?php echo $IDphoto[$k];?>" >
        </div>
        <?php
          $k++;
          }
          echo '<br /><input type="submit" name="button2" id="button2" value="Supprimer la sélection">';
        }
        else
        {
          echo $pasDePhoto;
        }
      ?>
    </form>
  </div>
    
</body>
</html>