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

  // Récupération du contenu de la table compagnie
    $requete = ($lang == "en") ? "SELECT * FROM compagnie_en" : "SELECT * FROM compagnie";
  $reponse = $bdd->query($requete);
  $donneesCompagnie = $reponse->fetch();
  
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
      }
      
      // S'il s'agit de la création à venir, on enregistre ses infos dans le tableau $donneesPage["creationAvenir"]
      if($donneesPageCreation["statut"] == "creationAvenir" AND $donneesPageCreation["active"] == 1)
      {
        $donneesPage["creationAvenir"] = $donneesPageCreation;
      }
      
      // S'il s'agit d'une  création actuelle, on enregistre ses infos dans le tableau $donneesPage["creationsActuelles"]
      if($donneesPageCreation["statut"] == "creationActuelle" AND $donneesPageCreation["active"] == 1)
      {
        $donneesPage["creationsActuelles"][$k] = $donneesPageCreation;
        $k++;
      }
      $nombreCreationsActuelles = $k;
      
      // S'il s'agit d'une  création passée, on enregistre ses infos dans le tableau $donneesPage["creationsPrecedentes"]
      if($donneesPageCreation["statut"] == "creationPrecedente" AND $donneesPageCreation["active"] == 1)
      {
        $donneesPage["creationsPrecedentes"][$l] = $donneesPageCreation;
        $l++;
      }
      $nombreCreationsPrecedentes = $l;
      
      // S'il s'agit d'une  création archivée, on enregistre ses infos dans le tableau $donneesPage["creationsArchivees"]
      if($donneesPageCreation["statut"] == "creationsArchivee" AND $donneesPageCreation["active"] == 1) // Statut à créer en bdd !
      {
        $donneesPage["creationsArchivees"][$m] = $donneesPageCreation;
        $m++;
      }
      $nombreCreationsArchivees = $m;
    }

  // Récupération de la liste des métiers et collaborateurs disponibles en bdd et associés à au moins une créations (liste disponible dans la table fo_col (qui aurait normalement dû être appelée cre_fo_col))

  if($lang == "en")
  {
    $requeteFonctionsCollaborateurs = "SELECT fonctions_en.metiers, GROUP_CONCAT(DISTINCT(CONCAT(collaborateurs.prenom, ' ', collaborateurs.nom)) SEPARATOR ', ')
                        FROM fo_col, fonctions_en, collaborateurs
                        WHERE fo_col.fonctionsID = fonctions_en.ID AND fo_col.collaborateursID = collaborateurs.ID
                        GROUP BY metiers" 
                        or die(print_r($bdd->errorInfo));
  }
  else
  {
    $requeteFonctionsCollaborateurs = "SELECT fonctions.metiers, GROUP_CONCAT(DISTINCT(CONCAT(collaborateurs.prenom, ' ', collaborateurs.nom)) SEPARATOR ', ')
                        FROM fo_col, fonctions, collaborateurs
                        WHERE fo_col.fonctionsID = fonctions.ID AND fo_col.collaborateursID = collaborateurs.ID
                        GROUP BY metiers" 
                        or die(print_r($bdd->errorInfo));
  }

  $reponseFonctionsCollaborateurs = $bdd->query($requeteFonctionsCollaborateurs);
  while($donneesFonctionsCollaborateurs = $reponseFonctionsCollaborateurs->fetch())
  {
    $donneesPage["fonctionsCollaborateurs"][] = $donneesFonctionsCollaborateurs;
  }
  $reponseFonctionsCollaborateurs->closeCursor(); // Termine le traitement de la requête
  
  // Récupération des liens amis
  $requeteLiens = "SELECT * FROM liens_amis";
  $reponseLiens = $bdd->query($requeteLiens);
  while($donnees = $reponseLiens->fetch())
  {
    $donneesPage["liensAmis"]["nom"][] = $donnees["nom"];
    $donneesPage["liensAmis"]["url"][] = $donnees["url"];
  }
  
  // Facebook
  $titleFacebook = "Compagnie AToU";
  $urlPageFacebook ="http://www.atou.fr/danse-contemporaine-lyon/compagnie.php";
  $urlImageFacebook = "http://www.atou.fr/photosVignettes/compagnie1Yakei.jpg";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Compagnie</title>
    
    <!-- Partage facebook -->
    <meta property="og:title" content="<?php echo $titleFacebook;?>" />
   <meta property="og:url" content="<?php echo $urlPageFacebook;?>" />
    <meta property="og:image" content="<?php echo $urlImageFacebook;?>" />
    
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

    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
          
    <!-- Toggle onglets déroulants -->
    <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/toggle.js"></script>
    
    <style>
      h3{
        text-transform:inherit; 
      }
    
      .nm_imgCompagnie{
        display:inline-block;
      }
    
      .nm_liensCrea:hover, .nm_liensAmis:hover{
        color:#81358A!important;
      }
    </style>

    <!-- LiveRoad -->
    <?php 
      if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
    ?>
</head>

<body id="compagnie">

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
                <p class="filAriane"><?php get_fil_ariane(array('final' => '&nbsp; '.$string_lang["FIL_ARIANE_COMPAGNIE"][$lang]), $lang);?></p>
            </div>
            <!--_________________________________-->

            <h1><?php echo $string_lang["COMPAGNIE_H1"][$lang];?></h1>
            
            <!--___________Zone 1___________-->
    
            <div id="zone1">          
                
                <!--________Encadré photo 1________-->
    
                <div class="cadre1">
                    <div class="black big">
                        <img id="compagnie1" src="<?php echo CHEMIN_SITE;?>/photosVignettes/compagnie1Yakei.jpg" alt="photo compagnie 1" width="692" height="519" />
                    </div>
                    <div class="black" id="firstBlock">
                    </div>
                    <div class="black" id="secondBlock">
                    </div>
                    <div class="black" id="thirdBlock">
                    </div>
                    <div class="black" id="fourthBlock">
                    </div>
                    <br class="annule">    
                </div>
        
                <!--________Fin encadré photo 1________-->
    
    
    
                <!--________Encadré liste des créations + call-to-action________-->
    
                <div class="cadre2">
                    <div class="black big2">
                        <p><?php echo $string_lang["COMPAGNIE_CADRE2_TITRE"][$lang];?></p>
                    </div>
                    <div class="black" id="firstBlock2">
                        <ul>
                            <li>
                                <a class="nm_liensCrea" href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationPresente"]["urlRewrite"]."-".$donneesPage["creationPresente"]["ID"];?>">
                                    <span class="creationTitre"><?php echo $donneesPage["creationPresente"]["titre"];?></span>
                                    <span class="creationDate"><?php echo $donneesPage["creationPresente"]["anneeCreation"];?></span><br />
                                    <span class="creationDescription"><?php echo $donneesPage["creationPresente"]["accroche"];?></span>
                                </a>
                            </li>
                            
                            <?php
                // 4 créations actuelles max 
                if($nombreCreationsActuelles > 4) $nombreCreationsActuelles = 4;
                for($i=0; $i<$nombreCreationsActuelles; $i++)
                {
                  if($donneesPage["creationsActuelles"][$i]["active"] == 1)
                    {
              ?>
                            <li>
                                <a class="nm_liensCrea" href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations/<?php echo $donneesPage["creationsActuelles"][$i]["urlRewrite"]."-".$donneesPage["creationsActuelles"][$i]["ID"];?>">
                                    <span class="creationTitre"><?php echo $donneesPage["creationsActuelles"][$i]["titre"];?></span>
                                    <span class="creationDate"><?php echo $donneesPage["creationsActuelles"][$i]["anneeCreation"];?></span><br />
                                    <span class="creationDescription"><?php echo $donneesPage["creationsActuelles"][$i]["accroche"];?></span>
                                </a>
                            </li>
                            <?php
                    }
                }
              ?>
                            <li>
                                <a class="nm_liensCrea" href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/creations">
                                    <span class="creationTitre"><?php echo $string_lang["COMPAGNIE_CADRE2_VOIR_TOUTES_LES_CREATIONS"][$lang];?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/contactPro"><div class="nm_callToAction"><?php echo $string_lang["COMPAGNIE_CONTACT"][$lang];?></div></a>
                </div>
                
    <!--________Fin encadré liste des créations + call-to-action________-->
             
            </div>
    <!--___________Fin Zone 1___________--> 
        
        
        <br class="annule"/> 
        
        <!--___________Zone 2___________-->
        
        <div id="zone2">                    
                          
        <!--___________Encadré Présentation AToU___________-->
        
                    <div class="white cadre1">
                        <div class="titrePosAbs">
                            <h3 class="black"><?php echo $donneesCompagnie["titre1"]?></h3>
                        </div>
                   
                        <div class="big">
                          
                            <h5><?php echo $donneesCompagnie["sousTitre1"]?></h5> 
                                
                            <p><?php echo $donneesCompagnie["resume1"]?></p>
                            
                            <div class="nm_imgCompagnie"><img src="<?php echo CHEMIN_SITE;?>/photosVignettes/compagnie2.jpg" alt="photo compagnie 2" width="300" height="200" /></div>

                        </div>
                        
                        <a class="partage" href="#" title="PARTAGER SUR"
                          onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo ($urlPageFacebook); ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">
                          <div class="facebook"><?php echo $string_lang["COMPAGNIE_FACEBOOK"][$lang];?>
                          </div>
                        </a>
                        
                    </div>
             
            
        <!--________Fin Encadré Présentation AToU________-->
        
    
        <!--________Encadré pratiques / Onglets déroulants________-->
        
                    <div class="cadre2">

            <?php
                            if(isset($donneesPage["fonctionsCollaborateurs"]))
                            {
                        ?>
                        <div id="firstBlock2_2">
                            <div class="toggle toggleUp"><?php echo $string_lang["COMPAGNIE_COLAB"][$lang];?></div>
                            
                            <div class="deroule">
                                <?php
                  for($i=0 ; $i<count($donneesPage["fonctionsCollaborateurs"]) ; $i++)
                  {
                ?>                               
                                <div>
                                    <span class="infoGras"><?php echo $donneesPage["fonctionsCollaborateurs"][$i][0];?> :</span>
                                    <span class="infoRom"><?php echo $donneesPage["fonctionsCollaborateurs"][$i][1];?></span><br />
                                </div>
                                <?php
                  }
                ?>
                                
                            </div>
                        </div>
                        <?php
              }
            ?>
                        
                        
                        <div id="secondBlock2">
                            <div class="toggle toggleUp"><?php echo $string_lang["COMPAGNIE_AMIS"][$lang];?></div>
                            
                            <div class="deroule">
                            <?php
                for($i=0;$i<count($donneesPage["liensAmis"]);$i++)
                {
              ?>    
                                <div>
                                    <a href="$donneesPage["liensAmis"]["url"][$i];?>">
                                        <span class="nm_liensAmis infoGras"><?php echo $donneesPage["liensAmis"]["nom"][$i];?></span>
                                    </a>
                                    <span class="infoRom"></span><br />
                                </div>
                    <?php
                }
              ?>
                            </div>
                        </div>
                        
                        <div id="thirdBlock2">
                            <div class="toggle toggleUp"><?php echo $string_lang["COMPAGNIE_PRESSE"][$lang];?></div>
                            
                            <div class="deroule">
                                <div>
                                    <a class="nm_liensAmis" href="#">
                                      <span class="nm_liensAmis infoGras"><?php echo $string_lang["COMPAGNIE_KITPRESS"][$lang];?></span>
                                      <span class="infoRom">(pdf)</span><br /><br />
                                    </a>
                                    <span class="infoRom"><?php echo $string_lang["COMPAGNIE_KITPRESS_CONTACT"][$lang];?></span>                    
                                </div>
                            </div>
                        </div>
                            
                        <a href="<?php echo CHEMIN_SITE;?>/<?php echo $lang;?>/partenaires" class="redirection1 nm_displayInlineBlock"><?php echo $string_lang["COMPAGNIE_PARTENAIRES"][$lang];?></a>
                        
                        <a href="#" class="callToAction2"><?php echo $string_lang["COMPAGNIE_FICHE"][$lang];?></a>
    
                        
    
                    </div>
                    
        
        <!--________Fin Encadré pratiques / Onglets déroulants________-->
                    
                </div>
        <!--___________Fin Zone 2___________-->
        
        
        
        <br class="annule"/>
        
        
        
        <!--___________Zone 3___________-->
        
                <div id="zone3">                    
                          
        <!--________Encadré Présentation Anan________-->
        
                    <div class="cadre1 white">
                        <div class="titrePosAbs">
                              <h3 class="black"><?php echo $donneesCompagnie["titre2"]?><br /><span class="fonction"><?php echo $donneesCompagnie["fonction2"]?></span></h3>
                        </div>
                        
                        <div class="big">
                        
                        <h5><?php echo $donneesCompagnie["sousTitre2"]?></h5> 
            
                        <p><?php echo $donneesCompagnie["resume21"]?></p>
                        <img id="compagnie3" src="<?php echo CHEMIN_SITE;?>/photosVignettes/compagnieAnanPortrait.jpg" alt="Portrait Anan"/>
                        <p><?php echo $donneesCompagnie["resume22"]?></p>
        
                        </div>
                        
                    </div>
            
        <!--________Fin Encadré Présentation Anan________-->
                    
                </div>
        <!--___________Fin Zone 3___________-->
        
        
        
        <br class="annule"/>
        
        
        
        <!--___________Zone 4___________-->
        
        <div id="zone4">                    
                          
        <!--________Encadré Présentation Marc________-->
        
                    <div class="cadre1 white">
                        <div class="titrePosAbs">
                            <h3 class="black"><?php echo $donneesCompagnie["titre3"]?><br /><span class="fonction"><?php echo $donneesCompagnie["fonction3"]?></span></h3>
                        </div>
        
                        <div class="big">
                        
                        <img id="compagnie4" src="<?php echo CHEMIN_SITE;?>/photosVignettes/compagnieMarcR.jpg" alt="photo compagnie 4" />
            
                        <h5><?php echo $donneesCompagnie["sousTitre3"]?></h5>
                        <p><?php echo $donneesCompagnie["resume3"]?></p>
                        
                        <!--<p>Marc Ribault, né en France, découvre sa vocation de danseur à 21 ans. Il n'a jamais fait de danse, ne vient pas d'une famille où l'on danse et est engagé dans des études d’histoire quand il rencontre l'art du mouvement. Dès lors, il n'aura de cesse de danser, danser et danser encore. Ses pieds découvrent le tapis de danse du CND pour sa "première fois". Il est confirmé dans son intuition et ne lâche plus la barre d'échauffement. Deux ans après son premier pas de danse, il obtient la bourse Fulbright pour aller étudier à New York à l'école Alvin Ailey puis, après deux ans de technique Graham et africaine, enchaîne avec l'école de Merce Cunningham où il rencontre Anan Atoyama.</p>
                        
                        <p>Revenu en France en 2005 après un court passage chez Bill T. Jones, Marc danse pour plusieurs compagnies, notamment chez Michel Hallet Eghayan, et obtient son diplôme de professeur, dispensant de nombreux cours et stages.
De plus en plus sensible à la démarche d'AToU, il interprète un rôle dans Râga en 2011, puis assiste Anan lors des répétitions du Défilé de la Biennale 2012, auprès de danseurs déficients mentaux et visuels.</p>
<p>Depuis 2013, il est artiste associé de la compagnie AToU, participant à toutes les créations, et est impliqué dans les choix artistiques de la compagnie.</p>-->
                        
                        
                        <br class="annule"/>
                                            
                        </div>
                    </div>
            
                <!--________Fin Encadré Présentation Marc________-->
                    
                </div>
            <!--___________Fin Zone 4___________-->
            
            
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