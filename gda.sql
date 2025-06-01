-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 01 juin 2025 à 21:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gda`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

CREATE TABLE `affectations` (
  `Id_Cahier` int(11) NOT NULL,
  `Id_Professeur` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cahiers`
--

CREATE TABLE `cahiers` (
  `ID` int(11) NOT NULL,
  `Nom_binome` varchar(100) NOT NULL,
  `Prenom_binome` varchar(100) NOT NULL,
  `Filiere_binome` enum('AL','SI','SRC') NOT NULL,
  `Id_Utilisateur` int(11) NOT NULL,
  `Intitule` varchar(200) NOT NULL,
  `Domaine` enum('AL','SI','SRC','AL-SI','AL-SRC','SI-SRC') NOT NULL,
  `Chemin_PDF` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Competence` enum('AL','SI','SRC','AL-SI','AL-SRC','SI-SRC','AL-SI-SRC') NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `relances`
--

CREATE TABLE `relances` (
  `ID` int(11) NOT NULL,
  `Id_Cahier` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Mot_de_passe` varchar(255) NOT NULL,
  `Filiere` enum('AL','SI','SRC') DEFAULT NULL,
  `Role` enum('etudiant','admin') NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`Id_Cahier`,`Id_Professeur`),
  ADD KEY `Id_Professeur` (`Id_Professeur`);

--
-- Index pour la table `cahiers`
--
ALTER TABLE `cahiers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Id_Utilisateur` (`Id_Utilisateur`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `relances`
--
ALTER TABLE `relances`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Id_Cahier` (`Id_Cahier`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cahiers`
--
ALTER TABLE `cahiers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `relances`
--
ALTER TABLE `relances`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectations`
--
ALTER TABLE `affectations`
  ADD CONSTRAINT `affectations_ibfk_1` FOREIGN KEY (`Id_Cahier`) REFERENCES `cahiers` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `affectations_ibfk_2` FOREIGN KEY (`Id_Professeur`) REFERENCES `professeurs` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cahiers`
--
ALTER TABLE `cahiers`
  ADD CONSTRAINT `cahiers_ibfk_1` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateurs` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `relances`
--
ALTER TABLE `relances`
  ADD CONSTRAINT `relances_ibfk_1` FOREIGN KEY (`Id_Cahier`) REFERENCES `cahiers` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
