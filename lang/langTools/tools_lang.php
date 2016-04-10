<?php
	//echo "<span style='background-color:red'>GET = </span>";
	//echo "<pre style='background-color:red'>";
	//print_r($_GET);
	//echo "</pre>";
	//echo "<span style='background-color:red'>_SERVER['SCRIPT_NAME'] : " . $_SERVER['SCRIPT_NAME'] ."</span><br>";
	//echo "<span style='background-color:red'>_SERVER['REQUEST_URI'] : " . $_SERVER['REQUEST_URI'] ."</span><br>";
	
	// Si l'url demandée contient "fr" ou "en", ie qu'un paramètre $lang existe, on utilise ce dernier
	if(isset($_GET["lang"]))
	{
		$lang = $_GET["lang"];
		if($lang == 'fr')
		{
			//echo "<span style='background-color:red'>Langue demandée = français : " . $lang . "</span><br>";
		}
		else
		{
			if($lang == 'en')
			{
				//echo "<span style='background-color:red'>Langue demandée = anglais : " . $lang . "</span><br>";
			}
			else
			{
				// Si la langue demandée n'existe pas (modification de l'URL par un utilisateur sournois), on garde le français par défaut
				$lang = 'fr';
				//echo "<span style='background-color:red'>Langue demandée inexistante ==> français par défaut : " . $lang . "</span><br>";
			}
		}
	}
	// Sinon on vérifie s'il existe déjà un cookie définissant la langue, et si oui on l'utilise
	elseif(isset($_COOKIE['lang']))
	{
		$lang = $_COOKIE['lang'];
		if($lang == 'fr')
		{
			$lang = 'fr';
			//echo "<span style='background-color:red'>Langue du cookie = français : " . $lang . "</span><br>";
			//echo "<span style='background-color:red'>URL demandée : " . $_SERVER['REQUEST_URI'] . "</span><br>";
		}
		else
		{
			if($lang == 'en')
			{
				$lang = 'en';
				//echo "<span style='background-color:red'>Langue du cookie = anglais : " . $lang . "</span><br>";
			}
			else
			{
				// Si la langue du cookie n'est ni le français ni l'anglais, on garde le français par défaut (cas réaliste ??)
				$lang = 'fr';
				//echo "<span style='background-color:red'>Langue du cookie incorrecte ==> français par défaut : " . $lang . "</span><br>";
			}
		}
	}
	// Sinon, si aucune langue n'a été demandée par l'utilisateur et qu'aucun cookie n'existe, on tente de reconnaître la langue par défaut du navigateur
	else
	{
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
		//echo "<span style='background-color:red'>Langue par défaut du navigateur : " . $lang . "</span><br>";
		$langues_valides = array('fr', 'en');
		// Si la reconnaissance échoue, on garde le français par défaut
		if(!in_array($lang, $langues_valides))
		{
			$lang = 'fr';
			//echo "<span style='background-color:red'>Tout a échoué ==> on garde le français par défaut : " . $lang . "</span><br>";
		}
	}

	function changer_langue($serveur_Request_URL, $langue_choisie)
	{	
		
		/*$url = pathinfo($serveur_Request_URL);
		$url_basename = $url['basename'];*/

		// Si aucune langue n'est présente dans l'url...
		if(strstr($serveur_Request_URL, "/fr") == false AND strstr($serveur_Request_URL, "/en") == false)
		{
			// ... soit on est dans l'espace adhérent, et dans ce cas $lang = fr
			if(preg_match("/adherents/", $_SERVER['SCRIPT_NAME']) == 1)
			{
				if($langue_choisie == "fr")
				{
					$urlNewBasename = str_replace("fr", "", $serveur_Request_URL);
				}
				if($langue_choisie == "en")
				{
					$urlNewBasename = str_replace("fr", "", $serveur_Request_URL);
				}
			}
			// ... soit on est à la racine
			else
			{
				if($langue_choisie == "fr")
				{
					$urlNewBasename = CHEMIN_SITE."/fr/index";
				}
				if($langue_choisie == "en")
				{
					$urlNewBasename = CHEMIN_SITE."/en/index";
				}
			}	
		}
		// Sinon on remplace le paramètre dans l'URL si besoin
		else
		{
			if(strstr($serveur_Request_URL, "/fr"))
			{		
				
				if($langue_choisie == "en")
				{
					$urlNewBasename = str_replace("fr", "en", $serveur_Request_URL);
				}
			}
			if(strstr($serveur_Request_URL, "/en"))
			{
				if($langue_choisie == "fr")
				{
					$urlNewBasename = str_replace("en", "fr", $serveur_Request_URL);
				}		
			}
		}

		return $urlNewBasename;
	}
?>