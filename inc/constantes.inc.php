<?php
  // Adresse newsletter AToU
  if($_SERVER["HTTP_HOST"] == "atou.fr" OR $_SERVER["HTTP_HOST"] == "www.atou.fr")
  {
    define("EMAIL_ATOU_ADMIN", "marc@atou.fr");
  }
  elseif($_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh")
  {
    define("EMAIL_ATOU_ADMIN", "contact@nicolasmura.fr");
  } 

  // Gestion des liens
  if($_SERVER["HTTP_HOST"] == "atou.local")
  {
    define("CHEMIN_SITE", ""); // PC local Nico
    define("CHEMIN_SITE_MOBILE", "/mobile"); // PC local Nico
  }

  elseif($_SERVER["HTTP_HOST"] == "portfolio.local")
  {
    define("CHEMIN_SITE", "/projets/AToU"); // Serveur distant mutualisé perso OVH
  }
  
  elseif($_SERVER["HTTP_HOST"] == "172.18.33.107:8888")
  {
    define("CHEMIN_SITE", "/SITEatou"); // Smartphone Nico local - WiFi Gobelins
    define("CHEMIN_SITE_MOBILE", "/SITEatou/mobile"); // Smartphone Nico local - WiFi Gobelins
  }
  
  elseif($_SERVER["HTTP_HOST"] == "172.18.33.245:8888")
  {
    define("CHEMIN_SITE", "http://172.18.33.245:8888/SITEatou"); // iPad Cécile local - WiFi Gobelins
    define("CHEMIN_SITE_MOBILE", "http://172.18.33.245:8888/SITEatou/mobile"); // iPad Cécile local - WiFi Gobelins
  }
  
  elseif($_SERVER["HTTP_HOST"] == "192.168.0.16")
  {
    define("CHEMIN_SITE", "http://192.168.0.16/AToU"); // Smartphone local Nico
    define("CHEMIN_SITE_MOBILE", "http://192.168.0.16/AToU/mobile"); // Smartphone local Nico
  }
  
  elseif($_SERVER["HTTP_HOST"] == "172.18.33.119:8888")
  {
    define("CHEMIN_SITE", "http://172.18.33.119:8888/SITEatou"); // iPad Jérôme local - WiFi Gobelins
    define("CHEMIN_SITE_MOBILE", "http://172.18.33.119:8888/SITEatou/mobile"); // iPad Jérome local - WiFi Gobelins
  } 
  
  elseif($_SERVER["HTTP_HOST"] == "localhost:8888")
  {
    define("CHEMIN_SITE", "/SITEatou"); // Mac local
    define("CHEMIN_SITE_MOBILE", "/SITEatou/mobile"); // Mac local
  }
  
  elseif($_SERVER["HTTP_HOST"] == "atou.fr" OR $_SERVER["HTTP_HOST"] == "www.atou.fr")
  {
    define("CHEMIN_SITE", ""); // Serveur distant
    define("CHEMIN_SITE_MOBILE", "/mobile"); // Serveur distant
  }
  elseif($_SERVER["HTTP_HOST"] == "nicolasmura.ovh" OR $_SERVER["HTTP_HOST"] == "www.nicolasmura.ovh")
  {
    define("CHEMIN_SITE", "/projets/AToU"); // Serveur distant mutualisé perso OVH
    define("CHEMIN_SITE_MOBILE", "/projets/AToU/mobile"); // Serveur distant mutualisé perso OVH
  }
  else
  {
    echo "Erreur : chemin absolu du site non défini !";
  }
?>