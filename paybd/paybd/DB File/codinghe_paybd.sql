-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for codinghe_paybd
CREATE DATABASE IF NOT EXISTS `codinghe_paybd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `codinghe_paybd`;


-- Dumping structure for table codinghe_paybd.tbabout
DROP TABLE IF EXISTS `tbabout`;
CREATE TABLE IF NOT EXISTS `tbabout` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='select autoId,description from tbAbout';

-- Dumping data for table codinghe_paybd.tbabout: ~0 rows (approximately)
DELETE FROM `tbabout`;
/*!40000 ALTER TABLE `tbabout` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbabout` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbcompanyinfo
DROP TABLE IF EXISTS `tbcompanyinfo`;
CREATE TABLE IF NOT EXISTS `tbcompanyinfo` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `mobile` varchar(150) NOT NULL DEFAULT '',
  `officeAddress` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='select companyName,email,mobile,officeAddress from tbCompanyInfo';

-- Dumping data for table codinghe_paybd.tbcompanyinfo: ~0 rows (approximately)
DELETE FROM `tbcompanyinfo`;
/*!40000 ALTER TABLE `tbcompanyinfo` DISABLE KEYS */;
INSERT INTO `tbcompanyinfo` (`autoId`, `companyName`, `email`, `mobile`, `officeAddress`) VALUES
	(1, 'Best Pay BD', 'info@bestpaybd.com', '+8801829663628', 'Noapara, Raozan, Chittagong, Post Code: 4346');
/*!40000 ALTER TABLE `tbcompanyinfo` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbcurrencyinfo
DROP TABLE IF EXISTS `tbcurrencyinfo`;
CREATE TABLE IF NOT EXISTS `tbcurrencyinfo` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `vCurrencyName` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='select autoId, vCurrencyName, image from tbcurrencyinfo';

-- Dumping data for table codinghe_paybd.tbcurrencyinfo: ~17 rows (approximately)
DELETE FROM `tbcurrencyinfo`;
/*!40000 ALTER TABLE `tbcurrencyinfo` DISABLE KEYS */;
INSERT INTO `tbcurrencyinfo` (`autoId`, `vCurrencyName`, `image`) VALUES
	(4, 'bKash Agent', 'upload/83f7433345.png'),
	(5, 'bKash Personal BDT', 'upload/ec61b56943.png'),
	(6, 'Coinbase BCH USD', 'upload/52adb95b71.png'),
	(7, 'Coinbase BTC USD', 'upload/e7949d9c60.png'),
	(8, 'Coinbase ETH USD', 'upload/7aa6f8df47.png'),
	(9, 'Coinbase LTC USD', 'upload/f0bd043886.png'),
	(10, 'DBBL Bank BDT', 'upload/a251ae021a.png'),
	(11, 'Neteller USD', 'upload/1fd43b2c9a.png'),
	(12, 'Payeer USD', 'upload/3b6ef7ebb2.png'),
	(13, 'Payoneer USD', 'upload/e19bc5ed71.png'),
	(14, 'PayPal USD', 'upload/778a63c2db.png'),
	(15, 'Payza USD', 'upload/206565848d.png'),
	(16, 'PerfectMoney USD', 'upload/cf9600cc2b.png'),
	(17, 'Skrill USD', 'upload/c84abc7f3f.png'),
	(18, 'Web Money USD', 'upload/fce7900146.png'),
	(19, 'Rocket Agent BDT', 'upload/c45941f370.png'),
	(20, 'Rocket Personal BDT', 'upload/9f72355951.png');
/*!40000 ALTER TABLE `tbcurrencyinfo` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbcurrencyiteminfo
DROP TABLE IF EXISTS `tbcurrencyiteminfo`;
CREATE TABLE IF NOT EXISTS `tbcurrencyiteminfo` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `vType` varchar(50) DEFAULT NULL,
  `iCurrencyIdFrom` int(11) DEFAULT NULL,
  `dblAmountFrom` double DEFAULT NULL,
  `iCurrencyIdTo` int(11) DEFAULT NULL,
  `dblAmountTo` double DEFAULT NULL,
  `dblCharge` double DEFAULT NULL,
  PRIMARY KEY (`autoId`),
  KEY `FK_tbcurrencyiteminfo_tbcurrencyinfo` (`iCurrencyIdFrom`),
  KEY `FK_tbcurrencyiteminfo_tbcurrencyinfo_2` (`iCurrencyIdTo`),
  CONSTRAINT `FK_tbcurrencyiteminfo_tbcurrencyinfo` FOREIGN KEY (`iCurrencyIdFrom`) REFERENCES `tbcurrencyinfo` (`autoId`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_tbcurrencyiteminfo_tbcurrencyinfo_2` FOREIGN KEY (`iCurrencyIdTo`) REFERENCES `tbcurrencyinfo` (`autoId`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='select autoId, vType, iCurrencyIdFrom, dblAmountFrom, iCurrencyIdTo, dblAmountTo, dblCharge from tbcurrencyiteminfo';

-- Dumping data for table codinghe_paybd.tbcurrencyiteminfo: ~13 rows (approximately)
DELETE FROM `tbcurrencyiteminfo`;
/*!40000 ALTER TABLE `tbcurrencyiteminfo` DISABLE KEYS */;
INSERT INTO `tbcurrencyiteminfo` (`autoId`, `vType`, `iCurrencyIdFrom`, `dblAmountFrom`, `iCurrencyIdTo`, `dblAmountTo`, `dblCharge`) VALUES
	(8, 'Sell', 4, 1, 4, 1, 1),
	(9, 'Sell', 4, 97, 17, 1, 0),
	(10, 'Sell', 4, 97, 11, 1, 0),
	(11, 'Sell', 4, 90, 16, 1, 0),
	(12, 'Sell', 4, 88, 12, 1, 0),
	(13, 'Sell', 4, 85, 15, 1, 0),
	(14, 'Sell', 4, 88, 18, 1, 0),
	(15, 'Sell', 4, 86, 14, 1, 0),
	(16, 'Sell', 4, 92, 7, 1, 0),
	(17, 'Sell', 4, 92, 8, 1, 0),
	(18, 'Sell', 4, 92, 9, 1, 0),
	(19, 'Sell', 4, 92, 6, 1, 0),
	(20, 'Sell', 4, 90, 13, 1, 0);
/*!40000 ALTER TABLE `tbcurrencyiteminfo` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbcurrencyreserve
DROP TABLE IF EXISTS `tbcurrencyreserve`;
CREATE TABLE IF NOT EXISTS `tbcurrencyreserve` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `iCurrencyId` int(11) DEFAULT '0',
  `dblAmount` double DEFAULT '0',
  PRIMARY KEY (`autoId`),
  KEY `FK__tbcurrencyinfo` (`iCurrencyId`),
  CONSTRAINT `FK__tbcurrencyinfo` FOREIGN KEY (`iCurrencyId`) REFERENCES `tbcurrencyinfo` (`autoId`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table codinghe_paybd.tbcurrencyreserve: ~0 rows (approximately)
DELETE FROM `tbcurrencyreserve`;
/*!40000 ALTER TABLE `tbcurrencyreserve` DISABLE KEYS */;
INSERT INTO `tbcurrencyreserve` (`autoId`, `iCurrencyId`, `dblAmount`) VALUES
	(1, 4, 10000),
	(2, 5, 4000),
	(3, 11, 900),
	(4, 17, 1000),
	(5, 19, 5000),
	(6, 6, 0),
	(7, 7, 0),
	(8, 9, 0),
	(9, 12, 40),
	(10, 13, 80),
	(11, 14, 100),
	(12, 15, 0),
	(13, 16, 0),
	(14, 18, 0),
	(15, 20, 0),
	(16, 10, 0);
/*!40000 ALTER TABLE `tbcurrencyreserve` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbinbox
DROP TABLE IF EXISTS `tbinbox`;
CREATE TABLE IF NOT EXISTS `tbinbox` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='select autoId, name, email, subject, message from tbinbox';

-- Dumping data for table codinghe_paybd.tbinbox: ~0 rows (approximately)
DELETE FROM `tbinbox`;
/*!40000 ALTER TABLE `tbinbox` DISABLE KEYS */;
INSERT INTO `tbinbox` (`autoId`, `name`, `email`, `subject`, `message`) VALUES
	(1, 'Didarul Alam', 'emdidar@gmail.com', 'Test Message', 'This is Test Message');
/*!40000 ALTER TABLE `tbinbox` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbl_admin
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `adminName` varchar(32) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='select adminId, adminUser, adminPass, adminName from tbl_admin';

-- Dumping data for table codinghe_paybd.tbl_admin: 1 rows
DELETE FROM `tbl_admin`;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`adminId`, `adminUser`, `adminPass`, `adminName`) VALUES
	(3, 'admin', '202cb962ac59075b964b07152d234b70', 'Didarul Alam');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbnoticeinfo
DROP TABLE IF EXISTS `tbnoticeinfo`;
CREATE TABLE IF NOT EXISTS `tbnoticeinfo` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `noticeName` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='select autoId,noticeName from tbnoticeinfo';

-- Dumping data for table codinghe_paybd.tbnoticeinfo: ~0 rows (approximately)
DELETE FROM `tbnoticeinfo`;
/*!40000 ALTER TABLE `tbnoticeinfo` DISABLE KEYS */;
INSERT INTO `tbnoticeinfo` (`autoId`, `noticeName`) VALUES
	(1, 'Hello');
/*!40000 ALTER TABLE `tbnoticeinfo` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbsestimonials
DROP TABLE IF EXISTS `tbsestimonials`;
CREATE TABLE IF NOT EXISTS `tbsestimonials` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `comment` varchar(350) CHARACTER SET utf8 NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='select autoId,userId,comment,image from tbSestimonials';

-- Dumping data for table codinghe_paybd.tbsestimonials: ~3 rows (approximately)
DELETE FROM `tbsestimonials`;
/*!40000 ALTER TABLE `tbsestimonials` DISABLE KEYS */;
INSERT INTO `tbsestimonials` (`autoId`, `userId`, `comment`, `image`) VALUES
	(1, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate ', 'female.jpg'),
	(2, 2, '100% ট্রাস্টেড সাইট। তবে রেট একটু কমালে ভাল হয়। আর ফোন নাম্বার এর ইউজ না থাকলে ভাল হয়, শুধু ইমেলই যথেষ্ট বলে আমার ধারণা।', 'female.jpg'),
	(3, 3, 'Could I... BE any more happy with this company?', 'female.jpg');
/*!40000 ALTER TABLE `tbsestimonials` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbsocialinfo
DROP TABLE IF EXISTS `tbsocialinfo`;
CREATE TABLE IF NOT EXISTS `tbsocialinfo` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `youtube` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `twiter` varchar(150) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='select youtube,facebook,twiter,instagram from tbSocialInfo';

-- Dumping data for table codinghe_paybd.tbsocialinfo: ~0 rows (approximately)
DELETE FROM `tbsocialinfo`;
/*!40000 ALTER TABLE `tbsocialinfo` DISABLE KEYS */;
INSERT INTO `tbsocialinfo` (`autoId`, `youtube`, `facebook`, `twiter`, `instagram`) VALUES
	(1, 'http://www.youtube.com/emdidar', 'http://www.facebook.com/emdidar', 'http://www.twitter.com/emdidar', 'http://www.instagram.com/emdidar');
/*!40000 ALTER TABLE `tbsocialinfo` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbtestimonial
DROP TABLE IF EXISTS `tbtestimonial`;
CREATE TABLE IF NOT EXISTS `tbtestimonial` (
  `autoId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `comment` varchar(350) CHARACTER SET utf8 NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='select autoId,userId,comment,image from tbTestimonial';

-- Dumping data for table codinghe_paybd.tbtestimonial: ~3 rows (approximately)
DELETE FROM `tbtestimonial`;
/*!40000 ALTER TABLE `tbtestimonial` DISABLE KEYS */;
INSERT INTO `tbtestimonial` (`autoId`, `userId`, `comment`, `image`) VALUES
	(1, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. \r\n	Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, \r\n	pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, \r\n	v', 'female.jpg'),
	(2, 2, '100% ট্রাস্টেড সাইট। তবে রেট একটু কমালে ভাল হয়। আর ফোন নাম্বার এর ইউজ না থাকলে ভাল হয়, শুধু ইমেলই যথেষ্ট বলে আমার ধারণা।', 'female.jpg'),
	(3, 3, 'Could I... BE any more happy with this company?', 'female.jpg');
/*!40000 ALTER TABLE `tbtestimonial` ENABLE KEYS */;


-- Dumping structure for table codinghe_paybd.tbuserinfo
DROP TABLE IF EXISTS `tbuserinfo`;
CREATE TABLE IF NOT EXISTS `tbuserinfo` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT '0.jpg',
  `phone` varchar(100) DEFAULT NULL,
  `verification` varchar(100) DEFAULT 'no',
  `verificationId` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'active',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='select userId,userName,email,password,firstName,lastName,mobile,location,image,phone,verification,verificationId,status from tbuserinfo ';

-- Dumping data for table codinghe_paybd.tbuserinfo: ~2 rows (approximately)
DELETE FROM `tbuserinfo`;
/*!40000 ALTER TABLE `tbuserinfo` DISABLE KEYS */;
INSERT INTO `tbuserinfo` (`userId`, `userName`, `email`, `password`, `firstName`, `lastName`, `mobile`, `location`, `image`, `phone`, `verification`, `verificationId`, `status`) VALUES
	(1, 'emdidar', 'emdidar@gmail.com', '202cb962ac59075b964b07152d234b70', 'Didarul', 'Alam', '01829663628', 'Chittagong', '1.jpg', NULL, 'no', NULL, 'active'),
	(2, 'admin', 'abc@gmail.com', '202cb962ac59075b964b07152d234b70', 'Abc', 'Def', '123', NULL, '0.jpg', NULL, 'no', NULL, 'active');
/*!40000 ALTER TABLE `tbuserinfo` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
