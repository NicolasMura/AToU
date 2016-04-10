<?php
  session_start();
  // Connexion BDD
  require_once('../Connections/connexionMysql.php');
  // Gestion des accents
  $bdd->query("SET NAMES 'utf8'");
  // Gestion des constantes 
  require_once("../inc/constantes.inc.php");
  // Protection pages admin (sauf l'index)
  if(!preg_match("/index/", $_SERVER['SCRIPT_NAME'])
      AND !preg_match("/loginErreur/", $_SERVER['SCRIPT_NAME'])
      AND !preg_match("/loginRecover/", $_SERVER['SCRIPT_NAME'])
      AND !preg_match("/loginResetPassword/", $_SERVER['SCRIPT_NAME'])
      AND !preg_match("/loginResetPasswordConf/", $_SERVER['SCRIPT_NAME']))
    include('inc/protectionAdmin.inc.php');
  // Fil d'ariane
  include('inc/fonctionFilArianne.inc.php');
  // Gestion des photos 
  require_once('tools/toolsPhotos.php');
  // Gestion du nettoyage des noms de créations pour le nommage des photos
  require_once('tools/toolsCaracteres.php');
  // Fonction mail
  require("inc/fonctionMailGoogle.php");
  // Autres
  require_once('tools/toolsDateCompare.php');
  require_once('tools/toolsDateTime.php');
?>