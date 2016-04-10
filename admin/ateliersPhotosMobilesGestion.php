<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération infos création ----------------------------------- */
  
  if(isset($_GET["ID"]))
  {
    $id = $_GET["ID"];
  }
  else
  {
    //header("Location:creationsGestion.php");
  }
  // Récupération des infos présentes en bdd :
  $requete='SELECT ID, titre FROM ateliers WHERE ID = '.$id;
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
  
  /*echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    if(isset($_FILES) AND is_array($_FILES) AND !(empty($_FILES['photos']['name'])))
    {
      // Raccourcis d'écriture pour le tableau reçu
      $photos = $_FILES['photos'];
      
      //  Si l'upload de la photo ne génère pas d'erreur, on la traite
      if($_FILES['photos']['error'][0] == 0)
      {
        $dimensionsPhoto = getimagesize($photos['tmp_name'][0]);
        $sizePhoto = filesize($photos['tmp_name'][0]);
        $infosPhoto = pathinfo($photos['name'][0]);
        
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
              // On on impose un format paysage
              if($dimensionsPhoto[0] > $dimensionsPhoto[1])
              {
                $nomPhoto = "Photo atelier " . $donneesPage['titre'];
                $donneesPage['titre'] = nettoyerChaine($donneesPage['titre']); // Nettoyage du nom de la création pour la photo
                $filenamePhoto = "mobile_atelier_" . $donneesPage['titre'] . ".jpg";
                
                // Déplacement depuis le répertoire temporaire vers le dossier "photosOriginales"
                $transfert = move_uploaded_file($photos['tmp_name'][0], '../photosOriginales/' . $filenamePhoto);
                echo "</p>";
                
                // Vérification que la photo a bien été déplacée
                if($transfert)
                {
                  // Ecriture du nom de la photo en base de données
                  $requete='UPDATE ateliers SET filenamePhotoMobile = ? WHERE ID = '.$id;
                  $reponse = $bdd->prepare($requete);
                  $reponse->execute(array($filenamePhoto)) or die(print_r($bdd->errorInfo()));
                  
                  // Conversion de la photo en version vignette large (champ "creationsID" à mettre à jour !)
                  //imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettes/' . $filenamePhoto, 294);
                  
                  // Conversion de la photo en version vignette (champ "creationsID" à mettre à jour !)
                  //imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettesLarges/' . $filenamePhoto, 780);
                  
                  // Conversion de la photo en version mobile (champ "creationsID" à mettre à jour !)
                  imagethumb('../photosOriginales/' . $filenamePhoto, '../photosMobiles/' . $filenamePhoto, 640);
                  
                  // Conversion de la photo en version version vignette mini (champ "creationsID" à mettre à jour !)
                  imagethumb('../photosOriginales/' . $filenamePhoto, '../photosVignettesMini/' . $filenamePhoto, 200);
                  
                  $transfertOK = 1;
                }
                else $erreur = "Erreur de transfert : la photo n'a pas pu être ajoutée !";
              }
              else $erreur = "Désolé, la photo enregistrée doit être au format paysage.";
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
        $numeroError = $_FILES['photos']['error'][0];
        echo "Problème sur l'upload de la photo : " .  $uploadErrors[$numeroError];
      }
      
      
      // Si la photo a été correctement traitée, on réinitialise les variables $_POST et $_FILES et on clôt la connexion sql
      if($transfertOK == 1)
      {
        $messageOK = "Vous avez ajouté la nouvelle photo pour le site mobile.";
        
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
  if(isset($_POST["button2"]))
  {
    // ...et que la photo est cochée
    if(count($_POST)>1)
    {
      // On récupère la photo à supprimer et on la supprime en bdd  
      // (qui correspond à la clé [button2]) afin de ne pas générer une fausse requête SQL
      $requete='SELECT filenamePhotoMobile FROM ateliers WHERE ID = ' . $id;
      $reponse = $bdd->query($requete);
      $donnees = $reponse->fetch();
      
      if($donnees) // Vérif supplémentaire pour correction bug de réactualisation de page juste après la suppression en bdd
      {
        // Suppression du fichier sur le serveur        
        $fichierAsupprimer1 = "../photosOriginales/" . $donnees["filenamePhotoMobile"];
        $fichierAsupprimer2 = "../photosVignettes/" . $donnees["filenamePhotoMobile"];
        $fichierAsupprimer3 = "../photosVignettesLarges/" . $donnees["filenamePhotoMobile"];
        $fichierAsupprimer4 = "../photosVignettesMini/" . $donnees["filenamePhotoMobile"];
        $fichierAsupprimer5 = "../photosMobiles/" . $donnees["filenamePhotoMobile"];
        $fichierAsupprimer6 = "../photosMobilesVignette/" . $donnees["filenamePhotoMobile"];
        if(file_exists($fichierAsupprimer1)) unlink($fichierAsupprimer1);
        if(file_exists($fichierAsupprimer2)) unlink($fichierAsupprimer2);
        if(file_exists($fichierAsupprimer3)) unlink($fichierAsupprimer3);
        if(file_exists($fichierAsupprimer4)) unlink($fichierAsupprimer4);
        if(file_exists($fichierAsupprimer5)) unlink($fichierAsupprimer5);
        if(file_exists($fichierAsupprimer6)) unlink($fichierAsupprimer6);
          
        // Suppression de l'entrée correspondante en base de données
        $requete='UPDATE ateliers SET filenamePhotoMobile = ? WHERE ID = '.$id;
        $suppression = $bdd->prepare($requete);
        $suppression->execute(array(NULL)) or die(print_r($bdd->errorInfo()));
      }
    
    }
    else $erreur = "Vous devez sélectionner la photo pour la supprimer.";
  }
  
  /* ------------------------------------------------- Recensement photos uploadées pour création ---------------------------------- */
  
  // Récupération de l'éventuelle photo présente en bdd :
  $requete='SELECT filenamePhotoMobile FROM ateliers WHERE ID = '.$id;
  $reponse = $bdd->query($requete);
  $donnees = $reponse->fetch();
  $nombrePhotos = $reponse->rowCount();
  
  /*echo $nombrePhotos;
  echo "<pre>";
  print_r($donnees);
  echo "</pre>";*/

  if($donnees["filenamePhotoMobile"] != NULL)
  { 
    $pathPhoto = "../photosVignettesMini/" . $donnees["filenamePhotoMobile"];
  }
  else
  {
    $pasDePhoto = "</p>Vous n'avez pas encore de photo pour cette création pour le site mobile.</p>";
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout photos ateliers</title>
    
  <?php include("inc/head.inc.php");?>
</head>

<body>
  
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
    
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérent', 'ateliersGestion.php' => 'Ateliers', 'final' => 'Gestion des photos de '.$donneesPage["titre"]));
      ?>
    </div> <!-- fin du fil d'Arianne -->
        
    <div class="halfPage filaire">
      <h1>Ajouter une photo à l'atelier</h1>
      <?php //echo "memory_limit : ".ini_get('memory_limit');?>
      <p><b><?php echo $avertissement;?></b></p>
      <p>La photo uploadée doit être au format paysage.</p>
      <form id="form1" action="ateliersPhotosMobilesGestion.php?ID=<?php echo $donneesPage["ID"];?>" method="post" enctype="multipart/form-data" >
        <p>
          <label for="titre">Atelier sélectionné : </label>
          <p><?php echo $donneesPage["titre"];?></p>
        </p>
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
        
      <form class="formCheckbox" id="form2" action="ateliersPhotosMobilesGestion.php?ID=<?php echo $donneesPage["ID"];?>" method="post" enctype="multipart/form-data" >
        <?php
          // Si la photo existe, en base de données, on l'affiche
          if($donnees["filenamePhotoMobile"] != "")
          {
            echo "<p>Vous avez 1 photo enregistrée pour cette atelier :</p>";
          ?>
          <div>
              <label for="suppPhoto"><img src="<?php echo $pathPhoto;?>" /></label><br />
              <input type="checkbox" name="suppPhoto" id="suppPhoto" value="0" >
          </div>
          <?php
            echo '<br /><input type="submit" name="button2" id="button2" value="Supprimer la photo">';
          }
          else
          {
            echo $pasDePhoto;
          }
        ?>
      </form>
    </div>
  </div>

</body>
</html>