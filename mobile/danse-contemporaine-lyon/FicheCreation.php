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
	require_once('../../admin/tools/toolsDateTime.php');
	
	if(isset($_GET['ID']))  $ID = $_GET['ID'];
	$url="http://www.atou.fr/mobile/danse-contemporaine-lyon/ficheCreation.php?ID=".$ID;
	$requete = "SELECT * FROM creations WHERE ID =".$ID;
	$reponse = $bdd->query($requete);
	$donnees = $reponse->fetch();
		
	$requete2 = "SELECT * FROM representations WHERE creationsID =".$ID." AND dates != '0000-00-00' ORDER BY dates ASC";
	$reponse2 = $bdd->query($requete2);
	//$donnees2 = $reponse2->fetch();
	$i=0;
	while($donnees2 = $reponse2->fetch())
	{
		$idCreations[] = $donnees2;
		
		// Traitement des horaires : on enlève les secondes inutiles
		$heureDebut = "2014-01-01 ".$idCreations[$i]["heureDebut"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
		$heureDebut = dateHeureInfos($heureDebut);
		$idCreations[$i]["heureDebut"] = $heureDebut["heure"];
		
		// Traitement des dates : conversion de la date en bon français
		if(isset($donnees2["dates"]) AND $donnees2["dates"] != "0000-00-00")
		{
			$prochaineDateCreation = dateHeureInfos($donnees2["dates"]);
			$idCreations[$i]["dates"] = $prochaineDateCreation["date"];
		}
		
		// Récup long et lat
		$gps = explode(",", $idCreations[$i]["adresseGpsDuLieu"]);
		$idCreations[$i]["long"] = $gps[0];
		$idCreations[$i]["lat"] = $gps[1];
		
		$i++;
	}
	
	// Facebook
	$titleFacebook = "Création AToU ".$donnees["titre"];
	$urlPageFacebook ="http://www.atou.fr/mobile/danse-contemporaine-lyon/ficheCreation.php?ID=".$donnees["ID"];
	$urlImageFacebook = "http://www.atou.fr/photosMobiles/".$donnees["filenamePhotoMobile"];
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>Fiche création</title>
    
	<!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
	<meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
    <!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <!--<link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    <style>
		#nm_heure{
			line-height:45px;
			}
	</style>
   
</head>

<body id="ficheAtelier">

	<?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>

	<div class="content">

        <?php include("../inc/header.inc.php");?>
       <a href="#superTop" class="topTop"></a><!--Bouton, top-->
       <div class="arrowBack"><a href="listeCreations.php"><img src="../../img/mobilePictoBack.png"/></a></div> <!--Update Jeudi 10 avril 2014 -->
       <div class="retourListe">Retour aux créations</div>
       
       <h1><?php echo $donnees['titre']?></h1>
       
       

       <div class="imgFicheCreation">
       <img src="../../photosMobiles/<?php echo $donnees['filenamePhotoMobile'];?>" alt="" />
       </div>
       
       
        
        <div class="black bouton" >
            <a href="#" class="toggle">Découvrir <?php echo $donnees['titre'];?></a>
            <div class="deroule">
                <p class="pFicheCreation">
                <h5>Création <?php echo $donnees['anneeCreation']?> - <?php echo $donnees['type'];?> - <?php echo $donnees['duree']?></h5>
                 </p>
                 <p class="pFicheCreation2">
                 <?php echo $donnees['resumeMobile'];?>
                </p>
       		
			<div ><a  class="partage" href="#" title="PARTAGER SUR" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">PARTAGER SUR</a></div>
            
           
            
            </div>
        </div>

        <p>&nbsp;</p> 	
        
        <?php
        	if(isset($idCreations[0]["infosMobile"])) echo "<p>" . $idCreations[0]["infosMobile"] . "</p>";
		?>
              
        
            	<div class="calendrier">
                		<div class="dateHeure"><!--Update Jeudi 10 avril 2014 -->
                            <div class="pictoCalendrier"><img src="../../img/mobilePictoDate.png"></div> <!--Update Jeudi 10 avril 2014 -->
                            <div class="date"> <?php echo $idCreations[0]["dates"];?></div>
                            <div id="nm_heure" class="heure"><?php echo $idCreations[0]["heureDebut"];?></div>
                        </div>
                        <div class="lieu"><?php echo $idCreations[0]['salle'];?></div>
                        <div class="adresse"><?php echo $idCreations[0]['adresse']?><br/><?php echo $idCreations[0]['ville'];?></div>
                        
                        <div data-long="<?php echo $idCreations[0]["long"];?>" 
                        	data-lat="<?php echo $idCreations[0]["lat"];?>"
                            data-idmap="<?php echo "carte5";?>"
                            class="go">Y aller</div>
                        <div class="blocCache">
                        
                        	<div class="modeTransport">
                                               
                        		<h5>Choississez votre itinéraire</h5>
                            
                                <div class="centragePuce">
                                
                                    <ul>
                                        <li><a href="#" onClick="changeTransportMode('voiture');return false" class="pictovoiture gmapvoitureOn"></a></li>
                                        <li><a href="#" onClick="changeTransportMode('transit');return false" class="pictotransit  gmaptransitOff"></a></li>
                                        <li><a href="#" onClick="changeTransportMode('pieds');return false" class="pictopieds gmappiedsOff"></a></li>
                                        <li><a href="#" onClick="changeTransportMode('velo');return false" class="pictovelo gmapveloOff"></a></li>
                                    </ul>
                                    
                                    <br class="annule"/>
                                    
                                </div>    
                                
                            </div>   
                                                    
                        	<!--<div id="carte"></div>-->
                      	                        
                        </div>
                </div>
             
            <p class="titreH3"><h3>Pour plus d'informations,<br/>
            contactez notre administrateur.</h3></p>
            <address>
                <a href="tel:+33(0)472141663">+33(0)472141663</a>
                <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
            </address>
            
       

	<?php include("../inc/footer.inc.php");?>
        
	</div>
    
	 <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="../../jquery/mapsGoogleTools.js" type="text/javascript"></script>
     <script>
	$('.partage').css({
    width:'177px',
	margin:'0 auto',
	heigth:'44px',
	lineHeight : '44px' ,
	padding:'0 0 0 20px',
	fontWeight:'300',
	fontSize:'18px',
	color:'white',
	background:'#82358A',
	border:'2px solid white',
	backgroundImage:'url(../../img/mobilePictoFacebookWhite.png)',
	backgroundRepeat:'no-repeat',
	backgroundPosition:'135px',
	marginTop:'10px',
	marginBottom:'20px'
});
	</script>
    
</body>
</html>


