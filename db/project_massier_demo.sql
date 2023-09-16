-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2023 at 12:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_massier_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_demo`
--

CREATE TABLE `user_demo` (
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `verify_otp` varchar(100) NOT NULL,
  `verify_expire` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_demo`
--

INSERT INTO `user_demo` (`email`, `password`, `dob`, `address`, `name`, `verify_otp`, `verify_expire`) VALUES
('hrshishir6875@gmail.com', '$2y$10$K89xxJYAMx9gNlJwy/S1yeUegIK8S4V6sdu6yAuO.Mvrn2LZWIYkW', '2000-09-18', '', 'wakil', '726984', '2023-09-17'),
('rabiulislamsanto.nstu@gmail.com', '$2y$10$LFPU9tr7eJab26bjXCRpoufnAxym6Gq.Vv/NOW/k8iCBTFbehzvkK', '2000-09-18', '', 'Md. Rabiul Islam Santo', '204508', '2023-09-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_demo`
--
ALTER TABLE `user_demo`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
