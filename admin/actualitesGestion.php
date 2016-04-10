<?php
  include_once ("inc/include.inc.php");
  
  // On récupère tout le contenu de la table actualité sauf l'ID 3 qui est dédié au mobile
  $reponse = $bdd->query('SELECT * FROM actualites WHERE ID!=3');
  $nbreActus = $reponse->rowCount();
  $i=0;
  while ($donnees = $reponse->fetch())
  {
    $donneesPage[$i] = $donnees;
    $i++;
  }
  // On récupère tout le contenu de l'ID 3 de la table actualité 
  $reponse2 = $bdd->query('SELECT * FROM actualites WHERE ID=3');
  $donnees2 = $reponse2->fetch();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion des actualités</title>
  
  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">

    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('final' => 'Gestion des actualités'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <h1>Actualités</h1>
    <br>
     
    <table>
      <tr>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
          <?php 
            for($i=0;$i<$nbreActus;$i++)
            {
          ?>
      <tr>
        <td><?php echo $donneesPage[$i]['titre'];?></td>
        <td>
          <a href="actualitesModif.php?ID=<?php echo $donneesPage[$i]['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a>
        </td>
        <td>
          <?php
            if($i==0)
            {
              echo "Vous ne pouvez pas supprimer cette actualité.";
            }
            else
            {
          ?>
          <a href="actualitesSupp.php?ID=<?php echo $donneesPage[$i]['ID'];?>" class="ahref" ><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg" /></a>
        </td>
          <?php
          }
          ?>
      </tr>
      <?php
      }
      ?>
    </table>
      <?php
      // S'il n'y a qu'une seule actualité, on laisse la possibilité d'en ajouter une 2ème
      if($nbreActus == 1)
      {
    ?>
      <p><a href="actualitesAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une autre actualité pour le site desktop</a></p>
      <?php
      }
    ?>
      
    <h1>Actualité mobile</h1>
    <br>
       
    <table>
      <tr>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      <tr>
        <td><?php echo $donnees2['titre'];?></td>
        <td>
          <a href="actualitesModif.php?ID=<?php echo $donnees2['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a>
        </td>
        <td>
          <?php
            echo "Vous ne pouvez pas supprimer cette actualité.";
          ?>
          <a href="actualitesSupp.php?ID=<?php echo $donnees2['ID'];?>" class="ahref" ></a>
        </td>
      </tr>
    </table>
    
  <h2>Gestion de la photo associée à l'actualité mobile (home page adhérents)</h2>
  <br>

  <table>
    <tr>
      <th>Titre</th>
      <th>Photo enregistrée</th>
      <th>Ajouter la photo</th>
    </tr> 
    <tr>
      <td class="cellule"><?php echo $donnees2['titre'];?></td>
      <td>
        <?php 
          if($donnees2["filenamePhotoMobile"] !== NULL AND $donnees2["filenamePhotoMobile"] !="")
          {     
            echo "OK";
          }
          else  
          {
           echo "Il faut 1 photo";
          }
        ?>
      </td>
      <td>
        <a href="actualitesPhotosMobilesGestion.php?ID=<?php echo $donnees2['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg"  /></a>
      </td>
    </tr>
  </table>
      
  </div>

</body>
</html>