-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2018 at 11:50 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `deals_db`
--
CREATE DATABASE IF NOT EXISTS `deals_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `deals_db`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `activity_log_id` int(8) NOT NULL,
  `action` varchar(64) DEFAULT NULL,
  `actor` varchar(64) DEFAULT NULL,
  `actor_type` varchar(16) DEFAULT NULL,
  `action_data` varchar(1024) DEFAULT NULL,
  `time_added` timestamp NULL DEFAULT NULL,
  `ip_adderss` varchar(32) DEFAULT NULL,
  `client_agent` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

DROP TABLE IF EXISTS `admin_info`;
CREATE TABLE `admin_info` (
  `admin_id` bigint(24) NOT NULL,
  `admin_login_name` varchar(32) NOT NULL,
  `encrypted_password` varchar(256) NOT NULL,
  `admin_login_status` tinyint(1) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(64) NOT NULL,
  `seq_no` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `seq_no`) VALUES
(1, 'BEAUTY & SPA', 0),
(2, 'CAKES', 1),
(3, 'ESTATE AGENTS', 2),
(4, 'FASHION & CLOTHING', 3),
(5, 'HEALTHCARE', 4),
(6, 'JEWELLERY', 5),
(7, 'OFF LICENCE', 6),
(8, 'PARCELS & DELIVERY', 7),
(9, 'PARTIES & SERVICES', 8),
(10, 'PUBS & LEISURE', 9),
(11, 'RESTAURANTS', 10),
(12, 'TECHNOLOGY & PRINTING', 11),
(13, 'TRANSPORTATION', 12),
(14, 'OTHERS', 13);

-- --------------------------------------------------------

--
-- Table structure for table `deal_category`
--

DROP TABLE IF EXISTS `deal_category`;
CREATE TABLE `deal_category` (
  `deal_id` int(8) NOT NULL,
  `category_id` int(8) NOT NULL,
  `seq_no` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deal_category`
--

INSERT INTO `deal_category` (`deal_id`, `category_id`, `seq_no`) VALUES
(1, 10, NULL),
(5, 10, NULL),
(5, 9, NULL),
(9, 1, NULL),
(13, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deal_info`
--

DROP TABLE IF EXISTS `deal_info`;
CREATE TABLE `deal_info` (
  `deal_id` int(24) NOT NULL,
  `parent_deal_id` int(24) DEFAULT NULL,
  `merchant_id` int(24) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `deal_amount` decimal(13,2) DEFAULT NULL,
  `currency` varchar(8) DEFAULT NULL,
  `actual_amount` decimal(13,2) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `redemption_count` int(8) DEFAULT NULL,
  `percentage` int(8) NOT NULL,
  `image_dir` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deal_info`
--

INSERT INTO `deal_info` (`deal_id`, `parent_deal_id`, `merchant_id`, `title`, `description`, `deal_amount`, `currency`, `actual_amount`, `start_date`, `end_date`, `is_active`, `redemption_count`, `percentage`, `image_dir`) VALUES
(1, 0, 1, 'Fresh traditional Indian and Sri Lankan food', 'At Maruthi Express, our selection of fresh Indian and Sri Lankan is made by traditional Indian chefs and taste as if it were made back home. We provide both an eat in and takeaway service, giving you the freedom to eat from the comfort of your own home.', '4.00', 'GBP', '0.00', '2018-07-31 18:30:00', '2018-09-30 18:29:59', 1, 0, 0, NULL),
(2, 1, 1, 'Freshly steamed Idli and Chutney for only £2.50!', 'Freshly steamed Idli and Chutney for only £2.50!', '3.00', 'GBP', '0.00', '2018-07-31 18:30:00', '2018-09-30 18:29:59', 1, 0, 0, NULL),
(3, 1, 1, 'Rice and any of our five curries for only £3.50!', 'Rice and any of our five curries for only £3.50!', '4.00', 'GBP', '0.00', '2018-07-31 18:30:00', '2018-09-30 18:29:59', 1, 1, 0, NULL),
(4, 1, 1, 'Any Biryani only £3.50!', 'Any Biryani only £3.50!', '4.00', 'GBP', '0.00', '2018-07-31 18:30:00', '2018-09-30 18:29:59', 1, 3, 0, NULL),
(5, 0, 2, 'Delicious Weekday Deals!', 'Yaal’s weekday deals offering some of your favourite dishes valid Monday to Friday from 11am - 7pm! We also provide freshly prepared vegetarian and non-vegetarian meals for parties, providing your guest with amazing, authentic Sri Lankan and South Indian experience.', '5.00', 'GBP', '0.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 0, 0, NULL),
(6, 5, 2, 'Large Party Deal, Discount when you order over 100 Vegetarian meals!', 'Large Party Deal, Discount when you order over 100 Vegetarian meals!', '5.00', 'GBP', '4.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 1, 0, NULL),
(7, 5, 2, 'Orders over £50, free 1kg mixer packet !', 'Orders over £50, free 1kg mixer packet !', '50.00', 'GBP', '0.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 1, 0, NULL),
(8, 5, 2, '100 String Hopper Deal, Monday to Thursday only', '100 String Hopper Deal, Monday to Thursday only', '12.55', 'GBP', '10.15', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 12, 0, NULL),
(9, 0, 3, 'Makeup & Hair Styling for all occasions', 'Look your best when we do your makeover for all kinds of events and parties. We will make you stand out from the crowd!', '500.00', 'GBP', '0.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 0, 0, NULL),
(10, 9, 3, 'Tamil Wedding full day package', 'Tamil Wedding full day package', '1200.00', 'GBP', '800.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 23, 0, NULL),
(11, 9, 3, '24 carat gold facial', '24 carat gold facial', '50.00', 'GBP', '40.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 5, 0, NULL),
(12, 9, 3, 'Saree Ceremony full day package', 'Saree Ceremony full day package', '700.00', 'GBP', '500.00', '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 7, 0, NULL),
(13, 0, 3, 'Cake making and styling for all occasions', 'As well as styling, we also do cakes for all occasions! Give us a call or check out what kinds of cakes we can make!', NULL, NULL, NULL, '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 0, 0, NULL),
(14, 13, 3, '30% off Baby Shower cakes!', '30% off Baby Shower cakes!', NULL, NULL, NULL, '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 0, 30, NULL),
(15, 13, 3, '25% off Birthday cakes!', '25% off Birthday cakes!', NULL, NULL, NULL, '2018-08-22 18:30:00', '2018-09-10 09:29:59', 1, 0, 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_info`
--

DROP TABLE IF EXISTS `merchant_info`;
CREATE TABLE `merchant_info` (
  `merchant_id` bigint(24) NOT NULL,
  `merchant_email` varchar(256) NOT NULL,
  `encrypted_password` varchar(256) NOT NULL,
  `email_otp` varchar(8) NOT NULL,
  `email_verified` tinyint(1) NOT NULL,
  `login_status` tinyint(1) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `business_name` varchar(128) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `address1` varchar(256) DEFAULT NULL,
  `address2` varchar(256) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `postal_code` varchar(16) DEFAULT NULL,
  `image_dir` varchar(128) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `youtube` varchar(128) DEFAULT NULL,
  `instagram` varchar(128) DEFAULT NULL,
  `operating_time` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `map_position` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchant_info`
--

INSERT INTO `merchant_info` (`merchant_id`, `merchant_email`, `encrypted_password`, `email_otp`, `email_verified`, `login_status`, `last_login_time`, `business_name`, `phone_number`, `address1`, `address2`, `state`, `country`, `postal_code`, `image_dir`, `website`, `facebook`, `youtube`, `instagram`, `operating_time`, `description`, `map_position`) VALUES
(1, 'maruthiexpress@gmail.com', '', '', 0, 0, '2018-08-26 11:48:11', 'MARUTHI EXPRESS', '442084230580', '248A Northolt Road', '', 'Harrow', 'UK', 'HA2 8DU', NULL, 'www.maruthiexpress.com', 'www.facebook.com/maruthiexpress', 'www.youtube.com/maruthiexpress', NULL, 'Monday - Sunday: 8:00am - 11:00pm', 'We are a traditional Indian and Sri Lankan restaurant making food taste exactly as you would expect it. Our team of local Indian chefs make food that you will love each and every time! We also offer a takeaway service so you can enjoy your favourite food i', '{ latitude: 51.5644916, longitude: -0.3563085 }'),
(2, 'yaalexpress@gmail.com', '', '', 0, 0, '2018-08-24 17:24:32', 'YAAL EXPRESS', '4420 8868 3861', '426B Rayners Lane', '', 'Harrow', 'United Kingdom', 'HA5 5DX', NULL, 'www.yaalexpress.com', NULL, NULL, NULL, 'Monday - Sunday: 8:00am - 11:00pm', 'Yaal Express recently opened its doors in Rayners Lane to serve our clientele fresh and authentic Sri-Lankan & South Indian cuisine. Our ethos is simple: Bringing Sri-Lankan & South Indian street food to the UK. We have a range of experience from fine dini', '{ latitude: 51.5773912, longitude: -0.3734332 }'),
(3, 'varshibeautycare@gmail.com', '', '', 0, 0, '2018-08-24 17:24:35', 'VARSHI BEAUTY CARE', '447880965404', '', '', 'London', 'United Kingdom', '', NULL, 'www.varshibeautycare.com', NULL, NULL, NULL, 'Monday - Sunday: 00:00am - 11:59pm', 'We make you look fabulous on your special day” We do bridal makeup service and make up service for all occasions. Our friendly, professionally trained make up artist come to your home or party hall and put your make up on for you.', '{ latitude: 51.59557, longitude: -0.2440267 }');

-- --------------------------------------------------------

--
-- Table structure for table `user_deals`
--

DROP TABLE IF EXISTS `user_deals`;
CREATE TABLE `user_deals` (
  `user_id` int(8) NOT NULL,
  `deal_id` int(8) NOT NULL,
  `qrcode_string` varchar(256) DEFAULT NULL,
  `is_redeemed` tinyint(1) DEFAULT NULL,
  `is_wished` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `user_id` bigint(24) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` bigint(16) NOT NULL,
  `email_otp` varchar(8) NOT NULL,
  `phone_number_otp` varchar(8) NOT NULL,
  `encrypted_password` varchar(256) NOT NULL,
  `email_verified` tinyint(1) NOT NULL,
  `phone_number_verified` tinyint(1) NOT NULL,
  `login_status` tinyint(1) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_social_login` tinyint(1) NOT NULL,
  `social_login_partner` varchar(32) NOT NULL,
  `social_login_id` varchar(256) NOT NULL,
  `address1` varchar(256) DEFAULT NULL,
  `address2` varchar(256) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `postal_code` varchar(16) DEFAULT NULL,
  `image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_log_id`);

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `deal_info`
--
ALTER TABLE `deal_info`
  ADD PRIMARY KEY (`deal_id`);

--
-- Indexes for table `merchant_info`
--
ALTER TABLE `merchant_info`
  ADD PRIMARY KEY (`merchant_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_log_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` bigint(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deal_info`
--
ALTER TABLE `deal_info`
  MODIFY `deal_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `merchant_info`
--
ALTER TABLE `merchant_info`
  MODIFY `merchant_id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

