<?php
  //début de session
  session_start();
  // connexion à la base
  require_once('../Connections/connexionMysql.php');
  // gestion des accents
  $bdd->query("SET NAMES 'utf8'");
  // gestion du fil d'Ariane
  include('../inc/fonctionFilArianne.inc.php');
  // Gestion des constantes 
  require_once("../inc/constantes.inc.php");
  
  // Gestion des langues (champs "statiques" du front-office)
  include("../lang/langTools/lang.inc.php");
  require("../lang/lang.php");

  // Recensement de toutes les créations (publiques) et actions culturelles enregistrées

  $requete = "SELECT ID, titre, urlRewrite FROM creations WHERE statut != 'creationArchivee'";
  $reponse = $bdd->query($requete);
  while($donnees = $reponse->fetch())
  {
    $donneesCreations["urls"][] = $donnees["urlRewrite"]."-".$donnees["ID"];
    $donneesCreations["titres"][] = $donnees["titre"];
  }
  $reponse->closeCursor();

  $requete = "SELECT ID, titre, urlRewrite FROM actions_culturelles";
  $reponse = $bdd->query($requete);
  while($donnees = $reponse->fetch())
  {
    $donneesActionsCulturelles["urls"][] = $donnees["urlRewrite"]."-".$donnees["ID"];
    $donneesActionsCulturelles["titres"][] = $donnees["titre"];
  }
  $reponse->closeCursor();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Plan du site</title>
    
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



<body id="planDuSite">
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
            
        <!--___________ Fil d'Arianne___________-->
        <div class="filaire">
        <?php
          define('Compagnie_ATou', $string_lang["FIL_ARIANE_ACCUEIL"][$lang].' &nbsp;', true);
        ?>
          <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["FIL_ARIANE_MAP"][$lang]), $lang);?></p>
        </div>
      <!--_____________________________________-->
            
        <h1><?php echo $string_lang["PLAN_SITE_H1"][$lang];?></h1>

      <!--_____________________Zone 1_____________________-->

      <div id="zone1"> 
      
        <div id="imgTacheBlancheAnnexes">
            <img src="<?php echo CHEMIN_SITE;?>/img/backgroundTacheBlanc.png"/>
        </div>
        
        <div class="cadreAnnexes">                

          <h5><?php echo $string_lang["PLAN_SITE_ACCUEIL"][$lang];?></h5>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/index';?>">&gt; <?php echo $string_lang["PLAN_SITE_ACCUEIL_SITE"][$lang];?></a></p>
          
          <h5><?php echo $string_lang["PLAN_SITE_ATOU"][$lang];?></h5>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/compagnie';?>">&gt; <?php echo $string_lang["PLAN_SITE_ATOU_PRESENTATION"][$lang];?></a></p>
          
          <h5><?php echo $string_lang["PLAN_SITE_CREATIONS"][$lang];?></h5>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/creations';?>">&gt; <?php echo $string_lang["PLAN_SITE_CREATIONS_LISTE"][$lang];?></a></p><br>
          <?php
            for($i=0; $i<count($donneesCreations["urls"]); $i++)
            {
          ?>
              <p><a class="creation" href="<?php echo CHEMIN_SITE.'/'.$lang.'/creations/'.$donneesCreations["urls"][$i];?>">
                &gt; <?php echo $donneesCreations["titres"][$i];?></a>
              </p>
          <?php
            }
          ?>

          <h5><?php echo $string_lang["PLAN_SITE_ACTIONS_CULTURELLES"][$lang];?></h5>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/actions-artistiques';?>">&gt; <?php echo $string_lang["PLAN_SITE_ACTIONS_CULTURELLES_LISTE"][$lang];?></a></p><br>
          <?php
            for($i=0; $i<count($donneesActionsCulturelles["urls"]); $i++)
            {
          ?>
              <p><a class="creation" href="<?php echo CHEMIN_SITE.'/'.$lang.'/actions-artistiques/'.$donneesActionsCulturelles["urls"][$i];?>">
                &gt; <?php echo $donneesActionsCulturelles["titres"][$i];?></a>
              </p>
          <?php
            }
          ?>              
         
          <h5>Espace adhérents</h5>
          <p><a href="<?php echo CHEMIN_SITE.'/adherents/accueil';?>">&gt; Accueil de l'espace adhérent</a></p><br>
          <p><a class="itemAdherent" href="<?php echo CHEMIN_SITE.'/adherents/listeAteliers.php';?>">&gt; Ateliers</a></p><br>
          <p><a class="sousItemAdherent" href="<?php echo CHEMIN_SITE.'/adherents/inscriptionNubesAdh.php';?>">&gt; Inscription à l'atelier Nubes</a></p><br>
          <p><a class="itemAdherent" href="<?php echo CHEMIN_SITE.'/adherents/discussion.php';?>">&gt; Carnet de bord</a></p><br>
          <p><a class="itemAdherent" href="<?php echo CHEMIN_SITE.'/adherents/galeriePhotos.php';?>">&gt; Galerie Photos</a></p><br>

          <h5>Autres liens</h5>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/newsletter';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_NEWSLETTER"][$lang];?></a></p><br>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/partenaires';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_PARTENAIRES"][$lang];?></a></p><br>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/sitemap';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_SITEMAP"][$lang];?></a></p><br>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/mentions-legales';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_MENTIONS_LEGALES"][$lang];?></a></p><br>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/contactPro';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_CONTACT_PRO"][$lang];?></a></p><br>
          <p><a href="<?php echo CHEMIN_SITE.'/'.$lang.'/contact';?>">
            &gt; <?php echo $string_lang["PLAN_SITE_AUTRES_LIENS_CONTACT"][$lang];?></a></p><br>
        </div>

      </div>
      <!--_____________________Fin Zone 1_____________________-->
      
      
      <br class="annule"/>

    </section>

  </div>

    
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