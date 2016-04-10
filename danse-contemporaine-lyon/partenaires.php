<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion du fil d'Ariane
	include('../inc/fonctionFilArianne.inc.php');
	// Gestion des constantes	
	require_once("../inc/constantes.inc.php");
	
	// Gestion des langues (champs "statiques" du front-office)
	include("../lang/langTools/lang.inc.php");
	require("../lang/lang.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Partenaires</title>
    
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

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="pagePartenaires">
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
                    define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
                ?>
            	<p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["FIL_ARIANE_PARTENAIRES"][$lang]), $lang);?></p>
            </div>
			<!--_____________________________________-->
        
        </section>
        
   </div>
             
        <div class="fondNoir">
         
            <section>
            
                <h1>Partenaires</h1>  
                         
				<!--________Encadré photo 1________-->
        
				<div class="cadre1 white">
                           
					<ul>
                          <li><a href="http://www.culturecommunication.gouv.fr"  target="blank" id="logoMinistereCulture">Logo Ministère de la culture</a></li>
                          <li><a href="http://www.lyon.fr/page/accueil.html"  target="blank" id="logoVilleLyon">Logo Ministère de la culture</a></li>
                          <li><a href="http://www.fondationdefrance.org" target="blank" id="logoFondation">Logo Fondation de France</a></li>        
                          <li><a href="http://www.rhonealpes.fr" target="blank" id="logoRegion">Logo Région Rhone Alpes</a></li>
                          <li><a href="https://www.rhone.fr" target="blank" id="logoRhone">Logo Rhône le département</a></li>
                          <li><a href="http://www.centrecharliechaplin.com" target="blank" id="logoCharliechaplin">Logo Charlie Chaplin</a></li>  
                          <li><a href="http://www.spedidam.fr" target="blank" id="logoSpedidam">Logo Spedidam</a></li>   
                          <li><a href="http://www.vaulx-en-velin.net" target="blank" id="logoVauxenvelin">Logo Vaux en Velin</a></li> 
                          <li><a href="http://www.lacse.fr" target="blank" id="logoAcse">Logo Acsen</a></li>                             
                          
                    </ul>
    			
                </div>
                
                <br/><br/>
                	 
				</div>
            
				<!--________Fin encadré photo 1________-->
        
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
	<script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>
    
    </body>
</html>