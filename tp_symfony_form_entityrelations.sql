-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 mars 2026 à 08:07
-- Version du serveur : 9.1.0
-- Version de PHP : 8.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_symfony_form_entityrelations`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id`, `name`, `year`) VALUES
(1, 'Divide', 2017),
(2, 'After Hours', 2019),
(3, 'Uptown Special', 2014),
(4, '21', 2010),
(5, 'Nevermind', 1991),
(6, 'Thriller', 1982),
(7, '8 Mile (OST)', 2002),
(8, 'Hunting High and Low', 1985),
(9, 'Hotel California', 1976),
(10, 'Ratatouille (OST)', 2007);

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Ed Sheeran'),
(2, 'The Weekend'),
(3, 'Mark Ronson'),
(4, 'Bruno Mars'),
(5, 'Adèle'),
(6, 'Nirvana'),
(7, 'Michael Jackson'),
(8, 'Eminem'),
(9, 'a-ah'),
(10, 'Eagles'),
(11, 'Camille');

-- --------------------------------------------------------

--
-- Structure de la table `artist_album`
--

DROP TABLE IF EXISTS `artist_album`;
CREATE TABLE IF NOT EXISTS `artist_album` (
  `artist_id` int NOT NULL,
  `album_id` int NOT NULL,
  PRIMARY KEY (`artist_id`,`album_id`),
  KEY `IDX_59945E10B7970CF8` (`artist_id`),
  KEY `IDX_59945E101137ABCF` (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artist_album`
--

INSERT INTO `artist_album` (`artist_id`, `album_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9),
(11, 10);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260313153934', '2026-03-16 07:16:51', 96),
('DoctrineMigrations\\Version20260313155251', '2026-03-16 07:16:51', 59);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Pop'),
(2, 'Synth-Pop'),
(3, 'Funk'),
(4, 'Soul'),
(5, 'Grunge'),
(6, 'Rock'),
(7, 'R&B'),
(8, 'Rap'),
(9, 'Rock'),
(10, 'Chanson Française');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE IF NOT EXISTS `track` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `album_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D6E3F8A61137ABCF` (`album_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `track`
--

INSERT INTO `track` (`id`, `name`, `album_id`) VALUES
(1, 'Shape of You', 1),
(2, 'Blinding Lights', 2),
(3, 'Uptown Funk', 3),
(4, 'Rolling in the deeD', 4),
(5, 'Smells Like Teen Spirit', 5),
(6, 'Billie Jeans', 6),
(7, 'Lose Yourself', 7),
(8, 'Take On Me', 8),
(9, 'Hotel California', 9),
(10, 'Le féstin', 10);

-- --------------------------------------------------------

--
-- Structure de la table `track_artist`
--

DROP TABLE IF EXISTS `track_artist`;
CREATE TABLE IF NOT EXISTS `track_artist` (
  `track_id` int NOT NULL,
  `artist_id` int NOT NULL,
  PRIMARY KEY (`track_id`,`artist_id`),
  KEY `IDX_499B576E5ED23C43` (`track_id`),
  KEY `IDX_499B576EB7970CF8` (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `track_artist`
--

INSERT INTO `track_artist` (`track_id`, `artist_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11);

-- --------------------------------------------------------

--
-- Structure de la table `track_genre`
--

DROP TABLE IF EXISTS `track_genre`;
CREATE TABLE IF NOT EXISTS `track_genre` (
  `track_id` int NOT NULL,
  `genre_id` int NOT NULL,
  PRIMARY KEY (`track_id`,`genre_id`),
  KEY `IDX_F3A7915F5ED23C43` (`track_id`),
  KEY `IDX_F3A7915F4296D31F` (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `track_genre`
--

INSERT INTO `track_genre` (`track_id`, `genre_id`) VALUES
(1, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 1),
(4, 4),
(5, 5),
(5, 6),
(6, 1),
(6, 7),
(7, 8),
(8, 2),
(9, 9),
(10, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
