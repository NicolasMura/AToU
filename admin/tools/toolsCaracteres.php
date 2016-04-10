<?php
	/* Fonction qui nettoie une chaîne de caractères
	Exemple : 
	
	$chaine="Avant qu'elle ne se fâne";
	$chaineNew = nettoyerChaine($chaine);
	
	--> la nouvelle chaîne de caractères $newChaine sera : "Avant-qu-elle-ne-se-ane"
	
	*/
	
	function nettoyerChaine($chaine)
	{
		$caracteres = array(
			'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', '@' => 'a',
			'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
			'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
			'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
			'Œ' => 'oe', 'œ' => 'oe',
			'$' => 's');
	 
		$chaine = strtr($chaine, $caracteres);
		$chaine = preg_replace('#[^A-Za-z0-9]+#', '-', $chaine);
		$chaine = trim($chaine, '-');
		$chaine = strtolower($chaine);
	 
		return $chaine;
	}
?>