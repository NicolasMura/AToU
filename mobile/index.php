<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("inc/constantes.inc.php");	
	// Autres
	require_once('../admin/tools/toolsDateTime.php');
	// Autres	
	require("../admin/inc/fonctionMailGoogle.php");
	
############################################################################################################################################
			//Récupération titre, salle, dates et photo de la création présente
			$requete = "SELECT representations.salle, representations.dates, creations.titre, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationPresente' AND representations.creationsID = creations.ID";
			$reponse = $bdd->query($requete);
			$donnees = $reponse->fetch();
			
			// Conversion de la date en bon français
			if(isset($donnees["dates"]) AND $donnees["dates"] != "0000-00-00")
			{
				$prochaineDate = dateHeureInfos($donnees["dates"]);
				$donnees["dates"] = $prochaineDate["date"];
			}
		
			//Récupération titre, salle, dates et photo d'une création à venir
			$requete2 = "SELECT representations.salle, representations.dates, creations.titre, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationAvenir' AND representations.creationsID = creations.ID";
			$reponse2 = $bdd->query($requete2);
			$donnees2 = $reponse2->fetch();
			
			// Conversion de la date en bon français
			if(isset($donnees2["dates"]) AND $donnees2["dates"] != "0000-00-00")
			{
				$prochaineDate2 = dateHeureInfos($donnees2["dates"]);
				$donnees2["dates"] = $prochaineDate2["date"];
			}
			
			//Récupération titre, salle, dates et photo de la dernière création actuelle
			$requete3 = "SELECT representations.salle, MAX(representations.dates), creations.titre, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationActuelle' AND representations.creationsID = creations.ID";
			$reponse3 = $bdd->query($requete3);
			$donnees3 = $reponse3->fetch();
	
			// Conversion de la date en bon français
			if(isset($donnees3["MAX(representations.dates)"]) AND $donnees3["MAX(representations.dates)"] != "0000-00-00")
			{
				$tmp = $donnees3["MAX(representations.dates)"];
				$prochaineDate3 = dateHeureInfos($tmp);
				$donnees3["dates"] = $prochaineDate3["date"];
			}
			
			// Récupération de l'urlvideo
	$requeteVideo = "SELECT urlVideo FROM creations WHERE statut='creationPresente'";
	$reponseVideo = $bdd->query($requeteVideo);
	$donneesVideo = $reponseVideo->fetch();
	
if(isset($_POST["button"]))
	{
			if(isset($_POST["mail"]))
			{
			//Envoi d'un message à AToU 
			$obj="Demande d'adhésion à la newsletter";
			$mess ="-----------------------<br />"; 
			$mess.="Une personne vous a demandé une adhésion à la newsletter AToU via le site mobile : ";
			$mess.=$_POST['mail']." \r\n <br />"; 
			$mess.="-----------------------<br />"; 
			
			$mailfrom = $_POST['mail']; 
			$namefrom="EMETTEUR";
			$mailto="nicolas.mura@gmail.com"; // A remplacer par atou.webmaster@gmail.com
			$nameto="DESTINATAIRE";			

				if(($mailto!="")&&($mailto!=NULL))	
				{
					//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
					mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
					//header("Location:index.php");
					
					//Envoi d'un message au demandeur 
					$obj="Demande d'adhésion à la newsletter AToU";
					$mess ="-----------------------<br />"; 
					$mess.="AToU vous informe que votre demande d'adhésion à la newsletter a bien été prise en compte. <br />Cordialement,<br />La compagnie AToU";
					$mess.="-----------------------<br />"; 
					
					$mailfrom = $_POST['mail']; 
					$namefrom="EMETTEUR";
					$mailto= $_POST['mail']; ;
					$nameto="DESTINATAIRE";			
		
					if(($mailto!="")&&($mailto!=NULL))	
					{
						//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
						mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
						//header("Location:index.php");
						$messageOK = "<h3>Merci. Votre demande a bien été prise en compte.</h3>";	
					}	
				}
				
			}
			else
			{
				$erreur = "<br /><h3>Vous devez entrer un email valide.</h3>";
			}
	}
	if(isset($_POST["val2"]))
	{
		header("Location:index.php");
	}	
############################################################################################################################################
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>Home page</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <link href="../jquery/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
    
    <!--________feuilles de style________-->
   
    <link href="css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
   <!-- <link href="css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />-->
     <link href="css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
</head>

<body id="homePage">
		<?php include("inc/facebookPartage.inc.php");?> 
		 <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("inc/menuDeroulant.inc.php");
            } ?>
       
    <div class="content">
   	
		<?php include("inc/header.inc.php");?> 
       
       <div class="separator"></div> 
        <!--________Slider________-->
        
        <a href="#superTop" class="topTop"></a><!--Bouton, top-->
      <div class="sliderContainer">
        
            <ul class="bxslider">
            
                <li>
                    
                    <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosMobiles/<?php echo  $donnees['filenamePhotoMobile'];?>" 
                    	alt="photo"/>
                    <span class="legendSlide">
                        <h2><?php echo  $donnees['titre'];?></h2>
                        <p><?php echo  $donnees['salle'];?></p>
                        <p><?php echo  $donnees['dates'];?></p>
                    </span>
                </li>
                
                <li>
                    <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosMobiles/<?php echo  $donnees3['filenamePhotoMobile'];?>" 
                    	alt="photo"/>
                    	<span class="legendSlide">
                            <h2><?php echo  $donnees3['titre'];?></h2>
                            <p><?php echo  $donnees3['salle'];?></p>
                            <p><?php echo  $donnees3['dates'];?></p>
                        </span>
                </li>
                
                <li>
                   
                    <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosMobiles/<?php echo  $donnees2['filenamePhotoMobile'];?>" 
                    	alt="photo"/>
                     <span class="legendSlide">
                        <h2><?php echo  $donnees2['titre'];?></h2>
                        <p><?php echo  $donnees2['salle'];?></p>
                        <p><?php echo  $donnees2['dates'];?></p>
                    </span>
                </li>
                
            </ul>
            
       </div>
        <!--________Toggle nous connaître________-->
        
        <div class="black bouton" >
            <a href="#" class="toggle">Nous connaître </a>
            <div class="deroule">
            <h1>Découvrez chaque mois notre nouvelle sélection vidéo.</h1>
            
            <iframe src="//player.vimeo.com/video/<?php echo $donneesVideo["urlVideo"];?>?color=fafafa" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            
            
            <!--<object width="100%" height="326px"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=80465773&amp;force_embed=1&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=81358A&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=80465773&amp;force_embed=1&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=81358A&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="281"></embed>
            </object>-->
            
                <p>Des corps résonnent les forces et les fragilités de la nature humaine. AToU en amplifie l'écho afin que chacun saisisse l’occasion d’interroger sa propre intimité et de découvrir les richesses et les possibles qui s’y trouvent.<br/>
En résidence depuis 2012 à Vaulx en Velin, et parallèlement à ses recherches artistiques, AToU initie avec passion de multiples projets à destination de publics n'ayant pas facilement accès à la richesse de la danse.</p>
				<div class="imgFicheCreation">
       			<img src="../../img/mobileCompagnieAnan.jpg" alt="" />
      			</div>
				<h5>La directrice artistique :</h5>
<p>Née au Japon où elle se forme à la danse classique, Anan Atoyama découvre la danse moderne à New York. Formée trois années aux écoles Alvin Ailey et Cunningham, elle travaille en Allemagne avant d’aider au développement des conservatoires de danses de Madhia et de Monastir pendant deux ans. De retour en Europe en 2008, elle fonde à Lyon AToU. <br/>
Anan Atoyama met en scène une humanité complexe, instinctive et sensible, où la beauté ne se réduit pas à une simple flatterie. La chorégraphe puise de ses traditions natales une énergie qu'elle refaçonne avec poésie et modernité, attirée par le croisement des arts et des cultures.</p>
            </div>
        </div>
        
        <!--________Lien vers les créations________-->
        
        <div class="black bouton">
            <a href="danse-contemporaine-lyon/listeCreations.php">Venir voir nos créations</a>
        </div>
        
        <!--________Formulaire newsletter________-->
        
        <div class="black bouton"><a href="danse-contemporaine-lyon/newsletter.php">S’inscrire à la newsletter</a></div>
        
        <div class="white">
          <?php
            	if(!isset($messageOK))
            	{
           		if(isset($erreur)) echo $erreur;
		?>
            <form method="post" action="index.php" class="md_formNewsletter">
                <ul>
                    <li>
                        <label for="email" class="labelChamps">Votre email <i>( champ obligatoire )</i></label>
                        <input type="email" name="mail" placeholder="" id="email" class="champs" data-validation="email" data-validation="required"/>
                      <input type="submit" name="button" value="OK" class="md_formNewsletterOK"/>
                    </li>
                    
                    <li></li>
                </ul>
            </form>
             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
       <script>
  $.validate();
</script>
            
        </div>
        <?php
			}
			else
			{
				echo $messageOK;
			}
		?>
        <!--________Inscription atelier Nubes________-->
        
        <div class="black bouton">
            <a href="danse-contemporaine-lyon/inscriptionateliernubes.php">S’inscrire à l'atelier Nubes</a>
        </div>
     
        <!--________Contacts________-->
        
        <h1>Nous contacter</h1>
        <div class="adresse">
        	Compagnie de danse AToU<br/>Maison Carmagnole<br/>8, avenue Bataillon Carmagnole-Liberté<br/>69120 Vaulx-en-Velin
        </div>
       
        <div data-long="45.758976" 
            data-lat="4.922618"
            data-idmap="carte0>"
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
    
	<?php include("inc/footer.inc.php");?>
      
	</div>
    
     <!--________Librairies jquery________-->
  
     <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
 	<script type="text/javascript" charset="utf-8" src="../jquery/nav-left.js"></script>
	<script src="../jquery/toggle.js" type="text/javascript"></script>
       <!--Bouton super top-->
	<script src="../jquery/topButtonMobile.js" type="text/javascript"></script>
	<script src="../jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
    <script src="../jquery/bxSlider.js" type="text/javascript"></script>
    
   
    
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="../jquery/mapsGoogleTools.js" type="text/javascript"></script>
 
</body>
</html>

					