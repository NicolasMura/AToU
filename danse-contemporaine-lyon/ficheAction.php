<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	
	// Gestion des constantes	
	require_once("../inc/constantes.inc.php");
	
	// Gestion des langues (champs "statiques" du front-office)
	include("../lang/langTools/lang.inc.php");
	require("../lang/lang.php");
	
	// gestion du fil d'Ariane
	include('../inc/fonctionFilArianne.inc.php');
	
	// Autres
	require_once('../admin/tools/toolsDateTime.php');
	
	// On récupère l'ID de la création
	if(isset($_GET["ID"])) $id = $_GET["ID"];
	else
	{
		// S'il n'y a rien à récupérer, on redirige vers la liste des actions culturelles
		header("Location:listeActions.php");
	}
	
	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
	// Récupération des infos de l'action culturelle affichée
		$requete = ($lang == "en") ? "SELECT * FROM actions_culturelles_en WHERE ID = " .$id : "SELECT * FROM actions_culturelles WHERE ID = " .$id;
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$donneesPageActionAffichee = $donnees;
	}
	$donneesPage["actionsActuelles"][0] = $donneesPageActionAffichee;
			
		//Infos table photos
		$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"]." ORDER BY ID ASC";
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$donneesPagePhotosActionAffichee[$j] = $donnees;
			$j++;
		}
		$donneesPage["actionsActuelles"][0]["photos"] = $donneesPagePhotosActionAffichee;
		
		//Infos tables collaborateurs / fonctions
		/*$requete = "SELECT fonctions.metiers, GROUP_CONCAT(' ', collaborateurs.prenom, ' ', collaborateurs.nom) AS 'collaborateurs' FROM fo_col
			JOIN fonctions ON fonctions.ID = fo_col.fonctionsID
			JOIN collaborateurs ON collaborateurs.ID = fo_col.collaborateursID
			WHERE fo_col.creationsID = " . $donneesPage["creationsActuelles"][0]["ID"] . " 
			GROUP BY fonctions.metiers" or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"][$j] = $donnees;
			$j++;
		}*/
		
		//Infos table représentations
		$requete = "SELECT * FROM representations WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"]." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$dates = dateHeureInfos($donnees["dates"]);
			$donnees["dates"] = $dates["date"]; // On met la date au bon format
			$donneesPage["actionsActuelles"][0]["representations"][$j] = $donnees;
			$j++;
		}
		
		//Infos table revue de presse
		$requete = "SELECT * FROM articles WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"]." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$datesArticles = dateHeureInfos($donnees["dates"]); // On met la date au bon format
			$donnees["dates"] = $datesArticles["date"];
			$donneesPage["actionsActuelles"][0]["articles"][$j] = $donnees;
			$j++;
		}
		
		//Infos table dossier de presse
		$requete = "SELECT * FROM dossier_presse WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$donnees = $reponse->fetch();
		$nbreResultats = $reponse->rowCount();
		if($nbreResultats > 0) $donneesPage["actionsActuelles"][0]["dossierPresse"] = $donnees;

		$requeteEn = "SELECT * FROM dossier_presse_en WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponseEn = $bdd->query($requeteEn);
		$donneesEn = $reponseEn->fetch();
		$nbreResultats = $reponseEn->rowCount();
		if($nbreResultats > 0) $donneesPage["actionsActuelles"][0]["dossierPresseEn"] = $donneesEn;
			
		//Infos table fiche
		$requete = "SELECT * FROM fiche WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$donnees = $reponse->fetch();
		$nbreResultats = $reponse->rowCount();
		if($nbreResultats > 0) $donneesPage["actionsActuelles"][0]["ficheAction"] = $donnees;
			
	// Si l'action culturelle affichée n'est pas l'action culturelle présente (= mise en avant), il faut également récupérer l'action culturelle présente pour l'ajouter en 
	// 1ère position au caroussel "A voir également" en bas de page (par commodité on l'ajoute dans le tableau $donneesPage["actionsActuelles"], sur l'indice $k=1)
	if($donneesPage["actionsActuelles"][0]["statut"] != "actionPresente")
	{
		$requete = "SELECT * FROM actions_culturelles WHERE statut = 'actionPresente'";
		$reponse = $bdd->query($requete);
		while($donnees = $reponse->fetch())
		{
			$donneesPageActionPresente = $donnees;
		}
		$donneesPage["actionsActuelles"][1] = $donneesPageActionPresente;
		
			//Infos table photos
			$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$donneesPage["actionsActuelles"][1]["ID"]." ORDER BY ID ASC";
			$reponse = $bdd->query($requete);
			$j=0;
			while($donnees = $reponse->fetch())
			{
				$donneesPagePhotosActionPresente[$j] = $donnees;
				$j++;
			}
			$donneesPage["actionsActuelles"][1]["photos"] = $donneesPagePhotosActionPresente;
	}
	
	// Récupération des ID de toutes les actions culturelles actuelles enregistrées (sauf celle qu'on a déjà affichée)
	$idActions = array();
	
	$requete = "SELECT ID FROM actions_culturelles WHERE statut = 'actionActuelle' AND ID != ".$donneesPage["actionsActuelles"][0]["ID"];
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$idActions[] = $donnees["ID"];
	}
	
	// Récupération des infos sur les actions culturelles actuelles / présente
	// Note : si l'action culturelle affichée n'est pas l'action culturelle présente, les autres actions culturelles actuelles suivent derrière l'action culturelle présente
	if(isset($donneesPage["actionsActuelles"][1])) $k=2; // Pour compter le nombre de créations actuelles
	else $k=1;
	foreach($idActions as $id)
		{	
			//Infos table actions culturelles
			$requete = "SELECT * FROM actions_culturelles WHERE active = 1 AND ID = ".$id;
			$reponse = $bdd->query($requete);
			$nbrResultats = $reponse->rowCount();
			if($nbrResultats > 0)
			{
				while($donnees = $reponse->fetch())
				{
					$donneesPageActionsActuelles = $donnees;
				}
				$donneesPage["actionsActuelles"][$k] = $donneesPageActionsActuelles;
					
					//Infos table photos
					$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$id." ORDER BY ID ASC";
					$reponse = $bdd->query($requete);
					$j=0;
					while($donnees = $reponse->fetch())
					{
						$donneesPagePhotosActionsActuelles[$j] = $donnees;
						$j++;
					}
					$donneesPage["actionsActuelles"][$k]["photos"] = $donneesPagePhotosActionsActuelles;
					$k++;
			}
		}
	$reponse->closeCursor();
	
	$nombreActionsActuelles = $k;
	
	// Facebook
	$titleFacebook = "Action culturelle AToU ".$donneesPage["actionsActuelles"][0]["titre"];
	$urlPageFacebook ="http://www.atou.fr/danse-contemporaine-lyon/ficheAction.php?ID=".$donneesPage["actionsActuelles"][0]["ID"];
	$urlImageFacebook = "http://www.atou.fr/photosVignettesLarges/".$donneesPage["actionsActuelles"][0]["photos"][1]["filename"];
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche action culturelle</title>
    
    <!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
	<meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_jf.css" />
    
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
    
    <!-- BXslider -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CHEMIN_SITE;?>/css/bxSliderSite.css" />
    
    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
          
    <!-- Toggle onglets déroulants -->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/toggle.js"></script>
    
    <!--________________________________ Fancy Box ________________________________-->
    
    <!-- Fancy Box -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesFancyBox_rbg.css" />
    
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!--  Code personnalisé fancyBox -->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/fancybox/fancyBox.js"></script> 
    
    <style>
		.nm_hidden{
			display:none;
			}
		.nm_liensArticles:hover{
			color:#81358A!important;
			}
	</style>

	<!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="ficheCreation">

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
                    //define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
                ?>
            	<p class="filAriane"><?php echo '<a href="/'.$lang.'/index">'.$string_lang["FIL_ARIANE_ACCUEIL"][$lang].'</a> &nbsp; > &nbsp; <a href="../actions-artistiques">'.$string_lang["FIL_ARIANE_ACTIONS"][$lang].'</a> &nbsp; > &nbsp; '.$donneesPage["actionsActuelles"][0]["titre"];?></p>
            </div>
			<!--_____________________________________-->
            
            <h1><?php echo $donneesPage["actionsActuelles"][0]["titre"];?></h1>  


           
			<!--____________________________________________Zone 1____________________________________________-->
    
            <div id="zone1"> 
            
            	<div id="imgTacheBlanche">
        			<img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png"/>
        		</div>
                
                <div id="imgTacheBlanche03">
        			<img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc03.png"/>
        		</div>     
                
                        
                
    			<!--________Encadré 1________-->
        
                <div class="cadre1">
                
                    <div class="white big">
                    
                        <h5 class="titreH5"><?php echo $donneesPage["actionsActuelles"][0]["interTitre"];?></h5>	
                        
                        <?php
							// S'il s'agit de l'action actuelle présente, on affiche la 2ème photo
							if($donneesPage["actionsActuelles"][0]["statut"] == "actionPresente")
							{
								
						?>
                        	
                        <img id="ficheCreationShinmu1" src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPage["actionsActuelles"][0]["photos"][1]["filename"];?>" 
	                        alt="<?php echo $donneesPage["actionsActuelles"][0]["photos"][1]["nom"];?>" height="387" />
						
                        <?php
							}
							// Sinon, on affiche la vidéo si elle est enregistrée
							elseif($donneesPage["actionsActuelles"][0]["urlVideo"] != "")
							{
						?>
                            <!--______Début cadre video_____-->
                            
                            <script src="<?php echo CHEMIN_SITE;?>/jquery/hideVideoElements.js" type="text/javascript"></script>
                            
                            
                            <iframe id="player1" 
                                src="http://player.vimeo.com/video/<?php echo $donneesPage["actionsActuelles"][0]["urlVideo"];?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" 
                                width="616" height="439" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                            </iframe>
                            
                            
                            <!--_____Fin cadre vidéo_____-->
                        <?php
							}
							// Sinon on affiche la 2ème photo
							else
							{
						?>
                        	<img id="ficheCreationShinmu1" src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPage["actionsActuelles"][0]["photos"][1]["filename"];?>"
                                alt="<?php echo $donneesPage["actionsActuelles"][0]["photos"][1]["nom"];?>" width="580" height="387" />
                        <?php
                        		echo "<script src='/js/detectionPhoto.js' type='text/javascript'></script>";
							}
						?>
                        
                        <p class="chapo"><?php echo $donneesPage["actionsActuelles"][0]["chapo"];?></p>
                            
                        <p><?php echo $donneesPage["actionsActuelles"][0]["resume"];?></p>
                        
                        <p class="citation"><?php echo $donneesPage["actionsActuelles"][0]["verbatim"];?></p>
                        
                        <p class="signature"><?php echo $donneesPage["actionsActuelles"][0]["verbatimAuteur"];?></p>
                        
                    </div>
                    
                    <a class="partage" href="" title="PARTAGER SUR" 
                        	onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
						<div class="facebook"><?php echo $string_lang["FICHE_ACTION_FACEBOOK"][$lang];?></div>
					</a>
                    
                </div>
        
    			<!--________Fin encadré 1________-->
    
    
    
   				<!--________Encadré 2________-->
    
                <div class="cadre2">
                
					<!--________Call-to-action________-->

                    <a href="<?php echo CHEMIN_SITE.'/'.$lang;?>/contactPro" class="nm_rustine">
                    <div class="callToAction"><?php echo $string_lang["FICHE_ACTION_CONTACT"][$lang];?></div>
                    </a>
                    
                	<!--________Fin Call-to-action________--> 
                    
                    <!--________Encadré pratiques / Onglets déroulants________-->

                    <?php
                    	if(isset($donneesPage["actionsActuelles"][0]["fonctionsCollaborateurs"]))
						{
                    ?>
                    <div id="firstBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_ACTION_DISTRIBUTION"][$lang];?></div>
                        
                        <div class="deroule">
							<?php
                            for($i=0; $i<count($donneesPage["actionsActuelles"][0]["fonctionsCollaborateurs"]); $i++)
                            {
                            ?>
                            <div>
                                <span class="infoGras"><?php echo $donneesPage["actionsActuelles"][0]["fonctionsCollaborateurs"][$i]["metiers"];?> :</span>
                                <span class="infoRom"><?php echo $donneesPage["actionsActuelles"][0]["fonctionsCollaborateurs"][$i]["collaborateurs"];?></span><br />
                            </div>
							<?php
                            }
                            ?>
                          
                        </div>
                    
                    </div>
                    <?php
						}
					?>
                    
                    
					<?php
                    	if(isset($donneesPage["actionsActuelles"][0]["representations"]))
						{
                    ?>
                    <div id="secondBlock2">
						<div class="toggle toggleUp"><?php echo $string_lang["FICHE_ACTION_REPRESENTATION"][$lang];?></div>
                        
                        <div class="deroule">
                            <?php
								for($i=0; $i<count($donneesPage["actionsActuelles"][0]["representations"]); $i++)
								{
                            ?>
                            <div>
                                <span class="infoGras"><?php echo $donneesPage["actionsActuelles"][0]["representations"][$i]["dates"];?></span><br />
                                <span class="infoRom"><?php echo $donneesPage["actionsActuelles"][0]["representations"][$i]["salle"];?>, 
                                	<?php echo $donneesPage["actionsActuelles"][0]["representations"][$i]["ville"]?></span><br />
                                <?php if(isset($donneesPage["actionsActuelles"][0]["representations"][$i]["infos"]))
									  {
								?>
								<span class="infoRom"> <?php echo $donneesPage["actionsActuelles"][0]["representations"][$i]["infos"]?></span><br />
                                <?php
									}
								?>
                            </div>
							<?php
								}
                            ?>
						</div>
                    </div>
                    <?php
						}
					?>

                  
					<?php
                    	if(isset($donneesPage["actionsActuelles"][0]["articles"]) > 0)
						{
                    ?>
                    <div id="thirdBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_ACTION_REVUEPRESSE"][$lang];?></div>
                        
                        <div class="deroule">
                            <div>
                                <span class="infoGras"><?php echo $string_lang["FICHE_CREATION_REVUEPRESSE_ARTICLES"][$lang];?></span><br />
                                
                                <?php
									for($i=0; $i<count($donneesPage["actionsActuelles"][0]["articles"]); $i++)
									{
								?>
								<a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["actionsActuelles"][0]["articles"][$i]["urlArticle"];?>">
                                    <span class="nm_liensArticles infoItal"><?php echo $donneesPage["actionsActuelles"][0]["articles"][$i]["titre"];?></span>
                                </a>    
                                    <span class="infoRom">, <?php echo $donneesPage["actionsActuelles"][0]["articles"][$i]["dates"];?> (pdf)</span><br />
                                <?php
									}
								?>      
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>

                    
                    <?php
                    	if(isset($donneesPage["actionsActuelles"][0]["dossierPresse"]) OR isset($donneesPage["actionsActuelles"][0]["dossierPresseEn"]))
						{
                    ?>
                    <div id="fourthBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_ACTION_DOSSIERPRESSE"][$lang];?></div>
                        
                        <div class="deroule">
                            <div>
                            	<?php
                                	if(isset($donneesPage["actionsActuelles"][0]["dossierPresse"]))
                                	{
                                ?>
                                <a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["actionsActuelles"][0]["dossierPresse"]["urlDossier"];?>">
                                    <span class="nm_liensArticles infoGras"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL"]["fr"];?></span>
                                </a>
                                <span class="infoRom">(pdf)</span><br />
								<?php
	                                }
                                	if(isset($donneesPage["actionsActuelles"][0]["dossierPresseEn"]))
                                	{
                                ?>
                                <a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["actionsActuelles"][0]["dossierPresseEn"]["urlDossier"];?>">
                                    <span class="nm_liensArticles infoGras"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL"]["en"];?></span>
                                </a>
                                <span class="infoRom">(pdf)</span><br />
									<?php
	                                }
	                            ?>
	                            <br />
                                <span class="infoRom"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_PHOTOS_HQ"][$lang];?></span>                    
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                    
                    <!--________Call-to-action________-->

                    <?php
						// S'il s'agit de TransFORME, on propose le DVD
						if($donneesPage["actionsActuelles"][0]['ID'] == 4)
						{
					?>
                    <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/contact"><div class="callToActionContact"><?php echo $string_lang["FICHE_ACTION_CALLTOACTION2"][$lang];?></div></a>
                    <?php
						}
					?>
                    
                	<!--________Fin Call-to-action________-->
                    
					<!--________Fin Encadré pratiques / Onglets déroulants________-->
                    
                    <!--_____Début bloc rappel_____-->
               
					<!-- Fancy Box -->
                  
                    <div class="blocRappel">
                    
                        <img src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][0]["photos"][0]["filename"];?>" alt="image 1" />
                        <h3><?php echo $string_lang["FICHE_ACTION_DIAPO"][$lang]?></h3>
                        <a class="fancybox" rel="group" href="<?php echo CHEMIN_SITE;?>/photosFancybox/<?php echo $donneesPage["actionsActuelles"][0]["photos"][0]["filename"];?>">
                            <div id="lienRustine" class="lien"><?php echo $string_lang["FICHE_ACTION_LIENCARTOUCHE"][$lang];?></div>
                        </a>
                    
                    </div>     
					<?php
						for($i=1; $i<count($donneesPage["actionsActuelles"][0]["photos"]); $i++)
						{
					?>
                    
                    <div class="blocRappel nm_hidden">
                    
                        <img src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][0]["photos"][$i]["filename"];?>" alt="image 1" />
                        <h3><?php echo $string_lang["FICHE_ACTION_DIAPO"][$lang]?></h3>
                        <a class="fancybox" rel="group" href="<?php echo CHEMIN_SITE;?>/photosFancybox/<?php echo $donneesPage["actionsActuelles"][0]["photos"][$i]["filename"];?>">
                            <div id="lienRustine" class="lien"><?php echo $string_lang["FICHE_ACTION_LIENCARTOUCHE"][$lang];?></div>
                        </a>

					</div>     
                  	<?php
						}
					?>
                 	<!-- Fin Fancy Box -->
                    
					<!--_____Fin bloc rappel_____-->
                    
      
                    
                </div>
                
   				 <!--________Fin Encadré 2________-->
             
			</div>
   			<!--____________________________________________Fin Zone 1____________________________________________-->
    
   			<br class="annule"/>
 
			<?php
            	// S'il y a des données sur "Autour de l'action culturelle", on les affiche
				if(isset($donneesPage["actionsActuelles"][0]["notesTitre"]) AND $donneesPage["actionsActuelles"][0]["notesTitre"] != ""
					AND isset($donneesPage["actionsActuelles"][0]["notesTexte"]) AND $donneesPage["actionsActuelles"][0]["notesTexte"] != "")
            	{
			?>
            <!--____________________________________________Zone 2____________________________________________-->
    
            <div id="zone2">          
                
    			<!--________Encadré 1________-->
        
                <div class="cadre1">            
            
                    <div class="white big">
                    
                        <h5><?php echo $string_lang["FICHE_ACTION_AUTOUR"][$lang];?></h5> 
                        
                        <?php
							// S'il s'agit de l'action actuelle présente, on affiche la 3ème photo
							if($donneesPage["actionsActuelles"][0]["statut"] == "actionPresente")
							{
									
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][0]["photos"][2]["filename"];?>" 
                        	alt="<?php echo $donneesPage["actionsActuelles"][0]["photos"][2]["nom"];?>" width="300" />
                        <?php
							}
							// Sinon, si la vidéo est enregistrée, on affiche la 2ème photo
							elseif($donneesPage["actionsActuelles"][0]["urlVideo"] != "")
							{
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][0]["photos"][2]["filename"];?>" 
                        	alt="<?php echo $donneesPage["actionsActuelles"][0]["photos"][2]["nom"];?>" width="300" />
                        <?php
							}
							// Sinon on affiche la 3ème photo
							else
							{
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][0]["photos"]["2"]["filename"];?>" 
                        	alt="<?php echo $donneesPage["actionsActuelles"][0]["photos"]["2"]["nom"];?>" width="300" />
                        <?php
							}
						?>
                        <p><?php echo $donneesPage["actionsActuelles"][0]["notesTitre"];?></p>
                        
                        <p class="citation"><?php echo $donneesPage["actionsActuelles"][0]["notesTexte"];?></p>
        
						<p class="signature"><?php echo $donneesPage["actionsActuelles"][0]["notesAuteur"];?></p>
                            
                    </div>
                                  
                </div>
        
    			<!--________Fin encadré 1________-->
                
         
			</div>
			<!--____________________________________________Fin Zone 2____________________________________________-->
			<?php
				}
			?>
            
			<br class="annule"/>   
            
            <!--____________________________________________Zone 3____________________________________________-->
    
            <div id="zone3">
                
                <!--_____Début de la cadre 2_____-->
                
                <div class="cadre2">
                
					<?php
                        // S'il y a au moins 1 action culturelle actuelle (en plus de l'action présente) avec un statut actif (= avec au moins une photo), on affiche le slider
                        if(isset($donneesPage["actionsActuelles"]) AND count($donneesPage["actionsActuelles"]) > 1 
                            AND (isset($donneesPage["actionsActuelles"][1]) AND $donneesPage["actionsActuelles"][1]["active"] == 1))
                        {
                    ?>
                    <h2><?php echo $string_lang["FICHE_ACTION_VOIRAUSSI"][$lang];?></h2>
        	
           	 		<!--_____Début du slider 1_____-->
           			
                    <div class="sliderContainer">
             
                            <ul class="bxSlider">
                                <?php
									// On commence à 1 car une action culturelle est déjà affichée sur la page
                                    for($i=1; $i<$nombreActionsActuelles; $i++)
                                    {
										if($donneesPage["actionsActuelles"][$i]["active"] == 1)
										{
                                ?>
                                <li>
                                    <div class="black">   
                                        <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][$i]["photos"][0]["filename"];?>" 
                                        	alt="<?php echo $donneesPage["actionsActuelles"][$i]["photos"][0]["nom"];?>" />
                                        <h3><?php echo $donneesPage["actionsActuelles"][$i]["titre"];?></h3>
                                    </div>       
                                    
                                    <div class="cartouche">     
                                        <h4><?php echo $donneesPage["actionsActuelles"][$i]["anneeCreation"];?></h4>
                                        <p><?php echo $donneesPage["actionsActuelles"][$i]["accroche"];?></p>
                                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/actions-artistiques/<?php echo $donneesPage["actionsActuelles"][$i]["urlRewrite"]."-".$donneesPage["actionsActuelles"][$i]["ID"];?>"><div class="lien">
                                        	<?php echo $string_lang["FICHE_ACTION_INFO"][$lang];?></div></a>
                                    </div>
                                </li>
                                <?php
										}
									}
                                ?>
                             </ul>
                            
					</div>
                      
                    <!--_____Fin du slider_____--> 
                    <?php
						}
					?>    
        
				</div>
                                    
				<!--_____Fin du cadre 2_____-->
                                            	    
            </div>  
                  
            <!--____________________________________________Fin Zone 3____________________________________________-->
            
                    
        </section>

        <!--____________________________________________Fin SECTION____________________________________________--> 

	</div>
    
    <!--____________________________________________Fin FOND NOIR____________________________________________--> 
     

    
    
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
    
    <!--Player Vimeo-->
	<script src="<?php echo CHEMIN_SITE;?>/jquery/vimeoPlayer.js" type="text/javascript"></script>
    
    <!--Bouton super top-->
	<script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>
    
    <!-- Add BxSlider -->
	<script src="<?php echo CHEMIN_SITE;?>/jquery/bxSlider2.js"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>

</body>
</html>