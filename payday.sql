-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 08:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payday`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`employee_id`, `name`, `salary`) VALUES
(1, 'Ermal', 50000),
(2, 'Ergest', 50000),
(3, 'Adela', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `specific_days`
--

CREATE TABLE `specific_days` (
  `day_id` int(11) NOT NULL,
  `day_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specific_days`
--

INSERT INTO `specific_days` (`day_id`, `day_type`) VALUES
(1, 'usual'),
(2, 'weekend'),
(3, 'holiday');

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `hours_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours` double NOT NULL,
  `employee_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `working_days`
--

INSERT INTO `working_days` (`hours_id`, `date`, `hours`, `employee_id`, `day_id`) VALUES
(1, '2021-03-17', 8, 1, 1),
(2, '2021-03-17', 8, 2, 1),
(3, '2021-03-17', 8, 3, 1),
(4, '2021-03-18', 9, 1, 1),
(5, '2021-03-18', 9, 2, 1),
(6, '2021-03-18', 4, 3, 1),
(7, '2021-03-19', 4, 2, 1),
(8, '2021-03-19', 8, 3, 1),
(9, '2021-03-20', 8, 3, 2),
(10, '2021-03-22', 8, 1, 3),
(11, '2021-03-22', 8, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `specific_days`
--
ALTER TABLE `specific_days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`hours_id`),
  ADD KEY `day_id` (`employee_id`),
  ADD KEY `day_id_2` (`day_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specific_days`
--
ALTER TABLE `specific_days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `hours_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
