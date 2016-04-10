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
		
	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */

	// Récupération des ID de toutes les actions culturelles enregistrées
	$idCreations = array();
	
	$requete = "SELECT ID FROM actions_culturelles";
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$idActions[] = $donnees["ID"];
	}
	
	// Récupération des infos sur les actions culturelles
	
	$k=0; // Pour compter le nombre d'actions actuelles
	$l=0; // Pour compter le nombre d'actions précédentes
	foreach($idActions as $id)
		{	
			//Infos table actions_culturelles
            $requete = ($lang == "en") ? "SELECT * FROM actions_culturelles_en WHERE ID = ".$id : "SELECT * FROM actions_culturelles WHERE ID = ".$id;
			$reponse = $bdd->query($requete);
			while($donnees = $reponse->fetch())
			{
				$donneesPageAction = $donnees;
			}
			
			// S'il s'agit de l'action culturelle présente, on enregistre ses infos dans le tableau $donneesPage["actionPresente"]
			if($donneesPageAction["statut"] == "actionPresente" AND $donneesPageAction["active"] == 1)
			{
				$donneesPage["actionPresente"] = $donneesPageAction;
				
				//Infos table photos
				$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$id." ORDER BY ID ASC";
				$reponse = $bdd->query($requete);
				$j=0;
				while($donnees = $reponse->fetch())
				{
					$donneesPagePhotosActionPresente[$j] = $donnees;
					$j++;
				}
				$donneesPage["actionPresente"]["photos"] = $donneesPagePhotosActionPresente;
			}
			
			// S'il s'agit de l'action culturelle à venir, on enregistre ses infos dans le tableau $donneesPage["actionAvenir"]
			if($donneesPageAction["statut"] == "actionAvenir" AND $donneesPageAction["active"] == 1)
			{
				$donneesPage["actionAvenir"] = $donneesPageAction;
			
				//Infos table photos
				$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$id." ORDER BY ID ASC";
				$reponse = $bdd->query($requete);
				$j=0;
				while($donnees = $reponse->fetch())
				{
					$donneesPagePhotosActionAvenir[$j] = $donnees;
					$j++;
				}
				$donneesPage["actionAvenir"]["photos"] = $donneesPagePhotosActionAvenir;
			}
			
			// S'il s'agit d'une action culturelle actuelle, on enregistre ses infos dans le tableau $donneesPage["actionsActuelles"]
			if($donneesPageAction["statut"] == "actionActuelle" AND $donneesPageAction["active"] == 1)
			{
				$donneesPage["actionsActuelles"][$k] = $donneesPageAction;
				
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
				unset($donneesPagePhotosActionsActuelles); // Car tableau susceptible d'être créé plusieurs fois
				$k++;
			}
			$nombreActionsActuelles = $k;
			
			// S'il s'agit d'une action culturelle passée, on enregistre ses infos dans le tableau $donneesPage["actionsPrecedentes"]
			if($donneesPageAction["statut"] == "actionPrecedente" AND $donneesPageAction["active"] == 1)
			{
				$donneesPage["actionsPrecedentes"][$l] = $donneesPageAction;
				
				//Infos table photos
				$requete = "SELECT * FROM photos WHERE actions_culturellesID = ".$id." ORDER BY ID ASC";
				$reponse = $bdd->query($requete);
				$j=0;
				while($donnees = $reponse->fetch())
				{
					$donneesPagePhotosActionsPrecedentes[$j] = $donnees;
					$j++;
				}
				$donneesPage["actionsPrecedentes"][$l]["photos"] = $donneesPagePhotosActionsPrecedentes;
				unset($donneesPagePhotosActionsPrecedentes); // Car tableau susceptible d'être créé plusieurs fois
				$l++;
			}
			$nombreActionsPrecedentes = $l;
		}
	$reponse->closeCursor();
	
	/*echo "<pre>";
	print_r($donneesPage);
	echo "</pre>";*/
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Les actions culturelles</title>
        
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
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/css/bxSliderSite.css" type="text/css" media="screen"/>
    
    <!-- Add jQuery library -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- Froogaloop js library for calling Vimeo's API -->
    <script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
        
	<style>
        #listeActions #zone1 h3{
            left: -80px;
            position: absolute;
            top: -20px;
        }
    </style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="listeActions">

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
            
            <!--___________ Fil d'Arianne ___________-->
            <div class="filaire">
                <?php
                    define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["LISTE_ACTIONS_FIL_ARIANE"][$lang]), $lang);?></p>
            </div>
            <!--_________________________________-->
        
            <h1><?php echo $string_lang["LISTE_ACTIONS_H1"][$lang];?></h1>
        
             <!--_____Zone 1_____-->	
            
            <div id="zone1">
            
                <div class="imgTacheBlanche">
                        <img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png" alt="toto"/>
                </div>
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre1">
                            
                    <h3 id="nomCrea" class="black"><?php echo $donneesPage["actionPresente"]["titre"];?></h3>		
                    <!--_____Cartouche_____-->
                
                    <div class="cartouche">
                        <!--<h4><?php //echo $donneesPage["actionPresente"]["accroche"];?></h4>-->                 
                        <p><?php echo $donneesPage["actionPresente"]["accroche"];?></p>
                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/actions-artistiques/<?php echo $donneesPage["actionPresente"]["urlRewrite"]."-".$donneesPage["actionPresente"]["ID"];?>"><div class="lien">
                                    <?php echo $string_lang["LISTE_ACTIONS_INFO"][$lang];?></div></a>
                    </div>
                           
                    <!--_____Fin du cartouche_____-->
                
                    <div class="pictoPlayVideo">
                          <img src="<?php echo CHEMIN_SITE;?>/img/communPictoVideo.png" alt="video" width="70" height="70" />
                    </div>
                     
                    <!--______Début cadre video_____-->
                        
                    <div class="black">
                        <iframe id="player1" 
                            src="http://player.vimeo.com/video/<?php echo $donneesPage["actionPresente"]["urlVideo"];?>?title=0&amp;player_id=player1&amp;byline=0&amp;portrait=0&amp;color=ffffff" 
                            width="780" height="439" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                        </iframe>
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
    
            <!--_____Début de la zone 2_____-->
        
            <div class="zone2">
            
            <!--_____Début de la cadre 2_____-->
            
                <div class="cadre2">
                
                    <?php
                        // S'il y a au moins 1 action culturelle actuelle avec un statut actif (= avec au moins une photo), on affiche le slider
                        if(isset($donneesPage["actionsActuelles"]) AND count($donneesPage["actionsActuelles"]) > 0 
                            AND (isset($donneesPage["actionsActuelles"][0]) AND $donneesPage["actionsActuelles"][0]["active"] == 1))
                        {
                    ?>
                    
                    <h2><?php echo $string_lang["LISTE_ACTIONS_ACTIONS_ACTUELLES"][$lang];?></h2>
                    
                    <!--_____Début du slider 1_____-->
                            
                    <div class="sliderContainer">
             
                        <ul class="bxSlider">
                            <?php
                                for($i=0; $i<$nombreActionsActuelles; $i++)
                                {
                                    if($donneesPage["actionsActuelles"][$i]["active"] == 1)
                                    {
                            ?>
                            <li>
                                <div class="black">   
                                    <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsActuelles"][$i]["photos"][0]["filename"];?>" 
                                        alt="<?php echo $donneesPage["actionsActuelles"][$i]["photos"][0]["nom"];?>" width="296" height="196" />
                                    <h3><?php echo $donneesPage["actionsActuelles"][$i]["titre"];?></h3>
                                </div>       
                                
                                <div class="cartouche">     
                                    <h4><?php echo /*$donneesPage["actionsActuelles"][$i]["type"] . " " . */$donneesPage["actionsActuelles"][$i]["anneeCreation"];?></h4>
                                    <!--<time class="time"><?php //echo $donneesPage["actionsActuelles"][$i]["duree"];?></time>-->
                                    <p><?php echo $donneesPage["actionsActuelles"][$i]["accroche"];?></p>
                                    <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/actions-artistiques/<?php echo $donneesPage["actionsActuelles"][$i]["urlRewrite"]."-".$donneesPage["actionsActuelles"][$i]["ID"];?>"><div class="lien">
                                        <?php echo $string_lang["LISTE_ACTIONS_INFO"][$lang];?></div></a>
                                </div>
                            </li>
                            <?php
                                    }
                                }
                            ?>
                         </ul>
                        
                    </div>                       
                              
                    <!--_____Fin du slider 1_____--> 
                      
                    <?php
                        }
                    ?>
                </div>
                            
                <!--_____Fin du cadre 2_____-->
                            
            </div>  
                  
            <!--_____Fin de la zone 2_____-->
            
            <br class="annule"/> 
        
		</section>
        
        <!--_____Fin de la section_____-->
          
 	</div>
     
    <!--_____Fin du fondNoir_____-->
     
     
    <!--_____Début fond noir_____-->
     
    <div class="fondNoir">
     
		<section>
	
    		<div id="zone4">
            	        
				<div class="cadre4">
                	
                <?php
					// S'il y a au moins 1 action culturelle précédente avec un statut actif (= avec au moins une photo), on affiche le slider
					if(isset($donneesPage["actionsPrecedentes"]) AND count($donneesPage["actionsPrecedentes"]) > 0 
						AND (isset($donneesPage["actionsPrecedentes"][0]) AND $donneesPage["actionsPrecedentes"][0]["active"] == 1))
					{
				?>
				
                <h2><?php echo $string_lang["LISTE_ACTIONS_ACTIONS_PRECEDENTES"][$lang];?></h2>
              
                <!--_____Début du slider 1_____-->
                            
                    <div class="sliderContainer">
             
                        <ul class="bxSlider">
                            <?php
                                for($i=0; $i<$nombreActionsPrecedentes; $i++)
                                {
                                    if($donneesPage["actionsPrecedentes"][$i]["active"] == 1)
                                    {
                            ?>
                            <li>
                                <div class="black">   
                                    <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["actionsPrecedentes"][$i]["photos"][0]["filename"];?>" 
                                        alt="<?php echo $donneesPage["actionsPrecedentes"][$i]["photos"][0]["nom"];?>" width="296" height="196" />
                                    <h3><?php echo $donneesPage["actionsPrecedentes"][$i]["titre"];?></h3>
                                </div>       
                                
                                <div class="cartouche">     
                                    <h4><?php echo /*$donneesPage["actionsPrecedentes"][$i]["type"] . " " . */$donneesPage["actionsPrecedentes"][$i]["anneeCreation"];?></h4>
                                    <!--<time class="time"><?php //echo $donneesPage["actionsPrecedentes"][$i]["duree"];?></time>-->
                                    <p><?php echo $donneesPage["actionsPrecedentes"][$i]["accroche"];?></p>
                                    <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/actions-artistiques/<?php echo $donneesPage["actionsPrecedentes"][$i]["urlRewrite"]."-".$donneesPage["actionsPrecedentes"][$i]["ID"];?>"><div class="lien">
                                        <?php echo $string_lang["LISTE_ACTIONS_INFO"][$lang];?></div></a>
                                </div>
                            </li>
                            <?php
                                    }
                                }
                            ?>
                         </ul>
                        
                    </div>                       
                              
                    <!--_____Fin du slider 1_____--> 
                      
                    <?php
                        }
                    ?>
                </div>
                            
                <!--_____Fin du cadre 2_____-->
                            
            </div>  
                  
            <!--_____Fin de la zone 2_____-->
            
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

    <!--Player Vimeo-->
	<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/vimeoPlayer.js"></script>
    
    <!--Pour cacher le titre et le cartouche sur le Player Vimeo lors de la lecture-->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/hideVideoElements.js"></script>
    
    <!--Bouton super top-->
	<script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>
    
    <!-- Add BxSlider -->
	<script src="<?php echo CHEMIN_SITE;?>/jquery/bxSlider2.js"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>
           

</body>
</html>