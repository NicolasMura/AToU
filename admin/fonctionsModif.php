<?php
  include_once ("inc/include.inc.php");
  
  ####################################################
  //On récupère l'ID dans la barre d'adresse
  if(isset($_GET['ID']))  $ID = $_GET["ID"];
  // On récupère tout le contenu des tables fonctions et fonctions_en
  $requete="SELECT * FROM fonctions WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);

  $requeteEn="SELECT * FROM fonctions_en WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponseEn = $bdd->query($requeteEn);

  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();
  $donneesEn = $reponseEn->fetch();
    
  if(isset($_POST['flag']) AND $_POST['flag']==1 AND (isset($ID)) AND ($ID != "")) 
  {
    $metiers = $_POST["metiers-fr"];
    $metiersEn = ($_POST["metiers-en"] != "") ? $_POST["metiers-en"] : $_POST["metiers-fr"];
    
    $req = $bdd->prepare("UPDATE fonctions SET metiers = :metiers WHERE ID = :ID");
    $req->execute(array(

    'metiers' => $metiers,
    'ID' => $ID
    ));

    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE fonctions_en SET metiers = :metiersEn WHERE ID = :ID");
    $reqEn->execute(array(

    'metiersEn' => $metiersEn,
    'ID' => $ID
    ));
    
     // envoi à accueil.php
    header("Location:cieAtouGestion.php");
    
    $reqEn->closeCursor(); // Termine le traitement de la requête

    $reponse->closeCursor();
    
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification d'une fonction</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>
<?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('cieAtouGestion.php' => 'Cie Atou', 'final' => 'Modification d\' une fonction'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <?php
      if(!isset($_POST["button"]))
      {
    ?>

    <div class="halfPage filaire">
      <h1>Modifier une fonction</h1>
      <?php include('inc/choix-langue.php');?>
      <form id="form1" name="form1" method="post" action="">
      <fieldset>
      <legend> Modification d'une fonction </legend>
      <ul>
        <li>
          <label for="nom">Modifier la fonction : </label>
          <input type="text" name="metiers-fr" id="metiers-fr" value="<?php echo $donnees['metiers'];?>" required>
          <input type="text" name="metiers-en" id="metiers-en" value="<?php echo $donneesEn['metiers'];?>">
        </li>
        <li>
          <input type="submit" name="button" id="button" value="Enregistrer la modification" class="button-grand">
        </li>
        <li>
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID']; ?>">
        </li>
      </ul>
      </form>
    </div>
    <?php
      }
    ?>

  </div>

  <script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/admin/tools/toolsLang.js" charset="utf-8"></script>

</body>
</html>