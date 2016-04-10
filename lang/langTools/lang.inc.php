<?php 
	/*//echo $_SERVER['REQUEST_URI']."<br>";
	$url = pathinfo($_SERVER['REQUEST_URI']);
	$url_basename = $url['basename'];
	//echo $url_basename;*/
	// Si on est à la racine de l'espace adhérents
	if(preg_match("/adherents/", $_SERVER['SCRIPT_NAME']) == 1)
	{
		//echo "<span style='background-color:red'>racine adherent</span><br>";
		require_once("../lang/lang.php");
		require("../lang/langTools/tools_lang.php");
		//detecter_langue($_SERVER['REQUEST_URI']);
		require_once("../inc/menuFrontLienActif.php");
	}
	
	// Si on est à la racine du site (index.php)
	elseif(preg_match("/index/", $_SERVER['SCRIPT_NAME']))
	{
		//echo "<span style='background-color:red'>racine index</span><br>";
		require_once("lang/lang.php");
		require("lang/langTools/tools_lang.php");
		//detecter_langue($_SERVER['REQUEST_URI']);
		require_once("inc/menuFrontLienActif.php");
	}
	
	// Sinon, si on est à la racine du site sur une autre page que l'index (par exemple login.php, loginErreur.php, landingPage.php...)
	/*elseif(preg_match("/login/", $_SERVER['SCRIPT_NAME']) == 1)
	{
		//echo "racine login";
		require_once("lang/lang.php");
		require("lang/langTools/tools_lang.php");
		require_once("inc/menuFrontLienActif.php");
	}*/
	
	// Sinon, pour toutes les autres pages placées dans un dossier qui est à la racine du site
	else
	{
		//echo "<span style='background-color:red'>dossier à la racine</span><br>";
		require_once("../lang/lang.php");
		include("../lang/langTools/tools_lang.php");
		//detecter_langue($_SERVER['REQUEST_URI']);
		require_once("../inc/menuFrontLienActif.php");
	}
	
	// Récupération info gestion langue bdd
	$requeteLangues = "SELECT statut FROM langues";
	$reponseLangues = $bdd->query($requeteLangues);
	$donneesLangues = $reponseLangues->fetch();
	
	//définition de la durée du cookie (1 an)
	$expire = 365*24*3600;
	
	//enregistrement du cookie au nom de lang
	//echo "<span style='background-color:red'>Langue à enregistrer dans le cookie : ".$lang."</span>";
	if($_SERVER["HTTP_HOST"] == "atou.local") setcookie('lang', $lang, time() + $expire, "/", "atou.local");
	elseif($_SERVER["HTTP_HOST"] == "portfolio.local") setcookie('lang', $lang, time() + $expire, "/projets/AToU", "portfolio.local");
	elseif($_SERVER["HTTP_HOST"] == "nicolasmura.ovh") setcookie('lang', $lang, time() + $expire, "/projets/AToU", "nicolasmura.ovh");
	else setcookie('lang', $lang, time() + $expire, "/", "atou.fr");

	//echo "<pre style='background-color:red'>";
	//print_r($_COOKIE);
	//echo "</pre>";
?>