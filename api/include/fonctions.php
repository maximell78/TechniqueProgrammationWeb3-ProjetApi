<?php

function ConversionForfaitSQLEnObjet($forfaitsSQL) {

    $forfaitsOBJ = new stdClass();
    $forfaitsOBJ->region = $forfaitsSQL["region"];
    $forfaitsOBJ->destination = $forfaitsSQL["destination"];
    $forfaitsOBJ->villeDepart = $forfaitsSQL["villeDepart"];
    $forfaitsOBJ->dateDepart = $forfaitsSQL["dateDepart"];
    $forfaitsOBJ->dateRetour = $forfaitsSQL["dateRetour"];
    $forfaitsOBJ->prix = $forfaitsSQL["prix"];
    $forfaitsOBJ->rabais = $forfaitsSQL["rabais"];
    $forfaitsOBJ->affichageRabais = $forfaitsSQL["affichageRabais"];
    $forfaitsOBJ->nouveauPrix = $forfaitsSQL["nouveauPrix"];
    $forfaitsOBJ->vedette = $forfaitsSQL["vedette"];

    $forfaitsOBJ->hotel = new stdClass();
    $forfaitsOBJ->hotel->nom = $forfaitsSQL["nom"];
    $forfaitsOBJ->hotel->coordonnees = $forfaitsSQL["coordonnees"];
    $forfaitsOBJ->hotel->nombreEtoiles = $forfaitsSQL["nombreEtoiles"];
    $forfaitsOBJ->hotel->nombreChambres = $forfaitsSQL["nombreChambres"];
    $forfaitsOBJ->hotel->description = $forfaitsSQL["description"];
    $forfaitsOBJ->hotel->caracteristiques = explode(";", $forfaitsSQL["caracteristiques"]);
    $forfaitsOBJ->hotel->avis = $forfaitsSQL["avis"];

    return $forfaitsOBJ;
}   

?>