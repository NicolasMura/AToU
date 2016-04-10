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

	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
	/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";*/
	
	// On récupère la prochaine date Nubes enregistrée (si elle existe)
	$requeteNubesDates = "SELECT dates FROM nubes";
	$reponseNubesDates = $bdd->query($requeteNubesDates);
	$nombreNubesDates = $reponseNubesDates->rowCount();
	//$requeteNubesDates->closeCursor();
	
	// Si cette date existe, on met le champ nubesDate de l'adhérent à jour en y inscrivant cette date (si l'adhérent n'est pas déjà inscrit)
	if($nombreNubesDates > 0)
	{		
		$requeteNubesNextDate = "SELECT MIN(dates) FROM nubes";
		$donneesNubesNextDate = $bdd->query($requeteNubesNextDate);
		$reponseNubesNextDate = $donneesNubesNextDate->fetch();
		$prochaineDateNubes = $reponseNubesNextDate["MIN(dates)"];
		//$requeteNubesNextDate->closeCursor();
		
		// Données adhérent
		$requeteNubesAdh = "SELECT nubesDate FROM adherents WHERE ID = ".$_SESSION['adherentID'];
		$donneesNubesAdh = $bdd->query($requeteNubesAdh);
		$reponseNubesAdh = $donneesNubesAdh->fetch();
		$NubesAdh = $reponseNubesAdh["nubesDate"];
		if($NubesAdh == $prochaineDateNubes) $nubesDateAdh = 1;
		else $nubesDateAdh = 0;
	}
	else
	{
		header("Location:accueilAdherents.php");
	}
	
	/* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */

	if(isset($_POST["env"]) AND $_POST["env"] == "Validez")
	{
		if(isset($_POST["inscNubes"]) AND $_POST["inscNubes"] == "oui")
		{
			$requete = "UPDATE adherents SET nubesDate = ? WHERE ID = ".$_SESSION['adherentID'];
			$req = $bdd->prepare($requete);
			$req->execute(array($prochaineDateNubes)) or die(print_r($req->errorInfo()));
			$req->closeCursor();
			$messageOK = "Nous avons bien reçu votre inscription au prochain atelier Nubes."; 
		}
		elseif(isset($_POST["inscNubes"]) AND $_POST["inscNubes"] == "non")
		{
			$requete = "UPDATE adherents SET nubesDate = ? WHERE ID = ".$_SESSION['adherentID'];
			$req = $bdd->prepare($requete);
			$req->execute(array("0000-00-00")) or die(print_r($req->errorInfo()));
			$req->closeCursor();
			if(isset($nubesDateAdh) AND $nubesDateAdh == 1) $messageOK = "Votre désinscription a bien été prise en compte.";
			else $messageOK = "Votre n'étiez pas inscrit(e) et vous ne l'êtes toujours pas.";
		}
		else $erreur = "Vous devez faire un choix avant de le valider."; 
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription Nubes Adhérents</title>
    
    <!--________Librairies jquery________-->
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_jf.css" />
    
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

    <!-- Add jQuery library -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <style>
		p.erreur{
			color:red;
			}
	</style>

	<?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>



<body id="inscriptionNubes">
	
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
                
			<!--___________ Fil d'Arianne ___________-->
            <div class="filaire">
                <?php
                    define('Compagnie_ATou', 'Accueil &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('accueilAdherents.php' => '&nbsp; espace adhérents &nbsp;', 
					'listeAteliers.php' => '&nbsp; Ateliers &nbsp;', 'final' => '&nbsp; Inscription Nubes'), $lang);?></p>
            </div>
            <!--_________________________________-->
            
        
    
    <div class="fondWhite">
		
        <section class="formulaire" >
        
			<a href="#superTop" id="top"></a><!--Bouton, top-->
            
			<p class="titreFormulaire1">Inscription au prochain atelier Nubes*</p> 

			<p class="titreFormulaire2">
            	L'atelier Nubes a lieu les deuxièmes samedis de chaque mois,
            	de 10h à 13h, <br /> au studio Carmagnole.
            </p>
                         

			<!--________________________ cadreFormulaireLeft ________________________-->	
			
            <div class="cadreFormulaireLeft">
			




                <!--________________________Formulaire________________________-->
            
                <div class="cadreFormulaire1">
                
			        <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
                    <p class="titreFormulaire5">
                        Souhaitez-vous participer au prochain atelier Nubes ?
                    </p>
                    <p><?php if(isset($nubesDateAdh) AND $nubesDateAdh == 1) echo "(Rappel : vous vous êtes déjà inscrit(e)).";?></p>
    
                    <form action="inscriptionNubesAdh.php" method="post">
                    
                        <!--________________________Formulaire Colonne 1________________________-->
    
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
                    
                        <!--________________________Fin Formulaire Colonne 1________________________-->
    
                    
                        <!--________________________Formulaire Colonne 2________________________-->
                        
                        <div id="col2">
                            <ul>
                                <li class="entreesFormulairee">
                                    <input type="submit" name="env" value="Validez" id="env"  class="callToAction3"/>
                                </li>
                            </ul>   
                        </div>
                        
                        <!--________________________Fin Formulaire Colonne 2________________________-->
    
                    </form>
    
                </div>
                
                <!--________________________Fin Formulaire________________________-->
 
 
                <!--________________________Message Formulaire________________________-->

				<div class="cadreFormulaire1">
                    <p class="titreFormulaire5">
                        <?php if(isset($messageOK)) echo "<p>" . $messageOK . "</p>";?>
                    </p>
				</div>

                <!--________________________Fin Message Formulaire________________________-->
           
			
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
                    
					<p class="texteFormulaire2">
                        * Les ateliers Nubes sont accessibles gratuitement
                        pour les adhérents.
                    </p>
				</div>
			</div>
            
            <br class="annule" />
			<!--________________________Fin Contact________________________-->        


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
	<script src="../jquery/topButton.js" type="text/javascript"></script>
    
</body>
</html>