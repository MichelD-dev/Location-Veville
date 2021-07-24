-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 23 juil. 2021 à 21:49
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `veville`
--

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

CREATE TABLE `agences` (
  `id_agence` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` int(3) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id_agence`, `titre`, `adresse`, `ville`, `cp`, `description`, `photo`) VALUES
(1, 'Agence de Paris', '300 boulevard de Vaugirard', 'Paris', 75015, 'Notre agence de Paris 300 boulevard de Vaugirard, 75015, Paris Ouvert 7j/7 de 09h à 13h et de 14h à 20h 01 49 78 21 33 contact@veville.com', 'https://www.driveones.com/images/trios/trio3.jpg?v112'),
(2, 'Agence de Lyon', '15 rue Sainte Catherine', 'Lyon', 69003, 'Agence de Lyon...', 'https://www.we-van.com/assets/img/ui/bg-home-offices.jpg'),
(3, 'Agence de Bordeaux', '10 Place de l\'hôtel de ville', 'Bordeaux', 33000, 'Notre agence de Bordeaux vous ouvre ses portes...', 'https://www.leasysrent.fr/content/leasysrent/fr/images/homepage/paragraphs/landing-voiture.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) DEFAULT NULL,
  `id_vehicule` int(3) DEFAULT NULL,
  `id_agence` int(3) DEFAULT NULL,
  `date_heure_depart` datetime NOT NULL,
  `date_heure_fin` datetime NOT NULL,
  `prix_total` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_vehicule`, `id_agence`, `date_heure_depart`, `date_heure_fin`, `prix_total`, `date_enregistrement`) VALUES
(1, 53, 1, 3, '2021-07-02 21:00:00', '2021-07-15 19:00:00', 1300, '2021-07-20 21:00:00'),
(2, 52, 2, 1, '2021-07-05 10:51:40', '2021-07-17 10:31:00', 800, '2021-07-21 10:51:40'),
(5, 96, 7, 2, '2021-06-26 20:42:34', '2021-07-31 08:42:34', 1300, '2021-07-22 20:42:34');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('Homme','Femme') NOT NULL,
  `statut` enum('Admin','Membre') NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(52, 'John Doe', 'wxcbwxcb', 'Doe', 'John', 'johndoe@mail.com', 'Homme', 'Admin', '2021-07-20 18:59:13'),
(53, 'Jane Doe', 'wxcbwxcbwxcvb', 'Doe', 'Jane', 'janedoe@mail.com', 'Femme', 'Membre', '2021-07-20 18:59:21'),
(95, 'trucmuche', '$2y$10$oUQfYHE02a8IcULKpTzUPe9kaTXHsvuLukMwLE/wqf0kO2wdOmP/a', 'DELAUNAY', 'Michel', 'delaunaymichel@hotmail.fr', 'Homme', 'Membre', '2021-07-22 15:23:53'),
(96, 'tomjones', '$2y$10$watP8pjgYgRZm1mDDOw5KuruwIvbMG7D7ln7TrAAk03F0qIt2drV.', 'Jones', 'Tom', 'delaunaymichel@hotmail.fr', 'Homme', 'Admin', '2021-07-22 16:23:52'),
(104, 'toto', 'toto', 'toto', 'toto', 'toto@tit', 'Homme', 'Admin', '2021-07-23 11:54:00');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int(3) NOT NULL,
  `id_agence` int(3) DEFAULT NULL,
  `titre` varchar(200) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `prix_journalier` int(3) NOT NULL,
  `disponible` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `id_agence`, `titre`, `marque`, `modele`, `description`, `photo`, `prix_journalier`, `disponible`) VALUES
(1, 1, 'Ford T', 'Ford', 'T', 'La distinction par excellence...', 'https://uimages.resulto.ca/Ll7/ovAkV/1926-ford-model-t-QNErDE-original.jpg', 150, 0),
(2, 3, 'Lada Niva', 'Lada', 'Niva', 'Intemporelle et inusable, l\'arpenteuse des steppes.', 'https://cdn-s-www.lalsace.fr/images/1C611BB8-9279-485E-BACE-7577B6B3569C/NW_raw/le-niva-est-devenue-une-vraie-legende-photo-lada-1595592238.jpg', 200, 0),
(7, 3, 'Lada Niva', 'Lada', 'Niva', 'Intemporelle et inusable, l\'arpenteuse des steppes.', 'https://cdn-s-www.lalsace.fr/images/1C611BB8-9279-485E-BACE-7577B6B3569C/NW_raw/le-niva-est-devenue-une-vraie-legende-photo-lada-1595592238.jpg', 500, 0),
(11, 1, 'Ford T', 'Ford', 'T', 'La distinction par excellence...', 'https://uimages.resulto.ca/Ll7/ovAkV/1926-ford-model-t-QNErDE-original.jpg', 650, 0),
(12, 3, 'Lada Niva', 'Lada', 'Niva', 'Intemporelle et inusable, l\'arpenteuse des steppes.', 'https://cdn-s-www.lalsace.fr/images/1C611BB8-9279-485E-BACE-7577B6B3569C/NW_raw/le-niva-est-devenue-une-vraie-legende-photo-lada-1595592238.jpg', 200, 0),
(13, 2, 'Lada Niva', 'Lada', 'Niva', 'Intemporelle et inusable, l\'arpenteuse des steppes.', 'https://cdn-s-www.lalsace.fr/images/1C611BB8-9279-485E-BACE-7577B6B3569C/NW_raw/le-niva-est-devenue-une-vraie-legende-photo-lada-1595592238.jpg', 500, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agences`
--
ALTER TABLE `agences`
  ADD PRIMARY KEY (`id_agence`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD UNIQUE KEY `id_agence` (`id_agence`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_vehicule` (`id_vehicule`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`),
  ADD KEY `id_agence` (`id_agence`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agences`
--
ALTER TABLE `agences`
  MODIFY `id_agence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_ibfk_3` FOREIGN KEY (`id_agence`) REFERENCES `agences` (`id_agence`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`id_agence`) REFERENCES `agences` (`id_agence`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
