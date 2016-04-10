<?php
	// Fonction qui renvoie une chaîne "classe_active" si la page est active, et une chaîne vide sinon
	
	function definir_classe_page($page_courante, $page1, $page2 = false, $page3 = false, $page4 = false, $page5 = false, $page6 = false)
	{
		// Ternaire : si la page est la page active, on la surligne à l'aide de la classe "page_active"
		$classe_page = ($page_courante == $page1 OR $page_courante == $page2 OR $page_courante == $page3 OR $page_courante == $page4 OR $page_courante == $page5 OR $page_courante == $page6) ? "menuActive" : "";
		return $classe_page;
	}
?>