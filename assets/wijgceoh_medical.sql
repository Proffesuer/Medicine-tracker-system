-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2024 at 10:43 PM
-- Server version: 8.0.36
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wijgceoh_medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int NOT NULL,
  `medicine_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `indications` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `precautions` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `storage` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `medicine_name`, `indications`, `precautions`, `storage`, `Date`) VALUES
(1, 'Panadol', 'panadol indication', 'Avoid alcohol', 'Store in a Cool Dry Place', '2024-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int NOT NULL,
  `medicine` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `times` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `days_prescribed` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `number_refils` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `instructions` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `patient` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `doctor` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `doctor`, `date`) VALUES
(2, 'Panadol', '3', '3', '5', '5', 'hello world', 'patient2', 'doctor', '2024-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `id` int NOT NULL,
  `prescription_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `patient` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `prescription_id`, `phone`, `mode`, `status`, `patient`, `time`) VALUES
(3, '1', '0704907555', 'Daily', 'Subscribe', 'patient', ''),
(4, '2', '0704907555', 'Daily', 'Subscribe', 'patient2', '13:00:00'),
(5, '1', '0704907555', 'Once', 'Subscribe', 'patient', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `patient` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dcotor` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `patient`, `dcotor`, `message`, `date`) VALUES
(1, 'patient', 'doctor', 'hello', '2024-08-15'),
(3, 'patient2', 'doctor', 'hello ', '2024-08-15'),
(4, 'patient', 'doctor', 'helllo world', '2024-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `DOB` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login_session_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-11-10 00:00:00',
  `password_reset_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `gender`, `DOB`, `image`, `role`, `password`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(1, 'admin', 'patricia@admin.com', '0704907555', 'Male', '1998-01-01', 'http://localhost/Medicine-tracker-system/uploads/files/rugjocefk086a2x.JPG', 'Administrator', '$2y$10$.O.QO6INbmTM6XUeCZL5U.8pkucResT.eu7e4mCWG/4AsELs.7hKy', NULL, NULL, '2024-11-10 00:00:00', NULL),
(2, 'patient', 'patient@gmail.com', '0722925404', 'Female', '12/17/1998', 'http://localhost/Medicine-tracker-system/uploads/files/z6cueobt89w5rmn.JPG', 'patient', '$2y$10$Hvcl6sCbEcs.NCtrcirKcuv9YQlAWvioYQscrOpYvLKClmaqxKPPy', NULL, NULL, '2024-11-10 00:00:00', NULL),
(3, 'doctor', 'doctor@gmail.com', '0728678982', 'Female', '12/17/1998', 'http://localhost/Medicine-tracker-system/uploads/files/dckbvrp4wzsi3m0.JPG', 'Doctor', '$2y$10$G6U03WYwsCBWuHl7Ak8Q8uI5SaD2MzTr54v/rwIZTr72FEnhc6q8i', NULL, NULL, '2024-11-10 00:00:00', NULL),
(4, 'patient2', 'patient2@gmail.com', '0793983823', 'Female', '12/17/1998', 'http://localhost/Medicine-tracker-system/uploads/files/gbc26_ua9qv1yws.JPG', 'patient', '$2y$10$q0IRNgbDODOWoBtAP7yT3eIBk9Yuyi/t4rrjgllkXSWPqlmWauONK', NULL, NULL, '2024-11-10 00:00:00', NULL),
(5, 'doctor2', 'doctor2@gmail.com', '0728678982', 'Female', '2014-08-03', '', 'Doctor', '$2y$10$p1M9VyXfDyiUQ9wM451bUuf5tZFDQZ1dpqJgVsZDeKsXT4cRjRH/S', NULL, NULL, '2024-11-10 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
