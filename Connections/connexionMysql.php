<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
try
{
  // On se connecte à MySQL
  if($_SERVER["HTTP_HOST"] == "localhost" OR $_SERVER["HTTP_HOST"] == "atou.local" OR $_SERVER["HTTP_HOST"] == "portfolio.local") // Serveur WAMP local sur PC
  {
    $bdd = new PDO('mysql:host=localhost;dbname=atoufr', 'nmura', 'TRmjr7Uf!vfVaHIN');
  }
  elseif($_SERVER["HTTP_HOST"] == "localhost:8888") // Serveur MAMP local sur MAC
  {
    $bdd = new PDO('mysql:host=localhost;dbname=atoufr', 'root', 'root');
  }
  elseif($_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh"
          OR $_SERVER["HTTP_HOST"] == "mobileatou.nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.mobileatou.nicolasmura.ovh") // Serveur distant OVH mutualisé perso
  {
    $bdd = new PDO('mysql:host=nicolasmmznm.mysql.db;dbname=nicolasmmznm', 'nicolasmmznm', '64H7ogDkh2J6');
  }
  else
  {
    $bdd = new PDO('mysql:host=mysql.atou.fr;dbname=atoufr', 'atoufr', '2fBEAU&4lun'); // Serveur distant AToU (Infomaniak)
  }
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
  die('Erreur : '.$e->getMessage());
}

// Ajout Nico 15/04/2015 : protection de toutes les pages du site (FO + BO) pour espace projet (portfolio.local, nicolasmura.ovh, ...)
if($_SERVER["HTTP_HOST"] == "portfolio.local" OR $_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh")
{
  // Si on est à la racine de l'espace adhérents
  if(preg_match("/admin/", $_SERVER['SCRIPT_NAME']) == 1)
  {
    include('../../inc/protectionPagesProjets.inc.php');
    /*echo "<span style='background-color:red'>preg_match /admin/ OK</span>";*/
  }
  elseif(preg_match("/adherents/", $_SERVER['SCRIPT_NAME']) == 1)
  {
    include('../../inc/protectionPagesProjets.inc.php');
    /*echo "<span style='background-color:red'>preg_match /adherents/ OK</span>";*/
  }
  // Si on est à la racine du site (index.php)
  elseif(preg_match("/index/", $_SERVER['SCRIPT_NAME']))
  {
    include('../inc/protectionPagesProjets.inc.php');
    /*echo "<span style='background-color:red'>preg_match /index/ OK</span>";*/
  }
  // Sinon, pour toutes les autres pages placées dans un dossier qui est à la racine du site
  else
  {
    include('../../inc/protectionPagesProjets.inc.php');
    /*echo "<span style='background-color:red'>preg_match 'autres' OK</span>";*/
  }
}
?>