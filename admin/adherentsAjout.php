<?php
  include_once ("inc/include.inc.php");

  if(isset($_POST['flag']) AND $_POST['flag']==1)
  {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $niveau = $_POST["niveau"];
    $ville = $_POST["ville"];
    $telephone = $_POST["telephone"];
    $mail = $_POST["mail"];
    $numeroAdherent = $_POST["numeroAdherent"];
    $login = $_POST["login"];
    $motDePasse = md5($_POST["motDePasse"]);
    $atelier = $_POST["atelier"];
    

    $req= $bdd->prepare('INSERT INTO adherents (nom, prenom, adresse, niveau, ville, telephone, mail, numeroAdherent, login, motDePasse, atelier) VALUES (:nom, :prenom, :adresse, :niveau, :ville, :telephone, :mail, :numeroAdherent, :login, :motDePasse, :atelier)');

    $req->execute(array(

    'nom' => $nom,
    'prenom' => $prenom,
    'adresse' => $adresse,
    'niveau' => $niveau,
    'ville' => $ville,
    'telephone' => $telephone,
    'mail' => $mail,
    'numeroAdherent' => $numeroAdherent,
    'login' => $login,
    'motDePasse' => $motDePasse,
    'atelier' => $atelier,

    ));
    header("Location:adherentsGestion.php");
    $req->closeCursor(); // Termine le traitement de la requête
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajouter un adhérent</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>

  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       get_fil_ariane(array('adherentsGestion.php' => 'Adhérents', 'final' => 'Ajout d\' un adhérent'));
    ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <?php
    if(!isset($_POST["button"]))
    {
    ?>
    <div class="halfPage filaire">
      <h1>Ajouter un adhérent</h1>
      <form name="form1" method="post" action="adherentsAjout.php">
      <fieldset>
      <legend> Ajout d'un adhérent </legend>
        <ul>
          <li>
            <label for="nom">Entrez un nom : </label>
            <input type="text" name="nom" id="nom" required>
          </li>
          <li>
            <label for="prenom">Entrez un prenom : </label>
            <input type="text" name="prenom" id="prenom" required>
          </li>
          <li>
            <label for="adresse">Entrez une adresse :</label>
            <input type="text" name="adresse" id="adresse">
          </li>
          <li>
            <label for="ville">Entrez une ville : </label>
            <input type="text" name="ville" id="ville">
          </li>
          <li>
            <label for="telephone">Entrez un numero de telephone : </label>
            <input type="text" name="telephone" id="telephone">
          </li>
          <li>
            <label for="mail">Entrez un email : </label>
            <input type="text" name="mail" id="mail" required>
          </li>
          <li>
            <label for="numeroAdherent">Entrez un numero d'adherent : </label>
            <input type="text" name="numeroAdherent" id="numeroAdherent">
          </li>
          <li>
            <label for="login">Entrez un login :</label>
            <input type="text" name="login" id="login" required>
          </li>
          <li>
            <label for="motDePasse">Entrez un mot de passe : </label>
            <input type="text" name="motDePasse" id="motDePasse" required>
          </li>
          <li>
            <label for="atelier">Entrez un atelier : </label>
            <input type="text" name="atelier" id="atelier">
          </li>
          <li>
            <input type="submit" name="button" id="button" value="Ajouter">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
            <input type="hidden" name="niveau" id="niveau" value="adherent"> <!-- Pour distinguer le log admin de l'adhérent -->
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
