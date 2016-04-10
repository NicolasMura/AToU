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
	// Autres
	require_once('../admin/tools/toolsDateTime.php');
	
	// Gestion des langues (champs "statiques" du front-office)
	include("../lang/langTools/lang.inc.php");
	require("../lang/lang.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription Nubes</title>
    
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
    
    <!-- Froogaloop js library for calling Vimeo's API -->
    <script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="inscriptionNubes">

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
       
	<div class="fondBlanc">
         
		<section class="formulaire" >
        
			<a href="#superTop" id="top"></a><!--Bouton, top-->
                
			<!--___________ Fil d'Arianne___________-->
            <div class="filaire">
            <?php
              define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
            ?>
              <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; Inscription Nubes'), $lang);?></p>
            </div>
            <!--_____________________________________-->

			<p class="titreFormulaire1">Inscription au prochain atelier Nubes*</p> 

			<p class="titreFormulaire2">
            	L'atelier Nubes a lieu les deuxièmes samedis de chaque mois,
            	de 10h à 13h, <br /> au studio Carmagnole.
            </p>
                         

			<!--________________________ cadreFormulaireLeft ________________________-->	
			
            <div class="cadreFormulaireLeft">
			
            <!--________________________Formulaire 1________________________-->
        	
			<div class="cadreFormulaire1">
            
            	<!--________________________Formulaire Colonne 1________________________-->

				<div id="col1">
              		<p class="titreFormulaire5">Vous êtes adhérent(e) et possédez déjà un identifiant ?</p>
				</div>
                
                <!--________________________Fin Formulaire Colonne 1________________________-->

                
                <!--________________________Formulaire Colonne 2________________________-->
                
                <div id="col2">
                	<form action="" method="post" enctype="application/x-www-form-urlencoded">
                        <ul>
                			<li class="entreesFormulairee">
                                 <input type="submit" value="Cliquez ici" id="env" class="callToAction4"/>
                            </li>
                        </ul>
					</form>
				</div>
                
                <!--________________________Fin Formulaire Colonne 2________________________-->
                
			</div>
            
			<!--________________________Fin Formulaire 1________________________-->






			<!--________________________Formulaire 2________________________-->
                
			<div class="cadreFormulaire1">
            	<p class="titreFormulaire5">
                	Vous êtes adhérent(e) et possédez déjà un identifiant ?
                	Afin de vous inscrire au prochain atelier Nubes,
                    vous devez d'abord vous connecter à l'espace adhérent.
                </p>
                
                    
                	<form action="" method="post" enctype="application/x-www-form-urlencoded">
                    
                        <!--________________________Formulaire 2 Colonne 1________________________-->
    
                        <div id="col1">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="identifiant">Identifiant<br />
                                    </label>
                                    <input type="text" id="identifiant" name="identifiant"
                                    placeholder="Votre identifiant" required/>
                                 </li>
                                    
                                 <p class="texteFormulaire3">
                                    *Si vous avez oublié votre mot de passe, <a href="#"> cliquez ici</a>.
                                 </p>
                            </ul>
                        </div>
                    
                        <!--________________________Fin Formulaire 2 Colonne 1________________________-->
    
                    
                        <!--________________________Formulaire 2 Colonne 2________________________-->
                    
                        <div id="col2">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="pass">Mot de passe *<br />
                                    </label>
                                    <input type="password" id="pass" name="pass"
                                    placeholder="Votre mot de passe" required/>
                                </li>
                                <li class="entreesFormulaire">
                                    <input type="submit" value="Validez" id="env" class="callToAction4"/>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!--________________________Fin Formulaire 2 Colonne 2________________________-->
        
                </div>
                
                <!--________________________Fin Formulaire 2________________________-->




				<!--________________________Formulaire 3________________________-->
        	
				<div class="cadreFormulaire1">
            		<p class="titreFormulaire5">
                		Veuillez entrer votre adresse mail,
                		vous recevrez par mail votre mot de passe.
					</p>
            		
                    <form action="" method="post" enctype="application/x-www-form-urlencoded">

                        <!--________________________Formulaire 3 Colonne 1________________________-->
                    
                        <div id="col1">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="mail">Mail<br />
                                    </label>
                                    <input type="email" id="mail" name="mail"
                                    placeholder="Votre mail" required/>
                                </li>
                            </ul>                  
                        </div>
                    
                        <!--________________________Fin Formulaire 3 Colonne 1________________________-->
    
                    
                        <!--________________________Formulaire 3 Colonne 2________________________-->
                    
                        <div id="col2">
                            <ul>
                                <li class="entreesFormulaire">
                                    <input type="submit" value="Validez" id="env"
                                    class="callToAction4 callToActionPosition1"/>
                                </li>
                            </ul>
                        </div>
                        
                        <!--________________________Fin Formulaire 3 Colonne 2________________________-->

                	</form>
                
				</div>
            
				<!--________________________Fin Formulaire 3________________________-->



				<!--________________________Message Formulaire 3________________________-->
        	
				<div class="cadreFormulaire1">
            		<p class="titreFormulaire5">
                		Nous avons bien reçu votre demande.
                        Vous allez recevoir un mail avec votre mot de passe.
					</p>
				</div>
            
				<!--________________________Fin Message Formulaire 3________________________-->








                <!--________________________Formulaire 4________________________-->
            
                <div class="cadreFormulaire1">
                
                    <p class="titreFormulaire5">
                        Bonjour Sylvie ! Souhaitez-vous participer au prochain atelier Nubes ?
                    </p>
    
                    <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    
                        <!--________________________Formulaire 4 Colonne 1________________________-->
    
                        <div id="col1">
                            <ul class="civiliteFormulaire">
                                <li>	
                                    <label for="oui">Oui</label>
                                    <input type="radio" id="oui" name="inscNubes" value="oui"/>
                                </li>
                                <li>
                                    <label for="non">Non</label>
                                    <input type="radio" id="non" name="inscNubes" value="non"/>
                                 </li>
                            </ul>
                        </div>
                    
                        <!--________________________Fin Formulaire 4 Colonne 1________________________-->
    
                    
                        <!--________________________Formulaire 4 Colonne 2________________________-->
                        
                        <div id="col2">
                            <ul>
                                <li class="entreesFormulairee">
                                    <input type="submit" value="Validez" id="env"  class="callToAction3"/>
                                </li>
                            </ul>   
                        </div>
                        
                        <!--________________________Fin Formulaire 4 Colonne 2________________________-->
    
                    </form>
    
                </div>
                
                <!--________________________Fin Formulaire 4________________________-->



				<!--________________________Formulaire 5________________________-->
        	
                <div class="cadreFormulaire1">
                
                    <!--________________________Formulaire 5 Colonne 1________________________-->
    
                    <div id="col1">
                        <p class="titreFormulaire5">
                			Vous souhaitez participer au prochain atelier Nubes
                   	 		et vous n'êtes pas encore adhérent(e) ?
                		</p>
                    </div>
                    
                    <!--________________________Fin Formulaire 5 Colonne 1________________________-->
    
                    
                    <!--________________________Formulaire 5 Colonne 2________________________-->
                    
                    <div id="col2">
                        <form action="" method="post" enctype="application/x-www-form-urlencoded">
                            <ul>
                                <li class="entreesFormulairee">
                                     <input type="submit" value="Participez" id="env" class="callToAction4"/>
                                </li>
                            </ul>
                        </form>
                    </div>
                    
                    <!--________________________Fin Formulaire 5 Colonne 2________________________-->
                    
                </div>
                
                <!--________________________Fin Formulaire 5________________________-->




                <!--________________________Formulaire 6________________________-->
            
                <div class="cadreFormulaire1">
                
                    <p class="titreFormulaire5">
                        Vous souhaitez participer au prochain atelier Nubes
                        et vous n'êtes pas encore adhérent(e) ?
                        Merci de remplir ce formulaire.
                    </p>
    
                    <form action="" method="post" enctype="application/x-www-form-urlencoded">
    
                        <div>
                            <ul class="civiliteFormulaire">
                                <li>	
                                    <label for="mde">Madame</label>
                                    <input type="radio" id="mde" name="civilite" value="mde"/>
                                </li>
                                <li>
                                    <label for="melle">Mademoiselle</label>
                                    <input type="radio" id="melle" name="civilite" value="melle"/>
                                 </li>
                                 <li>   
                                    <label for="m">Monsieur</label>
                                    <input type="radio" id="m" name="civilite" value="m"/>
                                </li>
                            </ul>
                        </div>
    
                    
                        <!--________________________Formulaire 6 Colonne 1________________________-->
    
                        <div id="col1">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="nom">Nom<br /></label>
                                    <input type="text" id="nom" name="nom" placeholder="Votre nom" required/>
                                </li>
                                <li class="entreesFormulaire">
                                    <label for="mail">Mail<br /></label>
                                    <input type="email" id="mail" name="mail" placeholder="Votre mail" required/>
                                </li>
                               <li class="entreesFormulaire">
                                    <label for="anniv">Date de naissance<br /></label>
                                    <input type="date" id="anniv" name="anniv"
                                    placeholder="Votre date de naissance" required/>
                                </li>
                            </ul>
                        </div>
                    
                        <!--________________________Fin Formulaire 6 Colonne 1________________________-->
    
                    
                        <!--________________________Formulaire 6 Colonne 2________________________-->
                        
                        <div id="col2">
                            <ul>
                                <li class="entreesFormulaire">
                                    <label for="prenom">Prénom<br /></label>
                                    <input type="text" id="prenom" name="prenom"
                                    placeholder="Votre prénom" required/>
                                </li>
                                <li class="entreesFormulaire">
                                    <label for="tel">Téléphone<br /></label>
                                    <input type="tel" id="tel" name="tel" placeholder="Votre téléphone"/>
                                </li>
                                <li class="entreesFormulairee">
                                    <label for="env"></label>
                                    <input type="submit" value="Validez" id="env"  class="callToAction3"/>
                                </li>
                            </ul>   
                        </div>
                        
                        <!--________________________Fin Formulaire 6 Colonne 2________________________-->
    
                    </form>
    
                </div>
                
                <!--________________________Fin Formulaire 6________________________-->
            
            
				<!--________________________Message Formulaire 6________________________-->
        	
				<div class="cadreFormulaire1">
            		<p class="titreFormulaire5">
                		Nous avons bien reçu votre demande, et vous en remercions.
                        Vous allez recevoir un mail avec votre identifiant et votre mot de passe.
					</p>
				</div>

                <!--________________________OU________________________-->


				<div class="cadreFormulaire1">
            		<p class="titreFormulaire5">
                		Cette adresse mail est déjà associée à un compte adhérent.
                        Veuillez vous identifier ou saisir une autre adresse mail.
					</p>
				</div>            
				<!--________________________Fin Message Formulaire 6________________________-->
                
			
			</div>
            <!--________________________Fin cadreFormulaireLeft________________________-->
			
            
			<!--________________________Contact________________________-->
        
			<div class="cadreFormulaireRight">
				<ul id="firstBlockFormulaire">
                	<li class="titreFormulaire3">Contactez-nous</li>
                    
                	<li class="titreFormulaire4">Administration</li>
					<li class="texteFormulaire2">
                    	Tél./ +33 (0)4 72 14 16 63<br />
                    	administration@atou.fr
                    </li>

                	<li class="titreFormulaire4">Studio Carmagnole</li>
					<li class="texteFormulaire2">
                    	Avenue Bataillon<br />Carmagnole-Liberté<br />69120 Vaulx-en-Velin
                    </li>
				</ul>
                
				<div id="secondBlockFormulaire">
                	<p class="titreFormulaire3">* Frais de participation</p>
                    
					<p class="texteFormulaire2">Lors de votre arrivée pour l’atelier, nous vous demanderons de remplir un bulletin d’adhésion complet et de régler par chèque un montant d’adhésion de 10 euros. L’adhésion est obligatoire pour des raisons d’assurance.  Une fois que vous êtes adhérents, tous les ateliers Nubes vous sont accessibles gratuitement.</p>
				</div>
			</div>
            
            <br class="annule" />
			<!--________________________Fin Contact________________________-->        


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