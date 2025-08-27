-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 26 mars 2025 à 20:00
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jirama`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `codeCli` varchar(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(2) NOT NULL,
  `quartier` varchar(30) NOT NULL,
  `niveau` varchar(1) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`codeCli`, `nom`, `prenom`, `sexe`, `quartier`, `niveau`, `mail`) VALUES
('00000001', 'RATSIMBAZAFY', 'Tahiana', 'M', 'Tanambao', 'B', 'ratsimba@gmail.com'),
('00000002', 'RAKOTO', 'Paul', 'M', 'Anjoma', 'C', 'rkpaul@gmail.com'),
('00000003', 'RAZAKA', 'Tahiana', 'M', 'Tanambao', 'B', 'ascasc@gmas.com');

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

CREATE TABLE `compteur` (
  `codeCompteur` varchar(11) NOT NULL,
  `type` varchar(4) NOT NULL,
  `pu` int(11) NOT NULL,
  `codeCli` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `compteur`
--

INSERT INTO `compteur` (`codeCompteur`, `type`, `pu`, `codeCli`) VALUES
('C00000001', 'elec', 12300, '00000001'),
('C00000002', 'elec', 34, '00000002'),
('C00000003', 'elec', 45, '00000003'),
('E00000001', 'eau', 12000, '00000001'),
('E00000002', 'eau', 120, '00000002');

-- --------------------------------------------------------

--
-- Structure de la table `payer`
--

CREATE TABLE `payer` (
  `codePaie` varchar(11) NOT NULL,
  `datePaie` date NOT NULL,
  `codeCli` varchar(11) NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `payer`
--

INSERT INTO `payer` (`codePaie`, `datePaie`, `codeCli`, `montant`) VALUES
('0002', '2025-03-20', '00000002', 5644);

-- --------------------------------------------------------

--
-- Structure de la table `releve_eau`
--

CREATE TABLE `releve_eau` (
  `codeEau` varchar(11) NOT NULL,
  `dateReleve2` date NOT NULL,
  `valeur2` int(11) NOT NULL,
  `date_presentation2` date NOT NULL,
  `date_limite2` date NOT NULL,
  `codeCompteur` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `releve_eau`
--

INSERT INTO `releve_eau` (`codeEau`, `dateReleve2`, `valeur2`, `date_presentation2`, `date_limite2`, `codeCompteur`) VALUES
('00000001', '2025-03-14', 34, '2025-03-20', '2025-03-28', 'E00000001'),
('00000002', '2025-03-14', 34, '2025-03-25', '2025-03-31', 'E00000002');

-- --------------------------------------------------------

--
-- Structure de la table `releve_elec`
--

CREATE TABLE `releve_elec` (
  `codeElec` varchar(11) NOT NULL,
  `dateReleve1` date NOT NULL,
  `valeur1` int(11) NOT NULL,
  `date_presentation` date NOT NULL,
  `date_limite` date NOT NULL,
  `codeCompteur` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `releve_elec`
--

INSERT INTO `releve_elec` (`codeElec`, `dateReleve1`, `valeur1`, `date_presentation`, `date_limite`, `codeCompteur`) VALUES
('00000001', '2025-03-15', 45, '2025-03-25', '2025-03-29', 'C00000001'),
('00000002', '2025-03-05', 46, '2025-03-25', '2025-03-29', 'C00000002'),
('00000003', '2025-03-13', 56, '2025-03-26', '2025-03-31', 'C00000003');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compteur`
--
ALTER TABLE `compteur`
  ADD PRIMARY KEY (`codeCompteur`);

--
-- Index pour la table `payer`
--
ALTER TABLE `payer`
  ADD PRIMARY KEY (`codePaie`);

--
-- Index pour la table `releve_eau`
--
ALTER TABLE `releve_eau`
  ADD PRIMARY KEY (`codeEau`);

--
-- Index pour la table `releve_elec`
--
ALTER TABLE `releve_elec`
  ADD PRIMARY KEY (`codeElec`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
