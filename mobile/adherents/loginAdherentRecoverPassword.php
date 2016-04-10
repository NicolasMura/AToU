<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	// Autres	
	require("../../admin/inc/fonctionMailGoogle.php");
	
	if(isset($_POST["val"]))
	{
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
				echo "OK";
				$res = $reponse->fetch();
				
				//Si le login a été trouvé dans la base
				if($res["login"] AND $res['prenom']  AND $res['nom'])
				{
					//Envoi d'un message avec le pwd
					$obj="Récupération du login et mot de passe";
					$mess="Bonjour, \r\n <br />Voici votre mot de passe et login : \r\n <br />";
					$mess.="-----------------------<br />"; 
					$mess.="Nom : ".$res['nom']." \r\n <br />"; 
					$mess.="Prénom : ".$res['prenom']." \r\n <br />";  
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
						//header("Location:index.php");
						$messageOK = "<h3>Nous venons de vous adresser un mail avec votre mot de passe.</h3>";	
					}	
				}
			}
			else
			{
				$erreur = "<br /><h3>Erreur : email inconnu.</h3>";
			}
		}
	}
	if(isset($_POST["val2"]))
	{
		header("Location:index.php");
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <title>Mot de passe oublié</title>
    
    <!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
</head>
    
<body id="motDePasseOublié">

    <?php include("../inc/menuDeroulant.inc.php");?>
    
    <div class="content">
      	
        <?php include("../inc/header.inc.php");?>
		 <a href="#superTop" class="topTop"></a><!--Bouton, top-->
            <h1 class="filAriane">MOT DE PASSE OUBLIÉ</h1>
            <?php
            	if(!isset($messageOK))
            	{
			?>
            <h3>Veuillez entrer votre adresse mail. Nous vous enverrons votre mot de passe.</h3>
            <?php if(isset($erreur)) echo $erreur;?>
			
              <form method="post" action="loginAdherentRecoverPassword.php">
                <ul>
                    <li>
                        <label for="mail" class="labelChamps">Mail</label> 
                        <input type="email" name="mail" id="mail" class="champs" required /> 
                    </li>
                           
                    <li>
                        <label for="val"></label>
                        <input type="submit" name="val" value="Valider" id="val" class="val"/>
                    </li>
               </ul>
        	</form>
            <?php
				}
				else
				{
					echo $messageOK;
			?>
            <form method="post" action="loginAdherentRecoverPassword.php">
            	 <ul>
                 	<li>
                        <label for="val2">	</label>
                        <input type="submit" name="val2" value="Retour" id="val2" class="val"/>
                    </li>
                </ul>
            </form>
			<?php
				}
			?>
        
       <!-- <h3>Nous venons de vous adresser un mail avec votre mot de passe.</h3>
       <p>&nbsp;</p>-->
        
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