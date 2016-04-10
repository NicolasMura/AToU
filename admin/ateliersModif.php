<?php
  include_once ("inc/include.inc.php");
  
  // On récupère l'ID de l'atelier à modifier
  if(isset($_GET["atelierID"])) $atelierID = $_GET["atelierID"];
  if(isset($_POST["atelierID"])) $atelierID = $_POST["atelierID"];
  
  // S'il n'y a rien à récupérer, on redirige vers la gestion des ateliers
  if(!isset($_GET["atelierID"]) AND !isset($_POST["atelierID"])) header("Location:ateliersGestion.php");
  
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
      // Traitement particulier pour l'atelier "global" Autour de TransFORME 2014
      if($atelierID == 2)
      {
        $_POST["date"] = "9999-99-99";
        $_POST["infos"] = "";
      }
      
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
            $requete="UPDATE ateliers 
              SET titre = ?,salle = ?, texte = ?, texteMobile = ?, dates = ?, infos = ?, heureDebut = ?, heureFin = ?, adresse = ?, 
                codePostal = ?, ville = ?, adresseGpsDuLieu = ? WHERE ID = ".$atelierID;
            $req = $bdd->prepare($requete);
            $req->execute(
              array($titre, $salle,$texte, $texteMobile, $date, $infos, $heureDebut, $heureFin, $adresse, $codePostal, $ville, $adresseGpsDuLieu))
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
          
          $requete="UPDATE ateliers
                SET titre = ?,salle = ?, texte = ?, texteMobile = ?, dates = ?, infos = ?, heureDebut = ?, heureFin = ?, adresse = ?, 
                codePostal = ?, ville = ?, adresseGpsDuLieu = ? WHERE ID = ".$atelierID;;
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
      $erreur = "Tous les champs sont obligatoires et vous devez rentrer une prochaine date OU une information de type texte.";
    }
  }
  
  /* ------------------------------------------- Récupération des infos en base de données ----------------------------------- */
  
  if(isset($_GET["atelierID"]) or isset($_POST["atelierID"]))
  { 
    $requeteAtelier = "SELECT * FROM ateliers WHERE ID = ".$atelierID;
    $reponseAtelier = $bdd->query($requeteAtelier);
    
    // Initialisation du tableau contenant les données à afficher sur la page
    $donneesPage = array("titre", "texte");
    
    $donneesAtelier = $reponseAtelier->fetch();
    $donneesPage["titre"] = $donneesAtelier["titre"];
    $donneesPage["salle"] = $donneesAtelier ["salle"];
    $donneesPage["texte"] = $donneesAtelier["texte"];
    $donneesPage["texteMobile"] = $donneesAtelier["texteMobile"];
    $donneesPage["dates"] = $donneesAtelier["dates"];
    $donneesPage["infos"] = $donneesAtelier["infos"];
    $donneesPage["heureDebut"] = $donneesAtelier["heureDebut"];
    $donneesPage["heureFin"] = $donneesAtelier["heureFin"];
    $donneesPage["adresse"] = $donneesAtelier["adresse"];
    $donneesPage["codePostal"] = $donneesAtelier["codePostal"];
    $donneesPage["ville"] = $donneesAtelier["ville"];
    $donneesPage["adresseGpsDuLieu"] = $donneesAtelier["adresseGpsDuLieu"];
    
    $reponseAtelier->closeCursor();
    
    // Pour ne pas perdre les données
    $infosDebut = explode(":", $donneesAtelier["heureDebut"]);
    $infosFin = explode(":", $donneesAtelier["heureFin"]);
    $donneesPage["heureDebut"] = $infosDebut[0];
    $donneesPage["minuteDebut"] = $infosDebut[1];
    $donneesPage["heureFin"] = $infosFin[0];
    $donneesPage["minuteFin"] = $infosFin[1];
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modification d'un atelier</title>
  
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
        get_fil_ariane(array('espaceAdherentGestion.php' => 'Espace adhérents', 'ateliersGestion.php' => 'Gestion des ateliers', 'final' => 'Modification d\'un atelier'));
      ?>
    </div> <!-- fin du fil d'Arianne -->
    
    <div class="halfPage filaire">  
      <form id="form1" name="form1" method="post" action="ateliersModif.php?atelierID=<?php echo $atelierID;?>">
      <h1>Modification d'un atelier</h1>
      <fieldset>
      <legend>Informations de l'atelier</legend>        
        <ul>
          <li>   
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php if(isset($donneesPage["titre"])) echo $donneesPage["titre"];?>" required>
          </li>
          <li>   
            <label for="salle">Lieu</label>
            <input type="text" name="salle" id="salle" value="<?php if(isset($donneesPage["salle"])) echo $donneesPage["salle"];?>" required>
          </li>
          <li>
            <label for="texte">Description</label>
            <textarea name="texte" class="jqte-test" id="texte" required><?php if(isset($donneesPage["texte"])) echo $donneesPage["texte"];?></textarea>
          </li>
          <li>
            <label for="texteMobile">Description pour la version mobile</label>
            <textarea name="texteMobile" class="jqte-test" id="texteMobile" required><?php if(isset($donneesPage["texteMobile"])) echo $donneesPage["texteMobile"];?></textarea>
          </li>
          <br />
          <?php
            if($atelierID != 2)
          {
          ?>
          <li>
            <label for="datepicker">Prochaine date</label>
            <input type="date" name="date" id="datepicker" value="<?php if(isset($donneesPage["dates"]) AND $donneesPage["dates"] != "0000-00-00") echo $donneesPage["dates"];?>" />
          </li>
          OU
          <li>
            <label for="infos">Informations (à préciser)</label>
            <input type="text" name="infos" id="infos" value="<?php if(isset($donneesPage["infos"])) echo $donneesPage["infos"];?>" />
          </li>
          <?php
            }
          ?>
          <li>
            <label for="heureDebut">Heure de début</label>
            <select name="heureDebut" name="heureDebut" id="heureDebut" class="time" >
            <?php
              for($i=0;$i<24;$i++)
              {
                echo "<option ";
                if(isset($donneesPage["heureDebut"]) AND intval($donneesPage["heureDebut"]) == $i) echo "selected";
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
                if(isset($donneesPage["minuteDebut"]) AND intval($donneesPage["minuteDebut"]) == $i) echo "selected";
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
                if(isset($donneesPage["heureFin"]) AND intval($donneesPage["heureFin"]) == $i) echo "selected";
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
                if(isset($donneesPage["minuteFin"]) AND intval($donneesPage["minuteFin"]) == $i) echo "selected";
                echo ">" . sprintf("%02d", $i) . "</option>";
              }
            ?>
            </select>
          </li>
          <li>   
            <label for="adr">Adresse du lieu</label>
            <input type="text" name="adresse" id="adr" value="<?php if(isset($donneesPage["adresse"])) echo $donneesPage["adresse"];?>"required >
          </li>
          <li>   
            <label for="codeP">Code postal du lieu</label>
            <input type="text" name="codePostal" id="codeP" value="<?php if(isset($donneesPage["codePostal"])) echo $donneesPage["codePostal"];?>" required>
          </li>
          <li>   
            <label for="city">Ville du lieu</label>
            <input type="text" name="ville" id="city" value="<?php if(isset($donneesPage["ville"])) echo $donneesPage["ville"];?>" required>
          </li>
          <li>   
            <label for="gps">Coordonnées GPS du lieu</label>
            <input type="text" name="adresseGpsDuLieu" id="gps" value="<?php if(isset($donneesPage["adresseGpsDuLieu"])) echo $donneesPage["adresseGpsDuLieu"];?>" required>
          </li>

          <?php if(isset($erreur)) echo "<p class='erreur'>" . $erreur . "</p>";?>

          <li>
            <input type="submit" name="button1" id="button1" value="Enregistrer les modifications" class="button-grand"/>
          </li>
          <li>
            <input type="hidden" name="flag1" id="flag1" value="1">
            <input type="hidden" name="atelierID" id="atelierID" value="<?php if(isset($atelierID)) echo $atelierID;?>">
          </li>
        </ul>
        </fieldset>
      </form>
    </div>
  </div>

</body>
</html>