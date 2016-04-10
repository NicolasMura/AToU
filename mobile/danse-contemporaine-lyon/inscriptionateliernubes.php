<?php
	//début de session
	session_start();
	// connexion à la base
	require_once('../../Connections/connexionMysql.php');
	// gestion des accents
	$bdd->query("SET NAMES 'utf8'");
	// gestion des constantes
	require_once("../inc/constantes.inc.php");
	$url="http://atou.fr/mobile/danse-contemporaine-lyon/inscriptionateliernubes.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
	<title>S'inscrire à l'atelier Nubes</title>

	<!--________reset Eric Meyer________-->
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" />
    
    <!--________feuilles de style________-->
    
    <link href="../css/stylesSmart_md.css" rel="stylesheet" type="text/css" />
    <link href="../css/stylesSmart.css" rel="stylesheet" type="text/css" />
    
    <!--________font Alegreya________-->
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
    
    <!--________Librairies jquery________-->
    
   
</head>

<body id="inscriptionNubes">
		
        <?php if (isset($_SESSION["adherentID"]) AND $_SESSION["adherentID"]!="") { 
          	include("../inc/menuDeroulantAdherent.inc.php");
			 }else{ 
            include("../inc/menuDeroulant.inc.php");
            } ?>
        
        
	<div class="content">

        <?php include("../inc/header.inc.php");?>
        <a href="#superTop" id="top"></a><!--Bouton, top-->
        <h1 class="filAriane">S'inscrire à l'atelier Nubes</h1>
        
        <div class="black bouton" >
            <a href="#" class="toggle">Atelier Nubes</a>
            <div class="deroule">
            
                <p class="titreLegendesNubes">
                    L'atelier Nubes a lieu les deuxièmes samedis de chaque mois,
                    de 10h à 13h, au studio Carmagnole.
                </p>
            
                <p>AToU vous invite à participer à une session de danse-improvisation une fois par mois, au studio Carmagnole. Cette session s’adresse à tous ceux qui, par l’expression du corps, veulent apprendre sur eux-mêmes et sur les autres, que vous soyez professionnels, amateurs ou sans expérience de la danse. Ces sessions seront  guidées par Anan Atoyama,  la chorégraphe d’AToU.</p>
                
                <p class="titreLegendesNubes">* Frais de participation</p>
            
                <p class="legendeNubes">
Lors de votre arrivée pour l’atelier, nous vous demanderons de remplir un bulletin d’adhésion complet et de régler par chèque un montant d’adhésion de 10 euros. L’adhésion est obligatoire pour des raisons d’assurance. Une fois que vous êtes adhérents, tous les ateliers Nubes vous sont accessibles gratuitement.   </p>
				<!--PARTAGE FACEBOOK-->
				 <div><a class="partage" href="#" title="PARTAGER SUR" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u= <?php echo $url; ?>', 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');">PARTAGER SUR</a></div>
				<!--PARTAGE FACEBOOK-->
          </div>
        </div>
        
        <p>&nbsp;</p>

        <h3>Vous êtes déjà adhérent(e) et possédez déjà un identifiant?</h3>
        
       <form action="<?php echo CHEMIN_SITE_MOBILE;?>/adherents/index.php" method="post" enctype="application/x-www-form-urlencoded">
            <ul>
                <li>
                <input type="submit" value="Cliquer ici" id="val" class="val"/> <!--renvoie au formulaire connexionAdh-->
                </li>
            </ul>
		</form>
       
        <h3>Vous n'êtes pas encore adhérent(e)?<br/>Pour pouvoir participer à l'atelier Nubes,<br/>merci de remplir ce formulaire.</h3>
            
        <form method="post" action="" enctype="text/plain">
          
            <ul>
                <li>
                    <label for="civilité" class="labelChamps">Civilité</label>
        
          			<div class="md_square">
                        <label for="civiliteMME">mme</label>
                        <input type="radio" value="madame" class="md_squaredOne" name="civilite" id="civiliteMME" />
                    </div>
        
                    <div class="md_square">
                        <label for="civiliteM">m</label>
                        <input type="radio" value="monsieur" class="md_squaredOne" name="civilite" id="civiliteM" />
                    </div> 
                </li>
                
                <li>
                    <label for="nom" class="labelChamps">Nom <i>( champ obligatoire )</i> </label>
                    <input type="text" id="nom" name="nom" value="" class="champs"/>
                </li>
                <li>
                    <label for="prenom" class="labelChamps">Prénom <i>( champ obligatoire )</i></label>
                    <input type="text" id="prenom" name="prenom" value="" class="champs"/>
                </li>
                <li>
                    <label for="mail" class="labelChamps">Mail <i>( champ obligatoire )</i></label> 
                    <input type="email" name="mail" id="mail" class="champs"/> 
                </li>
                <li>
                    <label for="tel" class="labelChamps">Téléphone </label>
                    <input type="tel" name="téléphone" id="tel" class="champs"/> 
                </li>
                
                <li>
                    <label for="dateNaissance" class="labelChamps2">Date de naissance</label>
                    
                        <div class="md_square2">
                            <label for="datenaissanceJour">Jour</label>
                            <input type="j" name="jour" class="champs2" /> 
                        </div>
            
                        <div class="md_square2">
                            <label for="datenaissanceMois">Mois</label>
                            <input type="m" name="mois" class="champs2" /> 
                        </div> 
                        
                        <div class="md_square2">
                            <label for="datenaissanceAnnee">Année</label>
                            <input type="a" name="annee" class="champs2" />
                        </div>
                       
            	</li>
               
                 <li>
                     <label for="val"></label>
                     <input type="submit" value="Valider" id="val" class="val" />
                 </li>
                 
                                    
            </ul>
           
        </form>
        
        	<h3>Pour plus d'informations,<br/>
            contactez notre administrateur.
            </h3>
            
            <address>
                <a href ="mailto:administration@atou.fr">administration@atou.fr</a>
            </address>
        
        <h3>Merci.<br/>
            Votre inscription a bien été prise<br/>
            en compte, vous allez recevoir<br/>
            un mail de confirmation.</h3>
        
        <p>&nbsp;</p>


	<?php include("../inc/footer.inc.php");?>
        
	</div>
    
	 <!--________Librairies jquery________-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
 	<script type="text/javascript" charset="utf-8" src="../../jquery/nav-left.js"></script>
	<script src="../../jquery/toggle.js" type="text/javascript"></script>
    <script src="../../jquery/topButtonMobile.js" type="text/javascript"></script>
    
    <script>
	$('.partage').css({
    width:'177px',
	margin:'0 auto',
	heigth:'44px',
	lineHeight : '44px' ,
	padding:'0 0 0 20px',
	fontWeight:'300',
	fontSize:'18px',
	color:'white',
	background:'#82358A',
	border:'2px solid white',
	backgroundImage:'url(../../img/mobilePictoFacebookWhite.png)',
	backgroundRepeat:'no-repeat',
	backgroundPosition:'135px',
	marginTop:'10px',
	marginBottom:'20px'
});
	</script>
    

    
</body>
</html>


