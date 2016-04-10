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
	
	if(isset($_POST['login']) AND isset($_POST['pass']) AND $_POST['login'] != "" AND $_POST['pass'] != "")
	{
	  $login=$_POST["login"];
	  $pass=$_POST["pass"];
	  $requeteSql="SELECT login, motDePasse, niveau, ID FROM adherents WHERE login='".$login."' AND motDePasse='".$pass."'";
	  $reponse = $bdd->query($requeteSql); // exécution de la requête sql
	  $donnees = $reponse->fetch(); //récupérer résultats de la requête Mysql et mis dans une variable $donnees
	  
			  if($_POST['pass']==$donnees[1] AND $_POST['login']==$donnees[0])
			  {
			  
			  //declare two session variables and assign them
				$_SESSION['MM_Username'] = $donnees[0];
				$_SESSION['MM_UserGroup'] = $donnees[2];
				// Ajout Nico
				$_SESSION['adherentID'] = $donnees["ID"];
				// envoi à accueil.php
				header("Location:accueilAdherents.php");
			  }
			  // sinon envoi à loginErreur.php
			  else
			  {
				  header("Location:loginAdherentErreur.php"); //. $_SERVER['HTTP_REFERER']
			  }
	  $reponse-> closeCursor();
	}
?>
<!doctype html>
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

        <!--________Librairies jquery________-->
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        
        <!--_____Tests_____-->
        <link href="../css/lightbox-form_TestNico.css" rel="stylesheet" type="text/css" >

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
        
            <h1>LOGIN ADHERENT ERREUR</h1>
            <form name="form1" method="POST" action="loginAdherentErreur.php">
              <p>
                <label for="login">Entrez votre login : </label>
                <input type="text" name="login" id="login">
              </p>
              <p>
                <label for="pass">Entrez votre mot de passe : </label>
                <input type="password" name="pass" id="pass">
              </p>
              <p>
                <input type="submit" name="button" id="button" value="Envoyer">
              </p>
            </form>
            
            <p>
            <!--<a href="loginRecoverPassword.php">Vous avez oublié votre mot de passe?</a>-->
            <a href="#" onClick="openbox('Mot de passe oublié', 1)">Vous avez oublié votre mot de passe ?</a>
            </p>

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
        
        <!--On inclut la lightbox du formulaire de récupération de mot de passe (= caché par défaut)-->
		<?php
            include("loginAdherentRecoverPasswordLightbox.php");
        ?>
        
        <script src="../js/centrerLightbox.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            
            $(document).ready(function(e){
                
                    centrerLightbox(300, 150, 48); // Largeur et hauteur SANS les paddings (= paddings déduits), hauteur et paddings facultatifs, et hauteur sans boxtitle
        
            });
        </script>
        
        <script src="../js/lightbox-form.js" type="text/javascript"></script>
        
</body>
</html>