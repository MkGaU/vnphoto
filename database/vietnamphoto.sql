-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2013 at 09:17 AM
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
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Uploader', '3', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('Uploader', 2, 'Upload Images', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Author` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category` int(11) DEFAULT NULL,
  `ageType` int(11) DEFAULT NULL,
  `tags` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `ImgLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(10) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(11) NOT NULL,
  `thumbnails` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedTime` int(10) DEFAULT NULL,
  `UpdateTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=111 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `Title`, `filename`, `Author`, `Category`, `ageType`, `tags`, `status`, `ImgLink`, `format`, `size`, `width`, `height`, `thumbnails`, `CreatedTime`, `UpdateTime`) VALUES
(101, 'dfdsfdsg', '10003.jpg', NULL, NULL, 0, 'beautiful girl', 2, '/images/2013/11/18/8f22b2d138a798b504cb01da952095b7.jpg', 'jpg', 124643, 2560, 1440, '/images/2013/11/18/thumbs/8f22b2d138a798b504cb01da952095b7.jpg', 1384761302, 1385445879),
(102, 'jjjjjjjjjjjjjjjjjjjjjj', '9623.jpg', NULL, NULL, 0, 'beautiful girl', 1, '/images/2013/11/18/01672308d6a19878f31193f54ab7e424.jpg', 'jpg', 366740, 2560, 1440, '/images/2013/11/18/thumbs/01672308d6a19878f31193f54ab7e424.jpg', 1384761401, 1384761401),
(103, 'sfjnsdfsknvkjsnf', 'Babes8676.jpg', NULL, NULL, 0, 'babes', 1, '/images/2013/11/18/0be44826e329c812ee7fafc990a8a7f0.jpg', 'jpg', 168076, 2560, 1440, '/images/2013/11/18/thumbs/ea22436a33ab497722cba4745eef50d5.jpg', 1384762218, 1384762218),
(104, 'panorama', 'Untitled_Panorama2.jpg', NULL, NULL, 0, '', 1, '/images/2013/11/18/b99789e6a742704dd7fc9d6478a51f4b.jpg', 'jpg', 4033506, 4499, 3474, '/images/2013/11/18/thumbs/eed6700d3b87739182d1dd2e4254d5a8.jpg', 1384764526, 1384764526),
(105, 'tgf', 'DSC_4568.JPG', NULL, NULL, 0, '', 1, '/images/2013/11/18/4f80df520270cfb63976705b186b2ddd.JPG', 'JPG', 3439296, 4928, 3264, '/images/2013/11/18/thumbs/4ce7fbb0299d30627261a9bf0cf93f38.JPG', 1384764733, 1384764733),
(106, 'dsfgfdg', 'IMG_0252.JPG', NULL, NULL, 4, 'sida', 2, '/images/2013/11/19/39eab2616d1933e86e26d4eb881efa2d.JPG', 'JPG', 3120477, 3888, 2592, '/images/2013/11/19/thumbs/099b8eeb64c1f8da0a7d9613da98d15f.JPG', 1384846271, 1385054752),
(107, 'sdsfsd', 'IMG_0018.JPG', '1', NULL, 3, 'phuot, hotel, team, smile, s', 2, '/images/2013/11/21/92d894acdc3724c5b02d727800c20eaf.JPG', 'JPG', 3754613, 3888, 2592, '/images/2013/11/21/thumbs/5ffd6b74da5486741dac1c355c6fa9ad.JPG', 1385022974, 1385053165),
(108, 'fdghdfdhdgsdg', 'IMG_0191.JPG', '1', NULL, 2, 'hero, superman', 2, '/images/2013/11/21/4fcfb93ad6a0d6137bd0b8f7750404cb.JPG', 'JPG', 2137051, 3888, 2592, '/images/2013/11/21/thumbs/e3a7d6f9362b9da5372482486af5c891.JPG', 1385026483, 1385030090),
(109, 'dfdgdfhdfg', 'IMG_0015.JPG', '1', NULL, 1, 'ha giang, phuot, travel', 2, '/images/2013/11/21/5a023dcb979ae90dbcf84e7623597526.JPG', 'JPG', 3564371, 3888, 2592, '/images/2013/11/21/thumbs/20e7672d7e58295155b2bf991da25755.JPG', 1385031184, 1385047978),
(110, 'sdsd', 'IMG_0011.JPG', '1', NULL, NULL, '', 1, '/images/2013/11/22/9bc3c7bd7c5b7e0d6ad2801a8199f066.JPG', 'JPG', 2917870, 3888, 2592, '/images/2013/11/22/thumbs/3eedaf3e513bd0a13c209b43920f4043.JPG', 1385110295, 1385110295);

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Draft', 1, 'ImageStatus', 1),
(2, 'Published', 2, 'ImageStatus', 2),
(3, 'Archived', 3, 'ImageStatus', 3),
(4, 'Under_16', 1, 'age', 1),
(5, '16-25', 2, 'age', 2),
(6, '25-50', 3, 'age', 3),
(7, 'Upper_50', 4, 'age', 4);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`) VALUES
(1, 'Admin', 'Administrator'),
(2, 'Demo', 'Demo'),
(3, '1234567', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `frequency`) VALUES
(7, 'sf se', 1),
(8, 'ad', 1),
(9, 'sd', 1),
(10, 'fs', 1),
(11, 'df', 1),
(12, 'troll', 2),
(13, 'jav', 1),
(14, 'storm', 2),
(15, 'rock', 1),
(16, 'mydinh', 1),
(17, 'beautiful girl', 3),
(18, 'babes', 1),
(20, 'hero', 1),
(21, 'superman', 1),
(22, 'ha giang', 1),
(23, 'phuot', 2),
(24, 'travel', 1),
(25, 'hotel', 1),
(26, 'team', 1),
(27, 'smile', 1),
(28, 's', 1),
(29, 'sida', 1);

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
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2013-11-19 08:25:56', '2013-11-26 12:50:20', 1, 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2013-11-19 08:25:56', '2013-11-19 02:45:47', 0, 1),
(3, 'user', '81dc9bdb52d04dc20036dbd8313ed055', 'user@gmail.com', '9851627579fd331bf6ffeb7ac1688190', '2013-11-19 09:19:21', '2013-11-22 01:19:50', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
