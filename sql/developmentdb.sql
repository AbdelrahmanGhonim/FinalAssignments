-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 07, 2024 at 12:25 PM
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
(5, 'Cucumber', 3.60, 0.50, 0.20, 0.50, 0),
(7, 'Lettuce', 1.00, 0.50, 0.10, 1.00, 0),
(8, 'Zucchini', 3.10, 1.20, 0.20, 1.00, 0),
(12, 'Sweet Potato', 20.10, 1.60, 0.10, 3.00, 1),
(14, 'Oats', 66.30, 16.90, 7.00, 10.60, 1),
(15, 'Greek Yogurt', 3.60, 10.00, 5.00, 0.00, 1),
(18, 'Almonds', 21.70, 21.20, 49.40, 11.80, 1),
(19, 'Chicken Breast', 0.00, 31.00, 3.60, 0.00, 1),
(22, 'Eggs', 0.60, 12.60, 9.50, 0.00, 2),
(23, 'Beef', 0.00, 26.10, 21.20, 0.00, 2),
(24, 'Greek Yogurt', 3.60, 10.00, 5.00, 0.00, 2),
(25, 'Cottage Cheese', 3.40, 11.10, 4.30, 0.00, 2),
(29, 'Peanut Butter', 20.00, 25.00, 50.00, 8.00, 2),
(30, 'Pasta', 71.20, 12.50, 1.10, 2.50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userfood`
--

CREATE TABLE `userfood` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `foodname` varchar(255) NOT NULL,
  `carbs` decimal(10,2) NOT NULL,
  `proteins` decimal(10,2) NOT NULL,
  `fats` decimal(10,2) NOT NULL,
  `fibers` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `workoutName` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `userfood`
--
ALTER TABLE `userfood`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

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
-- AUTO_INCREMENT for table `userfood`
--
ALTER TABLE `userfood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userfood`
--
ALTER TABLE `userfood`
  ADD CONSTRAINT `userfood_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `workout`
--
ALTER TABLE `workout`
  ADD CONSTRAINT `workout_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
