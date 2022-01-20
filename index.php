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
                echo json_encode($forfaitsOBJ, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
            } else { 
				$requete = $mysqli->query("SELECT * FROM forfaits");                
                $forfaitsOBJ = $requete->fetch_all(MYSQLI_ASSOC); // Récupération de l'enregistrement
                echo json_encode($forfaitsOBJ, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
			} 
			break;
		case 'POST': // GESTION DES DEMANDES DE TYPE POST 
			$corpsJSON = file_get_contents('php://input'); 
            $data = json_decode($corpsJSON, TRUE);

            $reponse = new stdClass(); 
            $reponse->message = "Ajout du produit: "; 

            if(isset($data['nom']) && isset($data['description']) && isset($data['prix']) && isset($data['quantite']) && isset($data['categorie'])) {
                if ($requete = $mysqli->prepare("INSERT INTO produits (nom, description, prix, quantite, categorie) VALUES( ?, ?, ?, ?, ?)")) { 
                    $requete->bind_param("ssdis", $data['nom'], $data['description'], $data['prix'], $data['quantite'], $data['categorie']); 
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

            if(isset($_GET['id'])) { 
                if(isset($data['nom']) && isset($data['description']) && isset($data['prix']) && isset($data['quantite']) && isset($data['categorie'])) {
                    if ($requete = $mysqli->prepare("UPDATE produits SET nom=?, description=?, prix=?, quantite=?, categorie=? WHERE id=?")) {
                        $requete->bind_param("ssdisi", $data['nom'], $data['description'], $data['prix'], $data['quantite'], $data['categorie'], $_GET['id']); 
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
                if ($requete = $mysqli->prepare("DELETE FROM produits WHERE id=?")) { 
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