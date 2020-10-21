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
-- Table structure for table `city_pairs`
--

DROP TABLE IF EXISTS `city_pairs`;
CREATE TABLE `city_pairs` (
  `city_pairs_id` int(11) NOT NULL,
  `From_City_Code` int(11) NOT NULL,
  `To_City_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This table holds the relational city pairs codes';

--
-- Dumping data for table `city_pairs`
--

INSERT INTO `city_pairs` VALUES(1, 1, 2);
INSERT INTO `city_pairs` VALUES(2, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_pairs`
--
ALTER TABLE `city_pairs`
  ADD PRIMARY KEY (`city_pairs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_pairs`
--
ALTER TABLE `city_pairs`
  MODIFY `city_pairs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

