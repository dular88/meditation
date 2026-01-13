-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2026 at 12:56 PM
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
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `name`) VALUES
(8, 2, 'Maitri Nagar Resali'),
(9, 2, 'Resali'),
(10, 2, 'Taalpuri'),
(11, 2, 'Ruabandha Sector Resali'),
(13, 2, 'Sector-10'),
(14, 2, 'Sector-6'),
(15, 2, 'Maroda'),
(16, 2, 'Vaishali Nagar'),
(18, 10, 'Siltara'),
(19, 10, 'Ghadi Chowk'),
(20, 10, 'Ge Road'),
(21, 10, 'Shivanand Nagar'),
(22, 10, 'Arihant Nagar'),
(23, 10, 'Anupam Nagar'),
(24, 10, 'Rajendra Nagar'),
(25, 10, 'Shailendra Nagar'),
(26, 10, 'Devendra Nagar'),
(27, 1, 'Sarkanda'),
(28, 1, 'Vidhani Chowk'),
(29, 1, 'Bahatarai'),
(30, 1, 'Rajkishor Nagar'),
(31, 1, 'Railway Quater'),
(32, 12, 'Pendri'),
(33, 4, 'Ghutiya'),
(34, 6, 'Ravishankar Shukla Nagar'),
(35, 6, 'Mongra'),
(36, 8, 'Jodhapur'),
(37, 8, 'Maratha Para'),
(38, 8, 'Bamlai Para'),
(39, 8, 'Depo Para'),
(40, 15, 'New Rawan Bhata'),
(41, 15, 'Temari'),
(43, 3, 'Mahud'),
(44, 3, 'Dhamdha'),
(45, 3, 'Anda'),
(46, 2, 'Anjora'),
(47, 2, 'Kumhari'),
(49, 3, 'Patan'),
(50, 16, 'Chhura'),
(51, 17, 'Pratappur'),
(53, 18, 'Bhatagaon'),
(55, 19, 'Mohla'),
(56, 20, 'Nawagarh'),
(57, 20, 'Pahanda'),
(58, 21, 'Simga'),
(59, 23, 'Kuwakonda'),
(60, 5, 'Vrindavan Colony');

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
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Bilaspur'),
(2, 'Bhilai'),
(3, 'Durg'),
(4, 'Champa'),
(5, 'Raigarh'),
(6, 'Korba'),
(8, 'Dhamatari'),
(10, 'Raipur'),
(12, 'Rajnandgaon'),
(15, 'Mahasamund'),
(16, 'Gariyaband'),
(17, 'Ambikapur'),
(18, 'Gundardehi'),
(19, 'Ambagarh Chowki'),
(20, 'Bemetara'),
(21, 'Baloda Bazar'),
(23, 'Dantewada');

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
  `link` text NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `center_id`, `name`, `start_date`, `end_date`, `photo`, `link`, `details`, `created_at`) VALUES
(11, 13, 'Dhyan Yagna', '2026-01-25', '2026-01-26', 'uploads/events/1768285634_6965e5c2b5d41.jpeg', '', 'Dhyan Yagna in Raipur\'s Biggest Pyramid \"Shivpriya Pyramid\" .', '2026-01-13 06:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `meditation_centers`
--

CREATE TABLE `meditation_centers` (
  `id` int(11) NOT NULL,
  `center_name` varchar(255) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
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

INSERT INTO `meditation_centers` (`id`, `center_name`, `area_id`, `city_id`, `address`, `contact_number`, `email`, `google_business_url`, `youtube_url`, `google_map_url`) VALUES
(2, 'Maruti Pyramid', 9, 2, 'Aajad Market', '8770878527', '', 'https://search.google.com/local/writereview?placeid=ChIJhTtoz7Y9KToRDIOu7AJTw9Y', 'https://www.youtube.com/watch?v=kcRYu7ewr-U', 'https://www.google.com/maps?rlz=1C1ONGR_enIN1099IN1099&gs_lcrp=EgZjaHJvbWUqCAgBEEUYJxg7MgYIABBFGDkyCAgBEEUYJxg7MggIAhBFGCcYOzIVCAMQLhhDGMcBGLEDGNEDGIAEGIoFMgoIBBAAGLEDGIAEMgYIBRBFGDwyBggGEEUYPTIGCAcQRRg90gEINDA4MmowajSoAgCwAgA&um=1&ie=UTF-8&fb=1&gl=in&sa=X&geocode=KYU7aM-2PSk6MQyDruwCU8PW&daddr=589M%2B9VM+Ajad+Market,+Risali,+Bhilai,+Chhattisgarh+490006'),
(9, 'Shivpriya Pyramid Dhyan Kendra', 18, 10, 'GK Township Near Guru Fuels Charoda Mod, Bilaspur Road', '6261968619, 93995441', '', 'https://search.google.com/local/writereview?placeid=ChIJhfOFKSnlKDoRsvKlLIMuBJM', 'https://www.youtube.com/watch?v=50_cAuCwiiA', 'https://www.google.com/maps?q=21.3833378,81.6703338&z=17&hl=en'),
(13, 'Kailash Dhyan Kendra', 19, 10, 'Jail Road Near Rashtriya Vidyalaya, Second Floor RIT Head Office', '9329773021', '', '', 'https://www.youtube.com/watch?v=Y2Kz1-z2ObY', ''),
(14, 'Ekta Pyramid Dhyan Center', 8, 2, 'Street Number 1A, Maitrinagar, Risali, Bhilai, Chhattisgarh 490006', '9399004492', '', 'https://search.google.com/local/writereview?placeid=ChIJVcuyGK08KToRRuvCjET_m_k', 'https://www.youtube.com/watch?v=hR1kQQ3a-8c', 'google.com/maps/dir//Street+Number+1A,+Maitrinagar,+Risali,+Bhilai,+Chhattisgarh+490006/@21.2619056,81.6190733,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x3a293cad18b2cb55:0xf99bff448cc2eb46!2m2!1d81.3384555!2d21.1668858?entry=ttu&g_ep=EgoyMDI2MDEwNy4wIKXMDSoASAFQAw%3D%3D'),
(15, 'Pawan Putra Pyramid', 10, 2, 'B Block', '9630526800, 94079091', '', '', '', ''),
(16, 'Maheshwara Pyramid Dhyan Kendra', 9, 2, 'Ruabandha Sector', '9131132688, 83192693', '', '', '', ''),
(17, 'Mahaveer Pyramid', 20, 10, 'Kanger Valley Academy', '9329773021, 93028730', '', '', '', ''),
(18, 'Patri Ji Pyramid', 21, 10, 'Near Bilaspur Road', '9575155301', '', '', '', ''),
(19, 'Shri Krishna Pyramid Dhyan Kendra', 22, 10, 'Arihant Nagar', '9755389162', '', '', '', ''),
(20, 'Vishwakarma Pyramid Dhyan Kendra', 23, 10, 'Near Shankar Nagar TV Tower', '9300679967, 94060074', '', '', '', ''),
(21, 'Patri Ji Meditation Center', 25, 10, 'Near Ring Road', '8602569165', '', '', '', ''),
(22, 'Zorba The Buddha Golden Pyramid', 25, 10, 'Near Katora Talab', '830590393934', '', '', '', ''),
(23, 'Bhagirathi Pyramid Dhyan Kendra', 27, 1, 'New Sarkanda', '7999281542', '', '', '', ''),
(24, 'PSSM Dhyan Kendra', 28, 1, 'Express Education Center', '9752475009', '', '', '', ''),
(25, 'Keshar Dhyan Kendra', 29, 1, 'Bahatarai', '8103054048, 62693613', '', '', '', ''),
(26, 'Sandhya Dhyan Kendra', 30, 1, 'Rajkishor Nagar', '8839813435', '', '', '', ''),
(27, 'Life Meditation Center', 31, 1, 'Railway Bunglow Yard', '9752475009', '', '', '', ''),
(28, 'Swasti Pyramid', 32, 12, 'Bagde Farm House', '7587338181, 94064037', '', '', '', ''),
(29, 'Sambhala Pyramid Dhyan Kendra', 33, 4, 'Krishna Vihar Colony', '7879640486, 90099399', '', '', '', ''),
(30, 'Dayanand Saraswati Dhyan Kendra', 34, 6, 'Ravishankar Shukla Nagar', '8839687743', '', '', '', ''),
(31, 'Maruti Jankalyan Pyramid Dhyan Kendra', 43, 3, 'Mahud-A', '8435552034, 82239009', '', '', '', ''),
(32, 'Shiv Shakti Pyramid', 44, 3, 'Kareli', '9425556767, 87708785', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `meditators`
--

CREATE TABLE `meditators` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `meditators`
--

INSERT INTO `meditators` (`id`, `name`, `address`, `city_id`, `area_id`, `contact`, `created_at`) VALUES
(1, 'Rachna Sahu', 'Sector-10', 2, 13, '8319696780', '2025-11-15 11:04:21'),
(3, 'Dinesh Kumar Verma', 'Paras Nagar Devendra Nagar Sector-3', 10, 26, '6261968619', '2025-11-16 10:41:58'),
(6, 'Vimala Mishra', 'Sector-6', 2, 14, '9329517424', '2026-01-11 12:29:55'),
(7, 'Neeta Ramtake', 'Maroda', 2, 15, '9993238301', '2026-01-11 12:30:30'),
(8, 'Puja Dhanwani', 'Vaishali Nagar', 2, 16, '9399282577', '2026-01-11 12:31:12'),
(9, 'Sunita Sahu', 'Raipur', 10, 19, '8817035772', '2026-01-11 12:48:45'),
(10, 'Suman Sahu', 'Raipur', 10, 19, '8871116522', '2026-01-11 12:49:17'),
(11, 'Kusum Sahu', 'Banki', 6, 35, '7724012390', '2026-01-12 09:28:00'),
(12, 'Dharmendra Gajendra', 'Jodhapur', 8, 36, '8770505865, 62659231', '2026-01-12 09:30:45'),
(13, 'Shrilekha Jadhav', 'Maratha Para', 8, 37, '9993677035', '2026-01-12 09:32:36'),
(14, 'Nilima Tiwari', 'Bamlai Para', 8, 38, '7805963037', '2026-01-12 09:33:35'),
(15, 'Kanti Nayar', 'Housing Board Colony', 8, 39, '9407926654', '2026-01-12 09:34:23'),
(16, 'Laxmi Sahu', 'New Rawan Bhata', 15, 40, '9407958851', '2026-01-12 09:37:06'),
(17, 'Chain Singh Pipariya', 'Temari', 15, 41, '7000121381', '2026-01-12 09:39:12'),
(18, 'Khilendra Sahu', 'Chingari', 3, 45, '9752305526', '2026-01-12 09:55:33'),
(19, 'Anjulata Tripathi', 'SAGES Anjora', 2, 46, '7000227918', '2026-01-12 09:58:09'),
(20, 'Sharda Sawai', 'Kharun Greens Colony', 2, 47, '9893151613', '2026-01-12 10:00:32'),
(21, 'Savita Sahu', 'Nipani', 3, 49, '8299708868', '2026-01-12 10:01:34'),
(22, 'Dharmendra Sahu', 'Jheent', 3, 49, '9981540866', '2026-01-12 10:02:33'),
(23, 'Mahendra Dwivedi', 'Om Krishi Kendra, Rasela Road', 16, 50, '9893159158', '2026-01-12 10:05:46'),
(24, 'Rekha Rathor', 'Pratap Pur', 17, 51, '7447054223', '2026-01-12 10:07:46'),
(25, 'Hemlata Pipariya', 'Bhatagaon-R', 18, 53, '7987079797', '2026-01-12 10:10:26'),
(26, 'Reena Netam', 'Mohla', 19, 55, '7089256475', '2026-01-12 10:13:27'),
(27, 'Sonu Yadu', 'Nawagarh', 20, 56, '9165463538', '2026-01-12 10:16:01'),
(28, 'Khubiram Sahu', 'Pahanda', 20, 57, '7987895819', '2026-01-12 10:16:52'),
(29, 'Durgesh Sahu', 'Pahanda', 20, 57, '9098506285', '2026-01-12 10:17:30'),
(30, 'Durgesh Sahu', 'Pahanda', 20, 57, '9098506285', '2026-01-12 10:17:30'),
(31, 'Bhojram Sahu', 'Pahanda', 20, 57, '7697540797', '2026-01-12 10:18:03'),
(32, 'Ajay Kumar Thakur', 'Jhiriya', 21, 58, '9827825994', '2026-01-12 10:20:32'),
(33, 'Tripti Yadav', 'SAGES Kuwakonda', 23, 59, '9340461659', '2026-01-12 10:23:20'),
(34, 'Rashmita Behara', 'Vrindavan Colony', 5, 60, '7978936596', '2026-01-13 06:16:50'),
(35, 'Kamini Chowrasiya', 'Vrindavan Colony', 5, 60, '9770118880', '2026-01-13 06:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `city_id`, `email`, `phone`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Super Admin', 0, 'admin@ekta.com', '9999999999', '$2y$10$MneAXHuZp3LIc7v3M1DclOgSUs8jXWvld0mqMyeQxvzIPxt.UFpXG', 'admin', 1, '2025-12-24 10:24:34'),
(26, 'Dinesh Kumar Verma', 10, '', '7509016505', '$2y$10$O8jQPdebEe5vNQmcV8J8F.dCdtsdE/oD/Gen0g3cz84f4MEhrVNh2', 'manager', 1, '2025-12-25 06:25:42'),
(27, 'Vimal', 2, '', '8770878527', '$2y$10$vlACDkH2E4vWS19LTc640uu8Mn7N.err5wkizJkz54EuQcWkSzEZS', 'manager', 1, '2026-01-06 08:03:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`city_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meditation_centers`
--
ALTER TABLE `meditation_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `meditators`
--
ALTER TABLE `meditators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
