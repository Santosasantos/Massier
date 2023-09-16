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
-- Database: `project_massier`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `mess_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `balance_type` enum('meal','month') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `date`, `mess_id`, `email`, `amount`, `balance_type`) VALUES
(1, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 1000, 'meal'),
(2, '2023-09-13', 1, 'shishir2515@student.nstu.edu.bd', 1000, 'month'),
(3, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 1111, 'meal'),
(4, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 12, 'meal'),
(5, '2023-09-13', 1, 'shishir2515@student.nstu.edu.bd', 100, 'month'),
(6, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 100, 'meal'),
(7, '2023-09-13', 1, 'shishir2515@student.nstu.edu.bd', 1234, 'meal'),
(8, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 60, 'meal'),
(9, '2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 1000, 'meal'),
(10, '2023-09-14', 1, 'hasanur.rahman.shishir.iit@gmail.com', 100, 'meal'),
(11, '2023-09-14', 1, 'shishir2515@student.nstu.edu.bd', 1000, 'meal'),
(12, '2023-09-15', 1, 'hasanur.rahman.shishir.iit@gmail.com', 100, 'meal'),
(13, '2023-09-17', 1, 'hasanur.rahman.shishir.iit@gmail.com', 1000, 'meal');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `cost_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `mess_id` int(11) NOT NULL,
  `type` enum('house_rent','gas_bill','electricity_bill','water_bill','maid_bill','internet_bill','caretaker_bill','others') NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `date`, `mess_id`, `type`, `description`, `amount`) VALUES
(29, '2023-09-17', 1, 'house_rent', '', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `exp_id` int(11) NOT NULL,
  `date_of_req` date NOT NULL,
  `date_of_approve` date NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `status` enum('approved','pending') NOT NULL,
  `email` varchar(50) NOT NULL,
  `mess_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`exp_id`, `date_of_req`, `date_of_approve`, `amount`, `description`, `status`, `email`, `mess_id`) VALUES
(1, '2023-09-13', '2023-09-13', 100, 'rice', 'approved', 'shishir2515@student.nstu.edu.bd', 1),
(2, '2023-09-13', '2023-09-13', 80, 'rice', 'approved', 'shishir2515@student.nstu.edu.bd', 1),
(3, '2023-09-16', '2023-09-16', 100, 'rice', 'approved', 'shishir2515@student.nstu.edu.bd', 1),
(4, '2023-09-16', '2023-09-16', 100, 'oil', 'approved', 'shishir2515@student.nstu.edu.bd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `manager_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `starting_date` date NOT NULL,
  `closing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`manager_id`, `mess_id`, `email`, `starting_date`, `closing_date`) VALUES
(1, 1, 'hasanur.rahman.shishir.iit@gmail.com', '2023-09-12', '0000-00-00'),
(2, 2, 'hasanur.rahman.shishir.iit@gmail.com', '2023-09-13', '0000-00-00'),
(3, 3, 'hrshishir6875@gmail.com', '2023-09-16', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `date` date NOT NULL,
  `mess_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lunch` int(11) NOT NULL,
  `breakfast` int(11) NOT NULL,
  `dinner` int(11) NOT NULL,
  `status` enum('approved','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`date`, `mess_id`, `email`, `lunch`, `breakfast`, `dinner`, `status`) VALUES
('2023-09-12', 1, 'hasanur.rahman.shishir.iit@gmail.com', 2, 10, 1, 'approved'),
('2023-09-13', 1, 'hasanur.rahman.shishir.iit@gmail.com', 10, 0, 0, 'approved'),
('2023-09-13', 1, 'shishir2515@student.nstu.edu.bd', 1, 1, 10, 'approved'),
('2023-09-14', 1, 'hasanur.rahman.shishir.iit@gmail.com', 1, 1, 1, 'approved'),
('2023-09-14', 1, 'shishir2515@student.nstu.edu.bd', 1, 0, 0, 'approved'),
('2023-09-15', 1, 'hasanur.rahman.shishir.iit@gmail.com', 0, 0, 0, 'approved'),
('2023-09-15', 1, 'shishir2515@student.nstu.edu.bd', 2, 0, 0, 'approved'),
('2023-09-16', 1, 'hasanur.rahman.shishir.iit@gmail.com', 0, 0, 0, 'approved'),
('2023-09-16', 1, 'shishir2515@student.nstu.edu.bd', 0, 0, 0, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `mess`
--

CREATE TABLE `mess` (
  `mess_id` int(11) NOT NULL,
  `mess_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mess`
--

INSERT INTO `mess` (`mess_id`, `mess_name`, `address`) VALUES
(1, 'dremers', 'noakhali'),
(2, 'mess1', 'n'),
(3, 'nstu101', 'Housing');

-- --------------------------------------------------------

--
-- Table structure for table `mess_members`
--

CREATE TABLE `mess_members` (
  `mess_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('member','manager','ex_member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mess_members`
--

INSERT INTO `mess_members` (`mess_id`, `email`, `role`) VALUES
(1, 'hasanur.rahman.shishir.iit@gmail.com', 'member'),
(1, 'rabiulislamsanto.nstu@gmail.com', 'member'),
(1, 'shishir2515@student.nstu.edu.bd', 'manager'),
(2, 'hasanur.rahman.shishir.iit@gmail.com', 'manager'),
(2, 'shishir2515@student.nstu.edu.bd', 'member'),
(3, 'hasanur.rahman.shishir.iit@gmail.com', 'member'),
(3, 'hrshishir6875@gmail.com', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `reset_token` varchar(100) NOT NULL,
  `reset_expire` date NOT NULL,
  `login_token` varchar(100) NOT NULL,
  `login_expire` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `dob`, `name`, `address`, `reset_token`, `reset_expire`, `login_token`, `login_expire`) VALUES
('hasanur.rahman.shishir.iit@gmail.com', '$2y$10$xqZCIXQVFjCk1pO46EUjO.0wtsBXO/I/yjZaCvVN7B7plLltgApMu', '2000-09-12', 'Shishir', '', '728b63b9c22e69338d92976ccb267435', '2023-09-15', '382c2659f4483918aea2b093c18b0156fe4b7682df01d6aa251a2ce854d87ca2', '0000-00-00'),
('hrshishir6875@gmail.com', '$2y$10$3auHTa95l7IzmA4xA50R7uzk.dAq94iUGFRzyXPsWOinwHaYcqRT.', '2000-09-18', 'wakil', '', '9f262670abf76192716aaa445974e6c4', '2023-09-17', '6cfea991d177ab5d51b997836b8c66e9d1b9159fe505a522bb72a7b1306308ad', '0000-00-00'),
('rabiulislamsanto.nstu@gmail.com', '$2y$10$LFPU9tr7eJab26bjXCRpoufnAxym6Gq.Vv/NOW/k8iCBTFbehzvkK', '2000-09-18', 'Md. Rabiul Islam Santo', '', '', '0000-00-00', 'cac3ca8f257728acf268530a7c3196320a7bdbbbc508ec0e93db72048c842347', '0000-00-00'),
('shishir2515@student.nstu.edu.bd', '$2y$10$eizCWBntD0XCSg.jYnu9l.0T1WhO7FKZtXsyvs8vSjM8jdiDsjg72', '2023-09-14', 'sanwar', '', '', '0000-00-00', '969c91c49fc9696a4b6b225681b1da0e9286b730ee41c38b71517d0a6399e719', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `balance email` (`email`),
  ADD KEY `balance mess id` (`mess_id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `cost for mess` (`mess_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `expense  email` (`email`),
  ADD KEY `expense mess id` (`mess_id`);

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `manages email` (`email`),
  ADD KEY `manager mess id` (`mess_id`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`date`,`mess_id`,`email`),
  ADD KEY `mess_id` (`mess_id`),
  ADD KEY `meal prvider` (`email`);

--
-- Indexes for table `mess`
--
ALTER TABLE `mess`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `mess_members`
--
ALTER TABLE `mess_members`
  ADD PRIMARY KEY (`mess_id`,`email`),
  ADD KEY `mess_member email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manages`
--
ALTER TABLE `manages`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `balance mess id` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost for mess` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense  email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `expense mess id` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE;

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `manager mess id` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `manages email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `meal`
--
ALTER TABLE `meal`
  ADD CONSTRAINT `meal prvider` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mess_id` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE;

--
-- Constraints for table `mess_members`
--
ALTER TABLE `mess_members`
  ADD CONSTRAINT `mess members id` FOREIGN KEY (`mess_id`) REFERENCES `mess` (`mess_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mess_member email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
