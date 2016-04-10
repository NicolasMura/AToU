<?php
if($_SERVER["HTTP_HOST"] == "localhost")
{
	define("CHEMIN_SITE", "http://localhost/SITEatou"); // PC local Nico
	define("CHEMIN_SITE_MOBILE", "http://localhost/SITEatou/mobile"); // PC local Nico
}

elseif($_SERVER["HTTP_HOST"] == "172.18.33.68:8888")
{
	define("CHEMIN_SITE", "http://172.18.33.68:8888/SITEatou"); // Smartphone Nico local - WiFi Gobelins
	define("CHEMIN_SITE_MOBILE", "http://172.18.33.68:8888/SITEatou/mobile"); // Smartphone Nico local - WiFi Gobelins
}

elseif($_SERVER["HTTP_HOST"] == "172.18.33.195:8888")
{
	define("CHEMIN_SITE", "http://172.18.33.195:8888/SITEatou"); // iPhone Manon local - WiFi Gobelins
	define("CHEMIN_SITE_MOBILE", "http://172.18.33.195:8888/SITEatou/mobile"); // iPhone Manon local - WiFi Gobelins
}

elseif($_SERVER["HTTP_HOST"] == "172.18.33.132:8888")
{
	define("CHEMIN_SITE", "http://172.18.33.132:8888/SITEatou"); // iPhone Jerome local - WiFi Gobelins
	define("CHEMIN_SITE_MOBILE", "http://172.18.33.132:8888/SITEatou/mobile"); // iPhone Jerome local - WiFi Gobelins
}

elseif($_SERVER["HTTP_HOST"] == "172.18.33.88:8888")
{
	define("CHEMIN_SITE", "http://172.18.33.88:8888/SITEatou"); // iPhone Roger local - WiFi Gobelins
	define("CHEMIN_SITE_MOBILE", "http://172.18.33.88:8888/SITEatou/mobile"); // iPhone Roger local - WiFi Gobelins
}

elseif($_SERVER["HTTP_HOST"] == "192.168.0.16")
{
	define("CHEMIN_SITE", "http://192.168.0.16/SITEatou"); // Smartphone local Nico
	define("CHEMIN_SITE_MOBILE", "http://192.168.0.16/SITEatou/mobile"); // Smartphone local Nico
}

elseif($_SERVER["HTTP_HOST"] == "localhost:8888")
{
	define("CHEMIN_SITE", "http://localhost:8888/SITEatou"); // Mac local
	define("CHEMIN_SITE_MOBILE", "http://localhost:8888/SITEatou/mobile"); // Mac local
}

elseif($_SERVER["HTTP_HOST"] == "www.atou.fr")
{
	define("CHEMIN_SITE", ""); // Serveur distant
	define("CHEMIN_SITE_MOBILE", "/mobile"); // Serveur distant
}

elseif($_SERVER["HTTP_HOST"] == "atou.fr")
{
	define("CHEMIN_SITE", ""); // Serveur distant
	define("CHEMIN_SITE_MOBILE", "/mobile"); // Serveur distant
}

elseif($_SERVER["HTTP_HOST"] == "mobile.atou.fr")
{
	define("CHEMIN_SITE", ""); // Serveur distant
	define("CHEMIN_SITE_MOBILE", "/mobile"); // Serveur distant
}
?>