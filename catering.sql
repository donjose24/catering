-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2015 at 01:26 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE IF NOT EXISTS `additional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `package` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`id`, `menu_id`, `reservation_id`, `package`, `quantity`, `category`) VALUES
(5, 80, 'ID-FD63THBQ', 0, 1, 1),
(7, 2, 'ID-FD63THBQ', 0, 1, 2),
(8, 80, 'ID-5D2DGIRH', 0, 1, 1),
(9, 2, 'ID-5D2DGIRH', 0, 1, 2),
(10, 82, 'ID-VEISHVAM', 0, 5, 1),
(11, 80, 'ID-VEISHVAM', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `employee_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agents_employee_number_unique` (`employee_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `first_name`, `last_name`, `employee_number`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Agent Karol', 'Karol Agent', '1203901239', 'Note on this\r\n', '2015-02-06 15:51:54', '2015-02-06 15:51:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brokens`
--

CREATE TABLE IF NOT EXISTS `brokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `reservation_id` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `brokens`
--

INSERT INTO `brokens` (`id`, `menu_id`, `reservation_id`, `quantity`) VALUES
(3, 1, 'ID-VEISHVAM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `img`, `created_at`) VALUES
(1, '', 'I_have_no_idea_what_9buz.jpg', '2015-02-28 03:14:54'),
(3, '', 'adobo.jpg', '2015-02-28 03:33:12'),
(4, '', '984106_10203852639657871_6471109802128370439_n.jpg', '2015-02-28 03:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'fish', '2015-02-02 14:20:07', '2015-02-02 14:20:07'),
(5, 'chicken', '2015-02-02 14:20:13', '2015-02-02 14:20:13'),
(6, 'salad', '2015-02-02 14:20:19', '2015-02-02 14:20:19'),
(7, 'soup', '2015-02-02 14:20:24', '2015-02-02 14:20:24'),
(8, 'Beef', '2015-02-21 18:06:50', '2015-02-21 18:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_num` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `alt_tel_num` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_num` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `customer_name`, `company_name`, `street_address`, `city`, `state`, `zip_code`, `country`, `tel_num`, `alt_tel_num`, `fax_num`, `email`, `contact_person`, `designation`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Karol Client', 'ThinkSteep', '', '', '', '', 'Philippines', '091203801239', '', '', '', '', '', '', '2015-02-06 15:50:38', '2015-02-06 15:50:38', NULL),
(2, 'Breezy Client', 'ThinkBit', 'Quezyon', 'City', 'State', '1700', NULL, '091029309123', NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-21 18:49:51', '2015-02-21 18:49:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` int(10) unsigned NOT NULL,
  `cr_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `check_number` int(11) NOT NULL,
  `bank_deposit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` enum('PDC','Cash','CC','Bank Transfer') COLLATE utf8_unicode_ci NOT NULL,
  `collected_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `collections_cr_id_unique` (`cr_id`),
  KEY `collections_quotation_id_foreign` (`quotation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `quotation_id`, `cr_id`, `amount`, `check_number`, `bank_deposit`, `bank_name`, `payment_type`, `collected_by`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '123123', 200000, 0, '', '', 'PDC', 'Renzki', '2015-02-06', '2015-02-06 17:13:02', '2015-02-06 17:13:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `title`, `description`, `updated_at`, `created_at`) VALUES
(3, 'Renz', 'Renz', 'Masyadong pogi sobrang nakakaakit', '2015-02-21 06:03:00', '2015-02-21 06:03:00'),
(4, 'Renz', 'Thank You', 'for the joy and thank you for the glow', '2015-02-21 18:07:54', '2015-02-21 18:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` int(10) unsigned NOT NULL,
  `reference_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `delivered_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `deliveries_reference_number_unique` (`reference_number`),
  KEY `deliveries_quotation_id_foreign` (`quotation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `quotation_id`, `reference_number`, `delivery_date`, `delivered_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '12312311s123901', '2015-02-06', 'BMI', '2015-02-06 17:08:52', '2015-02-06 17:08:52', NULL),
(2, 4, '123124123', '2015-02-21', '12124123123', '2015-02-21 19:24:59', '2015-02-21 19:24:59', NULL),
(3, 4, '124123', '2015-02-21', '125123123', '2015-02-21 19:25:09', '2015-02-21 19:25:09', NULL),
(4, 4, '15176125123123', '2015-02-21', '161615123', '2015-02-21 19:26:33', '2015-02-21 19:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_item`
--

CREATE TABLE IF NOT EXISTS `delivery_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delivery_item_delivery_id_foreign` (`delivery_id`),
  KEY `delivery_item_item_id_foreign` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `delivery_item`
--

INSERT INTO `delivery_item` (`id`, `delivery_id`, `item_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 4, 2, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `keyname`, `value`, `created_at`, `deleted_at`, `updated_at`, `type`) VALUES
(1, 'name', 'Rey and Chris', '2015-09-08 15:02:31', '2015-09-08 15:02:31', '2015-09-09 00:56:10', 'primary'),
(2, 'address', '933B M.Dela fuente St. Sampaloc Manila', '2015-09-08 15:03:09', '2015-09-08 15:03:09', '2015-09-08 15:03:09', 'contact'),
(3, 'phonenumber', '024313313', '2015-09-08 15:03:31', '2015-09-08 15:03:31', '2015-09-08 15:03:31', 'contact'),
(4, 'mobile', '09056057553', '2015-09-08 15:03:42', '2015-09-08 15:03:42', '2015-09-08 15:03:42', 'contact'),
(5, 'email', 'xnalimits@gmail.com', '2015-09-08 15:04:32', '2015-09-08 15:04:32', '2015-09-08 16:24:21', 'contact'),
(6, 'logo', 'http://localhost:8000/carousel/I_have_no_idea_what_9buz.jpg', '2015-09-08 15:05:05', '2015-09-08 15:05:05', '2015-09-08 15:05:05', 'logo'),
(7, 'twitter', 'twitter.com/test', '2015-09-08 15:05:23', '2015-09-08 15:05:23', '2015-09-08 15:05:23', 'link'),
(8, 'facebook', 'facebook.com/hubbykosiapple', '2015-09-08 15:05:57', '2015-09-08 15:05:57', '2015-09-08 15:05:57', 'link'),
(9, 'googleplus', 'google.com/', '2015-09-08 15:05:57', '2015-09-08 15:05:57', '2015-09-08 15:05:57', 'link');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dimensions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `average_price` double(15,2) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `allocated_quantity` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL,
  `itemtype_id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `uom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_itemtype_id_foreign` (`itemtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `model_number`, `description`, `dimensions`, `average_price`, `total_quantity`, `allocated_quantity`, `alert_quantity`, `itemtype_id`, `image`, `created_at`, `updated_at`, `deleted_at`, `uom`) VALUES
(1, '109123-T', 'Table na bibilin ko bukas Yappie :D', '100x2010', 1500.00, 8, 9, 50, 1, '', '2015-02-06 15:54:57', '2015-05-10 16:35:27', NULL, 'pcs'),
(2, 'TABLE-BLACK', 'A Black not so racist table', '1000x1000', 1000.00, -97, 0, 10, 2, '', '2015-02-21 17:54:50', '2015-03-17 15:54:12', NULL, 'pcs'),
(3, 'Llala', 'SLOWLY DRIFTING', '2000x123', 27000.00, 0, 0, 50, 2, 'banana-pudding-parfaits-1.jpg', '2015-02-28 13:43:15', '2015-03-14 14:42:32', NULL, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE IF NOT EXISTS `itemtypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Renz', 'Item Category Renz', '2015-02-06 15:54:03', '2015-02-06 15:54:03', NULL),
(2, 'Hard Wooden Table', 'A table that is made from wood', '2015-02-21 17:52:36', '2015-02-21 17:52:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_purchase`
--

CREATE TABLE IF NOT EXISTS `item_purchase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivered_quantity` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `line_total` double(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_purchase_purchase_id_foreign` (`purchase_id`),
  KEY `item_purchase_item_id_foreign` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `item_purchase`
--

INSERT INTO `item_purchase` (`id`, `purchase_id`, `item_id`, `quantity`, `delivered_quantity`, `price`, `line_total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 10, 10, 1500.00, 15000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 3, 2, 10, 2, 1000.00, 10000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 3, 1, 5, 2, 1500.00, 7500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 5, 1, 1, 0, 1500.00, 1500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(6, 1, 1, 1, 1, 1500.00, 1500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, 6, 1, 1, 0, 1500.00, 1500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 7, 2, 1, 0, 1000.00, 1000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(9, 10, 1, 1, 0, 1500.00, 1500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_quotation`
--

CREATE TABLE IF NOT EXISTS `item_quotation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivered_quantity` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `line_discount` double NOT NULL,
  `sub_total` double NOT NULL,
  `line_total` double(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_quotation_quotation_id_foreign` (`quotation_id`),
  KEY `item_quotation_item_id_foreign` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item_quotation`
--

INSERT INTO `item_quotation` (`id`, `quotation_id`, `item_id`, `quantity`, `delivered_quantity`, `price`, `line_discount`, `sub_total`, `line_total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 5, 5, 1500.00, 0, 7500, 7500.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 4, 2, 100, 100, 1000.00, 0, 100000, 100000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 4, 1, 1, 1, 1500.00, 500, 1500, 1000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 4, 1, 10, 1, 1500.00, 500, 15000, 10000.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_receiving`
--

CREATE TABLE IF NOT EXISTS `item_receiving` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receiving_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_receiving_receiving_id_foreign` (`receiving_id`),
  KEY `item_receiving_item_id_foreign` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item_receiving`
--

INSERT INTO `item_receiving` (`id`, `receiving_id`, `item_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 2, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 3, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 3, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_reservation`
--

CREATE TABLE IF NOT EXISTS `item_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_warehouse`
--

CREATE TABLE IF NOT EXISTS `item_warehouse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `warehouse_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_warehouse_warehouse_id_foreign` (`warehouse_id`),
  KEY `item_warehouse_item_id_foreign` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE IF NOT EXISTS `maintenances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`id`, `name`, `type`, `value`, `updated_at`) VALUES
(1, 'pax', 'min', 20, '2015-02-21 18:09:50'),
(2, 'pax', 'max', 100, '2015-02-28 06:40:11'),
(3, 'cancellation fee', 'fee', 5000, '2015-02-21 20:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mcat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `mcat`, `scat`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(80, 'lunch_only', 'chicken', 'adobo', 'connection', 123, '994466_975239719155453_6621773160734691558_n.jpg', '2015-02-21 10:11:56', '2015-02-21 18:11:56', '0000-00-00 00:00:00'),
(81, 'lunch_only', 'chicken', 'samting', 'samting', 200, 'banana-pudding-parfaits-1.jpg', '2015-02-28 00:04:30', '2015-02-28 08:04:30', '0000-00-00 00:00:00'),
(82, 'dinner_only', 'salad', 'Banana Parfait', 'A delicious smoothy that comes within the bottom of \r\nBikini Bottom with Spongebob and friends.', 2500, 'banana-pudding-parfaits-1.jpg', '2015-02-28 00:04:35', '2015-02-28 08:04:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_package`
--

CREATE TABLE IF NOT EXISTS `menu_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_reservation`
--

CREATE TABLE IF NOT EXISTS `menu_reservation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `reservation_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_reservation_menu_id_foreign` (`menu_id`),
  KEY `menu_reservation_reservation_id_foreign` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `menu_reservation`
--

INSERT INTO `menu_reservation` (`id`, `menu_id`, `reservation_id`, `day`, `package`) VALUES
(10, 81, 'ID-E0OMOMRL', '1', 0),
(11, 80, 'ID-TCLM730H', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_reservation_id_foreign` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_06_04_130257_create_users_table', 1),
('2014_06_25_083117_create_clients_table', 1),
('2014_06_25_083118_create_quotations_table', 1),
('2014_06_25_083348_create_deliveries_table', 1),
('2014_06_25_083944_create_item_types_table', 1),
('2014_06_25_083945_create_items_table', 1),
('2014_06_25_083946_create_item_quotation_table', 1),
('2014_06_25_083947_create_delivery_item_table', 1),
('2014_07_01_070016_add_uom_to_items_table', 1),
('2014_07_02_142036_remove_unique_from_quotation', 1),
('2014_07_05_131528_add_pendingapproval_status', 1),
('2014_07_07_055302_create_warehouses_table', 1),
('2014_07_07_055432_create_item_warehouse_table', 1),
('2014_07_07_055558_add_allocated_and_delivered_field', 1),
('2014_07_07_055948_create_collections_table', 1),
('2014_07_10_091254_create_agents_table', 1),
('2014_07_10_091818_line_discounts_and_quotation_table_update', 1),
('2014_07_16_110424_drop_unique_from_company_name', 1),
('2015_01_12_231527_create_suppliers_table', 1),
('2015_01_12_232240_create_purchases_table', 1),
('2015_01_13_015711_add_fields_to_collections_table', 1),
('2015_01_13_020918_add_fields_to_quotations_table', 1),
('2015_01_19_230116_create_receivings_table', 1),
('2015_01_19_230206_create_item_purchase_table', 1),
('2015_01_19_230247_create_item_receiving_table', 1),
('2015_01_20_015957_remove_unique_from_purchases', 1),
('2015_01_20_025655_add_pendingapproval_status_to_purchases_table', 1),
('2015_01_20_193151_add_column_delivered_quantity', 1),
('2015_01_20_230619_create_payment_table', 1),
('2015_01_23_080223_create_menu_table', 1),
('2015_01_23_202207_create_reservation_table', 1),
('2015_01_24_074348_create_menu_reservation_table', 1),
('2015_01_24_101820_add_column_to_reservation_table', 2),
('2015_02_03_205054_create_message_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Fuckage', 'Me so Hey', 1500, '2015-02-21 04:34:27', '2015-02-21 04:34:27'),
(2, 'fucking fuckage', 'a good for 100 chichirya', 2500, '2015-02-21 19:46:55', '2015-02-21 19:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(10) unsigned NOT NULL,
  `payment_receipt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `collected_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_payment_receipt_unique` (`payment_receipt`),
  KEY `payments_purchase_id_foreign` (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `purchase_id`, `payment_receipt`, `amount`, `collected_by`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '1239812938', 2000000, '981923819238', '2015-02-06', '2015-02-06 17:04:06', '2015-02-06 17:04:06', NULL),
(2, 3, '987129387561065016', 2500, 'Renz', '2015-02-21', '2015-02-21 18:43:33', '2015-02-21 18:43:33', NULL),
(3, 3, '901920391', 500, 'RENZ', '2015-02-21', '2015-02-21 18:47:19', '2015-02-21 18:47:19', NULL),
(4, 5, '123123123', 123123123123, '123', '2015-02-28', '2015-02-28 18:15:52', '2015-02-28 18:15:52', NULL),
(5, 1, '89898', 2000, '45454', '2015-04-18', '2015-04-18 13:13:20', '2015-04-18 13:13:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `po_number` int(10) unsigned NOT NULL,
  `si_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `terms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` double(15,2) NOT NULL,
  `discount` double(15,2) NOT NULL,
  `grand_total` double(15,2) NOT NULL,
  `net_total` double(15,2) NOT NULL,
  `prepared_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_status` enum('Draft','PendingApproval','Approved','SalesOrder','Downpayment','FullPayment') COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_status` enum('NotDelivered','PartiallyDelivered','CompletelyDelivered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NotDelivered',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchases_po_number_unique` (`po_number`),
  KEY `purchases_supplier_id_foreign` (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `po_number`, `si_number`, `supplier_id`, `date`, `terms`, `tax`, `discount`, `grand_total`, `net_total`, `prepared_by`, `approved_by`, `billing_status`, `delivery_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12919, '790', 1, '2015-01-24', '10', 12.00, 0.00, 1500.00, 1500.00, 'test', '', 'FullPayment', 'CompletelyDelivered', '2015-01-25 04:51:04', '2015-04-18 13:13:20', NULL),
(2, 12319238, '1293-12390', 1, '2015-02-06', '0', 12.00, 0.00, 15000.00, 15000.00, 'test', '', 'FullPayment', 'CompletelyDelivered', '2015-02-06 16:51:56', '2015-02-06 17:04:06', NULL),
(3, 98910912, '012938019', 1, '2015-02-21', '0', 12.00, 0.00, 17500.00, 17500.00, 'test', '', 'Downpayment', 'PartiallyDelivered', '2015-02-21 18:19:44', '2015-02-21 18:43:33', NULL),
(4, 1023901293, '', 1, '2015-02-21', '10', 12.00, 10.00, 0.00, 0.00, 'test', '', 'Draft', 'NotDelivered', '2015-02-21 18:23:04', '2015-02-21 18:34:40', '2015-02-21 18:34:40'),
(5, 123, '123123', 1, '2015-02-21', '0', 12.00, 0.00, 1500.00, 1500.00, 'test', '', 'FullPayment', 'NotDelivered', '2015-02-21 18:30:15', '2015-02-28 18:15:52', NULL),
(6, 1241, '', 1, '2015-03-14', '0', 12.00, 0.00, 1500.00, 1500.00, 'test', '', 'Draft', 'NotDelivered', '2015-03-14 11:33:11', '2015-04-18 13:12:33', NULL),
(7, 12415, '', 1, '2015-03-14', '0', 12.00, 0.00, 1000.00, 1000.00, 'test', '', 'PendingApproval', 'NotDelivered', '2015-03-14 11:34:12', '2015-04-18 13:12:20', NULL),
(9, 1429339312, '', 1, '2015-04-18', '0', 12.00, 0.00, 0.00, 0.00, 'test', '', 'Draft', 'NotDelivered', '2015-04-18 13:41:52', '2015-04-18 13:41:52', NULL),
(10, 10, '', 2, '2015-04-18', '0', 12.00, 0.00, 1500.00, 1500.00, 'test', '', 'PendingApproval', 'NotDelivered', '2015-04-18 13:43:04', '2015-04-18 13:51:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE IF NOT EXISTS `quotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_date` date NOT NULL,
  `si_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `si_date` date NOT NULL,
  `date` date NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `agent_id` int(10) unsigned NOT NULL,
  `terms` double(15,2) NOT NULL,
  `tax` double(15,2) NOT NULL,
  `discount` double(15,2) NOT NULL,
  `grand_total` double(15,2) NOT NULL,
  `net_total` double(15,2) NOT NULL,
  `prepared_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_status` enum('Draft','PendingApproval','Approved','SalesOrder','Downpayment','FullPayment') COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_status` enum('NotDelivered','PartiallyDelivered','CompletelyDelivered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NotDelivered',
  `installation_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quotations_quotation_number_unique` (`quotation_number`),
  KEY `quotations_client_id_foreign` (`client_id`),
  KEY `quotations_agent_id_foreign` (`agent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `quotation_number`, `so_number`, `so_date`, `si_number`, `si_date`, `date`, `client_id`, `agent_id`, `terms`, `tax`, `discount`, `grand_total`, `net_total`, `prepared_by`, `approved_by`, `billing_status`, `delivery_status`, `installation_status`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1293819238', '1293812938', '0000-00-00', '120391203i123', '0000-00-00', '2015-02-06', 1, 1, 0.00, 12.00, 0.00, 7500.00, 7500.00, 'test', '', 'SalesOrder', 'CompletelyDelivered', '', '', '2015-02-06 17:05:31', '2015-02-06 17:13:25', NULL),
(2, '123', '', '0000-00-00', '', '0000-00-00', '2015-02-21', 2, 1, 0.00, 12.00, 0.00, 0.00, 0.00, 'test', '', 'PendingApproval', 'NotDelivered', '', '', '2015-02-21 19:13:33', '2015-02-21 19:19:47', NULL),
(3, '123123', '', '0000-00-00', '', '0000-00-00', '2015-02-21', 1, 1, 0.00, 12.00, 0.00, 0.00, 0.00, 'test', '', 'Draft', 'NotDelivered', '', '', '2015-02-21 19:17:10', '2015-02-21 19:17:10', NULL),
(4, '01293012930851', '95345345345', '0000-00-00', '', '0000-00-00', '2015-02-21', 1, 1, 0.00, 12.00, 0.00, 111000.00, 111000.00, 'test', '', 'SalesOrder', 'PartiallyDelivered', '', '', '2015-02-21 19:17:55', '2015-02-21 19:24:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receivings`
--

CREATE TABLE IF NOT EXISTS `receivings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `received_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `receivings_reference_number_unique` (`reference_number`),
  KEY `receivings_purchase_id_foreign` (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `receivings`
--

INSERT INTO `receivings` (`id`, `reference_number`, `purchase_id`, `date`, `received_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '12391023', 2, '2015-02-06', 'LBC', '2015-02-06 16:59:05', '2015-02-06 16:59:05', NULL),
(2, '12301923', 2, '2015-02-06', '10923019', '2015-02-06 17:02:26', '2015-02-06 17:02:26', NULL),
(3, '1411512341', 3, '2015-02-21', 'LBC', '2015-02-21 18:40:13', '2015-02-21 18:40:13', NULL),
(4, '90909', 1, '2015-04-18', '909', '2015-04-18 13:13:03', '2015-04-18 13:13:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `venue_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_request` date NOT NULL,
  `pax` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reservation_start` date NOT NULL,
  `reservation_end` date NOT NULL,
  `net_total` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `reservations_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `first_name`, `middle_name`, `last_name`, `client_address`, `contact`, `motif`, `venue_address`, `event`, `date_request`, `pax`, `status`, `event_start`, `event_end`, `reservation_start`, `reservation_end`, `net_total`, `payment_mode`, `payment_method`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ID-E0OMOMRL', 'John', '', 'Peralta', '958-B M.Dela fuente St. Sampaloc', '2147483647', 'JAV ORGY BABY', 'M.dela Fuente', 'Sex party', '2015-09-09', 20, 'Payment Pending', '00:59', '12:59', '2015-09-25', '2015-09-25', 4000, '', '', '2015-09-09 02:16:07', '2015-09-09 02:16:07', NULL),
('ID-TCLM730H', 'John', '', 'Peralta', '958-B M.Dela fuente St. Sampaloc', '2147483647', 'sex party', 'M.dela Fuente', 'Sex party', '2015-09-09', 70, 'Payment Pending', '00:59', '12:59', '2015-09-25', '2015-09-25', 8610, '', '', '2015-09-09 02:21:55', '2015-09-09 02:21:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `menu_id`, `reservation_id`, `quantity`) VALUES
(2, 1, 'ID-VEISHVAM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `si_tbl`
--

CREATE TABLE IF NOT EXISTS `si_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `si_number` varchar(255) NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `si_tbl`
--

INSERT INTO `si_tbl` (`id`, `si_number`, `reservation_id`, `created_at`) VALUES
(11, '90786309', 'ID-VEISHVAM', '2015-04-25 06:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_tel_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `company_name`, `street_address`, `city`, `state`, `zip_code`, `country`, `tel_num`, `alt_tel_num`, `fax_num`, `email`, `contact_person`, `designation`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Claudine Mi', 'GXS Philippines', '', '', '', 0, 'Philippines', '09291080192', '', '', '', '', '', '', '2015-01-25 04:50:09', '2015-01-25 04:50:09', NULL),
(2, 'Karol Supplier', 'ThinkQuick', '', '', '', 0, 'Philippines', '0920190239', '', '', '', '', '', '', '2015-02-06 15:49:27', '2015-02-06 15:49:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE IF NOT EXISTS `terms_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `number`, `title`, `description`) VALUES
(4, 4, 'Cancellations s', 'If the client cancels a contracted food and beverage event, and /or facility equipment rental, the service provider can retain all of the deposit as liquidated damages.'),
(5, 5, 'Time ', 'No event will be permitted to run over the time agreed upon without caterers approval. The service provider reserves the right to make reasonable additional charges for events running beyond the time agreed upon. The agreed charge is stated at the bottom of this contract.'),
(6, 6, 'Legal Remedies ', 'In the event that the Service provider must seek legal remedies to complete execution of this contract, the client agrees to pay all reasonable attorney fees.'),
(7, 7, 'Damages ', 'The service provider and / or its agents will be liable for any damage to property entrusted to its employees. The Client assumes responsibilty for any damages to any property rented by the client or at the venue of his choice that may be caused by patrons, members, guests or invitees.'),
(8, 8, 'Indemnity ', 'The service provider shall have no responsibility or liability for failure to supply any services when prevented from doing so by strikes, accidents or any cause beyond Caterer''s control, or by orders of any governmental authority, except to return said deposit within sixty (60) days.	This contract constitutes the entire agreement between the parties. No modifications or cancellations thereof shall be valid nor of any force effect unless in writing signed by the service provider.	The undersigned acknowledges that he or she has read and accepted all the terms of Rental AGREEMENT and had executed the agreement on all of the following The agreement coincides with the Rental ORDER WORKSHEET which outlines the exact type of food, times and equipment to be provided by the service provider for patron. A copy of the Catering Order worksheet must accompany this agreement to make it whole.'),
(10, 1, 'Third Party', 'either we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.'),
(11, 2, 'Material', 'This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.'),
(12, 3, 'Link', 'From time to time this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'karol', '$2y$10$rBExe62mT7wNvH99uuEF4uhWO4bU2RQ9ppU7Cc55be60jW.ZObwWq', NULL, 1, '2015-01-24 16:55:49', '2015-01-24 16:55:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`);

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`);

--
-- Constraints for table `delivery_item`
--
ALTER TABLE `delivery_item`
  ADD CONSTRAINT `delivery_item_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`),
  ADD CONSTRAINT `delivery_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_itemtype_id_foreign` FOREIGN KEY (`itemtype_id`) REFERENCES `itemtypes` (`id`);

--
-- Constraints for table `item_purchase`
--
ALTER TABLE `item_purchase`
  ADD CONSTRAINT `item_purchase_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_purchase_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_quotation`
--
ALTER TABLE `item_quotation`
  ADD CONSTRAINT `item_quotation_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_quotation_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`);

--
-- Constraints for table `item_receiving`
--
ALTER TABLE `item_receiving`
  ADD CONSTRAINT `item_receiving_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_receiving_receiving_id_foreign` FOREIGN KEY (`receiving_id`) REFERENCES `receivings` (`id`);

--
-- Constraints for table `item_warehouse`
--
ALTER TABLE `item_warehouse`
  ADD CONSTRAINT `item_warehouse_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_warehouse_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `menu_reservation`
--
ALTER TABLE `menu_reservation`
  ADD CONSTRAINT `menu_reservation_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_reservation_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `quotations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `receivings`
--
ALTER TABLE `receivings`
  ADD CONSTRAINT `receivings_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
