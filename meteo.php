<?php
include_once 'include/config.php';

header("Content-Type: application/json; Charset=UTF-8");
header('Access-Control-Allow-Origin: *');

    $mysqli = new mysqli($host, $username, $password, $database);
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue 
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error; 
        exit(); 
    }
    if(isset($_GET['id'])) {                
        $requete = $mysqli->prepare("SELECT destination, temperature, tempRessenti FROM meteo WHERE id=?");                
        $requete->bind_param("i", $_GET['id']); // Envoi des paramètres à la requête
        $requete->execute(); // Exécution de la requête
        $resultat_requete = $requete->get_result(); // Récupération de résultats de la requête
        $tableau = $resultat_requete->fetch_assoc(); // Récupération de l'enregistrement 
        echo json_encode($tableau, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
    } else { 
        $requete = $mysqli->query("SELECT destination, temperature, tempRessenti FROM meteo");                
        $tableau = $requete->fetch_all(MYSQLI_ASSOC); // Récupération de l'enregistrement
        echo json_encode($tableau, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); // Transmission de l’objet au format JSON
    }
?>