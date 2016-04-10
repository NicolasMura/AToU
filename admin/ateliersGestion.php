<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  // Infos Nubes, TransFORME, Neruda et Malval
  $requeteAteliers = "SELECT ID, titre, filenamePhotoMobile FROM ateliers WHERE ID < 11 ORDER BY ID";
  $reponseAteliers = $bdd->query($requeteAteliers);
  $nombreAteliers = $reponseAteliers->rowCount();
  
  $i=0;
  while($donneesAteliers = $reponseAteliers->fetch())
  {
    $donneesPage["atelierID"][$i] = $donneesAteliers["ID"];
    $donneesPage["atelierTitre"][$i] = $donneesAteliers["titre"];
    $donneesPage["atelierFilename"][$i] = $donneesAteliers["filenamePhotoMobile"];
    $i++;
  }
  
  $reponseAteliers->closeCursor();
  
  // Infos autres ateliers
  $requeteAutresAteliers = "SELECT ID, titre, filenamePhotoMobile FROM ateliers WHERE ID > 10 ORDER BY ID";
  $reponseAutresAteliers = $bdd->query($requeteAutresAteliers);
  $nombreAutresAteliers = $reponseAutresAteliers->rowCount();
  
  $i=0;
  while($donneesAutresAteliers = $reponseAutresAteliers->fetch())
  {
    $donneesPageAutres["atelierID"][$i] = $donneesAutresAteliers["ID"];
    $donneesPageAutres["atelierTitre"][$i] = $donneesAutresAteliers["titre"];
    $donneesPageAutres["atelierFilename"][$i] = $donneesAutresAteliers["filenamePhotoMobile"];
    $i++;
  }
  
  $reponseAutresAteliers->closeCursor();
  
  // Infos ateliers concernés par les photos mobiles (= ceux de la liste ateliers : Nubes, Autour de TransFORME 2014, Neruda, Malval et les autres ateliers)
  $requeteAteliersMobile = "SELECT ID, titre, filenamePhotoMobile FROM ateliers WHERE ID < 3 OR ID > 8 ORDER BY ID";
  $reponseAteliersMobile = $bdd->query($requeteAteliersMobile);
  $nombreAteliersMobile = $reponseAteliersMobile->rowCount();
  
  $i=0;
  while($donneesAteliersMobile = $reponseAteliersMobile->fetch())
  {
    $donneesPageMobile["atelierID"][$i] = $donneesAteliersMobile["ID"];
    $donneesPageMobile["atelierTitre"][$i] = $donneesAteliersMobile["titre"];
    $donneesPageMobile["atelierFilename"][$i] = $donneesAteliersMobile["filenamePhotoMobile"];
    $i++;
  }
  
  $reponseAteliersMobile->closeCursor();
  
  /*echo "<pre>";
  print_r($donneesPageMobile);
  echo "</pre>";*/
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion ateliers</title>
    
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'final' => 'Gestion des ateliers'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <h1>Gestion des ateliers</h1>
    
    <!--____________________________ Atelier Nubes ____________________________-->
    
    <h3>Gérer l'atelier d'improvisation Nubes</h3>
    <br />
    <table>
      <tr>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
      <tr>
        <td><?php echo $donneesPage['atelierTitre'][0];?></td>
        <td><a href="nubesGestion.php"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td>Vous ne pouvez pas supprimer cet atelier.</td>
      </tr>
    </table>
    <p><a href="nubesListeParticipants.php" class="ahref">> Voir la liste des adhérents ayant signalé leur présence au prochain atelier Nubes</a></p>
    
    <!--____________________________ Ateliers non supprimables ____________________________-->
   
    <h3>Gérer les ateliers TransFORME, Neruda et Malval</h3>

    <br />
    <table>
      <tr>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
      <?php     
        for($i=1;$i<$nombreAteliers;$i++)
        {
      ?>
      <tr>
        <td><?php echo $donneesPage['atelierTitre'][$i];?></td>
        <td><a href="ateliersModif.php?atelierID=<?php echo $donneesPage['atelierID'][$i];?>"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td>Vous ne pouvez pas supprimer cet atelier.</td>
      </tr>
      <?php
        }
      ?> 
    </table>
        
    <!--____________________________ Autres ateliers ____________________________-->
   
    <h3>Gérer les autres ateliers</h3>
    
    <?php
      // S'il y a au mois 1 autre atelier, on l'affiche
      if($nombreAutresAteliers > 0)
      {
    ?>
    <table>
      <tr>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>               
      </tr>
      <?php     
        for($i=0;$i<$nombreAutresAteliers;$i++)
        {
      ?>
      <tr>
        <td><?php echo $donneesPageAutres['atelierTitre'][$i];?></td>
        <td><a href="ateliersModif.php?atelierID=<?php echo $donneesPageAutres['atelierID'][$i];?>">
          <img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td><a href="ateliersSupp.php?atelierID=<?php echo $donneesPageAutres['atelierID'][$i];?>">
          <img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg" /></a></td>
      </tr>
      <?php
        }
      ?>    
    </table>
    <?php
      }
      else echo "Vous n'avez pas encore enregistré d'atelier.";  
    ?>
    <p><a href="ateliersAjout.php" class="ahref">> Ajouter un nouvel atelier</a></p>
            
    <h2>Gestion des photos mobiles associées aux ateliers</h2>

    <table>
      <tr>
        <th>Titre</th>
        <th>Photo enregistrée</th>
        <th>Ajouter des photos</th>
      </tr> 
      <?php      
        for($i=0;$i<$nombreAteliersMobile;$i++)
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donneesPageMobile['atelierTitre'][$i];?></td>
        <td>
          <?php 
            // Pour chaque photo recensée, on regarde si elle est associée à la création en cours
        
            if($donneesPageMobile["atelierFilename"][$i] !== NULL AND $donneesPageMobile["atelierFilename"][$i] !==""){     
            echo "OK";
            }
            else  
            {
            echo "Il faut au moins 1 photo";
            }
          ?>
        </td>
        <td>
          <a href="ateliersPhotosMobilesGestion.php?ID=<?php echo $donneesPageMobile['atelierID'][$i];?>" 
                class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg"  /></a>
        </td>
      </tr>
      <?php
        } // fin du for
      ?>
    </table>
    
  </div>

</body>
</html>