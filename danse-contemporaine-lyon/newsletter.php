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
	
	if(isset($_POST["button"]))
	{
		if(isset($_POST['mail']) AND $_POST["mail"] != ''
			AND isset($_POST['nom']) AND $_POST["nom"] != ''
			AND isset($_POST['prenom']) AND $_POST["prenom"] != '')
		{	
			$email = $_POST['mail'];
			if(isset($_POST['civilite'])) $civilite = $_POST['civilite'];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			
			//Envoi d'un message à AToU 
			$obj="Demande d'adhésion à la newsletter";
			$mess ="-----------------------<br />"; 
			$mess.="Une personne vous a demandé une adhésion à la newsletter via le site AToU :  \r\n <br />";
			if(isset($civilite)) $mess .= "Civilité : ".$civilite." \r\n <br />"; 
			$mess .= "Nom : ".$nom." \r\n <br />"; 
			$mess .= "Prénom : ".$prenom." \r\n <br />";  
			$mess .= "Email : ".$email." \r\n <br />";
			$mess.="-----------------------<br />"; 
			
			$mailfrom = $_POST['mail']; 
			$namefrom="EMETTEUR";
			$mailto=EMAIL_ATOU;
			
			$nameto="DESTINATAIRE";			

			if(($mailto!="")&&($mailto!=NULL))
			{
				//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
				mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
				//header("Location:index.php");
				
				//Envoi d'un message au demandeur 
				$obj="Demande d'adhésion à la newsletter AToU";
				$mess ="-----------------------<br />"; 
				$mess.="Votre demande a bien été reçue. <br />Merci pour votre intérêt porté à la compagnie AToU.<br />Au plaisir de partager la richesse de la Danse ensemble.<br />Cordiales salutations<br />L'équipe AToU<br />";
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
					$messageOK = "Nous avons bien reçu votre inscription à notre newsletter, et vous en remercions.<br />Vous allez recevoir un mail de confirmation.";	
				}
				else $erreur = "Vous devez entrer un email.";
			}
			else $erreur = "Vous devez entrer un email.";
		}
		else $erreur = "Vous devez entrer un email.";
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Newsletter</title>
    
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
    
    <style>
		.erreur{
			color:red;
			}
	</style>

	<!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="newsletter">

    <div id="superTop"></div> <!--Bouton, top-->
    <!--______________________Menu header______________________-->
    
	<div class="bgheader">
		<div id="entete">
			<header>
				<?php
					include("../inc/menuFront.inc.php");
				?>
			</header>  
		</div> 
	</div> 
        
    <!--______________________Fin Menu header______________________-->
    
    <div class="fondNoir">
 
        <section>
            
            <!--___________ Fil d'Arianne___________-->
            <div class="filaire">
                <?php
                    define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["FIL_ARIANE_NEWSLETTER"][$lang]), $lang);?></p>
            </div>
            <!--_____________________________________-->
        
		<div class="fondWhite">
         
		<section class="formulaire" >
        
			<a href="#superTop" id="top"></a><!--Bouton, top-->
    
			<p class="titreFormulaire1"><?php echo $string_lang["NEWSLETTER_TITRE"][$lang];?></p> 

			<?php
				if(!$messageOK)
				{
					if(isset($erreur)) echo "<p class='erreur'>".$erreur."</p>";
			?>
            <!--________________________ cadreFormulaireLeft ________________________-->	
			
            <div class="cadreFormulaireLeft">
			
                <!--________________________Formulaire 1________________________-->
            
                <div class="cadreFormulaire1">
                
                    <p class="titreFormulaire5">
                        <?php echo $string_lang["NEWSLETTER_QUESTION"][$lang];?>
                    </p>
                    
                    <form action="../newsletter" method="post" enctype="application/x-www-form-urlencoded">

                        <div>
                        	<ul class="civiliteFormulaire">
                                <li>	
                                    <label for="mde"><?php echo $string_lang["NEWSLETTER_MADAME"][$lang];?></label>
                                    <input type="radio" id="mde" name="civilite" value="mde"/>
                                </li>
                                <li>
                                    <label for="melle"><?php echo $string_lang["NEWSLETTER_MADEMOISELLE"][$lang];?></label>
                                    <input type="radio" id="melle" name="civilite" value="melle"/>
                                 </li>
                                 <li>   
                                    <label for="m"><?php echo $string_lang["NEWSLETTER_MONSIEUR"][$lang];?></label>
                                    <input type="radio" id="m" name="civilite" value="m"/>
                                </li>
                            </ul>
                        </div>
                    
                    	<!--________________________Formulaire Colonne 1________________________-->
    
                    	<div id="col1">
                  			<ul>
                                <li class="entreesFormulaire">
                                    <label for="nom"><?php echo $string_lang["NEWSLETTER_NOM"][$lang];?><br /></label>
                                    <input type="text" id="nom" name="nom" placeholder="<?php echo $string_lang["NEWSLETTER_NOM_FIELD"][$lang];?>" tabindex=1 
                                    	value="<?php if(isset($_POST["nom"]))echo $_POST["nom"];?>" required/>
                                </li>                 				          
                                <li class="entreesFormulaire">
                                    <label for="mail"><?php echo $string_lang["NEWSLETTER_MAIL"][$lang];?><br />
                                    </label>
                                    <input type="email" id="mail" name="mail"
                                    placeholder="<?php echo $string_lang["NEWSLETTER_MAIL_FIELD"][$lang];?>" tabindex=3 value="<?php if(isset($_POST["mail"]))echo $_POST["mail"];?>" required/>
                                </li>
                            </ul>
						</div>
   
                  		<!--________________________Fin Formulaire Colonne 1________________________-->
    
                    
                    	<!--________________________Formulaire Colonne 2________________________-->
                    
                    	<div id="col2">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="prenom"><?php echo $string_lang["NEWSLETTER_PRENOM"][$lang];?><br /></label>
                                    <input type="text" id="prenom" name="prenom"
                                    placeholder="<?php echo $string_lang["NEWSLETTER_PRENOM_FIELD"][$lang];?>" tabindex=2 value="<?php if(isset($_POST["prenom"]))echo $_POST["prenom"];?>" required/>
                                </li>
                                
                                <li class="entreesFormulairee">
                                    <label for="env"></label>
                                    <input type="submit" name="button" value="<?php echo $string_lang["NEWSLETTER_ENVOI"][$lang];?>" id="env"  class="callToAction3"/>
                                </li>
                            </ul>
						</div>
     
					</form>
                    
                    <!--________________________Fin Formulaire Colonne 2________________________-->
                     
                </div>
                
                <!--________________________Fin Formulaire 1________________________-->
			
            </div>
            
            <!--________________________Fin cadreFormulaireLeft________________________-->
            
            <br class="annule" />


			<!-- <p href="#" class="texteFormulaire"><a href="#">
			            	<?php echo $string_lang["NEWSLETTER_DESINSCRIPTION"][$lang];?>
			</a></p> -->
            
            
			<?php
            	}
				else
				{
			?>
            <!--________________________Message Formulaire 1________________________-->
        	
            	<p class="titreFormulaire5">
                	<?php echo $messageOK;?>
				</p>
      
			<!--________________________Fin Message Formulaire 1________________________-->
            <?php
				}
			?>
            
            </div>

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