-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 juin 2025 à 22:10
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
-- Structure de la table `aides`
--

CREATE TABLE `aides` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(100) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `les_demandes` varchar(100) DEFAULT NULL,
  `descriptions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `aides`
--

INSERT INTO `aides` (`id`, `nom_prenom`, `adresse`, `telephone`, `mail`, `les_demandes`, `descriptions`) VALUES
(1, 'Adama Faye', 'su', '782396761', 'fayeadama@gmail.sn', 'nourriture', 'rtddjdkii'),
(2, 'Adama Faye', 'su', '782396761', 'fayeadama@gmail.sn', 'nourriture', 'rtddjdkii');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aides`
--
ALTER TABLE `aides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aides`
--
ALTER TABLE `aides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
