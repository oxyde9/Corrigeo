-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 03 juil. 2020 à 14:32
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `geoloc`
--

CREATE TABLE `cg_geoloc` (
  `idgeoloc` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `lat` varchar(16) CHARACTER SET latin1 NOT NULL,
  `lon` varchar(16) CHARACTER SET latin1 NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `source` varchar(64) DEFAULT NULL,
  `text_idtext` int(11) DEFAULT NULL,
  `geoloc_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `geoloc`
--

INSERT INTO `cg_geoloc` (`idgeoloc`, `name`, `lat`, `lon`, `ordre`, `source`, `text_idtext`, `geoloc_created_at`) VALUES
(80, 'Saint-Denis', '48.935773', '2.3580232', NULL, NULL, NULL, '2020-06-30 16:27:51');

-- --------------------------------------------------------

--
-- Structure de la table `placename`
--

CREATE TABLE `cg_placename` (
  `idplacename` int(11) NOT NULL,
  `nom_ref` varchar(256) CHARACTER SET latin1 NOT NULL,
  `lat_placename` varchar(16) CHARACTER SET latin1 NOT NULL,
  `lon_placename` varchar(16) CHARACTER SET latin1 NOT NULL,
  `nom_text` varchar(256) CHARACTER SET latin1 NOT NULL,
  `text_idtext` int(11) NOT NULL,
  `geoloc_idgeoloc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `text`
--

CREATE TABLE `cg_text` (
  `idtext` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `user_iduser` int(11) NOT NULL,
  `text_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `cg_user` (
  `iduser` int(11) NOT NULL,
  `nom` varchar(45) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `passwd` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `cg_user` (`iduser`, `nom`, `email`, `passwd`, `user_created_at`) VALUES
(2, 'test', 'test@gmail.com', 'test', '2020-06-30 14:15:13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `geoloc`
--
ALTER TABLE `cg_geoloc`
  ADD PRIMARY KEY (`idgeoloc`),
  ADD KEY `text_idtext` (`text_idtext`);

--
-- Index pour la table `placename`
--
ALTER TABLE `cg_placename`
  ADD PRIMARY KEY (`idplacename`),
  ADD KEY `text_idtext` (`text_idtext`),
  ADD KEY `geoloc_idgeoloc` (`geoloc_idgeoloc`);

--
-- Index pour la table `text`
--
ALTER TABLE `cg_text`
  ADD PRIMARY KEY (`idtext`),
  ADD KEY `user_iduser` (`user_iduser`);

--
-- Index pour la table `user`
--
ALTER TABLE `cg_user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `geoloc`
--
ALTER TABLE `cg_geoloc`
  MODIFY `idgeoloc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `placename`
--
ALTER TABLE `cg_placename`
  MODIFY `idplacename` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `text`
--
ALTER TABLE `cg_text`
  MODIFY `idtext` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `cg_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `geoloc`
--
ALTER TABLE `cg_geoloc`
  ADD CONSTRAINT `geoloc_ibfk_1` FOREIGN KEY (`text_idtext`) REFERENCES `text` (`idtext`);

--
-- Contraintes pour la table `placename`
--
ALTER TABLE `cg_placename`
  ADD CONSTRAINT `placename_ibfk_1` FOREIGN KEY (`text_idtext`) REFERENCES `text` (`idtext`),
  ADD CONSTRAINT `placename_ibfk_2` FOREIGN KEY (`geoloc_idgeoloc`) REFERENCES `geoloc` (`idgeoloc`);

--
-- Contraintes pour la table `text`
--
ALTER TABLE `cg_text`
  ADD CONSTRAINT `text_ibfk_1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
