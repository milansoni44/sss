-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 06:10 PM
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
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `balance` decimal(14,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `name`, `balance`, `created_at`) VALUES
(1, 'Administrative', '450.00', '2020-03-06 09:42:48'),
(2, 'Nominee Change', '0.00', '2020-03-06 09:42:48'),
(3, 'Institute', '360.00', '2020-03-06 09:43:01'),
(4, 'Penalty', '0.00', '2020-03-06 09:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `periodic_email`
--

CREATE TABLE `periodic_email` (
  `id` int(11) NOT NULL,
  `member_email` varchar(200) DEFAULT NULL,
  `subject` varchar(300) DEFAULT NULL,
  `body` mediumtext DEFAULT NULL,
  `attempts` tinyint(4) DEFAULT 0,
  `is_sent` varchar(20) NOT NULL DEFAULT 'No' COMMENT 'Yes/No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `periodic_email_attachments`
--

CREATE TABLE `periodic_email_attachments` (
  `id` int(11) NOT NULL,
  `periodic_email_id` int(11) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `json_payload` text DEFAULT NULL,
  `view_file_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(14,2) DEFAULT NULL,
  `ledger_id` int(11) DEFAULT NULL,
  `demise_user_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `status` enum('PAID','UNPAID') NOT NULL DEFAULT 'UNPAID' COMMENT 'PAID|UNPAID',
  `type` enum('Debit','Credit') NOT NULL DEFAULT 'Debit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `ledger_id`, `demise_user_id`, `date_created`, `date_paid`, `payment_mode`, `status`, `type`) VALUES
(1, 2, '120.00', 3, NULL, '2020-03-07 18:38:37', NULL, 'Deposite', 'PAID', 'Debit'),
(2, 2, '90.00', 1, NULL, '2020-03-07 18:38:37', NULL, 'Deposite', 'PAID', 'Debit'),
(3, 3, '120.00', 3, NULL, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(4, 3, '100.00', NULL, 10, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(5, 3, '100.00', NULL, 12, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(6, 3, '100.00', NULL, 25, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(7, 3, '100.00', NULL, 30, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(8, 3, '90.00', 1, NULL, '2020-03-07 18:38:37', NULL, 'CHEQUE', 'PAID', 'Debit'),
(9, 4, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(10, 4, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(11, 4, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(12, 4, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(13, 4, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(14, 4, '90.00', 1, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(15, 5, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(16, 5, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(17, 5, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(18, 5, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(19, 5, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(20, 5, '90.00', 1, NULL, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(21, 6, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(22, 6, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(23, 6, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(24, 6, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(25, 6, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(26, 6, '90.00', 1, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(27, 7, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(28, 7, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(29, 7, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(30, 7, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(31, 7, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(32, 7, '90.00', 1, NULL, '2020-03-07 18:38:38', NULL, 'CHEQUE', 'PAID', 'Debit'),
(33, 8, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(34, 8, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(35, 8, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(36, 8, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(37, 8, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(38, 8, '90.00', 1, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(39, 9, '120.00', 3, NULL, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(40, 9, '100.00', NULL, 10, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(41, 9, '100.00', NULL, 12, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(42, 9, '100.00', NULL, 25, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(43, 9, '100.00', NULL, 30, '2020-03-07 18:38:38', NULL, NULL, 'UNPAID', 'Debit'),
(44, 9, '90.00', 1, NULL, '2020-03-07 18:38:39', NULL, NULL, 'UNPAID', 'Debit'),
(45, 11, '120.00', 3, NULL, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(46, 11, '100.00', NULL, 10, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(47, 11, '100.00', NULL, 12, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(48, 11, '100.00', NULL, 25, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(49, 11, '100.00', NULL, 30, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(50, 11, '90.00', 1, NULL, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(51, 13, '120.00', 3, NULL, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(52, 13, '100.00', NULL, 10, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(53, 13, '100.00', NULL, 12, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(54, 13, '100.00', NULL, 25, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(55, 13, '100.00', NULL, 30, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(56, 13, '90.00', 1, NULL, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(57, 14, '120.00', 3, NULL, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(58, 14, '100.00', NULL, 10, '2020-03-07 18:38:39', NULL, 'Deposite', 'PAID', 'Debit'),
(59, 14, '100.00', NULL, 12, '2020-03-07 18:38:40', NULL, 'Deposite', 'PAID', 'Debit'),
(60, 14, '100.00', NULL, 25, '2020-03-07 18:38:40', NULL, 'Deposite', 'PAID', 'Debit'),
(61, 14, '100.00', NULL, 30, '2020-03-07 18:38:40', NULL, 'Deposite', 'PAID', 'Debit'),
(62, 14, '90.00', 1, NULL, '2020-03-07 18:38:40', NULL, 'Deposite', 'PAID', 'Debit'),
(63, 15, '120.00', 3, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(64, 15, '100.00', NULL, 10, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(65, 15, '100.00', NULL, 12, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(66, 15, '100.00', NULL, 25, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(67, 15, '100.00', NULL, 30, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(68, 15, '90.00', 1, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(69, 16, '120.00', 3, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(70, 16, '100.00', NULL, 10, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(71, 16, '100.00', NULL, 12, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(72, 16, '100.00', NULL, 25, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(73, 16, '100.00', NULL, 30, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(74, 16, '90.00', 1, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(75, 17, '120.00', 3, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(76, 17, '100.00', NULL, 10, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(77, 17, '100.00', NULL, 12, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(78, 17, '100.00', NULL, 25, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(79, 17, '100.00', NULL, 30, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(80, 17, '90.00', 1, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(81, 18, '120.00', 3, NULL, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(82, 18, '100.00', NULL, 10, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(83, 18, '100.00', NULL, 12, '2020-03-07 18:38:40', NULL, NULL, 'UNPAID', 'Debit'),
(84, 18, '100.00', NULL, 25, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(85, 18, '100.00', NULL, 30, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(86, 18, '90.00', 1, NULL, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(87, 19, '120.00', 3, NULL, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(88, 19, '100.00', NULL, 10, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(89, 19, '100.00', NULL, 12, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(90, 19, '100.00', NULL, 25, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(91, 19, '100.00', NULL, 30, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(92, 19, '90.00', 1, NULL, '2020-03-07 18:38:41', NULL, NULL, 'UNPAID', 'Debit'),
(93, 20, '120.00', 3, NULL, '2020-03-07 18:38:41', NULL, 'Deposite', 'PAID', 'Debit'),
(94, 20, '100.00', NULL, 10, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(95, 20, '100.00', NULL, 12, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(96, 20, '100.00', NULL, 25, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(97, 20, '100.00', NULL, 30, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(98, 20, '90.00', 1, NULL, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(99, 21, '120.00', 3, NULL, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(100, 21, '100.00', NULL, 10, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(101, 21, '100.00', NULL, 12, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(102, 21, '100.00', NULL, 25, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(103, 21, '100.00', NULL, 30, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(104, 21, '90.00', 1, NULL, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(105, 22, '120.00', 3, NULL, '2020-03-07 18:38:42', NULL, 'Deposite', 'PAID', 'Debit'),
(106, 22, '100.00', NULL, 10, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(107, 22, '100.00', NULL, 12, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(108, 22, '100.00', NULL, 25, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(109, 22, '100.00', NULL, 30, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(110, 22, '90.00', 1, NULL, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(111, 23, '120.00', 3, NULL, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(112, 23, '100.00', NULL, 10, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(113, 23, '100.00', NULL, 12, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(114, 23, '100.00', NULL, 25, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(115, 23, '100.00', NULL, 30, '2020-03-07 18:38:43', NULL, 'Deposite', 'PAID', 'Debit'),
(116, 23, '90.00', 1, NULL, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(117, 24, '120.00', 3, NULL, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(118, 24, '100.00', NULL, 10, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(119, 24, '100.00', NULL, 12, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(120, 24, '100.00', NULL, 25, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(121, 24, '100.00', NULL, 30, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(122, 24, '90.00', 1, NULL, '2020-03-07 18:38:44', NULL, 'Deposite', 'PAID', 'Debit'),
(123, 26, '120.00', 3, NULL, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(124, 26, '100.00', NULL, 10, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(125, 26, '100.00', NULL, 12, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(126, 26, '100.00', NULL, 25, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(127, 26, '100.00', NULL, 30, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(128, 26, '90.00', 1, NULL, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(129, 27, '120.00', 3, NULL, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(130, 27, '100.00', NULL, 10, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(131, 27, '100.00', NULL, 12, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(132, 27, '100.00', NULL, 25, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(133, 27, '100.00', NULL, 30, '2020-03-07 18:38:44', NULL, NULL, 'UNPAID', 'Debit'),
(134, 27, '90.00', 1, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(135, 28, '120.00', 3, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(136, 28, '100.00', NULL, 10, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(137, 28, '100.00', NULL, 12, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(138, 28, '100.00', NULL, 25, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(139, 28, '100.00', NULL, 30, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(140, 28, '90.00', 1, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(141, 29, '120.00', 3, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(142, 29, '100.00', NULL, 10, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(143, 29, '100.00', NULL, 12, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(144, 29, '100.00', NULL, 25, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(145, 29, '100.00', NULL, 30, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(146, 29, '90.00', 1, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(147, 31, '120.00', 3, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(148, 31, '100.00', NULL, 10, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(149, 31, '100.00', NULL, 12, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(150, 31, '100.00', NULL, 25, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(151, 31, '100.00', NULL, 30, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(152, 31, '90.00', 1, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(153, 32, '120.00', 3, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(154, 32, '100.00', NULL, 10, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(155, 32, '100.00', NULL, 12, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(156, 32, '100.00', NULL, 25, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(157, 32, '100.00', NULL, 30, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(158, 32, '90.00', 1, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(159, 33, '120.00', 3, NULL, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(160, 33, '100.00', NULL, 10, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(161, 33, '100.00', NULL, 12, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(162, 33, '100.00', NULL, 25, '2020-03-07 18:38:45', NULL, NULL, 'UNPAID', 'Debit'),
(163, 33, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(164, 33, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(165, 34, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(166, 34, '100.00', NULL, 10, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(167, 34, '100.00', NULL, 12, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(168, 34, '100.00', NULL, 25, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(169, 34, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(170, 34, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(171, 35, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(172, 35, '100.00', NULL, 10, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(173, 35, '100.00', NULL, 12, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(174, 35, '100.00', NULL, 25, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(175, 35, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(176, 35, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(177, 36, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(178, 36, '100.00', NULL, 10, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(179, 36, '100.00', NULL, 12, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(180, 36, '100.00', NULL, 25, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(181, 36, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(182, 36, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(183, 37, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(184, 37, '100.00', NULL, 10, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(185, 37, '100.00', NULL, 12, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(186, 37, '100.00', NULL, 25, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(187, 37, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(188, 37, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(189, 38, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(190, 38, '100.00', NULL, 10, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(191, 38, '100.00', NULL, 12, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(192, 38, '100.00', NULL, 25, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(193, 38, '100.00', NULL, 30, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(194, 38, '90.00', 1, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(195, 39, '120.00', 3, NULL, '2020-03-07 18:38:46', NULL, NULL, 'UNPAID', 'Debit'),
(196, 39, '100.00', NULL, 10, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(197, 39, '100.00', NULL, 12, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(198, 39, '100.00', NULL, 25, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(199, 39, '100.00', NULL, 30, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(200, 39, '90.00', 1, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(201, 40, '120.00', 3, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(202, 40, '100.00', NULL, 10, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(203, 40, '100.00', NULL, 12, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(204, 40, '100.00', NULL, 25, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(205, 40, '100.00', NULL, 30, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(206, 40, '90.00', 1, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(207, 41, '120.00', 3, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(208, 41, '100.00', NULL, 10, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(209, 41, '100.00', NULL, 12, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(210, 41, '100.00', NULL, 25, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(211, 41, '100.00', NULL, 30, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(212, 41, '90.00', 1, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(213, 42, '120.00', 3, NULL, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(214, 42, '100.00', NULL, 10, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(215, 42, '100.00', NULL, 12, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(216, 42, '100.00', NULL, 25, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(217, 42, '100.00', NULL, 30, '2020-03-07 18:38:47', NULL, NULL, 'UNPAID', 'Debit'),
(218, 42, '90.00', 1, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(219, 43, '120.00', 3, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(220, 43, '100.00', NULL, 10, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(221, 43, '100.00', NULL, 12, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(222, 43, '100.00', NULL, 25, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(223, 43, '100.00', NULL, 30, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(224, 43, '90.00', 1, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(225, 44, '120.00', 3, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(226, 44, '100.00', NULL, 10, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(227, 44, '100.00', NULL, 12, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(228, 44, '100.00', NULL, 25, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(229, 44, '100.00', NULL, 30, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(230, 44, '90.00', 1, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(231, 45, '120.00', 3, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(232, 45, '100.00', NULL, 10, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(233, 45, '100.00', NULL, 12, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(234, 45, '100.00', NULL, 25, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(235, 45, '100.00', NULL, 30, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(236, 45, '90.00', 1, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(237, 46, '120.00', 3, NULL, '2020-03-07 18:38:48', NULL, NULL, 'UNPAID', 'Debit'),
(238, 46, '100.00', NULL, 10, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(239, 46, '100.00', NULL, 12, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(240, 46, '100.00', NULL, 25, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(241, 46, '100.00', NULL, 30, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(242, 46, '90.00', 1, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(243, 47, '120.00', 3, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(244, 47, '100.00', NULL, 10, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(245, 47, '100.00', NULL, 12, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(246, 47, '100.00', NULL, 25, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(247, 47, '100.00', NULL, 30, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(248, 47, '90.00', 1, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(249, 48, '120.00', 3, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(250, 48, '100.00', NULL, 10, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(251, 48, '100.00', NULL, 12, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(252, 48, '100.00', NULL, 25, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(253, 48, '100.00', NULL, 30, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(254, 48, '90.00', 1, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(255, 49, '120.00', 3, NULL, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(256, 49, '100.00', NULL, 10, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(257, 49, '100.00', NULL, 12, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(258, 49, '100.00', NULL, 25, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(259, 49, '100.00', NULL, 30, '2020-03-07 18:38:49', NULL, NULL, 'UNPAID', 'Debit'),
(260, 49, '90.00', 1, NULL, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(261, 50, '120.00', 3, NULL, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(262, 50, '100.00', NULL, 10, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(263, 50, '100.00', NULL, 12, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(264, 50, '100.00', NULL, 25, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(265, 50, '100.00', NULL, 30, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(266, 50, '90.00', 1, NULL, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(267, 51, '120.00', 3, NULL, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(268, 51, '100.00', NULL, 10, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(269, 51, '100.00', NULL, 12, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(270, 51, '100.00', NULL, 25, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(271, 51, '100.00', NULL, 30, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit'),
(272, 51, '90.00', 1, NULL, '2020-03-07 18:38:50', NULL, NULL, 'UNPAID', 'Debit');

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
  `inactivity_date` date DEFAULT NULL,
  `balance` decimal(14,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `name`, `user_name`, `password`, `reset`, `email`, `mobile`, `status`, `insert_date`, `update_date`, `user_type`, `address`, `nominee1`, `nominee2`, `nominee1_reimbursement`, `nominee2_reimbursement`, `membership_fee`, `inactivity_date`, `balance`) VALUES
(1, 'Horus CRM', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 'test@gmail.com', '8866748587', 'Active', '2018-07-05 09:24:27', '2019-12-28 06:15:07', 'Admin', NULL, 'Sister', 'Brother', '50', '50', '0.00', NULL, '0.00'),
(2, 'Milan Soni', 'Milan', 'd1f6648a66b1e7c82e34dd142e8a0330', NULL, 'ravip@gmail.com', '8866739817', 'Active', '1980-12-11 15:39:14', '2020-02-29 18:20:38', 'Advance deposite', 'Ahmedabad', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '8320.00'),
(3, 'Mehul Patel', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'milansoni44@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 08:28:17', 'Cheque', 'Kadi', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '0.00'),
(4, 'Ronak Gajjar', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'snehalhello@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 18:20:44', 'Cheque', 'Maninagar', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '0.00'),
(5, 'Rakesh Jangir', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:09:26', '2020-03-06 11:09:26', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(6, 'Nirav Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:09:50', '2020-03-06 11:09:50', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(7, 'Snehal Trapsiya', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:10', '2020-03-06 11:10:10', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(8, 'Avinash Singh', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:25', '2020-03-06 11:10:25', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(9, 'Devansh Shah', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:35', '2020-03-06 11:10:35', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(10, 'Khanjan Shah', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:10:47', '2020-03-06 11:10:47', 'Cheque', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', NULL),
(11, 'Devendra Jangir', NULL, NULL, NULL, 'milansoni44@gmail.com', '9161650505', 'Active', '2020-03-06 11:11:02', '2020-03-06 11:11:02', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(12, 'Atul Purohit', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:11:11', '2020-03-06 11:11:11', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', NULL),
(13, 'Pooja Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:19', '2020-03-06 11:11:19', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(14, 'Pooja Dave', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:28', '2020-03-06 11:11:28', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(15, 'Ashish Makwana', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:40', '2020-03-06 11:11:40', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(16, 'Ravi Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:53', '2020-03-06 11:11:53', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(17, 'Urvi Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:05', '2020-03-06 11:12:05', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(18, 'Dhara Patadia', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:17', '2020-03-06 11:12:17', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(19, 'Jitendra Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:28', '2020-03-06 11:12:28', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(20, 'Yamin Pipadwala', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:45', '2020-03-06 11:12:45', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(21, 'Harsh Dalwadi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:03', '2020-03-06 11:13:03', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(22, 'Dhruv Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:22', '2020-03-06 11:13:22', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(23, 'Piyush Chokshi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:38', '2020-03-06 11:13:38', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(24, 'Rahul Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:48', '2020-03-06 11:13:48', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '4960.00'),
(25, 'Mukesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:14:07', '2020-03-06 11:14:07', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', NULL),
(26, 'Samir Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:15', '2020-03-06 11:14:15', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(27, 'Mohammed Zahid Mansuri', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:26', '2020-03-06 11:14:26', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(28, 'Ketan Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:37', '2020-03-06 11:14:37', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(29, 'Ketan Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:43', '2020-03-06 11:14:43', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(30, 'Pooja Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:14:59', '2020-03-06 11:14:59', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', NULL),
(31, 'Vihana Dhaval Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:13', '2020-03-06 11:15:13', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(32, 'Kavya Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:26', '2020-03-06 11:15:26', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(33, 'Khyati Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:43', '2020-03-06 11:15:43', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(34, 'Darshan Sanghavi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:56', '2020-03-06 11:15:56', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(35, 'Darshan Parekh', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:01', '2020-03-06 11:16:01', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(36, 'Mitul Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:12', '2020-03-06 11:16:12', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(37, 'Urvish Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:22', '2020-03-06 11:16:22', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(38, 'Nainesh Makwana', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:36', '2020-03-06 11:16:36', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(39, 'Sachin Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:46', '2020-03-06 11:16:46', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(40, 'Hiren Vadodariya', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:07', '2020-03-06 11:17:07', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(41, 'Dharmang Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:29', '2020-03-06 11:17:29', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(42, 'Mitesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:35', '2020-03-06 11:17:35', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(43, 'Zarna Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:55', '2020-03-06 11:17:55', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(44, 'Riken Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:10', '2020-03-06 11:18:10', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(45, 'Dhara Mehul Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:29', '2020-03-06 11:18:29', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(46, 'Rakesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:36', '2020-03-06 11:18:36', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(47, 'Sneha Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:45', '2020-03-06 11:18:45', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(48, 'Ronak Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:15', '2020-03-06 11:19:15', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(49, 'Ronak Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:20', '2020-03-06 11:19:20', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(50, 'Vimal Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:31', '2020-03-06 11:19:31', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00'),
(51, 'Krunal Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:39', '2020-03-06 11:19:39', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periodic_email`
--
ALTER TABLE `periodic_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periodic_email_attachments`
--
ALTER TABLE `periodic_email_attachments`
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
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `periodic_email`
--
ALTER TABLE `periodic_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periodic_email_attachments`
--
ALTER TABLE `periodic_email_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
