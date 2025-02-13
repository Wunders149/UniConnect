-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 fév. 2025 à 15:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coms`
--

CREATE TABLE `coms` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) DEFAULT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `date_com` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `coms`
--

INSERT INTO `coms` (`id`, `pub_id`, `etudiant_id`, `contenu`, `date_com`) VALUES
(1, 1, 1, 'vdvs', '2025-02-13 13:16:28');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `filiere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `titre`, `description`, `date_debut`, `date_fin`, `filiere_id`) VALUES
(1, 'Introduction à la Programmation', 'Cours d\'introduction à la programmation en Python.', '2023-09-01', '2023-12-15', 1),
(2, 'Algèbre Linéaire', 'Cours sur les concepts fondamentaux de l\'algèbre linéaire.', '2023-09-01', '2023-12-15', 2),
(3, 'Base de Données', 'Cours sur la conception et la gestion des bases de données.', '2023-09-01', '2023-12-15', 1),
(4, 'Réseaux Informatiques', 'Cours sur les principes des réseaux informatiques.', '2023-09-01', '2023-12-15', 1),
(5, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences de l\'ingénieur.', '2023-09-01', '2023-12-15', 2),
(6, 'Physique Quantique', 'Cours sur les principes de la physique quantique.', '2023-09-01', '2023-12-15', 3),
(7, 'Chimie Organique', 'Cours sur la chimie organique et ses applications.', '2023-09-01', '2023-12-15', 4),
(8, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 5),
(9, 'Développement Web', 'Cours sur le développement web avec HTML, CSS et JavaScript.', '2023-09-01', '2023-12-15', 1),
(10, 'Analyse Numérique', 'Cours sur les méthodes numériques pour l\'analyse.', '2023-09-01', '2023-12-15', 2),
(11, 'Thermodynamique', 'Cours sur les principes de la thermodynamique.', '2023-09-01', '2023-12-15', 3),
(12, 'Chimie Inorganique', 'Cours sur la chimie inorganique et ses applications.', '2023-09-01', '2023-12-15', 4),
(13, 'Génétique', 'Cours sur la génétique et ses applications.', '2023-09-01', '2023-12-15', 5),
(14, 'Intelligence Artificielle', 'Cours sur les concepts de l\'intelligence artificielle.', '2023-09-01', '2023-12-15', 1),
(15, 'Statistiques', 'Cours sur les méthodes statistiques et leurs applications.', '2023-09-01', '2023-12-15', 2),
(16, 'Mécanique Quantique', 'Cours sur les principes de la mécanique quantique.', '2023-09-01', '2023-12-15', 3),
(17, 'Chimie Analytique', 'Cours sur les méthodes analytiques en chimie.', '2023-09-01', '2023-12-15', 4),
(18, 'Biochimie', 'Cours sur la biochimie et ses applications.', '2023-09-01', '2023-12-15', 5),
(19, 'Sécurité Informatique', 'Cours sur les principes de la sécurité informatique.', '2023-09-01', '2023-12-15', 1),
(20, 'Calcul Différentiel', 'Cours sur le calcul différentiel et ses applications.', '2023-09-01', '2023-12-15', 2),
(21, 'Introduction à la Littérature', 'Cours d\'introduction à la littérature classique et moderne.', '2023-09-01', '2023-12-15', 6),
(22, 'Analyse Littéraire', 'Cours sur l\'analyse des œuvres littéraires.', '2023-09-01', '2023-12-15', 6),
(23, 'Histoire de la Littérature', 'Cours sur l\'histoire de la littérature à travers les âges.', '2023-09-01', '2023-12-15', 6),
(24, 'Littérature Comparée', 'Cours sur la comparaison des littératures de différentes cultures.', '2023-09-01', '2023-12-15', 6),
(25, 'Poésie et Prose', 'Cours sur la poésie et la prose dans la littérature.', '2023-09-01', '2023-12-15', 6),
(26, 'Littérature Française', 'Cours sur les œuvres majeures de la littérature française.', '2023-09-01', '2023-12-15', 6),
(27, 'Littérature Anglaise', 'Cours sur les œuvres majeures de la littérature anglaise.', '2023-09-01', '2023-12-15', 6),
(28, 'Littérature Américaine', 'Cours sur les œuvres majeures de la littérature américaine.', '2023-09-01', '2023-12-15', 6),
(29, 'Littérature Contemporaine', 'Cours sur les œuvres littéraires contemporaines.', '2023-09-01', '2023-12-15', 6),
(30, 'Littérature Classique', 'Cours sur les œuvres littéraires classiques.', '2023-09-01', '2023-12-15', 6),
(31, 'Introduction à la Physique', 'Cours d\'introduction aux concepts fondamentaux de la physique.', '2023-09-01', '2023-12-15', 7),
(32, 'Chimie Générale', 'Cours sur les principes fondamentaux de la chimie.', '2023-09-01', '2023-12-15', 7),
(33, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 7),
(34, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences.', '2023-09-01', '2023-12-15', 7),
(35, 'Physique Quantique', 'Cours sur les principes de la physique quantique.', '2023-09-01', '2023-12-15', 7),
(36, 'Chimie Organique', 'Cours sur la chimie organique et ses applications.', '2023-09-01', '2023-12-15', 7),
(37, 'Biologie Moléculaire', 'Cours sur la biologie moléculaire et ses applications.', '2023-09-01', '2023-12-15', 7),
(38, 'Astronomie', 'Cours sur les principes de l\'astronomie et l\'exploration de l\'espace.', '2023-09-01', '2023-12-15', 7),
(39, 'Géologie', 'Cours sur les principes de la géologie et l\'étude de la Terre.', '2023-09-01', '2023-12-15', 7),
(40, 'Écologie', 'Cours sur les principes de l\'écologie et la conservation de l\'environnement.', '2023-09-01', '2023-12-15', 7),
(41, 'Introduction à la Programmation', 'Cours d\'introduction à la programmation en Python.', '2023-09-01', '2023-12-15', 1),
(42, 'Algèbre Linéaire', 'Cours sur les concepts fondamentaux de l\'algèbre linéaire.', '2023-09-01', '2023-12-15', 1),
(43, 'Base de Données', 'Cours sur la conception et la gestion des bases de données.', '2023-09-01', '2023-12-15', 1),
(44, 'Réseaux Informatiques', 'Cours sur les principes des réseaux informatiques.', '2023-09-01', '2023-12-15', 1),
(45, 'Analyse Numérique', 'Cours sur les méthodes numériques pour l\'analyse.', '2023-09-01', '2023-12-15', 2),
(46, 'Statistiques', 'Cours sur les méthodes statistiques et leurs applications.', '2023-09-01', '2023-12-15', 2),
(47, 'Calcul Différentiel', 'Cours sur le calcul différentiel et ses applications.', '2023-09-01', '2023-12-15', 2),
(48, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences de l\'ingénieur.', '2023-09-01', '2023-12-15', 2),
(49, 'Physique Quantique', 'Cours sur les principes de la physique quantique.', '2023-09-01', '2023-12-15', 3),
(50, 'Thermodynamique', 'Cours sur les principes de la thermodynamique.', '2023-09-01', '2023-12-15', 3),
(51, 'Mécanique Quantique', 'Cours sur les principes de la mécanique quantique.', '2023-09-01', '2023-12-15', 3),
(52, 'Astronomie', 'Cours sur les principes de l\'astronomie et l\'exploration de l\'espace.', '2023-09-01', '2023-12-15', 3),
(53, 'Chimie Organique', 'Cours sur la chimie organique et ses applications.', '2023-09-01', '2023-12-15', 4),
(54, 'Chimie Inorganique', 'Cours sur la chimie inorganique et ses applications.', '2023-09-01', '2023-12-15', 4),
(55, 'Chimie Analytique', 'Cours sur les méthodes analytiques en chimie.', '2023-09-01', '2023-12-15', 4),
(56, 'Chimie Générale', 'Cours sur les principes fondamentaux de la chimie.', '2023-09-01', '2023-12-15', 4),
(57, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 5),
(58, 'Biologie Moléculaire', 'Cours sur la biologie moléculaire et ses applications.', '2023-09-01', '2023-12-15', 5),
(59, 'Génétique', 'Cours sur la génétique et ses applications.', '2023-09-01', '2023-12-15', 5),
(60, 'Écologie', 'Cours sur les principes de l\'écologie et la conservation de l\'environnement.', '2023-09-01', '2023-12-15', 5),
(61, 'Introduction à la Littérature', 'Cours d\'introduction à la littérature classique et moderne.', '2023-09-01', '2023-12-15', 6),
(62, 'Analyse Littéraire', 'Cours sur l\'analyse des œuvres littéraires.', '2023-09-01', '2023-12-15', 6),
(63, 'Histoire de la Littérature', 'Cours sur l\'histoire de la littérature à travers les âges.', '2023-09-01', '2023-12-15', 6),
(64, 'Littérature Comparée', 'Cours sur la comparaison des littératures de différentes cultures.', '2023-09-01', '2023-12-15', 6),
(65, 'Introduction à la Physique', 'Cours d\'introduction aux concepts fondamentaux de la physique.', '2023-09-01', '2023-12-15', 7),
(66, 'Chimie Générale', 'Cours sur les principes fondamentaux de la chimie.', '2023-09-01', '2023-12-15', 7),
(67, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 7),
(68, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences.', '2023-09-01', '2023-12-15', 7),
(69, 'Introduction à la Programmation', 'Cours d\'introduction à la programmation en Python.', '2023-09-01', '2023-12-15', 1),
(70, 'Algèbre Linéaire', 'Cours sur les concepts fondamentaux de l\'algèbre linéaire.', '2023-09-01', '2023-12-15', 1),
(71, 'Base de Données', 'Cours sur la conception et la gestion des bases de données.', '2023-09-01', '2023-12-15', 1),
(72, 'Réseaux Informatiques', 'Cours sur les principes des réseaux informatiques.', '2023-09-01', '2023-12-15', 1),
(73, 'Analyse Numérique', 'Cours sur les méthodes numériques pour l\'analyse.', '2023-09-01', '2023-12-15', 2),
(74, 'Statistiques', 'Cours sur les méthodes statistiques et leurs applications.', '2023-09-01', '2023-12-15', 2),
(75, 'Calcul Différentiel', 'Cours sur le calcul différentiel et ses applications.', '2023-09-01', '2023-12-15', 2),
(76, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences de l\'ingénieur.', '2023-09-01', '2023-12-15', 2),
(77, 'Physique Quantique', 'Cours sur les principes de la physique quantique.', '2023-09-01', '2023-12-15', 3),
(78, 'Thermodynamique', 'Cours sur les principes de la thermodynamique.', '2023-09-01', '2023-12-15', 3),
(79, 'Mécanique Quantique', 'Cours sur les principes de la mécanique quantique.', '2023-09-01', '2023-12-15', 3),
(80, 'Astronomie', 'Cours sur les principes de l\'astronomie et l\'exploration de l\'espace.', '2023-09-01', '2023-12-15', 3),
(81, 'Chimie Organique', 'Cours sur la chimie organique et ses applications.', '2023-09-01', '2023-12-15', 4),
(82, 'Chimie Inorganique', 'Cours sur la chimie inorganique et ses applications.', '2023-09-01', '2023-12-15', 4),
(83, 'Chimie Analytique', 'Cours sur les méthodes analytiques en chimie.', '2023-09-01', '2023-12-15', 4),
(84, 'Chimie Générale', 'Cours sur les principes fondamentaux de la chimie.', '2023-09-01', '2023-12-15', 4),
(85, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 5),
(86, 'Biologie Moléculaire', 'Cours sur la biologie moléculaire et ses applications.', '2023-09-01', '2023-12-15', 5),
(87, 'Génétique', 'Cours sur la génétique et ses applications.', '2023-09-01', '2023-12-15', 5),
(88, 'Écologie', 'Cours sur les principes de l\'écologie et la conservation de l\'environnement.', '2023-09-01', '2023-12-15', 5),
(89, 'Introduction à la Littérature', 'Cours d\'introduction à la littérature classique et moderne.', '2023-09-01', '2023-12-15', 6),
(90, 'Analyse Littéraire', 'Cours sur l\'analyse des œuvres littéraires.', '2023-09-01', '2023-12-15', 6),
(91, 'Histoire de la Littérature', 'Cours sur l\'histoire de la littérature à travers les âges.', '2023-09-01', '2023-12-15', 6),
(92, 'Littérature Comparée', 'Cours sur la comparaison des littératures de différentes cultures.', '2023-09-01', '2023-12-15', 6),
(93, 'Introduction à la Physique', 'Cours d\'introduction aux concepts fondamentaux de la physique.', '2023-09-01', '2023-12-15', 7),
(94, 'Chimie Générale', 'Cours sur les principes fondamentaux de la chimie.', '2023-09-01', '2023-12-15', 7),
(95, 'Biologie Cellulaire', 'Cours sur la biologie cellulaire et ses mécanismes.', '2023-09-01', '2023-12-15', 7),
(96, 'Mathématiques Avancées', 'Cours sur les mathématiques avancées pour les sciences.', '2023-09-01', '2023-12-15', 7),
(97, 'Programmation Web', 'Chapitre 3 : JavaScript avancé', '2025-02-13', '2025-02-18', 1),
(98, 'Algèbre Linéaire', 'Matrices, déterminants et espaces vectoriels', '2025-02-13', '2025-02-19', 2),
(99, 'Introduction à la Physique', 'Mécanique et forces fondamentales', '2025-02-13', '2025-02-20', 3),
(100, 'Chimie Organique', 'Les réactions fondamentales et leurs applications', '2025-02-13', '2025-02-17', 4),
(101, 'Biologie Cellulaire', 'Structure et fonction des cellules', '2025-02-13', '2025-02-18', 5),
(102, 'Analyse de Textes', 'Méthodes d’analyse littéraire', '2025-02-13', '2025-02-19', 6),
(103, 'Sciences de l’Environnement', 'Impact de l’activité humaine sur la planète', '2025-02-13', '2025-02-20', 7),
(104, 'Développement Mobile', 'Créer des applications avec React Native', '2025-02-13', '2025-03-13', 1),
(105, 'Statistiques et Probabilités', 'Bases des statistiques descriptives et inférentielles', '2025-02-13', '2025-03-13', 2),
(106, 'Physique Quantique', 'Introduction aux principes de la mécanique quantique', '2025-02-13', '2025-03-13', 3),
(107, 'Chimie Analytique', 'Techniques de dosage et d’analyse chimique', '2025-02-13', '2025-03-13', 4),
(108, 'Génétique', 'Transmission des caractères héréditaires', '2025-02-13', '2025-03-13', 5),
(109, 'Histoire de la Littérature', 'Mouvements littéraires du Moyen Âge à nos jours', '2025-02-13', '2025-03-13', 6),
(110, 'Sciences et Technologie', 'Innovation et progrès technologiques', '2025-02-13', '2025-03-13', 7);

-- --------------------------------------------------------

--
-- Structure de la table `emploi_du_temps`
--

CREATE TABLE `emploi_du_temps` (
  `id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `jour` varchar(50) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `salle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `emploi_du_temps`
--

INSERT INTO `emploi_du_temps` (`id`, `cours_id`, `jour`, `heure_debut`, `heure_fin`, `salle`) VALUES
(1, 1, 'Lundi', '09:00:00', '11:00:00', 'Salle 101'),
(2, 1, 'Mercredi', '13:00:00', '15:00:00', 'Salle 101'),
(3, 2, 'Mardi', '10:00:00', '12:00:00', 'Salle 201'),
(4, 2, 'Jeudi', '14:00:00', '16:00:00', 'Salle 201'),
(5, 3, 'Lundi', '11:00:00', '13:00:00', 'Salle 102'),
(6, 3, 'Vendredi', '09:00:00', '11:00:00', 'Salle 102'),
(7, 4, 'Mardi', '13:00:00', '15:00:00', 'Salle 103'),
(8, 4, 'Jeudi', '11:00:00', '13:00:00', 'Salle 103'),
(9, 5, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(10, 5, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(11, 6, 'Mardi', '09:00:00', '11:00:00', 'Salle 202'),
(12, 6, 'Vendredi', '13:00:00', '15:00:00', 'Salle 202'),
(13, 7, 'Lundi', '10:00:00', '12:00:00', 'Salle 203'),
(14, 7, 'Vendredi', '10:00:00', '12:00:00', 'Salle 203'),
(15, 8, 'Mercredi', '14:00:00', '16:00:00', 'Salle 104'),
(16, 8, 'Vendredi', '09:00:00', '11:00:00', 'Salle 104'),
(17, 9, 'Mardi', '11:00:00', '13:00:00', 'Salle 203'),
(18, 9, 'Jeudi', '09:00:00', '11:00:00', 'Salle 203'),
(19, 10, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(20, 10, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(21, 11, 'Mardi', '09:00:00', '11:00:00', 'Salle 202'),
(22, 11, 'Vendredi', '13:00:00', '15:00:00', 'Salle 202'),
(23, 12, 'Lundi', '10:00:00', '12:00:00', 'Salle 203'),
(24, 12, 'Vendredi', '10:00:00', '12:00:00', 'Salle 203'),
(25, 13, 'Mercredi', '14:00:00', '16:00:00', 'Salle 104'),
(26, 13, 'Vendredi', '09:00:00', '11:00:00', 'Salle 104'),
(27, 14, 'Mardi', '11:00:00', '13:00:00', 'Salle 203'),
(28, 14, 'Jeudi', '09:00:00', '11:00:00', 'Salle 203'),
(29, 15, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(30, 15, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(31, 16, 'Mardi', '09:00:00', '11:00:00', 'Salle 202'),
(32, 16, 'Vendredi', '13:00:00', '15:00:00', 'Salle 202'),
(33, 17, 'Lundi', '10:00:00', '12:00:00', 'Salle 203'),
(34, 17, 'Vendredi', '10:00:00', '12:00:00', 'Salle 203'),
(35, 18, 'Mercredi', '14:00:00', '16:00:00', 'Salle 104'),
(36, 18, 'Vendredi', '09:00:00', '11:00:00', 'Salle 104'),
(37, 19, 'Mardi', '11:00:00', '13:00:00', 'Salle 203'),
(38, 19, 'Jeudi', '09:00:00', '11:00:00', 'Salle 203'),
(39, 20, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(40, 20, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(41, 21, 'Mardi', '11:00:00', '13:00:00', 'Salle 203'),
(42, 21, 'Jeudi', '09:00:00', '11:00:00', 'Salle 203'),
(43, 22, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(44, 22, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(45, 23, 'Mardi', '09:00:00', '11:00:00', 'Salle 202'),
(46, 23, 'Vendredi', '13:00:00', '15:00:00', 'Salle 202'),
(47, 24, 'Lundi', '10:00:00', '12:00:00', 'Salle 203'),
(48, 24, 'Vendredi', '10:00:00', '12:00:00', 'Salle 203'),
(49, 25, 'Mercredi', '14:00:00', '16:00:00', 'Salle 104'),
(50, 25, 'Vendredi', '09:00:00', '11:00:00', 'Salle 104'),
(51, 26, 'Mardi', '11:00:00', '13:00:00', 'Salle 203'),
(52, 26, 'Jeudi', '09:00:00', '11:00:00', 'Salle 203'),
(53, 27, 'Lundi', '14:00:00', '16:00:00', 'Salle 301'),
(54, 27, 'Mercredi', '11:00:00', '13:00:00', 'Salle 301'),
(55, 28, 'Mardi', '09:00:00', '11:00:00', 'Salle 202'),
(56, 28, 'Vendredi', '13:00:00', '15:00:00', 'Salle 202'),
(57, 41, 'Lundi', '08:00:00', '10:00:00', 'Salle 101'),
(58, 42, 'Mardi', '10:00:00', '12:00:00', 'Salle 201'),
(59, 43, 'Mercredi', '12:00:00', '14:00:00', 'Salle 102'),
(60, 44, 'Jeudi', '14:00:00', '16:00:00', 'Salle 103'),
(61, 45, 'Lundi', '10:00:00', '12:00:00', 'Salle 301'),
(62, 46, 'Mardi', '12:00:00', '14:00:00', 'Salle 302'),
(63, 47, 'Mercredi', '14:00:00', '16:00:00', 'Salle 303'),
(64, 48, 'Jeudi', '16:00:00', '18:00:00', 'Salle 304'),
(65, 49, 'Lundi', '08:00:00', '10:00:00', 'Salle 401'),
(66, 50, 'Mardi', '10:00:00', '12:00:00', 'Salle 402'),
(67, 51, 'Mercredi', '12:00:00', '14:00:00', 'Salle 403'),
(68, 52, 'Jeudi', '14:00:00', '16:00:00', 'Salle 404'),
(69, 53, 'Lundi', '10:00:00', '12:00:00', 'Salle 501'),
(70, 54, 'Mardi', '12:00:00', '14:00:00', 'Salle 502'),
(71, 55, 'Mercredi', '14:00:00', '16:00:00', 'Salle 503'),
(72, 56, 'Jeudi', '16:00:00', '18:00:00', 'Salle 504'),
(73, 57, 'Lundi', '08:00:00', '10:00:00', 'Salle 601'),
(74, 58, 'Mardi', '10:00:00', '12:00:00', 'Salle 602'),
(75, 59, 'Mercredi', '12:00:00', '14:00:00', 'Salle 603'),
(76, 60, 'Jeudi', '14:00:00', '16:00:00', 'Salle 604'),
(77, 61, 'Lundi', '08:00:00', '10:00:00', 'Salle 701'),
(78, 62, 'Mardi', '10:00:00', '12:00:00', 'Salle 702'),
(79, 63, 'Mercredi', '12:00:00', '14:00:00', 'Salle 703'),
(80, 64, 'Jeudi', '14:00:00', '16:00:00', 'Salle 704'),
(81, 65, 'Lundi', '08:00:00', '10:00:00', 'Salle 801'),
(82, 66, 'Mardi', '10:00:00', '12:00:00', 'Salle 802'),
(83, 67, 'Mercredi', '12:00:00', '14:00:00', 'Salle 803'),
(84, 68, 'Jeudi', '14:00:00', '16:00:00', 'Salle 804'),
(85, 69, 'Lundi', '08:00:00', '10:00:00', 'Salle 101'),
(86, 70, 'Mardi', '10:00:00', '12:00:00', 'Salle 201'),
(87, 71, 'Mercredi', '12:00:00', '14:00:00', 'Salle 102'),
(88, 72, 'Jeudi', '14:00:00', '16:00:00', 'Salle 103'),
(89, 73, 'Lundi', '10:00:00', '12:00:00', 'Salle 301'),
(90, 74, 'Mardi', '12:00:00', '14:00:00', 'Salle 302'),
(91, 75, 'Mercredi', '14:00:00', '16:00:00', 'Salle 303'),
(92, 76, 'Jeudi', '16:00:00', '18:00:00', 'Salle 304'),
(93, 77, 'Lundi', '08:00:00', '10:00:00', 'Salle 401'),
(94, 78, 'Mardi', '10:00:00', '12:00:00', 'Salle 402'),
(95, 79, 'Mercredi', '12:00:00', '14:00:00', 'Salle 403'),
(96, 80, 'Jeudi', '14:00:00', '16:00:00', 'Salle 404'),
(97, 81, 'Lundi', '10:00:00', '12:00:00', 'Salle 501'),
(98, 82, 'Mardi', '12:00:00', '14:00:00', 'Salle 502'),
(99, 83, 'Mercredi', '14:00:00', '16:00:00', 'Salle 503'),
(100, 84, 'Jeudi', '16:00:00', '18:00:00', 'Salle 504'),
(101, 85, 'Lundi', '08:00:00', '10:00:00', 'Salle 601'),
(102, 86, 'Mardi', '10:00:00', '12:00:00', 'Salle 602'),
(103, 87, 'Mercredi', '12:00:00', '14:00:00', 'Salle 603'),
(104, 88, 'Jeudi', '14:00:00', '16:00:00', 'Salle 604'),
(105, 89, 'Lundi', '08:00:00', '10:00:00', 'Salle 701'),
(106, 90, 'Mardi', '10:00:00', '12:00:00', 'Salle 702'),
(107, 91, 'Mercredi', '12:00:00', '14:00:00', 'Salle 703'),
(108, 92, 'Jeudi', '14:00:00', '16:00:00', 'Salle 704'),
(109, 93, 'Lundi', '08:00:00', '10:00:00', 'Salle 801'),
(110, 94, 'Mardi', '10:00:00', '12:00:00', 'Salle 802'),
(111, 95, 'Mercredi', '12:00:00', '14:00:00', 'Salle 803'),
(112, 96, 'Jeudi', '14:00:00', '16:00:00', 'Salle 804');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `identification` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `email`, `identification`, `password`) VALUES
(1, 'kassimo', 'ben', 'kassim@gmail.com', 'ID152', '1234');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`) VALUES
(1, 'Informatique'),
(2, 'Mathématiques'),
(3, 'Physique'),
(4, 'Chimie'),
(5, 'Biologie'),
(6, 'Littérature'),
(7, 'Sciences');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_liked` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pub`
--

CREATE TABLE `pub` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `date_pub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `pub`
--

INSERT INTO `pub` (`id`, `etudiant_id`, `contenu`, `fichier`, `date_pub`) VALUES
(1, 1, 'Bonjour! Pouvez-vous me venir en aides sur ce sujet', 'uploads/1739452553_1_1 Tips for using Colab - Copy.pdf', '2025-02-13 13:15:53'),
(2, 1, 'Salut tout le monde! Un petit partage de ma part.', 'uploads/1739453771_link_to_drive_file.docx', '2025-02-13 13:36:11');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `fichier` varchar(100) DEFAULT NULL,
  `date_publication` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id`, `etudiant_id`, `contenu`, `fichier`, `date_publication`) VALUES
(1, 1, 'voici un capture d\'ecran pour la logo de nmap', NULL, '2025-02-12 12:07:15'),
(2, 1, 'voici un capture d\'ecran pour la logo de nmap', NULL, '2025-02-12 12:09:44'),
(3, 1, 'voici un capture d\'ecran pour la logo de nmap', 'uploads/1739362293_Capture d’écran (3).png', '2025-02-12 12:11:33'),
(4, 1, 'voici un capture d\'ecran pour la logo de nmap', 'uploads/1739362449_Capture d’écran (3).png', '2025-02-12 12:14:09'),
(5, 1, 'voici un capture d\'ecran pour la logo de nmap', 'uploads/1739362792_Capture d’écran (3).png', '2025-02-12 12:19:52');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `date_reponse` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_id` (`publication_id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `coms`
--
ALTER TABLE `coms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pub_id` (`pub_id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filiere_id` (`filiere_id`);

--
-- Index pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cours_id` (`cours_id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `identification` (`identification`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pub_id` (`pub_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `pub`
--
ALTER TABLE `pub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaire_id` (`commentaire_id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `coms`
--
ALTER TABLE `coms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pub`
--
ALTER TABLE `pub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `coms`
--
ALTER TABLE `coms`
  ADD CONSTRAINT `coms_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pub` (`id`),
  ADD CONSTRAINT `coms_ibfk_2` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`filiere_id`) REFERENCES `filiere` (`id`);

--
-- Contraintes pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD CONSTRAINT `emploi_du_temps_ibfk_1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pub` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `pub`
--
ALTER TABLE `pub`
  ADD CONSTRAINT `pub_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
