-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 24 jan. 2018 à 17:00
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cv_yannick`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `competence` varchar(30) NOT NULL,
  `c_niveau` varchar(255) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `competence`, `c_niveau`, `utilisateur_id`) VALUES
(1, 'HTML5', '65', 1),
(2, 'CSS3', '65', 1),
(7, 'Bootstrap', '60', 1),
(8, 'Javascript', '45', 1),
(9, 'JQuery', '40', 1),
(10, 'PHP ', '50', 1),
(11, 'MySQL', '30', 1),
(12, 'Silex', '20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

CREATE TABLE `t_experiences` (
  `id_experience` int(11) NOT NULL,
  `e_poste` varchar(255) NOT NULL,
  `e_dates` varchar(50) NOT NULL,
  `e_description` text NOT NULL,
  `utilisateur_id` int(3) NOT NULL,
  `e_employeur` varchar(255) NOT NULL,
  `e_lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_experiences`
--

INSERT INTO `t_experiences` (`id_experience`, `e_poste`, `e_dates`, `e_description`, `utilisateur_id`, `e_employeur`, `e_lieu`) VALUES
(1, 'Superviseur agent accueil ', 'Janvier 2011- Juin 2016', '<p>Information travaux</p>\r\n\r\n<p>Aide &agrave; la vente</p>\r\n\r\n<p>R&eacute;gulation de flux</p>\r\n', 1, 'City One ', 'Ile-de-france'),
(2, 'Employé commercial ', 'Juin 2016 - Octobre 2016', '<p>Tenue de caisse</p>\r\n\r\n<p>Mise en rayon&nbsp;</p>\r\n\r\n<p>Manutention&nbsp;</p>\r\n', 1, 'Fresco Marché ', 'Clichy-la-Garenne'),
(3, 'Développeur Web Junior', 'Juin 2017 - Février 2017 ', '<p>R&eacute;alisation d&#39;un site CV&nbsp;</p>\r\n\r\n<p>Refonte d&#39;un site WordPress</p>\r\n', 1, 'LePoleS', 'Villeneuve-la-Garenne');

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `f_titre` varchar(50) NOT NULL,
  `f_lieu` varchar(50) NOT NULL,
  `f_dates` varchar(255) NOT NULL,
  `f_description` text NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_formations`
--

INSERT INTO `t_formations` (`id_formation`, `f_titre`, `f_lieu`, `f_dates`, `f_description`, `utilisateur_id`) VALUES
(4, 'Baccalauréat ', 'Villeneuve-la-Garenne', '2008', '<p>S&eacute;rie Litt&eacute;raire</p>\r\n', 1),
(5, 'Droit et Science politique ', 'Université Paris XIII, Villetaneuse', '2009 - 2012', '<p>Deuxi&egrave;me ann&eacute;e de Licence</p>\r\n', 1),
(6, 'Certification Webforce 3 ', 'Villeneuve-la-Garenne ', 'Juin 2017 - Janvier 2018', '<p>Formation labellis&eacute;e Grande Ecole du Num&eacute;rique et certifications reconnues RNCP</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` int(10) UNSIGNED ZEROFILL NOT NULL,
  `mdp` varchar(12) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` enum('H','F') NOT NULL,
  `etat_civil` enum('Mr','Mme') NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `code_postal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `ville` varchar(30) NOT NULL,
  `pays` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `mdp`, `pseudo`, `age`, `date_naissance`, `sexe`, `etat_civil`, `adresse`, `code_postal`, `ville`, `pays`) VALUES
(1, 'Yannick', 'Bley', 'bleyyannick@gmail.com', 0646409404, 'admin', 'admin', 26, '1991-07-05', 'H', 'Mr', '2è rue du haut de la noue ', 92390, 'Villeneuve-la-garenne', 'France');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
