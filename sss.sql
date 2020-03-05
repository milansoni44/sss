-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 05:15 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sss`
--

-- --------------------------------------------------------

--
-- Table structure for table `demises`
--

CREATE TABLE `demises` (
  `id` int(11) NOT NULL,
  `demise_of_Member_id` int(11) NOT NULL,
  `institute_fee` varchar(30) NOT NULL,
  `fee_given_by` int(11) NOT NULL,
  `deminses_fee` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `administrative_fee` varchar(50) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_fee_paid` decimal(14,2) NOT NULL,
  `balance_due` decimal(14,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `fee_flag` enum('MEMBER_FEE','INSTITUTE_FEE','DEMISE_FEE','NOMINEE_FEE') NOT NULL DEFAULT 'MEMBER_FEE' COMMENT 'MEMBER_FEE | INSTITUTE_FEE | DEMISE_FEE|NOMINEE_FEE',
  `demise_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `membership_fee_paid`, `balance_due`, `created_at`, `fee_flag`, `demise_user_id`) VALUES
(1, 2, '1500.00', '0.00', '2020-02-29 23:02:35', 'MEMBER_FEE', NULL),
(2, 3, '1500.00', '0.00', '2020-02-29 23:02:35', 'MEMBER_FEE', NULL),
(3, 4, '1500.00', '0.00', '2020-02-29 23:02:41', 'MEMBER_FEE', NULL),
(5, 3, '50.00', '0.00', '2020-03-04 21:46:26', 'NOMINEE_FEE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reset` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `status` enum('Pending','Active','Deactive','') DEFAULT NULL,
  `insert_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'User',
  `address` varchar(1024) DEFAULT NULL,
  `nominee1` varchar(1024) DEFAULT NULL,
  `nominee2` varchar(1024) DEFAULT NULL,
  `nominee1_reimbursement` varchar(1024) DEFAULT NULL,
  `nominee2_reimbursement` varchar(1024) DEFAULT NULL,
  `membership_fee` decimal(14,2) NOT NULL DEFAULT 0.00,
  `inactivity_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `name`, `user_name`, `password`, `reset`, `email`, `mobile`, `status`, `insert_date`, `update_date`, `user_type`, `address`, `nominee1`, `nominee2`, `nominee1_reimbursement`, `nominee2_reimbursement`, `membership_fee`, `inactivity_date`) VALUES
(1, 'Horus CRM', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 'test@gmail.com', '8866748587', 'Active', '2018-07-05 09:24:27', '2019-12-28 06:15:07', 'Admin', NULL, 'Sister', 'Brother', '50', '50', '0.00', NULL),
(2, 'Milan Soni', 'Milan', 'd1f6648a66b1e7c82e34dd142e8a0330', NULL, 'ravip@gmail.com', '8866739817', 'Active', '2018-12-11 15:39:14', '2020-02-29 18:20:38', 'Advance deposite', 'Ahmedabad', 'Sister', 'Brother', '50', '50', '1500.00', '2020-12-25'),
(3, 'Mehul Patel', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'snehalhello@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 08:28:17', 'Cheque', 'Kadi', 'Sister', 'Brother', '50', '50', '1500.00', '2021-03-31'),
(4, 'Ronak Gajjar', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'snehalhello@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 18:20:44', 'Cheque', 'Maninagar', 'Sister', 'Brother', '50', '50', '1500.00', '2021-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demises`
--
ALTER TABLE `demises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demises`
--
ALTER TABLE `demises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
