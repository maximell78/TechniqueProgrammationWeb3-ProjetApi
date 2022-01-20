<?php

function ConversionForfaitSQLEnObjet($forfaitsSQL) {

    $forfaitsOBJ->infoVol = new stdClass();
    $forfaitsOBJ->infoVol-> destination = $forfaitsSQL["destination"];
    $forfaitsOBJ->infoVol-> villeDepart = $forfaitsSQL["villeDepart"];
    $forfaitsOBJ->infoVol-> dateRetour = $forfaitsSQL["dateRetour"];
    $forfaitsOBJ->infoVol-> prix = $forfaitsSQL["prix"];
    $forfaitsOBJ->infoVol-> rabais = $forfaitsSQL["rabais"];
    $forfaitsOBJ->infoVol-> affichageRabais = $forfaitsSQL["affichageRabais"];
    $forfaitsOBJ->infoVol-> nouveauPrix = $forfaitsSQL["nouveauPrix"];
    $forfaitsOBJ->infoVol-> vedette = $forfaitsSQL["vedette"];

    $forfaitsOBJ->hotel = new stdClass();
    $forfaitsOBJ->hotel->nom = $forfaitsSQL["nom"];
    $forfaitsOBJ->hotel->coordonnees = $forfaitsSQL["coordonnees"];
    $forfaitsOBJ->hotel->nombreEtoiles = $forfaitsSQL["nombreEtoiles"];
    $forfaitsOBJ->hotel->nombreChambres = $forfaitsSQL["nombreChambres"];
    $forfaitsOBJ->hotel->description = $forfaitsSQL["description"];
    $forfaitsOBJ->hotel->caracteristiques = $forfaitsSQL["caracteristiques"];
    $forfaitsOBJ->hotel->avis = $forfaitsSQL["avis"];

    return $forfaitsOBJ;
}   

?>