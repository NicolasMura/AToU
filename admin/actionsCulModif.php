<?php
  include_once ("inc/include.inc.php");

  //On récupère l'ID de l'action culturelle dans la barre d'adresse

  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  elseif(isset($_POST['ID'])) $ID = $_POST['ID'];
  elseif(isset($_GET['actions_culturellesID'])) $ID = $_GET['actions_culturellesID'];
  elseif(isset($_POST['actions_culturellesID'])) $ID = $_POST['actions_culturellesID'];
  else header("location:actionsCulGestion.php");

  ######################################################################
  // update des action_culturelles
  if(isset($_POST['flag']) AND $_POST['flag']==1 AND (isset($ID)) AND ($ID != "")) 
  {
    $statut = $_POST["statut"];
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
    
    $req = $bdd->prepare("UPDATE actions_culturelles SET statut = :statut, anneeCreation = :anneeCreation, duree = :duree, auteur =:auteur, accroche = :accroche, chapo = :chapo, interTitre = :interTitre, resume = :resume, resumeMobile = :resumeMobile, verbatim = :verbatim, verbatimAuteur = :verbatimAuteur, urlVideo = :urlVideo, notesTitre = :notesTitre, notesTexte = :notesTexte, notesAuteur = :notesAuteur WHERE ID = :ID");

    $req->execute(array(

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
  	'ID' => $ID
  	));

  	 // envoi à accueil.php
  	//header("Location:creationsGestion.php");
  	
  	$req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE actions_culturelles_en SET statut = :statut, anneeCreation = :anneeCreation, duree = :duree, auteur =:auteur, accroche = :accrocheEn, chapo = :chapoEn, interTitre = :interTitreEn, resume = :resumeEn, resumeMobile = :resumeMobileEn, verbatim = :verbatimEn, verbatimAuteur = :verbatimAuteur, urlVideo = :urlVideo, notesTitre = :notesTitreEn, notesTexte = :notesTexteEn, notesAuteur = :notesAuteur WHERE ID = :ID");

    $reqEn->execute(array(

    'statut' => $statut,
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

  	// Redirection sur la gestion des actions culturelles
  	header("Location:actionsCulGestion.php?modif=actionCulturelle");
  }

  // On récupère tout le contenu des tables action_culturelles et action_culturelles_en

  $requete="SELECT * FROM actions_culturelles WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  // On affiche l' entrée
  $donnees = $reponse->fetch();

  $requeteEn="SELECT * FROM actions_culturelles_en WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponseEn = $bdd->query($requeteEn);
  // On affiche l' entrée
  $donneesEn = $reponseEn->fetch();

  ############################ Affichage de la liste des représentations ###########################################
  // On récupère tout le contenu de la table representations
  $requeteRepresentation = "SELECT *,  DATE_FORMAT(dates, '%d/%m/%Y') FROM representations WHERE actions_culturellesID = ".$ID." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
  $representationsAll = $bdd->query($requeteRepresentation);
  $nombreRepresentations = $representationsAll->rowCount();

  ############################ Affichage de la liste des articles ###########################################
  // On récupère tout le contenu de la table articles
  $requeteArticle = "SELECT *,  DATE_FORMAT(dates, '%d/%m/%Y') FROM articles WHERE actions_culturellesID = ".$ID." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
  $articlesAll = $bdd->query($requeteArticle);
  $nombreArticles = $articlesAll->rowCount();

  ############################ Affichage du dossier de presse ###########################################
  // On récupère tout le contenu des tables dossier_presse et dossier_presse_en
  $requeteDossier = "SELECT * FROM dossier_presse WHERE actions_culturellesID = ".$ID or die(print_r($bdd->errorInfo));
  $dossierPresseAll = $bdd->query($requeteDossier);
  $requeteDossierEn = "SELECT * FROM dossier_presse_en WHERE actions_culturellesID = ".$ID or die(print_r($bdd->errorInfo));
  $dossierPresseEnAll = $bdd->query($requeteDossierEn);
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modifier une création</title>
  
  <?php include("inc/head.inc.php");?>
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
       get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'final' => 'Modification de l\'action culturelle '.$donnees["titre"]));
    ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <!-- **************************** -->
    <!-- Formulaire ACTION CULTURELLE -->
    <!-- **************************** -->

    <div class="halfPage filaire">
      <h1>Modifier une action culturelle</h1>
      <?php include('inc/choix-langue.php');?>
      <form name="form1" method="post" action="actionsCulModif.php">
      <fieldset>
      <legend>Modification d'une action culturelle</legend>
      <ul>
        <li>
          <label for="titre">Entrez un titre : </label>
          <input type="text" name="titre" id="titre" value="<?php echo $donnees['titre'];?>" required disabled> (Vous ne pouvez pas modifier le titre)
        </li>
        <li>
          <label for="statut">Choisissez un statut :</label>
          <select name="statut" id="statut">
          <option value="actionPresente" <?php if (!(strcmp("actionPresente", $donnees['statut']))) {echo "selected=\"selected\"";} ?>>action culturelle présente</option>
          <option value="actionActuelle" <?php if (!(strcmp("actionActuelle", $donnees['statut']))) {echo "selected=\"selected\"";} ?>>action culturelle actuelle</option>
          <option value="actionPrecedente" <?php if (!(strcmp("actionPrecedente", $donnees['statut']))) {echo "selected=\"selected\"";} ?>>action culturelle précédente</option>
          <option value="actionAvenir" <?php if (!(strcmp("actionAvenir", $donnees['statut']))) {echo "selected=\"selected\"";} ?>>action culturelle à venir</option>
          </select>
        </li>
        <li>
          <label for="anneeCreation">Entrez l'année (optionnel) : </label>
          <input type="text" name="anneeCreation" id="anneeCreation" value="<?php echo $donnees['anneeCreation'];?>" required>
        </li>
        <li> <!--Note Nico : champ pas utilisé pour le moment-->
          <label for="duree">Entrez la durée (optionnel) : </label>
          <input type="text" name="duree" id="duree" value="<?php echo $donnees['duree'];?>">
        </li>
        <li>
          <label for="auteur">Nom de l'auteur (optionnel) : </label>
          <input type="text" name="auteur" id="auteur" value="<?php echo $donnees['auteur'];?>">
        </li>
        <li>
          <label for="accroche">Accroche (250 caractères max, espaces compris): </label>
          <input type="text" name="accroche-fr" id="accroche-fr" maxlength="100" value="<?php echo $donnees['accroche'];?>" required>
          <input type="text" name="accroche-en" id="accroche-en" maxlength="100" value="<?php echo $donneesEn['accroche'];?>">
          </li>
        <br /><br />
        <!--<li> 
          <label for="titreBloc">Entrez un sous-titre: </label>
          <input type="text" name="titreBloc" id="titreBloc" value="<?php //echo $donnees['titreBloc'];?>" required>
        </li>-->
        <li>
          <p>Entrez votre chapo (pour la fiche action culturelle)  :</p>
          <textarea name="chapo-fr" id="chapo-fr" rows="8" cols="45"><?php echo $donnees['chapo'];?></textarea>
          <textarea name="chapo-en" id="chapo-en" rows="8" cols="45"><?php echo $donneesEn['chapo'];?></textarea>
        <li>
          <p>Entrez un inter-titre (pour la fiche action culturelle) :</p>
          <textarea name="interTitre-fr" id="interTitre-fr" rows="8" cols="45"><?php echo $donnees['interTitre'];?></textarea>
          <textarea name="interTitre-en" id="interTitre-en" rows="8" cols="45"><?php echo $donneesEn['interTitre'];?></textarea>
        </li>
        </li>
        <br />
        <li>
          <!-- jQUERY TEXT EDITOR -->
          <p>Entrez votre résumé (pour la fiche action culturelle) :</p>
          <textarea name="resume-fr" class="jqte-test" id="resume-fr"><?php echo $donnees['resume'];?></textarea>
          <textarea name="resume-en" class="jqte-test" id="resume-en"><?php echo $donneesEn['resume'];?></textarea>
          
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
          <textarea name="resumeMobile-fr" id="resumeMobile-fr" rows="8" cols="45"><?php echo $donnees['resumeMobile'];?></textarea>
          <textarea name="resumeMobile-en" id="resumeMobile-en" rows="8" cols="45"><?php echo $donneesEn['resumeMobile'];?></textarea>
        </li>
        <li>
          <p>Entrez un verbatim :</p>
          <textarea name="verbatim-fr" id="verbatim-fr" rows="8" cols="80"><?php echo $donnees['verbatim'];?></textarea>
          <textarea name="verbatim-en" id="verbatim-en" rows="8" cols="80"><?php echo $donneesEn['verbatim'];?></textarea>
        </li>
        <li>
          <label for="verbatimAuteur">Entrez l'auteur du verbatim : </label>
          <input type="text" name="verbatimAuteur" id="verbatimAuteur" value="<?php echo $donnees['verbatimAuteur'];?>">
        </li>
          <li>
          <label for="urlVideo">Entrez le numéro Vimeo de la video : </label>
          <input type="text" name="urlVideo" id="urlVideo" value="<?php echo $donnees['urlVideo'];?>">
        </li>
        <fieldset>
        <legend>Autour de l'action culturelle</legend>
        <li>
          <label for="notesTitre">Entrez un titre : </label>
          <input type="text" name="notesTitre-fr" id="notesTitre-fr" value="<?php echo $donnees['notesTitre'];?>">
          <input type="text" name="notesTitre-en" id="notesTitre-en" value="<?php echo $donneesEn['notesTitre'];?>">
        </li>
      
        <li>
          <label for="notesTexte">Entrez un texte : </label>
          <textarea name="notesTexte-fr" id="notesTexte-fr" rows="8" cols="45"><?php echo $donnees['notesTexte'];?></textarea>
          <textarea name="notesTexte-en" id="notesTexte-en" rows="8" cols="45"><?php echo $donneesEn['notesTexte'];?></textarea>
        </li>
         <li>
          <label for="notesAuteur">Nom de l'auteur : </label>
          <input type="text" name="notesAuteur" id="notesAuteur" value="<?php echo $donnees['notesAuteur'];?>">
        </li>
         
        </fieldset>
        <li>
          <input type="submit" name="button" id="button" value="Enregistrer les modifications" class="button-grand">
        </li>
        <p><span class="underline">Note</span> : la modification de l'action culturelle entraîne la mise à jour de la version anglaise <span class="underline">et</span> de la version française.</p>
        <li>
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID']; ?>">
        </li>
      </ul>
    </form>
</div>
<?php
}
// On affiche chaque entrée une à une de la liste représentation

?>

<!-- ************************** -->
<!-- Formulaire REPRESENTATIONS -->
<!-- ************************** -->

<hr>
<p>
<div class="halfPage">
    <fieldset>
    <legend>Représentations de l'action culturelle</legend>
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
                        <?php  while ($representationsDonnees = $representationsAll->fetch())
                            {
                        ?>
                       
                    <tr>
                        <td><?php echo $representationsDonnees['salle'];?></td>
                        <td><?php echo $representationsDonnees['ville'];?></td>
                        <td><?php echo $representationsDonnees['pays'];?></td>
                        <td><?php echo $representationsDonnees['dates'];?></td>
                        <td><a href="representationsModif.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=
                            <?php echo $donnees['ID'];?>&representationsID=<?php echo $representationsDonnees['ID'];?>" 
                            class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
                        <td><a href="representationsSupp.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=
                            <?php echo $donnees['ID'];?>&representationsID=<?php echo $representationsDonnees['ID'];?>" 
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
            </p>
    </fieldset>
</div>
<p>
<a href="representationsAjout.php?actions_culturellesID=<?php echo $donnees['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une représentation</a>
</p>    

<!-- ***************************** -->
<!-- Formulaire ARTICLES DE PRESSE -->
<!-- ***************************** -->

<hr>
<p>
<div class="halfPage">
    <fieldset>
    <legend>Articles de presse de l'action culturelle</legend>
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
                        <?php  while($articlesDonnees = $articlesAll->fetch())
                            {
                        ?>
                       
                    <tr>
                        <td><?php echo $articlesDonnees['titre'];?></td>
                        <td><?php echo $articlesDonnees['dates'];?></td>
                        <td><a href="articlesModif.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=<?php echo $donnees['ID'];?>&articlesID=<?php echo $articlesDonnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
                        <td><a href="articlesSupp.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=<?php echo $donnees['ID'];?>&articlesID=<?php echo $articlesDonnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
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
    </p>
    </fieldset>
</div>
<p>
<a href="articlesAjout.php?actions_culturellesID=<?php echo $donnees['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter un article</a>
</p>

<!-- **************************** -->
<!-- Formulaire DOSSIER DE PRESSE -->
<!-- **************************** -->

    <hr>
    <p>
    <div class="halfPage">
      <fieldset>
      <legend>Dossier de presse de l'action culturelle</legend>
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
          <td><a href="dossierPresseSupp.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=<?php echo $donnees['ID'];?>&dossierPresseID=<?php echo $dossierPresseDonnees['ID'];?>" 
              class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
        </tr>
        <?php
          }
          if($dossierPresseDonneesEn)
          {
        ?>
        <tr>
          <td><?php echo $dossierPresseDonneesEn['titre'];?> (version anglaise)</td>
          <td><a href="dossierPresseSupp.php?ID=<?php echo $donnees['ID'];?>&actions_culturellesID=<?php echo $donnees['ID'];?>&dossierPresseID=<?php echo $dossierPresseDonneesEn['ID'];?>&version=en" 
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
    <a href="dossierPresseAjout.php?actions_culturellesID=<?php echo $donnees['ID'];?>&ID=<?php echo $_GET['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter le dossier de presse (version française)</a>
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
    <a href="dossierPresseAjout.php?actions_culturellesID=<?php echo $donnees['ID'];?>&ID=<?php echo $_GET['ID'];?>&version=en" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter le dossier de presse (version anglaise)</a>
  </p>
  <?php
    }
    $dossierPresseAll->closeCursor(); // Termine le traitement de la requête
  ?>

  <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/admin/tools/toolsLang.js" charset="utf-8"></script>


</div>
</body>
</html>
