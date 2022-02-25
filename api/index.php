<?php
include_once 'include/config.php';
include_once 'include/fonctions.php';

header("Content-Type: application/json; Charset=UTF-8");
header('Access-Control-Allow-Origin: *');

    $mysqli = new mysqli($host, $username, $password, $database);
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue 
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error; 
        exit(); 
    }
	switch($_SERVER['REQUEST_METHOD']) { 
		case 'GET': // GESTION DES DEMANDES DE TYPE GET
			if(isset($_GET['id'])) {                
                $requete = $mysqli->prepare("SELECT * FROM forfaits WHERE id=?");                
				$requete->bind_param("i", $_GET['id']); // Envoi des paramètres à la requête
                $requete->execute(); // Exécution de la requête
                $resultat_requete = $requete->get_result(); // Récupération de résultats de la requête
                $forfaitsOBJ = $resultat_requete->fetch_assoc(); // Récupération de l'enregistrement
                $forfaitsOBJ = ConversionForfaitSQLEnObjet($forfaitsOBJ);
                echo json_encode($forfaitsOBJ, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
                $requete->close();
            } else { 
				$requete = $mysqli->query("SELECT * FROM forfaits");
                $listeForfaitsObj = [];
                while ($forfaitsSQL = $requete->fetch_assoc()){
                    $forfaitsOBJ = ConversionForfaitSQLEnObjet($forfaitsSQL);
                    array_push($listeForfaitsObj, $forfaitsOBJ);
                }
                echo json_encode($listeForfaitsObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
                $requete->close();
			} 
			break;
		 case 'POST': // GESTION DES DEMANDES DE TYPE POST 
            $reponse = new stdClass(); 
            $reponse->message = "Ajout d'un forfait: "; 

			$corpsJSON = file_get_contents('php://input'); 
            $data = json_decode($corpsJSON, TRUE);

            $region = $data['region'];
            $destination = $data['destination'];
            $villeDepart = $data['villeDepart'];
            $dateDepart = $data['dateDepart'];
            $dateRetour = $data['dateRetour'];
            $prix = $data['prix'];
            $rabais = $data['rabais'];
            $affichageRabais = $data['affichageRabais'];
            $nouveauPrix = $data['nouveauPrix'];
            $vedette = $data['vedette'];
            $nom = $data['hotel']['nom'];
            $coordonnees = $data['hotel']['coordonnees'];
            $nombreEtoiles = $data['hotel']['nombreEtoiles'];
            $nombreChambres = $data['hotel']['nombreChambres'];
            $description = $data['hotel']['description'];
            $caracteristiques = $data['hotel']['caracteristiques'];
            $avis = $data['hotel']['avis'];

            if(isset($region) && isset($destination) && isset($villeDepart) && isset($dateDepart) && isset($dateRetour) && isset($prix) && isset($rabais) && isset($affichageRabais)
                && isset($nouveauPrix) && isset($vedette) && isset($nom) && isset($coordonnees) && isset($nombreEtoiles) && isset($nombreChambres) 
                && isset($description) && isset($caracteristiques) && isset($avis)) {                
                $caracteristiques_str = implode(';', $caracteristiques);
                if($requete = $mysqli->prepare("INSERT INTO forfaits (destination, villeDepart, dateDepart, dateRetour, prix, rabais, affichageRabais, nouveauPrix, vedette, nom, coordonnees, nombreEtoiles, nombreChambres, description, caracteristiques, avis) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) { 
                    $requete->bind_param("ssssddidissdissi", $destination, $villeDepart, $dateDepart, $dateRetour, $prix, $rabais, $affichageRabais, $nouveauPrix, $vedette, $nom, $coordonnees, $nombreEtoiles, $nombreChambres, $description, $caracteristiques_str, $avis); 
                    if($requete->execute()) { 
                        $reponse->message .= "Succès"; 
                    } else { 
                        $reponse->message .= "Erreur dans l'exécution de la requête"; 
                    } 
                    $requete->close();
                } else { 
                    $reponse->message .= "Erreur dans la préparation de la requête"; 
                } 
            } else { 
                $reponse->message .= "Erreur dans le corps de l'objet fourni"; 
            } 

            echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

			break;
        case 'PUT': // GESTION DES DEMANDES DE TYPE PUT 
            $reponse = new stdClass(); 
            $reponse->message = "Édition du produit:"; 

            $corpsJSON = file_get_contents('php://input'); 
            $data = json_decode($corpsJSON, TRUE); 

            $region = $data['region'];
            $destination = $data['destination'];
            $villeDepart = $data['villeDepart'];
            $dateDepart = $data['dateDepart'];
            $dateRetour = $data['dateRetour'];
            $prix = $data['prix'];
            $rabais = $data['rabais'];
            $affichageRabais = $data['affichageRabais'];
            $nouveauPrix = $data['nouveauPrix'];
            $vedette = $data['vedette'];
            $nom = $data['hotel']['nom'];
            $coordonnees = $data['hotel']['coordonnees'];
            $nombreEtoiles = $data['hotel']['nombreEtoiles'];
            $nombreChambres = $data['hotel']['nombreChambres'];
            $description = $data['hotel']['description'];
            $caracteristiques = $data['hotel']['caracteristiques'];
            $avis = $data['hotel']['avis'];

            if(isset($_GET['id'])) { 
                if(isset($region) && isset($destination) && isset($villeDepart) && isset($dateDepart) && isset($dateRetour) && isset($prix) && isset($rabais) && isset($affichageRabais)
                && isset($nouveauPrix) && isset($vedette) && isset($nom) && isset($coordonnees) && isset($nombreEtoiles) && isset($nombreChambres) 
                && isset($description) && isset($caracteristiques) && isset($avis)){
                    $caracteristiques_str = implode(';', $caracteristiques);
                    if ($requete = $mysqli->prepare("UPDATE forfaits SET destination=?, villeDepart=?, dateDepart=?, dateRetour=?, prix=?, rabais=?, affichageRabais=?, nouveauPrix=?, vedette=?, nom=?, coordonnees=?, nombreEtoiles=?, nombreChambres=?, description=?, caracteristiques=?, avis=? WHERE id=?")) {
                        $requete->bind_param("ssssddidissdissii", $destination, $villeDepart, $dateDepart, $dateRetour, $prix, $rabais, $affichageRabais, $nouveauPrix, $vedette, $nom, $coordonnees, $nombreEtoiles, $nombreChambres, $description, $caracteristiques_str, $avis, $_GET['id']); 
                        if($requete->execute()) { 
                            $reponse->message .= "Succès"; 
                        } else { 
                            $reponse->message .= "Erreur dans l'exécution de la requête"; 
                        } $requete->close();
                    } else { 
                        $reponse->message .= "Erreur dans la préparation de la requête"; 
                    } 
                } else { 
                    $reponse->message .= "Erreur dans le corps de l'objet fourni"; 
                } 
            } else { 
                $reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; 
            } 
            echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
            break;
            
		case 'DELETE': // GESTION DES DEMANDES DE TYPE DELETE 
			$reponse = new stdClass(); 
            $reponse->message = "Suppression du client: "; 

            if(isset($_GET['id'])) { 
                if ($requete = $mysqli->prepare("DELETE FROM forfaits WHERE id=?")) { 
                    $requete->bind_param("i", $_GET['id']); 
                    if($requete->execute()) { 
                        $reponse->message .= "Succès"; 
                    } else { 
                        $reponse->message .= "Erreur dans l'exécution de la requête"; 
                    } 
                    $requete->close(); 
                } else { 
                    $reponse->message .= "Erreur dans la préparation de la requête"; 
                } 
            } else { 
                $reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; 
            } 
            echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        break; 
		default: 
}
?>