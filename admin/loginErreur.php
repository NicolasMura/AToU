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
  <title>Login administrateur - erreur</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>

  <form name="form1" method="POST" action="loginErreur.php">
    <fieldset>
    <legend>Accès à l'espace d'administration</legend>
    <?php if(isset($_GET["mdp"]) AND isset($_GET["mdp"]) == "erreur") echo "<span style='color:red'>Le login ou mot de passe indiqué est incorrect. Merci de les saisir à nouveau.</span><br><br>"?>
    <?php if(isset($erreur)) echo $erreur;?>
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
    <p>
      <br><a href="loginRecover.php">Vous avez oublié votre login?</a>
    </p>
    <p>
      <br><a href="loginResetPassword.php">Vous avez oublié votre mot de passe?</a>
    </p>
    </fieldset>
  </form>

</body>
</html>