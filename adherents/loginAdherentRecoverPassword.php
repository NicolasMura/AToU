<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
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
	
	// Autres	
	require("../admin/inc/fonctionMailGoogle.php");	

	if(isset($_POST['mail']) AND $_POST["mail"] != '')
	{
		$email = $_POST['mail'];
		// requete vers la base
		$query = 'SELECT login, motDePasse, mail, nom, prenom FROM adherents WHERE mail="'.$email.'"';
		$reponse = $bdd->query($query);
		$nbreReponse = $reponse->rowCount();

		//Si la requête s'est exécutée avec succès			
		if($nbreReponse > 0)
		{
			$res = $reponse->fetch();
			
			//Si le login a été trouvé dans la base
			if($res["login"] AND $res['prenom']  AND $res['nom'])
			{
				//Envoi d'un message avec le pwd
				$obj="Récupération du login et mot de passe";
				$mess="Bonjour ".$res['prenom'].", \r\n <br /><br />Voici votre mot de passe et login : \r\n <br />";
				$mess.="-----------------------<br />"; 
				$mess.="Login : ".$res['login']." \r\n <br />"; 
				$mess.="Mot de passe : ".$res['motDePasse']." \r\n <br />";  
				$mess.="-----------------------<br /> \r\n";
				$mess.="L'équipe ATOU <br /> \r\n"; 
				
				$mailfrom = $res['mail']; 
				$namefrom="EMETTEUR";
				$mailto=$email;	
				$nameto="DESTINATAIRE";			

				if(($mailto!="")&&($mailto!=NULL))	
				{
					//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
					mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
					//echo "MESSAGE ".$mess."<br />";				
					//echo "ENVOI à ".$destinataire."<br />";	
					//header("Location:index.php");	
				}	
			} // fin du test d'envoi du form
					
					//if(mail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess))
				//	{
				//		echo "L'email a bien été envoyé.";
				//	}
				//	else
				//	{	
				//		echo "Une erreur s'est produite lors de l'envoi de l'email.";
				//	}
			//	}else{

			//	echo("Ce mail ne correspond à rien");
		}
		else
		{
			$erreur = "Erreur : désolé, cet email nous est inconnu.";	
		}				
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Login adhérent erreur</title>
    
    <!--_____reset Eric Meyer_____-->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <!--_____feuille de style_____-->
    
    <link href="../css/stylesScreen.css" rel="stylesheet" type="text/css"/>
    <link href="../css/stylesScreen_cv.css" rel="stylesheet" type="text/css"/>
    <link href="../css/stylesScreen_jf.css" rel="stylesheet" type="text/css"/>
    
    <!--_____font Alegreya_____-->
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

    <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>
<body>
	
    <div class="bgheader">
		<div id="entete">
			<header>
				<?php
		  		include("../inc/menuFront.inc.php");
    			?>
			</header>  
		</div> 
    </div>
    
 	<section>
        <div class="fondNoir">
        
			<h1>Récupération de mot de passe</h1>
            <?php if(isset($erreur)) echo $erreur;?>
            <form method="post" action="loginAdherentRecoverPassword.php">
            <fieldset>
            <legend>Récupération de mot de passe</legend>
                <span id="sprytextfield1">
                    <label for="mail">Entrez votre mail :</label>
                    <input type="text" name="mail" id="mail" required />
                    <span class="textfieldRequiredMsg">Une valeur est requise.</span><span class="textfieldInvalidFormatMsg">Format non valide.</span>
                </span>
                <p>
                    <input type="submit" name="button" id="button" value="Envoyer" />
                </p>
            </fieldset>
            </form>                
        
		<script type="text/javascript">
        var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
        </script>
        
        </div>
    </section>
        
    <div id="bgfooter">
        <div id="pied">
            <footer>
                <?php
                  include("../inc/footerFront.inc.php");
                ?>
            </footer>
        </div>
    </div>
        
</body>
</html>