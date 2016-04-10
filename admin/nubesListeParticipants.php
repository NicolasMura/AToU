<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  // On récupère la prochaine date Nubes enregistrée
  $requeteNubesDates = "SELECT dates FROM nubes";
  $reponseNubesDates = $bdd->query($requeteNubesDates);
  $nombreNubesDates = $reponseNubesDates->rowCount();
  
  if($nombreNubesDates > 0)
  {   
    $requeteNubesNextDate = "SELECT MIN(dates) FROM nubes";
    $donneesNubesNextDate = $bdd->query($requeteNubesNextDate);
    $reponseNubesNextDate = $donneesNubesNextDate->fetch();
      
    $prochaineDateNubes = $reponseNubesNextDate["MIN(dates)"]; 
  }
  else
  {
    $prochaineDateNubes = "";
  }
  
  // On récupère les éventuels adhérents qui ont répondu présent pour la prochaine date Nubes enregistrée (s'il y en a une)
  if($prochaineDateNubes != "")
  {
    $donneesPage["prochaineDateNubes"] = dateHeureInfos($prochaineDateNubes);
    
    $requeteParticipants = "SELECT nom, prenom, nubesDate FROM adherents WHERE nubesDate = '". $prochaineDateNubes ."'";
    $reponseParticipants = $bdd->query($requeteParticipants);
    $nombreParticipants = $reponseParticipants->rowCount();
    
    if($nombreParticipants > 0)
    {
      $i=0;
      while($donneesParticipants = $reponseParticipants->fetch())
      {
        $dateParticipant = $donneesParticipants["nubesDate"];
        $donneesPage[$i]["nom"] = $donneesParticipants["nom"];
        $donneesPage[$i]["prenom"] = $donneesParticipants["prenom"];
        $i++;
      }
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Liste participants Nubes</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'final' => 'Liste des participants au prochain atelier Nubes'));
      ?>
    </div><!-- fin du fil d'Arianne -->
      
    <h1>Liste des participants au prochain atelier Nubes</h1>
    
    <?php
      if($prochaineDateNubes != "")
      {
        if($nombreParticipants > 0)
        {
    ?>
    <p>Les adhérents ayant répondu présent au prochain atelier Nubes du <?php echo $donneesPage["prochaineDateNubes"]["date"];?> sont :</p>
    <table>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
      </tr>
        <?php
          for($i=0; $i<$nombreParticipants; $i++)
          {
        ?>
        <tr>
          <td><?php echo $donneesPage[$i]['nom'];?></td>
          <td><?php echo $donneesPage[$i]['prenom'];?></td>
        </tr>
        <?php
          }
        ?>
    </table>
    <?php
        }
        else echo "Il n'y a encore aucun participant inscrit pour l'atelier Nubes  du " . $donneesPage["prochaineDateNubes"]["date"] . ".";
      }
      else echo "Vous n'avez encore date enregistrée pour l'atelier Nubes."
    ?>
            
  </div>

</body>
</html>