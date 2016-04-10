<?php
// début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	// Protection des pages adhérents
	include('../../admin/inc/protectionAdherent.inc.php');
	
	if(!isset($_SESSION["adherentID"])) header("location:index.php");
	
############################################################################################################################################
			//Récupération titre, salle, dates des ateliers
			$requete = "SELECT titre, texte, filenamePhotoMobile FROM actualites WHERE ID=3";
			$reponse = $bdd->query($requete);
			$donnees = $reponse->fetch();

############################################################################################################################################
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>Accueil Adhérents</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <link href="../../jquery/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />
    
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
     
   
</head>

<body id="homePage">
		
         <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
		
        
    <div class="content">
      	
		<?php include("../inc/header.inc.php");?> 
        <a href="#superTop" class="topTop"></a><!--Bouton, top-->
        <div class="separator"></div>       
        <!--________Slider________-->
        
         <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosMobiles/<?php echo  $donnees['filenamePhotoMobile'];?>" alt=""/>
                    	<span class="legendSlide2">
                            <h2><?php echo $donnees['titre'];?> </h2>
                            <p><?php echo $donnees['texte'];?></p>
                        </span>
 
        <!--________Lien vers les créations________-->
        
        <div class="black bouton3 ">
            <a href="<?php echo CHEMIN_SITE_MOBILE;?>/adherents/listeAteliers.php">Venir à nos ateliers</a>
        </div>
        
        <div class="black bouton3 ">
            <a href="<?php echo CHEMIN_SITE_MOBILE;?>/adherents/inscriptionateliernubesAdh.php">Participer à l'atelier à l'atelier Nubes</a>
        </div>
        
       <div class="black bouton3">
            <a href="<?php echo CHEMIN_SITE_MOBILE;?>/danse-contemporaine-lyon/listeCreations.php">Venir voir nos créations</a>
        </div>
        
           
            <div class="black bouton3">
                <a  href="<?php echo CHEMIN_SITE_MOBILE;?>/adherents/donnervotreavis.php">Donner votre avis</a>
            </div>
        
     	<div class="annule"></div>
        <!--________Contacts________-->
        
        <h1>Nous contacter</h1>
        
        <div class="adresse">
        	Compagnie de danse AToU<br/>8, avenue Bataillon<br/>69120 Vaulx-en-Velin
        </div>
       
        <div data-long="45.758976" 
            data-lat="4.922618"
            data-idmap="<?php echo "carte".$i;?>"
            class="go">Y aller</div>
                        
        <div class="blocCache">
                  
            <!--________Carte Google________-->
                    <div id="itineraire">
                    
                    <h5>Choississez votre itinéraire</h5>
                        <ul>
                            <li><a href="#" onClick="changeTransportMode('voiture');return false" class="pictovoiture gmapvoitureOn"></a></li>
                            <li><a href="#" onClick="changeTransportMode('transit');return false" class="pictotransit  gmaptransitOff"></a></li>
                            <li><a href="#" onClick="changeTransportMode('pieds');return false" class="pictopieds gmappiedsOff"></a></li>
                            <li><a href="#" onClick="changeTransportMode('velo');return false" class="pictovelo gmapveloOff"></a></li>
                        </ul>
                    </div>
                    
                <!--<div id="carte"></div>
                <div id="detailParcours"></div>-->
        
        </div>
       
        <!--________Contacts - Suite________-->
        <br/>
        <h3 class="titreH3">Notre administrateur</h3>
        <address>
            <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
        	 
        	<a href="tel:+33(0)472141663">+33(0)472141663</a>
        </address>
      
<h3>Notre chargée de diffusion<br />Anne-Sophie Gineste</h3>
        <address>
            <a href ="mailto:diffusion@atou.fr">diffusion@atou.fr</a>
        
         
        <a href="tel:+33(0)651812475">+33(0)651812475</a>
       
        </address>
    
	<?php include("../inc/footer.inc.php");?>
           
	</div>
    
     <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
     <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
   
    
	 <script src="../../jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
    <script src="../../jquery/bxSlider.js" type="text/javascript"></script>
    
    
	 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="../../jquery/mapsGoogleTools.js" type="text/javascript"></script>
 
</body>
</html>

					