<?php 
  include_once ("inc/include.inc.php");

  if(isset($_POST["button"]))
  {
    if(isset($_POST['mail']) AND $_POST["mail"] != '')
    {
      $mail = $_POST['mail'];
      // Requete vers la base
      $query = 'SELECT mail FROM administrateurs WHERE mail="'.$mail.'"';
      $reponse = $bdd->query($query);
      $res = $reponse->fetch();

      // Si le mail a été trouvé dans la base
      if($mail == $res["mail"])
      {
        if($pass == $passConf)
        {
          // Génération d'une clé unique pour la confirmation
          $cleConf = md5(rand(1000, 2000));

          $req = $bdd->prepare("UPDATE administrateurs SET niveau = :niveau, cleConf = :cleConf WHERE mail = :mail");
          $req->execute(array(

          'niveau' => "0",
          'cleConf' => $cleConf,
          'mail' => $mail
          ));

          //Envoi d'un message pour la confirmation
          $obj="Back-office AToU - Réinitialisation de votre mot de passe";
          $mess="Bonjour, \r\n <br />Vous avez demandé la réinitialisation de votre mot de passe. Veuillez cliquer sur le lien ci-dessous pour confirmer votre demande : \r\n <br />";
          $mess.="-----------------------<br />"; 
          if($_SERVER["HTTP_HOST"] == "atou.fr" OR $_SERVER["HTTP_HOST"] == "www.atou.fr")
          {
            $mess.="<a href='http://atou.fr/admin/loginResetPasswordConf.php?mail=".EMAIL_ATOU_ADMIN."&cleConf=".$cleConf."'>Réinitialisation du mot de passe administrateur</a> \r\n <br />";
          }
          elseif($_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh")
          {
            $mess.="<a href='http://nicolasmura.ovh/projets/AToU/admin/loginResetPasswordConf.php?mail=".EMAIL_ATOU_ADMIN."&cleConf=".$cleConf."'>Réinitialisation du mot de passe administrateur</a> \r\n <br />";
          } 
          $mess.="-----------------------<br /> \r\n";
          
          $mailfrom = $res['mail'];
          $namefrom="EMETTEUR";
          $mailto=EMAIL_ATOU_ADMIN; 
          $nameto="DESTINATAIRE";     

          if(($mailto!="")&&($mailto!=NULL))  
          {
            mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
            $req->closeCursor(); // Termine le traitement de la requête
            header("Location:index.php?mdp=demandeReset");
          }
        }
        else $erreur = "<span style='color:red'>Erreur : les mots de passe que vous avez entrés ne correspondent pas : veuillez réessayer.</span><br>";
      }
      else $erreur = "<span style='color:red'>Erreur : email inconnu. Veuillez saisir une adresse mail valide.</span><br>";
    }
    else $erreur = "<span style='color:red'>Tous les champs sont requis.</span><br>";
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Réinitialisation du mot de passe administrateur</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>
  <div id="container">

  <br/>
  <br/>
  <form name="form1" method="post" action="loginResetPassword.php">
  <fieldset>
  <legend>Réinitialisation du mot de passe administrateur</legend>
    <?php 
      if(isset($erreur)) echo $erreur."<br>";
    ?>
    <span id="sprytextfield1">
    <label for="mail">Entrez votre mail :</label>
    <input type="text" name="mail" id="mail" value="<?php if(isset($_POST['mail'])) echo $_POST['mail']?>" required>
    <span class="textfieldRequiredMsg">Une valeur est requise.</span><span class="textfieldInvalidFormatMsg">Format non valide.</span></span>
    <br>
    <p>
      <input type="submit" name="button" id="button" value="Envoyer">
    </p>
  </fieldset>
  </form> 
    
  <script type="text/javascript">
  var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
  </script>
  </div>
</body>
</html>