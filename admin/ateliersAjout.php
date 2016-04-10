<?php
  include_once ("inc/include.inc.php");
  
  /* ------------------------------------------- Récupération des infos formulaire ----------------------------------- */
    
  if(isset($_POST['flag1']) AND $_POST['flag1']==1 AND isset($_POST['button1']))
  {
    if(isset($_POST["titre"]) AND $_POST["titre"]!="" 
      AND isset($_POST["salle"])
      AND isset($_POST["texte"]) AND $_POST["texte"]!=""
      AND isset($_POST["texteMobile"]) AND $_POST["texteMobile"]!=""
      AND isset($_POST["adresse"]) AND $_POST["adresse"]!=""
      AND isset($_POST["codePostal"]) AND $_POST["codePostal"]!=""
      AND isset($_POST["ville"]) AND $_POST["ville"]!=""
      AND isset($_POST["adresseGpsDuLieu"]) AND $_POST["adresseGpsDuLieu"]!="")
    {
      // On vérifie qu'il y a une prochaine date OU des informations texte
      if((isset($_POST["date"]) AND !empty($_POST["date"]) AND isset($_POST["infos"]) AND empty($_POST["infos"]))
        OR (isset($_POST["infos"]) AND !empty($_POST["infos"]) AND isset($_POST["date"]) AND $_POST["date"]===""))
      {
        $titre = $_POST["titre"];
        $salle = $_POST["salle"];
        $texte = $_POST["texte"];
        $texteMobile = $_POST["texteMobile"];
        $heureDebut = $_POST["heureDebut"] . ":" . $_POST["minuteDebut"];
        $heureFin = $_POST["heureFin"] . ":" . $_POST["minuteFin"];
        $adresse = $_POST["adresse"];
        $codePostal = $_POST["codePostal"];
        $ville = $_POST["ville"];
        $adresseGpsDuLieu = $_POST["adresseGpsDuLieu"];
        
        if(isset($_POST["date"]) AND !empty($_POST["date"]))
        {
          // On vérifie que la date entrée est dans le futur
          // Si la date est bien dans le futur, on l'enregistre
          $date = $_POST["date"];
          $infos = "";
          
          $now = date('Y-m-d'); // Date actuelle
          if(dateCompare($now, $date) == 1)
          { 
            $requete="INSERT INTO ateliers (titre, salle, texte, texteMobile, dates, infos, heureDebut, heureFin, adresse, codePostal, ville, adresseGpsDuLieu) 
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $req = $bdd->prepare($requete);
            $req->execute(array($titre, $salle, $texte, $texteMobile, $date, $infos, $heureDebut, $heureFin, $adresse, $codePostal, $ville, $adresseGpsDuLieu)) 
              or die(print_r($req->errorInfo()));
            $req->closeCursor();
            header("Location:ateliersGestion.php");
          }
          else
          {
            $erreur = "Erreur : la date que vous voulez enregistrer est déjà passée !";
          }
        }
        
        if(isset($_POST["infos"]) AND !empty($_POST["infos"]))
        {
          $date = "0000-00-00";
          $infos = $_POST["infos"];
          
          $requete="INSERT INTO ateliers (titre, salle, texte, texteMobile, dates, infos, heureDebut, heureFin, adresse, codePostal, ville, adresseGpsDuLieu) 
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $req = $bdd->prepare($requete);
          $req->execute(array($titre, $salle, $texte, $texteMobile, $date, $infos, $heureDebut, $heureFin, $adresse, $codePostal, $ville, $adresseGpsDuLieu)) 
            or die(print_r($req->errorInfo()));
          $req->closeCursor();
          header("Location:ateliersGestion.php");
        }
      }
      else $erreur = "Vous devez rentrer une prochaine date OU une information de type texte.";
    }
    else
    {
      $erreur = "Tous les champs sont obligatoires.";
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Ajout d'un atelier</title>
  
  <?php include("inc/head.inc.php");?>
 
  <script>
    $(function() {
      $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
      $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
    });
  </script>

  <style>
    textarea {
      width:400px;
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
         get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'ateliersGestion.php' => 'Gestion des ateliers', 'final' => 'Ajout d\'un atelier'));
          ?>
    </div> <!-- fin du fil d'Arianne -->
      
    <div class="halfPage filaire">
      <h1>Ajout d'un atelier</h1>
      <form id="form1" name="form1" method="post" action="ateliersAjout.php">
      <fieldset>
      <legend>Informations de l'atelier</legend>        
        <ul>
          <li>   
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php if(isset($_POST["titre"])) echo $_POST["titre"];?>" required>
          </li>
          <li>   
            <label for="salle">Lieu</label>
            <input type="text" name="salle" id="salle" value="<?php if(isset($_POST["salle"])) echo $_POST["salle"];?>" required>
          </li>
          <li>
            <label for="texte">Description</label>
            <textarea name="texte" class="jqte-test" id="texte" required><?php if(isset($_POST["texte"])) echo $_POST["texte"];?></textarea>
          </li>
          <li>
            <label for="texteMobile">Description pour la version mobile</label>
            <textarea name="texteMobile" class="jqte-test" id="texteMobile" required><?php if(isset($_POST["texteMobile"])) echo $_POST["texteMobile"];?></textarea>
          </li>
          <br />
          <li>
            <label for="datepicker">Prochaine date</label>
            <input type="date" name="date" id="datepicker" value="<?php if(isset($_POST["dates"])) echo $_POST["dates"];?>" />
          </li>
          OU
          <li>
            <label for="infos">Informations (à préciser)</label>
            <input type="text" name="infos" id="infos" value="<?php if(isset($_POST["infos"])) echo $_POST["infos"];?>" />
          </li>
          <li>
            <label for="heureDebut">Heure de début</label>
            <select name="heureDebut" name="heureDebut" id="heureDebut" class="time" >
            <?php
              for($i=0;$i<24;$i++)
              {
                echo "<option ";
                if(isset($_POST["heureDebut"]) AND intval($_POST["heureDebut"]) == $i) echo "selected";
                echo ">" . sprintf("%02d", $i) . "</option>";
              }
            ?>
            </select>
            h
            <select name="minuteDebut" name="minuteDebut" id="minuteDebut" class="time" >
            <?php
              for($i=0;$i<60;$i++)
              {
                echo "<option ";
                if(isset($_POST["minuteDebut"]) AND intval($_POST["minuteDebut"]) == $i) echo "selected";
                echo ">" . sprintf("%02d", $i) . "</option>";
              }
            ?>
            </select>
          </li>
          <li>
            <label for="heureFin">Heure de fin</label>
            <select name="heureFin" name="heureFin" id="heureFin" class="time" >
            <?php
              for($i=0;$i<24;$i++)
              {
                echo "<option ";
                if(isset($_POST["heureFin"]) AND intval($_POST["heureFin"]) == $i) echo "selected";
                echo ">" . sprintf("%02d", $i) . "</option>";
              }
            ?>
            </select>
            h
            <select name="minuteFin" name="minuteFin" id="minuteFin" class="time" >
            <?php
              for($i=0;$i<60;$i++)
              {
                echo "<option ";
                if(isset($_POST["minuteFin"]) AND intval($_POST["minuteFin"]) == $i) echo "selected";
                echo ">" . sprintf("%02d", $i) . "</option>";
              }
            ?>
            </select>
          </li>
          <li>   
            <label for="adr">Adresse du lieu</label>
            <input type="text" name="adresse" id="adr" value="<?php if(isset($_POST["adresse"])) echo $_POST["adresse"];?>"required >
          </li>
          <li>   
            <label for="codeP">Code postal du lieu</label>
            <input type="text" name="codePostal" id="codeP" value="<?php if(isset($_POST["codePostal"])) echo $_POST["codePostal"];?>" required>
          </li>
          <li>   
            <label for="city">Ville du lieu</label>
            <input type="text" name="ville" id="city" value="<?php if(isset($_POST["ville"])) echo $_POST["ville"];?>" required>
          </li>
          <li>   
            <label for="gps">Coordonnées GPS du lieu</label>
            <input type="text" name="adresseGpsDuLieu" id="gps" value="<?php if(isset($_POST["adresseGpsDuLieu"])) echo $_POST["adresseGpsDuLieu"];?>" required>
          </li>

          <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>

          <li>
            <input type="submit" name="button1" id="button1" value="Ajouter l'atelier" />
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
          </li>

        </ul>
      </fieldset>
      </form>
    </div>
  </div>

</body>
</html>