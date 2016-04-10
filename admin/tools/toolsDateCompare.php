<?php
	/* Fonction qui renvoie 1 si la date1 est antérieure à la date2, et 0 dans le cas contraire */

	function dateCompare($date1, $date2)
	{
		//$now = date('Y-m-d'); // Date actuelle
		//$now = explode("-", $now);
		//$now = $now[0].$now[1].$now[2]; // On se retrouve avec une valeur numérique
		$dateAcomparer1 = explode("-", $date1);
		$dateAcomparer1 = $dateAcomparer1[0].$dateAcomparer1[1].$dateAcomparer1[2]; // On se retrouve avec une valeur numérique
		$dateAcomparer2 = explode("-", $date2);
		$dateAcomparer2 = $dateAcomparer2[0].$dateAcomparer2[1].$dateAcomparer2[2]; // On se retrouve avec une valeur numérique
		
		if($dateAcomparer1 <= $dateAcomparer2) return 1;
		else return 0;
	}
?>