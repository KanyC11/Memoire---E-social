-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 juin 2025 à 13:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dons`
--

-- --------------------------------------------------------

--
-- Structure de la table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `prenomnom` varchar(100) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `soutiens` varchar(100) DEFAULT NULL,
  `typedon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `donations`
--

INSERT INTO `donations` (`id`, `prenomnom`, `adresse`, `telephone`, `email`, `soutiens`, `typedon`, `description`) VALUES
(1, 'kany cisse', 'Thies', '771702465', 'cissekany141@gmail.com', 'j&#039;offres des habits pour enfants de 10-14 ans', '01', '2'),
(2, 'kany cisse', 'Thies', '771702465', 'cissekany141@gmail.com', 'j&#039;offres des habits pour enfants de 10-14 ans', '01', '2'),
(3, 'kany cisse', 'Thies', '771702465', 'cissekany141@gmail.com', 'j&#039;offres des habits pour enfants de 10-14 ans', '01', '2'),
(4, 'kany cisse', 'Thies', '771702465', 'cissekany141@gmail.com', 'j&#039;ai envoyer 10 mil par wave', '03', '1'),
(8, 'kany cisse', 'Thies', '771702465', 'cissekany@gmail.com', 'j&#039;offres des sacs de riz', '02', '3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
