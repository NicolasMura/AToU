<?php
	/* Fonction qui renvoie la date et l'heure du message posté au format suivant:
		- Le 01 janvier 2013 à 00h00 (en français)
	*/

	function dateHeureInfos($dateHeure)
	{
		$messageInfos = array(
			"date",
			"heure",
			);
		
		$string_month = array(
			'01' => "janvier",
			'02' => "février",
			'03' => "mars",
			'04' => "avril",
			'05' => "mai",
			'06' => "juin",
			'07' => "juillet",
			'08' => "août",
			'09' => "septembre",
			'10' => "octobre",
			'11' => "novembre",
			'12' => "décembre",
		);
				
		$annee = substr($dateHeure, 0, 4);
		$mois = substr($dateHeure, 5, 2);
		$jour = substr($dateHeure, 8, 2);
		$heure = substr($dateHeure, 11, 2);
		$minutes = substr($dateHeure, 14, 2);
		
		$messageInfos["date"] = $jour . " " . $string_month[$mois] . " " . $annee;
		$messageInfos["heure"] = $heure . "h" . $minutes;
		return $messageInfos;
	}
?>