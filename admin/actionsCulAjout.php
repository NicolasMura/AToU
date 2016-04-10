<?php
  include_once ("inc/include.inc.php");
  
  //############### Insertion des données au clic du formulaire#######################
  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
  //############### Récupération dans des variables des champs créations ##############################
    $titre = $_POST["titre"];
    $statut = $_POST["statut"];
    $anneeCreation = $_POST["anneeCreation"];
    $duree = $_POST["duree"];
    $auteur = $_POST["auteur"];
    $accroche = $_POST["accroche"];
    $titreBloc = "";//$_POST["titreBloc"];
    $chapo = $_POST["chapo"];
    $interTitre = $_POST["interTitre"];
    $resume = $_POST["resume"];
    $resumeMobile = $_POST["resumeMobile"];
    $verbatim = $_POST["verbatim"];
    $verbatimAuteur = $_POST["verbatimAuteur"];
    $urlVideo = $_POST["urlVideo"];
    $notesTitre = $_POST["notesTitre"];
    $notesTexte = $_POST["notesTexte"];
    $notesAuteur = $_POST["notesAuteur"];

    $urlRewrite = nettoyerChaine($titre); // Nettoyage du nom de l'action culturelle pour l'url rewrite
   
    //################ Insertion dans les tables actions_culturelles et actions_culturelles_en #################################
    
    $req= $bdd->prepare('INSERT INTO actions_culturelles (titre, statut, anneeCreation, duree, auteur, accroche, chapo, interTitre, resume, resumeMobile, verbatim, verbatimAuteur, urlVideo, notesTitre, notesTexte, notesAuteur, urlRewrite) VALUES (:titre, :statut, :anneeCreation, :duree, :auteur, :accroche, :chapo, :interTitre, :resume, :resumeMobile, :verbatim, :verbatimAuteur, :urlVideo, :notesTitre, :notesTexte, :notesAuteur, :urlRewrite)');

    $req->execute(array(

    'titre' => $titre,
    'statut' => $statut,
    'anneeCreation' => $anneeCreation,
    'duree' => $duree,
    'auteur' => $auteur,
    'accroche' => $accroche,
    'chapo' => $chapo,
    'interTitre' => $interTitre,
    'resume' => $resume,
    'resumeMobile' => $resumeMobile,
    'verbatim' => $verbatim,
    'verbatimAuteur' => $verbatimAuteur,
    'urlVideo' => $urlVideo,
    'notesTitre' => $notesTitre,
    'notesTexte' => $notesTexte,
    'notesAuteur' => $notesAuteur,
    'urlRewrite' => $urlRewrite
    ));
    
    $lastID = $bdd->lastInsertId();
    /*echo "<br />lastID : ".$lastID;*/
    /*Note : l'ajout de LAST_INSERT_ID() permet d'enregistrer les données dans la table actions_culturelles_en avec le même ID (= le dernier utilisé par MySQL lors de l'insert dans la table actions_culturelles)*/

    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn= $bdd->prepare('INSERT INTO actions_culturelles_en (titre, statut, anneeCreation, duree, auteur, accroche, chapo, interTitre, resume, resumeMobile, verbatim, verbatimAuteur, urlVideo, notesTitre, notesTexte, notesAuteur, urlRewrite) VALUES (:titre, :statut, :anneeCreation, :duree, :auteur, :accroche, :chapo, :interTitre, :resume, :resumeMobile, :verbatim, :verbatimAuteur, :urlVideo, :notesTitre, :notesTexte, :notesAuteur, :urlRewrite)');

    $reqEn->execute(array(

    'titre' => $titre,
    'statut' => $statut,
    'anneeCreation' => $anneeCreation,
    'duree' => $duree,
    'auteur' => $auteur,
    'accroche' => $accroche,
    'chapo' => $chapo,
    'interTitre' => $interTitre,
    'resume' => $resume,
    'resumeMobile' => $resumeMobile,
    'verbatim' => $verbatim,
    'verbatimAuteur' => $verbatimAuteur,
    'urlVideo' => $urlVideo,
    'notesTitre' => $notesTitre,
    'notesTexte' => $notesTexte,
    'notesAuteur' => $notesAuteur,
    'urlRewrite' => $urlRewrite
    ));

    $reqEn->closeCursor(); // Termine le traitement de la requête
    
    // envoi à accueil.php
    $redirection="actionsCulGestion.php?ajout=actionCulturelle";
    header("Location:$redirection");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajouter une action culturelle</title>
  
  <?php include("inc/head.inc.php");?>
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
       get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'final' => 'Ajout d\'une action culturelle'));
    ?>
    <!-- fin du fil d'Arianne -->
    </div>

    <div class="halfPage filaire">
      <h1>Ajouter une action culturelle</h1>
      <p>Une fois votre action culturelle ajoutée, vous pourrez par la suite ajouter des représentations, des articles de presse et un dossier de presse. Vous pourrez également ajouter la version anglaise.<br><br>Il vous suffira pour cela de modifier l'action culturelle que vous venez juste d'ajouter.</p>
      <form name="form1" method="post" action="actionsCulAjout.php">
      <fieldset>
      <legend>Ajout d'une action culturelle</legend>
      <ul>
          <li>
            <label for="titre">Entrez un titre : </label>
            <input type="text" name="titre" id="titre" required>
          </li>
          <li>
            <label for="statut">Choisissez un statut</label>
            <select name="statut" id="statut">
            <option value="actionPresente" selected="selected">action culturelle présente</option>
            <option value="actionActuelle">action culturelle actuelle</option>
            <option value="actionPrecedente">action culturelle précédente</option>
            <option value="actionAvenir">action culturelle à venir</option>
            </select>
          </li>
          <li>
            <label for="anneeCreation">Entrez l'année (optionnel) : </label>
            <input type="text" name="anneeCreation" id="anneeCreation" >
          </li>
          <li> <!--Note Nico : champ pas utilisé pour le moment-->
            <label for="duree">Entrez la durée (optionnel) : </label>
            <input type="text" name="duree" id="duree">
          </li>
          <li>
            <label for="telephone">Nom de l'auteur (optionnel) : </label>
            <input type="text" name="auteur" id="auteur">
          </li>
          <li>
            <label for="accroche">Accroche (250 caractères max, espaces compris) : </label>
            <input type="text" name="accroche" id="accroche" maxlength="100" required>
          </li>
          <br /><br />
          <!--<li>
            <label for="titreBloc">Entrez un sous-titre: </label>
            <input type="text" name="titreBloc" id="titreBloc" required>
          </li>-->
          <li>
            <p>Entrez votre chapo (pour la fiche action culturelle) :</p>
            <textarea name="chapo" rows="8" cols="45">Votre message ici</textarea>
          </li>
          <li>
            <p>Entrez un inter-titre (pour la fiche action culturelle) :</p>
            <textarea name="interTitre" rows="8" cols="45">Votre message ici</textarea>
          </li>
          <br />
          <li>
          <!--<p>Entrez votre résumé (pour la fiche action culturelle) :</p><textarea name="resume" rows="8" cols="45">Votre message ici</textarea>-->
          <!-- jQUERY TEXT EDITOR -->
          
          <p>Entrez votre résumé (pour la fiche action culturelle) :</p>
          <textarea name="resume" class="jqte-test" id="res">Votre résumé ici</textarea>
          
          <script>
          $('.jqte-test').jqte();
            // settings of status
            var jqteStatus = true;
            $(".status").click(function()
            {
              jqteStatus = jqteStatus ? false : true;
              $('.jqte-test').jqte({"status" : jqteStatus})
            });
          </script>
          
          <!-- jQUERY TEXT EDITOR -->
        
          </li>
           <li>
            <p>Entrez votre résumé destiné à la version mobile du site :</p>
            <textarea name="resumeMobile" rows="8" cols="45">Votre message ici</textarea>
          </li>
          <li>
            <p>Entrez un verbatim :</p>
            <textarea name="verbatim" rows="8" cols="45">Votre message ici</textarea>
          </li>
          <li>
            <label for="verbatimAuteur">Entrez l'auteur du verbatim : </label>
            <input type="text" name="verbatimAuteur" id="verbatimAuteur">
          </li>
          <li>
            <label for="mail">Entrez le numéro Vimeo de la video : </label>
            <input type="text" name="urlVideo" id="urlVideo">
          </li>
          <fieldset>
          <legend>Autour de l'action culturelle</legend>
          <li>
            <label for="titre">Entrez un titre : </label>
            <input type="text" name="notesTitre" id="notesTitre">
          </li>
          <li>
            <p>Entrez un texte :</p><textarea name="notesTexte" rows="8" cols="45">Votre message ici</textarea>
          </li>
          <li>
            <label for="telephone">Entrez un auteur : </label>
            <input type="text" name="notesAuteur" id="notesAuteur">
          </li> 

          </fieldset>
          <li>
            <input type="submit" name="button" id="button" value="Ajouter l'action culturelle">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
          </li>
        </ul>
        
      </form>
    </div>
    <?php
      }
    ?>
  </div>
</body>
</html>
