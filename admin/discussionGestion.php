<?php
  include_once ("inc/include.inc.php");
  
  // Récupération de l'ID de la dernière discussion enregistrée
  $requeteDiscussionIdMax = "SELECT MAX(ID) FROM discussions";
  $reponseDiscussionIdMax = $bdd->query($requeteDiscussionIdMax);
  
  $donneesDiscussionIdMax = $reponseDiscussionIdMax->fetch();
  $discussionID = $donneesDiscussionIdMax["MAX(ID)"];
  
  // Si la dernière discussion enregistrée n'est pas active (cad qu'elle ne contient pas de titre et/ou une description et/ou un auteur),
  // on reprend les données de la discussion précédentes
  $requeteDiscussionActive = "SELECT titre, texte, auteur FROM discussions WHERE ID = " . $discussionID;
  $reponseDiscussionActive = $bdd->query($requeteDiscussionActive);
  
  $donneesDiscussionActive = $reponseDiscussionActive->fetch();
  
  if($donneesDiscussionActive["titre"] == "" OR $donneesDiscussionActive["texte"] == "" OR $donneesDiscussionActive["auteur"] == "")
  {
    $discussionID = $donneesDiscussionIdMax["MAX(ID)"] - 1;
  }
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["discussionTitre"]) AND $_POST["discussionTitre"]!=""
      AND isset($_POST["discussionTexte"]) AND $_POST["discussionTexte"]!=""
      AND isset($_POST["discussionAuteur"]) AND $_POST["discussionAuteur"]!="")
    {
      $titre = $_POST["discussionTitre"];
      $texte = $_POST["discussionTexte"];
      $auteur = $_POST["discussionAuteur"];
      
      $requete="UPDATE discussions SET titre = ?, texte = ?, auteur = ? WHERE ID = " . $discussionID;
      $req = $bdd->prepare($requete);
      $req->execute(array($titre, $texte, $auteur)) or die(print_r($req->errorInfo()));
      $req->closeCursor();
      $messageTexteOK = "Vos modifications ont bien été prises en compte.";
    }
    else
    {
      $erreurTexte = "Vous devez entrer un titre, une description et un auteur avant de valider.";
    }
  }
  
  if(isset($_POST['flag2']) AND $_POST['flag2']==1 AND isset($_POST['button2']))
  {
    if(isset($_POST["date"]) AND $_POST["date"]!="")
    {
      $dates = $_POST["date"];
      $heureDebut = $_POST["heureDebut"] . ":" . $_POST["minuteDebut"];
      $heureFin = $_POST["heureFin"] . ":" . $_POST["minuteFin"];
      
      // Si la date entrée n'existe pas déjà en base de données, on l'enregistre
      $requeteDateTmp = "SELECT id FROM nubes WHERE dates='".$dates."'";
      $reponseDateTmp = $bdd->query($requeteDateTmp);
      $nombreResultatsTmp = $reponseDateTmp->rowCount();
      $reponseDateTmp->closeCursor();
      if($nombreResultatsTmp < 1)
      {
        $requete="INSERT INTO nubes (dates, heureDebut, heureFin) VALUES(?, ?, ?)";
        $req = $bdd->prepare($requete);
        $req->execute(array($dates, $heureDebut, $heureFin)) or die(print_r($req->errorInfo()));

        $req->closeCursor();
        $messageDateOK = "La date a bien été ajoutée.";
      }
      else
      {
        $erreurDate = "Vous avez déjà été enregistré cette date.";
      }
    }
    else
    {
      $erreurDate = "Vous devez entrer une date avant de l'ajouter.";
    }
  }
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  // Initialisation du tableau contenant les données à afficher sur la page
  $donneesPage = array(
    "discussionID",
    "discussionTitre",
    "discussionTexte",
    "discussionAuteur",
    "messagesID" => array(), // A passer en paramètre POST pour la modification ou la suppression d'un commentaire
    "messagesDate" => array(),
    "messagesTexte" => array(),
    "messagesAuteur" => array(),
    );
  
  $requeteDiscussion = "SELECT ID, titre, texte, auteur FROM discussions WHERE ID = " . $discussionID;
  $reponseDiscussion = $bdd->query($requeteDiscussion);
  
  $donneesDiscussion = $reponseDiscussion->fetch();
  
  // On vérifie que la dernière discussion enregistrée est active (cad qu'elle contient bien un titre, une description et un auteur)
  if($donneesDiscussion["titre"] != "" AND $donneesDiscussion["texte"] != "" AND $donneesDiscussion["auteur"] != "")
  {
    $donneesPage["discussionID"] = $donneesDiscussion["ID"];
    $donneesPage["discussionTitre"] = $donneesDiscussion["titre"];
    $donneesPage["discussionTexte"] = $donneesDiscussion["texte"];
    $donneesPage["discussionAuteur"] = $donneesDiscussion["auteur"];
    
    $reponseDiscussion->closeCursor();
  }
  // Sinon on reprend les données de la discussion précédente
  else
  {
    $discussionID = $discussionID - 1;
    $requeteDiscussion = "SELECT ID, titre, texte, auteur FROM discussions WHERE ID = " . $discussionID;
    $reponseDiscussion = $bdd->query($requeteDiscussion);
    
    $donneesDiscussion = $reponseDiscussion->fetch();
  
    $donneesPage["discussionID"] = $donneesDiscussion["ID"];
    $donneesPage["discussionTitre"] = $donneesDiscussion["titre"];
    $donneesPage["discussionTexte"] = $donneesDiscussion["texte"];
    $donneesPage["discussionAuteur"] = $donneesDiscussion["auteur"];
    
    $reponseDiscussion->closeCursor();
  }
    
  $requeteMessages = "SELECT M.ID messagesID , M.dates, M.commentaires, M.adherentsID, A.ID, A.nom
            FROM messages M, adherents A
            WHERE M.discussionsID = " . $discussionID . " AND M.adherentsID = A.ID
            ORDER BY M.dates DESC";
  $reponseMessages = $bdd->query($requeteMessages);
  $nombreMessages = $reponseMessages->rowCount();
  
  $i=0;
  while($donneesMessages = $reponseMessages->fetch())
  {
    $donneesPage["messagesID"][$i] = $donneesMessages["messagesID"];
    $donneesPage["messagesDate"][$i] = $donneesMessages["dates"];
    $donneesPage["messagesTexte"][$i] = $donneesMessages["commentaires"];
    $donneesPage["messagesAuteur"][$i] = $donneesMessages["nom"];
    $i++;
  }
  
  $reponseMessages->closeCursor();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion du carnet de bord</title>
    
  <?php include("inc/head.inc.php");?>

  <style>
    textarea{
      width: 400px;
    }
  </style>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'final' => 'Gestion du carnet de bord'));
      ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <h1>Gestion du carnet de bord</h1>
      
    <p><a href="discussionAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Commencer une nouvelle discussion.</a></p>
    <p>Attention, la création d'une nouvelle discussion entraîne la suppression de la discussion en cours, ainsi que de tous les commentaires associés.</p>
    
    <div class="halfPage filaire">
      <form id="form1" name="form1" method="post" action="discussionGestion.php">
      <fieldset>
      <legend>Modification de la discussion en cours</legend>        
        <ul>
          <li>   
            <label for="discussionTitre">Titre</label>
            <input type="text" name="discussionTitre" id="discussionTitre" value="<?php echo $donneesPage["discussionTitre"];?>" required>
          </li>
          <li>
            <label for="discussionTexte">Description</label>
            <textarea name="discussionTexte" class="jqte-test" id="discussionTexte" rows="5"><?php echo $donneesPage["discussionTexte"];?></textarea>
          </li>
          <li>   
            <label for="discussionAuteur">Auteur</label>
            <input type="text" name="discussionAuteur" id="discussionAuteur" value="<?php echo $donneesPage["discussionAuteur"];?>" required>
          </li>

          <?php if(isset($messageTexteOK)) echo "<p class='success'>" . $messageTexteOK . "</p>";?>
          <?php if(isset($messageAvertissement)) echo "<p class='success'>" . $messageAvertissement. "</p>";?>
          <?php if(isset($erreurTexte)) echo "<p class='erreur'>" . $erreurTexte . "</p>";?>
      
          <li>
            <input type="submit" name="button1" id="button1" value="Enregistrer les modifications" class="button-grand"/>
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
      
      <?php
        // S'il y a au mois 1 commentaire, on l'affiche
        if($nombreMessages > 0)
        {
      ?>
      <h2>Liste des commentaires associés à cette discussion :</h2>
      <table>
        <tr>
          <th>Date</th>
          <th>Auteur</th>
          <th>Commentaire</th>
          <th>Modifier</th>
          <th>Supprimer</th>               
        </tr>
          <?php     
            for($i=0;$i<$nombreMessages;$i++)
            {
          ?>
        <tr>
          <td><?php echo $donneesPage['messagesDate'][$i];?></td>
          <td><?php echo $donneesPage['messagesAuteur'][$i];?></td>
          <td><?php echo $donneesPage['messagesTexte'][$i];?></td>
          <td><a href="discussionMessagesModif.php?ID=<?php echo $donneesPage['messagesID'][$i];?>"><img class="icons" src="../img/atouIconModify.jpg" /></a></td>
          <td><a href="discussionMessagesSupp.php?ID=<?php echo $donneesPage['messagesID'][$i];?>"><img class="icons" src="../img/atouIconDelete.jpg" /></a></td>
        </tr>
          <?php
            }
          ?>    
      </table>
      <?php
          }
          else echo "Il n'y a aucun commentaire existant pour cette discussion.";
      ?>
    </div>
  </div>

</body>
</html>