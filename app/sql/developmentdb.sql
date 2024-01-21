-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 21, 2024 at 04:55 PM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--
CREATE DATABASE IF NOT EXISTS `developmentdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `developmentdb`;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `content_id` int(11) NOT NULL,
  `content_type` enum('article','workout','recipe') NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`content_id`, `content_type`, `title`, `content`, `image_name`, `created_at`) VALUES
(1, 'article', 'Embrace the Journey, Celebrate the Progress.\r\n\r\n', 'In the pursuit of your fitness goals, remember that every step forward is a victory, no matter how small. It\'s not just about reaching the destination; it\'s about the growth, the effort, and the resilience you display along the way. Embrace the journey with open arms, stay focused on your progress, and let each day be a testament to your strength and determination.', 'image1.jpg', '2024-01-08 13:29:35'),
(2, 'workout', 'Overcoming Challenges\r\n\r\n', 'Every hurdle is a chance to prove your resilience, turning challenges into stepping stones on your fitness journey. Embrace the struggle, for within it lies the raw power that propels you forward. You are not just overcoming challenges; you are becoming stronger with each triumph. Your journey is a testament to the unwavering spirit that defines your path to fitness success.', 'image2.jpg', '2024-01-08 13:29:35'),
(3, 'recipe', 'Fuel Your Body, Fuel Your Journey', 'In the realm of fitness, nutrition is the cornerstone of your success. What you eat is not just sustenance; it\'s the fuel that powers your progress. Embrace the vitality of wholesome choices, savor the energy of balanced meals, and let nutrition be the catalyst for your transformative journey. Remember, a well-nourished body is a resilient body, ready to conquer every workout and surmount every goal.', 'image3.jpg', '2024-01-13 17:35:10'),
(4, 'recipe', 'Elevate Your Heart, Elevate Your Health', 'Cardiovascular exercise isn\'t just about burning calories; it\'s about nurturing the most vital muscle in your body — your heart. Engage in cardio activities to enhance endurance, boost energy levels, and fortify your cardiovascular system. Whether it\'s the rhythmic pounding of a run or the steady flow of a cycling session, cardio is the heartbeat of your fitness journey.\r\n\r\nEmbrace the invigorating power of cardio. Elevate your heart rate, strengthen your stamina, and feel the surge of vitality that comes with each beat. Your heart is the rhythm of your health — let it thrive.', 'image4.jpg', '2024-01-13 17:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_facts`
--

CREATE TABLE `nutrition_facts` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `carbs` decimal(10,2) DEFAULT NULL,
  `proteins` decimal(10,2) DEFAULT NULL,
  `fats` decimal(10,2) DEFAULT NULL,
  `fibers` decimal(10,2) DEFAULT NULL,
  `goal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_facts`
--

INSERT INTO `nutrition_facts` (`food_id`, `food_name`, `carbs`, `proteins`, `fats`, `fibers`, `goal_id`) VALUES
(1, 'Spinach', 1.20, 0.50, 0.20, 0.70, 0),
(2, 'Broccoli', 6.60, 2.80, 0.60, 2.60, 0),
(3, 'Kale', 5.40, 2.90, 0.50, 1.30, 0),
(4, 'Cauliflower', 5.30, 2.00, 0.30, 2.00, 0),
(5, 'Cucumber', 3.60, 0.50, 0.20, 0.50, 0),
(6, 'Tomato', 3.90, 0.90, 0.20, 1.20, 0),
(7, 'Lettuce', 1.00, 0.50, 0.10, 1.00, 0),
(8, 'Zucchini', 3.10, 1.20, 0.20, 1.00, 0),
(9, 'Bell Pepper', 6.00, 1.00, 0.20, 2.50, 0),
(10, 'Cabbage', 6.00, 1.30, 0.10, 2.50, 0),
(11, 'Quinoa', 21.30, 4.10, 1.60, 2.80, 1),
(12, 'Sweet Potato', 20.10, 1.60, 0.10, 3.00, 1),
(13, 'Brown Rice', 44.80, 8.50, 1.60, 3.50, 1),
(14, 'Oats', 66.30, 16.90, 7.00, 10.60, 1),
(15, 'Greek Yogurt', 3.60, 10.00, 5.00, 0.00, 1),
(16, 'Salmon', 0.00, 25.40, 11.80, 0.00, 1),
(17, 'Avocado', 8.50, 2.00, 14.70, 6.70, 1),
(18, 'Almonds', 21.70, 21.20, 49.40, 11.80, 1),
(19, 'Chicken Breast', 0.00, 31.00, 3.60, 0.00, 1),
(20, 'Quinoa Salad', 18.70, 4.00, 6.20, 2.80, 1),
(21, 'Chicken Breast', 0.00, 31.00, 3.60, 0.00, 2),
(22, 'Eggs', 0.60, 12.60, 9.50, 0.00, 2),
(23, 'Beef', 0.00, 26.10, 21.20, 0.00, 2),
(24, 'Greek Yogurt', 3.60, 10.00, 5.00, 0.00, 2),
(25, 'Cottage Cheese', 3.40, 11.10, 4.30, 0.00, 2),
(26, 'Chickpeas', 45.00, 12.50, 2.60, 7.60, 2),
(27, 'Brown Rice', 44.80, 8.50, 1.60, 3.50, 2),
(28, 'Almonds', 21.70, 21.20, 49.40, 11.80, 2),
(29, 'Peanut Butter', 20.00, 25.00, 50.00, 8.00, 2),
(30, 'Pasta', 71.20, 12.50, 1.10, 2.50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `bmrInfo` decimal(10,2) DEFAULT NULL,
  `goal` enum('Lose Weight','Maintain Weight','Build Muscle') DEFAULT NULL,
  `caloriesIntake` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `age`, `gender`, `weight`, `height`, `bmrInfo`, `goal`, `caloriesIntake`) VALUES
(76, 'Abdo4', '$2y$10$vqS0CHto9Yo6u6Rc5Pc0lexM/xu.UMCGAKWPCQ5l2sekVREfFqpU6', 21, 'Male', 82.00, 175.00, 1907.52, 'Lose Weight', 1407.52),
(77, 'Ali', '$2y$10$Ly6Nv5v1Y4eSE3echNaRguvZhQ0FwZZx7x/RA324nRgywTfwylGuq', 22, 'Male', 90.00, 185.00, 2057.01, 'Lose Weight', 1557.01),
(78, 'Ali', '$2y$10$v0AUhXR1cCn0OHzv3tIX/.M0M2QKPP4EkmEqKsQrnZYn1XXAkqe8W', 24, 'Male', 100.00, 176.00, 2136.44, 'Lose Weight', 1636.44),
(101, 'Abdo', '$2y$10$T80PrjjsZLqYWbJWzrBgAOJdsNiyurJPDoXiXya/F8PeRK0GQefja', 20, 'Male', 75.00, 187.00, 1877.01, 'Maintain Weight', 1877.01),
(102, 'Ghonim', '$2y$10$4SeecHHDYf8S416v7jooFuwD3m03Kgj5ITuRmchL/9krFuKenVEpS', 20, 'Male', 80.00, 182.00, 1920.00, 'Lose Weight', 1420.00),
(103, 'mohamed', '$2y$10$Ge2oVttdlsvRW6/BawT7RuxnSQZF8JAW/9Oltlr03wsPzQwmsc0MG', 20, 'Male', 87.00, 187.00, 2037.77, 'Lose Weight', 1537.77),
(104, 'Abdelrahman', '$2y$10$4Hq66OTbuNkKys90K7IKTu2DwBJMz6vLbNYP.v0VostVd2LyWKpOi', 31, 'Male', 67.00, 181.00, 1678.59, 'Lose Weight', 1178.59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `nutrition_facts`
--
ALTER TABLE `nutrition_facts`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nutrition_facts`
--
ALTER TABLE `nutrition_facts`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
