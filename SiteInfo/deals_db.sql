-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2018 at 04:56 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `deal_images`
--

DROP TABLE IF EXISTS `deal_images`;
CREATE TABLE `deal_images` (
  `deal_id` int(8) NOT NULL,
  `image` blob,
  `seq_no` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deal_info`
--

DROP TABLE IF EXISTS `deal_info`;
CREATE TABLE `deal_info` (
  `deal_id` int(24) NOT NULL,
  `parent_deal_id` int(24) DEFAULT NULL,
  `merchant_id` int(24) DEFAULT NULL,
  `deal_heading` varchar(128) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `notes` varchar(2048) DEFAULT NULL,
  `deal_amount` int(8) DEFAULT NULL,
  `currency` varchar(8) DEFAULT NULL,
  `actual_amount` int(8) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `redemption_count` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `image` blob,
  `website` varchar(128) DEFAULT NULL,
  `operating_time` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `deal_images`
--
ALTER TABLE `deal_images`
  ADD PRIMARY KEY (`deal_id`);

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
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_images`
--
ALTER TABLE `deal_images`
  MODIFY `deal_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_info`
--
ALTER TABLE `deal_info`
  MODIFY `deal_id` int(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant_info`
--
ALTER TABLE `merchant_info`
  MODIFY `merchant_id` bigint(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

