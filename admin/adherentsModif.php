<?php
  include_once ("inc/include.inc.php");

  //On récupère l'ID dans la barre d'adresse
  if(isset($_GET['ID']))  $ID = $_GET["ID"];
  if(isset($_POST['ID']))  $ID = $_POST["ID"];
  // On récupère tout le contenu de la table adhérent
  $requete="SELECT * FROM adherents WHERE ID = ".$ID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);

  // On affiche chaque entrée une à une
  $donnees = $reponse->fetch();
    
  // Update infos adhérent
  if(isset($_POST['flag']) AND $_POST['flag']==1 )
  {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $niveau = "adherent";
    $ville = $_POST["ville"];
    $telephone = $_POST["telephone"];
    $mail = $_POST["mail"];
    $numeroAdherent = $_POST["numeroAdherent"];
    $login = $_POST["login"];
    $atelier = $_POST["atelier"];
    
    $req = $bdd->prepare("UPDATE adherents SET nom = :nom, prenom = :prenom, adresse = :adresse, niveau = :niveau, ville = :ville, telephone = :telephone, mail = :mail, numeroAdherent = :numeroAdherent, login = :login, atelier = :atelier WHERE ID = :ID");
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
    'atelier' => $atelier,
    'ID' => $ID
    ));
    
     // envoi à accueil.php
    header("Location:adherentsGestion.php");
    
    $req->closeCursor(); // Termine le traitement de la requête
    $reponse->closeCursor();
  }

  // Réinitialisation mot de passe adhérent
  if(isset($_POST['flag2']) AND $_POST['flag2']==1 )
  {
    $motDePasse = md5($_POST["motDePasse"]);
    
    $req = $bdd->prepare("UPDATE adherents SET motDePasse = :motDePasse WHERE ID = :ID");
    $req->execute(array(

    'motDePasse' => $motDePasse,
    'ID' => $ID
    ));
    
     // envoi à accueil.php
    header("Location:adherentsGestion.php");
    
    $req->closeCursor(); // Termine le traitement de la requête
    $reponse->closeCursor();
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modifier un adhérent</title>

  <?php include("inc/head.inc.php");?>
</head>
<body>
  
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
  <!-- Fil d'Arianne -->
  <div class="filaire">
  <?php
     define('Compagnie_ATou', 'Accueil', true);
     get_fil_ariane(array('adherentsGestion.php' => 'Adhérents', 'final' => 'Modification d\'un adhérent'));
  ?>
  </div> <!-- fin du fil d'Arianne -->

  <?php
  if(!isset($_POST["button"]))
  {
  ?>
  <div class="halfPage filaire">
    <h1>Modifier un adhérent</h1>
    <form id="form1" name="form1" method="post" action="adherentsModif.php">
    <fieldset>
    <legend>Modification des informations d'un adhérent</legend>
      <ul>
        <li>
          <label for="nom">Entrez un nom : </label>
          <input type="text" name="nom" id="nom" value="<?php echo $donnees['nom'];?>" required>
        </li>
        <li>
          <label for="prenom">Entrez un prenom : </label>
          <input type="text" name="prenom" id="prenom" value="<?php echo $donnees['prenom']; ?>" required>
        </li>
        <li>
          <label for="adresse">Entrez une adresse :</label>
          <input type="text" name="adresse" id="adresse" value="<?php echo $donnees['adresse']; ?>">
        </li>
        <li>
          <label for="ville">Entrez une ville : </label>
          <input type="text" name="ville" id="ville" value="<?php echo $donnees['ville']; ?>">
        </li>
        <li>
          <label for="telephone">Entrez un numero de telephone : </label>
          <input type="text" name="telephone" id="telephone" value="<?php echo $donnees['telephone']; ?>">
        </li>
        <li>
          <label for="mail">Entrez un email : </label>
          <input type="text" name="mail" id="mail" value="<?php echo $donnees['mail'];?>" required>
        </li>
        <li>
          <label for="numeroAdherent">Entrez un numero d'adherent : </label>
          <input type="text" name="numeroAdherent" id="numeroAdherent" value="<?php echo $donnees['numeroAdherent'];?>">
        </li>
        <li>
          <label for="login">Entrez un login :</label>
          <input type="text" name="login" id="login" value="<?php echo $donnees['login']; ?>" required>
        </li>
        <li>
          <label for="motDePasse">Mot de passe (non modifiable) : </label>
          <input type="text" name="motDePasse" id="motDePasse" value="<?php echo $donnees['motDePasse'];?>" disabled>
        </li>
        <li>
          <label for="atelier">Entrez un atelier : </label>
          <input type="text" name="atelier" id="atelier" value="<?php echo $donnees['atelier'];?>">
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

    <form id="form2" name="form2" method="post" action="adherentsModif.php">
    <fieldset>
    <legend>Réinitialisation du mot de passe d'un adhérent</legend>
      <ul>
        <li>
          <label for="motDePasse">Entrez un nouveau mot de passe : </label>
          <input type="text" name="motDePasse" id="motDePasse" required>
        </li>
        <li>
          <input type="submit" name="button2" id="button2" value="Réinitialiser le mot de passe" class="button-grand">
        </li>
        <li>
          <input type="hidden" name="flag2" id="flag2" value="1">
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
