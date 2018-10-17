-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 16, 2018 at 04:03 AM
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
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `job_title_id`, `location_id`) VALUES
(1, 'Cathrin', 'Weiser', 'cweiser0@purevolume.com', 1, 65),
(2, 'Pacorro', 'Laphorn', 'plaphorn1@cisco.com', 2, 33),
(3, 'Brenna', 'Dimitrie', 'bdimitrie2@unc.edu', 3, 1),
(4, 'Violet', 'Thornley', 'vthornley3@blogs.com', 4, 23),
(5, 'Ezequiel', 'Ivashnikov', 'eivashnikov4@addtoany.com', 5, 45),
(6, 'Doti', 'Diviney', 'ddiviney5@icio.us', 5, 77),
(7, 'Hal', 'Melia', 'hmelia6@discuz.net', 5, 45),
(8, 'Janaya', 'Gudge', 'jgudge7@chicagotribune.com', 5, 98),
(9, 'Danica', 'Thurstan', 'dthurstan8@census.gov', 6, 87),
(10, 'Shandra', 'Jutson', 'sjutson9@comsenz.com', 6, 3),
(11, 'Ragnar', 'Ramberg', 'rramberga@list-manage.com', 6, 70),
(12, 'Anny', 'August', 'aaugustb@economist.com', 6, 32),
(13, 'Gerhardine', 'Cavanagh', 'gcavanaghc@wsj.com', 7, 55),
(14, 'Kelcy', 'Smeeth', 'ksmeethd@state.tx.us', 7, 76),
(15, 'Carree', 'Harder', 'chardere@quantcast.com', 7, 27),
(16, 'Birch', 'Lenoir', 'blenoirf@livejournal.com', 7, 21),
(17, 'Sapphire', 'Sarath', 'ssarathg@acquirethisname.com', 8, 2),
(18, 'Thatch', 'Huet', 'thueth@apache.org', 8, 3),
(19, 'Felice', 'Pickvance', 'fpickvancei@meetup.com', 8, 6),
(20, 'Egan', 'Gittis', 'egittisj@wix.com', 8, 9),
(21, 'Titos', 'Elbourn', 'telbournk@nydailynews.com', 9, 31),
(22, 'Korey', 'Jacobsohn', 'kjacobsohnl@addthis.com', 9, 76),
(23, 'Aretha', 'Muston', 'amustonm@etsy.com', 9, 75),
(24, 'Neall', 'Tutsell', 'ntutselln@cbc.ca', 9, 78),
(25, 'Christean', 'Seiffert', 'cseifferto@amazon.de', 10, 11),
(26, 'Julie', 'Thew', 'jthewp@seesaa.net', 10, 20),
(27, 'Meagan', 'Osgorby', 'mosgorbyq@boston.com', 10, 36),
(28, 'Korry', 'Van Driel', 'kvandrielr@creativecommons.org', 10, 41),
(29, 'Georgeanna', 'Sear', 'gsears@cloudflare.com', 11, 42),
(30, 'Svend', 'Carabine', 'scarabinet@skype.com', 11, 93),
(31, 'Aigneis', 'Picton', 'apictonu@uiuc.edu', 11, 9),
(32, 'Gisela', 'Spaice', 'gspaicev@ow.ly', 11, 16),
(33, 'Viviyan', 'Filyakov', 'vfilyakovw@intel.com', 11, 72),
(34, 'Camille', 'Sumbler', 'csumblerx@mayoclinic.com', 11, 19),
(35, 'Louisette', 'D\'Adamo', 'ldadamoy@ted.com', 11, 44),
(36, 'Joannes', 'Darth', 'jdarthz@theguardian.com', 11, 59),
(37, 'Lindi', 'Timlett', 'ltimlett10@upenn.edu', 11, 62),
(38, 'Ruggiero', 'Zappel', 'rzappel11@pbs.org', 11, 57),
(39, 'Hinze', 'Giacomoni', 'hgiacomoni12@instagram.com', 12, 31),
(40, 'Avram', 'Loyndon', 'aloyndon13@engadget.com', 12, 12),
(41, 'Lexi', 'Gatley', 'lgatley14@instagram.com', 12, 80),
(42, 'Stormie', 'Kegan', 'skegan15@mediafire.com', 12, 38),
(43, 'Tracee', 'Helis', 'thelis16@alexa.com', 12, 81),
(44, 'Kippie', 'Crofts', 'kcrofts17@ameblo.jp', 12, 2),
(45, 'Derril', 'Walak', 'dwalak18@wp.com', 12, 60),
(46, 'Dyana', 'Ithell', 'dithell19@hatena.ne.jp', 12, 37),
(47, 'Kaela', 'Haistwell', 'khaistwell1a@elegantthemes.com', 12, 5),
(48, 'Domeniga', 'Ellerman', 'dellerman1b@bizjournals.com', 12, 82),
(49, 'Riva', 'MacArte', 'rmacarte1c@cocolog-nifty.com', 12, 14),
(50, 'Vlad', 'Edyson', 'vedyson1d@businessinsider.com', 12, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
