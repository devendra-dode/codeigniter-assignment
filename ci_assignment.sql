-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 12:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Mumbai'),
(2, 1, 'Pune'),
(3, 1, 'Nagpur'),
(4, 2, 'Ahmedabad'),
(5, 2, 'Surat'),
(6, 3, 'Jaipur'),
(7, 3, 'Udaipur');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_details`
--

CREATE TABLE `dealer_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dealer_details`
--

INSERT INTO `dealer_details` (`id`, `user_id`, `zip`, `state_id`, `city_id`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 8, '111111', 1, 1, '2026-01-03 10:13:31', '2026-01-03 12:09:15', 8),
(2, 9, '123654', 3, 7, '2026-01-03 10:15:57', '2026-01-03 10:46:52', 9),
(3, 30, '789654', 3, 7, '2026-01-03 10:56:20', '2026-01-03 11:02:15', 30),
(4, 10, '321456', 2, 4, '2026-01-03 11:02:48', '2026-01-03 11:02:48', 28),
(5, 32, '987654', 1, 1, '2026-01-03 12:13:54', '2026-01-03 12:15:29', 31),
(6, 11, '654321', 1, 3, '2026-01-03 12:15:05', '2026-01-03 12:15:05', 31);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Maharashtra', NULL),
(2, 'Gujarat', NULL),
(3, 'Rajasthan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('employee','dealer') NOT NULL,
  `is_first_login` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `is_first_login`, `created_at`, `updated_at`) VALUES
(8, 'User1', 'Test', 'user1@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 0, '2026-01-03 08:57:53', 2147483647),
(9, 'User2', 'Test', 'user2@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 0, '2026-01-03 08:57:53', 2147483647),
(10, 'User3', 'Test', 'user3@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 0, '2026-01-03 08:57:53', 2147483647),
(11, 'User4', 'Test', 'user4@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 0, '2026-01-03 08:57:53', 2147483647),
(12, 'User5', 'Test', 'user5@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(13, 'User6', 'Test', 'user6@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(14, 'User7', 'Test', 'user7@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(15, 'User8', 'Test', 'user8@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(16, 'User9', 'Test', 'user9@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(17, 'User10', 'Test', 'user10@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(18, 'User11', 'Test', 'user11@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 0, '2026-01-03 08:57:53', 2147483647),
(19, 'User12', 'Test', 'user12@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 0, '2026-01-03 08:57:53', 2147483647),
(20, 'User13', 'Test', 'user13@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 0, '2026-01-03 08:57:53', 2147483647),
(21, 'User14', 'Test', 'user14@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 0, '2026-01-03 08:57:53', 2147483647),
(22, 'User15', 'Test', 'user15@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 0, '2026-01-03 08:57:53', 2147483647),
(23, 'User16', 'Test', 'user16@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(24, 'User17', 'Test', 'user17@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(25, 'User18', 'Test', 'user18@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(26, 'User19', 'Test', 'user19@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(27, 'User20', 'Test', 'user20@test.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'dealer', 1, '2026-01-03 08:57:53', 2147483647),
(28, 'devendra', 'dode', 'devendra1821@gmail.com', '$2y$10$vKRPA0vJdzz70ctOa6kbyOn2ELav/5YfnclOx8XP5OGOiOcmymZ4i', 'employee', 1, '2026-01-03 08:58:21', NULL),
(29, 'devendra', 'dode', 'devendra18211@gmail.com', '$2y$10$dpy6fshWXu9C46xyf/T1n.tUGHuRKFfHZ3TtMCk9Y5slN9BVrLeUq', 'employee', 1, '2026-01-03 09:28:06', NULL),
(30, 'test', 'test', 'test@gmail.com', '$2y$10$FMedJ1T8XOBbsqXc6sPVb.MaK5sHic59zoXQEpSl8nDZh3sgD/SiS', 'dealer', 0, '2026-01-03 09:55:53', NULL),
(31, 'emp', 'test', 'emp@test.com', '$2y$10$96SugN/MQSBcaC61F.O82uVyfgUCFe10R8b7mcon1biSqGR7CetFi', 'employee', 1, '2026-01-03 11:13:02', NULL),
(32, 'dealer', 'test', 'dealer@test.com', '$2y$10$BPlwtMe5zD1mkGZ/tWMWQu5iG/y/wfnWIFk7O7DWuVRxuPvbSvaLi', 'dealer', 0, '2026-01-03 11:13:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `dealer_details`
--
ALTER TABLE `dealer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dealer_details`
--
ALTER TABLE `dealer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `dealer_details`
--
ALTER TABLE `dealer_details`
  ADD CONSTRAINT `dealer_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dealer_details_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `dealer_details_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
