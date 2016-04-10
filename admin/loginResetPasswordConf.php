<?php 
  include_once ("inc/include.inc.php");

  if(isset($_GET["mail"]) AND $_GET["mail"] != '' AND isset($_GET["cleConf"]) AND $_GET["cleConf"] != '')
  {
    $mail    = $_GET["mail"];
    $cleConf = $_GET['cleConf'];

    $query = 'SELECT mail, cleConf FROM administrateurs WHERE mail="'.$mail.'"';
    $reponse = $bdd->query($query);
    $donnees = $reponse->fetch();

    // Si le mail a été trouvé dans la base et si la clé récupérée en GET correspond à celle écrite en bdd
    if($mail == $donnees["mail"] AND $cleConf == $donnees["cleConf"])
    {
      if(isset($_POST["button"]))
      {
        if(isset($_POST['pass']) AND $_POST["pass"] != '' AND isset($_POST['passConf']) AND $_POST["passConf"] != '')
        {
          // Si les mots de passe correspondent
          if($_POST['pass'] == $_POST['passConf'])
          {
            $pass = md5($_POST['pass']);

            $req = $bdd->prepare("UPDATE administrateurs SET motDePasse = :motDePasse, niveau = :niveau WHERE mail = :mail");
            $req->execute(array(

            'motDePasse' => $pass,
            'niveau' => "admin",
            'mail' => $mail
            ));
            $req->closeCursor(); // Termine le traitement de la requête
            header("Location:index.php?mdp=confOK");
          }
          else $erreur = "<span style='color:red'>Erreur : les mots de passe que vous avez entrés ne correspondent pas : veuillez réessayer.</span><br>";
        }
        else $erreur = "<span style='color:red'>Tous les champs sont requis.</span><br>";
      }
    }
    else header("Location:index.php");
  }
  else header("Location:index.php");
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Réinitialisation du mot de passe administrateur - confirmation</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>
  <div id="container">

  <br/>
  <br/>
  <form name="form1" method="post" action="loginResetPasswordConf.php?mail=<?php echo $mail;?>&cleConf=<?php echo $cleConf;?>">
  <fieldset>
  <legend>Réinitialisation du mot de passe administrateur - Confirmation</legend>
    <?php 
      if(isset($erreur)) echo $erreur."<br>";
    ?>
    <label for="pass">Entrez votre nouveau mot de passe :</label>
    <input type="password" name="pass" id="pass" required>
    <br><br>
    <label for="passConf">Confirmer votre mot de passe :</label>
    <input type="password" name="passConf" id="passConf" required>
    <br>
    <p>
      <input type="submit" name="button" id="button" value="Envoyer">
    </p>
  </fieldset>
  </form> 

  </div>
</body>
</html>