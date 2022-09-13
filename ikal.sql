-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 13 sep. 2022 à 18:32
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ikal`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `user_id`, `nom`, `rue`, `complement`, `code_postal`, `ville`, `pays`, `telephone`) VALUES
(1, 2, 'Maison', '12 rue de paris', 'Batiment boulot', '75000', 'Paris', 'FR', '0627620923'),
(2, 2, 'Travail', '99 rue du taf', 'Batiment boulot', '75000', 'JobCity', 'MX', '0627620923');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `atelier`
--

CREATE TABLE `atelier` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Appareil Photo'),
(2, 'Camera'),
(3, 'Ampli'),
(4, 'Platine'),
(5, 'Enceinte'),
(6, 'Radio'),
(7, 'Gramophone');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_marque`
--

CREATE TABLE `categorie_marque` (
  `categorie_id` int(11) NOT NULL,
  `marque_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_marque`
--

INSERT INTO `categorie_marque` (`categorie_id`, `marque_id`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 5),
(5, 6),
(6, 3),
(7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporteur_prix` double NOT NULL,
  `adresse_livraison` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_payed` tinyint(1) NOT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `quantite` int(11) NOT NULL,
  `sous_total_ht` double NOT NULL,
  `tva` double NOT NULL,
  `sous_total_ttc` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_total_ht` double NOT NULL,
  `tva` double NOT NULL,
  `prix_total_ttc` double NOT NULL,
  `is_payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `details_panier`
--

CREATE TABLE `details_panier` (
  `id` int(11) NOT NULL,
  `panier_id` int(11) NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_total_ht` double NOT NULL,
  `tva` double NOT NULL,
  `prix_total_ttc` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details_panier`
--

INSERT INTO `details_panier` (`id`, `panier_id`, `nom_produit`, `prix`, `quantite`, `prix_total_ht`, `tva`, `prix_total_ttc`) VALUES
(6, 6, 'S2', 450, 1, 450, 90, 540),
(7, 6, 'Super8', 2000, 1, 2000, 400, 2400),
(8, 7, 'Nikon S2', 450, 2, 900, 180, 1080),
(9, 8, 'Nikon S2', 450, 1, 450, 90, 540),
(10, 9, 'Nikon S2', 450, 2, 900, 180, 1080);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220901094803', '2022-09-01 09:48:13', 1151),
('DoctrineMigrations\\Version20220901110109', '2022-09-01 11:01:17', 311),
('DoctrineMigrations\\Version20220901110547', '2022-09-01 11:07:34', 288);

-- --------------------------------------------------------

--
-- Structure de la table `fiche_produit`
--

CREATE TABLE `fiche_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pellicule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autofocus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obturation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dimension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amplificateur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haut_parleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equaliseur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `impedance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rendement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pavillon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filtre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vitesse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fiche_produit`
--

INSERT INTO `fiche_produit` (`id`, `nom`, `type`, `format`, `pellicule`, `mesure`, `autofocus`, `iso`, `obturation`, `poids`, `dimension`, `couleur`, `flash`, `amplificateur`, `haut_parleur`, `equaliseur`, `impedance`, `rendement`, `pavillon`, `filtre`, `vitesse`, `cellule`) VALUES
(1, '', 'télémétrique', '35 mm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom`) VALUES
(1, 'NIKON'),
(2, 'KODAK'),
(3, 'ROBERTS'),
(4, 'LINE MAGNETIC'),
(5, 'VICTROLA'),
(6, 'KLIPSCH'),
(7, 'COLUMBIA');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transporteur_prix` double NOT NULL,
  `adresse_livraison` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_payed` tinyint(1) NOT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `quantite` int(11) NOT NULL,
  `sous_total_ht` double NOT NULL,
  `tva` double NOT NULL,
  `sous_total_ttc` double NOT NULL,
  `stripe_checkout_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `user_id`, `reference`, `nom_user`, `transporteur`, `transporteur_prix`, `adresse_livraison`, `is_payed`, `information`, `created_at`, `quantite`, `sous_total_ht`, `tva`, `sous_total_ttc`, `stripe_checkout_session`) VALUES
(6, 2, 'DC3ACE89-7B38-C06E-ED38-852E9F4A9AD1-', 'Toki', 'Chronopost', 20, 'Maison[spr]12 rue de paris[spr]75000 - Paris[spr]FR[spr]0627620923[spr]', 0, NULL, '2022-09-04 12:02:48', 2, 2450, 490, 2960, NULL),
(7, 2, 'E1EE1DD3-F58A-40CE-5FEA-A1074BB87B9A-', 'Toki', 'UPS', 5, 'Travail[spr]99 rue du taf[spr]75000 - JobCity[spr]MX[spr]0627620923[spr]', 0, 'rdv', '2022-09-07 14:34:22', 2, 900, 180, 1085, NULL),
(8, 2, '2D71557B-1284-F4DB-75B6-9D4E22E56743-', 'Toki', 'UPS', 5, 'Maison[spr]12 rue de paris[spr]75000 - Paris[spr]FR[spr]0627620923[spr]', 0, NULL, '2022-09-09 08:39:58', 1, 450, 90, 545, NULL),
(9, 2, 'FC65A188-6CEE-A42A-7728-E6C2E7A60C0D-', 'Toki', 'UPS', 5, 'Maison[spr]12 rue de paris[spr]75000 - Paris[spr]FR[spr]0627620923[spr]', 0, NULL, '2022-09-09 08:40:33', 2, 900, 180, 1085, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `marque_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `fiche_produit_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_new` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `marque_id`, `categorie_id`, `fiche_produit_id`, `nom`, `description`, `quantite`, `prix`, `slug`, `image_name`, `updated_at`, `is_new`) VALUES
(1, 1, 1, 1, 'Nikon S2', '<p>Appareil photo ancien de collection&nbsp;</p>\r\n\r\n<p>film 35 mm, copie Contax II,</p>\r\n\r\n<p>objectif &nbsp;Nikkor SC 1.4f50, Nikkor Q-C 3.5f35.</p>\r\n\r\n<p>Fabriqu&eacute; &agrave; partir de l&rsquo;ann&eacute;e&nbsp;1954.</p>\r\n\r\n<p>Pays d&rsquo;origine :&nbsp;Japon.</p>', 10, 450, 'nikons2', 'nikons2.jpg', NULL, 1),
(2, 2, 2, NULL, 'Super8', '<p>Elle int&egrave;gre un &eacute;cran LCD de 4 pouces qui est orientable &agrave; plus ou moins 45 degr&eacute;s pour faciliter toute vos prises de vues. La cam&eacute;ra dispose d&rsquo;un port pour carte SD qui vraisemblablement devrait, non pas servir &agrave; la prise d&rsquo;images, mais &agrave; la prise de son.</p>', 2, 2000, 'super8', 'super8.png', NULL, 1),
(3, 4, 3, NULL, 'LM 845IA', '<p>Le LM-845IA, est une &eacute;volution qualitative du LM-518. L&#39;&eacute;tage de puissance (2x22W) est un montage single ended de tubes 845 driv&eacute; par des 6P3P. L&rsquo;amplificateur LM-845iA utilise des tubes triodes 845 mont&eacute;s en &laquo; single-ended &raquo; Classe A.</p>', 5, 3990, 'lm845ia', 'lm805.png', NULL, 1),
(4, 7, 7, NULL, '102', 'Année 1930 avec manivelle.', 1, 325, 'columbia102', 'columbia.png', NULL, NULL),
(5, 6, 5, NULL, 'The Sixes', 'Équipée d\'une entrée phono pré-amplifiée, la paire d\'enceintes Klipsch The Sixes peut être raccordée directement à une platine vinyle. Cette chaîne vinyle est disponible sous la référence Klipsch The Sixes + Heritage Debut Carbon.', 8, 669, 'thesixes', 'klipsch.png', NULL, NULL),
(6, 3, 6, NULL, 'rambler', 'La radio portable Roberts Rambler BT au design vintage offre toutes les fonctions d\'une radio moderne : Bluetooth, écran LCD, radio FM/DAB, double alarme et deux connectiques mini-jack (sortie casque et entrée analogique).', 1, 119, 'rambler', 'rambler.png', NULL, NULL),
(7, 5, 4, NULL, 'victrola', 'Platine FM.', 1, 119, 'victrola', 'victrola.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transporteur`
--

CREATE TABLE `transporteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transporteur`
--

INSERT INTO `transporteur` (`id`, `nom`, `description`, `prix`, `created_at`, `updated_at`) VALUES
(1, 'Chronopost', 'Livraison Express 24h', 20, NULL, NULL),
(2, 'UPS', 'Livraison 72h', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newpassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `nom`, `prenom`, `newpassword`) VALUES
(1, 'admin@ikla.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$ZQyy/aw0cOcX6PcNPjdD3.I8P84NQVWhKt/S5bxg4bpUqCjappZnW', 0, 'Pasquier', 'Jennifer', NULL),
(2, 'jenne@jenne.com', '[\"ROLE_USER\"]', '$2y$13$NK7iIQGgX/Zeh1DHXtK0NuM8A2QIsqDVs3JxlE0Lre1dRopok6lqa', 1, 'Pasquier', 'Jenne', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C35F0816A76ED395` (`user_id`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `atelier`
--
ALTER TABLE `atelier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_marque`
--
ALTER TABLE `categorie_marque`
  ADD PRIMARY KEY (`categorie_id`,`marque_id`),
  ADD KEY `IDX_DC493BF7BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_DC493BF74827B9B2` (`marque_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67DA76ED395` (`user_id`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4BCD5F682EA2E54` (`commande_id`);

--
-- Index pour la table `details_panier`
--
ALTER TABLE `details_panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_14E91DBDF77D927C` (`panier_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `fiche_produit`
--
ALTER TABLE `fiche_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24CC0DF2A76ED395` (`user_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC274827B9B2` (`marque_id`),
  ADD KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_29A5EC27A1627A0C` (`fiche_produit_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `transporteur`
--
ALTER TABLE `transporteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `atelier`
--
ALTER TABLE `atelier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_panier`
--
ALTER TABLE `details_panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fiche_produit`
--
ALTER TABLE `fiche_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transporteur`
--
ALTER TABLE `transporteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F0816A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `categorie_marque`
--
ALTER TABLE `categorie_marque`
  ADD CONSTRAINT `FK_DC493BF74827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DC493BF7BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `FK_4BCD5F682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `details_panier`
--
ALTER TABLE `details_panier`
  ADD CONSTRAINT `FK_14E91DBDF77D927C` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC274827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  ADD CONSTRAINT `FK_29A5EC27A1627A0C` FOREIGN KEY (`fiche_produit_id`) REFERENCES `fiche_produit` (`id`),
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
