<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion du fil d'Ariane
	include('../inc/fonctionFilArianne.inc.php');
	// Gestion des constantes	
	require_once("../inc/constantes.inc.php");
	// Autres
	require_once('../admin/tools/toolsDateTime.php');
	
	// Gestion des langues (champs "statiques" du front-office)
	include("../lang/langTools/lang.inc.php");
	require("../lang/lang.php");
	
	// On récupère l'ID de la création
	if(isset($_GET["ID"])) $id = $_GET["ID"];
	else
	{
		// S'il n'y a rien à récupérer, on redirige vers la liste des créations
		header("Location:listeCreations.php");
	}
	
	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
	// Récupération des infos de la création affichée
	$requete = ($lang == "en") ? "SELECT * FROM creations_en WHERE ID = " .$id : "SELECT * FROM creations WHERE ID = " .$id;
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$donneesPageCreaAffichee = $donnees;
	}
	
	$donneesPage["creationsActuelles"][0] = $donneesPageCreaAffichee;
			
	// Si la création est une création archivée, on vérifie que l'utilisateur est loggé
	if($donneesPage["creationsActuelles"][0]["statut"] == "creationArchivee")
	{
		if(!isset($_SESSION["adherentID"])) header("Location:/fr/creations");
	}
	
		//Infos table photos
		$requete = "SELECT * FROM photos WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"]." ORDER BY ID ASC";
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$donneesPagePhotosCreaAffichee[$j] = $donnees;
			$j++;
		}
		$donneesPage["creationsActuelles"][0]["photos"] = $donneesPagePhotosCreaAffichee;
		
		//Infos tables collaborateurs / fonctions
		if($lang == "en")
  		{
			$requete = "SELECT fonctions_en.metiers, GROUP_CONCAT(' ', collaborateurs.prenom, ' ', collaborateurs.nom) AS 'collaborateurs' FROM fo_col
				JOIN fonctions_en ON fonctions_en.ID = fo_col.fonctionsID
				JOIN collaborateurs ON collaborateurs.ID = fo_col.collaborateursID
				WHERE fo_col.creationsID = " . $donneesPage["creationsActuelles"][0]["ID"] . " 
				GROUP BY fonctions_en.metiers" or die(print_r($bdd->errorInfo));
		}
		else
		{
			$requete = "SELECT fonctions.metiers, GROUP_CONCAT(' ', collaborateurs.prenom, ' ', collaborateurs.nom) AS 'collaborateurs' FROM fo_col
				JOIN fonctions ON fonctions.ID = fo_col.fonctionsID
				JOIN collaborateurs ON collaborateurs.ID = fo_col.collaborateursID
				WHERE fo_col.creationsID = " . $donneesPage["creationsActuelles"][0]["ID"] . " 
				GROUP BY fonctions.metiers" or die(print_r($bdd->errorInfo));
		}
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"][$j] = $donnees;
			$j++;
		}
		
		//Infos table représentations
		$requete = "SELECT * FROM representations WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"]." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$dates = dateHeureInfos($donnees["dates"]);
			$donnees["dates"] = $dates["date"]; // On met la date au bon format
			$donneesPage["creationsActuelles"][0]["representations"][$j] = $donnees;
			$j++;
		}
		
		//Infos table revue de presse
		$requete = "SELECT * FROM articles WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"]." ORDER BY dates ASC" or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$datesArticles = dateHeureInfos($donnees["dates"]); // On met la date au bon format
			$donnees["dates"] = $datesArticles["date"];
			$donneesPage["creationsActuelles"][0]["articles"][$j] = $donnees;
			$j++;
		}
		
		//Infos tables dossier de presse
		$requete = "SELECT * FROM dossier_presse WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$donnees = $reponse->fetch();
		$nbreResultats = $reponse->rowCount();
		if($nbreResultats > 0) $donneesPage["creationsActuelles"][0]["dossierPresse"] = $donnees;

		$requeteEn = "SELECT * FROM dossier_presse_en WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponseEn = $bdd->query($requeteEn);
		$donneesEn = $reponseEn->fetch();
		$nbreResultats = $reponseEn->rowCount();
		if($nbreResultats > 0) $donneesPage["creationsActuelles"][0]["dossierPresseEn"] = $donneesEn;
			
		//Infos table fiche
		$requete = "SELECT * FROM fiche WHERE creationsID = ".$donneesPage["creationsActuelles"][0]["ID"] or die(print_r($bdd->errorInfo));
		$reponse = $bdd->query($requete);
		$donnees = $reponse->fetch();
		$nbreResultats = $reponse->rowCount();
		if($nbreResultats > 0) $donneesPage["creationsActuelles"][0]["ficheCreation"] = $donnees;
			
	// Si la création affichée n'est pas la création présente (= mise en avant), il faut également récupérer la création présente pour l'ajouter en 
	// 1ère position au caroussel "A voir également" en bas de page (par commodité on l'ajoute dans le tableau $donneesPage["creationsActuelles"], sur l'indice $k=1)
	if($donneesPage["creationsActuelles"][0]["statut"] != "creationPresente")
	{
		$requete = "SELECT * FROM creations WHERE statut = 'creationPresente'";
		$reponse = $bdd->query($requete);
		while($donnees = $reponse->fetch())
		{
			$donneesPageCreaPresente = $donnees;
		}
		$donneesPage["creationsActuelles"][1] = $donneesPageCreaPresente;
		
			//Infos table photos
			$requete = "SELECT * FROM photos WHERE creationsID = ".$donneesPage["creationsActuelles"][1]["ID"]." ORDER BY ID ASC";
			$reponse = $bdd->query($requete);
			$j=0;
			while($donnees = $reponse->fetch())
			{
				$donneesPagePhotosCreaPresente[$j] = $donnees;
				$j++;
			}
			$donneesPage["creationsActuelles"][1]["photos"] = $donneesPagePhotosCreaPresente;
	}
	
	// Récupération des ID de toutes les créations actuelles enregistrées (sauf celle qu'on a déjà affichée)
	$idCreations = array();
	
	$requete = "SELECT ID FROM creations WHERE statut = 'creationActuelle' AND ID != ".$donneesPage["creationsActuelles"][0]["ID"];
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$idCreations[] = $donnees["ID"];
	}
	
	// Récupération des infos sur les créations actuelles / présente
	// Note : si la création affichée n'est pas la création présente, les autres créations actuelles suivent derrière la création présente
	if(isset($donneesPage["creationsActuelles"][1])) $k=2; // Pour compter le nombre de créations actuelles
	else $k=1;
	foreach($idCreations as $id)
	{	
		//Infos table creations
		$requete = "SELECT * FROM creations WHERE active = 1 AND ID = ".$id;
		$reponse = $bdd->query($requete);
		$nbrResultats = $reponse->rowCount();
		if($nbrResultats > 0)
		{
			while($donnees = $reponse->fetch())
			{
				$donneesPageCreasActuelles = $donnees;
			}
			$donneesPage["creationsActuelles"][$k] = $donneesPageCreasActuelles;
				
				//Infos table photos
				$requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
				$reponse = $bdd->query($requete);
				$j=0;
				while($donnees = $reponse->fetch())
				{
					$donneesPagePhotosCreasActuelles[$j] = $donnees;
					$j++;
				}
				$donneesPage["creationsActuelles"][$k]["photos"] = $donneesPagePhotosCreasActuelles;
				$k++;
		}
	}
	$reponse->closeCursor();
	
	$nombreCreationsActuelles = $k;
	
	// Facebook
	$titleFacebook = "Création AToU ".$donneesPage["creationsActuelles"][0]["titre"];
	$urlPageFacebook ="http://www.atou.fr/danse-contemporaine-lyon/ficheCreation.php?ID=".$donneesPage["creationsActuelles"][0]["ID"];
	$urlImageFacebook = "http://www.atou.fr/photosVignettesLarges/".$donneesPage["creationsActuelles"][0]["photos"][1]["filename"];
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Fiche création</title>
    
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
                <p class="filAriane"><?php echo '<a href="/'.$lang.'/index">'.$string_lang["FIL_ARIANE_ACCUEIL"][$lang].'</a> &nbsp; > &nbsp; <a href="/'.$lang.'/creations">'.$string_lang["FIL_ARIANE_CREATIONS"][$lang].'</a> &nbsp; > &nbsp; '.$donneesPage["creationsActuelles"][0]["titre"];?></p>
            </div>
			<!--_____________________________________-->
           
            <h1><?php echo $donneesPage["creationsActuelles"][0]["titre"];?></h1>  
           
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
                
                    <!--<h3 class="black">Danser l'invisible</h3>-->
                
                    <div class="white big">
                        
                        <h5 class="titreH5"><?php echo $donneesPage["creationsActuelles"][0]["interTitre"];?></h5> 
                 
						<?php
							// S'il s'agit de la création présente, on affiche la 2ème photo
							if($donneesPage["creationsActuelles"][0]["statut"] == "creationPresente")
							{
								
                        ?>
						
                        <img id="ficheCreationShinmu1" src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["filename"];?>"
                            alt="<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["nom"];?>" height="387" />
                       
                        <?php
							}
							// Sinon, on affiche la vidéo (si elle est enregistrée)
							elseif($donneesPage["creationsActuelles"][0]["urlVideo"] != "")
							{
						?>
                            <!--______Début cadre video_____-->
                            
                            <script src="<?php echo CHEMIN_SITE;?>/jquery/hideVideoElements.js" type="text/javascript"></script>
                            
                            
                            <iframe id="player1" 
                                src="http://player.vimeo.com/video/<?php echo $donneesPage["creationsActuelles"][0]["urlVideo"];?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" 
                                width="616" height="439" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                            </iframe>
                            
                            
                            <!--_____Fin cadre vidéo_____-->
                        <?php
							}
							// Sinon on affiche la 2ème photo
							else
							{
						?>
                        	<img id="ficheCreationShinmu1" src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["filename"];?>"
                                alt="<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["nom"];?>" width="580" height="387" />
                        <?php
                        	echo "<script src='".CHEMIN_SITE."/js/detectionPhoto.js' type='text/javascript'></script>";
							}
						?>
                        
                        <p class="chapo"><?php echo $donneesPage["creationsActuelles"][0]["chapo"];?></p>
                        
                        <p><?php echo $donneesPage["creationsActuelles"][0]["resume"];?></p>
                        
                        <!--<p>Le plateau ne s’habille que de tulle sur cette pièce, pour mieux se draper de projections numériques, accentuant l’imaginaire et l’irréel des corps des trois danseurs en mouvement.</p>-->
                        
                        <p class="citation"><?php echo $donneesPage["creationsActuelles"][0]["verbatim"];?></p>
                        
                        <p class="signature"><?php echo $donneesPage["creationsActuelles"][0]["verbatimAuteur"];?></p>
                        
                    </div>
                    
                    <a class="partage" href="" title="PARTAGER SUR" 
                        	onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
						<div class="facebook"><?php echo $string_lang["FICHE_CREATION_FACEBOOK"][$lang];?>
                        </div>
                    </a>
  
                </div>
        
    			<!--________Fin encadré 1________-->
    
    
    
   				<!--________Encadré 2________-->
    
                <div class="cadre2">
                
					<!--________Call-to-action________-->

                    <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/contactPro" class="nm_rustine"><div class="callToAction"><?php echo $string_lang["FICHE_CREATION_CONTACT"][$lang];?></div></a>
                    
                	<!--________Fin Call-to-action________--> 
                
                
                   
					<!--________Cartouche________-->
            
           	  		<div class="cartouche_nm"> 
                        <h4><?php echo $donneesPage["creationsActuelles"][0]["type"]." ".$donneesPage["creationsActuelles"][0]["anneeCreation"];?></h4>
                        <time class="time"><?php echo $donneesPage["creationsActuelles"][0]["duree"];?></time>
                        <p><?php echo $donneesPage["creationsActuelles"][0]["accroche"];?></p>
            		</div>
                    
					<!--________Fin Cartouche________-->

                    
                    <!--________Encadré pratiques / Onglets déroulants________-->

                    <?php
                    	if(isset($donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"]))
						{
                    ?>
                    <div id="firstBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_CREATION_DISTRIBUTION"][$lang];?></div>
                        
                        <div class="deroule">
							<?php
                            for($i=0; $i<count($donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"]); $i++)
                            {
                            ?>
                            <div>
                                <span class="infoGras"><?php echo $donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"][$i]["metiers"];?> :</span>
                                <span class="infoRom"><?php echo $donneesPage["creationsActuelles"][0]["fonctionsCollaborateurs"][$i]["collaborateurs"];?></span><br />
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
                    	if(isset($donneesPage["creationsActuelles"][0]["representations"]))
						{
                    ?>
                    <div id="secondBlock2">
						<div class="toggle toggleUp"><?php echo $string_lang["FICHE_CREATION_REPRESENTATION"][$lang];?></div>
                        
                        <div class="deroule">
                            <?php
								for($i=0; $i<count($donneesPage["creationsActuelles"][0]["representations"]); $i++)
								{
                            ?>
                            <div>
                                <span class="infoGras"><?php echo $donneesPage["creationsActuelles"][0]["representations"][$i]["dates"];?></span><br />
                                <span class="infoRom"><?php echo $donneesPage["creationsActuelles"][0]["representations"][$i]["salle"];?>, 
                                	<?php echo $donneesPage["creationsActuelles"][0]["representations"][$i]["ville"]?></span><br />
                                <?php if(isset($donneesPage["creationsActuelles"][0]["representations"][$i]["infos"]))
									  {
								?>
								<span class="infoRom"> <?php echo $donneesPage["creationsActuelles"][0]["representations"][$i]["infos"]?></span><br />
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
                    	if(isset($donneesPage["creationsActuelles"][0]["articles"]) > 0)
						{
                    ?>
                    <div id="thirdBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_CREATION_REVUEPRESSE"][$lang];?></div>
                        
                        <div class="deroule">
                            <div>
                                <span class="infoGras"><?php echo $string_lang["FICHE_CREATION_REVUEPRESSE_ARTICLES"][$lang];?></span><br />
                                
                                <?php
									for($i=0; $i<count($donneesPage["creationsActuelles"][0]["articles"]); $i++)
									{
								?>
								<a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["creationsActuelles"][0]["articles"][$i]["urlArticle"];?>">
                                    <span class="nm_liensArticles infoItal"><?php echo $donneesPage["creationsActuelles"][0]["articles"][$i]["titre"];?></span>
                                </a>
                                <span class="infoRom">, <?php echo $donneesPage["creationsActuelles"][0]["articles"][$i]["dates"];?> (pdf)</span><br />
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
                    	if(isset($donneesPage["creationsActuelles"][0]["dossierPresse"]) OR isset($donneesPage["creationsActuelles"][0]["dossierPresseEn"]))
						{
                    ?>
                    <div id="fourthBlock2">
                        <div class="toggle toggleUp"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE"][$lang];?></div>
                        
                        <div class="deroule">
                            <div>
                                <?php
                                	if(isset($donneesPage["creationsActuelles"][0]["dossierPresse"]))
                                	{
                                ?>
                                <a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["creationsActuelles"][0]["dossierPresse"]["urlDossier"];?>">
                                    <span class="nm_liensArticles infoGras"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL"][$lang];?></span>
                                </a>    
                                <span class="infoRom">(pdf <?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL_FR_INFO"][$lang];?>)</span><br />
                                <?php
	                                }
                                	if(isset($donneesPage["creationsActuelles"][0]["dossierPresseEn"]))
                                	{
                                ?>
                                <a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["creationsActuelles"][0]["dossierPresseEn"]["urlDossier"];?>">
                                    <span class="nm_liensArticles infoGras"><?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL"][$lang];?></span>
                                </a>    
                                <span class="infoRom">(pdf <?php echo $string_lang["FICHE_CREATION_DOSSIERPRESSE_DL_EN_INFO"][$lang];?>)</span><br />
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
                    	if(isset($donneesPage["creationsActuelles"][0]["ficheCreation"]) > 0)
						{
                    ?>
                    <a href="<?php echo CHEMIN_SITE;?>/pdf/<?php echo $donneesPage["creationsActuelles"][0]["ficheCreation"]["urlFiche"];?>">
                    	<div class="callToAction2"><?php echo $string_lang["FICHE_CREATION_FICHE"][$lang];?></div>
                    </a>
                    <?php
						}
					?>
                    
                	<!--________Fin Call-to-action________-->
                    
					<!--________Fin Encadré pratiques / Onglets déroulants________-->
                    
                   	<!--_____Début bloc rappel_____-->
               
					<!-- Fancy Box -->
                  
                  	<?php
                    	if(count($donneesPage["creationsActuelles"][0]["photos"]) > 0)
						{
                    ?>
                    <div class="blocRappel">
                        <img src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][0]["photos"][0]["filename"];?>" alt="image 1" width="296" />
                        <h3><?php echo $string_lang["FICHE_CREATION_DIAPO"][$lang]?></h3>
                        <a class="fancybox" rel="group" href="<?php echo CHEMIN_SITE;?>/photosFancybox/<?php echo $donneesPage["creationsActuelles"][0]["photos"][0]["filename"];?>">
                            <div id="lienRustine" class="lien"><?php echo $string_lang["FICHE_CREATION_LIENCARTOUCHE"][$lang];?></div>
                        </a>
                    
                    </div>     
					<?php
							for($i=1; $i<count($donneesPage["creationsActuelles"][0]["photos"]); $i++)
							{
					?>
                    
                    <div class="blocRappel nm_hidden">
                    
                        <img src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][0]["photos"][$i]["filename"];?>" alt="image 1" />
                        <h3><?php echo $string_lang["FICHE_CREATION_DIAPO"][$lang]?></h3>
                        <a class="fancybox" rel="group" href="<?php echo CHEMIN_SITE;?>/photosFancybox/<?php echo $donneesPage["creationsActuelles"][0]["photos"][$i]["filename"];?>">
                            <div id="lienRustine" class="lien"><?php echo $string_lang["FICHE_CREATION_LIENCARTOUCHE"][$lang];?></div>
                        </a>

					</div>     
                  	<?php
							}
						}
					?>
                 <!-- Fin Fancy Box -->
                    
                <!--_____Fin bloc rappel_____-->
                    
      
                    
                </div>
                
   				 <!--________Fin Encadré 2________-->
             
			</div>
   			<!--____________________________________________Fin Zone 1____________________________________________-->
    
   			<!--<br class="annule"/>-->
 
			<?php
            	// S'il y a des données sur "Autour de la création", on les affiche
				if(isset($donneesPage["creationsActuelles"][0]["notesTitre"]) AND $donneesPage["creationsActuelles"][0]["notesTitre"] != ""
					AND isset($donneesPage["creationsActuelles"][0]["notesTexte"]) AND $donneesPage["creationsActuelles"][0]["notesTexte"] != "")
            	{
			?>
            <!--____________________________________________Zone 2____________________________________________-->
    
            <div id="zone2">          
                
    			<!--________Encadré 1________-->
        
                <div class="cadre1">            
            
            		<div class="white big">
                    
                    	<h5><?php echo $string_lang["FICHE_CREATION_AUTOUR"][$lang];?></h5> 
                        
                        <?php
							// S'il s'agit de la création présente, on affiche la 3ème photo
							if($donneesPage["creationsActuelles"][0]["statut"] == "creationPresente")
							{
									
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][0]["photos"][2]["filename"];?>" 
                        	alt="<?php echo $donneesPage["creationsActuelles"][0]["photos"][2]["nom"];?>" width="300" />
                         <?php
							}
							// Sinon, si la vidéo est enregistrée, on affiche la 2ème photo
							elseif($donneesPage["creationsActuelles"][0]["urlVideo"] != "")
							{
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["filename"];?>" 
                        	alt="<?php echo $donneesPage["creationsActuelles"][0]["photos"][1]["nom"];?>" width="300" />
                        <?php
							}
							// Sinon on affiche la 3ème photo
							else
							{
						?>
                        <img id="ficheCreationShinmu2" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][0]["photos"][2]["filename"];?>" 
                        	alt="<?php echo $donneesPage["creationsActuelles"][0]["photos"][2]["nom"];?>" width="300" />
                        <?php
							}
						?>
                        
                        <p><?php echo $donneesPage["creationsActuelles"][0]["notesTitre"];?></p>
                        
                        <p class="citation"><?php echo $donneesPage["creationsActuelles"][0]["notesTexte"];?></p>
        				
						<p class="signature"><?php echo $donneesPage["creationsActuelles"][0]["notesAuteur"];?></p>	 
                      
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
                        // S'il y a au moins 1 création actuelle (en plus de la création présente) avec un statut actif (= avec au moins une photo), on affiche le slider
                        if(isset($donneesPage["creationsActuelles"]) AND count($donneesPage["creationsActuelles"]) > 1 
                            AND (isset($donneesPage["creationsActuelles"][1]) AND $donneesPage["creationsActuelles"][1]["active"] == 1))
                        {
                    ?>
                    <h2><?php echo $string_lang["FICHE_CREATION_VOIRAUSSI"][$lang];?></h2>
        	
           	 		<!--_____Début du slider 1_____-->
           			
                    <div class="sliderContainer">
             
                            <ul class="bxSlider">
                                <?php
									// On commence à 1 car une création est déjà affichée sur la page
                                    for($i=1; $i<$nombreCreationsActuelles; $i++)
                                    {
										if($donneesPage["creationsActuelles"][$i]["active"] == 1)
										{
                                ?>
                                <li>
                                    <div class="black">   
                                        <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][$i]["photos"][0]["filename"];?>" 
                                        	alt="<?php echo $donneesPage["creationsActuelles"][$i]["photos"][0]["nom"];?>" />
                                        <h3><?php echo $donneesPage["creationsActuelles"][$i]["titre"];?></h3>
                                    </div>       
                                    
                                    <div class="cartouche">     
                                        <h4><?php echo $donneesPage["creationsActuelles"][$i]["type"] . " " . $donneesPage["creationsActuelles"][$i]["anneeCreation"];?></h4>
                                        <time class="time"><?php echo $donneesPage["creationsActuelles"][$i]["duree"];?></time>
                                        <p><?php echo $donneesPage["creationsActuelles"][$i]["accroche"];?></p>
                                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationsActuelles"][$i]["urlRewrite"]."-".$donneesPage["creationsActuelles"][$i]["ID"];?>"><div class="lien">
                                        	<?php echo $string_lang["FICHE_CREATION_INFO"][$lang];?></div></a>
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