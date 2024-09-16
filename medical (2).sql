-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 07:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `indications` varchar(255) NOT NULL,
  `precautions` varchar(255) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `Date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `Quantity` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `indications`, `precautions`, `storage`, `Date`, `Quantity`) VALUES
(8, 'cetrizine', 'antihistamine', 'avoid alchohol', 'store away from children', '2024-09-05 12:50:17.783308', '20'),
(9, 'flugone', 'cough syrup', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 12:38:47.381394', '-1'),
(10, 'good morning lung tonic', 'cough suppresant', 'avoid operating heavy machinery', 'store away from direct sunlight', '2024-09-05 11:51:32.289092', ''),
(11, 'flugone', 'capsules', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 11:51:38.286203', ''),
(13, 'cod liver oil', '2234', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 11:51:42.730474', ''),
(14, 'lipita', 'tablets', '', 'store away from direct sunlight', '2024-09-05 12:08:40.923465', ''),
(15, 'lipita', 'tablets', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 12:09:54.030702', ''),
(16, 'clopilet', 'tablets', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 12:12:08.636709', ''),
(17, 'abz', 'tablet', 'avoid alchohol', 'store away from direct sunlight', '2024-09-05 12:29:21.544252', '-1'),
(18, 'cgfjhy', 'gtdrt', 'sxthtjy', 'szhfrft', '2024-09-13 06:53:13.477999', '22'),
(19, 'panadol', 'tablets', 'avoid alchohol', 'store out of childrens reach', '2024-09-13 11:19:37.958926', '4');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `times` varchar(255) NOT NULL,
  `days_prescribed` varchar(255) NOT NULL,
  `number_refils` varchar(255) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `patient` varchar(250) NOT NULL,
  `date` varchar(255) NOT NULL,
  `quantity_given` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `user_id`, `patient`, `date`, `quantity_given`) VALUES
(3, 'Panadol', '2', '3', '5', '2', 'hello', '1', '', '2024-08-19 22:46:19', NULL),
(4, 'Panadol', '2', '3', '4', '2', 'hey', '1', '', '2024-08-19 22:47:23', NULL),
(5, 'Panadol', '2', '3', '4', '2', 'hey', '1', '', '2024-08-19 22:47:23', NULL),
(6, 'Panadol', '2', '3', '2', '2', 'hey', '1', '', '2024-08-19 22:58:36', NULL),
(7, 'Panadol', '2', '3', '4', '2', 'ddds', '1', 'patient', '2024-08-19 23:01:31', NULL),
(9, 'Panadol', '2', '3', '3', '2', 'fgfgf', '5', 'patient2', '2024-08-20 08:43:52', NULL),
(12, 'good morning lung tonic', '5ml', '3', '5', '0', 'avoid alchohol', '13', 'Denis Mageto', '2024-08-21 17:20:51', NULL),
(13, 'paracetamol', '2', '3', '3', '2', 'take after meals', '13', 'Denis Mageto', '2024-08-21 19:45:59', NULL),
(14, 'cetrizine', '1', '2', '5', '0', 'avoid alchohol', '13', 'Denis Mageto', '2024-08-22 08:53:44', NULL),
(15, 'cod liver oil', '5ml', '10', '3', '0', 'take after meals', '19', 'Fridah Jebet', '2024-08-22 11:32:06', NULL),
(16, 'flugone', '1', '3', '5', '1', 'avoid alchohol', '13', 'Denis Mageto', '2024-09-04 22:52:59', NULL),
(17, 'flugone', '-10', '3', '3', '1', 'No alcohol', '13', 'Denis Mageto', '2024-09-05 13:28:13', 10),
(18, 'flugone', '5ml', '3', '3', '1', 'No alcohol', '13', 'Denis Mageto', '2024-09-05 13:57:50', 1),
(19, 'flugone', '10ml', '3', '3', '1', 'No alcohol', '13', 'Denis Mageto', '2024-09-05 13:59:24', 1),
(20, 'abz', '1', '1', '1', '0', 'avoid alchohol', '13', 'Denis Mageto', '2024-09-05 14:20:37', 1),
(21, 'abz', '1', '1', '1', '0', 'avoid alchohol', '13', 'Denis Mageto', '2024-09-05 14:28:36', 15),
(22, 'flugone', '1', '2', '10', '0', 'avoid alchohol', '13', 'Denis Mageto', '2024-09-05 14:29:39', 20),
(23, 'cetrizine', '2', '3', '6', '0', 'avoid alcohol', '13', 'Denis Mageto', '2024-09-05 14:47:29', 16),
(24, 'panadol', '3', '3', '4', '2', 'avoid alchohol', '13', 'Denis Mageto', '2024-09-13 09:32:36', 12),
(25, 'panadol', '2', '2', '3', '0', 'avoid alchohol', '19', 'Betty Njuguna', '2024-09-13 09:56:35', 12),
(26, 'panadol', '2', '3', '4', '0', 'Don&#039;t drink alcohol', '19', 'Denis Mageto', '2024-09-13 13:17:43', 12);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` int(11) NOT NULL,
  `prescription_id` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `patient` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time_date_start` varchar(255) NOT NULL,
  `doctor` varchar(11) NOT NULL,
  `sent` varchar(250) DEFAULT NULL,
  `confirmation` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `prescription_id`, `phone`, `mode`, `status`, `patient`, `date`, `time_date_start`, `doctor`, `sent`, `confirmation`) VALUES
(45, '12', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '18:26', '13', 'sent', 'Confirmed'),
(46, '12', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '06:26', '13', NULL, 'Confirmed'),
(47, '13', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '20:53', '13', NULL, 'Confirmed'),
(48, '14', '+254104027586', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '09:58', '13', 'sent', ''),
(49, '14', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '10:00', '13', 'sent', ''),
(50, '12', '+254104027586', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '10:03', '13', 'sent', ''),
(51, '15', '+254784264101', 'Daily', 'Subscribe', 'Fridah Jebet', NULL, '12:40', '19', 'sent', 'Confirmed'),
(52, '15', '+254784264101', 'Daily', 'Subscribe', 'Fridah Jebet', NULL, '12:44', '19', 'sent', 'Confirmed'),
(53, '12', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '16:47', '13', 'sent', 'Confirmed'),
(54, '16', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '23:56', '13', 'sent', 'Confirmed'),
(55, '20', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '15:24', '13', 'sent', 'Confirmed'),
(56, '25', '+254788640786', 'Daily', 'Subscribe', 'Betty Njuguna', NULL, '11:03', '19', 'sent', 'Confirmed'),
(57, '26', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', NULL, '14:22', '19', 'sent', ''),
(58, '26', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', '2024-09-13', '16:00', '13', 'sent', ''),
(59, '22', '+254788640786', 'Daily', 'Subscribe', 'Denis Mageto', '2024-09-16', '19:41', '13', 'sent', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `recipient`, `message`, `date`) VALUES
(1, 'patient', 'doctor', 'hello', '2024-08-14 21:00:00.000000'),
(3, 'patient2', 'doctor', 'hello ', '2024-08-14 21:00:00.000000'),
(4, 'patient', 'doctor', 'helllo world', '2024-08-14 21:00:00.000000'),
(5, '&lt;br /&gt;\r\n&lt;b&gt;Warning&lt;/b&gt;:  Undefined variable $active_user_username in &lt;b&gt;C:\\xampp\\htdocs\\Medicine-tracker-system\\app\\reviews.php&lt;/b&gt; on line &lt;b&gt;16&lt;/b&gt;&lt;br /&gt;\r\n', 'patient', 'hello', '2024-08-19 20:36:44.000000'),
(6, 'patient', 'patient', 'ssssdd', '2024-08-19 20:40:01.000000'),
(7, 'doctor', 'doctor', 'hello sasa', '2024-08-19 20:52:36.000000'),
(8, 'patient', 'patient', 'hey', '2024-08-19 20:53:16.000000'),
(9, 'doctor2', 'doctor2', 'yooh', '2024-08-19 20:53:46.000000'),
(10, 'doctor', 'doctor', 'hello', '2024-08-19 21:03:47.000000'),
(11, 'doctor2', 'doctor2', 'hello too', '2024-08-19 21:04:33.000000'),
(12, 'levis', 'levis', 'hey', '2024-08-19 21:21:00.000000'),
(13, 'doctor', 'doctor', 'helllo', '2024-08-19 21:21:35.000000'),
(14, 'patient2', 'patient2', 'hey', '2024-08-19 21:23:35.000000'),
(15, 'Denis Mageto', 'Victoria Chebet', 'hello daktari', '2024-08-21 14:38:40.000000'),
(16, 'Victoria Chebet', 'Denis Mageto', 'hello denis', '2024-08-21 14:39:24.000000'),
(17, 'Carla Maritim', 'Victoria Chebet', 'hello', '2024-08-21 15:45:58.000000'),
(18, 'Victoria Chebet', 'Carla Maritim', 'hello too', '2024-08-21 15:46:35.000000'),
(19, 'Victoria Chebet', 'Denis Mageto', 'hello Denis', '2024-08-21 16:37:59.000000'),
(20, 'Denis Mageto', 'Victoria Chebet', 'Hello Daktari', '2024-08-21 16:39:02.000000'),
(21, 'admin', 'Victoria Chebet', 'you have an appointment with patient at 3:00 pm', '2024-08-21 17:12:12.000000'),
(22, 'admin', 'Victoria Chebet', 'hello daktari. please come in for a patient consultation at 4:00', '2024-08-22 08:24:45.000000'),
(23, 'Christopher Mapesa', 'Fridah Jebet', 'are you having any reaction to the medication prescribed', '2024-08-22 08:48:25.000000'),
(24, 'Fridah Jebet', 'Christopher Mapesa', 'No daktari I am not having a reaction', '2024-08-22 08:51:28.000000'),
(25, 'Christopher Mapesa', 'Denis Mageto', 'hello denis. did the swelling subside', '2024-08-22 08:57:50.000000'),
(26, 'Denis Mageto', 'Christopher Mapesa', 'yes it did daktari', '2024-08-22 08:58:35.000000'),
(27, 'Christopher Mapesa', 'Fridah Jebet', 'hello', '2024-08-22 09:22:54.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-11-10 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `gender`, `dob`, `image`, `role`, `password`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(1, 'admin', 'patricia@admin.com', '0704907555', 'Male', '1998-01-01', 'avatar2.jpg', 'Administrator', '$2y$10$.O.QO6INbmTM6XUeCZL5U.8pkucResT.eu7e4mCWG/4AsELs.7hKy', NULL, NULL, '2024-11-10 00:00:00', NULL),
(12, 'Denis Mageto', 'dmageto@gmail.com', '0700892739', '', '1990-09-20', 'GANTT 3.PNG', 'patient', '$2y$10$l2CK7QY4WZ2LLuq4BlUIsOPUbiR2NMRLceARtapAfMwkexgwhblNu', NULL, NULL, '2024-11-10 00:00:00', NULL),
(13, 'Victoria Chebet', 'vikkichevvy@gmail.com', '0796305039', '', '1995-03-22', 'avatar4.jpg', 'Doctor', '$2y$10$S5z6JgMRYMeBIJnnO0PyT.nAsJjsZcqAC7crDKOv0Bzg7aFcgPwte', NULL, NULL, '2024-11-10 00:00:00', NULL),
(14, 'Geoffrey Chepkwony', 'geff@gmail.com', '0722601686', '', '1967-11-30', 'avatar.jpg', 'Doctor', '$2y$10$d.bxLA9nWMpwoMoQQbzIE.mqwjll/cM5W/wYSqhzQ3g47xMcIrVMO', NULL, NULL, '2024-11-10 00:00:00', NULL),
(15, 'Florence Chepkwony', 'flockaptich@gmail.com', '0722234330', '', '1970-02-14', 'avatar3.jpg', 'patient', '$2y$10$4UcI3AvskoDS/HS33OKf9.hie5.TFdjJ8096yNyc3c8Yspc/Kwh.m', NULL, NULL, '2024-11-10 00:00:00', NULL),
(16, 'Carla Maritim', 'carlamaritim@gmail.com', '0700892737', '', '2001-07-12', 'avatar2.jpg', 'patient', '$2y$10$Aaful56DIq2WuE4oBwdfQuoqGuuRv3PUn3mbBia7drPYlgTcz3fii', NULL, NULL, '2024-11-10 00:00:00', NULL),
(18, 'Fridah Jebet', 'fridah@gmail.com', '0700892737', '', '2012-12-05', 'WhatsApp Image 2024-05-05 at 15.40.21 (1).jpg', 'patient', '$2y$10$JYyovX5kzh9/TEHPz0WGBus8YGdbiD.tQb8l0typuAZ5.qldtkbea', NULL, NULL, '2024-11-10 00:00:00', NULL),
(19, 'Christopher Mapesa', 'cmapesa@cuea.edu', '0721851654', '', '1987-12-05', 'proposed system flowchart.PNG', 'Doctor', '$2y$10$2uHbUKRu5FDxXDjJLpUVLORaMKsttTKqIx00OMCQW.hkbk0DA9cHC', NULL, NULL, '2024-11-10 00:00:00', NULL),
(20, 'Susan', 'susan.nyabate@gmail.com', '0700892737', '', '1991-03-23', '', 'Pharmacist', '$2y$10$eVEUJnfqUBbuHHLHIl5ZW.ao7dVNHVtbtfUqcdgsQx0r7dmRtFvYq', NULL, NULL, '2024-11-10 00:00:00', NULL),
(21, 'Evance', 'evance@gmail.com', '070083456', '', '1991-01-01', '', 'Administrator', '$2y$10$jvIxx8FHII5eqcAPwM40aOhurABuy3n6PUlfsOOthjaZ7H6teHgOq', NULL, NULL, '2024-11-10 00:00:00', NULL),
(22, 'Judy', 'judy@gmail.com', '0700892737', '', '1985-09-05', '', 'Pharmacist', '$2y$10$TkLb6H38O67/0kcsHuSbrOm9J9LvJsjUwmXeaIljGTbuI6FbWenn2', NULL, NULL, '2024-11-10 00:00:00', NULL),
(23, 'Jemimah Nduati', 'jemimah@cuea.edu', '0796305039', '', '2014-09-01', '', 'Doctor', '$2y$10$lmGDpA4MaUBaY2lLyHFz9OgYNbjIhDLiVX524/Wr1c/TjsXsnTrHy', NULL, NULL, '2024-11-10 00:00:00', NULL),
(24, 'Dan Ndiwa', 'dan@gmail.com', '0796305039', '', '2014-09-05', '', 'Doctor', '$2y$10$.b20KaJ36B4/jCwW1bY2eO903nfOPsCGqn2o/BXSXSlOEBZW.MLT2', NULL, NULL, '2024-11-10 00:00:00', NULL),
(25, 'Diana Kerubo', 'diana@gmail.com', '0700892739', '', '2014-09-06', '', 'Pharmacist', '$2y$10$HMRLdzIQdwyaEeG6XYavtOX1awLiHpck1ruwdUdm4oc4XMp9vd9Ye', NULL, NULL, '2024-11-10 00:00:00', NULL),
(26, 'Betty Njuguna', 'bnjuguna@cuea.edu', '+254788640786', '', '2014-09-06', '', 'patient', '$2y$10$i71drmSj2bmucIQkiolO4uco4TfFow8CjSKsez7P.dYabGnnoE5TO', NULL, NULL, '2024-11-10 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
