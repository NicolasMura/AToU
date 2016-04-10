<?php
  include_once ("inc/include.inc.php");

  /* Mise à jour éventuelle du sitemap si on vient d'ajouter une création (axe d'amélioration : mettre à jour uniquement lorsque la 1ère photo a été ajoutée) */
  //Remplacé par génération en temps réel, cf. sitemap.php*/
  /*if((isset($_GET["ajout"]) AND $_GET["ajout"] == "actionCulturelle")
      OR (isset($_GET["modif"]) AND $_GET["modif"] == "actionCulturelle")
      OR (isset($_GET["supp"]) AND $_GET["supp"] == "actionCulturelle")) include("inc/sitemap.php");*/

  /* ------------------------------------------------- Recensement photos uploadées pour les créations ---------------------------------- */
  
  // Récupération des éventuelles photos présentes en bdd :
  $requete='SELECT actions_culturellesID FROM photos WHERE creationsID > 0 OR actions_culturellesID > 0';
  $reponse = $bdd->query($requete);
  $nombrePhotos = $reponse->rowCount();
  
  if($nombrePhotos > 0)
  {
    //echo "OK";
    $i=0;
    while($donnees = $reponse->fetch())
    {
      $donneesPhotos["actions_culturellesID"][$i] = $donnees["actions_culturellesID"];
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
       get_fil_ariane(array('final' => 'Actions culturelles'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <h1>Gestion des actions culturelles</h1>
    <?php
      // On récupère tout le contenu de la table creations
      $reponse = $bdd->query('SELECT titre, ID, statut, active FROM actions_culturelles');
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
        <td><?php echo $donnees['titre'];?></td>
        <td class="cellule"><?php echo $donnees['statut'];?></td>
        <td class="cellule">
          <?php
            if($donnees['active'] == 0)
            {
            echo "Inactif";
            echo "<br />(Il faut au moins 1 photo)";
            }
            else  echo "Actif"?>
        </td>
        <td>
          <a href="actionsCulModif.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a>
        </td>
        <td>
          <a href="actionsCulSupp.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a>
        </td>
      </tr>
                             
    <?php
      }
    ?>
    </table>
    <?php
      $reponse->closeCursor(); // Termine le traitement de la requête
    ?>
    <p><a href="actionsCulAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une action culturelle</a></p>

    <h2>Gestion des photos associées aux actions culturelles</h2>

    <?php 
      // On récupère tout le contenu de la table creations
      $reponse = $bdd->query('SELECT titre, ID FROM actions_culturelles');
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
          <td><?php $j=0;
                // Pour chaque photo recensée, on regarde si elle est associée à la création en cours
                for($i=0; $i<$nombrePhotos;$i++)
                {
                  if($donnees['ID'] == $donneesPhotos["actions_culturellesID"][$i]) $j++;     
                }
                echo $j;?>
          </td>
          <td><a href="actionsCulPhotosGestion.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /></a></td>
        </tr>

    <?php
      }
    ?>
    </table>
    <?php
      $reponse->closeCursor(); // Termine le traitement de la requête
    ?>

  </div>

</body>
</html>