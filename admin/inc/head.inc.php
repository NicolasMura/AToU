<!-- reset Eric Meyer -->
<link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/css/resetAdmin.css" />
<!-- feuille de style -->
<link rel="stylesheet" href="<?php echo CHEMIN_SITE;?>/admin/css/styleAdmin_nm.css" type="text/css"/>
<!-- font Alegreya -->
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,100,300,500,800,700' rel='stylesheet' type='text/css'>
<!-- feuille de style pour plugin richtext jQuery -->
<link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_SITE;?>/css/jquery-te-1.4.0.css">
<!-- feuille de style pour plugin jQuery Datepicker (à changer si pas beau) -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/black-tie/jquery-ui.css">
<!-- feuille de style pour plugin Form Validation -->
<link href="<?php echo CHEMIN_SITE;?>/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
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

<!-- Librairies jquery -->
<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/jquery.min.js" charset="utf-8"></script>
<!-- Plugin richtext jQuery -->
<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<!-- jQuery UI Datepicker - Default functionality -->
<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/jquery-ui.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo CHEMIN_SITE;?>/jquery/datepicker-fr.js" charset="utf-8"></script>
<!-- js pour plugin Form Validation -->
<script src="<?php echo CHEMIN_SITE;?>/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<!-- LiveRoad -->
<?php
  if($_SERVER["HTTP_HOST"] == "atou.local"){
    echo "
      <script>document.write('<script src=\"http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1\"></' + 'script>')
      </script>
      ";
    }
?>