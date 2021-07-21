-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 20 avr. 2021 à 12:26
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `Sananair`
--

-- --------------------------------------------------------

--
-- Structure de la table `Plane`
--

CREATE TABLE `Plane` (
                         `id` int(11) NOT NULL,
                         `model` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                         `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Plane`
--

INSERT INTO `Plane` (`id`, `model`, `capacity`) VALUES
(1, 'A380', 407);

-- --------------------------------------------------------

--
-- Structure de la table `Session`
--

CREATE TABLE `Session` (
                           `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
                           `idUser` int(11) NOT NULL,
                           `expirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
                        `id` int(11) NOT NULL,
                        `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                        `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `login`, `password`) VALUES
(1, 'root', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8'),
(2, 'toor', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Plane`
--
ALTER TABLE `Plane`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Session`
--
ALTER TABLE `Session`
    ADD PRIMARY KEY (`token`),
  ADD KEY `fk_user` (`idUser`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Plane`
--
ALTER TABLE `Plane`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Session`
--
ALTER TABLE `Session`
    ADD CONSTRAINT `fk_user` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);
