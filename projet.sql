-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 04:25 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgenre_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre_name`, `subgenre_name`) VALUES
(716, 'Afrique', NULL),
(717, 'Afrique', 'Afrobeat'),
(718, 'Afrique', 'Congolese rumba'),
(719, 'Afrique', 'Coupé-Décalé'),
(720, 'Afrique', 'Kizomba'),
(721, 'Afrique', 'Kuduro'),
(722, 'Afrique', 'Kwassa kwassa'),
(723, 'Afrique', 'Makossa'),
(724, 'Afrique', 'Ndombolo'),
(725, 'Afrique', 'Raï'),
(726, 'Afrique', 'Soukous'),
(727, 'Afrique', 'Zouglou'),
(728, 'Asie', NULL),
(729, 'Asie', 'Bhangra'),
(730, 'Asie', 'C-pop'),
(731, 'Asie', 'Fann at-Tanbura'),
(732, 'Asie', 'Fijiri'),
(733, 'Asie', 'Indian pop'),
(734, 'Asie', 'J-pop'),
(735, 'Asie', 'K-pop'),
(736, 'Asie', 'Khaliji'),
(737, 'Asie', 'Liwa'),
(738, 'Asie', 'Pinoy pop'),
(739, 'Asie', 'Sawt'),
(740, 'Asie', 'Thai pop'),
(741, 'Asie', 'V-pop'),
(742, 'Avant-Garde', NULL),
(743, 'Avant-Garde', 'Electroacoustique'),
(744, 'Avant-Garde', 'Lo-fi'),
(745, 'Avant-Garde', 'Musique concrète'),
(746, 'Avant-Garde', 'Musique experimentale'),
(747, 'Avant-Garde', 'Noise'),
(748, 'Blues', NULL),
(749, 'Blues', 'Blues rock'),
(750, 'Blues', 'Country blues'),
(751, 'Blues', 'Delta blues'),
(752, 'Blues', 'Electric blues'),
(753, 'Blues', 'Gospel blues'),
(754, 'Blues', 'Hokum blues'),
(755, 'Blues', 'Punk blues'),
(756, 'Blues', 'Soul blues'),
(757, 'Caraïbes', NULL),
(758, 'Caraïbes', 'Bouyon'),
(759, 'Caraïbes', 'Calypso'),
(760, 'Caraïbes', 'Compas'),
(761, 'Caraïbes', 'Dancehall'),
(762, 'Caraïbes', 'Dub'),
(763, 'Caraïbes', 'Mambo'),
(764, 'Caraïbes', 'Merengue'),
(765, 'Caraïbes', 'Ragga'),
(766, 'Caraïbes', 'Reggae'),
(767, 'Caraïbes', 'Reggaeton'),
(768, 'Caraïbes', 'Rocksteady'),
(769, 'Caraïbes', 'Rumba'),
(770, 'Caraïbes', 'Ska'),
(771, 'Caraïbes', 'Soca'),
(772, 'Caraïbes', 'Zouk'),
(773, 'Country', NULL),
(774, 'Country', 'Americana'),
(775, 'Country', 'Bluegrass'),
(776, 'Country', 'Cajun'),
(777, 'Country', 'Hokum'),
(778, 'Country', 'Honky Tonk'),
(779, 'Country', 'Psychobilly'),
(780, 'Country', 'Rockabilly'),
(781, 'Country', 'Sertanejo'),
(782, 'Country', 'Western swing'),
(783, 'Country', 'Zydeco'),
(784, 'Electro', NULL),
(785, 'Electro', '2-step'),
(786, 'Electro', 'Acid house'),
(787, 'Electro', 'Acid jazz'),
(788, 'Electro', 'Ambient'),
(789, 'Electro', 'Big beat'),
(790, 'Electro', 'Breakbeat'),
(791, 'Electro', 'Coldwave'),
(792, 'Electro', 'Deep house'),
(793, 'Electro', 'Disco'),
(794, 'Electro', 'Downtempo'),
(795, 'Electro', 'Drum and bass'),
(796, 'Electro', 'Dub'),
(797, 'Electro', 'Dubstep'),
(798, 'Electro', 'EDM'),
(799, 'Electro', 'Eurodance'),
(800, 'Electro', 'Gabba'),
(801, 'Electro', 'Goa'),
(802, 'Electro', 'Grime'),
(803, 'Electro', 'Hardcore'),
(804, 'Electro', 'Hip house'),
(805, 'Electro', 'House music'),
(806, 'Electro', 'Jungle'),
(807, 'Electro', 'Miami bass'),
(808, 'Electro', 'Minimal wave'),
(809, 'Electro', 'Mákina'),
(810, 'Electro', 'New rave'),
(811, 'Electro', 'Nu-gaze'),
(812, 'Electro', 'Speedcore'),
(813, 'Electro', 'Synthwave'),
(814, 'Electro', 'Techno'),
(815, 'Electro', 'Trance'),
(816, 'Electro', 'Trip hop'),
(817, 'Electro', 'UK garage'),
(818, 'Folk', NULL),
(819, 'Folk', 'Celtique'),
(820, 'Folk', 'Chalga'),
(821, 'Folk', 'Folktronica'),
(822, 'Folk', 'Neofolk'),
(823, 'Folk', 'Poésie chantée'),
(824, 'Folk', 'Progressive folk'),
(825, 'Folk', 'Psychedelic folk'),
(826, 'Folk', 'Skiffle'),
(827, 'Folk', 'Western music'),
(828, 'Hip Hop', NULL),
(829, 'Hip Hop', 'Alternatif'),
(830, 'Hip Hop', 'Boom bap'),
(831, 'Hip Hop', 'Bounce music'),
(832, 'Hip Hop', 'Chicano rap'),
(833, 'Hip Hop', 'Chopped and screwed'),
(834, 'Hip Hop', 'Conscient'),
(835, 'Hip Hop', 'Country rap'),
(836, 'Hip Hop', 'Crunk'),
(837, 'Hip Hop', 'Drill'),
(838, 'Hip Hop', 'Experimental'),
(839, 'Hip Hop', 'G-funk'),
(840, 'Hip Hop', 'Gangsta'),
(841, 'Hip Hop', 'Grime'),
(842, 'Hip Hop', 'Hardcore'),
(843, 'Hip Hop', 'Hip house'),
(844, 'Hip Hop', 'Horrorcore'),
(845, 'Hip Hop', 'Hyphy'),
(846, 'Hip Hop', 'Instrumental'),
(847, 'Hip Hop', 'Jazzy'),
(848, 'Hip Hop', 'Metal'),
(849, 'Hip Hop', 'Miami bass'),
(850, 'Hip Hop', 'Pop urbaine'),
(851, 'Hip Hop', 'Snap music'),
(852, 'Hip Hop', 'Southern'),
(853, 'Hip Hop', 'Trap'),
(854, 'Hip Hop', 'Turntablism'),
(855, 'Hip Hop', 'Underground'),
(856, 'Hip Hop', 'West coast'),
(857, 'Jazz', NULL),
(858, 'Jazz', 'Acid jazz'),
(859, 'Jazz', 'Bebop'),
(860, 'Jazz', 'Boogie woogie'),
(861, 'Jazz', 'Cape jazz'),
(862, 'Jazz', 'Cool jazz'),
(863, 'Jazz', 'Free jazz'),
(864, 'Jazz', 'Gypsy jazz'),
(865, 'Jazz', 'Hard bop'),
(866, 'Jazz', 'Jazz blues'),
(867, 'Jazz', 'Jazz fusion'),
(868, 'Jazz', 'Jazz rock'),
(869, 'Jazz', 'Jazz vocal'),
(870, 'Jazz', 'Jazz-funk'),
(871, 'Jazz', 'Latin jazz'),
(872, 'Jazz', 'Ragtime'),
(873, 'Jazz', 'Smooth jazz'),
(874, 'Jazz', 'Soul jazz'),
(875, 'Jazz', 'Swing'),
(876, 'Musique Classique', NULL),
(877, 'Musique Classique', 'Aubade'),
(878, 'Musique Classique', 'Ballade'),
(879, 'Musique Classique', 'Baroque'),
(880, 'Musique Classique', 'Cantate'),
(881, 'Musique Classique', 'Chorale'),
(882, 'Musique Classique', 'Concerto'),
(883, 'Musique Classique', 'Contemporaine'),
(884, 'Musique Classique', 'Fantaisie'),
(885, 'Musique Classique', 'Madrigal'),
(886, 'Musique Classique', 'Moderne'),
(887, 'Musique Classique', 'Opéra'),
(888, 'Musique Classique', 'Requiem'),
(889, 'Musique Classique', 'Romantique'),
(890, 'Musique Classique', 'Rondeau'),
(891, 'Musique Classique', 'Sérénade'),
(892, 'Musique Classique', 'Sonate'),
(893, 'Musique Classique', 'Suite'),
(894, 'Musique Classique', 'Symphonie'),
(895, 'Musique Classique', 'Toccata'),
(896, 'Musique Classique', 'Valse'),
(897, 'Musique Latine', NULL),
(898, 'Musique Latine', 'Bachata'),
(899, 'Musique Latine', 'Bossa Nova'),
(900, 'Musique Latine', 'Carioca'),
(901, 'Musique Latine', 'Cumbia'),
(902, 'Musique Latine', 'Fado'),
(903, 'Musique Latine', 'Flamenco'),
(904, 'Musique Latine', 'Lambada'),
(905, 'Musique Latine', 'Mambo'),
(906, 'Musique Latine', 'Mariachi'),
(907, 'Musique Latine', 'Merengue'),
(908, 'Musique Latine', 'Rumba'),
(909, 'Musique Latine', 'Salsa'),
(910, 'Musique Latine', 'Samba'),
(911, 'Musique Latine', 'Tango'),
(912, 'Pop', NULL),
(913, 'Pop', 'Britpop'),
(914, 'Pop', 'C-pop'),
(915, 'Pop', 'Electropop'),
(916, 'Pop', 'French pop'),
(917, 'Pop', 'J-pop'),
(918, 'Pop', 'K-pop'),
(919, 'Pop', 'Pop rock'),
(920, 'Pop', 'Synthpop'),
(921, 'R&B/Soul', NULL),
(922, 'R&B/Soul', 'Blue-eyed soul'),
(923, 'R&B/Soul', 'Boogie'),
(924, 'R&B/Soul', 'Disco'),
(925, 'R&B/Soul', 'Funk'),
(926, 'R&B/Soul', 'Go-go'),
(927, 'R&B/Soul', 'New jack swing'),
(928, 'R&B/Soul', 'Northern soul'),
(929, 'R&B/Soul', 'Nu soul'),
(930, 'R&B/Soul', 'P-Funk'),
(931, 'R&B/Soul', 'Rhythm and blues'),
(932, 'R&B/Soul', 'Soul'),
(933, 'R&B/Soul', 'Southern soul'),
(934, 'Rock', NULL),
(935, 'Rock', 'Alternatif'),
(936, 'Rock', 'Black metal'),
(937, 'Rock', 'Death metal'),
(938, 'Rock', 'Emo'),
(939, 'Rock', 'Glam rock'),
(940, 'Rock', 'Gothique'),
(941, 'Rock', 'Grindcore'),
(942, 'Rock', 'Grunge'),
(943, 'Rock', 'Hard rock'),
(944, 'Rock', 'Heavy metal'),
(945, 'Rock', 'Industriel'),
(946, 'Rock', 'Krautrock'),
(947, 'Rock', 'New wave'),
(948, 'Rock', 'Noise rock'),
(949, 'Rock', 'Pop rock'),
(950, 'Rock', 'Psychobilly'),
(951, 'Rock', 'Punk rock'),
(952, 'Rock', 'Rock and roll'),
(953, 'Rock', 'Thrash metal');

-- --------------------------------------------------------

--
-- Table structure for table `live`
--

CREATE TABLE `live` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_live` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deezer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spotify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soundcloud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `live_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgenre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live`
--

INSERT INTO `live` (`id`, `artist`, `image`, `date_created`, `date_live`, `schedule`, `description`, `facebook`, `instagram`, `twitter`, `youtube`, `deezer`, `spotify`, `soundcloud`, `user_id`, `live_type`, `ticket`, `live_name`, `price`, `genre`, `subgenre`, `address`, `postcode`, `ville`, `latitude`, `longitude`) VALUES
(7, 'Cac Stevens', 'Cac Stevens.jpeg', '2020-06-16 11:16:19', '2020-06-20', '21:00', 'Cac Stevens, c\'est un petit bout d\'Amérique au coeur de l\'Occitanie. Amateur de longue date de grosses cylindrées, ce bluesman hors-pair vous emmènera faire un tour avec lui sur sa Harley Davidson, le temps d\'un concert relatant ses péripéties sur les routes du département. Oscillant en permanence entre récits introspectifs, humour au vitriol et cuisine Asiatique à emporter, ce showman réputé viendra enflammer la scène du Bikini avec un road trip musical haletant, mais toujours dans le respect des limitations de vitesse.', 'cacstevens', 'cacstevens/?hl=fr', 'cacstevens/?hl=fr', 'user/cacstevens', 'fr/artist/57171', 'artist/4e8tDC3yIRlHFbx9nbUPvW', 'cacstevens', 4, 'Concert', 'https://lebikini.com/billetterie/', 'Sur la route de Grenade...', '15', 'Blues', 'Blues rock', 'Parc Technologique du Canal, Rue Théodore Monod,', '31250', 'Ramonville-Saint-Agne', '43.5480036', '1.4834853'),
(8, 'Prince Eric', 'Prince Eric.jpeg', '2020-06-16 11:20:33', '2020-06-30', '19:30', 'La vie c\'est simple comme un étang paisible, une bière bien fraiche et un petit air de Jazz. Prince Eric l\'a bien compris, et s\'applique ainsi à mettre en musique sa vision du bonheur depuis maintenant plus de 20 ans, avec un swing digne des plus grands. Récemment revenu sur le devant de la scène locale suite au succès du single \"Véro, lâche mon clavier\", ce prodige de la note bleue vous accompagnera avec élégance tout le long de cette formule repas + concert proposée par le célèbre bar à tapas Le Pic.', 'prince-eric', 'prince-eric/?hl=fr', 'prince-eric/?hl=fr', 'user/prince-eric', 'fr/artist/7685', 'artist/1xbjT6BnZk2j6PZhf5VZR7', 'prince-eric', 4, 'Festival', 'lepic-muret.fr', 'Carpe et diem', '30', 'Jazz', 'Swing', '152 Avenue Du Pic Du Ger', '31600', 'Muret', '43.5360389', '1.3924701'),
(9, 'Jean-Guy Balnave', 'Jean-Guy Balnave.jpeg', '2020-06-16 11:25:56', '2020-07-05', '17:30', 'Après une tournée triomphale dans les bars-pmu de Meurthe et Moselle l\'an dernier, Jean-Guy Balnave revient aujourd\'hui avec son tout nouveau spectacle \"Rupture de stock\". Toujours aussi farouchement déjanté, cet artiste atypique et mal rasé viendra présenter ses nouvelles compositions en exclusivité lors de ce showcase dans l\'enceinte de votre magasin Cultura de Portet sur Garonne. Energie, bonne humeur et effluves corporelles diverses vous attendent dès 17h30 ce jour-là pour un moment qui s\'annonce d\'ores et déjà mémorable.', 'jgbalnave', 'jgbalnave/?hl=fr', 'jgbalnave/?hl=fr', 'user/jgbalnave', 'fr/artist/70333', 'artist/5GghUYk576UbbR133hZwh7', 'jgbalnave', 4, 'Showcase', 'https://www.cultura.com/les-magasins/cultura-portet-sur-garonne.html', 'Rupture de stock tour', '1', 'Jazz', 'Swing', '12 Boulevard De L\'Europe', '31120', 'Portet-Sur-Garonne', '43.4127029', '1.3049959'),
(10, 'testtesttesttest', 'testtesttesttest.jpeg', '2020-06-16 16:07:42', '2020-06-24', '05:08', 'mardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardimardi', 'test', 'mardi', 'mardi', 'mardi', 'mardi', 'mardi', 'mardi', 4, 'Festival', 'Test collection', 'test', '20', 'Musique Latine', 'Rumba', 'Place du capitole', '31000', 'Toulouse', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200609083805', '2020-06-09 08:40:09'),
('20200609090928', '2020-06-09 09:09:39'),
('20200609091841', '2020-06-09 09:18:51'),
('20200609092526', '2020-06-09 09:34:52'),
('20200609093458', '2020-06-09 09:35:04'),
('20200609101240', '2020-06-09 10:12:47'),
('20200609125624', '2020-06-09 12:56:46'),
('20200609130455', '2020-06-09 13:05:01'),
('20200609161647', '2020-06-09 16:16:59'),
('20200610072049', '2020-06-10 07:21:01'),
('20200610074813', '2020-06-10 07:48:21'),
('20200610075028', '2020-06-10 07:50:39'),
('20200610081411', '2020-06-10 08:14:16'),
('20200610082131', '2020-06-10 08:21:35'),
('20200610083517', '2020-06-10 08:37:45'),
('20200610113753', '2020-06-10 11:38:29'),
('20200610120523', '2020-06-10 12:05:28'),
('20200611085838', '2020-06-11 08:58:47'),
('20200611090257', '2020-06-11 09:03:11'),
('20200611112734', '2020-06-11 11:27:43'),
('20200611210218', '2020-06-12 08:14:21'),
('20200611210348', '2020-06-12 08:14:21'),
('20200611211441', '2020-06-12 08:14:21'),
('20200611211702', '2020-06-12 08:14:21'),
('20200612102051', '2020-06-12 10:21:00'),
('20200612102248', '2020-06-12 10:22:53'),
('20200612155020', '2020-06-12 15:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `release`
--

CREATE TABLE `release` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_release` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deezer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spotify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soundcloud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgenre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `release`
--

INSERT INTO `release` (`id`, `artist`, `date_created`, `image`, `release_type`, `date_release`, `release_name`, `description`, `facebook`, `instagram`, `twitter`, `youtube`, `deezer`, `spotify`, `soundcloud`, `user_id`, `genre`, `subgenre`) VALUES
(16, 'El Concombrito Maskado', '2020-06-16 11:34:29', 'El Concombrito Maskado.jpeg', 'Digital', '2020-06-19', 'No pasaran los microbos!', 'Pendant que le monde entier luttait avec le covid-19, un jeune artiste d\'origine Indienne eut la folle idée de se faire greffer un masque directement sur le visage. Fort de ce gain de charisme instantané, il décida alors d\'entrer en studio afin d\'enregistrer un véritable pamphlet anti-virus, un brulot politique abrasif et sans concessions. Malheureusement, à cause de l\'épaisseur du masque, personne jusqu\'ici n\'a été capable de déchiffrer un seul mot de ce qu\'il raconte. Mais la musique est bonne, promis.', 'elconcombritomaskado', 'elconcombritomaskado/?hl=fr', 'elconcombritomaskado/?hl=fr', 'artist/2FKWNmZWDBZR4dE5KX4plR', 'fr/artist/1199677', 'artist/2FKWNmZWDBZR4dE5KX4plR', 'elconcombritomaskado', 4, 'Asie', 'Indian pop'),
(17, 'Le Rat Luckiano', '2020-06-16 11:41:07', 'Le Rat Luckiano.jpeg', 'CD', '2020-06-26', 'Vision trouble', '2020, la voix des quartiers nord de l\'Aveyron s\'apprête à retentir dans tout l\'hexagone en la personne du Rat Luckiano. Ancien membre du groupe Flamby Family, ce jeune lyriciste surdoué pose avec son nouvel album \"Vision trouble\" un regard plein de lucidité et de strabisme sur le monde actuel. Un rap frontal et précis, des vérités qui blessent, des verres double foyer: Tous les ingrédients d\'un futur classique sont réunis au sein de ce CD. Amateurs de Hip Hop et de textes riches, ne passez pas à côté!', 'leratluckiano', 'leratluckiano/?hl=fr', 'leratluckiano/?hl=fr', 'artist/5QuZ9HdvnXcX8kEG782Phv', 'fr/artist/13672', 'artist/5QuZ9HdvnXcX8kEG782Phv', 'leratluckiano', 4, 'Hip Hop', 'Conscient'),
(18, 'Peter Nakamura', '2020-06-16 11:49:01', 'Peter Nakamura.jpeg', 'Vinyl', '2020-07-10', 'Serial Lover', 'Si les NTM chantaient \"Laisse pas trainer ton fils\", Peter Nakamura pourrait leur répondre \"Laisse pas trainer ta fille\". Ce véritable petit prodige du RnB à l\'ancienne, titulaire d\'un BTS Moonwalk et d\'une licence en brisage de coeurs, nous présente aujourd\'hui son tant attendu premier album: Une collection de 12 ritournelles plus suaves les unes que les autres, des hits imparables à foison, une saveur musicale à mi-chemin entre Dany Brillant et Willy Denzey. Vous cherchiez le futur du RnB à la française? Il est devant vous!', 'peternakamura', 'peternakamura/?hl=fr', 'peternakamura/?hl=fr', 'artist/1ELgiI6P1y4zEkVElVjCbC', 'fr/artist/91948', 'artist/1ELgiI6P1y4zEkVElVjCbC', 'peternakamura', 4, 'R&B/Soul', 'New jack swing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `familyname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `roles`, `password`, `email`, `is_verified`, `date_created`, `nickname`, `familyname`) VALUES
(4, 'Utilisateur', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$RjRZVzBRVXlEb2d3a2JUYg$t2LCmgWrhf+Ou0HHeij5r2RYLDYVx+X3Btw5Ah6AANE', 'contact@nouvelletechno.fr', 0, '2020-06-16 10:59:53', 'Benoit', 'Gambier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_530F2CAFA76ED395` (`user_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `release`
--
ALTER TABLE `release`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9E47031DA76ED395` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E986CC499D` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954;

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `release`
--
ALTER TABLE `release`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `live`
--
ALTER TABLE `live`
  ADD CONSTRAINT `FK_530F2CAFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `release`
--
ALTER TABLE `release`
  ADD CONSTRAINT `FK_9E47031DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
