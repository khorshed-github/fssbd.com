-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2018 at 02:42 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tearesort`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

CREATE TABLE IF NOT EXISTS `accomodation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facilities_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `sqm` float NOT NULL,
  `sqf` float NOT NULL,
  `guest` float NOT NULL,
  `bdt_rate` float NOT NULL,
  `usd_rate` float NOT NULL,
  `discount` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accomodation`
--

INSERT INTO `accomodation` (`id`, `facilities_id`, `title`, `description`, `sqm`, `sqf`, `guest`, `bdt_rate`, `usd_rate`, `discount`, `image`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 1, '2 Rooms Bungalow', 'A most modern concept, a combination of design, style, space and a peaceful faraway outlook of gardens, lake or swimming pool, the room is 382 sqft. in size featuring a 32" LCD TV with comprehensive cable TV channels. A large writing desk with an ergonomic chair and wi-fi access are welcome benefits for business and leisure travellers alike.', 0, 0, 6, 8000, 95, 20, '4472_2rooms.jpg', '1', '::1', '2018-06-27 07:35:10', 1),
(2, 1, '3 Rooms Bungalow', 'A most modern concept, a combination of design, style, space and a peaceful faraway outlook of gardens, lake or swimming pool, the room is 382 sqft. in size featuring a 32" LCD TV with comprehensive cable TV channels. A large writing desk with an ergonomic chair and wi-fi access are welcome benefits for business and leisure travellers alike.', 0, 1500, 8, 12000, 142, 20, '12369_3rooms.jpg', '1', '::1', '2018-06-27 07:38:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `class`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 'Rooms & Bungalow', 'rooms', '1', '::1', '2018-05-29 09:52:36', 1),
(2, 'Restaurant & cafe', 'restaurants', '1', '::1', '2018-05-29 09:52:55', 1),
(3, 'Upcoming Facilities', '', '1', '::1', '2018-05-29 09:44:44', 1),
(4, 'Others', 'others', '1', '::1', '2018-05-29 09:53:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `client_id` int(10) unsigned DEFAULT NULL,
  `adult_count` int(2) NOT NULL DEFAULT '0',
  `child_count` int(2) NOT NULL DEFAULT '0',
  `extra_guest_count` int(2) NOT NULL DEFAULT '0',
  `discount_coupon` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `total_cost` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `payment_success` tinyint(1) NOT NULL DEFAULT '0',
  `payment_txnid` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `paypal_email` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `special_id` int(10) unsigned NOT NULL DEFAULT '0',
  `special_requests` text CHARACTER SET latin1,
  `is_block` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `block_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ip` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `booking_time` (`discount_coupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_time`, `start_date`, `end_date`, `client_id`, `adult_count`, `child_count`, `extra_guest_count`, `discount_coupon`, `total_cost`, `payment_amount`, `payment_type`, `payment_success`, `payment_txnid`, `paypal_email`, `special_id`, `special_requests`, `is_block`, `is_deleted`, `block_name`, `ip`, `datetime`) VALUES
(4, '2018-06-04 02:58:34', '2018-06-05', '2018-06-06', 1, 4, 2, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-04 08:58:34'),
(5, '2018-06-04 03:03:46', '2018-06-05', '2018-06-08', 3, 4, 1, 0, '', 14490.00, 14997.15, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-04 10:25:04'),
(6, '2018-06-04 03:36:51', '2018-06-04', '2018-06-06', 2, 3, 3, 0, '', 9660.00, 9998.10, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-04 10:25:48'),
(7, '2018-06-04 04:22:16', '2018-06-06', '2018-06-07', 4, 2, 1, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-04 10:24:47'),
(8, '2018-06-05 12:18:58', '2018-06-05', '2018-06-07', 5, 4, 2, 0, '', 14490.00, 14997.15, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-05 06:18:59'),
(9, '2018-06-05 12:21:45', '2018-06-06', '2018-06-07', 6, 3, 1, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-05 06:21:45'),
(10, '2018-06-05 12:35:39', '2018-06-05', '2018-06-06', 0, 3, 2, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-05 06:35:39'),
(11, '2018-06-05 12:42:22', '2018-06-05', '2018-06-06', 0, 1, 0, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-05 06:42:22'),
(13, '2018-06-11 10:36:56', '2018-06-11', '2018-06-12', 1, 1, 1, 0, '', 4830.00, 4999.05, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-06-11 04:36:56'),
(14, '2018-07-10 11:29:28', '2018-07-10', '2018-07-12', 1, 4, 2, 0, '', 15456.00, 15996.96, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-07-10 05:29:28'),
(15, '2018-08-05 04:25:46', '2018-08-06', '2018-08-10', 1, 6, 1, 0, '', 46368.00, 47990.88, '', 0, '', '', 0, '', 0, 0, '', '::1', '2018-08-05 10:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `booking_search`
--

CREATE TABLE IF NOT EXISTS `booking_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adult_gest` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_type_title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `booking_search`
--

INSERT INTO `booking_search` (`id`, `adult_gest`, `room_type_id`, `room_type_title`, `status`) VALUES
(1, 1, 1, '2 Rooms Bungalow', 1),
(2, 2, 1, '2 Rooms Bungalow', 1),
(3, 3, 1, '2 Rooms Bungalow', 1),
(4, 4, 1, '2 Rooms Bungalow', 1),
(5, 5, 2, '3 Rooms Bungalow', 1),
(6, 6, 2, '3 Rooms Bungalow', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `surname` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `title` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `street_addr` text CHARACTER SET latin1,
  `city` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `province` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `zip` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `nid` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `additional_comments` text CHARACTER SET latin1,
  `ip` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `existing_client` tinyint(1) NOT NULL DEFAULT '0',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `surname`, `title`, `street_addr`, `city`, `province`, `zip`, `country`, `phone`, `nid`, `email`, `additional_comments`, `ip`, `existing_client`, `datetime`) VALUES
(1, 'khorshed', 'alam', 'Mr.', 'chittagong', 'chittagong', 'chittagong', '4007', 'Bangladesh', '1722371882', '524545585455', 'khorshedussl@gmail.com', 'No comments', '::1', 1, '2018-06-02 10:54:01'),
(2, 'Didarul', 'Alam', 'Mr.', 'chittagong', 'chittagong', 'Rangunia', '4360', 'Bangladesh', '01829663628', '98357349579812834', 'emdidar@gmail.com', 'No Requrest', '::1', 0, '2018-06-04 08:41:36'),
(3, 'khorshed', 'alam', 'Mr.', 'chittagong', 'chittagong', 'chittagong', '4007', 'Bangladesh', '1722371882', '564564565', 'example@gmail.com', 'dkfdfsd', '::1', 0, '2018-06-04 09:36:51'),
(4, 'Mezbah', 'Uddin', 'Mr.', 'Caxbazar, Bangladesh.', 'chittagong', 'chittagong', '4007', 'Bangladesh', '1722371882', '43645645654645', 'mezbah@gmail.com', 'No', '::1', 0, '2018-06-04 10:22:16'),
(5, 'Test', 'Purpose', '', 'ctg', 'ctg', 'ctg', '3243', 'Bangladesh', '01737376483', '', 'test@gmail.com', 'test', '::1', 0, '2018-06-09 09:09:50'),
(6, 'Another', 'Name', 'Mr.', 'chittagong', 'chittagong', 'chittagong', '4007', 'Bangladesh', '1722371882', '524545585455', 'another@gmail.com', 'dfd', '::1', 0, '2018-06-05 06:21:45'),
(7, 'sd', 'sd', '', 'sd', 'sdsa', 'sad', '564', 'fg', '65767453454', '', 'abc@gmail.com', '', '::1', 1, '2018-06-09 09:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  `identy` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `description`, `image`, `userid`, `ip`, `datetime`, `status`, `identy`) VALUES
(1, 'Rooms & Bungalow', 'A combination of design, space and a peaceful faraway outlook of tea garden, lake or swimming pool, There are 135 rooms of 08 categories consisting of both rooms and suites, ranging from King, Queen, Triple, Executive Suites, Family Suites and the exclusive Presidential Suite (Raj Prashad). The high speed Wi-Fi facilities in each of our guest rooms and in the Lobby area and the Business Center allow you to keep in touch with home and your office.', '6237_2rooms.jpg', '1', '::1', '2018-06-27 09:45:12', 1, 'room-suite'),
(2, 'Restaurant & Cafe', 'The Tea Resort & Museum is fitted with the most up to date hygienic kitchen maintained and operated by our highly trained team of Food and Beverage specialists. Our service staff are professionally trained and knowledgeable in the local area and aim to assist in making your stay pleasurable and an unforgettable experience.', '21330_dining-room.jpg', '1', '::1', '2018-05-27 05:05:10', 1, ''),
(3, 'Swimming Pool', 'Perhaps the amoeba shaped, temperature controlled swimming pool, the largest in Bangladesh, can soothe your tired mind and body after a long days adventure whilst your children enjoy the 2 smaller childrens pools.', '15503_swimingpool.jpg', '1', '::1', '2018-05-26 06:36:46', 1, ''),
(4, 'Indoor Sports', 'Pool, Game Centre, and Children Play Zone can present you the moment of eventful joy.', 'home-indoor-sports.jpg', '1', '::1', '2018-05-20 09:21:44', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `facilities_details`
--

CREATE TABLE IF NOT EXISTS `facilities_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facilities_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `facilities_details`
--

INSERT INTO `facilities_details` (`id`, `facilities_id`, `title`, `description`, `image`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 2, 'Fowara Dine', 'The elegant all day dining restaurant Fowara Dine provides a stunning atmosphere in which to sample European, Asian, Pan Asia. . .', '17142_fowara-dine.jpg', '1', '::1', '2018-05-24 07:02:38', 1),
(2, 2, 'Oronno Bilash', 'Experience our BBQ in the perfect ambiance against the backdrop of the green Tea gardens at our Hilltop Restaurant Oronno Bil. . .', '15778_oronnobilash.jpg', '1', '::1', '2018-05-26 05:57:09', 1),
(3, 3, 'Swimming Pool', 'Perhaps the amoeba shaped, temperature controlled swimming pool, the largest in Bangladesh, can soothe your tired mind and body after a long day~s adventure whilst your children enjoy the 2 smaller children~s pools.', '2844_swimingpool.jpg', '1', '::1', '2018-05-26 06:50:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facilities_slider`
--

CREATE TABLE IF NOT EXISTS `facilities_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facilities_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `facilities_slider`
--

INSERT INTO `facilities_slider` (`id`, `facilities_id`, `title`, `image`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 2, 'Restaurant & Cafe', '2183_resturant-cafe.jpg', '1', '::1', '2018-05-26 07:00:27', 1),
(2, 1, 'Rooms & Suites', '31994_room-suite.jpg', '1', '::1', '2018-05-26 06:57:55', 1),
(3, 3, 'Tea Resort & Museum Swimming pool', '29477_swimming-pool-slider.jpg', '1', '::1', '2018-05-26 06:55:12', 1),
(6, 2, 'Dining Room, Tea Resort & Museum', '3415_dining-room.jpg', '1', '::1', '2018-05-27 05:08:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class` varchar(50) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `aid`, `title`, `image`, `class`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 1, 'Rooms & Bungalow Images', '21523_rooms-bungalow.jpg', '', '1', '::1', '2018-05-29 09:10:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_events`
--

CREATE TABLE IF NOT EXISTS `meeting_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `meeting_events`
--

INSERT INTO `meeting_events` (`id`, `type`, `title`, `description`, `start_date`, `end_date`, `image`, `ip`, `userid`, `datetime`, `status`) VALUES
(1, 'meeting', 'Meetings & Events', 'Meetings & Events coming soon......', '2018-07-15', '2018-07-31', '28402_quest-dubbo-meeting-and-conference-room.jpg', '1', '::1', '2018-07-15 10:20:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_type` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `discount` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `offer_type`, `title`, `description`, `discount`, `start_date`, `end_date`, `image`, `sort_order`, `ip`, `userid`, `datetime`, `status`) VALUES
(1, 'Rainy Season Offer', 'Rainy Season Offer', '01 Jul to 30 Sep 2018 Discount Offers for all visitors.', 20, '2018-07-01', '2018-09-30', '23306_20Offer.jpg', 1, '::1', '1', '2018-06-30 04:22:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(10) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(10) DEFAULT NULL,
  `room_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `capacity_id` int(10) DEFAULT NULL,
  `no_of_child` int(11) NOT NULL DEFAULT '0',
  `extra_bed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`room_id`),
  KEY `roomtype_id` (`room_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_type_id`, `room_no`, `capacity_id`, `no_of_child`, `extra_bed`) VALUES
(30, 1, '30', 4, 2, 0),
(31, 1, '31', 4, 2, 0),
(32, 1, '32', 4, 2, 0),
(33, 1, '33', 4, 2, 0),
(34, 1, '34', 4, 2, 0),
(35, 1, '35', 4, 2, 0),
(36, 1, '36', 4, 2, 0),
(37, 1, '37', 4, 2, 0),
(38, 1, '38', 4, 2, 0),
(39, 1, '39', 4, 2, 0),
(40, 2, '40', 6, 2, 0),
(41, 2, '41', 6, 2, 0),
(42, 2, '42', 6, 2, 0),
(44, 2, '44', 6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`, `userid`, `ip`, `datetime`, `status`) VALUES
(1, 'Tea Resort Main Get', '29620_tearesort-get.jpg', '1', '::1', '2018-05-27 04:50:11', 1),
(2, 'Tea Resort Restaurant Inner Ground', '4416_home-banner2.jpg', '1', '::1', '2018-05-21 07:28:22', 1),
(3, 'Tea Resort & Banglo Tea Garden', '19421_teagarden-teresort.jpg', '1', '::1', '2018-05-27 04:59:42', 1),
(4, 'Tea Resort Entry Get', '9339_entry-get-1.jpg', '1', '::1', '2018-05-26 04:57:49', 1),
(5, 'Tea Resort Entry Get-2', '12952_entry-get-2.jpg', '1', '::1', '2018-05-26 04:58:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_pic` varchar(250) NOT NULL,
  `user_dob` date NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `datetime` date NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `mobile`, `password`, `name`, `email`, `user_pic`, `user_dob`, `user_type`, `ip`, `datetime`, `status`) VALUES
(1, '01915357699', '202cb962ac59075b964b07152d234b70', 'Md. Samsuddoha', 'abc@gmail.com', '31255_man-icon.png', '2018-07-01', 'superadmin', '::1', '2018-07-01', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
