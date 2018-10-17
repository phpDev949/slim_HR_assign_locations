-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 16, 2018 at 04:25 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_locations`
--

CREATE TABLE `assigned_locations` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_locations`
--

INSERT INTO `assigned_locations` (`id`, `employee_id`, `location_name`) VALUES
(1, 1, 'Anas bahamensis'),
(2, 2, 'Notechis semmiannulatus'),
(3, 3, 'Climacteris melanura'),
(4, 4, 'Varanus sp.'),
(5, 5, 'Sus scrofa'),
(6, 6, 'Bettongia penicillata'),
(7, 7, 'Sus scrofa'),
(8, 8, 'Felis yagouaroundi'),
(9, 9, 'Felis chaus'),
(10, 10, 'Stercorarius longicausus'),
(11, 11, 'Psophia viridis'),
(12, 12, 'Diceros bicornis'),
(13, 13, 'Perameles nasuta'),
(14, 14, 'Rhea americana'),
(15, 15, 'Felis concolor'),
(16, 16, 'Bucorvus leadbeateri'),
(17, 17, 'Phalacrocorax carbo'),
(18, 18, 'Stercorarius longicausus'),
(19, 19, 'Phascogale calura'),
(20, 20, 'Ephipplorhynchus senegalensis'),
(21, 21, 'Cochlearius cochlearius'),
(22, 22, 'Rhea americana'),
(23, 23, 'Felis libyca'),
(24, 24, 'Ursus maritimus'),
(25, 25, 'Uraeginthus bengalus'),
(26, 26, 'Ara macao'),
(27, 27, 'Ctenophorus ornatus'),
(28, 28, 'Dendrocitta vagabunda'),
(29, 29, 'Crotalus cerastes'),
(30, 30, 'Pavo cristatus'),
(31, 31, 'Ephipplorhynchus senegalensis'),
(32, 32, 'Antechinus flavipes'),
(33, 33, 'Ursus arctos'),
(34, 34, 'Macropus fuliginosus'),
(35, 35, 'Microcebus murinus'),
(36, 36, 'Phascogale tapoatafa'),
(37, 37, 'Morelia spilotes variegata'),
(38, 38, 'Chauna torquata'),
(39, 39, 'Cochlearius cochlearius'),
(40, 40, 'Cercatetus concinnus'),
(41, 41, 'Charadrius tricollaris'),
(42, 42, 'Gorilla gorilla'),
(43, 43, 'Semnopithecus entellus'),
(44, 44, 'Phalacrocorax carbo'),
(45, 45, 'Damaliscus lunatus'),
(46, 46, 'unavailable'),
(47, 47, 'Phascogale calura'),
(48, 48, 'Macropus agilis'),
(49, 49, 'Plegadis ridgwayi'),
(50, 50, 'Varanus sp.'),
(51, 1, 'Diceros bicornis'),
(52, 40, 'Diceros bicornis'),
(53, 33, 'Diceros bicornis'),
(54, 11, 'Diceros bicornis'),
(55, 15, 'Phalacrocorax carbo'),
(56, 25, 'Phalacrocorax carbo'),
(57, 44, 'Phalacrocorax carbo'),
(58, 39, 'Phalacrocorax carbo'),
(59, 1, 'Phascogale calura\r\n'),
(60, 1, 'Ephipplorhynchus senegalensis'),
(61, 2, 'Ephipplorhynchus senegalensis'),
(62, 2, 'Cochlearius cochlearius'),
(65, 3, 'Ara macao'),
(66, 4, 'Procyon cancrivorus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_locations`
--
ALTER TABLE `assigned_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_locations`
--
ALTER TABLE `assigned_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
