<a href="<?php echo CHEMIN_SITE."/".$lang;?>/index"><img id="logo" src="<?php echo CHEMIN_SITE;?>/img/menuLogo1024.jpg" alt="logo AToU"  /></a>

<nav id="ensemble" >

    <?php
		if($donneesLangues["statut"] == 1)
		{
	?>
    <nav id="langue">
        <ul>
            <li>
                <a class="<?php if($lang == "fr") echo "langueActive";?>" title="Site en français" 
                    href="<?php echo $new_url = changer_langue($_SERVER['REQUEST_URI'], "fr");?>" id="fr">
                    fr 
                </a>
            </li>
            <li>
                <a class="<?php if($lang == "en") echo "langueActive";?>" title="Site in English" 
                	href="<?php echo $new_url = changer_langue($_SERVER['REQUEST_URI'], "en");?>" id="en">
                    en
                </a>
            </li>
        </ul>        
    </nav>
    <?php
		}
	?>
    
    <br class:"annule"/>
    
 	<?php
    	$pageCourante = basename($_SERVER['SCRIPT_NAME']);
    ?>                  
    <nav id="menuHeader">
        <ul>
            <li>
                <a class="<?php echo $class = definir_classe_page($pageCourante, "compagnie.php");?>" 
                	href="<?php echo CHEMIN_SITE."/".$lang;?>/compagnie" id="compagnie">
                    <?php echo $string_lang["HEADER_COMPAGNIE"][$lang];?>
                </a>
            </li>
            <li>
                <a class="<?php echo $class = definir_classe_page($pageCourante, "listeCreations.php", "ficheCreation.php");?>" 
                	href="<?php echo CHEMIN_SITE."/".$lang;?>/creations" id="creations">
                    <?php echo $string_lang["HEADER_CREATIONS"][$lang];?></a></li>
            <li>
                <a class="<?php echo $class = definir_classe_page($pageCourante, "listeActions.php", "ficheAction.php");?>" 
                	href="<?php echo CHEMIN_SITE."/".$lang;?>/actions-artistiques" id="actions">
                    <?php echo $string_lang["HEADER_ACTIONS_CULTURELLES"][$lang];?>
                </a>
            </li>
         </ul>
    </nav>

    <a class="<?php echo $class = definir_classe_page($pageCourante, "index.php", "accueilAdherents.php", "listeAteliers.php", "discussion.php", "galeriePhotos.php", "inscriptionNubesAdh.php");?>"
    	href="<?php echo CHEMIN_SITE;?>/adherents/<?php if(isset($_SESSION["adherentID"])) echo "accueil";
														else echo "login";?>" id="adherents">
    	<img src="<?php echo CHEMIN_SITE;?>/img/menuPictoAdherent<?php if(isset($_SESSION["adherentID"])) echo "Connected";?>1024.png" alt="picto adhérent" width="11px" />
		<?php echo $string_lang["HEADER_ESPACE_ADHERENTS"][$lang];?>
	</a>
 </nav>