<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	// Récupération de l'urlvideo
	$requete = "SELECT urlVideo FROM creations WHERE statut='creationActuelle'";
	$reponse = $bdd->query($requete);
	$donnees = $reponse->fetch();
	
	// Facebook
	$titleFacebook = "Compagnie AToU ";
	$urlPageFacebook ="http://www.atou.fr/img/mobileCompagnieAnan.jpg";
	$urlImageFacebook = "http://www.atou.fr/img/mobileCompagnieAnan.jpg";
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>nousConnaitre</title>
    
    <!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
	<meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    

   
</head>

<body id="nousConnaitre">
		<?php include("../inc/facebookPartage.inc.php");?>
       <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
       
	<div class="content">

        <?php include("../inc/header.inc.php");?>
         <a href="#superTop" class="topTop"></a><!--Bouton, top-->
       <h1>Nous connaître</h1>
       
       <h4>Découvrez chaque mois <br/> notre nouvelle sélection vidéo.</h4>
           	<p>&nbsp;</p>
            <iframe src="//player.vimeo.com/video/<?php echo $donnees["urlVideo"];?>?color=fafafa" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            
       		 <p>&nbsp;</p>
                <p>Des corps résonnent les forces et les fragilités de la nature humaine. AToU en amplifie l'écho afin que chacun saisisse l’occasion d’interroger sa propre intimité et de découvrir les richesses et les possibles qui s’y trouvent. 
En résidence depuis 2012 à Vaulx en Velin, et parallèlement à ses recherches artistiques, AToU initie avec passion de multiples projets à destination de publics n'ayant pas facilement accès à la richesse de la danse.</p>

		<div class="imgFicheCreation">
       <img src="../../img/mobileCompagnieAnan.jpg" alt="" />
       </div>
     
      
<h5>La directrice artistique : </h5>
<p>
Née au Japon où elle se forme à la danse classique, Anan Atoyama découvre la danse moderne à New York. Formée trois années aux écoles Alvin Ailey et Cunningham, elle travaille en Allemagne avant d’aider au développement des conservatoires de danses de Madhia et de Monastir pendant deux ans. De retour en Europe en 2008, elle fonde à Lyon AToU. 
Anan Atoyama met en scène une humanité complexe, instinctive et sensible, où la beauté ne se réduit pas à une simple flatterie. La chorégraphe puise de ses traditions natales une énergie qu'elle refaçonne avec poésie et modernité, attirée par le croisement des arts et des cultures.
</p>
          
       
       
        <div ><a  class="partage" href="#" title="PARTAGER SUR" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">PARTAGER SUR</a></div>
      
     	
            <p class="titreH3"><h3>Pour plus d'informations,<br/>
            contactez notre administrateur.</h3></p>
            <address>
                <a href="tel:+33(0)472141663">+33(0)472141663</a>
                <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
            </address>
	
	<?php include("../inc/footer.inc.php");?>
 </div>
	
    
	 <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
 	<script src="../../jquery/nav-left.js" type="text/javascript"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>

    
</body>
</html>


