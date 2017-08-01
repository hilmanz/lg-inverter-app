-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2016 at 10:37 AM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `berbagie_lg_inverter`
--

-- --------------------------------------------------------

--
-- Table structure for table `register_fb`
--

CREATE TABLE IF NOT EXISTS `register_fb` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fb_id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `register_fb`
--

INSERT INTO `register_fb` (`id`, `fb_id`, `nama`, `kode`, `email`, `created_at`) VALUES
(1, '10202589888225056', 'Fauzi Rahman', '4892507e9', 'fauzirahman45@yahoo.com', '2016-11-09 10:15:02'),
(2, '10205767747672813', 'Andri Setia Permana', '882201798', 'asp_fey@yahoo.co.id', '2016-11-09 10:25:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
