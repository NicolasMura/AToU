<?php
  //début de session
  session_start();
  // connexion à la base
  require_once('../Connections/connexionMysql.php');
  // gestion des accents
  $bdd->query("SET NAMES 'utf8'");
  
  // Gestion des constantes 
  require_once("../inc/constantes.inc.php");
    
  // Gestion des langues (champs "statiques" du front-office)
  include("../lang/langTools/lang.inc.php");
  require("../lang/lang.php");
  
  // gestion du fil d'Ariane
  include('../inc/fonctionFilArianne.inc.php');
    
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */

  // Récupération des ID de toutes les créations enregistrées
  $idCreations = array();
  
  $requete = "SELECT ID FROM creations";
  $reponse = $bdd->query($requete);
  while($donnees = $reponse->fetch())
  {
    $idCreations[] = $donnees["ID"];
  }
  
  // Récupération des infos sur les créations
  
  $k=0; // Pour compter le nombre de créations actuelles
  $l=0; // Pour compter le nombre de créations précédentes
  $m=0; // Pour compter le nombre de créations archivées
  foreach($idCreations as $id)
  { 
    //Infos table creations
    $requete = ($lang == "en") ? "SELECT * FROM creations_en WHERE ID = ".$id : "SELECT * FROM creations WHERE ID = ".$id;
    $reponse = $bdd->query($requete);
    while($donnees = $reponse->fetch())
    {
      $donneesPageCreation = $donnees;
    }
    
    // S'il s'agit de la création présente, on enregistre ses infos dans le tableau $donneesPage["creationPresente"]
    if($donneesPageCreation["statut"] == "creationPresente" AND $donneesPageCreation["active"] == 1)
    {
      $donneesPage["creationPresente"] = $donneesPageCreation;
      
      //Infos table photos
      $requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
      $reponse = $bdd->query($requete);
      $j=0;
      while($donnees = $reponse->fetch())
      {
        $donneesPagePhotosCreaPresente[$j] = $donnees;
        $j++;
      }
      $donneesPage["creationPresente"]["photos"] = $donneesPagePhotosCreaPresente;
    }
    
    // S'il s'agit de la création à venir, on enregistre ses infos dans le tableau $donneesPage["creationAvenir"]
    if($donneesPageCreation["statut"] == "creationAvenir" AND $donneesPageCreation["active"] == 1)
    {
      $donneesPage["creationAvenir"] = $donneesPageCreation;
    
      //Infos table photos
      $requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
      $reponse = $bdd->query($requete);
      $j=0;
      while($donnees = $reponse->fetch())
      {
        $donneesPagePhotosCreaAvenir[$j] = $donnees;
        $j++;
      }
      $donneesPage["creationAvenir"]["photos"] = $donneesPagePhotosCreaAvenir;
    }
    
    // S'il s'agit d'une  création actuelle, on enregistre ses infos dans le tableau $donneesPage["creationsActuelles"]
    if($donneesPageCreation["statut"] == "creationActuelle" AND $donneesPageCreation["active"] == 1)
    {
      $donneesPage["creationsActuelles"][$k] = $donneesPageCreation;
      
      //Infos table photos
      $requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
      $reponse = $bdd->query($requete);
      $j=0;
      while($donnees = $reponse->fetch())
      {
        $donneesPagePhotosCreasActuelles[$j] = $donnees;
        $j++;
      }
      $donneesPage["creationsActuelles"][$k]["photos"] = $donneesPagePhotosCreasActuelles;
      unset($donneesPagePhotosCreasActuelles); // Car tableau susceptible d'être créé plusieurs fois
      $k++;
    }
    $nombreCreationsActuelles = $k;
    
    // S'il s'agit d'une  création passée, on enregistre ses infos dans le tableau $donneesPage["creationsPrecedentes"]
    if($donneesPageCreation["statut"] == "creationPrecedente" AND $donneesPageCreation["active"] == 1)
    {
      $donneesPage["creationsPrecedentes"][$l] = $donneesPageCreation;
      
      //Infos table photos
      $requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
      $reponse = $bdd->query($requete);
      $j=0;
      while($donnees = $reponse->fetch())
      {
        $donneesPagePhotosCreaPrecedentes[$j] = $donnees;
        $j++;
      }
      $donneesPage["creationsPrecedentes"][$l]["photos"] = $donneesPagePhotosCreaPrecedentes;
      unset($donneesPagePhotosCreaPrecedentes); // Car tableau susceptible d'être créé plusieurs fois
      $l++;
    }
    $nombreCreationsPrecedentes = $l;
    
    // S'il s'agit d'une  création archivée, on enregistre ses infos dans le tableau $donneesPage["creationsArchivees"]
    if($donneesPageCreation["statut"] == "creationArchivee" AND $donneesPageCreation["active"] == 1) // Statut à créer en bdd !
    {
      $donneesPage["creationsArchivees"][$m] = $donneesPageCreation;
      
      //Infos table photos
      $requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
      $reponse = $bdd->query($requete);
      $j=0;
      while($donnees = $reponse->fetch())
      {
        $donneesPagePhotosCreasArchivees[$j] = $donnees;
        $j++;
      }
      $donneesPage["creationsArchivees"][$m]["photos"] = $donneesPagePhotosCreasArchivees;
      unset($donneesPagePhotosCreasArchivees); // Car tableau susceptible d'être créé plusieurs fois
      $m++;
    }
    $nombreCreationsArchivees = $m;
  }
  $reponse->closeCursor();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Liste des créations</title>
    
    <!-- reset Eric Meyer -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/reset.css" />
    
    <!-- feuilles de style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_cv.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/stylesScreen_jf.css" />
    
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

    <!-- BXslider -->
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/css/bxSliderSite.css" type="text/css" media="screen"/>
        
    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- Froogaloop js library for calling Vimeo's API -->
    <script type="text/javascript" src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="listeCreations">

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
                    define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["LISTE_CREATIONS_FIL_ARIANE"][$lang]), $lang);?></p>
            </div>
      <!--_________________________________-->
            
            <h1><?php echo $string_lang["LISTE_CREATIONS_H1"][$lang];?></h1>
        
             <!--_____Zone 1_____-->  
            
            <div id="zone1">
        
                <div class="imgTacheBlanche">
                        <img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png" alt="toto"/>
                </div>
            
                <!--_____Encadré photo 1_____-->
    
                <div class="cadre1">
                    
                  <h3 id="nomCrea" class="black"><?php echo $donneesPage["creationPresente"]["titre"];?></h3>
                
                    <!--_____Cartouche_____-->
                    
                    <div class="cartouche">
                            <h4><?php echo $donneesPage["creationPresente"]["type"]." ".$donneesPage["creationPresente"]["anneeCreation"];?></h4>
                            <time class="time"><?php echo $donneesPage["creationPresente"]["duree"];?></time>
                            <p><?php echo $donneesPage["creationPresente"]["accroche"];?></p>
                     
                            <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationPresente"]["urlRewrite"]."-".$donneesPage["creationPresente"]["ID"];?>"><div class="lien">
                <?php echo $string_lang["LISTE_CREATIONS_INFO"][$lang];?></div></a>
                    </div>
                               
                    <!--_____Fin du cartouche_____-->
                
                    <div class="pictoPlayVideo">
                          <img src="<?php echo CHEMIN_SITE;?>/img/communPictoVideo.png" alt="video" width="70" height="70" />
                    </div>
                     
                    <!--______Début cadre video_____-->
                    
                    <div class="black">
                        <iframe id="player1" 
                            src="http://player.vimeo.com/video/<?php echo $donneesPage["creationPresente"]["urlVideo"];?>?title=0&amp;player_id=player1&amp;byline=0&amp;portrait=0&amp;color=ffffff" 
                            width="780" height="439" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                        </iframe>
                    </div>
                    
                    <!--_____Fin cadre vidéo_____-->
                
                <!--_____Début des rectangles_____-->
                
                <div class="black big petitBlocContour"></div>
                <div class="black big grandBlocContour"></div>
                <div class="black big petitBlocContour"></div>
                
                <!--_____Fin des rectangles______-->
                                        
                </div>
         
                <!--_____Fin du cadre 01_____-->      
                        
            </div>
            
          <!--_____Fin Zone 1_____-->

      <br class="annule"/>    

      <!--_____Début de la zone 2_____-->
    
        <div class="zone2">
      
                <!--_____Début de la cadre 2_____-->
            
                <div class="cadre2">
        
        <?php
                    // S'il y a au moins 1 création actuelle avec un statut actif (= avec au moins une photo), on affiche le slider
          if(isset($donneesPage["creationsActuelles"]) AND count($donneesPage["creationsActuelles"]) > 0 
            AND (isset($donneesPage["creationsActuelles"][0]) AND $donneesPage["creationsActuelles"][0]["active"] == 1))
                    {
        ?>
                    <h2><?php echo $string_lang["LISTE_CREATIONS_CREAS_ACTUELLES"][$lang];?></h2>
          
                <!--_____Début du slider 1_____-->
                
                    <div class="sliderContainer">
             
                            <ul class="bxSlider">
                                <?php
                                    for($i=0; $i<$nombreCreationsActuelles; $i++)
                                    {
                    if($donneesPage["creationsActuelles"][$i]["active"] == 1)
                    {
                                ?>
                                <li>
                                    <div class="black">   
                                        <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsActuelles"][$i]["photos"][0]["filename"];?>" 
                                          alt="<?php echo $donneesPage["creationsActuelles"][$i]["photos"][0]["nom"];?>" width="296" height="196"/>
                                        <h3><?php echo $donneesPage["creationsActuelles"][$i]["titre"];?></h3>
                                    </div>       
                                    
                                    <div class="cartouche">     
                                        <h4><?php echo $donneesPage["creationsActuelles"][$i]["type"] . " " . $donneesPage["creationsActuelles"][$i]["anneeCreation"];?></h4>
                                        <time class="time"><?php echo $donneesPage["creationsActuelles"][$i]["duree"];?></time>
                                        <p><?php echo $donneesPage["creationsActuelles"][$i]["accroche"];?></p>
                                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationsActuelles"][$i]["urlRewrite"]."-".$donneesPage["creationsActuelles"][$i]["ID"];?>"><div class="lien">
                                          <?php echo $string_lang["LISTE_CREATIONS_INFO"][$lang];?></div></a>
                                    </div>
                                </li>
                                <?php
                    }
                  }
                                ?>
                             </ul>
                            
                        </div>                       
                              
                    <!--_____Fin du slider 1_____-->
        <?php
          }
        ?>

        </div>
                
               <!--_____Fin du cadre 2_____-->
                    
      </div>  
          
          <!--_____Fin de la zone 2_____-->
             
      </section>
        
        <!--_____Fin de la section_____-->
          
  </div>
     
    <!--_____Fin du fondNoir_____-->
     
     
    <!--_____Début du fond blanc_____-->
     
    <?php
    // S'il y a 1 création à venir avec un statut actif (= avec au moins une photo) et un résumé, on l'affiche
    if(isset($donneesPage["creationAvenir"]) AND $donneesPage["creationAvenir"]["active"] == 1)
    {
  ?> 
     
    <div class="fondBlanc">          
    
      <section>
                               
         <div id="zone3">
             
              <div class="imgTacheNoir">
              <img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheNoir.png" alt="toto"/>
            </div>
            
                <div class="cadre1">
                  
                    <h2><?php echo $string_lang["LISTE_CREATIONS_CREAS_EN_COURS"][$lang];?></h2>
                  
                    <h3 class="black"><?php echo $donneesPage["creationAvenir"]["titre"];?></h3>
                    
                     <!--_____Cartouche_____-->
            
                  <div class="cartouche"> 
                        <h4><?php echo $donneesPage["creationAvenir"]["type"]." ".$donneesPage["creationAvenir"]["anneeCreation"];?></h4>
                        <time class="time"><?php echo $donneesPage["creationAvenir"]["duree"];?></time>
                        <p><?php echo $donneesPage["creationAvenir"]["accroche"];?></p>
                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationAvenir"]["urlRewrite"]."-".$donneesPage["creationAvenir"]["ID"];?>"><div class="lien">
                            <?php echo $string_lang["LISTE_CREATIONS_INFO"][$lang];?></div></a>
                    </div>
              
        <!--_____Fin du cartouche_____-->
                            
                  <div class="bordNoir">
                    <img src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPage["creationAvenir"]["photos"][0]["filename"];?>" 
                      alt="<?php echo $donneesPage["creationAvenir"]["photos"][0]["nom"];?>" width="780" height="440" />
                     
                     
                     </div>
                     
                    <div class="white big petitBlocContour"></div>
                    <div class="white big grandBlocContour"></div>
                    <div class="white big petitBlocContour"></div>
                    <div class="white big grandBlocContour"></div>
                    <div class="white big petitBlocContour"></div>
                    
                     <br class="annule" />
                                         
                 </div>           
                
                <!--_____Fin du cadre_____-->
                    
           </div> 
            
            <!--_____Fin de la zone_____--> 
            
        </section> 
         
         <!---_____Fin de la section_____-->
               
  </div>
    
    <?php
    }
  ?>

     <!--_____Fin du fond blanc_____-->
     
     
     <!--_____Début fond noir_____-->
     
     <div class="fondNoir">
     
      <section>
     
        <div id="zone2">
                      
                <div class="cadre2">
                  
                 <?php
                    // S'il y a au moins 1 création précédente avec un statut actif (= avec au moins une photo), on affiche le slider
          if(isset($donneesPage["creationsPrecedentes"]) AND count($donneesPage["creationsPrecedentes"]) > 0 
            AND (isset($donneesPage["creationsPrecedentes"][0]) AND $donneesPage["creationsPrecedentes"][0]["active"] == 1))
                    {
        ?>
                    <h2><?php echo $string_lang["LISTE_CREATIONS_CREAS_PRECEDENTES"][$lang];?></h2>
          
                <!--_____Début du slider 2_____-->
                
                    <div class="sliderContainer">
             
                            <ul class="bxSlider">
                                <?php
                                    for($i=0; $i<$nombreCreationsPrecedentes; $i++)
                                    {
                    if($donneesPage["creationsPrecedentes"][$i]["active"] == 1)
                    {
                                ?>
                                <li>
                                    <div class="black">   
                                        <img class="photoSlider" src="<?php echo CHEMIN_SITE;?>/photosVignettes/<?php echo $donneesPage["creationsPrecedentes"][$i]["photos"][0]["filename"];?>" 
                                          alt="<?php echo $donneesPage["creationsPrecedentes"][$i]["photos"][0]["nom"];?>" width="296" height="196" />
                                        <h3><?php echo $donneesPage["creationsPrecedentes"][$i]["titre"];?></h3>
                                    </div>       
                                    
                                    <div class="cartouche">     
                                        <h4><?php echo $donneesPage["creationsPrecedentes"][$i]["type"] . " " . $donneesPage["creationsPrecedentes"][$i]["anneeCreation"];?></h4>
                                        <time class="time"><?php echo $donneesPage["creationsPrecedentes"][$i]["duree"];?></time>
                                        <p><?php echo $donneesPage["creationsPrecedentes"][$i]["accroche"];?></p>
                                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationsPrecedentes"][$i]["urlRewrite"]."-".$donneesPage["creationsPrecedentes"][$i]["ID"];?>"><div class="lien">
                                          <?php echo $string_lang["LISTE_CREATIONS_INFO"][$lang];?></div></a>
                                    </div>
                                </li>
                                <?php
                    }
                  }
                                ?>
                             </ul>
                            
                        </div>                       
                              
                    <!--_____Fin du slider 2_____-->
        <?php
          }
        ?>
                
                <!--_____Fin du cadre_____-->
                
            </div>
            
            <!--_____Fin de la zone_____-->
            
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

    <!--Player Vimeo-->
  <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/vimeoPlayer.js"></script>
    
    <!--Pour cacher le titre et le cartouche sur le Player Vimeo lors de la lecture-->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/hideVideoElements.js"></script>
    
    <!--Bouton super top-->
  <script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>
    
    <!-- Add BxSlider -->
  <script src="<?php echo CHEMIN_SITE;?>/jquery/bxSlider2.js"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
    <script src="<?php echo CHEMIN_SITE;?>/jquery/jquery.bxslider/plugins/jquery.easing.1.3.js"></script>
            
</body>
</html>