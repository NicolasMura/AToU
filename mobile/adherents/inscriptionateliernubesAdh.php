<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// Protection des pages adhérents
	include('../../admin/inc/protectionAdherent.inc.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// Gestion des constantes	
	require_once("../inc/constantes.inc.php");
	// Autres
	require_once('../../admin/tools/toolsDateTime.php');

/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
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
		
		$prochaineDateNubesEnFrancais = dateHeureInfos($prochaineDateNubes);
		$prochaineDateNubesEnFrancais = $prochaineDateNubesEnFrancais["date"];
		//$requeteNubesNextDate->closeCursor();
		
		// Données adhérent
		$requeteNubesAdh = "SELECT prenom, nubesDate FROM adherents WHERE ID = ".$_SESSION['adherentID'];
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

	if(isset($_POST["env"]) AND $_POST["env"] == "Valider")
	{
		if(isset($_POST["participation"]) AND $_POST["participation"] == "oui")
		{
			$requete = "UPDATE adherents SET nubesDate = ? WHERE ID = ".$_SESSION['adherentID'];
			$req = $bdd->prepare($requete);
			$req->execute(array($prochaineDateNubes)) or die(print_r($req->errorInfo()));
			$req->closeCursor();
			$messageOK = "Merci.<br/>Votre inscription a bien été prise<br/>en compte.<br /><br />"; 
		}
		elseif(isset($_POST["participation"]) AND $_POST["participation"] == "non")
		{
			$requete = "UPDATE adherents SET nubesDate = ? WHERE ID = ".$_SESSION['adherentID'];
			$req = $bdd->prepare($requete);
			$req->execute(array("0000-00-00")) or die(print_r($req->errorInfo()));
			$req->closeCursor();
			if(isset($nubesDateAdh) AND $nubesDateAdh == 1) $messageOK = "Votre désinscription a bien été prise en compte.<br /><br />";
			else $messageOK = "Votre n'étiez pas inscrit(e) et vous ne l'êtes toujours pas.<br /><br />";
		}
		else $erreur = "Vous devez faire un choix avant de le valider."; 
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>S'inscrire à l'atelier Nubes Adh</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    <!--________Librairies jquery________-->
   
   	
    <style>
		.erreur{
			color:red;
			}
	</style>
</head>

<body id="inscriptionNubes">
<?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
	<div class="content">

			<?php include("../inc/header.inc.php");?>
            <a href="#superTop" class="topTop"></a><!--Bouton, top-->
            <h1 class="filAriane">S'inscrire à l'atelier Nubes</h1>
            
            <?php
                // Si l'adhérent n'a encore rien envoyé, on affiche le formulaire
                if(!isset($messageOK))
                {
            ?>
            
            <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>
            <h3>Bonjour <?php echo $reponseNubesAdh["prenom"];?> !<br/>Souhaitez-vous participer au prochain atelier Nubes du <?php echo $prochaineDateNubesEnFrancais;?> ?</h3>
            <p><?php if(isset($nubesDateAdh) AND $nubesDateAdh == 1) echo "(Rappel : vous vous êtes déjà inscrit(e)).";?></p>
            <p>&nbsp;</p>
        
            <div class="formulaireInscription">
            
            <form method="post" action="inscriptionateliernubesAdh.php">
          
                <ul>
                    <li>
                        <label for="participation" class="labelChamps"></label>
           	  <div class="formulaireInscriptionCentrage">
             
                            <div class="md_square">
                                <label for="participationOui">Oui</label>
                                <input type="radio" value="oui" class="md_squaredOne" name="participation" id="participationOui" />
                            </div>
        
                            <div class="md_square">
                                <label for="participationNon">Non</label>
                                <input type="radio" value="non" class="md_squaredOne" name="participation" id="participationNon" />
                            </div> 
        		</div>
                </li>
        
                <li>
                    <label for="val"></label>
                    <input type="submit" value="Valider" id="val" name="env" class="val" />
                </li>
             </ul>
         
        </form>
        </div>
        <?php
			}
			// Sinon on affiche le retour utilisateur qui va bien
			else echo "<p>" . $messageOK . "</p>";
		?>
        
		
       
        	<h3 class="titreH3">Notre administrateur</h3>
        <address>
            <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
        	 
        	<a href="tel:+33(0)472141663">+33(0)472141663</a>
        </address>
        

	<?php include("../inc/footer.inc.php");?>
        
	
    </div> <!--fin du content-->
    
	 <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
 	<script src="../../jquery/nav-left.js" type="text/javascript"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
</body>
</html>


