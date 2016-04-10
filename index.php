<?php
  //début de session
  session_start();
  // connexion à la base
  require_once('Connections/connexionMysql.php');
  // gestion des accents
  $bdd->query("SET NAMES 'utf8'");
  
  // Gestion des constantes 
  require_once("inc/constantes.inc.php");
  
  // Gestion des langues (champs "statiques" du front-office)
  include("lang/langTools/lang.inc.php");
  require("lang/lang.php");
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */

  // Actualité(s)
    $requeteActus = ($lang == "en") ? "SELECT titre, texte FROM actualites_en WHERE ID != 3" : "SELECT titre, texte FROM actualites WHERE ID != 3";
  $reponseActus = $bdd->query($requeteActus);
  $nbreActus = $reponseActus->rowCount();
  $i=0;
  while($donnees = $reponseActus->fetch())
  {
    $donneesPageActus[$i] = $donnees;
    $i++;
  }
  
  // Récupération du contenu des tables compagnie et compagnie_en
    $requete = $lang == "en" ? "SELECT * FROM compagnie_en" : "SELECT * FROM compagnie";
    $reponse = $bdd->query($requete);
    $donneesCompagnie = $reponse->fetch();

    // Création présente
    $requeteCrea = $lang == "en" ? "SELECT MIN(ID), titre, accroche, urlRewrite FROM creations_en WHERE statut = 'creationPresente' AND active = 1" : "SELECT MIN(ID), titre, accroche, urlRewrite FROM creations WHERE statut = 'creationPresente' AND active = 1";
  $reponseCrea = $bdd->query($requeteCrea);
  if($reponseCrea)
  {
    $donneesPageCreation = $reponseCrea->fetch();
    $reponseCrea->closeCursor();
    
    //Infos table photos
    $requeteCreaPhoto = "SELECT MIN(ID), nom, filename FROM photos WHERE creationsID = ".$donneesPageCreation["MIN(ID)"];
    $reponseCreaPhoto = $bdd->query($requeteCreaPhoto);
    if($reponseCreaPhoto)
    {
      $donneesPageCreation["photos"] = $reponseCreaPhoto->fetch();
      $reponseCreaPhoto->closeCursor();
    }
  }
  
  // Action présente
  $requeteAction = "SELECT MIN(ID), titre, accroche FROM actions_culturelles WHERE statut = 'actionPresente' AND active = 1";
  $reponseAction = $bdd->query($requeteAction);
  if($reponseAction)
  {
    $donneesPageAction = $reponseAction->fetch();
    $reponseAction->closeCursor();
    
    //Infos table photos
    $requeteActionPhoto = "SELECT MIN(ID), nom, filename FROM photos WHERE actions_culturellesID = ".$donneesPageAction["MIN(ID)"];
    $reponseActionPhoto = $bdd->query($requeteActionPhoto);
    if($reponseActionPhoto)
    {
      $donneesPageAction["photos"] = $reponseActionPhoto->fetch();
      $reponseActionPhoto->closeCursor();
    }
  }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AToU, compagnie de danse</title>
    
    <!-- reset Eric Meyer -->
    <!--<link rel="stylesheet" type="text/css" href="http://meyerweb.com/eric/tools/css/reset/reset.css">-->
    
    <!-- Feuille de style reset perso ? -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/reset.css">
    <!-- Notre feuille de style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/styleHome.css">
    
    <!-- font Alegreya -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' />
    
    <!-- carousel actualités -->
    <link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/css/tinycarousel.css" type="text/css" media="screen"/>
    
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
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/js/jquery.stellar.min.js"></script>
    <!-- Add tinycarousel JS -->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/jquery.tinycarousel.js"></script>
       
    <!-- Modernizr -->      
    <script src="<?php echo CHEMIN_SITE;?>/js/modernizr.custom.60851.js"></script>
    
    <!-- initialisation du plug in stellar -->
    <script>
        jQuery(document).ready(function ($) {
            //$(window).stellar();
            if (!Modernizr.touch ) { 
                $(window).stellar();                    
                }
        });
        /*$.stellar({
              horizontalOffset: 40,
              verticalOffset: 150
            });*/
    </script>
    
    <style>
    #nm_AToU{
      text-transform:inherit;
      }
    #menuHeader ul li a, #ensemble #adherents, #menuFooter ul li a{
      text-decoration:none;
      }
    #menuHeader ul li a:hover{
      text-decoration:none;
      color:#81358A;
      }
  </style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("inc/livereload.php");
    ?>
</head>

<body>
    <div id="superTop"></div> <!--Bouton, top-->
    <!--___________Menu header___________-->
    
        <div class="bgheader">
            <div id="entete">
                <header>
                    <?php
                      include("inc/menuFront.inc.php");
                    ?>
                </header>  
            </div> 
        </div> 
        
    <!--___________Fin Menu header___________-->
  <a href="#superTop" id="top"></a><!--Bouton, top-->
    
    <!--Slide 1-->
    <div class="slide" id="slide1" data-stellar-background-ratio="1">
       
        <div class="cadre" data-stellar-background-ratio="0.84" >
        
          <img src="<?php echo CHEMIN_SITE;?>/img/trace2Home.png" id="trace1" alt="" height="833px" width="89px" data-stellar-ratio="1" >
     
            <div id="cadre_2" data-stellar-ratio="0.90">
              
                <div class="cartouche">
                  <p><?php echo $donneesCompagnie["descriptionCompagnie"]?></p>
                </div>
                
                <a href="<?php echo CHEMIN_SITE.'/'.$lang;?>/compagnie"><div class="lien"><?php echo $string_lang["HP_DECOUVRIR_CIE"][$lang];?></div></a>
            
            </div>
                     
                     
            <div id="cadre_3" data-stellar-ratio="0.75"  data-stellar-horizontal-offset="0">
                        
                      <div class="cartouche">
                          
                          <div id="slider7">
                            
                              <div class="viewport">
                            
                                  <ul class="overview">
                                    <?php
                    for($i=0;$i<$nbreActus;$i++)
                    {
                  ?>
                                        <li>                             
                                            <h2><?php echo $donneesPageActus[$i]["titre"];?></h2>
                                            <p><?php echo $donneesPageActus[$i]["texte"];?></p>
                                        </li>
                  <?php
                    }
                  ?>    
                                   </ul>
                                 
                              </div>                       
                        
                        </div>
                                               
                        </div>
                    
                    </div>
                   
                    <div class="black" id="big">
                        <h1 id="nm_AToU"> AToU </h1>
                    </div>
                    
                    <div class="black" id="firstBlock">
                    </div>
                    <div class="black" id="secondBlock">
                    </div>
                    <div class="black" id="thirdBlock">
                    </div>
                    <div class="black" id="fourthBlock">
                    </div>
                    <div class="black" id="fifthBlock">
                    </div>
                    <div class="black" id="sixthBlock">
                    </div>
                    
        </div>
        
        <div class="centragePhoto" data-stellar-ratio="0.5" data-stellar-vertical-offset="0">
          <img src="<?php echo CHEMIN_SITE;?>/img/homeFond03.jpg" id="bigPhoto" alt="" height="681px"  width="1024px"  />
        </div>
         
    </div>
    <!--End Slide 1-->

  <!--Slide 2-->
    <div class="slide" id="slide2" data-stellar-background-ratio="1">
    <img src="<?php echo CHEMIN_SITE;?>/img/trace1Home.png" id="trace2" alt="" height="686px" width="26px" data-stellar-ratio="0.7" />
        <div class="cadre">
                       <div id="cadre_4" data-stellar-ratio="0.90" data-stellar-vertical-offset="150">
                                    <div class="cartouche">
                                        <p><?php echo $donneesPageCreation["accroche"];?></p>
                                    </div>
                                    <a href="<?php echo CHEMIN_SITE.'/'.$lang;?>/creations/<?php echo $donneesPageCreation["urlRewrite"]."-".$donneesPageCreation["MIN(ID)"];?>">
                                      <div class="lien"><?php echo $string_lang["HP_INFO_CREA"][$lang];?></div>
                                    </a>
                       </div>
                        <div class="black" id="title"  data-stellar-ratio="0.95"  data-stellar-vertical-offset="150">
                        <h1><?php echo $donneesPageCreation["titre"];?></h1>
                  </div>
            <div class="black" id="big2">
            <img src="<?php echo CHEMIN_SITE;?>/photosVignettesLarges/<?php echo $donneesPageCreation["photos"]["filename"];?>" id="shinmu" 
              alt="photosVignettesLarges/<?php echo $donneesPageCreation["photos"]["nom"];?>" height="411" width="607"/>
            </div>
            <div id="cadredeco2"> 
                <div class="black" id="firstBlock2">
                </div>
                <div class="black" id="secondBlock2">
                </div>
                <div class="black" id="thirdBlock2">
                </div>
                <div class="black" id="fourthBlock2">
                </div>
                <div class="black" id="fifthBlock2" >
                </div>
                <div class="black" id="sixthBlock2">
                </div>
             </div>   
        </div>
    </div>
    <!--End Slide 2-->

 <!--Slide 3-->
    <div class="slide" id="slide3" data-stellar-background-ratio="0.5">
      
         <div class="cadre">
         
         <div id="cadre_5" data-stellar-ratio="0.90" data-stellar-vertical-offset="150">
                                    <div class="cartouche">
                                        <p><?php echo $donneesCompagnie["descriptionActions"]?></p>
                                    </div>
                                    <a href="<?php echo CHEMIN_SITE.'/'.$lang;?>/actions-artistiques"><div class="lien"><?php echo $string_lang["HP_INFO_ACTIONS"][$lang];?></div></a>
                       </div>
         <div class="black" id="title2"  data-stellar-ratio="0.95">
                        <h1><?php echo $string_lang["HP_TITRE_ACTIONS"][$lang];?></h1>
         </div>
            <div class="black" id="big3">
            <img src="<?php echo CHEMIN_SITE;?>/img/actionsCultHome.jpg" id="action_cult" alt="" height="390px" width="616px"/>
            </div>
            <div class="black" id="firstBlock3">
            </div>
            <div class="black" id="secondBlock3">
            </div>
            <div class="black" id="thirdBlock3">
            </div>
            <div class="black" id="fourthBlock3">
            </div>
            <div class="black" id="fifthBlock3" >
            </div>
            <div class="black" id="sixthBlock3">
            </div>
        </div>
    </div>
    <!--End Slide 3-->
    
      <script>
    $(document).ready(function()
    {
      $("#slider7").tinycarousel({ interval: true, intervalTime: 6000 });
    
      var slider7 = $("#slider7").data("plugin_tinycarousel");
    
      // The move method you can use to make a
      // anchor to a certain slide.
      //
      $('#gotoslide4').click(function()
      {
        slider7.move(4);
    
        return false;
      });
    
      // The start method starts the interval.
      //
      $('#startslider').click(function()
      {
        slider7.start();
    
        return false;
      });
    
      // The stop method stops the interval.
      //
      $('#stopslider').click(function()
      {
        slider7.stop();
    
        return false;
      });
    });
  </script>
    
    
    <!--___________Menu footer___________-->
 
  <div id="bgfooter">
      <div id="pied">
        <footer>
        <?php
          include("inc/footerFront.inc.php");
          ?>
      </footer>
    </div>
    </div>

  <!--___________Fin Menu footer___________-->
    
  <!--Bouton super top-->
  <script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>
    
</body>
</html>