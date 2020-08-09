-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 02:38 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
