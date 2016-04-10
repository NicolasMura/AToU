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
############################################################################################################################################
			//Récupération titre, salle, dates de la création actuelle
			$requete = "SELECT representations.salle, representations.dates, creations.titre, creations.ID, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationPresente' AND representations.creationsID = creations.ID";
			$reponse = $bdd->query($requete);
			$donnees = $reponse->fetch();
			// Conversion de la date en bon français
			if(isset($donnees["dates"]) AND $donnees["dates"] != "0000-00-00")
			{
				$prochaineDateCreation = dateHeureInfos($donnees["dates"]);
				$donneesCreations["dates"] = $prochaineDateCreation["date"];
			}
			
			//Récupération titre, salle, dates d'une création à venir
			$requete2 = "SELECT representations.salle, representations.dates, creations.titre, creations.ID, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationAvenir' AND representations.creationsID = creations.ID";
			$reponse2 = $bdd->query($requete2);
			$donnees2 = $reponse2->fetch();
			// Conversion de la date en bon français
			if(isset($donnees2["dates"]) AND $donnees2["dates"] != "0000-00-00")
			{
				$prochaineDateCreation2 = dateHeureInfos($donnees2["dates"]);
				$donneesCreations2["dates"] = $prochaineDateCreation2["date"];
			}
			
			//Récupération titre, salle, dates d'une création la plus présente 
			$requete3 = "SELECT representations.salle, MAX(representations.dates), creations.titre, creations.ID, creations.filenamePhotoMobile FROM representations, creations WHERE creations.statut = 'creationActuelle' AND representations.creationsID = creations.ID";
			$reponse3 = $bdd->query($requete3);
			$donnees3 = $reponse3->fetch();
			// Conversion de la date en bon français
			if(isset($donnees3["MAX(representations.dates)"]) AND $donnees3["MAX(representations.dates)"] != "0000-00-00")
			{
				$prochaineDateCreation3 = dateHeureInfos($donnees3["MAX(representations.dates)"]);
				$donneesCreations3["MAX(representations.dates)"] = $prochaineDateCreation3["date"];
			}
			
############################################################################################################################################
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>
	<title>Liste des créations</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css"/>
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    <!--<link href="../css/stylesSmart_nm.css" rel="stylesheet" type="text/css" />-->
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    
    
    
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
        <h1 class="filAriane">CREATIONS</h1>
           
                <a href="ficheCreation.php?ID=<?php echo $donnees['ID'];?>">
                <div class="onglet">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donnees['filenamePhotoMobile'];?>" alt="alt" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartouche">
                                <h2 class="titreListeCreations"><?php echo  $donnees['titre'];?></h2>
                                <p class="pLight">Prochain spectacle le</p>
                                <p class="pWeight"><?php echo  $donneesCreations["dates"];?></p>
                            </div>
                 </div>
                           
                </a>
         				     			
                <a href="ficheCreation.php?ID=<?php echo $donnees3['ID'];?>">
                <div class="onglet borderTop">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donnees3['filenamePhotoMobile'];?>" alt="Photo Madness, Love and Mysticism" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartouche">
                                <h2 class="titreListeCreations"><?php echo  $donnees3['titre'];?></h2>
                                <p class="pLight">Prochain spectacle le</p>
                                <p class="pWeight"><?php echo  $donneesCreations3["MAX(representations.dates)"];?></p>
                    		</div>
                 </div>           
                </a>
				<a href="ficheCreation.php?ID=<?php echo $donnees2['ID'];?>">
                <div class="onglet borderTop">
                            <div class="imag">
                            	<img src="../../photosMobiles/<?php echo $donnees2['filenamePhotoMobile'];?>" alt="alt" />
                            </div>
                    		<!-- <div class="strut"></div>Fake div -->
                            <div class="cartouche">
                                <h2 class="titreListeCreations"><?php echo  $donnees2['titre'];?></h2>
                                <p class="pLight">Prochain spectacle le</p>

                                <p class="pWeight"><?php echo  $donneesCreations2["dates"];?></p>
                   			</div>
                 </div>           
                </a>
        <?php include("../inc/footer.inc.php"); ?>
    
    </div>
  <!--________Librairies jquery________-->
  
   <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
</body>
</html>