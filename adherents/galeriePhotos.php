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

	if( isset($_GET['page']) && is_numeric($_GET['page']) )
		$page = $_GET['page'];
			else
			{
				$page = 1; // On se met sur la sous-page 1 (par défaut)
			}
	
			$maxVignettes=18; // nombre de photos par page
			$limit_start = $maxVignettes * ($page - 1); // Calcul du numéro de la 1ère photo à afficher dans la page courante
			//echo $limit_start;
	
		function curPageName() { // fonction affiche page courante
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		}
		// On récupère tout le contenu de la table photo triée par page
		$selectVignette = $bdd->query('SELECT filename FROM photos WHERE creationsID = 0 AND actions_culturellesID = 0 ORDER BY filename DESC LIMIT '.$limit_start.','.$maxVignettes.'') or die(print_r($bdd->errorInfo())); // requête fonctionnelle
	
	$nbrePhotos = $selectVignette->rowCount();
?>
 <!--AND actions_culturellesID = 0-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Galerie photos</title>
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen.css" />
    <!--<link rel="stylesheet" type="text/css" href="../css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_jf.css" />-->
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_rbg.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesFancyBox_rbg.css" />
    
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

    <!-- Lightbox -->
    <link rel="stylesheet" type="text/css" href="../css/lightbox-form_TestNico.css" />   
    
    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!--________________________________ Fancy Box ________________________________-->
    
    <!-- Fancy Box -->
    <link rel="stylesheet" type="text/css" href="../css/stylesFancyBox_rbg.css" />
    
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="../jquery/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="../jquery/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="../jquery/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="../jquery/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="../jquery/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="../jquery/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <link rel="stylesheet" href="../jquery/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="../jquery/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!--  Code personnalisé fancyBox -->
    <script type="text/javascript" src="../jquery/fancybox/fancyBox.js"></script> 
    
    <style>
		/* Effet de lueur externe */
		/* 0px de décalage en x, 0px de décalage en y, 12px de flou et la valeur en RGBA soit RedGreenBlueAlpha donc le 0.5 pour 50% d'opacité */
		.nm_liensDownload:hover
		{
			-webkit-box-shadow: black 0px 0px 12px /* rgba(255,255,255,0.8) */;
			-moz-box-shadow: black 0px 0px 12px /* rgba(255,255,255,0.8) */;
			box-shadow: black 0px 0px 12px /* rgba(255,255,255,0.8) */;
			/* behavior: url(../styles/scripts_styles_IE/PIE.htc); */	/* Pour le fonctionnement sous IE6-7-8... mais ne marche pas */
			transition: box-shadow 0.2s;	/* This lets IE know to call the script on all elements which get the 'box' class */
		}
		.nm_liensDownload2:hover
		{
			-webkit-box-shadow: white 0px 0px 10px /* rgba(255,255,255,0.8) */;
			-moz-box-shadow: white 0px 0px 10px /* rgba(255,255,255,0.8) */;
			box-shadow: white 0px 0px 10px /* rgba(255,255,255,0.8) */;
			/* behavior: url(../styles/scripts_styles_IE/PIE.htc); */	/* Pour le fonctionnement sous IE6-7-8... mais ne marche pas */
			transition: box-shadow 0.2s;	/* This lets IE know to call the script on all elements which get the 'box' class */
		}
	</style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="galerie">
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
                <p class="filAriane"><?php get_fil_ariane(array('accueilAdherents.php' => '&nbsp; Espace adhérents &nbsp;', 'final' => '&nbsp; Galerie photos'), $lang);?></p>
            </div>
            <!--_____________________________________-->
           
            <h1>Galerie photos</h1>  

       
    			<!--________Encadré 1________-->
        
                <div class="cadre1">
                    <div class="white">
                        <p class="chapo">Bienvenue dans la galerie de photographies de la compagnie AToU.</p>
                         <?php
							//if($nbrePhotos > 0)
							//{
						?>
                        <p>Vous pouvez consulter et télécharger les photos en ligne.</p>
                        <?php
							//}
							//else
							//{
						?>
                        <!--<p>Il n'y a pas de photos pour l'instant, mais n'hésitez pas à revenir régulièrement !</p>-->
                        <?php
							//}
						?>
                    </div>    
                </div>
        
    			<!--________Fin encadré 1________-->



				<!--________Navigation 1________-->
<?php

// On récupère tout le contenu de la table photo
$nb_total = $bdd->query('SELECT COUNT(*) AS nb_total FROM photos');
$nb_total = $nb_total->fetch();
$nb_total = $nb_total['nb_total'];

//echo $nb_total ;


// Pagination
$nb_pages = ceil($nb_total / $maxVignettes);
//echo $nb_pages ;


?>
        
        <?php
			//if($nbrePhotos > 0)
			//{
		?>
                <div id="paginationGalerie" class="navGalerie">
                    <ul>
                    <?php 
                        //Si le GET n'existe pas, on le crée (ne pas copier les 2 premieres lignes pour le fil suivant)
                        if(!isset($_GET["page"])){
                            $_GET["page"] = 1;
                        }
                        
                        //Pour les liens première page et page précédente
                        if( $_GET["page"] != 1 ) { 
					?>
                        <li>
                            <a href="<?php echo curPageName();?>">&lt;&lt;</a>
                        </li>
                        <li>
                        	<a href="<?php echo(curPageName()."?page=".($_GET["page"]-1)) ;?>">&lt;</a>
                        </li>
					<?php }
                        //On fait une boucle pour afficher le nombre de page disponible
						for($i=1; $i <= $nb_pages; $i++){
                        	if($i == $_GET["page"]){ // on désative le lien sur le <a href>
					?>
                        
                        <li>
                            <h3 id="chiffreActif"><?php echo (($i).".");?></h3>
                        </li>
                        
					<?php
                    		}
							else{ // sinon on affiche les liens>
					?> 
                        
                        <li>
                            <a href="<?php echo(curPageName()."?page=".($i)) ;?>#paginationGalerie"><?php echo (($i).".");?></a>
                        </li>
                        
					<?php
                            } // fin du if
                        } // fin de la boucle for
                        if($_GET["page"] != $nb_pages){//affichage des flèches suivantes
                    ?>
                            <li>                         
                                <a href="<?php echo(curPageName()."?page=".($_GET["page"]+1)) ;?>">&gt;</a>
                            </li>
                            <li>
                                <a href="<?php echo(curPageName()."?page=".($nb_pages)) ;?>">&gt;&gt;</a>
                            </li>
					<?php }?>
                    </ul>
                </div>
        
    			<!--________Fin Navigation 1________-->
    
    
    
				<!--________Photos________-->
                
                <div id="paginationGalerie2" class="navVignette">
 
					<?php
						// On affiche chaque entrée une à une
						$i=0;
						while ($nbTotalVignettes = $selectVignette->fetch())
						{
                    ?>
                		<div class="gabaritVignette">
                          	<a class="fancybox" rel="group" href="../photosOriginales/<?php echo $nbTotalVignettes['filename'];?>">
                            	<img class="nm_liensDownload2 vignette" src="../photosVignettesMini/<?php echo $nbTotalVignettes['filename'];?>"/></a>
                            <a href="../photosOriginales/<?php echo $nbTotalVignettes['filename'];?>" download="photo_AToU_<?php echo $nbTotalVignettes['filename'];?>">
                            	<img class="nm_liensDownload iconDownload" src="../img/communPictoTelecharger.png" width="36" height="36" title="Téléchargez la photo haute définition"/></a>
                        </div>
                    <?php
                    	$i++;
						}
                    ?>

                </div>
        
    			<!--________Fin Photos________-->
 
 
 				<!--________Navigation 1________-->
        
                <div class="navGalerie">
                <ul>
                 	<?php 
				 					
						//Pour les liens première page et page précédente
						if( $_GET["page"] != 1 ) { 
					?>
                        <li>
                       		<a href="<?php echo curPageName();?>">&lt;&lt;</a>
                        </li>
                        <li>
                        	<a href="<?php echo(curPageName()."?page=".($_GET["page"]-1)) ;?>">&lt;</a>
                        </li>
					<?php }
						//On fait une boucle pour afficher le nombre de page disponible
						for($i=1; $i <= $nb_pages; $i++){
							if($i == $_GET["page"]){ // on désative le lien sur le <a href>
					?>
                    
                    <li>
						<h3 id="chiffreActif"><?php echo (($i).".");?></h3>
                    </li>
                    
                    
            		<?php 
							}
							else{ // sinon on affiche les liens>
					?> 
					
                     	<li>
							<a href="<?php echo(curPageName()."?page=".($i)) ;?>#paginationGalerie2"><?php echo (($i).".");?></a>
                    	</li>
                    
					<?php
							} // fin du if
						} // fin de la boucle for
						if($_GET["page"] != $nb_pages){//affichage des flèches suivantes
					?>
                        <li>                         
                            <a href="<?php echo(curPageName()."?page=".($_GET["page"]+1)) ;?>">&gt;</a>
                        </li>
                        <li>
                            <a href="<?php echo(curPageName()."?page=".($nb_pages)) ;?>">&gt;&gt;</a>
                        </li>
                    <?php }?>
                    </ul>
                </div>
        
    			<!--________Fin Navigation 1________-->
 
		<?php
			//}
		?>
        
        </section>
 
	</div> 
 
    
    
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