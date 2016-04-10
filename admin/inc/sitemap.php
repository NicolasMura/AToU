<?php
  require_once('Connections/connexionMysql.php');

  // Recensement de toutes les créations et actions culturelles enregistrées

  $requete = "SELECT ID, urlRewrite FROM creations WHERE statut != 'creationArchivee'";
  $reponse = $bdd->query($requete);
  $urlsCreations = "";
  $j = 0;
  while($donnees = $reponse->fetch())
  {
    $urlsCreations = $donnees["urlRewrite"]."-".$donnees["ID"];
    $urlsCreationsSitemap .= 
"<url>
  <loc>http://atou.fr/fr/creations/".$urlsCreations."</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
";
    $j++;
  }
  $reponse->closeCursor();

  $requete = "SELECT ID, urlRewrite FROM actions_culturelles";
  $reponse = $bdd->query($requete);
  $urlsActionsCulturelles = "";
  $j = 0;
  while($donnees = $reponse->fetch())
  {
    $urlsActionsCulturelles = $donnees["urlRewrite"]."-".$donnees["ID"];
    $urlsActionsCulturellesSitemap .= 
"<url>
  <loc>http://atou.fr/fr/actions-artistiques/".$urlsActionsCulturelles."</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
";
    $j++;
  }
  
  /*echo "<pre>";
  print_r($urlsActionsCulturellesSitemap);
  echo "</pre>";*/

  // Génération du sitemap.xml

  $sitemapContent =  
'<?xml version="1.0" encoding="UTF-8"?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc>http://atou.fr/fr/index</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/fr/compagnie</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/fr/creations</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/fr/actions-artistiques</loc>
  <changefreq>monthly</changefreq>
  <priority>0.9</priority>
</url>
'.
$urlsCreationsSitemap.
$urlsActionsCulturellesSitemap.
'<url>
  <loc>http://atou.fr/newsletter</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/partenaires</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/sitemap</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/mentions-legales</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/contact</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
<url>
  <loc>http://atou.fr/contactPro</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
</urlset>'
;

  /*$sitemap = fopen('../sitemap.xml', 'w'); // Ouverture du fichier sitemap.xml 
  fputs($sitemap, $sitemapContent); // Ecriture dans le fichier
  fclose($sitemap); // Fermeture du fichier*/
  echo $sitemapContent;
?>