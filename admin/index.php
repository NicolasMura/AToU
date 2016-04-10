<?php
  include_once ("inc/include.inc.php");

  if(isset($_POST["button"]))
  {
    if(isset($_POST['login']) AND $_POST["login"] != ''
      AND isset($_POST['pass'])  AND $_POST["pass"] != '')
    {
      $login = $_POST["login"];
      $pass  = md5($_POST["pass"]);
      $requeteSql="SELECT login, motDePasse, niveau FROM administrateurs WHERE login='".$login."' AND motDePasse='".$pass."'";
      $reponse = $bdd->query($requeteSql); // exécution de la requête sql
      $donnees = $reponse->fetch(); //récupérer résultats de la requête Mysql et mis dans une variable $donnees
      
      if($pass==$donnees["motDePasse"] AND $login==$donnees["login"])
      {
        // On vérifie qu'une demande de réinitilisation de mot de passe n'est pas en cours
        if($donnees["niveau"] == "admin")
        {
          //declare two session variables and assign them
          $_SESSION['MM_Username'] = $donnees["login"];
          $_SESSION['MM_UserGroup'] = $donnees["niveau"];
          $reponse-> closeCursor();

          // envoi à accueil.php
          header("Location:accueil.php");
        }
        else $erreur = "<span style='color:red'>Désolé, une demande de réinitialisation de votre mot de passe a bien été confirmée mais vous n'avez pas encore procédé à l'enregistrement de votre nouveau mot de passe : veuillez consultez votre messagerie.</span><br>";
      }
      else
      {
        // sinon envoi à loginErreur.php
        header("Location:loginErreur.php?mdp=erreur");
      }
    }
    else $erreur = "<span style='color:red'>Tous les champs sont requis.</span><br>";
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login administrateur</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>

  <!-- <p style="color:red">L'accès au back-office est temporairement indisponible.</p> -->
  <form name="form1" method="POST" action="index.php">
    <fieldset>
    <legend>Accès à l'espace d'administration</legend>
    <?php
      if(isset($_GET["mdp"]) AND $_GET["mdp"] == "demandeReset") echo "<span style='color:green'>Votre demande de réinitilisation de mot passe a bien été enregistrée ! Vous allez recevoir un mail pour confirmer cette demande.</span><br>";
      if(isset($_GET["mdp"]) AND $_GET["mdp"] == "confOK") echo "<span style='color:green'>Votre nouveau mot passe a bien été enregistré ! Vous pouvez désormais vous connecter à votre espace d'administration.</span><br>";
      if(isset($_GET["login"]) AND $_GET["login"] == "recover") echo "<span style='color:green'>Votre demande a bien été prise en compte. Vous allez recevoir un mail.</span><br>";
      if(isset($erreur)) echo $erreur;
    ?>
    <p>
      <label for="login">Entrez votre login : </label>
      <input type="text" name="login" id="login" required>
    </p>
    <p>
      <label for="pass">Entrez votre mot de passe : </label>
      <input type="password" name="pass" id="pass" required>
    </p>
    <p>
      <input type="submit" name="button" id="button" value="Envoyer">
    </p>
    </fieldset>
  </form>

</body>
</html>