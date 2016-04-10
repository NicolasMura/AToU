<?php
          function get_fil_ariane($array_fil) {
        $fil = '<a href="accueil.php">' . Compagnie_ATou . '</a>';
        foreach($array_fil as $url => $lien) {
            $fil .= ' > ';
            if($url == 'final') {
                $fil .= $lien;
                break;
            }
            $fil .= '<a href="' . $url . '">' . $lien . '</a>';
        }
        echo $fil;
    }