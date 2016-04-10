<?php
  include_once ("inc/include.inc.php");

  /* Mise à jour éventuelle du sitemap si on vient d'ajouter une création (axe d'amélioration : mettre à jour uniquement lorsque la 1ère photo a été ajoutée) */
  //Remplacé par génération en temps réel, cf. sitemap.php*/
  /*if((isset($_GET["ajout"]) AND $_GET["ajout"] == "creation")
      OR (isset($_GET["modif"]) AND $_GET["modif"] == "creation")
      OR (isset($_GET["supp"]) AND $_GET["supp"] == "creation")) include("inc/sitemap.php");*/

  /* ------------------------------------------------- Recensement photos uploadées pour les créations ---------------------------------- */
  
  // Récupération des éventuelles photos présentes en bdd :
  $requete='SELECT creationsID, actions_culturellesID FROM photos WHERE creationsID > 0 OR actions_culturellesID > 0';
  $reponse = $bdd->query($requete);
  $nombrePhotos = $reponse->rowCount();
  
  if($nombrePhotos > 0)
  { 
    //echo "OK";
    $i=0;
    while($donnees = $reponse->fetch())
    {
      $donneesPhotos["creationsID"][$i] = $donnees["creationsID"];
      $i++;
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion des Créations</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('final' => 'Créations'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <h1>Gestion des créations</h1>

    <?php 
    // On récupère tout le contenu de la table creations
    $reponse = $bdd->query('SELECT titre, ID, statut, active FROM creations');
    // On affiche chaque entrée une à une
    ?>
    <table>
      <tr>
        <th>Titre</th>
        <th>Statut</th>
        <th>Actif ?</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr> 
      <?php 
        while ($donnees = $reponse->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donnees['titre'];?></td>
        <td class="cellule"><?php echo $donnees['statut'];?></td>
        <td class="cellule">
          <?php if($donnees['active'] == 0)
            {
              echo "Inactif";
              echo "<br />(Il faut au moins 1 photo)";
            }
            else  echo "Actif"
          ?>
        </td>
        <td>
          <a href="creationsModif.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a>
        </td>
        <td>
          <a href="creationsSupp.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a>
        </td>
      </tr>

      <?php
        }
      ?>
    </table>
      <?php
        $reponse->closeCursor(); // Termine le traitement de la requête
      ?>
    <p><a href="creationsAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une création</a></p>

    <h2>Gestion des photos associées aux créations</h2>

    <?php 
      // On récupère tout le contenu de la table creations
      $reponse = $bdd->query('SELECT titre, ID FROM creations');
      // On affiche chaque entrée une à une
    ?>

    <table>
      <tr>
        <th>Titre</th>
        <th>Nombre de photos enregistrées</th>
        <th>Ajouter des photos</th>
      </tr> 
      <?php 
        while ($donnees = $reponse->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donnees['titre'];?></td>
        <td>
          <?php $j=0;
            // Pour chaque photo recensée, on regarde si elle est associée à la création en cours
            for($i=0; $i<$nombrePhotos;$i++)
            {
              if($donnees['ID'] == $donneesPhotos["creationsID"][$i]) $j++;     
            }
            echo $j;
          ?>
        </td>
        <td>
          <a href="creationsPhotosGestion.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg"  /></a>
        </td>
      </tr>
                   
      <?php
        }
      ?>
    </table>
    <?php
      $reponse->closeCursor(); // Termine le traitement de la requête
    ?>
    
    <h2>Gestion des photos mobiles associées aux créations</h2>

    <?php 
      // On récupère tout le contenu de la table creations
      $reponse = $bdd->query('SELECT titre, ID, filenamePhotoMobile FROM creations');
      // On affiche chaque entrée une à une
    ?>

    <table>
      <tr>
        <th>Titre</th>
        <th>Photo enregistrée</th>
        <th>Ajouter des photos</th>
      </tr> 
      <?php 
        while ($donnees = $reponse->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donnees['titre'];?></td>
        <td>
          <?php 
            // Pour chaque photo recensée, on regarde si elle est associée à la création en cours
            if($donnees['filenamePhotoMobile'] !== NULL AND $donnees['filenamePhotoMobile'] !==""){     
            echo "OK";
            }
            else  
            {
            echo "Il faut au moins 1 photo";
            }
          ?>
        </td>
        <td>
          <a href="creationsPhotosMobilesGestion.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg"  /></a>
        </td>
      </tr>          
     
    <?php
      }
    ?>
    </table>

  </div>

</body>
</html>