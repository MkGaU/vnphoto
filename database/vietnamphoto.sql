-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2013 at 11:25 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vietnamphoto`
--
CREATE DATABASE IF NOT EXISTS `vietnamphoto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vietnamphoto`;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Author` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category` int(11) DEFAULT NULL,
  `Tags` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImgLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `Title`, `Author`, `Category`, `Tags`, `ImgLink`, `CreatedTime`) VALUES
(1, '12345', NULL, NULL, NULL, 'jumping.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '', 0, 1380697400, 1, 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '', 0, 1266543330, 0, 1),
(3, 'nam', 'admin', 'nhaqueonline_24h@yahoo.com', '', 0, 0, 0, 0),
(4, 'a', '1234', '', '', 0, 0, 0, 0),
(8, 'name', '12345', 'a@yahoo.com', '', 0, 0, 0, 0),
(9, 'nampd01372', 'e10adc3949ba59abbe56e057f20f883e', 'nhaqueonline@yahoo.com.vn', '', 0, 0, 0, 0),
(12, 'nnha', 'e10adc3949ba59abbe56e057f20f883e', 'nampd@yahoo.com', '', 0, 0, 0, 0),
(13, 'kfkkfk', 'e10adc3949ba59abbe56e057f20f883e', 'namdkd@yahoo.com', '', 0, 0, 0, 0),
(14, 'hieu', 'e10adc3949ba59abbe56e057f20f883e', 'hieu@yahoo.com', '', 0, 0, 0, 0),
(16, 'tuananh', 'e10adc3949ba59abbe56e057f20f883e', 'tuan@yahoo.com.vn', '', 0, 0, 0, 0),
(17, 'lan', 'e10adc3949ba59abbe56e057f20f883e', 'lan@yahoo.com.vn', '', 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
