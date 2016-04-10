<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// Protection des pages adhérents
	include('../admin/inc/protectionAdherent.inc.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	
	// Gestion des langues (champs "statiques" du front-office)
	include("../lang/langTools/lang.inc.php");
	require("../lang/lang.php");
	$lang = "fr";
	
	// gestion du fil d'Ariane
	include('../inc/fonctionFilArianne.inc.php');
	
	// Autres
	require_once('../admin/tools/toolsDateTime.php');
	
	/* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
		
	// Récupération de l'ID de la dernière discussion enregistrée
	
	$requeteDiscussionIdMax = "SELECT MAX(ID) FROM discussions";
	$reponseDiscussionIdMax = $bdd->query($requeteDiscussionIdMax);
	
	$donneesDiscussionIdMax = $reponseDiscussionIdMax->fetch();
	$discussionID = $donneesDiscussionIdMax["MAX(ID)"];
	
	$adherentID = $_SESSION["adherentID"];
	
	if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
	{
		if(isset($_POST["commentaire"]) AND $_POST["commentaire"]!="")
		{
			$commentaire = $_POST["commentaire"];
			$adherentID = $_SESSION["adherentID"];
			
			$requete = "INSERT messages (dates, commentaires, discussionsID, adherentsID) VALUES(NOW(), ?, ?, ?)";
			$req = $bdd->prepare($requete);
			$req->execute(array($commentaire, $discussionID, $adherentID)) or die(print_r($req->errorInfo()));
			$req->closeCursor();
			$messageOK = "Merci pour votre commentaire !";
			
			unset($_POST);
		}
		else
		{
			$erreur = "Vous devez entrer un commentaire avant de valider.";
		}
	}
	
	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
	// Initialisation du tableau contenant les données à afficher sur la page
	$donneesPage = array(
		"discussionTitre",
		"discussionTexte",
		"discussionAuteur",
		"messagesDate" => array(),
		"messagesTexte" => array(),
		"messagesAuteur" => array(),
		);
	
	// Récupération des infos sur la dernière discussion enregistrée
	$requeteDiscussion = "SELECT ID, titre, texte, auteur FROM discussions WHERE ID = ".$discussionID;
	$reponseDiscussion = $bdd->query($requeteDiscussion);
	
	$donneesDiscussion = $reponseDiscussion->fetch();
	
	$donneesPage["discussionID"] = $donneesDiscussion["ID"];
	$donneesPage["discussionTitre"] = $donneesDiscussion["titre"];
	$donneesPage["discussionTexte"] = $donneesDiscussion["texte"];
	$donneesPage["discussionAuteur"] = $donneesDiscussion["auteur"];

	$reponseDiscussion->closeCursor();
	
	// Récupération des infos sur les messages / adhérents associés à la dernière discussion enregistrée
	$requeteMessages = "SELECT M.dates, M.commentaires, A.prenom, A.nom
						FROM messages M, adherents A
						WHERE M.discussionsID = " . $discussionID . " AND M.adherentsID = A.ID
						ORDER BY M.dates DESC";
	$reponseMessages = $bdd->query($requeteMessages);
	$nombreMessages = $reponseMessages->rowCount();
	
	$i=0;
	while($donneesMessages = $reponseMessages->fetch())
	{
		$dateMessage = dateHeureInfos($donneesMessages['dates']);
		
		$donneesPage["messagesDate"][$i] = $dateMessage["date"];
		$donneesPage["messagesHeure"][$i] = $dateMessage["heure"];
		$donneesPage["messagesTexte"][$i] = $donneesMessages["commentaires"];
		$donneesPage["messagesAuteur"][$i] = $donneesMessages["prenom"] . " " . $donneesMessages["nom"];
		$i++;
	}
	
	$reponseMessages->closeCursor();
	
	// Récupération de l'ID de la dernière discussion enregistrée
	
	$requeteDiscussionIdMax = "SELECT MAX(ID) FROM discussions";
	$reponseDiscussionIdMax = $bdd->query($requeteDiscussionIdMax);
	
	$donneesDiscussionIdMax = $reponseDiscussionIdMax->fetch();
	$discussionID = $donneesDiscussionIdMax["MAX(ID)"];
	
	$adherentID = $_SESSION["adherentID"];
	
	// Récupération des infos en base de données sur les créations archivées pour les pages adhérents
	include("../inc/infosCreasArchivees.php");
	
	// Facebook
	$titleFacebook = "Carnet de bord AToU";
	$urlPageFacebook ="http://www.atou.fr/adherents/discussion.php";
	$urlImageFacebook = "http://www.atou.fr/photosVignettes/accueilAdherentsCarnetdebord.jpg";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Carnet de bord</title>
    
   	<!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
	<meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_jf.css" />
    
    <!-- font Alegreya -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' />
    
    <!-- favIcon -->    
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
     <!--jQuery Validate-->    
    <script src="../jquery/jquery.validate.js" type="text/javascript"></script>

    <style>
		p.erreur{
			color:red;
			}
	</style>

	<!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="discussion">

	<div id="superTop"></div> <!--Bouton, top-->
    <!--___________Menu header___________-->
    
    <div class="bgheader">
        <div id="entete">
            <header>
                <?php
                	include("../inc/menuFront.inc.php");
                ?>
            </header>  
        </div> 
    </div>
        
    <!--___________Fin Menu header___________-->
    
 	<div class="fondNoir">
    
		<section>
    
            <a href="#superTop" id="top"></a><!--Bouton, top-->
            
            <!--___________ Fil d'Arianne___________-->
            <div class="filaire">
                <?php
                    define('Compagnie_ATou', 'Accueil &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('accueilAdherents.php' => '&nbsp; Espace adhérents &nbsp;', 'final' => '&nbsp; Discussion'), $lang);?></p>
            </div>
            <!--_____________________________________-->
       
        
			<h1>Carnet de bord</h1>
	
			<!--_____Zone 1_____-->	
        
			<div id="zone1">
        
                <div class="imgTacheBlanche">
                        <img src="../img/backgroundTacheBlanc.png" alt="toto"/>
                </div>
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre1">
             
                    <!--_____Cartouche_____-->
                    
                    <div class="cartouche"> 
                             <p>AToU vous invite à échanger vos impressions dans un espace de partage et de discussion.</p>             
                    </div>
                               
                    <!--_____Fin du cartouche_____-->
                    
                    <!--______Début cadre video_____-->
                      
                    <div class="black">
                           <img src="../photosVignettes/accueilAdherentsCarnetdebord.jpg" alt="photo Carnet de bord" width="622" height="413" />
                    </div>
                 
                	<!--_____Fin cadre vidéo_____-->
             
             
                    <!--_____Début des rectangles_____-->
                     
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                   
                    <!--_____Fin des rectangles______-->
                                
        		</div>
 
  				<!--_____Fin du cadre 01_____-->      
                
			</div>
        
   			<!--_____Fin Zone 1_____-->

			<br class="annule"/>    

            <!--_____Zone 2_____-->	
                
            <div id="zone2">
        
                <!--_____Cadre 1_____-->	
                
                <div class="cadre1">      	
            
                    <div class="white big">
                   
                        <p id="nm_titreQuestions" class="titreQuestions"><?php echo $donneesPage["discussionTitre"]?></p>	
                        <p class="datePublication">Publié le 1er mars 2014 par <?php echo $donneesPage["discussionAuteur"]?></p>
                        
                        <p class="citation"><?php echo $donneesPage["discussionTexte"]?></p>
                        
                        <a class="partage" href="" title="PARTAGER SUR" 
                                onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
                            <div class="facebook">&nbsp; &nbsp; &nbsp; Partagez sur facebook</div>
                        </a>
                        
                        <br class="annule"/>
                        
                        <h5>Exprimez-vous</h5>
                   
						<br class="annule"/>
                                    
                        <form id="form1" name="form1" method="post" action="discussion.php#nm_titreQuestions">
                            <ul>
                                <li>
                                    <textarea name="commentaire" id="commentaire"><?php if(isset($_POST["commentaire"])) echo $_POST["commentaire"];?></textarea>
                                </li>
                                <?php if(isset($messageOK)) echo "<p class='success'>" . $messageOK . "</p>";?>
                                <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
                                <li>
                                    <input type="submit" name="button1" id="button1" value="Envoyer" class="callToAction3"/>
                                </li>
                                <li>
                                    <input type="hidden" name="flag1" id="flag1" value="1">
                                </li>
                            
                            </ul>
                        </form>
                        
                        <script>

							   $(document).ready(function(){
								      $("#form1").validate({
													  rules: {
														 "commentaire":{
															"required": true,
															"minlength": 2,
															"maxlength": 60000
														 },
														// "monemail": {
//															"email": true,
//															"maxlength": 255
//														 },
//														 "montelephone": {
//															"required": true
//														 }
										
												  }
										  });
										  
										  jQuery.extend(jQuery.validator.messages, {
												  required: "Vous devez remplir ce champ",
												  remote: "votre message",
												  email: "votre message",
												  url: "votre message",
												  date: "votre message",
												  dateISO: "votre message",
												  number: "votre message",
												  digits: "votre message",
												  creditcard: "votre message",
												  equalTo: "votre message",
												  accept: "votre message",
												  maxlength: jQuery.validator.format("votre message {0} caractéres."),
												  minlength: jQuery.validator.format("votre message {0} caractéres."),
												  rangelength: jQuery.validator.format("votre message&nbsp; entre {0} et {1} caractéres."),
												  range: jQuery.validator.format("votre message&nbsp; entre {0} et {1}."),
												  max: jQuery.validator.format("votre message&nbsp; inférieur ou égal à {0}."),
												  min: jQuery.validator.format("votre message&nbsp; supérieur ou égal à {0}.")
												});

								});
						
						</script>
                        
                     	<br class="annule"/>
                        
                        <h5><?php echo $nombreMessages;?> Commentaires sur « <?php echo $donneesPage["discussionTitre"]?> »</h5>                                
                        
                        <?php
							// S'il y a au mois 1 commentaire, on l'affiche
							if($nombreMessages > 0)
							{	
								for($i=0;$i<$nombreMessages;$i++)
								{
						?>
                        <p class="name"><?php echo $donneesPage['messagesAuteur'][$i];?>
                        	<span class="datePublication"> | Publié le <?php echo $donneesPage["messagesDate"][$i];?> à <?php echo $donneesPage["messagesHeure"][$i];?></span></p>
                        
                        <p class="discussion"><?php echo $donneesPage["messagesTexte"][$i];?></p>
                        <?php
								}
							}
							else echo "<p>Soyez le premier à réagir !</p>";
						?>
                                  
					</div>
               
                </div>
                <!--_____Fin cadre 1_____-->
                
               
                 
                <!--_____Début cadre 2_____-->	
                <div class="cadre2">
                   
                    <!--_____Premier cadre_____-->
                    
                    <div class="blocRappel">
                    
                        <img src="../photosVignettes/listeAteliersAteliers1.jpg" alt="image 1" />
                        <h3>Ateliers</h3>
                        <a href="listeAteliers.php"><div id="lienRustine" class="lien">Découvrir les ateliers et s’inscrire à Nubese</div></a>
                    
                    </div>
                    
                    <div class="blocRappel">
                    
                        <img src="../photosVignettes/listeAteliersGalerie1.jpg" alt="Galerie photos" />
                        <h3>Galerie photos</h3>
                        <a href="galeriePhotos.php"><div id="lienRustine" class="lien">Explorer la galerie photos</div></a>
                        
                    </div>     
                    
                    <div class="blocRappel">
                    
                        <img src="../photosVignettes/listeAteliersArchives1.jpg" alt="Archives" />
                        <h3>Créations archivées</h3>
                        <?php
                            if($nombreCreationsArchivees > 0)
                            {
                        ?>
                        <a href="../danse-contemporaine-lyon/ficheCreation.php?ID=<?php echo $donneesPage["creationsArchivees"][0]["ID"];?>">
                        	<div id="lienRustine" class="lien"><?php echo $donneesPage["creationsArchivees"][0]["titre"];?></div>
                        </a>
                        <?php
                            }
                            else echo "<h3>A venir...</h3>";
							
                            // Affichage de 5 autres créations archivées max, sinon pb au niveau de la mise en page
                            if($nombreCreationsArchivees > 5) $nombreCreationsArchivees = 5;
                            for($i=1; $i<$nombreCreationsArchivees; $i++)
                            {
                        ?>
                        <a href="../danse-contemporaine-lyon/ficheCreation.php?ID=<?php echo $donneesPage["creationsArchivees"][$i]["ID"];?>">
                        	<div id="lienRustine" class="lien"><?php echo $donneesPage["creationsArchivees"][$i]["titre"];?></div>
                        </a>
                        <?php
                            }
                        ?>        
                        
                    </div>
                         
                </div>   
                <!--_____Fin du cadre 2_____-->
                
        </div>
        <!--_____Fin Zone 2_____-->
        
		<br class="annule"/>      
      	
        </section>    	
        <!--_____Fin de la section_____-->
     
    </div>
    <!--_____Fin du fond noir_____-->
 
            
	<!--___________Menu footer___________-->

 
	<div id="bgfooter">
    	<div id="pied">
    		<footer>
				<?php
				  include("../inc/footerFront.inc.php");
    			?>
			</footer>
		</div>
    </div>

	<!--___________Fin Menu footer___________-->
    
    <!--Bouton super top-->
	<script src="../jquery/topButton.js" type="text/javascript"></script>
    
   
    
</body>
</html>