<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["titre"]) AND $_POST["titre"]!="" AND isset($_POST["textarea"]) AND $_POST["textarea"]!="")
    {
      $titre = $_POST["titre"];
      $texte = $_POST["textarea"];
      if(isset($_POST["textarea2"]) AND $_POST["textarea2"] != "") $texteMobile = $_POST["textarea2"];
      else
      {
        $texteMobile = $_POST["textarea"];
        $messageAvertissement = "En l'absence de description pour la version mobile, la version desktop est utilisée.";
      }
      
      $requete="UPDATE ateliers SET titre = ?, texte = ?, texteMobile = ? WHERE ID = 1";
      $req = $bdd->prepare($requete);
      $req->execute(array($titre, $texte, $texteMobile)) or die(print_r($req->errorInfo()));
      $req->closeCursor();
      $messageTexteOK = "Vos modifications ont bien été prises en compte.";
    }
    else
    {
      $erreurTexte = "Vous devez entrer un titre et une description avant de valider.";
    }
  }
  
  if(isset($_POST['flag2']) AND $_POST['flag2']==1 AND isset($_POST['button2']))
  {
    if(isset($_POST["date"]) AND $_POST["date"]!="")
    {
      $dates = $_POST["date"];
      $heureDebut = $_POST["heureDebut"] . ":" . $_POST["minuteDebut"];
      $heureFin = $_POST["heureFin"] . ":" . $_POST["minuteFin"];
      
      // On vérifie que la date entrée n'existe pas déjà en base de données
      $requeteDateTmp = "SELECT id FROM nubes WHERE dates='".$dates."'";
      $reponseDateTmp = $bdd->query($requeteDateTmp);
      $nombreResultatsTmp = $reponseDateTmp->rowCount();
      $reponseDateTmp->closeCursor();
      if($nombreResultatsTmp < 1)
      {
        // Si la date est bien dans le futur, on l'enregistre
        $now = date('Y-m-d'); // Date actuelle
        if(dateCompare($now, $dates) == 1)
        {
          $requete="INSERT INTO nubes (dates, heureDebut, heureFin) VALUES(?, ?, ?)";
          $req = $bdd->prepare($requete);
          $req->execute(array($dates, $heureDebut, $heureFin)) or die(print_r($req->errorInfo()));
          $req->closeCursor();
          
          // Pour le mobile
          // On récupère la prochaine date Nubes enregistrée (si elle existe)
          $requeteNubesDates = "SELECT dates FROM nubes";
          $reponseNubesDates = $bdd->query($requeteNubesDates);
          $nombreNubesDates = $reponseNubesDates->rowCount();
          //$requeteNubesDates->closeCursor();
          
          // Si cette date existe, on met le champ nubesDate de l'adhérent à jour en y inscrivant cette date (si l'adhérent n'est pas déjà inscrit)
          if($nombreNubesDates > 0)
          {   
            $requeteNubesNextDate = "SELECT MIN(dates) FROM nubes";
            $donneesNubesNextDate = $bdd->query($requeteNubesNextDate);
            $reponseNubesNextDate = $donneesNubesNextDate->fetch();
            $prochaineDateNubes = $reponseNubesNextDate["MIN(dates)"];
            //$requeteNubesNextDate->closeCursor();
          }
          else
          {
            $prochaineDateNubes = "0000-00-00";
          }
  
          $requete2="UPDATE ateliers SET dates = ? WHERE ID = 1";
          $req2 = $bdd->prepare($requete2);
          $req2->execute(array($prochaineDateNubes)) or die(print_r($req2->errorInfo()));
          $req2->closeCursor();
          
          $messageDateOK = "La date a bien été ajoutée.";
        }
        else
        {
        $erreurDate = "Erreur : la date que vous voulez enregistrer est déjà passée !";
        }
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
  
  $requeteTexte = "SELECT ID, titre, texte, texteMobile FROM ateliers WHERE ateliers.ID = 1";
  $reponseTexte = $bdd->query($requeteTexte);
  $donneesTexte = $reponseTexte->fetch();
  $reponseTexte->closeCursor();
    
  $requeteDates = "SELECT * FROM nubes ORDER BY dates ASC";
  $reponseDates = $bdd->query($requeteDates);
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion de l'atelier Nubes</title>
  
  <?php include("inc/head.inc.php");?>
 
  <script>
    $(function() {
      $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
      $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
    });
  </script>
</head>

<body>
    <?php include('inc/menuAdmin.inc.php'); ?>
    
    <div id="container">
    
      <!-- Fil d'Arianne -->
      <div class="filaire">
      <?php
        define('Compagnie_ATou', 'Accueil', true);
        get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'ateliersGestion.php' => 'Gestion des ateliers', 'final' => 'Gestion de l\'atelier Nubes'));
      ?>
      </div><!-- fin du fil d'Arianne -->
    
      <h1>Gestion de l'atelier Nubes</h1>
      
      <form id="form1" name="form1" method="post" action="nubesGestion.php#form1">
      <fieldset>
      <legend>Gestion du texte de l'atelier Nubes</legend>        
        <ul>
          <li>   
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $donneesTexte["titre"];?>">
          </li>
          <li>
            <label for="textarea">Description</label>
            <textarea name="textarea" class="jqte-test" id="textarea"><?php echo $donneesTexte["texte"];?></textarea>
          </li>
          <li>
            <label for="textarea2">Description pour la version mobile</label>
            <textarea name="textarea2" class="jqte-test" id="textarea2"><?php echo $donneesTexte["texteMobile"];?></textarea>
          </li>

          <?php if(isset($messageTexteOK)) echo "<p class='success'>" . $messageTexteOK . "</p>";?>
          <?php if(isset($messageAvertissement)) echo "<p class='success'>" . $messageAvertissement. "</p>";?>
          <?php if(isset($erreurTexte)) echo "<p class='erreur'>" . $erreurTexte . "</p>";?>
      
          <br>
          <li>
            <input type="submit" name="button1" id="button1" value="Valider le texte" />
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
        
      <form id="form2" name="form2" method="post" action="nubesGestion.php#form2">
      <fieldset>
      <legend>Gestion des dates de l'atelier Nubes</legend>
      <ul>
          <li>
            <label for="datepicker">Entrez une date</label>
            <input type="date" name="date" id="datepicker" value="<?php if(isset($_POST["date"])) echo $_POST["date"];?>" required/>
          </li>
          <li>
            <label for="heureDebut">Entrez une heure de début</label>
            <select name="heureDebut" name="heureDebut" id="heureDebut" class="time" required>
              <?php
                for($i=0;$i<24;$i++) echo "<option>" . sprintf("%02d", $i) . "</option>";
              ?>
            </select>
            h
            <select name="minuteDebut" name="minuteDebut" id="minuteDebut" class="time" required>
              <?php
                for($i=0;$i<60;$i++) echo "<option>" . sprintf("%02d", $i) . "</option>";
              ?>
            </select>
          </li>
          <li>
            <label for="heureFin">Entrez une heure de fin</label>
            <select name="heureFin" name="heureFin" id="heureFin" class="time" required>
              <?php
                for($i=0;$i<24;$i++) echo "<option>" . sprintf("%02d", $i) . "</option>";
              ?>
            </select>
            h
            <select name="minuteFin" name="minuteFin" id="minuteFin" class="time" required>
              <?php
                for($i=0;$i<60;$i++) echo "<option>" . sprintf("%02d", $i) . "</option>";
              ?>
            </select>
          </li>
          
          <?php if(isset($messageDateOK)) echo "<p class='success'>" . $messageDateOK . "</p>";?>
          <?php if(isset($erreurDate)) echo "<p class='erreur'>" . $erreurDate . "</p>";?>
  
          <li>
            <input type="submit" name="button2" id="button2" value="Ajouter la date" />
          </li>
          <li>
            <input type="hidden" name="flag2" id="flag2" value="1">
          </li>
        </ul>
      </fieldset>
      </form>
        
      <?php
        $nombreResultats = $reponseDates->rowCount();
        // S'il y a des dates, on les affiche
        if($nombreResultats > 0)
        {
      ?>
      <table>
        <tr>
          <th class="cellule">Date</th>
          <th class="cellule">Horaires</th>
          <th class="cellule">Supprimer</th>
        </tr> 
      <?php 
        echo "<p>Dates enregistrées :</p>";
        while($donneesDates = $reponseDates->fetch())
        {
          // Traitement des horaires : on enlève les secondes inutiles
          $heureDebut = "2014-01-01 ".$donneesDates["heureDebut"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
          $heureFin = "2014-01-01 ".$donneesDates["heureFin"]; // La date 2014-01-01 est juste là pour pouvoir se servir de la fonction dateHeureInfos()
          $heureDebut = dateHeureInfos($heureDebut);
          $heureFin = dateHeureInfos($heureFin);
          $donneesDates["heureDebut"] = $heureDebut["heure"];
          $donneesDates["heureFin"] = $heureFin["heure"];
        ?>
        <tr>
          <td class="cellule"><?php echo $donneesDates['dates'];?></td>
          <td class="cellule"><?php echo $donneesDates['heureDebut']." - ".$donneesDates['heureFin'];?></td>
          <td><a href="nubesDatesSupp.php?dateIdNubes=<?php echo $donneesDates['ID'];?>" class="ahref"><img class="icons" src="<?php echo CHEMIN_SITE;?>/img/atouIconDelete.jpg" /></a></td>
        </tr>
        <?php
          }
          $reponseDates->closeCursor();
        }
        else
        { 
          echo "<p>Vous n'avez aucune date enregistrée pour l'atelier Nubes.</p>";
        }
      ?>
    </table>
        
  </div>

</body>
</html>