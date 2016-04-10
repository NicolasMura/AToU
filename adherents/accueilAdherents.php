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
	
	// Récupération des infos en base de données sur les créations archivées pour les pages adhérents
	include("../inc/infosCreasArchivees.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Espace adhérents</title>
    
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
    
    <style>
		.nm_lienArchive{
			margin-top:19px;
			display:block;
			}
	</style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="accueilAdherents">

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
                <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; Espace adhérents'), $lang);?></p>
            </div>
            <!--_____________________________________-->
       
        
            <h1>Espace adhérents</h1>
        
             <!--_____Zone 1_____-->	
            
            <div id="zone1">
            
                <div class="imgTacheBlanche">
                        <img src="../img/backgroundTacheBlanc02.png" alt="toto"/>
                </div>
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre1">
                    
                     <h3 id="nomCrea" class="black">Ateliers</h3>		
                    
                    <!--_____Cartouche_____-->
                
                    <div class="cartouche"> 
                            <p>AToU propose des rencontres publiques, des ateliers hebdomadaires et des stages sur plusieurs jours, 
                            en lien avec le travail artistique de la compagnie.</p>
                            <a href="listeAteliers.php"><div class="lien">Découvrir les ateliers et s’inscrire à Nubes</div></a>           
                    </div>
                           
                    <!--_____Fin du cartouche_____-->
                
                             
                    <!--______Début cadre video_____-->                 
                      
                    <div class="black">
                       <!--<img src="../img/accueilAdherentsAteliers.jpg" alt="photo Ateliers" width="622" height="413" />-->
                       <img src="../photosVignettes/accueilAdherentsAteliers.jpg" alt="photo Ateliers" />
                    </div>
                     
                     <!--_____Fin cadre vidéo_____-->
                     
                     
                     <!--_____Début des rectangles_____-->
                     
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>              
               
                    <!--_____Fin des rectangles______-->
                                    
				</div>
     
            	<!--_____Fin du cadre 01_____-->      
                    
        	</div>
            
       		<!--_____Fin Zone 1_____-->
        
        	<br class="annule"/>  
        
        	<!--_____Début Zone 2_____-->
           
        
        	<div id="zone2">
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre2">
                    
                     <h3 id="nomCrea" class="black">Carnet de bord</h3>		
                    
                    <!--_____Cartouche_____-->
                
                    <div class="cartouche"> 
                            <p>AToU vous invite à échanger vos impressions dans un espace de partage et de discussion.</p>
                            <a href="discussion.php"><div class="lien">Découvrir le carnet de bord</div></a>           
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
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>             
               
                    <!--_____Fin des rectangles______-->
                                    
                </div>
         
                <!--_____Fin du cadre 02_____-->      
                    
            </div>
                
            <!--_____Fin Zone 02_____-->
            
            <br class="annule"/> 
            
            <!--_____Début  Zone 03_____-->	
            
            <div id="zone3">
            
                <div class="imgTacheBlanche">
                        <img src="../img/backgroundTacheBlanc02.png" alt="toto"/>
                </div>
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre3">
                    
                     <h3 id="nomCrea" class="black">Galerie photos</h3>		
                    
                    <!--_____Cartouche_____-->
                
                    <div class="cartouche"> 
                            <p>Venez consulter la galerie de photographies, télécharger et partager vos propres photographies.</p>
                            <a href="galeriePhotos.php"><div class="lien">Découvrir la galerie photos</div></a>           
                    </div>
                           
                    <!--_____Fin du cartouche_____-->
                
                             
                    <!--______Début cadre video_____-->                 
                      
                    <div class="black">
                       <img src="../photosVignettes/accueilAdherentsGalerie.jpg" alt="photo Galerie" width="622" height="413" />
                    </div>
                     
                     <!--_____Fin cadre vidéo_____-->
                     
                     
                     <!--_____Début des rectangles_____-->
                     
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>              
               
                    <!--_____Fin des rectangles______-->
                                    
                </div>
     
                <!--_____Fin du cadre 01_____-->      
                    
            </div>
            
            <!--_____Fin Zone 3_____-->
        
            <br class="annule"/>
        
        
            <!--_____Début Zone 4_____-->
               
            
            <div id="zone4">
            
                <!--_____Encadré photo 1_____-->
                
                <div class="cadre4">
                    
                    <h3 id="nomCrea" class="black">Archives de la compagnie</h3>		
                    
                    <!--_____Cartouche_____-->
                    
                    <div class="cartouche"> 
                        <p>AToU vous offre un accès exclusif aux archives de la compagnie.</p>
                        
                        <?php
                            if($nombreCreationsArchivees > 0)
                            {
                        ?>
                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationsArchivees"][0]["urlRewrite"]."-".$donneesPage["creationsArchivees"][0]["ID"];?>">
                            <div class="lien">
                                <?php echo $donneesPage["creationsArchivees"][0]["titre"];?>
                            </div>
                        </a>
                        <?php
                            }
                            else echo "A venir...";
                        ?>
                        <br class="annule"/>
                        
                        <?php
                            // Affichage de 5 autres créations archivées max, sinon pb au niveau de la mise en page
                            if($nombreCreationsArchivees > 5) $nombreCreationsArchivees = 5;
                            for($i=1; $i<$nombreCreationsArchivees; $i++)
                            {
                        ?>
                        <a class="nm_lienArchive" href="../danse-contemporaine-lyon/ficheCreation.php?ID=<?php echo $donneesPage["creationsArchivees"][$i]["ID"];?>">
                            <div class="lien">
                                <?php echo $donneesPage["creationsArchivees"][$i]["titre"];?>
                            </div>
                        </a>
                        <br class="annule"/>	
                        <?php
                            }
                        ?>                        
					</div>
                           
                    <!--_____Fin du cartouche_____-->
                    
                             
                    <!--______Début cadre video_____-->                 
                      
                    <div class="black">
                       <img src="../photosVignettes/accueilAdherentsArchives.jpg" alt="photo Archives" width="622" height="413" />
                    </div>
                     
                     <!--_____Fin cadre vidéo_____-->
                     
                     
                     <!--_____Début des rectangles_____-->
                     
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>
                    <div class="black big petitBlocContour"></div>
                    <div class="black big grandBlocContour"></div>             
                    
                    <!--_____Fin des rectangles______-->
                                    
                    </div>
                    
                    <!--_____Fin du cadre 04_____-->      
                        
                </div>
                
                <!--_____Fin Zone 04_____-->      
        
            <br class="annule"/>  
        
        </section>
            
        <!--_____Fin de la section_____-->

    </div>
     
    <!--_____Fin du fondNoir_____--> 


   
           
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