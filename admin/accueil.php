<?php
  include_once ("inc/include.inc.php");

  // ** Logout the current user. **
  $logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
  if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
    $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
  }

  if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
    //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);
  	
    $logoutGoTo = "index.php";
    if ($logoutGoTo) {
      header("Location: $logoutGoTo");
      exit;
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Accueil- administration site Atou</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
<?php include('inc/menuAdmin.inc.php'); ?>

<div id="container">
<section id="accueil">

    <div id="firstLine">
    
        <a href="cieAtouGestion.php" id="btn1" class="menuBouton"><!--<img src="../img/atou_menu_cie.png" width="200" height="150"/>-->Cie Atou</a>
        
    </div>
    
    <div id="secondLine">
    	
    	<div id="bloc2Center">
    
            <a href="actionsCulGestion.php" id="btn2" class="menuBouton"><!--<img src="../img/atou_menu_culture2.png" width="200" height="150"/>-->Actions culturelles</a>
            <a href="languesGestion.php" id="btn3" class="menuBouton"><!--<img src="../img/atou_menu_langues.png" width="200" height="150"/>-->Langues</a>
            
         </div>   
            
    </div>
    
    <div id="thirdLine">
    
        <a href="actualitesGestion.php" id="btn4" class="menuBouton"><!--<img src="../img/atou_menu_news.png" width="200" height="150"/>-->Actualités</a>
        <a href="creationsGestion.php" id="btn5" class="menuBouton"><!--<img src="../img/atou_menu_creations.png" width="200" height="150"/>-->Créations</a>
        <a href="adherentsGestion.php" id="btn6" class="menuBouton"><!--<img src="../img/atou_menu_adherents.png" width="200" height="150"/>-->Adhérents</a>
        <a href="espaceAdherentGestion.php" id="btn7" class="menuBouton"><!--<img src="../img/atou_menu_espace.png" width="200" height="150"/>-->Espace adhérents</a>
        
    </div>

</section>
</div>
</body>
</html>