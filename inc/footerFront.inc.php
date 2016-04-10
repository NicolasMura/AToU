<?php 
	// Si on est à la racine de l'espace adhérents
	if(preg_match("/adherents/", $_SERVER['SCRIPT_NAME']) == 1)
	{
		//echo "racine adherent";
		require_once("../inc/menuFrontLienActif.php");
	}
	
	// Si on est à la racine du site (index.php)
	elseif(preg_match("/index/", $_SERVER['SCRIPT_NAME']) == 1)
	{
		//echo "racine index";
		require_once("inc/menuFrontLienActif.php");
	}
	
	// Sinon, pour toutes les autres pages placées dans un dossier qui est à la racine du site
	else
	{
		//echo "dossier à la racine";
		require_once("../inc/menuFrontLienActif.php");
	}

	//enregistrement du cookie au nom de lang
	//setcookie('lang', $lang, time() + $expire);
	
    $pageCourante = basename($_SERVER['SCRIPT_NAME']);
?>
<nav id="menuFooter">
	<ul>
		<li>
        	<a class="<?php echo $class = definir_classe_page($pageCourante, "newsletter.php");?>" 
            	href="<?php echo CHEMIN_SITE."/".$lang;?>/newsletter" id="newsletter">
            	<?php echo $string_lang["FOOTER_NEWSLETTER"][$lang];?>
            </a>
		</li>
        <li>
        	<a class="<?php echo $class = definir_classe_page($pageCourante, "partenaires.php");?>" 
            	href="<?php echo CHEMIN_SITE."/".$lang;?>/partenaires" id="partenaires">
				<?php echo $string_lang["FOOTER_PARTENAIRES"][$lang];?>
            </a>
		</li>
		<li>
        	<a class="<?php echo $class = definir_classe_page($pageCourante, "plan.php");?>" 
            	href="<?php echo CHEMIN_SITE."/".$lang;?>/sitemap" id="plan">
            	<?php echo $string_lang["FOOTER_PLAN_SITE"][$lang];?>
            </a>
		</li>
		<li>
        	<a class="<?php echo $class = definir_classe_page($pageCourante, "mentionsLegales.php");?>" 
            	href="<?php echo CHEMIN_SITE."/".$lang;?>/mentions-legales" id="mentions">
            	<?php echo $string_lang["FOOTER_MENTIONS_LEGALES"][$lang];?>
            </a>
		</li>	
		<li>
        	<a class="<?php echo $class = definir_classe_page($pageCourante, "contact.php");?>" 
            	href="<?php echo CHEMIN_SITE."/".$lang;?>/contact" id="credits">
            	<?php echo $string_lang["FOOTER_CONTACT"][$lang];?>
        	</a>
		</li>
	</ul>
</nav>

<p>
	<a href="https://fr-fr.facebook.com/pages/Cie-AToU/305050169520146" id="rsp1" target="_blank">
    	<img src="<?php echo CHEMIN_SITE;?>/img/footerFacebook1024.png" alt="picto Facebook" width="24px" />
    </a>
	<a href="http://vimeo.com/channels/atou" id="rsp2" target="_blank">
    	<img src="<?php echo CHEMIN_SITE;?>/img/footerVimeo1024.png" alt="picto Vimeo" width="24px" />
    </a>
	<a href="http://fr.linkedin.com/pub/cie-atou/81/254/115" id="rsp3" target="_blank">
    	<img src="<?php echo CHEMIN_SITE;?>/img/footerLinkedIn1024.png" alt="picto LinkedIn" width="24px" />
    </a>
</p>

<p id="copyright">© AToU 2014.</p>

<script type="text/javascript" src="/js/analyticstracking.js"></script>