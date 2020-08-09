-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 07:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
(9, 'Jean-Guy Balnave', 'Jean-Guy Balnave.jpeg', '2020-06-16 11:25:56', '2020-07-05', '17:30', 'Après une tournée triomphale dans les bars-pmu de Meurthe et Moselle l\'an dernier, Jean-Guy Balnave revient aujourd\'hui avec son tout nouveau spectacle \"Rupture de stock\". Toujours aussi farouchement déjanté, cet artiste atypique et mal rasé viendra présenter ses nouvelles compositions en exclusivité lors de ce showcase dans l\'enceinte de votre magasin Cultura de Portet sur Garonne. Energie, bonne humeur et effluves corporelles diverses vous attendent dès 17h30 ce jour-là pour un moment qui s\'annonce d\'ores et déjà mémorable.', 'jgbalnave', 'jgbalnave/?hl=fr', 'jgbalnave/?hl=fr', 'user/jgbalnave', 'fr/artist/70333', 'artist/5GghUYk576UbbR133hZwh7', 'jgbalnave', 4, 'Showcase', 'https://www.cultura.com/les-magasins/cultura-portet-sur-garonne.html', 'Rupture de stock tour', '1', 'Jazz', 'Swing', '12 Boulevard De L\'Europe', '31120', 'Portet-Sur-Garonne', '43.4127029', '1.3049959');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_530F2CAFA76ED395` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `live`
--
ALTER TABLE `live`
  ADD CONSTRAINT `FK_530F2CAFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
