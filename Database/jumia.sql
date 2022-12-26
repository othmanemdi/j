-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 déc. 2022 à 20:19
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jumia`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tablétte', '2022-12-26 19:04:00', '2022-12-26 19:29:47', NULL),
(2, 'téléphone', '2022-12-26 19:04:43', '2022-12-26 19:29:29', NULL),
(3, 'Pc Bureau', '2022-12-26 19:11:22', NULL, '2022-12-26 19:44:48'),
(4, 'Pc Portable', '2022-12-26 19:18:17', NULL, '2022-12-26 19:44:46');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `prix` decimal(9,2) NOT NULL DEFAULT 0.00,
  `ancien_prix` decimal(9,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `reference`, `designation`, `quantite`, `prix`, `ancien_prix`) VALUES
(1, 'R-1-1', 'IPHONE 13 Pro Max Blue', 2, '13000.00', '13500.00'),
(2, 'R-2-2', 'IPHONE 13 PRO MAX GOLD', 1, '12000.00', '12500.00'),
(3, 'R-3', 'IMAC ORANGE', 2, '24100.00', '24500.00'),
(4, 'R-4', 'Imac Gray', 3, '25000.00', '25500.00'),
(5, 'R-5', 'Imac Blue', 1, '24000.00', '24500.00'),
(6, 'R-123aaa', 'Imac Orange', 2, '24000.00', '24500.00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
