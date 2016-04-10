<?php
  include_once ("inc/include.inc.php");
  
  /* --------------------------------------------------- Suppression d'un message ---------------------------------------------- */
  
  if(isset($_GET["ID"]))
  {
    // On récupère l'ID du message à supprimer
    $IdMessage= $_GET["ID"];
        
    // On récupère tout le contenu du message
    $requete = "SELECT * FROM messages WHERE ID = ".$IdMessage;
    $reponse = $bdd->query($requete);
    $donnees = $reponse->fetch();
    
    if(($IdMessage != "") && (isset($_GET['supp'])) )
    {
      //Requete SQL pour supprimer le message dans la base
      $req = $bdd->query("DELETE FROM messages WHERE ID = ".$IdMessage) or die(mysql_error());
      $req-> closeCursor();
      header("Location:discussionGestion.php");
    }
  }
  else
  {
  // S'il n'y a rien à récupérer, on redirige vers la gestion de la discussion
  header("Location:discussionGestion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suppression d'un message</title>
  
  <?php include("inc/head.inc.php");?>
  
  <style>
    p.erreur{
      color:red;
    }
    p.success{
      color:green;
    }
  </style>
</head>

<body class="supp">
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <h1>Suppression d'un message</h1>
    
    <?php
      if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";
      else
      {
    ?>
    <p>Attention, vous allez supprimer le message ci-dessous :</p>
    <p class="grosTitre"><?php echo $donnees['commentaires']; ?></p>
    <p>Pour supprimer ce message définitivement, cliquez sur :</p>
    <p><a href="discussionMessagesSupp.php?ID=<?php echo $donnees['ID']; ?>&amp;supp=ok" class="ahref">SUPPRIMER</a></p>
    <?php
      }
    ?>
  </div>

</body>
</html>