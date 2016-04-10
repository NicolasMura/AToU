<?php
	//début de session
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
			if(isset($_POST["civilite"]) AND isset($_POST["prenom"]) AND isset($_POST["nom"]) AND isset($_POST["mail"]) AND isset($_POST["tel"]))
			{
			//Envoi d'un message 
			$obj="Demande d'adhésion à la newsletter";
			$mess ="-----------------------<br />"; 
			$mess.="Civilité. : ".$_POST['civilite']." \r\n <br />"; 
			$mess.="Prénom : ".$_POST['prenom']." \r\n <br />"; 
			$mess.="Nom : ".$_POST['nom']." \r\n <br />";
			$mess.="Mail: ".$_POST['mail']." \r\n <br />"; 
			$mess.="Tel : ".$_POST['tel']." \r\n <br />"; 
			$mess.="-----------------------<br />"; 
			$mess.="L'équipe ATOU <br /> \r\n"; 
			
			$mailfrom = $_POST['mail']; 
			$namefrom="EMETTEUR";
			$mailto="atou.info@gmail.com";
			$nameto="DESTINATAIRE";			

				if(($mailto!="")&&($mailto!=NULL))	
				{
					//authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess);	
					mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
					//header("Location:index.php");
					$messageOK = "<h3>Merci. Votre inscription a bien été prise en compte, vous allez recevoir un mail de confirmation.</h3>";	
				}	
			}
			else
			{
				$erreur = "<br /><h3>Erreur : Tous les champs sont obligatoires.</h3>";
			}
	}
	if(isset($_POST["val2"]))
	{
		header("Location:newsletter.php");
	}
?>	
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>S'inscrire à la newsletter</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>

   
</head>

<body id="inscriptionNubes">
		<?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
	<div class="content">

        <?php include("../inc/header.inc.php");?>
       <!--  <a href="#superTop" class="topTop"></a><!--Bouton, top-->
        <h1 class="filAriane">Newsletter</h1>
        
        <p>&nbsp;</p>
		
         <?php
            	if(!isset($messageOK))
            	{
           		if(isset($erreur)) echo $erreur;
		?>
                 
        <h3>Recevez la newsletter trimestrielle<br/>de la compagnie pour vous tenir<br/>informés de son actualité.</h3>
           
      
        <form method="post" action="newsletter.php" >
          
            <ul>
                <li>
                    <label for="civilité" class="labelChamps">Civilité</label>
        
          			<div class="md_square">
                        <label for="civiliteMME">mme</label>
                        <input type="radio" value="madame" class="md_squaredOne" name="civilite" id="civiliteMME" />
                    </div>
        
                    <div class="md_square">
                        <label for="civiliteM">m</label>
                        <input type="radio" value="monsieur" class="md_squaredOne" name="civilite" id="civiliteM" />
                    </div> 
                </li>
                
                <li>
                    <label for="nom" class="labelChamps">Nom <i>( champ obligatoire )</i> </label>
                    <input type="text" id="nom" name="nom" value="" class="champs" data-validation-length="max25" data-validation="required"/>
                </li>
                <li>
                    <label for="prenom" class="labelChamps">Prénom <i>( champ obligatoire )</i></label>
                    <input type="text" id="prenom" name="prenom" value="" class="champs" data-validation-length="max25" data-validation="required"/>
                </li>
                <li>
                    <label for="mail" class="labelChamps">Mail <i>( champ obligatoire )</i></label> 
                    <input type="email" name="mail" id="mail" class="champs" data-validation="email" data-validation="required"/> 
                </li>
                <li>
                    <label for="tel" class="labelChamps">Téléphone </label>
                    <input type="tel" name="tel" id="tel" class="champs" data-validation="number"/> 
                </li>

                 <li>
                     <label for="val"></label>
                     <input type="submit" value="Valider" id="val" name="val" class="val" />
                 </li>
                 
                                    
            </ul>
           
        </form>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
       	<script>
  		$.validate();
		</script>
        	
           <?php
				}
				else
				{
					echo $messageOK;
			?>
            <address>
                <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
            </address>
        
        
             <form method="post" action="newsletter.php">
            	 <ul>
                 	<li>
                        <label for="val2">	</label>
                        <input type="submit" name="val2" value="Retour" id="val2" class="val"/>
                    </li>
                </ul>
            </form>
        <?php } ?>
        <p>&nbsp;</p>


	<?php include("../inc/footer.inc.php");?>
        
	</div>
    
	 <!--________Librairies jquery________-->
   
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
 	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
    
 	<script src="../../jquery/nav-left.js" type="text/javascript"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    

    
</body>
</html>


