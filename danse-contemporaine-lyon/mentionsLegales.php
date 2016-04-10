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
    <title>Mentions légales</title>
    
    <!--___________Librairies jquery___________-->
    
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    <!-- Froogaloop js library for calling Vimeo's API -->
    <script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>

	<!-- Add tinycarousel JS -->
	<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/jquery.tinycarousel.js"></script>
      
    
    <!--___________Toggle onglets déroulants___________-->
    
    <script type="text/javascript">
    
        $(document).ready(function(e){
           $('.deroule').hide();
			
			$('.toggle').click(function(){
				//init();
				$('.deroule').slideUp("slow");
				$('.toggle').addClass('toggleUp');
				$('.toggle').removeClass('toggleDown');
				
				if(!$(this).hasClass('accordeonActive')){
						$('.toggle').removeClass('accordeonActive');	
						$(this).next().slideToggle().siblings(".deroule:visible").slideUp("slow");
						$(this).addClass('accordeonActive');
						$(this).addClass('toggleDown');
						$(this).removeClass('toggleUp');
				}
				else {
					$('.toggle').removeClass('accordeonActive');	
					//$(this).removeClass('accordeonActive');
					
				}
				return false;
			})
			
		    
            // TOP BUTTON
            // RECUP HAUTEUR DE LA FENETRE
            var hauteurFenetre = $(window).height();
            var newhauteur = $('body').height();
            var topPosition = $('#top').position();
            var positionFromTop = topPosition.top;
            
            console.log(hauteurFenetre);
            
            $('#top').hide();
            
            $(window).scroll(function() {
                if($(this).scrollTop() >= hauteurFenetre) {
                    $("#top").show().css("bottom",600);
                } else {
                    $('#top').hide();
                }
            });		
        });
    
    </script>
    
    <!--___________reset Eric Meyer___________-->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/reset.css" />
    
    <!--___________feuille de style___________-->
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_cv.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_jf.css" rel="stylesheet" type="text/css"/>
    
    <!--_____feuille de style tinyCaroussel_____-->
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/css/tinycarousel.css" type="text/css" media="screen"/>
    
    <!--___________font Alegreya___________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>

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

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="pageMentionsLegales">
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
            	<p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; Mentions légales'), $lang);?></p>
            </div>
			<!--_____________________________________-->
            
            <h1>Mentions légales</h1>  


           
			<!--_____________________Zone 1_____________________-->
    
            <div id="zone1"> 
            
            	<div id="imgTacheBlancheAnnexes">
        			<img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png"/>
        		</div>
                
                <div class="cadreAnnexes">                

                        <h5>Mentions légales</h5>
						<p>En application de la loi du 11 mars 1957 [art. 41] et du Code de la propriété 
                        intellectuelle du 1er juillet 1992, toute reproduction partielle ou totale 
                        des informations contenues sur ce site, est strictement interdite sans autorisation 
                        écrite de la Compagnie de danse AToU. Les logos, visuels, documents et vidéos 
                        présents sur le site www.atou.fr sont la propriété de leurs détenteurs respectifs. 
                        Le site www.atou.fr est régi par le droit français.</p>
                        
                        <h5>Informations relatives à l'éditeur</h5>
                        <p>Le site www.atou.fr et la webapp mobile.atou.fr sont publiés par :</p>
						<p>Compagnie AToU, association loi 1901</p>
						<p>Maison Carmagnole</p>
						<p>8 avenue Bataillon Carmagnole-Liberté</p>
						<p>69120 Vaulx-en-Velin</p>
						<p>04 72 14 16 63<br /><br /<p>
                        
                        <p><span class="titreAnnexes">Président</span>
                        Arnaud Plaisance</p>
                        <p><span class="titreAnnexes">Secrétaire</span>
                        Nathalie Morin</p>
                        <p><span class="titreAnnexes">Trésorier</span>
                        Damien Cellier<br /><br /></p>
						<p>N° Siret : 517 911 731 00027 / NAF : 9001 Z<br />
                        Licences de 2e et 3e catégorie : 2-1031413 et 3-1031414</p>

                        <h5>Conception du site et réalisation</h5>
						<p>Le site www.atou.fr et la webapp mobile.atou.fr ont été conçus et développés 
                        dans le cadre de la formation CRPL (Conception et Réalisation de Produits 
                        en Ligne) de l'école des Gobelins, l'école de l'image. 
                        Ils sont le résultat du travail de cinq élèves de la promotion CRPL 2014 :<br /><br /><p>
                        
                        <p><span class="titreAnnexes">Nicolas Mura</span> Chef de projet</p>
						<p><span class="titreAnnexes">Manon Dubois</span> UX designer webapp</p>
                        <p><span class="titreAnnexes">Cécile Vagne</span> UX designer site</p>
						<p><span class="titreAnnexes">Jérôme Fiorese</span> Directeur artistique</p>
						<p><span class="titreAnnexes">Roger Bellon-Gronnier</span> Directeur technique</p>
     
                        <h5>Crédits</h5>
                        <p><span class="titreAnnexes">Photographies</span>
                        Anthony Faure, Shinya Iikawa, Emeline Olry, Eric Stern, Jean Loup Bertheau.</p>
                        
						<p><span class="titreAnnexes">Videos</span>
                        Oraline Agnes, Sylvain Daulin (les monocles), Corentin Le Flohic, Sebastien Fanger.</p>                        
                       
                       <h5>Copyright</h5>
                        <p>Tous droits réservés.</p>
                          
                        <h5>Hébergement</h5>
						<p>Le site est hébergé par Infomaniak Network SA :</p>  
                        <p>26 avenue de la Praille 1227 Carouge / Genève SUISSE.<p>
                        <p>Le choix de l'hébergeur a été fait suivant son engagement écologique :
                        http://ecologie.infomaniak.com/charte-environnementale.<p>
                </div>

			</div>
			<!--_____________________Fin Zone 1_____________________-->
            
            
            <br class="annule"/>
            
		</section>
 
			<!--_____________________Fin SECTION_____________________--> 
 
	</div>
    
    <!--_____________________Fin FOND NOIR_____________________--> 



    
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

</body>
</html>