<?php 
  include_once ("inc/include.inc.php");

  if(isset($_POST["button"]))
  {
    if(isset($_POST['mail']) AND $_POST["mail"] != '')
    {
      $mail=$_POST["mail"];
      
      // Requete vers la base
      $query = 'SELECT login, mail FROM administrateurs WHERE mail="'.$mail.'"';
      $reponse = $bdd->query($query);
      
      if($reponse)
      {
        $res = $reponse->fetch();
        // Si le mail a été trouvé dans la base
        if($res["mail"])
        {
          //Envoi d'un message pour la confirmation
          $obj="Back-office AToU - Récupération de votre login";
          $mess="Bonjour, \r\n <br />Voici votre login de connexion à l'espace d'administration : \r\n <br />";
          $mess.="-----------------------<br />"; 
          $mess.=$res["login"]." \r\n <br />";  
          $mess.="-----------------------<br /> \r\n";
          
          $mailfrom = $res['mail'];
          $namefrom="EMETTEUR";
          $mailto=EMAIL_ATOU_ADMIN; 
          $nameto="DESTINATAIRE";

          if(($mailto!="")&&($mailto!=NULL))  
          {
            mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
            $reponse->closeCursor(); // Termine le traitement de la requête
            header("Location:index.php?login=recover");
          }
        }
        else $erreur = "<span style='color:red'>Erreur : email inconnu. Veuillez saisir une adresse mail valide.</span><br>";
      }
    }
    else $erreur = "<span style='color:red'>Veuillez entrer votre adresse mail.</span><br>";
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login recover</title>

  <?php include("inc/head.inc.php");?>
</head>

<body>
  
  <div id="container">
    <br/>
    <br/>
    <form name="form1" method="post" action="loginRecover.php">
    <fieldset>
    <legend>Récupération de login</legend>
      <?php 
        if(isset($erreur)) echo $erreur."<br>";
      ?>
      <span id="sprytextfield1">
      <label for="mail">Entrez votre mail :</label>
      <input type="text" name="mail" id="mail" value="<?php if(isset($_POST['mail'])) echo $_POST['mail']?>" required>
      <span class="textfieldRequiredMsg">Une valeur est requise.</span><span class="textfieldInvalidFormatMsg">Format non valide.</span></span>
      <br><br>
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





