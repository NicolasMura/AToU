<?php
  include_once ("inc/include.inc.php");

  //############### Récupération en GET de l'ID de la création #######################
  if(isset($_GET['ID']))   $ID = $_GET['ID'];
  if(isset($_POST['ID']))   $ID = $_POST['ID'];
  if(isset($_GET['creationsID']))  $creationsID = $_GET['creationsID'];
  if(isset($_GET['actions_culturellesID']))  $actions_culturellesID = $_GET['actions_culturellesID'];
  if(isset($_POST['creationsID']))  $creationsID = $_POST['creationsID'];
  if(isset($_POST['actions_culturellesID']))  $actions_culturellesID = $_POST['actions_culturellesID'];

  if(isset($_GET['representationsID'])) $representationsID = $_GET['representationsID'];
  if(isset($_POST['representationsID'])) $representationsID = $_POST['representationsID'];

  // On récupère tout le contenu de la table representation
  $requete="SELECT * FROM representations WHERE ID =".$representationsID or die(print_r($bdd->errorInfo));
  $reponse = $bdd->query($requete);
  // On affiche l' entrée
  $donnees = $reponse->fetch();

    // Pour ne pas perdre les données
    $infosHeureDebut = explode(":", $donnees["heureDebut"]);
    $donnees["heureDebut"] = $infosHeureDebut[0];
    $donnees["minuteDebut"] = $infosHeureDebut[1];

  //############### Insertion des données au clic du formulaire#######################
  if(isset($_POST['flag']) AND $_POST['flag']==1)
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
    $representationsID = $_POST["representationsID"];
    //---------------------
    //$creationsID = $_POST["creationsID"];
  //################# Insertion dans la base données ##############################################################
    $req= $bdd->prepare('UPDATE representations SET salle = :salle, ville = :ville, pays = :pays, dates = :dates, heureDebut = :heureDebut, infos = :infos, infosMobile = :infosMobile, adresseGpsDuLieu = :adresseGpsDuLieu  WHERE ID= :ID');

    $req->execute(array(

    'salle' => $salle,
    'ville' => $ville,
    'pays' => $pays,
    'dates' => $dates,
    'heureDebut' => $heureDebut,
    'infos' => $infos,
    'infosMobile' => $infosMobile,
    'adresseGpsDuLieu' => $adresseGpsDuLieu,
    'ID' => $representationsID
    ));
    
  //############### Récupération de la dernière creation ID #######################
    //$lastID = $bdd->lastInsertId();
    //echo "<br />ID est : ".$lastID; devient 14
    // envoi à accueil.php
    
    $req->closeCursor(); // Termine le traitement de la requête
    
    if(isset($_POST['creationsID'])) $redirection="creationsModif.php?ID=".$creationsID;
    elseif(isset($_POST['actions_culturellesID'])) $redirection="actionsCulModif.php?ID=".$actions_culturellesID;
    
    header("Location:$redirection");
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>modifier une représentation</title>
  
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
  <div id="container">

    <!-- Fil d'Arianne -->
    <div class="filaire">
    <?php
      define('Compagnie_ATou', 'Accueil', true);
      if(isset($creationsID))
      {
      get_fil_ariane(array('creationsGestion.php' => 'Créations', 'creationsModif.php?ID='.$_GET['ID'] => 'Modification d\'une création', 'final' => 'Modification d\'une représentation'));
      }
      elseif(isset($actions_culturellesID))
      {
      get_fil_ariane(array('actionsCulGestion.php' => 'Actions culturelles', 'actionsCulModif.php?ID='.$_GET['ID'] => 'Modification d\'une action culturelle', 'final' => 'Modification d\'une représentation'));
      }
    ?>
    </div> <!-- fin du fil d'Arianne -->

    <div class="halfPage filaire">
      <h1>Modifier une représentation</h1>
      <form name="form1" method="post" action="representationsModif.php">
      <fieldset>
      <legend>Modification d'une représentation</legend>
        <ul>
          <li>
            <label for="titre">Entrez une salle : </label>
            <input type="text" name="salle" id="salle" value="<?php echo $donnees['salle'];?>">
          </li>
          <li>
            <label for="type">Entrez une ville : </label>
            <input type="text" name="ville" id="ville" value="<?php echo $donnees['ville'];?>">
          </li>
          <li>
            <label for="type">Entrez un pays : </label>
            <input type="text" name="pays" id="pays" value="<?php echo $donnees['pays'];?>">
          </li>
          <li>
            <label for="datepicker">Entrez une date : </label>
            <input type="date" name="dates" id="datepicker" value="<?php echo $donnees['dates'];?>" required/>
          </li>
          <li>
            <label for="heureDebut">Heure de début</label>
            <select name="heureDebut" name="heureDebut" id="heureDebut" class="time" >
            <?php
                for($i=0;$i<24;$i++)
                {
                    echo "<option ";
                    if(isset($donnees["heureDebut"]) AND intval($donnees["heureDebut"]) == $i) echo "selected";
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
                    if(isset($donnees["minuteDebut"]) AND intval($donnees["minuteDebut"]) == $i) echo "selected";
                    echo ">" . sprintf("%02d", $i) . "</option>";
                }
            ?>
            </select>
          </li>
          <li>
            <label for="infos">Autres informations (optionnel) <br />(contact, tarif, ...) : </label>
            <input type="text" name="infos" id="infos" value="<?php echo $donnees["infos"];?>">
          </li>
          <br /><br /><br />
          </li>
            <!-- jQUERY TEXT EDITOR -->
            
            <?php
              if(isset($creationsID))
              {
            ?>
            <p>Infos mobile :</p>
            <textarea name="infosMobile" class="jqte-test" id="res"><?php echo $donnees['infosMobile'];?></textarea>
            
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
            <label for="gps">Coordonnées GPS (site mobile) :</label>
            <input type="text" name="adresseGpsDuLieu" id="gps" value="<?php echo $donnees["adresseGpsDuLieu"];?>" required>
          </li>
          <!--<li>
            <label for="type">Entrez une date : </label>
            <input type="text" name="dates" id="dates" value="<?php //echo $donnees['dates'];?>">
          </li>-->
          <li>
            <input type="submit" name="button" id="button" value="Enregistrer les modifications" class="button-grand">
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
              if(isset($actions_culturellesID))
              {
            ?>
            <input type="hidden" name="actions_culturellesID" id="actions_culturellesID" value="<?php echo $actions_culturellesID; ?>">
            <?php
              }
            ?>
          </li>
          <li>
            <input type="hidden" name="representationsID" id="representationsID" value="<?php echo $representationsID; ?>">
          </li>
        </ul>
      </form>
    </div>
  </div>
</body>
</html>