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
	
	if(isset($_GET['ID']))  $ID = $_GET['ID'];
	else header("location:listeAteliers.php");
	
	// Données bdd des ateliers
	$requete = "SELECT * FROM ateliers WHERE ID =".$ID;
	$reponse = $bdd->query($requete);
	$donneesAtelier = $reponse->fetch();
	
	// Récup long et lat
		$gps = explode(",", $donneesAtelier["adresseGpsDuLieu"]);
		$donneesAtelier["long"] = $gps[0];
		$donneesAtelier["lat"] = $gps[1];
	
	// Pour l'atelier Nubes, on récupère la prochaine date Nubes enregistrée
	if($ID == 1)
	{
		$requeteNubes = "SELECT * FROM nubes ORDER BY dates DESC";
		$reponseNubes = $bdd->query($requeteNubes);
		$nombreNubesDates = $reponseNubes->rowCount();
		while($donneesNubes = $reponseNubes->fetch()) $donneesAtelierNubes = $donneesNubes;  // On ne garde que la dernière date (= la prochaine dans le temps)s
		
		if($nombreNubesDates > 0)
		{		
			//$requeteNubesNextDate = "SELECT MIN(dates) FROM nubes";
			//$donneesNubesNextDate = $bdd->query($requeteNubesNextDate);
			//$reponseNubesNextDate = $donneesNubesNextDate->fetch();
				
			$prochaineDateNubes = $donneesAtelierNubes["dates"]; 
			$prochaineDateNubes = dateHeureInfos($prochaineDateNubes);
			$donneesAtelier["prochaineDateNubes"] = $prochaineDateNubes["date"];
			
			// Traitement des horaires : on enlève les secondes inutiles
			$heureDebut = "2014-01-01 ".$donneesAtelierNubes["heureDebut"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
			$heureFin = "2014-01-01 ".$donneesAtelierNubes["heureFin"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
			$heureDebut = dateHeureInfos($heureDebut);
			$heureFin = dateHeureInfos($heureFin);
			$donneesAtelier["heureDebut"] = $heureDebut["heure"];
			$donneesAtelier["heureFin"] = $heureFin["heure"];
			
		}
		else
		{
			$donneesAtelier["prochaineDateNubes"] = "A venir...";
		}
	}
	
	// Données bdd pour l'atelier "global" Autour de TransFORME 2014
	// Données bdd pour les ateliers "Groupes de travail" et "Répétitions générales"de TransFORME
	//Récupération titre, salle, dates des ateliers à afficher sur la liste
	$requete2 = "SELECT * FROM ateliers WHERE ID BETWEEN 3 AND 8 ORDER BY ID";
	$reponse2 = $bdd->query($requete2);
	$i=0;
	while($donnees2 = $reponse2->fetch())
	{
		$donneesAteliersParticuliers[$i] = $donnees2;
		
		// Traitement des horaires : on enlève les secondes inutiles
		$heureDebut = "2014-01-01 ".$donneesAteliersParticuliers[$i]["heureDebut"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
		$heureFin = "2014-01-01 ".$donneesAteliersParticuliers[$i]["heureFin"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
		$heureDebut = dateHeureInfos($heureDebut);
		$heureFin = dateHeureInfos($heureFin);
		$donneesAteliersParticuliers[$i]["heureDebut"] = $heureDebut["heure"];
		$donneesAteliersParticuliers[$i]["heureFin"] = $heureFin["heure"];
		
		// Traitement de dates (si elles existent) : conversion de la date en bon français
		if(isset($donneesAteliersParticuliers[$i]["dates"]) AND $donneesAteliersParticuliers[$i]["dates"] != "0000-00-00")
		{
			$prochaineDateAtelier = dateHeureInfos($donneesAteliersParticuliers[$i]["dates"]);
			$donneesAteliersParticuliers[$i]["dates"] = $prochaineDateAtelier["date"];
		}
		
		// Récup long et lat
		$gps = explode(",", $donneesAteliersParticuliers[$i]["adresseGpsDuLieu"]);
		$donneesAteliersParticuliers[$i]["long"] = $gps[0];
		$donneesAteliersParticuliers[$i]["lat"] = $gps[1];
		
		$i++;
	};
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>ficheAtelier</title>
    
	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
	<!--  <link href="../css/stylesSmart_jf.css" rel="stylesheet" type="text/css" />-->
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
   
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
        <div class="arrowBack"><a href="listeAteliers.php"><img src="../../img/mobilePictoBack.png"/></a></div> <!--Update Jeudi 10 avril 2014 -->
        <div class="retourListe">Retour aux ateliers</div>
        
        <h1>Atelier <?php echo $donneesAtelier['titre'];?></h1>
        
        <h4>Ouvert à tous</h4>
        
        <div class="imgFicheCreation">
        <img src="../../photosMobiles/<?php echo $donneesAtelier["filenamePhotoMobile"]?>" alt="photo" />
        </div>
        
    
        
        <div class="black bouton" >
            <a href="#" class="toggle">Découvrir <?php echo $donneesAtelier['titre'];?></a>
            <div class="deroule">
                <p class="pFicheCreation">
                	<?php echo $donneesAtelier['texteMobile'];?>
            	</p>
            	
            </div>
		</div>
      	
    <?php    
        // S'il s'agit de l'atelier Nubes, on affiche les infos correspondantes
		if($donneesAtelier["ID"] == 1)
		{
    ?>      
            <!-- Début du toggle principal -->

        <!--<p>&nbsp;</p>-->
         
                <p>&nbsp;</p> 
                <div class="calendrier">
                		<div class="dateHeure"><!--Update Jeudi 10 avril 2014 -->
                            <div class="pictoCalendrier"><img src="../../img/mobilePictoDate.png"></div> <!--Update Jeudi 10 avril 2014 -->
                            <div class="date"><?php echo $donneesAtelier["prochaineDateNubes"];?></div>
                            <div class="heure"><?php echo $donneesAtelier["heureDebut"];?><br/><?php echo $donneesAtelier["heureFin"];?></div>
                         </div>
                            <div class="lieu">Studio Carmagnole</div>
                            <div class="adresse">4 avenue Bataillon Carmagnole<br/>69120 Vaulx en Velin</div>
                        
                        <div data-long="<?php echo $donneesAtelier["long"];?>" 
                        	data-lat="<?php echo $donneesAtelier["lat"];?>"
                            data-idmap="<?php echo "carte".$i;?>"
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
	<?php
		}
		// S'il s'agit de l'atelier TransFORME, on affiche les groupes de travail et les répétitions générales
		elseif($donneesAtelier["ID"] == 2)
		{
	?> 
            <div class="black bouton">
                <a href="#" class="toggle">Groupes de travail</a>
                
                <div class="deroule">
                <!-- ------------------------- -->
                    
                    <div class="separator"></div>
                    <!-- ------------------------- -->
                    <!-- First sous-toggle -->
                    
				<?php
                    for($i=0;$i<4;$i++)
                    {
                ?>
                    <div class="grey bouton2">
                        <a href="#" class="toggle2"><?php echo $donneesAteliersParticuliers[$i]["titre"];?></a>
                        <div class="deroule2">
                        
                        <div class="separator"></div>
                        
                        <!--<p>&nbsp;</p>--> 
                        
                        <?php
							if(isset($donneesAteliersParticuliers[$i]["texteMobile"])) echo "<p>" . $donneesAteliersParticuliers[$i]["texteMobile"] . "</p>";
						?>
						
                        <!-- Début google map first sous-toggle -->
                        <div class="calendrier">
                            <div class="dateHeure"><!--Update Jeudi 10 avril 2014 -->
                            <div class="pictoCalendrier"><img src="../../img/mobilePictoDate.png"></div> <!--Update Jeudi 10 avril 2014 -->
                            <div class="date"><?php 
												if(isset($donneesAteliersParticuliers[$i]['dates']) AND $donneesAteliersParticuliers[$i]['dates'] != "0000-00-00") 
													echo $donneesAteliersParticuliers[$i]['dates'];
												if(isset($donneesAteliersParticuliers[$i]['infos']) AND $donneesAteliersParticuliers[$i]['infos'] != "")
													echo $donneesAteliersParticuliers[$i]['infos'];?></div>
                            <div class="heure"><?php echo $donneesAteliersParticuliers[$i]['heureDebut'];?>
                            				<br/><?php echo $donneesAteliersParticuliers[$i]['heureFin'];?></div>
                        </div>
                        
                        <div class="lieu"><?php echo $donneesAteliersParticuliers[$i]['salle'];?></div>
                        <div class="adresse"><?php echo $donneesAteliersParticuliers[$i]["adresse"] . "<br />" . $donneesAteliersParticuliers[$i]["codePostal"] . " " . $donneesAteliersParticuliers[$i]["ville"];?></div>
                        
                        <div data-long="<?php echo $donneesAteliersParticuliers[$i]["long"];?>" 
                        	data-lat="<?php echo $donneesAteliersParticuliers[$i]["lat"];?>"
                            data-idmap="<?php echo "carte".$i;?>"
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
                            <!--<div id="carte<?php //echo $i;?>"></div>-->
                                
                        </div>
                    </div>  
                    <!-- Fin google map first sous-toggle -->                                                                
                </div>
            </div>
				<?php
                    }
                ?> 
         	
          <!-- Fin du toggle principal -->     
        </div>
    </div>
      
      
        <div class="black bouton" >
            <a href="#" class="toggle">Répétitions générales</a>
            <div class="deroule">
                
                <!--<p>&nbsp;</p>-->
                
                <?php
					if(isset($donneesAteliersParticuliers[5]["texteMobile"])) echo "<p>" . $donneesAteliersParticuliers[5]["texteMobile"] . "</p>";
				?>
                        
                <div class="calendrier">
                <div class="dateHeure"><!--Update Jeudi 10 avril 2014 -->
					<div class="pictoCalendrier"><img src="../../img/mobilePictoDate.png"></div> <!--Update Jeudi 10 avril 2014 -->
                		<div class="date"><?php 
												if(isset($donneesAteliersParticuliers[5]['dates']) AND $donneesAteliersParticuliers[$i]['dates'] != "0000-00-00") 
													echo $donneesAteliersParticuliers[5]['dates'];
												if(isset($donneesAteliersParticuliers[5]['infos']) AND $donneesAteliersParticuliers[$i]['infos'] != "")
													echo $donneesAteliersParticuliers[5]['infos'];?></div>
						<div class="heure"><?php echo $donneesAteliersParticuliers[5]['heureDebut'];?><br/><?php echo $donneesAteliersParticuliers[5]['heureFin'];?></div>
					</div>
					
                    <div class="lieu"><?php echo $donneesAteliersParticuliers[5]['salle'];?></div>
					<div class="adresse"><?php echo $donneesAteliersParticuliers[5]['adresse']. "<br />" . $donneesAteliersParticuliers[5]['codePostal'] . " " . $donneesAtelier['ville'];?></div>
                        
					<div data-long="<?php echo $donneesAteliersParticuliers[5]["long"];?>" 
                        	data-lat="<?php echo $donneesAteliersParticuliers[5]["lat"];?>"
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
		</div>
	</div>
	<?php
    	}
		
		// Sinon on affiche les autres ateliers
		else
		{
    ?>      
            <!-- Début du toggle principal -->

        <!--<p>&nbsp;</p>-->
        
                <p>&nbsp;</p> 
                <div class="calendrier">
                		<div class="dateHeure"><!--Update Jeudi 10 avril 2014 -->
                            <div class="pictoCalendrier"><img src="../../img/mobilePictoDate.png"></div> <!--Update Jeudi 10 avril 2014 -->
                            <div class="date"><?php 
												if(isset($donneesAtelier['dates']) AND $donneesAtelier['dates'] != "0000-00-00") 
													echo $donneesAtelier['dates'];
												if(isset($donneesAtelier['infos']) AND $donneesAtelier['infos'] != "")
													echo $donneesAtelier['infos'];?></div>
                            <div class="heure"><?php echo $donneesAtelier["heureDebut"];?><br/><?php echo $donneesAtelier["heureFin"];?></div>
                         </div>
                            <div class="lieu"><?php echo $donneesAtelier["salle"];?></div>
                            <div class="adresse"><?php echo $donneesAtelier["adresse"] . "<br />" . $donneesAtelier["codePostal"] . " " . $donneesAtelier["ville"];?></div>
                        
                        <div data-long="<?php echo $donneesAtelier["long"];?>" 
                        	data-lat="<?php echo $donneesAtelier["lat"];?>"
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
	<?php
		}
	?> 
                
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
    <script src="../../jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
     <script src="../../jquery/bxSlider.js" type="text/javascript"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="../../jquery/mapsGoogleTools.js" type="text/javascript"></script>
    
</body>
</html>


