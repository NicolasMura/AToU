<?php
// début de session
	session_start();
// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	// Protection des pages adhérents
	include('../../admin/inc/protectionAdherent.inc.php');
	// Autres	
	require("../../admin/inc/fonctionMailGoogle.php");
	
if(isset($_POST["val"]))
	{
		if(isset($_POST['messageAdherent']) AND $_POST["messageAdherent"] != '')
		{
			
			$messageAdherent = $_POST['messageAdherent'];
			// requete vers la base
			$query = 'SELECT nom, prenom FROM adherents WHERE ID ='.$_SESSION["adherentID"];
			$reponse = $bdd->query($query);
			$res = $reponse->fetch();
			
			//Envoi d'un message avec le pwd
			$obj="Message d'un adhérent";
			$mess="Bonjour, \r\n <br />Voici le message suivant : \r\n <br />";
			$mess.="-----------------------<br />"; 
			$mess.="Nom : ".$res['nom']." \r\n <br />"; 
			$mess.="Prénom : ".$res['prenom']." \r\n <br />";  
			$mess.="-----------------------<br />"; 
			$mess.="Son avis : ".$messageAdherent." \r\n <br />";  
			$mess.="-----------------------<br /> \r\n";
			$mess.="L'équipe ATOU <br /> \r\n"; 
			
			$mailfrom = $res['mail']; 
			$namefrom="EMETTEUR";
			$mailto="atou.info@gmail.com";
			$nameto="DESTINATAIRE";			

			if(($mailto!="")&&($mailto!=NULL))	
			{
				//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
				mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
				//header("Location:index.php");
				$messageOK = "<h3>Merci de nous avoir adressé votre message.</h3>";	
			}	
		}
		else
		{
			$erreur = "<br /><h3>Erreur : veuillez entrer un message.</h3>";
		}
	}
	if(isset($_POST["val2"]))
	{
		header("Location:donnervotreavis.php");
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>Donner votre avis</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
   
</head>
    
<body id="motDePasseOublie">
	 
     <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
     
    <div class="content">
      	
        <?php include("../inc/header.inc.php");?>
      <!--  <a href="#superTop" class="topTop"></a>Bouton, top-->
		<div class="contentSub">
            <h1 class="filAriane">DONNER VOTRE AVIS</h1>
        <?php
			if(!isset($messageOK))
			{
		?>    
            <p>&nbsp;</p>
            <p class="NoteAuteur">Faites nous part de vos remarques et commentaires en précisant le nom de l'atelier sur lequel vous souhaitez réagir.</p>
        <?php
			}
		?>   
	  <p>&nbsp;</p>
            
           
           
            <?php
            	if(!isset($messageOK))
            	{
			?>
           <h2>Exprimez vous</h2>
            <?php if(isset($erreur)) echo $erreur;?>
			
              <form method="post" action="donnervotreavis.php">
                <ul>
                    <li>
                    	Restrict length
                    	<span id="max-length-element">200</span> chars left
                      	<textarea name="messageAdherent" class="messageAdherent" cols="" rows=""></textarea>
                      	<!--  <label for="mail" class="labelChamps">Mail</label> 
                        <input type="email" name="mail" id="mail" class="champs" required /> -->
                    </li>
                           
                    <li>
                        <label for="val"></label>
                        <input type="submit" name="val" value="Valider" id="val" class="val"/>
                    </li>
               </ul>
        	</form>
             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
       <script>
  $.validate();
   $('.messageAdherent').restrictLength( $('#max-length-element') );
</script>
            <?php
				}
				else
				{
					echo $messageOK;
			?>
            <form method="post" action="donnervotreavis.php">
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
           
           
            <p>&nbsp;</p>
           </div> 
	<?php include("../inc/footer.inc.php");?>

        
    </div>
    
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
 	<script src="../../jquery/nav-left.js" type="text/javascript"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>

</body>
</html>


