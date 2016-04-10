<?php
  // début de session
  session_start();
  // connexion à la base
  require_once('../Connections/connexionMysql.php');
  // gestion des accents
  $bdd->query("SET NAMES 'utf8'");
  
  // gestion des constantes
  require_once("../inc/constantes.inc.php");
  
  // Gestion des langues (champs "statiques" du front-office)
  include("../lang/langTools/lang.inc.php");
  require("../lang/lang.php");
  $lang = "fr";
  
  // gestion du fil d'Ariane
  include('../inc/fonctionFilArianne.inc.php');
  
  // Autres 
  require("../admin/inc/fonctionMailGoogle.php");
  
  /* ------------------------------------------- Récupération des infos formulaire 1 (login) ----------------------------------- */
  
  if(isset($_POST["env"]))
  {
    if(isset($_POST['identifiant']) AND isset($_POST['pass']) AND $_POST['identifiant'] != "" AND $_POST['pass'] != "")
    {
      $login=$_POST["identifiant"];
      $pass=md5($_POST["pass"]);
      $requeteSql="SELECT login, motDePasse, niveau, ID FROM adherents WHERE login='".$login."' AND motDePasse='".$pass."'";
      $reponse = $bdd->query($requeteSql); // exécution de la requête sql
      $donnees = $reponse->fetch(); //récupérer résultats de la requête Mysql et mis dans une variable $donnees
      
          if($pass == $donnees[1] AND $login == $donnees[0])
          {
          
          //declare two session variables and assign them
          $_SESSION['MM_Username'] = $donnees[0];
          $_SESSION['MM_UserGroup'] = $donnees[2];
          // Ajout Nico
          $_SESSION['adherentID'] = $donnees["ID"];
          // envoi à accueil.php
          header("Location:accueilAdherents.php");
          }
          // sinon envoi à loginErreur.php
          else
          {
             $erreurLogin = "Le login ou mot de passe indiqué est incorrect. Merci de le saisir à nouveau.";
             //header("Location:index.php");
          }
      $reponse-> closeCursor();
    }
    else $erreurLogin = "Vous devez entrer un identifiant et un mot de passe.";
  }
  
  /* ------------------------------------------- Récupération des infos formulaire 2 (récupération mdp) ----------------------------------- */
  
  if(isset($_POST["env2"]))
  {
    if(isset($_POST['mail']) AND $_POST["mail"] != '')
    {
      $email = $_POST['mail'];
      // requete vers la base
      $query = 'SELECT login, motDePasse, mail, nom, prenom FROM adherents WHERE mail="'.$email.'"';
      $reponse = $bdd->query($query);
      $nbreReponse = $reponse->rowCount();
      
      //Si la requête s'est exécutée avec succès      
      if($nbreReponse > 0)
      {
        $res = $reponse->fetch();
        
        //Si le login a été trouvé dans la base
        if($res["login"] AND $res['prenom']  AND $res['nom'])
        {
          //Envoi d'un message avec le pwd
          $obj="Récupération du login et mot de passe";
          $mess="Bonjour ".$res['prenom'].", \r\n <br /><br />Voici votre mot de passe et login : \r\n <br />";
          $mess.="-----------------------<br />"; 
          $mess.="Login : ".$res['login']." \r\n <br />"; 
          $mess.="Mot de passe : ".$res['motDePasse']." \r\n <br />";  
          $mess.="-----------------------<br /> \r\n";
          $mess.="L'équipe ATOU <br /> \r\n"; 
          
          $mailfrom = $res['mail']; 
          $namefrom="EMETTEUR";
          $mailto=$email; 
          $nameto="DESTINATAIRE";     
  
          if(($mailto!="")&&($mailto!=NULL))  
          {
            //authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess); 
            mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
            //header("Location:index.php");
            $messageMailOK = "Nous venons de vous adresser un mail avec votre mot de passe."; 
          } 
        }
      }
      else
      {
        $erreurMailInconnu = "Erreur : email inconnu. Veuillez vous identifier ou saisir une autre adresse mail.";
      }
    }
    else $erreurMail = "Vous devez entrer une adresse mail.";
  }
  
  /* ------------------------------------------- Récupération des infos formulaire 3 (participer) ----------------------------------- */
  
  if(isset($_POST["env3"]))
  {
    if(isset($_POST['mail']) AND $_POST["mail"] != ''
      AND isset($_POST['nom']) AND $_POST["nom"] != ''
      AND isset($_POST['prenom']) AND $_POST["prenom"] != ''
      AND isset($_POST['anniv']) AND $_POST["anniv"] != '')
    { 
      $email = $_POST['mail'];
      if(isset($_POST['civilite'])) $civilite = $_POST['civilite'];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $anniv = $_POST['anniv'];
      if(isset($_POST['tel'])) $tel = $_POST['tel'];
      
      // requete vers la base
      $query = 'SELECT mail FROM adherents WHERE mail="'.$email.'"';
      $reponse = $bdd->query($query);
      $nbreReponse = $reponse->rowCount();
      
      //Si l'email n'est pas déjà en base de données, on traite la demande
      if($nbreReponse == 0)
      {
        //Envoi d'un message
        $obj = "Demande d'inscription.";
        $mess = "Bonjour, \r\n <br />Un internaute vous a demandé de l'inscrire en tant qu'adhérent AToU : \r\n <br />";
        $mess .= "-----------------------<br />"; 
        if(isset($civilite)) $mess .= "Civilité : ".$civilite." \r\n <br />"; 
        $mess .= "Nom : ".$nom." \r\n <br />"; 
        $mess .= "Prénom : ".$prenom." \r\n <br />";  
        $mess .= "Email : ".$email." \r\n <br />";
        $mess .= "Année de naissance : ".$anniv." \r\n <br />";
        if(isset($anniv)) $mess .= "Téléphone : ".$tel." \r\n <br />";  
        $mess .= "-----------------------<br /> \r\n";
        
        $mailfrom = $email; 
        $namefrom = "EMETTEUR";
        $mailto = $email; 
        $nameto = "DESTINATAIRE";     
        
        if(($mailto!="")&&($mailto!=NULL))  
        {
          //authgMail($mailfrom, $namefrom, $mailto, $nameto, $obj, $mess); 
          mail($mailto,$obj,$mess,"From:".$namefrom."\r\nReply-to:".$mailfrom."\r\nContent-type:text/html;charset=utf-8");
          //header("Location:index.php");
          $messageInscriptionOK = "Nous avons bien reçu votre demande, et vous en remercions.
            Nous vous enverrons rapidement un mail avec votre identifiant et votre mot de passe.";  
        } 
      }
      else
      {
        $erreurMailDejaPris = "Cette adresse mail est déjà associée à un compte adhérent. Veuillez vous identifier ou saisir une autre adresse mail.";
      }
    }
    else $erreurParticiper = "Les champs nom, prénom, mail et date de naissance sont obligatoires.";
  }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login adhérent erreur</title>
    
    <!--_____reset Eric Meyer_____-->
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <!--_____feuille de style_____-->
    
    <link href="../css/stylesScreen.css" rel="stylesheet" type="text/css"/>
    <link href="../css/stylesScreen_cv.css" rel="stylesheet" type="text/css"/>
    <link href="../css/stylesScreen_jf.css" rel="stylesheet" type="text/css"/>
    
    <!--_____font Alegreya_____-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    <!-- favIcon -->    
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo CHEMIN_SITE;?>/favicon/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo CHEMIN_SITE;?>/favicon/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <script>
    
    $(document).ready(function(e){
      $("#nm_bloc2").css({"display":"none"});
      $("#nm_bloc3").css({"display":"none"});
      $("#nm_bloc5").css({"display":"none"});
      $("#nm_bloc6").css({"display":"none"});
      $("#nm_bloc7").css({"display":"none"});
      
      $("#nm_bloc1Lien").click(function(){
        $("#nm_bloc2").fadeIn(1000);
        $("#nm_bloc3").fadeIn(1000);
        $("#nm_bloc2").css({"display":"block"});
        $("#nm_bloc3").css({"display":"block"});
      });
      
      $(".nm_boutonParticipez").click(function(){
        $("#nm_bloc4").fadeOut(1000);
        $("#nm_bloc5").fadeIn(1000);
        $("#nm_bloc6").fadeIn(1000);
        $("#nm_bloc7").fadeIn(1000);
        $("#nm_bloc4").css({"display":"none"});
        $("#nm_bloc5").css({"display":"block"});
        $("#nm_bloc6").css({"display":"block"});
        $("#nm_bloc7").css({"display":"block"});
      });
      
      $(".nm_callToAction4").click(function(){
        $("#nm_bloc1").css({"display":"block"});
        $("#nm_bloc2").css({"display":"none"});
        $("#nm_bloc3").css({"display":"none"});
        $("#nm_bloc4").css({"display":"block"});
        $("#nm_bloc5").css({"display":"none"});
        $("#nm_bloc6").css({"display":"none"});
        $("#nm_bloc7").css({"display":"none"});
      });
      
    });
    
  </script>
    
  <style>
    .nm_callToAction4{
      width:120px;
      height:45px;
      line-height:45px;
      //background-color:#81358A;
      font-family:"Alegreya Sans";
      font-weight:300;
      color:black;
      font-size:20px;
      //text-align:center;
      padding:10px;
      border: 1px solid none;
      margin:0 48px 0 0;
      //float:right;
      text-transform:uppercase;
    }
    .nm_marginTop{
      margin-top:30px;
    }
    .nm_boutonParticipez{
      width:120px;
      height:45px;
      line-height:45px;
      background-color:#81358A;
      font-family:"Alegreya Sans";
      font-weight:300;
      color:#FFF;
      font-size:20px;
      text-align:center;
      padding:10px;
      border:none;
      margin:0 10px;
      padding:0;
      float:right;
      text-transform:uppercase;
    }
    .nm_boutonParticipez a{
      width:120px;
      line-height:45px;
    }
    .nm_boutonParticipez:hover{
      background-color:#6E2C77;
      color:white;
    }
    .texteFormulaire3 a{
      color:black;
      }
    .erreur{
      color:red;
    }
  </style>

  <!-- LiveRoad -->
  <?php 
    if($_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") include("../inc/livereload.php");
  ?>
</head>

<body>

  <div id="superTop"></div> <!--Bouton, top-->
    <!--___________Menu header___________-->
    
    <div class="bgheader">
        <div id="entete">
            <header>
                <?php
                  include("../inc/menuFront.inc.php");
                ?>
            </header>  
        </div> 
    </div>
        
    <!--___________Fin Menu header___________-->
    
  <div class="fondNoir">
        
        <section>
            
            <!--___________ Fil d'Arianne___________-->
            <div class="filaire">
                <?php
                    define('Compagnie_ATou', 'Accueil &nbsp;', true);
                ?>
                <p class="filAriane"><?php get_fil_ariane(array('accueilAdherents.php' => '&nbsp; Espace adhérents &nbsp;', 
                    'final' => '&nbsp; Connexion'), $lang);?></p>
            </div>
            <!--_____________________________________-->
      
            <h1>LOGIN ADHERENT</h1>
                            
        <div class="fondWhite">
    
        <a href="#superTop" id="top"></a><!--Bouton, top-->
            
              <?php 
          include("loginAdherentForm.php");
        ?>
            
            </div>            
            
        </section>

    </div>
   
  
   
    <!--___________Menu footer___________-->

  <div id="bgfooter">
      <div id="pied">
        <footer>
        <?php
          include("../inc/footerFront.inc.php");
          ?>
      </footer>
    </div>
    </div>

  <!--___________Fin Menu footer___________-->
    
    <!--Bouton super top-->
  <script src="../jquery/topButton.js" type="text/javascript"></script>
    
</body>
</html>