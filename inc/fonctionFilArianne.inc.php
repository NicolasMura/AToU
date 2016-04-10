<?php
  require_once("../inc/constantes.inc.php");

  function get_fil_ariane($array_fil, $lang)
  {
    $racine = CHEMIN_SITE;
    $fil = '<a href="'.$racine.'/'.$lang.'/index"> ' . Compagnie_ATou . ' </a>';
    foreach($array_fil as $url => $lien)
    {
      $fil .= '  >  ';
      if($url == 'final')
      {
        $fil .= $lien;
        break;
      }
      $fil .= '<a href="' . $url . '" > ' . $lien . '</a>';
    }
    echo $fil;
  }
?>