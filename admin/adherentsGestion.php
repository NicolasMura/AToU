<?php
  include_once ("inc/include.inc.php");

  // On récupère tout le contenu de la table adhérent
  $reponse = $bdd->query('SELECT * FROM adherents');
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion des adhérents</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php');?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('final' => 'Adhérents'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <h1>Gestion des adhérents</h1>
    <br>
    <table>
      <tr>
        <th>ID</th>
        <th>nom</th>
        <th>prenom</th>
        <th>adresse</th>
        <th>ville</th>
        <th>telephone</th>
        <th>mail</th>
        <th>numero adherent</th>
        <th>login</th>
        <th>atelier</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
      <?php
        // On affiche chaque entrée une à une
        while ($donnees = $reponse->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donnees['ID'];?></td>
        <td class="cellule"><?php echo $donnees['nom'];?></td>
        <td class="cellule"><?php echo $donnees['prenom'];?></td>
        <td class="cellule"><?php echo $donnees['adresse'];?></td>
        <td class="cellule"><?php echo $donnees['ville'];?></td>
        <td class="cellule"><?php echo $donnees['telephone'];?></td>
        <td class="cellule"><?php echo $donnees['mail'];?></td>
        <td class="cellule"><?php echo $donnees['numeroAdherent'];?></td>
        <td class="cellule"><?php echo $donnees['login'];?></td>
        <td class="cellule"><?php echo $donnees['atelier'];?></td>
        <td class="cellule">
          <a href="adherentsModif.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a>
        </td>
        <td class="cellule">
          <a href="adherentsSupp.php?ID=<?php echo $donnees['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a>
        </td>
      </tr>
      <?php
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
      ?>
    </table>
    <p><a href="adherentsAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter un adhérent</a></p>
  </div>
</body>
</html>