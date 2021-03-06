-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2019 at 09:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halalwayz`
--

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trip_id` int(11) NOT NULL,
  `trip_type_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `users_user_id` varchar(25) NOT NULL,
  `trip_name` text NOT NULL,
  `trip_sum` text NOT NULL,
  `trip_dest` text NOT NULL,
  `trip_activity` text NOT NULL,
  `trip_cover` varchar(100) NOT NULL,
  `trip_num_day` int(11) NOT NULL DEFAULT '0',
  `trip_meeting_addr` varchar(2000) NOT NULL,
  `trip_meeting_lat` double NOT NULL,
  `trip_meeting_lng` double NOT NULL,
  `trip_condition_casual` int(11) NOT NULL DEFAULT '0',
  `trip_condition_physical` int(11) NOT NULL DEFAULT '0',
  `trip_condition_vegan` int(11) NOT NULL DEFAULT '0',
  `trip_condition_children` int(11) NOT NULL DEFAULT '0',
  `trip_condition_flexible` int(11) NOT NULL DEFAULT '0',
  `trip_condition_seasonal` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_date`
--

CREATE TABLE `trip_date` (
  `trip_id` int(11) NOT NULL,
  `trip_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_detail`
--

CREATE TABLE `trip_detail` (
  `trip_detail_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `trip_day` int(11) NOT NULL,
  `trip_detail_start` time NOT NULL,
  `trip_detail_end` time NOT NULL,
  `trip_detail_start_ap` varchar(2) NOT NULL,
  `trip_detail_end_ap` varchar(2) NOT NULL,
  `trip_detail_description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_photo`
--

CREATE TABLE `trip_photo` (
  `trip_id` int(11) NOT NULL,
  `trip_photo_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_price`
--

CREATE TABLE `trip_price` (
  `trip_id` int(11) NOT NULL,
  `price_food` varchar(10) NOT NULL,
  `price_extra` mediumtext NOT NULL,
  `price_max_pass` int(11) NOT NULL,
  `price_type` varchar(10) NOT NULL DEFAULT 'basic',
  `price_unit1` float NOT NULL,
  `price_total1` float NOT NULL,
  `price_unit2` float NOT NULL,
  `price_total2` float NOT NULL,
  `price_unit3` float NOT NULL,
  `price_total3` float NOT NULL,
  `price_unit4` float NOT NULL,
  `price_total4` float NOT NULL,
  `price_unit5` float NOT NULL,
  `price_total5` float NOT NULL,
  `price_unit6` float NOT NULL,
  `price_total6` float NOT NULL,
  `price_unit7` float NOT NULL,
  `price_total7` float NOT NULL,
  `price_unit8` float NOT NULL,
  `price_total8` float NOT NULL,
  `price_children_allow` int(11) NOT NULL DEFAULT '0',
  `price_children` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_reservation`
--

CREATE TABLE `trip_reservation` (
  `res_id` int(11) NOT NULL,
  `res_no` varchar(100) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `trip_res_adult` int(11) NOT NULL,
  `trip_res_child` int(11) NOT NULL,
  `trip_res_date` date NOT NULL,
  `trip_res_title` varchar(10) NOT NULL,
  `trip_res_fn` varchar(100) NOT NULL,
  `trip_res_ln` varchar(100) NOT NULL,
  `trip_res_email` varchar(100) NOT NULL,
  `trip_res_mobile` varchar(20) NOT NULL,
  `trip_res_country` varchar(50) NOT NULL,
  `trip_res_payment_method` varchar(30) NOT NULL,
  `trip_res_payment_status` int(11) NOT NULL DEFAULT '0',
  `trip_res_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trip_res_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip_type`
--

CREATE TABLE `trip_type` (
  `trip_type_id` int(11) NOT NULL,
  `trip_type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trip_type`
--

INSERT INTO `trip_type` (`trip_type_id`, `trip_type_name`) VALUES
(1, 'Travel Trip'),
(2, 'Business Trip'),
(3, 'Medical Trip'),
(4, 'Umrah Trip');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `oauth_provider` varchar(15) DEFAULT NULL,
  `oauth_uid` varchar(25) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` varchar(25) DEFAULT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `user_pass` varchar(20) DEFAULT NULL,
  `user_fb_connect` int(1) DEFAULT NULL,
  `user_fb_authorized` varchar(50) DEFAULT NULL,
  `user_gg_connect` int(1) DEFAULT NULL,
  `user_gg_authorized` varchar(50) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created`, `modified`, `status`, `oauth_provider`, `oauth_uid`, `gender`, `locale`, `picture`, `link`, `user_id`, `user_name`, `user_pass`, `user_fb_connect`, `user_fb_authorized`, `user_gg_connect`, `user_gg_authorized`, `user_last_login`) VALUES
(39, 'Natapon', 'Pantuwong', 'pantuwong@gmail.com', NULL, NULL, '2019-03-04 22:03:24', NULL, '1', NULL, NULL, NULL, NULL, 'https://lh6.googleusercontent.com/-jYpRVFUx77Y/AAAAAAAAAAI/AAAAAAAAIjQ/29yQhGLbuXI/photo.jpg', NULL, 'grW03pe8WvT6H6802NMmKgmNF', NULL, '10961684', NULL, NULL, 1, NULL, '2019-03-12 01:42:54'),
(40, 'Thai', 'Annotation', 'thai.annotation@gmail.com', NULL, NULL, '2019-03-04 23:00:54', NULL, '1', NULL, NULL, NULL, NULL, 'https://lh5.googleusercontent.com/-ywUV-hXxnDs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3re97v5CRiVovII2i30d0Q6sN1BzIA/mo/photo.jpg', NULL, 'SMc85zDzFlRySaAOKzJEzWYDW', NULL, '10272188', NULL, NULL, 1, NULL, '2019-03-04 23:02:01'),
(41, 'worker Vendor', 'Mu', 'mu-733e18@sdoperapera.com', NULL, NULL, '2019-03-07 23:46:53', NULL, '1', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/-hinkVthho5c/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdYXXNUZgsDyrY2leFFJ-9j9iNHDQ/mo/photo.jpg', NULL, 'ExbJqOcUJ8gzRI4WPFhAdHFOe', NULL, '10107395', NULL, NULL, 1, NULL, '2019-03-07 23:47:37'),
(42, 'Natapon', 'Pantuwong', 'pantuwongn@gmail.com', NULL, NULL, '2019-03-08 15:13:21', NULL, '1', NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/-Tcw4BHiHIjY/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdPawiKyi-Tb2Ucyz4YZb-e10oxrw/mo/photo.jpg', NULL, 'lOD3Dftx7LUASpyDRtqpbxtYT', NULL, '10930270', NULL, NULL, 1, NULL, '2019-03-15 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`) VALUES
(1, 'Walk'),
(2, 'Car'),
(3, 'Van'),
(4, 'Motobike'),
(5, 'Bike'),
(6, 'Boat'),
(7, 'Public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `trip_date`
--
ALTER TABLE `trip_date`
  ADD PRIMARY KEY (`trip_id`,`trip_date`);

--
-- Indexes for table `trip_detail`
--
ALTER TABLE `trip_detail`
  ADD PRIMARY KEY (`trip_detail_id`);

--
-- Indexes for table `trip_photo`
--
ALTER TABLE `trip_photo`
  ADD PRIMARY KEY (`trip_id`,`trip_photo_name`);

--
-- Indexes for table `trip_price`
--
ALTER TABLE `trip_price`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `trip_reservation`
--
ALTER TABLE `trip_reservation`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `trip_type`
--
ALTER TABLE `trip_type`
  ADD PRIMARY KEY (`trip_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_detail`
--
ALTER TABLE `trip_detail`
  MODIFY `trip_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_reservation`
--
ALTER TABLE `trip_reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_type`
--
ALTER TABLE `trip_type`
  MODIFY `trip_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
