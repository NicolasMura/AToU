<?php
  include_once ("inc/include.inc.php");
  
  // On récupère l'ID du message à modifier, ainsi que l'ID de l'auteur du message
  if(isset($_GET["ID"]))
  {
    $id = $_GET["ID"];
  }
  else
  {
    if(isset($_POST["ID"]))
    {
      $id = $_POST["ID"];
    }
    // S'il n'y a rien à récupérer (= il manque un des deux paramètres), on redirige vers la gestion de la discussion
    else header("Location:discussionGestion.php");
  }
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["commentaire"]) AND $_POST["commentaire"]!="")
    {
      $commentaire = $_POST["commentaire"];
      
      $requete = "UPDATE messages SET commentaires = ? WHERE ID = ".$id;
      $req = $bdd->prepare($requete);
      $req->execute(array($commentaire)) or die(print_r($req->errorInfo()));
      $req->closeCursor();
      header("Location:discussionGestion.php");
    }
    else
    {
      $erreurTexte = "Il n'est pas possible d'enregistrer un commentaire vide.";
    }
  }
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  if(isset($_GET["ID"]) or isset($_POST["ID"]))
  {   
    // Initialisation du tableau contenant les données à afficher sur la page
    $donneesPage = array(
      "messagesID",
      "messagesDate",
      "messagesTexte",
      "messageAuteur"
      );
  
    $requeteMessage = "SELECT ID, dates, commentaires FROM messages WHERE ID = " . $id;
    $reponseMessage = $bdd->query($requeteMessage);
    $nombreMessages = $reponseMessage->rowCount();
    echo "Nombre de messages (normalement 1) :" .$nombreMessages;
    $donneesMessage = $reponseMessage->fetch();
  
    $donneesPage["messageID"] = $donneesMessage["ID"];
    $donneesPage["messageTexte"] = $donneesMessage["commentaires"];
  
    $reponseMessage->closeCursor();
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modération d'un commentaire</title>
  
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <h1>Modération du commentaire</h1>
    
    <form id="form1" name="form1" method="post" action="discussionMessagesModif.php">
    <fieldset>
    <legend>Modération du commentaire</legend>        
      <ul>
        <li>
            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" class="jqte-test" id="commentaire"><?php if(isset($donneesPage["messageTexte"])) echo $donneesPage["messageTexte"];?></textarea>
        </li> 

       <?php if(isset($erreurTexte)) echo "<p class='erreur'>" . $erreurTexte . "</p>";?>
      
        <li>
            <input type="submit" name="button1" id="button1" value="Modifier le commentaire" />
        </li>
        <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
            <input type="hidden" name="ID" id="ID" value="<?php if(isset($_GET['ID'])) echo $_GET['ID'];
                            if(isset($_POST['ID'])) echo $_POST['ID']; ?>">
        </li>
      </ul>
    </fieldset>
    </form>
        
  </div>

</body>
</html>