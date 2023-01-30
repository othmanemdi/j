-- phpMyAdmin SQL Dump

-- version 5.2.0

-- https://www.phpmyadmin.net/

--

-- Hôte : 127.0.0.1

-- Généré le : lun. 30 jan. 2023 à 21:23

-- Version du serveur : 10.4.24-MariaDB

-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Base de données : `jumia`

--

-- --------------------------------------------------------

--

-- Structure de la table `carts`

--

CREATE TABLE
    `carts` (
        `id` int(11) NOT NULL,
        `ip_adresse` varchar(100) DEFAULT NULL,
        `date_cart` datetime NOT NULL DEFAULT current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `carts`

--

INSERT INTO
    `carts` (
        `id`,
        `ip_adresse`,
        `date_cart`
    )
VALUES (
        1,
        'test',
        '2023-01-25 20:17:12'
    );

-- --------------------------------------------------------

--

-- Structure de la table `cart_produit`

--

CREATE TABLE
    `cart_produit` (
        `id` int(11) NOT NULL,
        `cart_id` int(11) DEFAULT NULL,
        `produit_id` int(11) DEFAULT NULL,
        `qt` int(11) NOT NULL DEFAULT 1
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `cart_produit`

--

INSERT INTO
    `cart_produit` (
        `id`,
        `cart_id`,
        `produit_id`,
        `qt`
    )
VALUES (1, 1, 1, 1), (2, 1, 2, 2), (3, 1, 3, 1);

-- --------------------------------------------------------

--

-- Structure de la table `categories`

--

CREATE TABLE
    `categories` (
        `id` int(11) NOT NULL,
        `nom` varchar(100) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `categories`

--

INSERT INTO
    `categories` (
        `id`,
        `nom`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'Tablétte',
        '2022-12-26 19:04:00',
        '2022-12-26 19:29:47',
        NULL
    ), (
        2,
        'téléphone',
        '2022-12-26 19:04:43',
        '2022-12-26 19:29:29',
        NULL
    ), (
        3,
        'Pc Bureaux',
        '2022-12-26 19:11:22',
        NULL,
        NULL
    ), (
        4,
        'Pc Portable',
        '2022-12-26 19:18:17',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `clients`

--

CREATE TABLE
    `clients` (
        `id` int(11) NOT NULL,
        `nom` varchar(100) DEFAULT NULL,
        `telephone` varchar(100) DEFAULT NULL,
        `ville` varchar(100) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `clients`

--

INSERT INTO
    `clients` (
        `id`,
        `nom`,
        `telephone`,
        `ville`
    )
VALUES (
        1,
        'Oumaima',
        '06778899',
        'Tanger'
    ), (
        5,
        'Amine',
        '0605040708',
        'Houcema'
    ), (6, 'Sbai', '06050403', 'Fes');

-- --------------------------------------------------------

--

-- Structure de la table `commandes`

--

CREATE TABLE
    `commandes` (
        `id` int(11) NOT NULL,
        `client_id` int(11) DEFAULT NULL,
        `date_commande` datetime NOT NULL DEFAULT current_timestamp(),
        `num` int(11) NOT NULL DEFAULT 0
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `commandes`

--

INSERT INTO
    `commandes` (
        `id`,
        `client_id`,
        `date_commande`,
        `num`
    )
VALUES (1, 1, '2023-01-30 20:26:22', 1), (5, 5, '2023-01-30 21:18:44', 1), (6, 6, '2023-01-30 21:21:16', 1);

-- --------------------------------------------------------

--

-- Structure de la table `commande_produit`

--

CREATE TABLE
    `commande_produit` (
        `id` int(11) NOT NULL,
        `commande_id` int(11) DEFAULT NULL,
        `produit_id` int(11) DEFAULT NULL,
        `qt` int(11) NOT NULL DEFAULT 1
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `commande_produit`

--

INSERT INTO
    `commande_produit` (
        `id`,
        `commande_id`,
        `produit_id`,
        `qt`
    )
VALUES (11, 1, 5, 6), (12, 1, 4, 6), (13, 1, 2, 4), (14, 1, 1, 2), (15, 1, 3, 8), (16, 5, 2, 4), (17, 5, 4, 6), (18, 6, 1, 2), (19, 6, 3, 1);

-- --------------------------------------------------------

--

-- Structure de la table `couleurs`

--

CREATE TABLE
    `couleurs` (
        `id` int(11) NOT NULL,
        `nom` varchar(100) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `couleurs`

--

INSERT INTO
    `couleurs` (
        `id`,
        `nom`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'red',
        '2022-12-28 19:51:59',
        NULL,
        NULL
    ), (
        2,
        'Pink',
        '2022-12-28 19:52:36',
        '2022-12-28 19:52:41',
        NULL
    ), (
        3,
        'Yellow',
        '2022-12-28 19:58:04',
        NULL,
        NULL
    ), (
        4,
        'Gray',
        '2022-12-28 19:58:07',
        NULL,
        NULL
    ), (
        5,
        'Orange',
        '2023-01-02 20:08:18',
        NULL,
        NULL
    ), (
        6,
        'Blue',
        '2022-12-28 19:58:15',
        NULL,
        NULL
    ), (
        7,
        'White',
        '2022-12-28 19:58:19',
        NULL,
        NULL
    ), (
        8,
        'Black',
        '2022-12-28 19:58:23',
        NULL,
        NULL
    ), (
        9,
        'green',
        '2023-01-11 20:47:03',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `produits`

--

CREATE TABLE
    `produits` (
        `id` int(11) NOT NULL,
        `image` varchar(150) DEFAULT NULL,
        `reference` varchar(255) DEFAULT NULL,
        `designation` varchar(255) DEFAULT NULL,
        `quantite` int(11) NOT NULL DEFAULT 0,
        `prix` decimal(9, 2) NOT NULL DEFAULT 0.00,
        `ancien_prix` decimal(9, 2) NOT NULL DEFAULT 0.00,
        `categorie_id` int(11) DEFAULT NULL,
        `couleur_id` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `produits`

--

INSERT INTO
    `produits` (
        `id`,
        `image`,
        `reference`,
        `designation`,
        `quantite`,
        `prix`,
        `ancien_prix`,
        `categorie_id`,
        `couleur_id`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'ooo1.jpg',
        'R-1',
        'IPHONE 13 PRO MAX',
        2,
        '13000.00',
        '13500.00',
        2,
        6,
        '2023-01-25 19:37:16',
        NULL,
        NULL
    ), (
        2,
        '2.jpg',
        'R-2',
        'IPHONE 13 PRO MAX',
        4,
        '13000.00',
        '0.00',
        2,
        3,
        '2023-01-25 19:37:48',
        '2023-01-25 19:38:04',
        NULL
    ), (
        3,
        'ooo5.jpg',
        'R-3',
        'Imac 24 Pouce ',
        8,
        '24000.00',
        '24500.00',
        3,
        6,
        '2023-01-25 19:38:51',
        NULL,
        NULL
    ), (
        4,
        'ooo3.jpg',
        'R-4',
        'Imac 24 Pouce ',
        6,
        '24000.00',
        '24500.00',
        3,
        2,
        '2023-01-25 19:39:19',
        NULL,
        NULL
    ), (
        5,
        'ooo6.jpg',
        'R-5',
        'Imac 24 Pouce ',
        6,
        '24000.00',
        '24500.00',
        3,
        5,
        '2023-01-25 19:39:59',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Doublure de structure pour la vue `produits_view`

-- (Voir ci-dessous la vue réelle)

--

CREATE TABLE
    `produits_view` (
        `id` int(11),
        `image` varchar(150),
        `reference` varchar(255),
        `designation` varchar(255),
        `quantite` int(11),
        `prix` decimal(9, 2),
        `ancien_prix` decimal(9, 2),
        `categorie_id` int(11),
        `couleur_id` int(11),
        `created_at` datetime,
        `updated_at` datetime,
        `deleted_at` datetime,
        `categorie_nom` varchar(100),
        `couleur_nom` varchar(100)
    );

-- --------------------------------------------------------

--

-- Structure de la vue `produits_view`

--

DROP TABLE IF EXISTS `produits_view`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW `produits_view` AS
SELECT
    `p`.`id` AS `id`,
    `p`.`image` AS `image`,
    `p`.`reference` AS `reference`,
    `p`.`designation` AS `designation`,
    `p`.`quantite` AS `quantite`,
    `p`.`prix` AS `prix`,
    `p`.`ancien_prix` AS `ancien_prix`,
    `p`.`categorie_id` AS `categorie_id`,
    `p`.`couleur_id` AS `couleur_id`,
    `p`.`created_at` AS `created_at`,
    `p`.`updated_at` AS `updated_at`,
    `p`.`deleted_at` AS `deleted_at`,
    `c`.`nom` AS `categorie_nom`,
    `cl`.`nom` AS `couleur_nom`
FROM ( (
            `produits` `p`
            left join `categories` `c` on(`c`.`id` = `p`.`categorie_id`)
        )
        left join `couleurs` `cl` on(`cl`.`id` = `p`.`couleur_id`)
    );

--

-- Index pour les tables déchargées

--

--

-- Index pour la table `carts`

--

ALTER TABLE `carts` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `cart_produit`

--

ALTER TABLE `cart_produit`
ADD PRIMARY KEY (`id`),
ADD
    KEY `cart_id` (`cart_id`),
ADD
    KEY `produit_id` (`produit_id`);

--

-- Index pour la table `categories`

--

ALTER TABLE `categories` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `clients`

--

ALTER TABLE `clients` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `commandes`

--

ALTER TABLE `commandes`
ADD PRIMARY KEY (`id`),
ADD
    KEY `client_id` (`client_id`);

--

-- Index pour la table `commande_produit`

--

ALTER TABLE `commande_produit`
ADD PRIMARY KEY (`id`),
ADD
    KEY `commande_id` (`commande_id`),
ADD
    KEY `produit_id` (`produit_id`);

--

-- Index pour la table `couleurs`

--

ALTER TABLE `couleurs` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `produits`

--

ALTER TABLE `produits`
ADD PRIMARY KEY (`id`),
ADD
    KEY `produits_ibfk_1` (`categorie_id`),
ADD
    KEY `produits_ibfk_2` (`couleur_id`);

--

-- AUTO_INCREMENT pour les tables déchargées

--

--

-- AUTO_INCREMENT pour la table `carts`

--

ALTER TABLE
    `carts` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT pour la table `cart_produit`

--

ALTER TABLE
    `cart_produit` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--

-- AUTO_INCREMENT pour la table `categories`

--

ALTER TABLE
    `categories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 224;

--

-- AUTO_INCREMENT pour la table `clients`

--

ALTER TABLE
    `clients` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--

-- AUTO_INCREMENT pour la table `commandes`

--

ALTER TABLE
    `commandes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--

-- AUTO_INCREMENT pour la table `commande_produit`

--

ALTER TABLE
    `commande_produit` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 20;

--

-- AUTO_INCREMENT pour la table `couleurs`

--

ALTER TABLE
    `couleurs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 10;

--

-- AUTO_INCREMENT pour la table `produits`

--

ALTER TABLE
    `produits` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- Contraintes pour les tables déchargées

--

--

-- Contraintes pour la table `cart_produit`

--

ALTER TABLE `cart_produit`
ADD
    CONSTRAINT `cart_produit_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `cart_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `commandes`

--

ALTER TABLE `commandes`
ADD
    CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `commande_produit`

--

ALTER TABLE `commande_produit`
ADD
    CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `produits`

--

ALTER TABLE `produits`
ADD
    CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`couleur_id`) REFERENCES `couleurs` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;