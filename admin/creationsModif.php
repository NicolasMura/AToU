<?php
  include_once ("inc/include.inc.php");

  //On récupère l'ID de la création dans la barre d'adresse
  
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  elseif(isset($_POST['ID'])) $ID = $_POST['ID'];
  elseif(isset($_GET['creationsID'])) $ID = $_GET['creationsID'];
  elseif(isset($_POST['creationsID'])) $ID = $_POST['creationsID'];
  else header("location:gestionCreations.php");

  // Récupération de la liste des métiers disponibles en bdd (table fonctions)

  $requeteFonctions = "SELECT ID, metiers FROM fonctions";
  $reponseFonctions = $bdd->query($requeteFonctions);
  while($donneesFonctions = $reponseFonctions->fetch())
  {
    $donnees["fonctions"][] = $donneesFonctions;
  }
  $reponseFonctions->closeCursor(); // Termine le traitement de la requête

  // Update de la création

  if(isset($_POST['flag']) AND $_POST['flag']==1 AND (isset($ID)) AND ($ID != "")) 
  {
    $statut = $_POST["statut"];
    $type = $_POST["type-fr"];
    $typeEn = ($_POST["type-en"] != "") ? $_POST["type-en"] : $_POST["type-fr"];
    $anneeCreation = $_POST["anneeCreation"];
    $duree = $_POST["duree"];
    $auteur = $_POST["auteur"];
    $accroche = $_POST["accroche-fr"];
    $accrocheEn = ($_POST["accroche-en"] != "") ? $_POST["accroche-en"] : $_POST["accroche-fr"];
    $titreBloc = "";//$_POST["titreBloc"];
    $chapo = $_POST["chapo-fr"];
    $chapoEn = ($_POST["chapo-en"] != "") ? $_POST["chapo-en"] : $_POST["chapo-fr"];
    $interTitre = $_POST["interTitre-fr"];
    $interTitreEn = ($_POST["interTitre-en"] != "") ? $_POST["interTitre-en"] : $_POST["interTitre-fr"];
    $resume = $_POST["resume-fr"];
    $resumeEn = ($_POST["resume-en"] != "") ? $_POST["resume-en"] : $_POST["resume-fr"];
    $resumeMobile = $_POST["resumeMobile-fr"];
    $resumeMobileEn = ($_POST["resumeMobile-en"] != "") ? $_POST["resumeMobile-en"] : $_POST["resumeMobile-fr"];
    $verbatim = $_POST["verbatim-fr"];
    $verbatimEn = ($_POST["verbatim-en"] != "") ? $_POST["verbatim-en"] : $_POST["verbatim-fr"];
    $verbatimAuteur = $_POST["verbatimAuteur"];    
    $urlVideo = $_POST["urlVideo"];
    $notesTitre = $_POST["notesTitre-fr"];
    $notesTitreEn = ($_POST["notesTitre-en"] != "") ? $_POST["notesTitre-en"] : $_POST["notesTitre-fr"];
    $notesTexte = $_POST["notesTexte-fr"];
    $notesTexteEn = ($_POST["notesTexte-en"] != "") ? $_POST["notesTexte-en"] : $_POST["notesTexte-fr"];
    $notesAuteur = $_POST["notesAuteur"];
    
    $req = $bdd->prepare("UPDATE creations SET statut = :statut, type = :type, anneeCreation = :anneeCreation, duree = :duree, auteur =:auteur, accroche = :accroche, chapo = :chapo, interTitre = :interTitre, resume = :resume, resumeMobile = :resumeMobile, verbatim = :verbatim, verbatimAuteur = :verbatimAuteur, urlVideo = :urlVideo, notesTitre = :notesTitre, notesTexte = :notesTexte, notesAuteur = :notesAuteur WHERE ID = :ID");

    $req->execute(array(

    'statut' => $statut,
    'type' => $type,
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
    'ID' => $ID
    ));

    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE creations_en SET statut = :statut, type = :typeEn, anneeCreation = :anneeCreation, duree = :duree, auteur =:auteur, accroche = :accrocheEn, chapo = :chapoEn, interTitre = :interTitreEn, resume = :resumeEn, resumeMobile = :resumeMobileEn, verbatim = :verbatimEn, verbatimAuteur = :verbatimAuteur, urlVideo = :urlVideo, notesTitre = :notesTitreEn, notesTexte = :notesTexteEn, notesAuteur = :notesAuteur WHERE ID = :ID");

    $reqEn->execute(array(

    'statut' => $statut,
    'typeEn' => $typeEn,
    'anneeCreation' => $anneeCreation,
    'duree' => $duree,
    'auteur' => $auteur,
    'accrocheEn' => $accrocheEn,
    'chapoEn' => $chapoEn,
    'interTitreEn' => $interTitreEn,
    'resumeEn' => $resumeEn,
    'resumeMobileEn' => $resumeMobileEn,
    'verbatimEn' => $verbatimEn,
    'verbatimAuteur' => $verbatimAuteur,
    'urlVideo' => $urlVideo,
    'notesTitreEn' => $notesTitreEn,
    'notesTexteEn' => $notesTexteEn,
    'notesAuteur' => $notesAuteur,
    'ID' => $ID
    ));

    $reqEn->closeCursor(); // Termine le traitement de la requête

    // Redirection sur la gestion des créations
    $redirection="creationsGestion.php?modif=creation";
    header("Location:$redirection");
  }

  // Actualisation de la distribution (enregistrement dans la table fo_col (qui aurait normalement dû être appelée cre_fo_col))

  if(isset($_POST["boutonDistribution"]) AND $_POST["boutonDistribution"] == "ACTUALISER")
    {
      // On supprime d'abord TOUTES les liaisons de cette création
      $requeteSupprDistribution = $bdd->query("DELETE FROM fo_col WHERE creationsID = ".$ID) or die(mysql_error());
      $requeteSupprDistribution-> closeCursor();

      // On scanne la liste des fonctions disponibles et des collaborateurs sélectionnés
      for($i=0 ; $i<count($donnees["fonctions"]); $i++)
      {
        // Si un (ou plusieurs) collaborateur(s) de la fonction n°i est (sont) sélectionné(s)...
        $fonctionCourante = "select-fonction-" . $i;
        if(isset($_POST[$fonctionCourante]) AND $_POST[$fonctionCourante][0] != -1)
        {
          //...on parcourt les collaborateurs
          foreach ($_POST[$fonctionCourante] as $key => $collaborateurCourant)
          {
            // Enregistrement en base du couple fonction / collaborateur courant
            $creaID = $_POST['ID'];
            $fonID = $i;
            $colID = $collaborateurCourant;
            /*echo "INSERT INTO fo_col(creationsID, fonctionsID, collaborateursID) VALUES($creaID, $fonID, $colID)"."<br>";*/
            $requeteFoCol = $bdd->prepare("INSERT INTO fo_col(creationsID, fonctionsID, collaborateursID) VALUES(:creationsID, :fonctionsID, :collaborateursID)");
            $requeteFoCol->execute(array(
              'creationsID' => $creaID,
              'fonctionsID' => $fonID,
              'collaborateursID' => $colID
              ));
            $requeteFoCol->closeCursor(); // Termine le traitement de la requête
          }
        }
      }
    }

  // Récupération de la liste des collaborateurs disponibles en bdd (table collaborateurs)

  $requeteCollaborateurs = "SELECT ID, CONCAT(prenom, ' ', nom) FROM collaborateurs";
  $reponseCollaborateurs = $bdd->query($requeteCollaborateurs);
  while($donneesCollaborateurs = $reponseCollaborateurs->fetch())
  {
    $donnees["collaborateurs"][] = $donneesCollaborateurs;
  }
  $reponseCollaborateurs->closeCursor(); // Termine le traitement de la requête

  // Récupération de la liste des métiers et collaborateurs disponibles en bdd et associés à cette création (table fo_col (qui aurait normalement dû être appelée cre_fo_col))

  $requeteCreaFonctions = "SELECT DISTINCT fonctionsID FROM fo_col WHERE creationsID = " . $ID or die(print_r($bdd->errorInfo));
  $reponseCreaFonctions = $bdd->query($requeteCreaFonctions);
  while($donneesCreaFonctions = $reponseCreaFonctions->fetch())
  {
    $metierID = $donneesCreaFonctions["fonctionsID"];
    $donnees["creaFonctions"][$metierID] = $donneesCreaFonctions["fonctionsID"];
    // On en profite pour récupérer le nom de la fonction
    $requeteCreaFonctionsNom = "SELECT metiers FROM fonctions WHERE ID = " . $metierID or die(print_r($bdd->errorInfo));
    $reponseCreaFonctionsNom = $bdd->query($requeteCreaFonctionsNom);
    $donneesCreaFonctionsNom = $reponseCreaFonctionsNom->fetch();
    $donnees["creaFonctionsNoms"][$metierID] = $donneesCreaFonctionsNom["metiers"];
    $reponseCreaFonctionsNom->closeCursor(); // Termine le traitement de la requête
  }
  $reponseCreaFonctions->closeCursor(); // Termine le traitement de la requête
  
  // Pour chacune des fonctions récupérées (s'il y en au moins une), on récupère également le ou les collaborateurs associés en bdd
    if(!empty($donnees["creaFonctions"]))
    {
      foreach($donnees["creaFonctions"] as $metierID)
      {
        $requeteFonctionsCol = "SELECT DISTINCT collaborateursID FROM fo_col 
                                WHERE fonctionsID = " . $metierID . "
                                AND creationsID = " . $ID or die(print_r($bdd->errorInfo));
        $reponseFonctionsCol = $bdd->query($requeteFonctionsCol);
        while($donneesFonctionsCol = $reponseFonctionsCol->fetch())
        {
          $collaborateurID = $donneesFonctionsCol["collaborateursID"];
          $donnees["creaFonctionsCol"]["$metierID"][$collaborateurID] = $donneesFonctionsCol["collaborateursID"];
          // On en profite pour récupérer le nom du collaborateur
          $requeteFonctionsColNom = "SELECT CONCAT(prenom, ' ', nom) FROM collaborateurs WHERE ID = " . $collaborateurID or die(print_r($bdd->errorInfo));
          $reponseFonctionsColNom = $bdd->query($requeteFonctionsColNom);
          $donneesFonctionsColNom = $reponseFonctionsColNom->fetch();
          $donnees["creaFonctionsColNoms"][$metierID][] = $donneesFonctionsColNom["CONCAT(prenom, ' ', nom)"];
          $reponseCreaFonctionsNom->closeCursor(); // Termine le traitement de la requête
        }
        $reponseFonctionsCol->closeCursor(); // Termine le traitement de la requête
      }
    }

  // Récupération de toutes les infos de la création en cours de modification (tables creations et creations_en)
 
  $requeteCreation="SELECT * FROM creations WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponseCreation = $bdd->query($requeteCreation);
  while($donneesCreation = $reponseCreation->fetch())
  {
    $donnees["creation"] = $donneesCreation;
  }
  $reponseCreation->closeCursor(); // Termine le traitement de la requête

  $requeteCreationEn="SELECT * FROM creations_en WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponseCreationEn = $bdd->query($requeteCreationEn);
  while($donneesCreationEn = $reponseCreationEn->fetch())
  {
    $donnees["creationEn"] = $donneesCreationEn;
  }
  $reponseCreationEn->closeCursor(); // Termine le traitement de la requête

    // liste des représentations
    $requeteRepresentations = "SELECT *,  DATE_FORMAT(dates, '%d/%m/%Y') FROM representations WHERE creationsID = ".$ID." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
    $representationsAll = $bdd->query($requeteRepresentations);
    $nombreRepresentations = $representationsAll->rowCount();

    // liste des articles de presse
    $requeteArticles = "SELECT *,  DATE_FORMAT(dates, '%d/%m/%Y') FROM articles WHERE creationsID = ".$ID." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
    $articlesAll = $bdd->query($requeteArticles);
    $nombreArticles = $articlesAll->rowCount();

    // Dossiers de presse
    $requeteDossier = "SELECT * FROM dossier_presse WHERE creationsID = ".$ID or die(print_r($bdd->errorInfo));
    $dossierPresseAll = $bdd->query($requeteDossier);
    $requeteDossierEn = "SELECT * FROM dossier_presse_en WHERE creationsID = ".$ID or die(print_r($bdd->errorInfo));
    $dossierPresseEnAll = $bdd->query($requeteDossierEn);

    // Fiche créations
    $requeteFiche = "SELECT * FROM fiche WHERE creationsID = ".$ID or die(print_r($bdd->errorInfo));
    $ficheAll = $bdd->query($requeteFiche);
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modifier une création</title>

  <?php include("inc/head.inc.php");?>

  <style>
    p.info{
      font-size: 1em;
    }
    .lineHeight{
      line-height: 20px;
    }
    #tableVrification tr th:nth-child(2){
      width: 400px;
    }
  </style>
</head>
<body>
  <?php
  include('inc/menuAdmin.inc.php');
  
  if(!isset($_POST["button"]))
  {
  ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);
      get_fil_ariane(array('creationsGestion.php' => 'Créations', 'final' => 'Modification de la création '.$donnees["creation"]["titre"]));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <!-- ******************* -->
    <!-- Formulaire CREATION -->
    <!-- ******************* -->

    <div class="halfPage filaire">
      <h1>Modifier une création</h1>
      <?php include('inc/choix-langue.php');?>
      <form name="form1" method="post" action="creationsModif.php">
      <fieldset>
      <legend>Modification d'une création </legend>
      <ul>
        <li>
          <label for="titre">Entrez un titre : </label>
          <input type="text" name="titre" id="titre" value="<?php echo $donnees["creation"]['titre'];?>" required disabled> (Vous ne pouvez pas modifier le titre)
        </li>
        <li>
          <label for="statut">Choisissez un statut</label>
          <select name="statut" id="statut">
          <option value="creationPresente" <?php if (!(strcmp("creationPresente", $donnees["creation"]['statut']))) {echo "selected=\"selected\"";} ?>>création présente</option>
          <option value="creationActuelle" <?php if (!(strcmp("creationActuelle", $donnees["creation"]['statut']))) {echo "selected=\"selected\"";} ?>>création actuelle</option>
          <option value="creationPrecedente" <?php if (!(strcmp("creationPrecedente", $donnees["creation"]['statut']))) {echo "selected=\"selected\"";} ?>>création précédente</option>
          <option value="creationAvenir" <?php if (!(strcmp("creationAvenir", $donnees["creation"]['statut']))) {echo "selected=\"selected\"";} ?>>création à venir</option>
          <option value="creationArchivee" <?php if (!(strcmp("creationArchivee", $donnees["creation"]['statut']))) {echo "selected=\"selected\"";} ?>>création archivée</option>
          </select>
        </li>
        <li>
          <label for="type">Entrez un type : </label>
          <input type="text" name="type-fr" id="type-fr" value="<?php echo $donnees["creation"]['type'];?>">
          <input type="text" name="type-en" id="type-en" value="<?php echo $donnees["creationEn"]['type'];?>" >
        </li>
        <li>
          <label for="anneeCreation">Entrez l'année de la création : </label>
          <input type="text" name="anneeCreation" id="anneeCreation" value="<?php echo $donnees["creation"]['anneeCreation'];?>" required>
        </li>
        <li>
          <label for="duree">Entrez la durée de la création : </label>
          <input type="text" name="duree" id="duree" value="<?php echo $donnees["creation"]['duree'];?>" required>
        </li>
        <li>
          <label for="auteur">Nom de l'auteur (optionnel) : </label>
          <input type="text" name="auteur" id="auteur" value="<?php echo $donnees["creation"]['auteur'];?>" >
        </li>
        <li>
          <label for="accroche">Accroche (250 caractères max, espaces compris): </label>
          <input type="text" name="accroche-fr" id="accroche-fr" maxlength="100" value="<?php echo $donnees["creation"]['accroche'];?>" required>
          <input type="text" name="accroche-en" id="accroche-en" maxlength="100" value="<?php echo $donnees["creationEn"]['accroche'];?>" >
        </li>
        <!--<li>
          <label for="titreBloc">Entrez un sous-titre: </label>
          <input type="text" name="titreBloc" id="titreBloc" value="<?php //echo $donnees["creation"]['titreBloc'];?>" required>
        </li>-->
        <br />
        <br />
        <li>
          <p>Entrez un inter-titre (pour la fiche création) :</p>
          <textarea name="interTitre-fr" id="interTitre-fr" rows="8" cols="45"><?php echo $donnees["creation"]['interTitre'];?></textarea>
          <textarea name="interTitre-en" id="interTitre-en" rows="8" cols="45"><?php echo $donnees["creationEn"]['interTitre'];?></textarea>
        </li>
        <li>
          <p>Entrez votre chapo (pour la fiche création) :</p>
          <textarea name="chapo-fr" id="chapo-fr" rows="8" cols="80"><?php echo $donnees["creation"]['chapo'];?></textarea>
          <textarea name="chapo-en" id="chapo-en" rows="8" cols="80"><?php echo $donnees["creationEn"]['chapo'];?></textarea>
        </li>
        <!-- jQUERY TEXT EDITOR-->
        <li>
          <p>Entrez votre résumé (pour la fiche création) :</p>
          <textarea name="resume-fr" class="jqte-test" id="res-fr"><?php echo $donnees["creation"]['resume'];?></textarea>
          <textarea name="resume-en" class="jqte-test" id="res-en"><?php echo $donnees["creationEn"]['resume'];?></textarea>
        <!-- jQUERY TEXT EDITOR -->
          
        </li>
        <li>
          <p>Entrez votre résumé destiné à la version mobile du site :</p>
          <textarea name="resumeMobile-fr" id="resumeMobile-fr" rows="8" cols="80"><?php echo $donnees["creation"]['resumeMobile'];?></textarea>
          <textarea name="resumeMobile-en" id="resumeMobile-en" rows="8" cols="80"><?php echo $donnees["creationEn"]['resumeMobile'];?></textarea>
        </li>
        <li>
          <p>Entrez un verbatim :</p>
          <textarea name="verbatim-fr" id="verbatim-fr" rows="8" cols="80"><?php echo $donnees["creation"]['verbatim'];?></textarea>
          <textarea name="verbatim-en" id="verbatim-en" rows="8" cols="80"><?php echo $donnees["creationEn"]['verbatim'];?></textarea>
        </li>
        <li>
          <label for="verbatimAuteur">Entrez l'auteur du verbatim : </label>
          <input type="text" name="verbatimAuteur" id="verbatimAuteur" value="<?php echo $donnees["creation"]['verbatimAuteur'];?>">
        </li>
        <li>
          <label for="urlVideo">Entrez le numéro Vimeo de la video : </label>
          <input type="text" name="urlVideo" id="urlVideo" value="<?php echo $donnees["creation"]['urlVideo'];?>">
        </li>
          
        <fieldset>
        <legend> Modification "autour d'une création" </legend>
          
        <li>
          <label for="notesTitre">Entrez un titre : </label>
          <input type="text" name="notesTitre-fr" id="notesTitre-fr" value="<?php echo $donnees["creation"]['notesTitre'];?>">
          <input type="text" name="notesTitre-en" id="notesTitre-en" value="<?php echo $donnees["creationEn"]['notesTitre'];?>">
        </li>
        <!-- jQUERY TEXT EDITOR -->
        <li>
          <p>Entrez un texte :</p>
          <textarea name="notesTexte-fr" class="jqte-test" id="notesTexte-fr"><?php echo $donnees["creation"]['notesTexte'];?></textarea>
          <textarea name="notesTexte-en" class="jqte-test" id="notesTexte-en"><?php echo $donnees["creationEn"]['notesTexte'];?></textarea>
          
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
          <label for="notesAuteur">Nom de l'auteur : </label>
          <input type="text" name="notesAuteur" id="notesAuteur" value="<?php echo $donnees["creation"]['notesAuteur'];?>">
        </li>
        </fieldset>
        <li>
          <input type="submit" name="button" id="button" value="Modifier la création">
        </li>
        <p><span class="underline">Note</span> : la modification de la création entraîne la mise à jour de la version anglaise <span class="underline">et</span> de la version française.</p>
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID']; ?>">
      </ul>
      </fieldset>
      </form>
    </div>

    <?php
    }
    ?>
    
    <!-- ************************** -->
    <!-- Formulaire REPRESENTATIONS -->
    <!-- ************************** -->
    
    <hr>
    <p>
      <div class="halfPage filaire">
        <fieldset>
        <legend>Représentations de la création</legend>
        <?php
          if(isset($nombreRepresentations) AND $nombreRepresentations > 0)
          {
        ?>
        <table>
          <tr>
            <th>Salle</th>
            <th>Ville</th>
            <th>Pays</th>
            <th>Dates</th>
            <th>Modifier</th>
            <th>Supprimer</th>
          </tr>
          <?php
            while($representationsDonnees = $representationsAll->fetch())
            {
          ?>   
          <tr>
            <td><?php echo $representationsDonnees['salle'];?></td>
            <td><?php echo $representationsDonnees['ville'];?></td>
            <td><?php echo $representationsDonnees['pays'];?></td>
            <td><?php echo $representationsDonnees['dates'];?></td>
            <td><a href="representationsModif.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&representationsID=<?php echo $representationsDonnees['ID'];?>" 
              class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
            <td><a href="representationsSupp.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&representationsID=<?php echo $representationsDonnees['ID'];?>" 
              class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
          </tr>
          <?php
            }
          ?>
        </table>
        <?php
            $representationsAll->closeCursor(); // Termine le traitement de la requête
            }
          else echo "<p>Vous n'avez pas encore enregistré de représentations.</p>";
        ?>   
        </fieldset>
      </div>
    </p>
    <p>
      <a href="representationsAjout.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une représentation</a>
    </p> 

    <!-- ***************************** -->
    <!-- Formulaire ARTICLES DE PRESSE -->
    <!-- ***************************** -->
    
    <hr>
    <p>
      <div class="halfPage filaire">
      <fieldset>
      <legend>Articles de presse de la création</legend>
      <?php
        if(isset($nombreArticles) AND $nombreArticles > 0)
        {
      ?>
      <table>
        <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Modifier</th>
          <th>Supprimer</th>            
        </tr>
        <?php 
          while($articlesDonnees = $articlesAll->fetch())
          {
        ?>    
        <tr>
          <td><?php echo $articlesDonnees['titre'];?></td>
          <td><?php echo $articlesDonnees['dates'];?></td>
          <td><a href="articlesModif.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&articlesID=<?php echo $articlesDonnees['ID'];?>" 
            class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
          <td><a href="articlesSupp.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&articlesID=<?php echo $articlesDonnees['ID'];?>" 
            class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
        </tr>
        <?php
          }
        ?>
      </table>
      <?php                
        $articlesAll->closeCursor(); // Termine le traitement de la requête
        }
      else echo "<p>Vous n'avez pas encore enregistré d'articles de presse.</p>";
      ?>
      </fieldset>
    </div>
    <p>
    <a href="articlesAjout.php?creationsID=<?php echo $donnees["creation"]['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter un article</a>
    </p>

    <!-- **************************** -->
    <!-- Formulaire DOSSIER DE PRESSE -->
    <!-- **************************** -->

    <hr>
    <p>
      <div class="halfPage filaire">
        <fieldset>
        <legend>Dossier de presse de la création</legend>
        <?php
          $dossierPresseDonnees = $dossierPresseAll->fetch();
          $dossierPresseDonneesEn = $dossierPresseEnAll->fetch();
          if($dossierPresseDonnees OR $dossierPresseDonneesEn)
          {
        ?>
        <table>
          <tr>
            <th>Titre</th>
            <th>Supprimer</th>                   
          </tr>
          <?php
            if($dossierPresseDonnees)
            {
          ?>
          <tr>
            <td><?php echo $dossierPresseDonnees['titre'];?> (version française)</td>
            <td><a href="dossierPresseSupp.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&dossierPresseID=<?php echo $dossierPresseDonnees['ID'];?>" 
                class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
          </tr>
          <?php
            }
            if($dossierPresseDonneesEn)
            {
          ?>
          <tr>
            <td><?php echo $dossierPresseDonneesEn['titre'];?> (version anglaise)</td>
            <td><a href="dossierPresseSupp.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&dossierPresseID=<?php echo $dossierPresseDonneesEn['ID'];?>&version=en" 
                class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
          </tr>
          <?php
            }
          ?>
        </table>
        <?php
          }
          else echo "<p>Vous n'avez pas encore enregistré de dossier de presse.</p>";
        ?>
        </fieldset>
      </div>
    </p>
    <?php 
      if(!$dossierPresseDonnees)
      {
    ?>
    <p>
      <a href="dossierPresseAjout.php?creationsID=<?php echo $donnees["creation"]['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter le dossier de presse (version française)</a>
    </p>
    <?php
      }
      $dossierPresseAll->closeCursor(); // Termine le traitement de la requête
    ?>

    <?php 
      if(!$dossierPresseDonneesEn)
      {
    ?>
    <p>
      <a href="dossierPresseAjout.php?creationsID=<?php echo $donnees["creation"]['ID'];?>&ID=<?php echo $_GET['ID'];?>&version=en" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter le dossier de presse (version anglaise)</a>
    </p>
    <?php
      }
      $dossierPresseAll->closeCursor(); // Termine le traitement de la requête
    ?>
    
    <!-- ************************* -->
    <!-- Formulaire FICHE CREATION -->
    <!-- ************************* -->

    <hr>
    <p>
      <div class="halfPage filaire">
        <fieldset>
        <legend>Fiche de la création</legend>
        <?php
          $ficheDonnees = $ficheAll->fetch();
          if($ficheDonnees)
          {
        ?>
        <table>
          <tr>
            <th>Titre</th>
            <th>Modifier</th>
            <th>Supprimer</th>                   
          </tr>
          <tr>
            <td><?php echo $ficheDonnees['titre'];?></td>
            <td><a href="ficheModif.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&ficheID=<?php echo $ficheDonnees['ID'];?>" 
                class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
            <td><a href="ficheSupp.php?ID=<?php echo $donnees["creation"]['ID'];?>&creationsID=<?php echo $donnees["creation"]['ID'];?>&ficheID=<?php echo $ficheDonnees['ID'];?>" 
                class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
          </tr>
        </table>
        <?php
          }
        else echo "<p>Vous n'avez pas encore enregistré de fiche création.</p>";
        ?>
        </fieldset>
      </div>
    </p>
    <?php 
      if(!$ficheDonnees)
      {
    ?>
    <p>
      <a href="ficheAjout.php?creationsID=<?php echo $donnees["creation"]['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter la fiche création</a>
    </p>
    <?php
      }
      $ficheAll->closeCursor(); // Termine le traitement de la requête
    ?>

    <!-- *********************** -->
    <!-- Formulaire DISTRIBUTION -->
    <!-- *********************** -->

    <hr>
    <a name="formDistribution"></a>
    <div id="formDistribution" class="tableFloat filaire">
      <form name="formDistribution" method="post" action="creationsModif.php?ID=<?php echo $ID;?>#formDistribution">
      <fieldset>
      <legend> Distribution </legend>
        <p class="info">Sélectionnez les collaborateurs associés à cette création, puis cliquez sur le bouton "ACTUALISER"<br><br>Pour une même fonction, vous pouvez sélectionnez plusieurs collaborateurs à l'aide des touches "SHIFT" et "CTRL" sur PC ("SHIFT" et "CMD" sur Mac) de votre clavier.</p>
        <input type="submit" name="boutonDistribution" value="ACTUALISER">
        <br><br>
        <table>
          <tr>
            <th>Fonctions disponibles</th>
            <th>Collaborateurs disponibles</th>
          </tr>
       
          <?php         
          // Boucle sur les fonctions disponibles
          for($i=0; $i<count($donnees["fonctions"]); $i++)
          {
          ?>
          <tr>             
            <td><?php echo $donnees["fonctions"][$i]["metiers"];?></td>
            <td>
              <select name="select-fonction-<?php echo $donnees["fonctions"][$i]["ID"];?>[]" multiple size="5">
                <option value = "-1">--- Choisissez un collaborateur ---</option>
                <?php
                  // Boucle sur les collaborateurs disponibles
                  for($j=0; $j<count($donnees["collaborateurs"]); $j++)
                  {
                ?>
                <option value = "<?php echo $donnees["collaborateurs"][$j]["ID"];?>"

                    <?php
                      // Si la fonction existe en bdd pour cette création ET qu'elle contient le collaborateur courant dans la boucle, on sélectionne ce dernier
                      if(isset($donnees["creaFonctions"][$i+1])
                        AND in_array($donnees["collaborateurs"][$j]["ID"], $donnees["creaFonctionsCol"][$i+1]))
                      {
                        echo 'selected = "selected"';
                      }
                    ?>
                    >
                  <?php
                    echo $donnees["collaborateurs"][$j]["CONCAT(prenom, ' ', nom)"];
                  ?>
                </option>
                <?php
                  }
                ?>
              </select>
            </td>
          </tr>
          <?php         
          }
          ?>
        </table>

        <p>
          <input name="ID" type="hidden" id="ID" value="<?php echo $ID;?>">
        </p>

      </fieldset>
      </form>
    </div> <!-- fin du formDistribution -->
  
    <div class="tableFloat filaire">
      <p>Vérification de la distribution par création</p>
      <p>lorsque l'utilisateur appuie sur "ACTUALISER"</p>
      <table id="tableVrification">
        <tr>
          <th colspan="2"><?php echo $donnees["creation"]["titre"];?></th>
        </tr>
        <tr>
          <th class="entete">Fonctions</th>
          <th class="entete">Collaborateurs</th>
        </tr> 
        <?php
          if(!empty($donnees["creaFonctionsNoms"]))
          {
            // Boucle sur les métiers associés à la création
            foreach($donnees["creaFonctionsNoms"] as $key => $metier)
            { 
        ?>                
        <tr>
          <td>
          <?php
              echo $metier;
              // On récupère l'indice courant du tableau associatif, correspondant à l'ID de la fonction
              $fonctionCouranteID = $key;
          ?>
          </td>
          <td class="lineHeight">
          <?php
              // Boucle sur les collaborateurs associés à la fonction
              foreach($donnees["creaFonctionsColNoms"][$fonctionCouranteID] as $collaborateur)
              {
                echo $collaborateur . "<br>";
              }
          ?>
          </td>
        </tr>
        <?php
            }
          }
        ?>
        </tr>
      </table>
    </div>

  </div> <!-- fin du container -->

  <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/admin/tools/toolsLang.js" charset="utf-8"></script>
  
</body>
</html>