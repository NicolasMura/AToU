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
		if(isset($_POST["mail"]) AND isset($_POST["nom"]) AND isset($_POST["prenom"]))
		{
		//Envoi d'un message à AToU 
		$obj="Demande d'adhésion à la newsletter";
		$mess ="-----------------------<br />"; 
		$mess.="Un professionnel a rempli le formulaire de contact pro sur le site AToU : \r\n <br />";
		if(isset($_POST['civilite'])) $mess.="Civilité : ".$_POST['civilité']." \r\n <br />";
		$mess.="Nom : ".$_POST['nom']." \r\n <br />";
		$mess.="Prénom : ".$_POST['prenom']." \r\n <br />";
		$mess.="Email : ".$_POST['mail']." \r\n <br />";
		if(isset($_POST['tel'])) $mess.="Téléphone : ".$_POST['tel']." \r\n <br />";
		if(isset($_POST['profession'])) $mess.="Profession : ".$_POST['profession']." \r\n <br />";
		if(isset($_POST['fiche'])) 
		{
			$fiche = $_POST['fiche'];
			if($fiche == 1) $mess.="Intéressé par la fiche technique d'une création : oui \r\n <br />";
			else $mess.="Intéressé par la fiche technique d'une création : non \r\n <br />";
		}
		if(isset($_POST['crea'])) $mess.="Nom de la création : ".$_POST['crea']." \r\n <br />";
		$mess.="-----------------------<br />"; 
		
		$mailfrom = $_POST['mail']; 
		$namefrom="EMETTEUR";
		$mailto=EMAIL_ATOU;
		$nameto="DESTINATAIRE";			

			if(($mailto!="")&&($mailto!=NULL))	
			{
				mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
				
				//Envoi d'un message au demandeur 
				$obj="Demande d'adhésion à la newsletter AToU";
				$mess ="-----------------------<br />"; 
				$mess.="AToU vous informe que votre demande a bien été reçue et sera prise en compte prochainement.<br />Cordialement,<br />La compagnie AToU<br />";
				$mess.="-----------------------<br />"; 
				
				$mailfrom = $_POST['mail']; 
				$namefrom="EMETTEUR";
				$mailto= $_POST['mail']; ;
				$nameto="DESTINATAIRE";			
	
				if(($mailto!="")&&($mailto!=NULL))	
				{
					mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
					$messageOK = "";	
				}	
			}
			
		}
		else
		{
			$erreur = "<br /><h3>Vous devez entrer au moins un nom, un prénom et un email valide.</h3>";
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact professionnel</title>
    
    <!--________Librairies jquery________-->
    
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 
	<script type="text/javascript">
    
        $(document).ready(function(e){
            $('.deroule').hide();
            $('.toggle').click(function(){
				
            $('.deroule').slideUp("slow");
			$('.toggle').addClass('toggleUp');
			$('.toggle').removeClass('toggleDown');
				
			if(!$(this).hasClass('accordeonActive')){
            $(this).next().slideToggle().siblings(".deroule:visible").slideUp("slow");
				$(this).addClass('accordeonActive');
				$(this).addClass('toggleDown');
				$(this).removeClass('toggleUp');
			}
			else {
				$(this).removeClass('accordeonActive');	
				
			}
			
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
    
    <!--________reset Eric Meyer________-->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/reset.css" />
    <!--________feuille de style________-->
    
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_cv.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_jf.css" rel="stylesheet" type="text/css"/>
    
    <!--________font Alegreya________-->
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

    <style>
		.nm_mailContact{
			color:black;
			}
	</style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="contactPro">

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
                    <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["FIL_ARIANE_CONTACT_PRO"][$lang]), $lang);?></p>
                </div>
                <!--_____________________________________-->
             
            	<div class="fondWhite">	
                
                <section class="formulaire" >                
                                
                
                <p class="titreFormulaire1"><?php echo $string_lang["CONTACT_PRO_TITRE"][$lang];?>*</p>
    
                
                <?php
					if(!isset($messageOK))
					{
						if(isset($erreur)) echo "<p class='erreur'>".$erreur."</p>";
				?>
                <!--________________________ cadreFormulaireLeft ________________________-->	
                <div class="cadreFormulaireLeft">
                            
            
                    <div class="cadreFormulaire1">
                        <form action="../contactPro" method="post">
                            
                            <!--________________________Formulaire Colonne 1________________________-->
    
                            <div id="col1">
                                <ul>
                                    <li class="entreesFormulaire">
                                        <label for="nom"><?php echo $string_lang["CONTACT_PRO_NOM"][$lang];?><br /></label>
                                        <input type="text" id="nom" name="nom" placeholder="<?php echo $string_lang["CONTACT_PRO_NOM_FIELD"][$lang];?>" tabindex=1 value="<?php if(isset($_POST["nom"])) echo $_POST["nom"];?>" required />
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="mail"><?php echo $string_lang["CONTACT_PRO_MAIL"][$lang];?><br /></label>
                                        <input type="email" id="mail" name="mail" placeholder="<?php echo $string_lang["CONTACT_PRO_MAIL_FIELD"][$lang];?>" tabindex=3 value="<?php if(isset($_POST["mail"])) echo $_POST["mail"];?>" required/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="profession"><?php echo $string_lang["CONTACT_PRO_PROFESSION"][$lang];?><br /></label>
                                        <input type="text" id="profession" name="profession" placeholder="<?php echo $string_lang["CONTACT_PRO_PROFESSION_FIELD"][$lang];?>" tabindex=5 value="<?php if(isset($_POST["profession"])) echo $_POST["profession"];?>"/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="commentaire"><?php echo $string_lang["CONTACT_PRO_COMMENTAIRE"][$lang];?><br /></label>
                                        <textarea name="commentaire" tabindex=7><?php if(isset($_POST["commentaire"])) echo $_POST["commentaire"];?></textarea>
                                    </li>
                                </ul>
                            </div>
                            
                            <!--________________________Fin Formulaire Colonne 1________________________-->
    
                            <!--________________________Formulaire Colonne 2________________________-->
                    
                             <div id="col2">
                                <ul>
                                    <li class="entreesFormulaire">
                                        <label for="prenom"><?php echo $string_lang["CONTACT_PRO_PRENOM"][$lang];?><br /></label>
                                        <input type="text" id="prenom" name="prenom" placeholder="<?php echo $string_lang["CONTACT_PRO_PRENOM_FIELD"][$lang];?>" tabindex=2 value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"];?>" required/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="tel"><?php echo $string_lang["CONTACT_PRO_TEL"][$lang];?><br /></label>
                                        <input type="tel" id="tel" name="tel" placeholder="<?php echo $string_lang["CONTACT_PRO_TEL_FIELD"][$lang];?>" value="<?php if(isset($_POST["tel"])) echo $_POST["tel"];?>" tabindex=4/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="structure"><?php echo $string_lang["CONTACT_PRO_STRUCTURE"][$lang];?><br /></label>
                                        <input type="text" id="structure" name="structure" placeholder="<?php echo $string_lang["CONTACT_PRO_STRUCTURE_FIELD"][$lang];?>" tabindex=6 value="<?php if(isset($_POST["structure"])) echo $_POST["structure"];?>"/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="fiche" class="labeLine" >
                                            <?php echo $string_lang["CONTACT_PRO_FICHE_COCHE"][$lang];?>
                                        </label>
                                        <input type="checkbox" id="fiche" name="fiche" tabindex=8/>
                                    </li>
                                    <li class="entreesFormulaire">
                                        <label for="crea"><?php echo $string_lang["CONTACT_PRO_FICHE_PRECISION"][$lang];?><br /></label>
                                        <input type="text" id="crea" name="crea" tabindex=9 value="<?php if(isset($_POST["crea"])) echo $_POST["crea"];?>"/>
                                    </li>
                                    <li class="entreesFormulairee">
                                        <label for="env"></label>
                                        <input type="submit" value="<?php echo $string_lang["CONTACT_PRO_ENVOI"][$lang];?>" id="env" name="button" class="callToAction3 callToActionPosition3"/>
                                    </li>
                                </ul>
                            </div>
                            
                            <!--________________________Fin Formulaire Colonne 2________________________-->
    
                        </form> 
                    </div>
                    
                   <!--________________________Message Formulaire________________________-->
               
                    
        
                    <!--________________________Fin Message Formulaire________________________-->
                </div>
                <?php
					}
					else
					{
				?> 
                <div class="cadreFormulaire1">
                        <p class="titreFormulaire5">
                            <?php echo $string_lang["CONTACT_PRO_CONFIRMATION_ENVOI_FORMULAIRE"][$lang];?>
                        </p>
                    </div>
                 <?php
					}
				?> 
                
                
                
                
    
                    
                <!--________________________Fin cadreFormulaireLeft________________________-->
    
    
                <!--________________________Contact________________________-->
            
                <div class="cadreFormulaireRight">
                    <ul id="firstBlockFormulaire">
                        <li class="titreFormulaire3"><?php echo $string_lang["CONTACT_PRO_CONTACT"][$lang];?></li>
                        
                        <li class="texteFormulaire2">
                            8 avenue Bataillon<br />
                            Carmagnole-Liberté<br />
                            69120 Vaulx-en-Velin<br />
                            Tél./ +33 (0)4 72 14 16 63
                         </li>
    
                        <li class="titreFormulaire4">Anan Atoyama</li>
                        <li class="texteFormulaire2">
                            Chorégraphe<br />
                            <a class="nm_mailContact" href="mailto:a.atoyama@atou.fr">a.atoyama@atou.fr</a>
                        </li>
    
                        <li class="titreFormulaire4">Marc Ribault</li>
                        <li class="texteFormulaire2">
                            Artiste associé<br />
                            <a class="nm_mailContact" href="mailto:marc@atou.fr">marc@atou.fr</a>
                        </li>
                        
                        <li class="titreFormulaire4">Anne-Sophie Gineste</li>
                        <li class="texteFormulaire2">
                            Chargée de diffusion<br />
                            Tél./ +33 (0)6 51 81 24 75<br />
                            <a class="nm_mailContact" href="mailto:diffusion@atou.fr">diffusion@atou.fr</a>
                        </li>
                        
                        <li class="titreFormulaire4">Administration</li>
                        <li class="texteFormulaire2">
                            Delphine Le Gallais<br />
                            <a class="nm_mailContact" href="mailto:administration@atou.fr">administration@atou.fr</a>
                        </li>
                    </ul>
                </div>
                
                <br class="annule" />
                <!--________________________Fin Contact________________________-->        
    
                <p class="texteFormulaire">* <?php echo $string_lang["CONTACT_PRO_NOTE"][$lang];?></p> 
    			
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
    
</body>
</html>