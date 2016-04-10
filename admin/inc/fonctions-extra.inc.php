<?php
function FRtoUK($dateFR){
$tabDateFR=explode("-", $dateFR);
$dateUK=$tabDateFR[2]."-".$tabDateFR[1]."-".$tabDateFR[0];
return $dateUK;
}
function UKtoFR($dateUK){
$tabDateUK=explode("-", $dateUK);
$dateFR=$tabDateUK[2]."-".$tabDateUK[1]."-".$tabDateUK[0];
return $dateFR;
}
?>