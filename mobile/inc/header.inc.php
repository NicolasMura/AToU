<?php require_once("constantes.inc.php");?>
<header class="black">
    <nav id="menuHeader">
        <div id="menuBurger">
            <a href="#about"><img src="<?php echo CHEMIN_SITE;?>/img/mobilePictoHamburger.png" height="44px"/></a>
            
        </div>
        <div id="logoAtou">
            <a href="<?php echo CHEMIN_SITE_MOBILE;?>/index.php"><img src="<?php echo CHEMIN_SITE;?>/img/mobileLogoAtou.png" height="44px"/></a>
        </div>
        
        <div id="pictoAdherent">
            <a href="<?php echo CHEMIN_SITE_MOBILE;?>/adherents/<?php if(isset($_SESSION["adherentID"])) echo "accueilAdherents.php";
																	  else echo "index.php";?>"><img src="
            <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
           echo CHEMIN_SITE;?>/img/mobilePictoConnecte.png
			<?php }else{ 
           echo CHEMIN_SITE;?>/img/mobilePictoNonConnecte.png
            <?php } ?>"
			height="34px"/></a>
            <br class="annule"/>
        </div>    
    </nav>
</header>