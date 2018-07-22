-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2018 at 08:14 AM
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
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `social_login_id` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

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
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` bigint(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant_info`
--
ALTER TABLE `merchant_info`
  MODIFY `merchant_id` bigint(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` bigint(24) NOT NULL AUTO_INCREMENT;

