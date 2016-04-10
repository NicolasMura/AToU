<?php
	/* ---------------- Récupération des infos en base de données sur les créations archivées pour les pages adhérents ----------------- */
	
	// Récupération des ID de toutes les créations enregistrées
	$idCreations = array();
	
	$requete = "SELECT ID FROM creations WHERE statut = 'creationArchivee' AND active = 1";
	$reponse = $bdd->query($requete);
	while($donnees = $reponse->fetch())
	{
		$idCreations[] = $donnees["ID"];
	}
	
	// Récupération des infos sur les créations
	
	$m=0; // Pour compter le nombre de créations archivées
	foreach($idCreations as $id)
	{	
		//Infos table creations
		$requete = "SELECT * FROM creations WHERE ID = ".$id;
		$reponse = $bdd->query($requete);
		while($donnees = $reponse->fetch())
		{
			$donneesPageCreation = $donnees;
		}
		
		$donneesPage["creationsArchivees"][$m] = $donneesPageCreation;
		
		//Infos table photos
		$requete = "SELECT * FROM photos WHERE creationsID = ".$id." ORDER BY ID ASC";
		$reponse = $bdd->query($requete);
		$j=0;
		while($donnees = $reponse->fetch())
		{
			$donneesPagePhotosCreasArchivees[$j] = $donnees;
			$j++;
		}
		$donneesPage["creationsArchivees"][$m]["photos"] = $donneesPagePhotosCreasArchivees;
		unset($donneesPagePhotosCreasArchivees); // Car tableau susceptible d'être créé plusieurs fois
		$m++;
	}
	$nombreCreationsArchivees = $m;
	$reponse->closeCursor();
?>