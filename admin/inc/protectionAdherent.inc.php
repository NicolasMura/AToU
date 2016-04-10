<?php
  // gestion des constantes
  require_once("../inc/constantes.inc.php");
    
  if (!isset($_SESSION)) {
    session_start();
  }
  if($_SERVER["HTTP_HOST"] != "portfolio.local" AND $_SERVER["HTTP_HOST"] != "nicolasmura.ovh")
  {
    $MM_authorizedUsers = "adherent";
    $MM_donotCheckaccess = "false";
  }
  else
  {
    $MM_authorizedUsers = "admin";
    $MM_donotCheckaccess = "false";
  }

  // *** Restrict Access To Page: Grant or deny access to this page
  if($_SERVER["HTTP_HOST"] != "portfolio.local" AND $_SERVER["HTTP_HOST"] != "nicolasmura.ovh") /* Pour ne pas redéclarer la fonction si le site est intégré dans un espace projet sécurisé (portfolio.local, nicolasmura.ovh, ...)
  A améliorer : obligation de se reconnecter dans l'espace projet après connexion à l'espace adhérents... */
  {
    function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
      // For security, start by assuming the visitor is NOT authorized. 
      $isValid = False; 

      // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
      // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
      if (!empty($UserName)) { 
        // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
        // Parse the strings into arrays. 
        $arrUsers = Explode(",", $strUsers); 
        $arrGroups = Explode(",", $strGroups); 
        if (in_array($UserName, $arrUsers)) { 
          $isValid = true; 
        } 
        // Or, you may restrict access to only certain users based on their username. 
        if (in_array($UserGroup, $arrGroups)) { 
          $isValid = true; 
        } 
        if (($strUsers == "") && false) { 
          $isValid = true; 
        } 
      } 
      return $isValid; 
    }
  }

  if($_SERVER["HTTP_HOST"] == "portfolio.local" 
    OR $_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh"
    OR $_SERVER["HTTP_HOST"] == "nicolasmura.fr" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.fr") $MM_restrictGoTo = CHEMIN_PROJETS.'/index.php';/* Test mutualisé OVH */
  else $MM_restrictGoTo = "index.php";
  if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
    if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
    $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
    $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: ". $MM_restrictGoTo); 
    exit;
  }
?>