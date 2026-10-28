-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 24, 2026 at 12:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET FOREIGN_KEY_CHECKS = 0;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fittrack`
--
CREATE DATABASE IF NOT EXISTS `fittrack` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fittrack`;

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `muscle_group` varchar(100) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `name`, `muscle_group`, `difficulty`) VALUES
(1, 'Squats', 'legs', 'Beginner'),
(2, 'Push Ups', 'chest', 'Intermediate'),
(3, 'Plank', 'core', 'Beginner'),
(4, 'Lunges', 'legs', 'Beginner'),
(5, 'Deadlift', 'back', 'Advanced');

-- --------------------------------------------------------

--
-- Table structure for table `hydration`
--

DROP TABLE IF EXISTS `hydration`;
CREATE TABLE `hydration` (
  `hydration_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_ml` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hydration`
--

INSERT INTO `hydration` (`hydration_id`, `user_id`, `amount_ml`, `date`) VALUES
(1, 2, 1500, '2026-10-20'),
(2, 2, 2000, '2026-10-21'),
(3, 2, 1800, '2026-10-22'),
(4, 2, 2200, '2026-10-23'),
(5, 2, 2500, '2026-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `user_id`, `name`, `calories`, `date`) VALUES
(2, 2, 'Oatmeal with Banana', 350, '2026-10-20'),
(3, 2, 'Grilled Chicken with Rice', 550, '2026-10-21'),
(4, 2, 'Greek Yogurt with Berries', 250, '2026-10-22'),
(5, 2, 'Salmon with Vegetables', 600, '2026-10-23'),
(6, 2, 'Eggs and Avocado Toast', 450, '2026-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `motivation`
--

DROP TABLE IF EXISTS `motivation`;
CREATE TABLE `motivation` (
  `motivation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quote` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motivation`
--

INSERT INTO `motivation` (`motivation_id`, `user_id`, `quote`, `date`) VALUES
(1, 2, 'Every workout brings you closer to your goal.', '2026-10-20'),
(2, 2, 'Progress takes time. Stay consistent.', '2026-10-21'),
(3, 2, 'Your only competition is who you were yesterday.', '2026-10-22'),
(4, 2, 'Small steps lead to big results.', '2026-10-23'),
(5, 2, 'Believe in yourself and keep going.', '2026-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `recorded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `user_id`, `weight_kg`, `notes`, `recorded_at`) VALUES
(1, 2, 55.00, 'Starting weight', '2026-10-01 00:00:00'),
(2, 2, 55.30, 'First week progress', '2026-10-08 00:00:00'),
(3, 2, 55.70, 'Improved nutrition', '2026-10-15 00:00:00'),
(4, 2, 56.00, 'Consistent workouts', '2026-10-22 00:00:00'),
(5, 2, 56.20, 'Monthly progress update', '2026-10-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','USER') DEFAULT 'USER',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Demo Admin', 'admin@example.com', '$2y$12$1l29ep1BE.IpDte39mRmF.nzjWC0546ufLbPqxS4LI5QcPqSWQ0rC', 'ADMIN', '2026-10-24 10:00:00'),
(2, 'Demo User', 'user@example.com', '$2y$12$1l29ep1BE.IpDte39mRmF.nzjWC0546ufLbPqxS4LI5QcPqSWQ0rC', 'USER', '2026-10-24 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

DROP TABLE IF EXISTS `workouts`;
CREATE TABLE `workouts` (
  `workout_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `exercise_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`workout_id`, `user_id`, `name`, `duration`, `calories`, `date`, `exercise_id`) VALUES
(1, 2, 'Leg Day - Squats', 45, 300, '2026-10-20', 1),
(2, 2, 'Upper Body Workout', 30, 220, '2026-10-21', 2),
(3, 2, 'Core Workout', 20, 150, '2026-10-22', 3),
(4, 2, 'Leg Day - Lunges', 40, 280, '2026-10-23', 4),
(5, 2, 'Back Workout', 50, 350, '2026-10-24', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `hydration`
--
ALTER TABLE `hydration`
  ADD PRIMARY KEY (`hydration_id`),
  ADD KEY `fk_hydration_user` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`),
  ADD KEY `fk_meal_user` (`user_id`);

--
-- Indexes for table `motivation`
--
ALTER TABLE `motivation`
  ADD PRIMARY KEY (`motivation_id`),
  ADD KEY `fk_motivation_user` (`user_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `fk_progress_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`workout_id`),
  ADD KEY `fk_workout_user` (`user_id`),
  ADD KEY `fk_workouts_exercises` (`exercise_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hydration`
--
ALTER TABLE `hydration`
  MODIFY `hydration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motivation`
--
ALTER TABLE `motivation`
  MODIFY `motivation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hydration`
--
ALTER TABLE `hydration`
  ADD CONSTRAINT `fk_hydration_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `fk_meal_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `motivation`
--
ALTER TABLE `motivation`
  ADD CONSTRAINT `fk_motivation_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `fk_progress_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `fk_workout_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_workouts_exercises` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
