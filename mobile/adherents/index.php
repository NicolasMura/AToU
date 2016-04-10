<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	
	if(isset($_POST["val"]))
	{
		if(isset($_POST['login']) AND isset($_POST['motDePasse']) AND $_POST['login'] != "" AND $_POST['motDePasse'] != "")
		{
		  $login=$_POST["login"];
		  $pass=$_POST["motDePasse"];
		  $requeteSql="SELECT login, motDePasse, niveau, ID FROM adherents WHERE login='".$login."' AND motDePasse='".$pass."'";
		  $reponse = $bdd->query($requeteSql); // exécution de la requête sql
		  $donnees = $reponse->fetch(); //récupérer résultats de la requête Mysql et mis dans une variable $donnees
		  
				  if($pass==$donnees[1] AND $login==$donnees[0])
				  {
				  
				  //declare two session variables and assign them
					$_SESSION['MM_Username'] = $donnees[0];
					$_SESSION['MM_UserGroup'] = $donnees[2];
					// Ajout Nico
					$_SESSION['adherentID'] = $donnees["ID"];
					// envoi à accueil.php
					header("Location:accueilAdherents.php");
				  }
				  // sinon envoi à loginAdherentErreur.php
				  else
				  {
						header("Location:loginAdherentErreur.php");
				  }
		  $reponse-> closeCursor();
		}
		else $erreur = "<h3>Vous devez entrer un login et un mot de passe.</h3>";
	}	
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <title>Login adhérent</title>
    
   <!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
  <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>

<body id="loginAdherent">

	<?php include("../inc/menuDeroulant.inc.php");?>
     
	<div class="content">
      	
        <?php include("../inc/header.inc.php");?>
		<a href="#superTop" class="topTop"></a><!--Bouton, top-->
            <h1 class="filAriane">Se connecter</h1>
            
            <?php if(isset($erreur)) echo $erreur;?>
            
            <form name="form1" method="post" action="index.php">
            
                <ul>
                    <li>
                        <label for="login" class="labelChamps">Login</label> 
                        <input type="text" name="login" id="login" class="champs" required/> 
                    </li>
                
                    <li>
                        <label for="motDePasse" class="labelChamps">Mot de passe</label> 
                        <input type="password" name="motDePasse" id="motDePasse" class="champs" required/> 
                    </li>
                           
                    <li>
                        <label for="val"></label>
                        <input type="submit" name="val" value="VALIDER" id="val" class="val"/>
                    </li>
                </ul>
                
			</form>
           
            <address>
                <a href ="loginAdherentRecoverPassword.php">Mot de passe oublié</a>
            </address>
        
       <?php include("../inc/footer.inc.php");?>
        
    </div>
     <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
	
  
</body>
</html>