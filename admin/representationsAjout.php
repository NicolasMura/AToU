<?php
  include_once ("inc/include.inc.php");

  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['ID'])) $ID = $_GET['ID'];
  if(isset($_POST['ID'])) $ID = $_POST['ID'];

  if(isset($_GET['creationsID'])) $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID'])) $actions_culturellesID = $_GET['actions_culturellesID'];
  if(isset($_POST['creationsID'])) $creationsID = $_POST['creationsID'];
  if(isset($_POST['actions_culturellesID'])) $actions_culturellesID = $_POST['actions_culturellesID'];

  //############### Insertion des données au clic du formulaire#######################

  // Pour une création
  if(isset($_POST['flag']) AND $_POST['flag']==1 AND isset($_POST['creationsID']) AND $_POST['creationsID'] != "")
  {
  //############### Récupération dans des variables des données du formulaire ##############################
    $salle = $_POST["salle"];
    $ville = $_POST["ville"];
    $pays = $_POST["pays"];
    $dates = $_POST["dates"];
    $heureDebut = $_POST["heureDebut"] . ":" . $_POST["minuteDebut"];
    $infos = $_POST["infos"];
    if(isset($_POST["infosMobile"])) $infosMobile = $_POST["infosMobile"];
      else $infosMobile = "";
    $adresseGpsDuLieu = $_POST["adresseGpsDuLieu"];
    $creationsID = $_POST["creationsID"];
    $actions_culturellesID = 0;
  
  //################# Insertion dans la base données ##############################################################
    $req= $bdd->prepare('INSERT INTO representations (salle, ville, pays, dates, heureDebut, infos, infosMobile, adresseGpsDuLieu, creationsID, actions_culturellesID) 
                VALUES (:salle, :ville, :pays, :dates, :heureDebut, :infos, :infosMobile, :adresseGpsDuLieu, :creationsID, :actions_culturellesID)');
  
    $req->execute(array(
    'salle' => $salle,
    'ville' => $ville,
    'pays' => $pays,
    'dates' => $dates,
    'heureDebut' => $heureDebut,
    'infos' => $infos,
    'infosMobile' => $infosMobile,
    'adresseGpsDuLieu' => $adresseGpsDuLieu,
    'creationsID' => $creationsID,
    'actions_culturellesID' => $actions_culturellesID
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête
    $redirection="creationsModif.php?ID=".$ID;
    header("Location:$redirection");
  }

  // Pour une action culturelle
  if(isset($_POST['flag']) AND $_POST['flag']==1 AND isset($_POST['actions_culturellesID']) AND $_POST['actions_culturellesID'] != "")
  {
  //############### Récupération dans des variables des données du formulaire ##############################
    $salle = $_POST["salle"];
    $ville = $_POST["ville"];
    $pays = $_POST["pays"];
    $dates = $_POST["dates"];
    $heureDebut = $_POST["heureDebut"] . ":" . $_POST["minuteDebut"];
    $infos = $_POST["infos"];
    if(isset($_POST["infosMobile"])) $infosMobile = $_POST["infosMobile"];
      else $infosMobile = "";
    $adresseGpsDuLieu = $_POST["adresseGpsDuLieu"];
    $creationsID = 0;
    $actions_culturellesID = $_POST["actions_culturellesID"];
    
  //################# Insertion dans la base données ##############################################################
    $req= $bdd->prepare('INSERT INTO representations (salle, ville, pays, dates, heureDebut, infos, infosMobile, adresseGpsDuLieu, creationsID, actions_culturellesID) 
                VALUES (:salle, :ville, :pays, :dates, :heureDebut, :infos, :infosMobile, :adresseGpsDuLieu, :creationsID, :actions_culturellesID)');
  
    $req->execute(array(
    'salle' => $salle,
    'ville' => $ville,
    'pays' => $pays,
    'dates' => $dates,
    'heureDebut' => $heureDebut,
    'infos' => $infos,
    'infosMobile' => $infosMobile,
    'adresseGpsDuLieu' => $adresseGpsDuLieu,
    'creationsID' => $creationsID,
    'actions_culturellesID' => $actions_culturellesID
    ));
    
    $req->closeCursor(); // Termine le traitement de la requête
    $redirection="actionsCulModif.php?ID=".$ID;
    
    header("Location:$redirection");
  }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter une représentation</title>

    <?php include("inc/head.inc.php");?>
    
    <script>
      $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
        $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
      });
    </script>

    <style>
      div.jqte:nth-child(2n+1){
        box-shadow: inherit;
      }
    </style>
</head>

<body>
  <?php include('inc/menuAdmin.inc.php'); ?>
  <?php
    if(!isset($_POST["button"]))
    {
  ?>
  <div id="container">
  
    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
       define('Compagnie_ATou', 'Accueil', true);
       
       if(isset($creationsID))
        {
          get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification d\'une création', 'final' => 'Ajout d\'une représentation'));
      }
      elseif(isset($actions_culturellesID))
      {
        get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification d\'une action culturelle', 'final' => 'Ajout d\'une représentation'));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Ajouter une représentation</h1>
      <form name="form1" method="post" action="representationsAjout.php">
      <fieldset>
      <legend>Ajout d'une représentation</legend>
        <ul>
          <li>
            <label for="salle">Entrez une salle : </label>
            <input type="text" name="salle" id="salle">
          </li>
          <li>
            <label for="ville">Entrez une ville : </label>
            <input type="text" name="ville" id="ville">
          </li>
          <li>
            <label for="pays">Entrez un pays : </label>
            <input type="text" name="pays" id="pays">
          </li>
          <li>
            <label for="datepicker">Entrez une date : </label>
            <input type="date" name="dates" id="datepicker" required/>
          </li>
          <li>
            <label for="heureDebut">Entrez une heure de début : </label>
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
            <label for="infos">Autres informations (optionnel)<br />(contact, tarif, ...) : </label>
            <input type="text" name="infos" id="infos">
          </li>
          <br /><br /><br />
          </li>
          <!-- jQUERY TEXT EDITOR -->
          
          <?php
            if(isset($creationsID))
            {
          ?>
          <p>Infos mobile :</p>
          <textarea name="infosMobile" class="jqte-test" id="res"></textarea>
          
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
          
          <?php
            }
          ?>
          <!-- jQUERY TEXT EDITOR -->
          
          </li>
          <li>   
            <label for="adresseGpsDuLieu">Coordonnées GPS (site mobile) :</label>
            <input type="text" name="adresseGpsDuLieu" id="adresseGpsDuLieu" required>
          </li>
          <li>
            <input type="submit" name="button" id="button" value="Ajouter la représentation" class="button-grand">
          </li>
          <li>
            <input type="hidden" name="flag" id="flag" value="1">
          </li>
          <li>
            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">
          </li>
          <li>
          <?php
            if(isset($creationsID))
            {
          ?>
            <input type="hidden" name="creationsID" id="creationsID" value="<?php echo $creationsID; ?>">
          <?php
          }
            elseif(isset($actions_culturellesID))
            {
          ?>
            <input type="hidden" name="actions_culturellesID" id="actions_culturellesID" value="<?php echo $actions_culturellesID; ?>">
          <?php
            }
          ?>
          </li>
        </ul>
      </form>
      </fieldset>
    </div>
    <?php
      }
    ?>
  </div>
</body>
</html>