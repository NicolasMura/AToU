<?php
  include_once ("inc/include.inc.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion de l'espace adhérent</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);
      get_fil_ariane(array('final' => 'Espace adhérents'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
        
    <h1>Gestion de l'espace adhérents</h1>
        
    <div>
      <ul>
        <li>
          <a href="ateliersGestion.php" class="ahref">Gestion des ateliers</a>
        </li>
        <li>
          <a href="discussionGestion.php" class="ahref">Gestion du carnet de bord</a>
        </li>
        <li>
          <a href="galerieGestion.php" class="ahref">Gestion de la galerie photo</a>
        </li>
        <br/>
      </ul>
    </div>

  </div>

</body>
</html>