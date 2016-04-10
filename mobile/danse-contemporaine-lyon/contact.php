<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>atelierMalval</title>
    
	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    <!--________Librairies jquery________-->
    
   
</head>

<body id="atelierMalval">
		<?php include("../inc/facebookPartage.inc.php");?>
        
        <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
        
	<div class="content">

        <?php include("../inc/header.inc.php");?>
        <a href="#superTop" class="topTop"></a><!--Bouton, top-->
        
       <h1>Nous contacter</h1>
      
            <!--________Contacts - Suite________-->
            
        <div class="adresse">
        	Compagnie de danse AToU<br/>Maison Carmagnole<br/>8, avenue Bataillon Carmagnole-Liberté<br/>69120 Vaulx-en-Velin
        </div>    
            
        <br/>
        <h3 class="titreH3">Notre administrateur</h3>
            <address>
               	<a href="tel:+33(0)472141663">+33(0)472141663</a>
                <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
            </address>
      
<h3>Notre chargée de diffusion<br />Anne-Sophie Gineste</h3>
            <address>
            	<a href="tel:+33(0)651812475">+33(0)651812475</a>
                <a href ="mailto:diffusion@atou.fr">diffusion@atou.fr</a>
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


