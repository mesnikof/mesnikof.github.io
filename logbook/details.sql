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
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
CREATE TABLE `details` (
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `Aircraft-Model` char(12) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Aircraft-Flight-Ident` char(7) COLLATE utf8_bin NOT NULL DEFAULT '',
  `From` char(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `To` char(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Total-Time` decimal(6,1) UNSIGNED NOT NULL DEFAULT 0.0,
  `SEL` decimal(6,1) UNSIGNED DEFAULT NULL,
  `MEL` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Complex` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Turbine` decimal(6,1) UNSIGNED DEFAULT NULL,
  `High-Performance` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Tail-Wheel` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Instrument-Actual` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Instrument-Simulated` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Instrument-Approaches` int(10) DEFAULT NULL,
  `Aircraft-Simulator-PCATD` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Landings-Day` int(10) DEFAULT NULL,
  `Landings-Night` int(10) DEFAULT NULL,
  `Flight-Training-Received` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Cross-Country` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Night` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Solo` decimal(6,1) UNSIGNED DEFAULT NULL,
  `PIC` decimal(6,1) UNSIGNED DEFAULT NULL,
  `SIC` decimal(6,1) UNSIGNED DEFAULT NULL,
  `Instruction-Given` decimal(6,1) UNSIGNED DEFAULT NULL,
  `RealTime` time DEFAULT NULL,
  `details_id` int(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `details`
--

INSERT INTO `details` VALUES('1997-08-05', 'C172', 'N1317U', 'MHT', 'MHT', '1.1', '1.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '1.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `details_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7142;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
