<?php
  include_once ("inc/include.inc.php");
  
  // update des tables compagnie et compagnie_en
  if(isset($_POST['flag0']) AND $_POST['flag0']==1) 
  {
    $descriptionCompagnie = $_POST["descriptionCompagnie-fr"];
    $descriptionCompagnieEn = ($_POST["descriptionCompagnie-en"] != "") ? $_POST["descriptionCompagnie-en"] : $_POST["descriptionCompagnie-fr"];
    $descriptionActions = $_POST["descriptionActions-fr"];
    $descriptionActionsEn = ($_POST["descriptionActions-en"] != "") ? $_POST["descriptionActions-en"] : $_POST["descriptionActions-fr"];
    
    $req = $bdd->prepare("UPDATE compagnie SET descriptionCompagnie = :descriptionCompagnie, descriptionActions = :descriptionActions");
    $req->execute(array(
  
    'descriptionCompagnie' => $descriptionCompagnie,
    'descriptionActions' => $descriptionActions
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE compagnie_en SET descriptionCompagnie = :descriptionCompagnieEn, descriptionActions = :descriptionActionsEn");
    $reqEn->execute(array(

    'descriptionCompagnieEn' => $descriptionCompagnieEn,
    'descriptionActionsEn' => $descriptionActionsEn
    ));

    $reqEn->closeCursor(); // Termine le traitement de la requête
  }

  if(isset($_POST['flag1']) AND $_POST['flag1']==1) 
  {
    $titre1 = $_POST["titre1"];
    $sousTitre1 = $_POST["sousTitre1-fr"];
    $sousTitre1En = ($_POST["sousTitre1-en"] != "") ? $_POST["sousTitre1-en"] : $_POST["sousTitre1-fr"];
    $resume1 = $_POST["resume1-fr"];
    $resume1En = ($_POST["resume1-en"] != "") ? $_POST["resume1-en"] : $_POST["resume1-fr"];
    
    $req = $bdd->prepare("UPDATE compagnie SET titre1 = :titre1, sousTitre1 = :sousTitre1, resume1 = :resume1");
    $req->execute(array(
  
    'titre1' => $titre1,
    'sousTitre1' => $sousTitre1,
    'resume1' => $resume1
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE compagnie_en SET titre1 = :titre1, sousTitre1 = :sousTitre1En, resume1 = :resume1En");
    $reqEn->execute(array(

    'titre1' => $titre1,
    'sousTitre1En' => $sousTitre1En,
    'resume1En' => $resume1En
    ));

    $reqEn->closeCursor(); // Termine le traitement de la requête
  }
  
  if(isset($_POST['flag2']) AND $_POST['flag2']==1) 
  {
    $titre2 = $_POST["titre2"];
    $fonction2 = $_POST["fonction2-fr"];
    $fonction2En = ($_POST["fonction2-en"] != "") ? $_POST["fonction2-en"] : $_POST["fonction2-fr"];
    $sousTitre2 = $_POST["sousTitre2-fr"];
    $sousTitre2En = ($_POST["sousTitre2-en"] != "") ? $_POST["sousTitre2-en"] : $_POST["sousTitre2-fr"];
    $resume21 = $_POST["resume21-fr"];
    $resume21En = ($_POST["resume21-en"] != "") ? $_POST["resume21-en"] : $_POST["resume21-fr"];
    $resume22 = $_POST["resume22-fr"];
    $resume22En = ($_POST["resume22-en"] != "") ? $_POST["resume22-en"] : $_POST["resume22-fr"];
    
    $req = $bdd->prepare("UPDATE compagnie SET titre2 = :titre2, fonction2 = :fonction2, sousTitre2 = :sousTitre2, resume21 = :resume21, resume22 = :resume22");
    $req->execute(array(
  
    'titre2' => $titre2,
    'fonction2' => $fonction2,
    'sousTitre2' => $sousTitre2,
    'resume21' => $resume21,
    'resume22' => $resume22
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE compagnie_en SET titre2 = :titre2, fonction2 = :fonction2En, sousTitre2 = :sousTitre2En, resume21 = :resume21En, resume22 = :resume22En");
    $reqEn->execute(array(
  
    'titre2' => $titre2,
    'fonction2En' => $fonction2En,
    'sousTitre2En' => $sousTitre2En,
    'resume21En' => $resume21En,
    'resume22En' => $resume22En
    ));
    
    $reqEn->closeCursor(); // Termine le traitement de la requête
  }
  
  if(isset($_POST['flag3']) AND $_POST['flag3']==1) 
  {
    $titre3 = $_POST["titre3"];
    $fonction3 = $_POST["fonction3-fr"];
    $fonction3En = ($_POST["fonction3-en"] != "") ? $_POST["fonction3-en"] : $_POST["fonction3-fr"];
    $sousTitre3 = $_POST["sousTitre3-fr"];
    $sousTitre3En = ($_POST["sousTitre3-en"] != "") ? $_POST["sousTitre3-en"] : $_POST["sousTitre3-fr"];
    $resume3 = $_POST["resume3-fr"];
    $resume3En = ($_POST["resume3-en"] != "") ? $_POST["resume3-en"] : $_POST["resume3-fr"];
    
    $req = $bdd->prepare("UPDATE compagnie SET titre3 = :titre3, fonction3 = :fonction3, sousTitre3 = :sousTitre3, resume3 = :resume3");
    $req->execute(array(
  
    'titre3' => $titre3,
    'fonction3' => $fonction3,
    'sousTitre3' => $sousTitre3,
    'resume3' => $resume3
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête

    $reqEn = $bdd->prepare("UPDATE compagnie_en SET titre3 = :titre3, fonction3 = :fonction3En, sousTitre3 = :sousTitre3En, resume3 = :resume3En");
    $reqEn->execute(array(
  
    'titre3' => $titre3,
    'fonction3En' => $fonction3En,
    'sousTitre3En' => $sousTitre3En,
    'resume3En' => $resume3En
    ));
    
    $reqEn->closeCursor(); // Termine le traitement de la requête
  }
  
  // On récupère tout le contenu des tables compagnie et compagnie_en
  $requete="SELECT * FROM compagnie" or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  // On affiche l' entrée
  $donnees = $reponse->fetch();

  $requeteEn="SELECT * FROM compagnie_en" or die(print_r($bdd->errorInfo));
  $reponseEn = $bdd->query($requeteEn);
  // On affiche l' entrée
  $donneesEn = $reponseEn->fetch();
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion de la compagnie</title>
    
  <?php include("inc/head.inc.php");?>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <div id="container">
    <!-- Fil d'Arianne -->
    <div class="filaire">
      <?php
         define('Compagnie_ATou', 'Accueil', true);
         get_fil_ariane(array('final' => 'Cie AToU'));
      ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Modifier la page Home (accueil)</h1>
      <?php include('inc/choix-langue.php');?>
      <form id="form0" name="form0" method="post" action="cieAtouGestion.php#form0">
      <fieldset>
      <legend>Modification de la page d'accueil</legend>
        <ul>
          <li>
            <label for="descriptionCompagnie">Descriptif de la compagnie :</label>
            <input type="text" name="descriptionCompagnie-fr" id="descriptionCompagnie-fr" value="<?php if (isset($donnees['descriptionCompagnie'])) echo $donnees['descriptionCompagnie'];?>" required>
            <input type="text" name="descriptionCompagnie-en" id="descriptionCompagnie-en" value="<?php if (isset($donneesEn['descriptionCompagnie'])) echo $donneesEn['descriptionCompagnie'];?>">
          </li>      
          <li>
            <label for="descriptionActions">Descriptif des actions culturelles :</label>
            <input type="text" name="descriptionActions-fr" id="descriptionActions-fr" value="<?php if (isset($donnees['descriptionActions'])) echo $donnees['descriptionActions'];?>" required>
            <input type="text" name="descriptionActions-en" id="descriptionActions-en" value="<?php if (isset($donneesEn['descriptionActions'])) echo $donneesEn['descriptionActions'];?>">
          </li>
          <br>
          <li>
            <input type="submit" name="button0" id="button0" value="Valider les modifications" class="button-grand">
          </li>
          <p><span class="underline">Note</span> : la modification de ces descriptifs entraîne la mise à jour des versions anglaise <span class="underline">et</span> française.</p><style>
    textarea {
      width:400px;
    }
  </style>
          <li>
            <input type="hidden" name="flag0" id="flag0" value="1">
          </li>
        </ul>
      </fieldset>
      </form>

      <h1>Modifier la page compagnie</h1>
      <form id="form1" name="form1" method="post" action="cieAtouGestion.php#form1">
      <fieldset>
      <legend>Modification de la description AToU</legend>
        <ul>
          <li>
            <label for="titre1">Nom de la compagnie :</label>
            <input type="text" name="titre1" id="titre1" value="<?php if (isset($donnees['titre1'])) echo $donnees['titre1'];?>" required>
          </li>
          <li>
            <label for="sousTitre1">Sous-titre de la compagnie :</label>
            <input type="text" name="sousTitre1-fr" id="sousTitre1-fr" value="<?php if (isset($donnees['sousTitre1'])) echo $donnees['sousTitre1'];?>">
            <input type="text" name="sousTitre1-en" id="sousTitre1-en" value="<?php if (isset($donneesEn['sousTitre1'])) echo $donneesEn['sousTitre1'];?>">
          </li>              
          <li>
            <!-- jQUERY TEXT EDITOR-->
            <p>Description de la compagnie :</p>
            <textarea name="resume1-fr" class="jqte-test" id="resume1-fr"><?php if (isset($donnees['resume1'])) echo $donnees['resume1'];?></textarea>
            <textarea name="resume1-en" class="jqte-test" id="resume1-en"><?php if (isset($donneesEn['resume1'])) echo $donneesEn['resume1'];?></textarea>
            <!-- jQUERY TEXT EDITOR -->
          </li>
          <li>
            <input type="submit" name="button1" id="button1" value="Valider les modifications" class="button-grand">
          </li>
          <p><span class="underline">Note</span> : la modification de la description AToU entraînera la mise à jour de la version anglaise <span class="underline">et</span> de la version française.</p>
          <li>
              <input type="hidden" name="flag1" id="flag1" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
      
      <form id="form2" name="form2" method="post" action="cieAtouGestion.php#form2">
      <fieldset>
      <legend>Modification de la description de la personne n°1</legend>
        <ul>
          <li>
            <label for="titre2">Nom de la personne :</label>
            <input type="text" name="titre2" id="titre2" value="<?php if (isset($donnees['titre2'])) echo $donnees['titre2'];?>" required>
          </li>
          <li>
            <label for="fonction2">Fonction de la personne :</label>
            <input type="text" name="fonction2-fr" id="fonction2-fr" value="<?php if (isset($donnees['fonction2'])) echo $donnees['fonction2'];?>" required>
            <input type="text" name="fonction2-en" id="fonction2-en" value="<?php if (isset($donneesEn['fonction2'])) echo $donneesEn['fonction2'];?>">
          </li>
          <li>
            <label for="sousTitre2">Sous-titre :</label>
            <input type="text" name="sousTitre2-fr" id="sousTitre2-fr" value="<?php if (isset($donnees['sousTitre2'])) echo $donnees['sousTitre2'];?>">
            <input type="text" name="sousTitre2-en" id="sousTitre2-en" value="<?php if (isset($donneesEn['sousTitre2'])) echo $donneesEn['sousTitre2'];?>">
          </li>             
          <li>
            <!-- jQUERY TEXT EDITOR-->
            <p>Description de la personne (partie 1) :</p>
            <textarea name="resume21-fr" class="jqte-test" id="resume21-fr"><?php if (isset($donnees['resume21'])) echo $donnees['resume21'];?></textarea>
            <textarea name="resume21-en" class="jqte-test" id="resume21-en"><?php if (isset($donneesEn['resume21'])) echo $donneesEn['resume21'];?></textarea>
            <!-- jQUERY TEXT EDITOR -->
          </li>
          <li>
            <!-- jQUERY TEXT EDITOR-->
            <p>Description de la personne (partie 2) :</p>
            <textarea name="resume22-fr" class="jqte-test" id="resume22-fr"><?php if (isset($donnees['resume22'])) echo $donnees['resume22'];?></textarea>
            <textarea name="resume22-en" class="jqte-test" id="resume22-en"><?php if (isset($donneesEn['resume22'])) echo $donneesEn['resume22'];?></textarea>
            <!-- jQUERY TEXT EDITOR -->
          </li>
          <li>
            <input type="submit" name="button2" id="button2" value="Valider les modifications" class="button-grand">
          </li>
          <p><span class="underline">Note</span> : la modification de la description de la personne n°1 entraînera la mise à jour de la version anglaise <span class="underline">et</span> de la version française.</p>
          <li>
            <input type="hidden" name="flag2" id="flag2" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
      
      <form id="form3" name="form3" method="post" action="cieAtouGestion.php#form3">
      <fieldset>
      <legend>Modification de la description de la personne n°2</legend>
        <ul>
          <li>
            <label for="titre3">Nom de la personne :</label>
            <input type="text" name="titre3" id="titre3" value="<?php if (isset($donnees['titre3'])) echo $donnees['titre3'];?>" required>
          </li>
          <li>
            <label for="fonction3">Fonction de la personne :</label>
            <input type="text" name="fonction3-fr" id="fonction3-fr" value="<?php if (isset($donnees['fonction3'])) echo $donnees['fonction3'];?>" required>
            <input type="text" name="fonction3-en" id="fonction3-en" value="<?php if (isset($donneesEn['fonction3'])) echo $donneesEn['fonction3'];?>"
          </li>
          <li>
            <label for="sousTitre3">Sous-titre :</label>
            <input type="text" name="sousTitre3-fr" id="sousTitre3-fr" value="<?php if (isset($donnees['sousTitre3'])) echo $donnees['sousTitre3'];?>">
            <input type="text" name="sousTitre3-en" id="sousTitre3-en" value="<?php if (isset($donneesEn['sousTitre3'])) echo $donneesEn['sousTitre3'];?>">
          </li>             
          <li>
            <!-- jQUERY TEXT EDITOR -->
            <p>Description de la personne :</p>
            <textarea name="resume3-fr" class="jqte-test" id="resume3-fr"><?php if (isset($donnees['resume3'])) echo $donnees['resume3'];?></textarea>
            <textarea name="resume3-en" class="jqte-test" id="resume3-en"><?php if (isset($donneesEn['resume3'])) echo $donneesEn['resume3'];?></textarea>
            
            <script>
              $('.jqte-test').jqte();
              // settings of status
              var jqteStatus = true;
              $(".status").click(function()
              {
                  jqteStatus = jqteStatus ? false : true;
                  $('.jqte-test').jqte({"status" : jqteStatus})
              });
            </script>
            
            <!-- jQUERY TEXT EDITOR -->
          </li>
          <li>
            <input type="submit" name="button3" id="button3" value="Valider les modifications" class="button-grand">
          </li>
          <p><span class="underline">Note</span> : la modification de la description de la personne n°2 entraînera la mise à jour de la version anglaise <span class="underline">et</span> de la version française.</p>
          <li>
            <input type="hidden" name="flag3" id="flag3" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
    </div>


    <h1>Gestion des collaborateurs</h1>
    <!-- Liste des collaborateurs -->
    <table>
      <tr>
        <th class="cellule">nom</th>
        <th class="cellule">prenom</th>
        <th class="cellule">Modifier</th>
        <th class="cellule">Supprimer</th>
      </tr>
      <?php
        // On récupère tout le contenu de la table collaborateurs
        $reponseCollaborateurs = $bdd->query('SELECT * FROM collaborateurs');
        // On affiche chaque entrée une à une
        while ($donneesCollaborateurs = $reponseCollaborateurs->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donneesCollaborateurs['nom'];?></td>
        <td class="cellule"><?php echo $donneesCollaborateurs['prenom'];?></td>
        <td class="cellule"><a href="collaborateursModif.php?ID=<?php echo $donneesCollaborateurs['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td class="cellule"><a href="collaborateursSupp.php?ID=<?php echo $donneesCollaborateurs['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
      </tr>
      <?php
        }
        $reponseCollaborateurs->closeCursor(); // Termine le traitement de la requête
      ?>
    </table>
    <p><a href="collaborateursAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter un collaborateur</a></p>

    <!-- Liste des fonctions -->
    <h1>Gestion des fonctions</h1>
    <table>
      <tr>
        <th class="cellule">Fonction</th>
        <th class="cellule">Modifier</th>
        <th class="cellule">Supprimer</th>
      </tr>
      <?php
        // On récupère tout le contenu de la table fonctions
        $reponseFonctions = $bdd->query('SELECT * FROM fonctions');
        // On affiche chaque entrée une à une
        while ($donneesFonctions = $reponseFonctions->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donneesFonctions['metiers'];?></td>
        <td class="cellule"><a href="fonctionsModif.php?ID=<?php echo $donneesFonctions['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td class="cellule"><a href="fonctionsSupp.php?ID=<?php echo $donneesFonctions['ID'];?>"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
      </tr>
      <?php
        }
        $reponseFonctions->closeCursor(); // Termine le traitement de la requête
      ?>
    </table>
    <p><a href="fonctionsAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter une fonction</a></p>

    <!-- Liste des liens amis -->
    <h1>Gestion des liens amis</h1>
    <table>
      <tr>
        <th class="cellule">Nom du lien</th>
        <th class="cellule">Modifier</th>
        <th class="cellule">Supprimer</th>
      </tr>
      <?php
        // On récupère tout le contenu de la table liens_amis
        $reponseLiens = $bdd->query('SELECT * FROM liens_amis');
        // On affiche chaque entrée une à une
        while ($donneesLiens = $reponseLiens->fetch())
        {
      ?>
      <tr>
        <td class="cellule"><?php echo $donneesLiens['nom'];?></td>
        <td class="cellule"><a href="liensAmisModif.php?lienID=<?php echo $donneesLiens['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconModify.jpg" /></a></td>
        <td class="cellule"><a href="liensAmisSupp.php?lienID=<?php echo $donneesLiens['ID'];?>"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg"  /></a></td>
      </tr>
      <?php
        }
        $reponseLiens->closeCursor(); // Termine le traitement de la requête
      ?>
    </table>
    <p><a href="liensAmisAjout.php" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconAdd.jpg" /> Ajouter un lien ami</a></p>
  </div>

  <?php include('tools/toolsLang.php');?>

</body>
</html>