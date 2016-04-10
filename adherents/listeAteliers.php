<?php
	// début de session
	session_start();
	// connexion à la base
	require_once('../Connections/connexionMysql.php');
	// Protection des pages adhérents
	include('../admin/inc/protectionAdherent.inc.php');
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

	/* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
	
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
	}
	else
	{
		$prochaineDateNubes = "";
	}
	
	// Récupération des infos en base de données sur les créations archivées pour les pages adhérents
	include("../inc/infosCreasArchivees.php");
	
	// Facebook
	$titleFacebook = "Ateliers AToU";
	$urlPageFacebook ="http://www.atou.fr/adherents/listeAteliers.php";
	$urlImageFacebook = "http://www.atou.fr/photosVignettes/accueilAdherentsAteliers.jpg";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Ateliers</title>
        
	<!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
	<meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesScreen_jf.css" />
    
    <!-- font Alegreya -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' />
    
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

    <!-- Add jQuery library -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="listeAteliers">

	<div id="superTop"></div> <!--Bouton, top-->
    <!--___________Menu header___________-->
    
    <div class="bgheader">
		<div id="entete">
			<header>
				<?php
		  			include("../inc/menuFront.inc.php");
    			?>
			</header>  
		</div> 
    </div>
    
    <!--___________Fin Menu header___________-->
    
 	<div class="fondNoir">
    
		<section>
    
		<a href="#superTop" id="top"></a><!--Bouton, top-->
            
        <!--___________ Fil d'Arianne ___________-->
        <div class="filaire">
            <?php
                define('Compagnie_ATou', 'Accueil &nbsp;', true);
            ?>
            <p class="filAriane"><?php get_fil_ariane(array('accueilAdherents.php' => '&nbsp; Espace adhérents &nbsp;', 'final' => '&nbsp; ateliers'), $lang);?></p>
        </div>
        <!--_________________________________-->
        
        <h1>Les ateliers</h1>
	
		 <!--_____Zone 1_____-->	
        
        <div id="zone1">
        
        	<!--_____Cadre 1_____-->	
            
            <div class="cadre1">      	
        
                <div class="white big">
                
                 <h5 class="titreH5">Autour de Transforme 2014</h5>	
                 
                  <img class="imgDroite" src="../photosVignettes/listeAteliersTransform.jpg" alt="image 1" />	
                 
                 <div class="largeurFixe">
                                 
                <p>En 2013, la compagnie de danse AToU décide de proposer la création d'un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois, AToU accompagne ce groupe hétérogène, au travers d'ateliers hebdomadaires, afin d'arriver jusqu'à l'aboutissement du processus : la scène.</p>
                
                </div>
                
                <p>« TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : celui de croire que l'autre est avant tout une source de richesse et de partage plutôt qu'une menace pour soi.</p>
                
              
                
                <p><b>À noter dans vos agendas</b>
				
                <br><br>
                Vendredi 27 juin de 19h30 à 22h00<br>
                Présentation de TransForme 2014 au festival Festiv’Amphis<br>
                Cinéma Les Amphis<br>
                Rue Pierre Cot<br>
                69120 Vaulx-en-Velin<br>
                <br><br>
                
                <b>Spectacle gratuit sans reservation</b>
                <br><br>               
                Le samedi 21 juin à 19h30-21h<br>
                Théâtre Aux Echappées Belles<br>
                65/73 rue du Bourbonnais
                69009 Lyon<br><br>
                
                En vente uniquement sur place, tarif : 2 euros

				</p>
            
                <a href="<?php echo CHEMIN_SITE.'/fr/actions-artistiques/transforme-4';?>"><div class="lien">En savoir plus</div></a>
                
                <br class="annule"/>           
                           
                <h5>Ateliers hebdomadaires</h5> 
             
                <table width="620px">

                 <tr>
                    <td>Lundi</td>
                    <td>réservé aux participants du centre Witkowska</td>
                </tr>
                
                <tr>
                    <td>17h30</td>
                    <td>Salle de réunion du Centre Witkowska</td>
                </tr>
                    
                <tr>    
                    <td>18h45</td>
                    <td>10, rue Simon Jallade / 69110 Sainte Foy-lès-Lyon</td>
                </tr>
                                        
            	</table>
                
                <table width="620px">

                 <tr>
                    <td>Jeudi</td>
                    <td>réservé aux participants du centre Line Thévenin</td>
                </tr>
                
                <tr>
                    <td>18h15</td>
                    <td>Maison communale des Bruyères</td>
                </tr>
                    
                <tr>    
                    <td>19h30</td>
                    <td>55, boulevard des Provinces / 69110 Sainte Foy-lès-Lyon</td>
                </tr>
                                        
            	</table> 
                
                <table width="620px">

                 <tr>
                    <td>Jeudi</td>
                    <td>réservé aux participants du Sainte-Foy-lès-Lyon</td>
                </tr>
                
                <tr>
                    <td>19h30</td>
                    <td>Maison communale des Bruyères</td>
                </tr>
                    
                <tr>    
                    <td>21h15</td>
                    <td>55, bd des Provinces / 69110 Ste Foy-lès-Lyon</td>
                </tr>
                                        
            	</table>
                
                <table width="620px">

                 <tr>
                    <td>Vendredi</td>
                    <td>réservé aux participants de Vaux-en-Velin</td>
                </tr>
                
                <tr>
                    <td>18h15</td>
                    <td>Centre de danse</td>
                </tr>
                    
                <tr>    
                    <td>20h00</td>
                    <td>8 Avenue Bataillon Carmagnole-Liberté / 69120 Vaux-en-Velin</td>
                </tr>
                                        
            	</table>
                
                <h5>Répétitions communes</h5> 
                
                <table width="620px">

                 <tr>
                    <td>22 mai</td>
                    <td>réservé aux participants du centre Witkowska</td>
                </tr>
                
                <tr>
                    <td>18h45</td>
                    <td>RAMDAM</td>
                </tr>
                    
                <tr>    
                    <td>20h45</td>
                    <td>16 chemin des Santons / 69 110 Sainte Foy-lès-Lyon</td>
                </tr>
                                        
            	</table>
                
                <table width="620px">

                 <tr>
                    <td>22 mai</td>
                    <td>réservé aux participants du centre Thévenin</td>
                </tr>
                
                <tr>
                    <td>18h45</td>
                    <td>RAMDAM</td>
                </tr>
                    
                <tr>    
                    <td>20h45</td>
                    <td>16 chemin des Santons / 69 110 Sainte Foy-lès-Lyon</td>
                </tr>
                                        
            	</table>
                <table width="620px">

                 <tr>
                    <td>22 mai</td>
                    <td>réservé aux habitants de Vaux-en-Velin</td>
                </tr>
                
                <tr>
                    <td>18h45</td>
                    <td>RAMDAM</td>
                </tr>
                    
                <tr>    
                    <td>20h45</td>
                    <td>16 chemin des Santons / 69 110 Sainte Foy-lès-Lyon</td>
                </tr>
                                        
            	</table>
                
                <h5>Répétitions générale</h5>
                
                <table width="620px">

                 <tr>
                    <td>24 mai</td>
                    <td>pour tous les ateliers</td>
                </tr>
                
                <tr>
                    <td>10h00</td>
                    <td>Gynmase Blondin</td>
                </tr>
                    
                <tr>    
                    <td>18h00</td>
                    <td>1 Rue Maximilien de Robespierre / 69120 Vaulx-en-Velin</td>
                </tr>
                                        
            	</table>
                            
                <table width="620px">

                 <tr>
                    <td>21 juin</td>
                    <td>pour tous les ateliers</td>
                </tr>
                
                <tr>
                    <td>10h00</td>
                    <td>Théâtre Aux Echappées Belles</td>
                </tr>
                    
                <tr>    
                    <td>17h30</td>
                    <td width="494px">65/73 rue du Bourbonnais / 69009 Lyon                             </td>
                </tr>
                                        
            	</table>
                                         
            	</div>
           		
                <br class="annule"/>	
           
            	<a class="partage" href="" title="PARTAGER SUR" 
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
                    <div class="facebook">Partagez sur Facebook</div>
                </a>
            
            </div>
            
             
            <!--_____Fin cadre 1_____-->
            
             
            <!--_____Début cadre 2_____-->	
            
            <div class="cadre2">
                        	
                <!--_____Premier bloc_____-->
                
                <div class= "blocDate">
    	
					<h6>Tous nos ateliers ont lieu hors vacances scolaires</h6>
                    <h6 class="titreRappelAtelier">du 7 nov. 2013 au 1er juillet 2014</h6>
                    
                </div>
                
                <div class= "blocInformation">
    	
					<h5>Information et inscription</h5>
                    
                    <div class="trait"></div>
                   
                    <p>Pour toute information complémentaire et/ou inscription à l’un de nos ateliers, vous pouvez nous contacter.</p>
                    <p class="contactTel">Par téléphone : 09.52.42.08.95</p>
                    <p><a href="mailto:administration@atou.fr?Subject=Demande%20d'information" target="_top" class="contactTel">Par mail : administration@atou.fr</a></p>
                    
                </div>
                
               <!--_____Fin du premier bloc_____-->
              
                              
               
               <!--_____Second bloc_____--> 
                
               <!--_____Fin du second bloc_____--> 
               
               
               
               <!--_____Premier cadre_____-->
               
               <div class="blocRappel">
               
               		<img src="../photosVignettes/listeAteliersCarnetdebord1.jpg" alt="Carnet de bord" />
                    <h3>Carnet de bord</h3>
            		<a href="discussion.php"><div id="lienRustine" class="lien">Découvrir le carnet du bord</div></a>
                    
               </div>     
               
                <div class="blocRappel">
               
               		<img src="../photosVignettes/listeAteliersGalerie1.jpg" alt="Galerie photos" />
                    <h3>Explorer la galerie photos</h3>
            		<a href="galeriePhotos.php"><div id="lienRustine" class="lien">Découvrir la galerie photos</div></a>
                    
               </div>     
               
                <div class="blocRappel">
               
               		<img src="../photosVignettes/listeAteliersArchives1.jpg" alt="Archives" />
                    <h3>Créations archivées</h3>
            		<?php
						if($nombreCreationsArchivees > 0)
						{
					?>
					<a href="../danse-contemporaine-lyon/ficheCreation.php?ID=<?php echo $donneesPage["creationsArchivees"][0]["ID"];?>">
						<div id="lienRustine" class="lien"><?php echo $donneesPage["creationsArchivees"][0]["titre"];?></div>
					</a>
					<?php
						}
						else echo "<h3>A venir...</h3>";
						
						// Affichage de 5 autres créations archivées max, sinon pb au niveau de la mise en page
						if($nombreCreationsArchivees > 5) $nombreCreationsArchivees = 5;
						for($i=1; $i<$nombreCreationsArchivees; $i++)
						{
					?>
					<a href="../danse-contemporaine-lyon/ficheCreation.php?ID=<?php echo $donneesPage["creationsArchivees"][$i]["ID"];?>">
						<div id="lienRustine" class="lien"><?php echo $donneesPage["creationsArchivees"][$i]["titre"];?></div>
					</a>
					<?php
						}
					?>      
                    
               </div>     
                    
               <!--_____Fin du premier cadre_____-->
               
               
               
                  
             
        	</div>    
            
            <!--_____Fin du cadre 2_____-->
            
        </div>
        
        <!--_____Fin Zone 1_____-->
        
        
        <!--_____Zone 1_____-->	
        
        <div id="zone2">
        
        	<!--_____Cadre 1_____-->	
            
            <div class="cadre1">      	
        
                 <div class="white big">
                
                <h5 class="titreH5">Autour de Nubes</h3>		
                
                <div class="largeurFixe">
                
                <p>« AToU vous invite à participer à une session de danse-improvisation une fois par mois, au studio Carmagnole. Cette session s’adresse à tous ceux qui, par l’expression du corps, veulent apprendre sur eux-mêmes et sur les autres, que vous soyez professionnels, amateurs ou sans expérience de la danse. Ces sessions seront  guidées par Anan Atoyama, la chorégraphe d’AToU. »</p>
                
                </div>
                
                <img class="imgDroite" src="../photosVignettes/listeAteliersNubes.jpg" alt="image 1" />
                
                <br class="annule"/> 
                
                <a href="<?php echo CHEMIN_SITE.'/fr/actions-artistiques/nubes-8';?>"><div class="lien">En savoir plus</div></a>
                
                <br class="annule"/>
				<?php
					// S'il existe une prochaine date Nubes en bdd, on affiche le lien pour y participer
					if($prochaineDateNubes != "")
					{
				?>           
                <a href="inscriptionNubesAdh.php"><div class="lien">Participer au prochain atelier Nubes</div></a>
                <?php
					}
				?>
                <br class="annule"/> 
                
                <br>          
                           
                <h5>Ateliers hebdomadaires</h5> 
             
                <table width="620px">

                 <tr>
                    <td>Samedi</td>
                    <td colspan="4">Ouvert à tous – Niveau débutant</td>
                </tr>
                
                <tr>
                    <td>10h00</td>
                    <td colspan="4">Studio Carmagnole</td>
                </tr>
                    
                <tr>    
                    <td>13h00</td>
                    <td colspan="4">8 avenue Bataillon Carmagnole / 69120 Vaulx-en-Velin</td>
                </tr>
                
                <tr> 
                	<td></td>   
                    <td>17 mai 2014</td>
                    <td>14 juin 2014</td>
                  
                </tr>
                                      
            	</table>
                 
               </div>
           		
                <br class="annule"/>	
           
            	<a class="partage" href="" title="PARTAGER SUR" 
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
                    <div class="facebook">Partagez sur Facebook</div>
                </a>
            
            </div>
           
             
            <!--_____Fin cadre 1_____-->
            
              
            
        </div>
        
        <!--_____Fin Zone 1_____-->

		<br class="annule"/>
	
    </section>
        
      <!--_____Fin de la section_____-->
          
   </div>
    <!--_____Fin du fond noir_____-->



     
	<!--___________Menu footer___________-->

 
	<div id="bgfooter">
    	<div id="pied">
    		<footer>
				<?php
				  include("../inc/footerFront.inc.php");
    			?>
			</footer>
		</div>
    </div>

	<!--___________Fin Menu footer___________-->
    
    <!--Bouton super top-->
	<script src="../jquery/topButton.js" type="text/javascript"></script>
    
</body>
</html>