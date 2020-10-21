-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_codes`
--

DROP TABLE IF EXISTS `city_codes`;
CREATE TABLE `city_codes` (
  `city_codes_id` int(11) NOT NULL,
  `Name` varchar(128) COLLATE utf8_bin NOT NULL,
  `Code` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This table contains City-Name/City-Code pairs';

--
-- Dumping data for table `city_codes`
--

INSERT INTO `city_codes` VALUES(1, 'Logan International Airport, Boston, MA, USA', 'KBOS');
INSERT INTO `city_codes` VALUES(2, 'JFK International Airport, New York, NY, USA', 'KJFK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_codes`
--
ALTER TABLE `city_codes`
  ADD PRIMARY KEY (`city_codes_id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_codes`
--
ALTER TABLE `city_codes`
  MODIFY `city_codes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

