<?php
  // début de session
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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Contact</title>
  
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

  <!-- LiveRoad -->
  <?php 
    if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
  ?>
</head>
<body id="contact">

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
            

      <h1>Hu hu ! 404 !</h1>
           
      <!--_____________________Zone 1_____________________-->
    
            <div id="zone1"> 
            
              <div id="imgTacheBlancheAnnexes">
              <img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png"/>
            </div>
                
                <div class="cadreAnnexes">                
          <h5><?php echo $string_lang["404_TITRE"][$lang];?></h5>
          
                        
        </div>

      </div>
      <!--_____________________Fin Zone 1_____________________-->
            
            
            <br class="annule"/>
            
    </section>
 
      <!--_____________________Fin SECTION_____________________--> 
 
  </div>
    
    <!--_____________________Fin FOND NOIR_____________________--> 



    
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
  <script src="<?php echo CHEMIN_SITE;?>/jquery/topButton.js" type="text/javascript"></script>

</body>
</html>