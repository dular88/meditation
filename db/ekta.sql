-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2025 at 10:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekta`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `written_by` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `image`, `written_by`, `summary`, `created_at`) VALUES
(5, 'new book', '1763289653_WhatsApp Image 2025-11-14 at 9.08.51 AM.jpeg', 'dinesh', 'short', '2025-11-16 10:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Raipur'),
(2, 1, 'Bilaspur'),
(3, 1, 'Durg'),
(4, 3, 'Hyderabad'),
(5, 1, 'Bhilai'),
(6, 1, 'Champa');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'Dinesh Kumar Verma', 'dular88@gmail.com', '7509016504', 'meditation enquiry', 'moun dhyan when will happen ?', '2025-12-23 17:32:47'),
(2, 'Dinesh Kumar Verma', 'dular88@gmail.com', '7509016504', 'meditation enquiry', 'moun dhyan when will happen ?', '2025-12-23 17:35:44'),
(3, 'Dinesh Kumar Verma', 'dular88@gmail.com', '7509016504', 'meditation enquiry', 'testung', '2025-12-23 17:36:00'),
(4, 'Dinesh Kumar Verma', 'dular88@gmail.com', '', '', 'hdryrydhdfh', '2025-12-23 17:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `center_id`, `name`, `start_date`, `end_date`, `photo`, `details`, `created_at`) VALUES
(3, 4, 'Dinesh Kumar Verma', '2025-11-14', '2025-11-16', 'uploads/events/1763118823_69170ee705960.jpeg', 'fsfasf', '2025-11-14 11:13:43'),
(4, 2, 'business1 b upd sixrth', '2025-11-15', '2025-12-23', 'uploads/events/1763197248_691841405d7a0.jpg', 'fdfdsfsdg', '2025-11-15 09:00:48'),
(5, 4, 'business1 b upd sixrth', '2025-12-25', '2025-12-29', 'uploads/events/1763197535_6918425f5ba98.jpg', 'fdfdsfsdg', '2025-11-15 09:05:35'),
(6, 4, 'one', '2025-11-15', '2025-12-22', 'uploads/events/1763197933_691843edce46c.jpeg', 'shivpriya updated', '2025-11-15 09:12:13'),
(8, 2, 'Moun Dhyan', '2025-12-15', '2025-12-17', 'uploads/events/1765887514_69414e1ae21aa.jpg', 'Moun Dhyan', '2025-12-15 16:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `meditation_centers`
--

CREATE TABLE `meditation_centers` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `google_business_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `google_map_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `meditation_centers`
--

INSERT INTO `meditation_centers` (`id`, `center_name`, `state_id`, `city_id`, `address`, `contact_number`, `email`, `google_business_url`, `youtube_url`, `google_map_url`) VALUES
(2, 'Maruti Pyramid', 1, 5, 'Risali', '111111', '', 'https://share.google/eVtTZiGAGNxkyVdKr', 'http://youtube.com', 'map'),
(4, 'shivpriya pyramid', 1, 1, 'Siltara Raipur', '646464555545', '', 'https://share.google/eVtTZiGAGNxkyVdKr', 'http://youtube.com', 'map');

-- --------------------------------------------------------

--
-- Table structure for table `meditators`
--

CREATE TABLE `meditators` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `meditators`
--

INSERT INTO `meditators` (`id`, `name`, `address`, `state_id`, `city_id`, `contact`, `created_at`) VALUES
(1, 'Dinesh Kumar Verma', 'Resali', 1, 5, '6436346346', '2025-11-15 11:04:21'),
(3, 'golu', 'fafadih', 1, 2, '7896541230', '2025-11-16 10:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Chhattisgarh'),
(2, 'Madhya Pradesh'),
(3, 'Andhra Pradesh'),
(4, 'Gujrat'),
(5, 'Delhi'),
(6, 'Rajsthan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','user') DEFAULT 'user',
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Super Admin', 'admin@ekta.com', '9999999999', '$2y$10$MneAXHuZp3LIc7v3M1DclOgSUs8jXWvld0mqMyeQxvzIPxt.UFpXG', 'admin', 1, '2025-12-24 10:24:34'),
(26, 'Dinesh Kumar Verma upd', '', '7509016505', '$2y$10$O8jQPdebEe5vNQmcV8J8F.dCdtsdE/oD/Gen0g3cz84f4MEhrVNh2', 'manager', 1, '2025-12-25 06:25:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meditation_centers`
--
ALTER TABLE `meditation_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meditators`
--
ALTER TABLE `meditators`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `phone_2` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meditation_centers`
--
ALTER TABLE `meditation_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meditators`
--
ALTER TABLE `meditators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
