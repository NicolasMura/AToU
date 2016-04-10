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
	require_once('../../admin/tools/toolsDateTime.php');

	############################################################################################################################################
	//Récupération titre, salle, dates des ateliers à afficher sur la liste
	$requete = "SELECT * FROM ateliers WHERE ID < 3 OR ID > 8 ORDER BY ID";
	$reponse = $bdd->query($requete);
	$i=0;
	while($donnees = $reponse->fetch()){
		$donneesAteliers[$i] = $donnees;	

		// Conversion de la date en bon français
		if(isset($donnees["dates"]) AND $donnees["dates"] != "0000-00-00")
		{
			$prochaineDateAtelier = dateHeureInfos($donnees["dates"]);
			$donneesAteliers[$i]["dates"] = $prochaineDateAtelier["date"];
		}
		$i++;
	};

	// On récupère la prochaine date Nubes enregistrée (si elle existe)
	$requeteNubesDates = "SELECT dates FROM nubes";
	$reponseNubesDates = $bdd->query($requeteNubesDates);
	$nombreNubesDates = $reponseNubesDates->rowCount();

	if($nombreNubesDates > 0)
	{		
		$requeteNubesNextDate = "SELECT MIN(dates) FROM nubes";
		$donneesNubesNextDate = $bdd->query($requeteNubesNextDate);
		$reponseNubesNextDate = $donneesNubesNextDate->fetch();
		$prochaineDateNubes = $reponseNubesNextDate["MIN(dates)"];

		// Conversion de la date en bon français
		$prochaineDateNubes = dateHeureInfos($prochaineDateNubes);
		$prochaineDateNubes = $prochaineDateNubes["date"];
	}
	else
	{
		$prochaineDateNubes = "A venir...";
	}

	############################################################################################################################################
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>
	<title>Liste ateliers</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css"/>
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
  <!--  <link href="../css/stylesSmart_nm.css" rel="stylesheet" type="text/css" />-->
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>

<body id="listeCreations">

<?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>

    <div class="content">
    
		<?php include("../inc/header.inc.php"); ?>
		<a href="#superTop" class="topTop"></a><!--Bouton, top-->
        <h1 class="filAriane">ATELIERS</h1>
           		
           		<a href="ficheAtelier.php?ID=<?php echo $donneesAteliers[0]['ID'];?>">
                <div class="onglet">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donneesAteliers[0]["filenamePhotoMobile"];?>" alt="photo" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartoucheAtelier">
                                <h2 class="titreListeCreations"><?php echo $donneesAteliers[0]['titre']?></h2>
                                <p class="pLight">Prochain atelier le</p>
								<p class="pWeight"><?php echo $prochaineDateNubes;?></p>
                               <!-- <p class="pWeight">Le <time datetime="2014-11-22">22 novembre</time></p>-->
                            </div>
                 </div>           
                </a>
                
                <a href="ficheAtelier.php?ID=<?php echo $donneesAteliers[1]['ID'];?>">
                <div class="onglet borderTop">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donneesAteliers[1]["filenamePhotoMobile"];?>" alt="photo" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartoucheAtelier">
                                <h2 class="titreListeCreations"><?php echo $donneesAteliers[1]['titre']?></h2>
                                <p class="pLight"></p>
								<p class="pWeight"></p>
                               <!-- <p class="pWeight">Le <time datetime="2014-11-22">22 novembre</time></p>-->
                            </div>
                 </div>           
                </a>
				
				<?php for($i=2; $i<count($donneesAteliers); $i++)
						{?>
                        
                <a href="ficheAtelier.php?ID=<?php echo $donneesAteliers[$i]['ID'];?>">
                <div class="onglet borderTop">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donneesAteliers[$i]["filenamePhotoMobile"];?>" alt="photo" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartoucheAtelier">
                                <h2 class="titreListeCreations"><?php echo $donneesAteliers[$i]['titre']?></h2>
                                <p class="pLight"><?php if(isset($donneesAteliers[$i]['dates']) AND $donneesAteliers[$i]['dates'] != "0000-00-00") echo "Prochain atelier le";?></p>
								<p class="pWeight"><?php 
													if(isset($donneesAteliers[$i]['dates']) AND $donneesAteliers[$i]['dates'] != "0000-00-00") 
														echo $donneesAteliers[$i]['dates'];
													if(isset($donneesAteliers[$i]['infos']) AND $donneesAteliers[$i]['infos'] != "")
														echo $donneesAteliers[$i]['infos'];?></p>
                               <!-- <p class="pWeight">Le <time datetime="2014-11-22">22 novembre</time></p>-->
                            </div>
                 </div>           
                </a>
        		<?php }?> 
 				
        <?php include("../inc/footer.inc.php"); ?>
    
    </div>
 <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
</body>
</body>
</html>