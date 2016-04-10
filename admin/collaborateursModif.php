<?php
  include_once ("inc/include.inc.php");

  ####################################################
  //On récupère l'ID dans la barre d'adresse
  if(isset($_GET['ID']))  $ID = $_GET["ID"];
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM collaborateurs WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);

  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();
    
  if(isset($_POST['flag']) AND $_POST['flag']==1 AND (isset($ID)) AND ($ID != "")) 
  {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    
    $req = $bdd->prepare("UPDATE collaborateurs SET nom = :nom, prenom = :prenom WHERE ID = :ID");
    $req->execute(array(

    'nom' => $nom,
    'prenom' => $prenom,
    'ID' => $ID
    ));
    
     // envoi à accueil.php
    header("Location:cieAtouGestion.php");
    
    $req->closeCursor(); // Termine le traitement de la requête
    $reponse->closeCursor();
    
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification d'un collaborateur</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  <?php include('inc/menuAdmin.inc.php'); ?>

  <div id="container">

    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('cieAtouGestion.php' => 'Gestion de la Cie Atou','final' => 'Modification d\'un collaborateur'));
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <?php
      if(!isset($_POST["button"]))
      {
    ?>
    <div class="halfPage filaire">
      <h1>Modifier un collaborateur</h1>
      <form id="form1" name="form1" method="post" action="collaborateursModif.php?ID=<?php echo $_GET['ID']; ?>">
      <fieldset>
      <legend>Modification d'un collaborateur</legend>
       <ul>
        <li>
          <label for="nom">Entrez un nom : </label>
          <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom'];?>">
          </li>
          <li>
          <label for="prenom">Entrez un prénom : </label>
          <input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom']; ?>">
          </li>
        <li>
          <input type="submit" name="button" id="button" value="Enregistrer les modifications" class="button-grand">
          </li>
          <li>
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="ID" id="ID" value="<?php echo $_GET['ID']; ?>">
        </li>
       </ul>
      </fieldset>
      </form>
    </div>
    <?php
      }
    ?>
  </div>
</body>
</html>