-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2025 at 04:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopaholics`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(64) NOT NULL,
  `list_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `quantity` float NOT NULL,
  `measuring_unit` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `list_id`, `order_id`, `item`, `quantity`, `measuring_unit`, `completed`) VALUES
(100, 32, 2, 'μακαρόνια', 2, 10, 0),
(101, 32, 1, 'τυρί', 500, 0, 0),
(102, 32, 3, 'γάλα', 1, 3, 0),
(103, 32, 4, 'αφρόλουτρο', 1, 11, 0),
(104, 33, 1, 'υαλοκαθαριστήρες', 1, 12, 0),
(105, 33, 2, 'λάδια', 5, 3, 0),
(106, 34, 2, 'παντελόνι', 1, 9, 0),
(107, 34, 1, 'πουκάμισο', 1, 9, 0),
(108, 34, 3, 't-shirt', 2, 9, 0),
(109, 35, 1, 'γραβιέρα', 0.5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `junc_t_user_list`
--

CREATE TABLE `junc_t_user_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `list_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `junc_t_user_list`
--

INSERT INTO `junc_t_user_list` (`id`, `user_id`, `list_id`, `list_order_id`) VALUES
(34, 3, 32, 0),
(35, 3, 33, 1),
(36, 3, 34, 4),
(37, 3, 35, 4),
(38, 3, 36, 4),
(39, 3, 37, 5),
(40, 3, 38, 6);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `category` varchar(30) DEFAULT NULL,
  `icon` blob DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`list_id`, `title`, `category`, `icon`, `active`, `creation_date`) VALUES
(32, 'Μασούτης', '1', '', 1, '2025-01-05'),
(33, 'Αυτοκίνητο', '1', '', 1, '2025-01-05'),
(34, 'Ρούχα', '1', '', 1, '2025-01-05'),
(35, 'Lidl', '1', '', 1, '2025-01-05'),
(36, '5', '1', '', 1, '2025-01-05'),
(37, '6', '1', '', 1, '2025-01-05'),
(38, '7', '1', '', 1, '2025-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(64) NOT NULL,
  `picture` mediumblob DEFAULT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `reset_password_token` varchar(64) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `picture`, `creation_date`, `reset_password_token`, `token_expiration`) VALUES
(3, 'Περικλής', 'Βουτσάς', 'periklis@cocol.gr', '$2y$10$b3GM.PLwj6yRO5ZQ/zW71umOm6QV2PdeCaUwXp3IWtKvEdiaI52KS', NULL, '2025-01-04', NULL, NULL),
(4, 'Νικολέτα', 'Βουτσά', 'nikoleta@cocol.gr', '$2y$10$Jp0.Wwwod8uV8vfoAKv6Be5Da089YJQ1nyOX.pSeayiLys4PesFmS', NULL, '2025-01-04', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `junc_t_user_list`
--
ALTER TABLE `junc_t_user_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `junc_t_user_list`
--
ALTER TABLE `junc_t_user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`);

--
-- Constraints for table `junc_t_user_list`
--
ALTER TABLE `junc_t_user_list`
  ADD CONSTRAINT `junc_t_user_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `junc_t_user_list_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
