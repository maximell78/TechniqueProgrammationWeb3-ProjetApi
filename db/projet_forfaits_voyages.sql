-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2022 at 03:34 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_forfaits_voyages`
--

-- --------------------------------------------------------

--
-- Table structure for table `forfaits`
--

CREATE TABLE `forfaits` (
  `id` int(11) NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `villeDepart` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `coordonnees` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nombreEtoiles` decimal(11,0) NOT NULL,
  `nombreChambres` int(11) NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `caracteristiques` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `avis` int(11) NOT NULL,
  `dateDepart` date NOT NULL,
  `dateRetour` date NOT NULL,
  `prix` decimal(11,0) NOT NULL,
  `rabais` decimal(11,0) NOT NULL,
  `affichageRabais` tinyint(1) NOT NULL,
  `nouveauPrix` decimal(11,0) NOT NULL,
  `vedette` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forfaits`
--

INSERT INTO `forfaits` (`id`, `destination`, `villeDepart`, `nom`, `coordonnees`, `nombreEtoiles`, `nombreChambres`, `description`, `caracteristiques`, `avis`, `dateDepart`, `dateRetour`, `prix`, `rabais`, `affichageRabais`, `nouveauPrix`, `vedette`) VALUES
(1, 'Paris, France', 'Montréal, Québec', 'Citadines Bastille Marais Paris', '37, boulevard Richard Lenoir 75011 Paris FRANCE', '3', 138, 'Située à 5 minutes à pied de l’animation de la place de la Bastille et à 10 minutes à pied du magnifique quartier du Marais, le Citadines Bastille Marais Paris dispose de 108 studios (1 lit double ou 2 lits simples) et 30 appartements.', 'Métro: Bréguet-Sabin; Chemin Vert En ville; 1 édifice de 7 étages; Ascenseur;  Wi-Fi : hall, chambre; Climatisation centrale; Stationnement ($); 1 restaurant; Coffret de sûreté; Accessible; Séchoir à cheveux', 3264, '2022-02-25', '2022-03-05', '3799', '200', 1, '3599', 1),
(3, 'Kinetta, Grèce', 'Montréal, Québec', 'Kinetta Beach Resort And Spa', '57th km of Old National Road Athens Corinth - Kinetta Attica', '4', 253, 'Situé entre Athènes et le canal de Corinthe, le Kinetta Beach est l’hôtel idéal pour des vacances de détente en bord de mer. À moins d’un km de la gare de train, vous serez en 45 minutes à peine en plein cœur d’Athènes. L’hôtel propose 253 chambres élégamment décorées.', 'Kinetta; Face à la plage; 16 édifices de 2 étages; Wi-Fi : hall; Climatisation individuelle; Stationnement ($); 3 restaurants; 2 bars; 2 piscines; Coffret de sûreté ($)Accessible; Séchoir à cheveux', 4789, '2022-02-23', '2022-03-09', '2549', '700', 1, '1849', 0),
(4, 'Lisbone, Portugal', 'Montréal, Québec', 'Hotel Mundial', 'Largo Martim Moniz, 1100-341 Lisbone Portugal', '4', 350, 'L\'Hôtel Mundial est situé au coeur de Lisbonne, près de tous les services de transport en commun.', 'Métro: Martim Moniz; Centre-ville; 1 édifices; Wi-Fi : hall; Climatisation individuelle; Stationnement; 2 restaurants; 2 bars; Près d\'un attrait/ville/lieu historique; Coffret de sûreté; Séchoir à cheveux', 3411, '2022-03-05', '2022-03-12', '1519', '100', 1, '1419', 1),
(5, 'Londres, Royaume-Uni', 'Montréal, Québec', 'ME London', '336-337 The Strand WC2R 1HA Londre', '5', 157, 'Situé en plein coeur du quartier West End de Londres, et entouré de théâtres, boutiques et boîtes de nuit, à environ 46 km de l\'aéroport. Un hôtel avant-gardiste, il propose des vues panoramiques spectaculaires du haut de son bar sur le toit, une cuisine gastronomique internationale et des chambres modernes au design exquis, toutes avec vue sur la Tamise.', 'Métro: Covent Garden station; En ville; Ascenceur; Wi-Fi : hall, dans tout le complexe; Climatisation individuelle; Stationnement; 2 restaurants; 3 bars; Coffret de sûreté; Séchoir à cheveux', 1658, '2022-03-07', '2022-03-25', '6699', '1100', 1, '5599', 1),
(6, 'Sydney, Australie', 'Montreal, Quebec', 'Hotel Kangouroo', '125 Rue Skippy, Sydney', '4', 214, 'L\'Hôtel Kangouroo est situé au coeur de Sydney, près de tous les services de transport en commun.', 'test 12 12', 4596, '2022-03-10', '2022-03-22', '2999', '100', 1, '2899', 1),
(9, 'Moscou, Russie', 'Montreal, Quebec', 'Hotel El Russian', '5454 Russian Street', '5', 200, 'L\'Hôtel El Russian est situé au coeur de Moscou, près de tous les services de transport en commun.', ' Centre-ville; 1 édifices; Wi-Fi : hall; Climatisation individuelle; Stationnement ($); 1 restaurants; 1 bars; Coffret de sûreté; Séchoir à cheveux', 500, '2022-04-12', '2022-04-22', '3199', '200', 1, '2999', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meteo`
--

CREATE TABLE `meteo` (
  `id` int(11) NOT NULL,
  `temperature` decimal(10,0) NOT NULL,
  `tempRessenti` decimal(10,0) NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meteo`
--

INSERT INTO `meteo` (`id`, `temperature`, `tempRessenti`, `destination`) VALUES
(1, '25', '28', 'Paris, France'),
(2, '-20', '-27', 'Montréal, Québec'),
(3, '20', '23', 'New York, USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forfaits`
--
ALTER TABLE `forfaits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meteo`
--
ALTER TABLE `meteo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forfaits`
--
ALTER TABLE `forfaits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `meteo`
--
ALTER TABLE `meteo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
