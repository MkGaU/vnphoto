-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2013 at 09:34 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Author` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category` int(11) DEFAULT NULL,
  `sex` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ageType` int(11) DEFAULT NULL,
  `tags` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `imageColor` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImgLink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(10) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(11) NOT NULL,
  `dimension` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedTime` int(10) DEFAULT NULL,
  `UpdateTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=237 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `Title`, `filename`, `Author`, `Category`, `sex`, `ageType`, `tags`, `status`, `imageColor`, `ImgLink`, `format`, `size`, `width`, `height`, `dimension`, `thumbnails`, `CreatedTime`, `UpdateTime`) VALUES
(210, '', '9316.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/12671a9f29ad29fc6f4dc1fee67797ad.jpg', 'jpg', 438626, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/909776ea86437d31c06dbf7cc6ef9103.jpg', 1386125303, 1386125411),
(211, '', '9468.jpg', 'admin', NULL, '', NULL, '', 2, '#ffffff', '/images/2013/12/04/a5fc0776272b268974f13e675c628e1d.jpg', 'jpg', 658709, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/434328a97522b2cd143e6e0edaf90b2f.jpg', 1386125304, 1386133270),
(212, '', '9613.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/c302e1b0943723395036cece4eb01260.jpg', 'jpg', 355892, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/8b2a3a07a8e13b451bdc5684e6bc2031.jpg', 1386125306, 1386125393),
(213, '', '9623.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/617ea9a5d9d26e702a01c3adbb6c2fa6.jpg', 'jpg', 366740, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/8c75a07a2d22b165fc990b1f40124822.jpg', 1386125307, 1386125385),
(214, '', '9699.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/a58b58087b2a878f89aa66c233cff74a.jpg', 'jpg', 677884, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/61aebb8c13f35fb1cf3bbda66f553989.jpg', 1386125308, 1386125372),
(215, '', '9996.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/918bc70a8e999d9f0d90be28b3e9c2b8.jpg', 'jpg', 233981, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/fa6bb838ca4b5b7bebeb39052bbd2c49.jpg', 1386125310, 1386125363),
(216, '', '10003.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/4a4df9943c984cb1d879d441b18594b2.jpg', 'jpg', 124643, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/767be9226aa0ca64307aefb934c3a63c.jpg', 1386125311, 1386125355),
(217, '', '10008.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/42a85d7c2708eebf3547ecee840d98c2.jpg', 'jpg', 235549, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/ddad65396150667f0cff0562d3757059.jpg', 1386125312, 1386125346),
(218, '', '10041.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/0ff765c5b204b7ad33bd0f121dd6bb2d.jpg', 'jpg', 620407, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/96fad934284622443d39ef4c898e2ca0.jpg', 1386125314, 1386125337),
(219, '', 'DSC_4638.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/fe211c66f0a02fc7bf9264d4d3c8b720.JPG', 'JPG', 9495559, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/3f90030d60b617ac9d5344040eb2fd22.JPG', 1386127010, 1386127010),
(220, '', 'DSC_4567.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/ac44a09cbea8f9c9138ccde3355ba273.JPG', 'JPG', 5248803, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/b3d08a60940cdc73eae8cdd43bce679a.JPG', 1386127172, 1386127172),
(221, '', 'DSC_4605.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/621b0dd84f7b35e3bc4c022ae7ef4c1f.JPG', 'JPG', 6335179, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/12f0c6b78625ac8d8fc41b7ecdc307c4.JPG', 1386127196, 1386127196),
(222, '', 'DSC_4574.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/f250fed56fcee5605ff3e43bcbf4ca8f.JPG', 'JPG', 4290728, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/3c4639217f28b4cc15efadd30738a3e7.JPG', 1386127210, 1386127210),
(225, '', 'DSC_4605.JPG', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/4ae61bf7690321a5e98d5f87c59557b4.JPG', 'JPG', 6335179, 3264, 4928, 'horizontal', '/images/2013/12/04/thumbs/fa4e2ee7914785312069442c1b337e42.JPG', 1386128297, 1386128310),
(226, '', 'DSC_4572.JPG', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/d61d528568671bcf4880f98b535e393a.JPG', 'JPG', 6038336, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/f99d7b9b8804ec1342c2abb2de2ebe8a.JPG', 1386128336, 1386128351),
(227, '', 'image.jpg', 'admin', NULL, '', NULL, '', 2, '', '/images/2013/12/04/d89401bf7480fd22dc109f7fb2ddbe02.jpg', 'jpg', 975317, 2448, 798, 'vertical', '/images/2013/12/04/thumbs/bd2184e267daf051a788849c779e4871.jpg', 1386128376, 1386128388),
(228, '', 'DSC_4587.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/1bc8156516ccfc5f50a7d847bda6bdea.JPG', 'JPG', 7205736, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/562fc80591e8662dcad30822ecdcf9fc.JPG', 1386128653, 1386128653),
(229, '', 'DSC_4572.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/3af7ad03da6912962fdfd9b9008f55be.JPG', 'JPG', 6038336, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/18c9233c9d78ea4c44ff888d23fa451a.JPG', 1386128761, 1386128761),
(230, '', 'DSC_4580.JPG', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/59842f4f9aff8552f2699274647ac7d9.JPG', 'JPG', 5195011, 4928, 3264, 'vertical', '/images/2013/12/04/thumbs/1b44315f9d36c56cfbac3dfc22c692f2.JPG', 1386128766, 1386128766),
(232, '', '10008.jpg', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/06e16fb041253ae3966d83791f098fa0.jpg', 'jpg', 235549, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/7bbacb24ff547a146a2179b7bef5954d.jpg', 1386139012, 1386139012),
(233, '', '10041.jpg', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/edbfdafa107b3014467db40dd9dea0ad.jpg', 'jpg', 620407, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/9fe768e449a1a863a340b5b47d163116.jpg', 1386139014, 1386139014),
(234, '', '9468.jpg', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/59b80d6bf442efb786de186ef8224723.jpg', 'jpg', 658709, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/72937d10bf7b229dcc425b8bf0fe5482.jpg', 1386139016, 1386139016),
(235, '', '9699.jpg', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/c4aa7c75555f2f28131a4304d85911d0.jpg', 'jpg', 677884, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/486df7a68f10f5f7a8162c2b1346e7dd.jpg', 1386139017, 1386139017),
(236, '', '9996.jpg', 'admin', NULL, NULL, NULL, '', 1, NULL, '/images/2013/12/04/9b12afb90e08c68c8d478d030d41ef43.jpg', 'jpg', 233981, 2560, 1440, 'vertical', '/images/2013/12/04/thumbs/99c1191aed7648211b375e4475f566b4.jpg', 1386139018, 1386139018);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
