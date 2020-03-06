-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 05:22 PM
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
(1, 'Administrative', '0.00', '2020-03-06 09:42:48'),
(2, 'Nominee Change', '0.00', '2020-03-06 09:42:48'),
(3, 'Institute', '-7344.00', '2020-03-06 09:43:01'),
(4, 'Penalty', '0.00', '2020-03-06 09:43:10');

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
(1, 2, '120.00', 3, NULL, '2020-03-06 16:37:29', NULL, NULL, 'UNPAID', 'Debit'),
(2, 2, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(3, 2, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(4, 2, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(5, 2, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(6, 2, '90.00', 1, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(7, 3, '120.00', 3, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(8, 3, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(9, 3, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(10, 3, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(11, 3, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(12, 3, '90.00', 1, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(13, 4, '120.00', 3, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(14, 4, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(15, 4, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(16, 4, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(17, 4, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(18, 4, '90.00', 1, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(19, 5, '120.00', 3, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(20, 5, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(21, 5, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(22, 5, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(23, 5, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(24, 5, '90.00', 1, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(25, 6, '120.00', 3, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(26, 6, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(27, 6, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(28, 6, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(29, 6, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(30, 6, '90.00', 1, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(31, 7, '120.00', 3, NULL, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(32, 7, '100.00', NULL, 10, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(33, 7, '100.00', NULL, 12, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(34, 7, '100.00', NULL, 25, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(35, 7, '100.00', NULL, 30, '2020-03-06 16:37:30', NULL, NULL, 'UNPAID', 'Debit'),
(36, 7, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(37, 8, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(38, 8, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(39, 8, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(40, 8, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(41, 8, '100.00', NULL, 30, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(42, 8, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(43, 9, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(44, 9, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(45, 9, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(46, 9, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(47, 9, '100.00', NULL, 30, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(48, 9, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(49, 11, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(50, 11, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(51, 11, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(52, 11, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(53, 11, '100.00', NULL, 30, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(54, 11, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(55, 13, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(56, 13, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(57, 13, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(58, 13, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(59, 13, '100.00', NULL, 30, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(60, 13, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(61, 14, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(62, 14, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(63, 14, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(64, 14, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(65, 14, '100.00', NULL, 30, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(66, 14, '90.00', 1, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(67, 15, '120.00', 3, NULL, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(68, 15, '100.00', NULL, 10, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(69, 15, '100.00', NULL, 12, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(70, 15, '100.00', NULL, 25, '2020-03-06 16:37:31', NULL, NULL, 'UNPAID', 'Debit'),
(71, 15, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(72, 15, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(73, 16, '120.00', 3, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(74, 16, '100.00', NULL, 10, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(75, 16, '100.00', NULL, 12, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(76, 16, '100.00', NULL, 25, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(77, 16, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(78, 16, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(79, 17, '120.00', 3, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(80, 17, '100.00', NULL, 10, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(81, 17, '100.00', NULL, 12, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(82, 17, '100.00', NULL, 25, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(83, 17, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(84, 17, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(85, 18, '120.00', 3, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(86, 18, '100.00', NULL, 10, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(87, 18, '100.00', NULL, 12, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(88, 18, '100.00', NULL, 25, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(89, 18, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(90, 18, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(91, 19, '120.00', 3, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(92, 19, '100.00', NULL, 10, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(93, 19, '100.00', NULL, 12, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(94, 19, '100.00', NULL, 25, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(95, 19, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(96, 19, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(97, 20, '120.00', 3, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(98, 20, '100.00', NULL, 10, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(99, 20, '100.00', NULL, 12, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(100, 20, '100.00', NULL, 25, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(101, 20, '100.00', NULL, 30, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(102, 20, '90.00', 1, NULL, '2020-03-06 16:37:32', NULL, NULL, 'UNPAID', 'Debit'),
(103, 21, '120.00', 3, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(104, 21, '100.00', NULL, 10, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(105, 21, '100.00', NULL, 12, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(106, 21, '100.00', NULL, 25, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(107, 21, '100.00', NULL, 30, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(108, 21, '90.00', 1, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(109, 22, '120.00', 3, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(110, 22, '100.00', NULL, 10, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(111, 22, '100.00', NULL, 12, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(112, 22, '100.00', NULL, 25, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(113, 22, '100.00', NULL, 30, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(114, 22, '90.00', 1, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(115, 23, '120.00', 3, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(116, 23, '100.00', NULL, 10, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(117, 23, '100.00', NULL, 12, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(118, 23, '100.00', NULL, 25, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(119, 23, '100.00', NULL, 30, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(120, 23, '90.00', 1, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(121, 24, '120.00', 3, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(122, 24, '100.00', NULL, 10, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(123, 24, '100.00', NULL, 12, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(124, 24, '100.00', NULL, 25, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(125, 24, '100.00', NULL, 30, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(126, 24, '90.00', 1, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(127, 26, '120.00', 3, NULL, '2020-03-06 16:37:33', NULL, NULL, 'UNPAID', 'Debit'),
(128, 26, '100.00', NULL, 10, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(129, 26, '100.00', NULL, 12, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(130, 26, '100.00', NULL, 25, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(131, 26, '100.00', NULL, 30, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(132, 26, '90.00', 1, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(133, 27, '120.00', 3, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(134, 27, '100.00', NULL, 10, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(135, 27, '100.00', NULL, 12, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(136, 27, '100.00', NULL, 25, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(137, 27, '100.00', NULL, 30, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(138, 27, '90.00', 1, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(139, 28, '120.00', 3, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(140, 28, '100.00', NULL, 10, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(141, 28, '100.00', NULL, 12, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(142, 28, '100.00', NULL, 25, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(143, 28, '100.00', NULL, 30, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(144, 28, '90.00', 1, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(145, 29, '120.00', 3, NULL, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(146, 29, '100.00', NULL, 10, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(147, 29, '100.00', NULL, 12, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(148, 29, '100.00', NULL, 25, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(149, 29, '100.00', NULL, 30, '2020-03-06 16:37:34', NULL, NULL, 'UNPAID', 'Debit'),
(150, 29, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(151, 31, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(152, 31, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(153, 31, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(154, 31, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(155, 31, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(156, 31, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(157, 32, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(158, 32, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(159, 32, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(160, 32, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(161, 32, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(162, 32, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(163, 33, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(164, 33, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(165, 33, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(166, 33, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(167, 33, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(168, 33, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(169, 34, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(170, 34, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(171, 34, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(172, 34, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(173, 34, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(174, 34, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(175, 35, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(176, 35, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(177, 35, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(178, 35, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(179, 35, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(180, 35, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(181, 36, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(182, 36, '100.00', NULL, 10, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(183, 36, '100.00', NULL, 12, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(184, 36, '100.00', NULL, 25, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(185, 36, '100.00', NULL, 30, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(186, 36, '90.00', 1, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(187, 37, '120.00', 3, NULL, '2020-03-06 16:37:35', NULL, NULL, 'UNPAID', 'Debit'),
(188, 37, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(189, 37, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(190, 37, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(191, 37, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(192, 37, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(193, 38, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(194, 38, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(195, 38, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(196, 38, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(197, 38, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(198, 38, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(199, 39, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(200, 39, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(201, 39, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(202, 39, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(203, 39, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(204, 39, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(205, 40, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(206, 40, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(207, 40, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(208, 40, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(209, 40, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(210, 40, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(211, 41, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(212, 41, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(213, 41, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(214, 41, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(215, 41, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(216, 41, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(217, 42, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(218, 42, '100.00', NULL, 10, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(219, 42, '100.00', NULL, 12, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(220, 42, '100.00', NULL, 25, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(221, 42, '100.00', NULL, 30, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(222, 42, '90.00', 1, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(223, 43, '120.00', 3, NULL, '2020-03-06 16:37:36', NULL, NULL, 'UNPAID', 'Debit'),
(224, 43, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(225, 43, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(226, 43, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(227, 43, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(228, 43, '90.00', 1, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(229, 44, '120.00', 3, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(230, 44, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(231, 44, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(232, 44, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(233, 44, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(234, 44, '90.00', 1, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(235, 45, '120.00', 3, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(236, 45, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(237, 45, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(238, 45, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(239, 45, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(240, 45, '90.00', 1, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(241, 46, '120.00', 3, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(242, 46, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(243, 46, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(244, 46, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(245, 46, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(246, 46, '90.00', 1, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(247, 47, '120.00', 3, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(248, 47, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(249, 47, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(250, 47, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(251, 47, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(252, 47, '90.00', 1, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(253, 48, '120.00', 3, NULL, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(254, 48, '100.00', NULL, 10, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(255, 48, '100.00', NULL, 12, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(256, 48, '100.00', NULL, 25, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(257, 48, '100.00', NULL, 30, '2020-03-06 16:37:37', NULL, NULL, 'UNPAID', 'Debit'),
(258, 48, '90.00', 1, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(259, 49, '120.00', 3, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(260, 49, '100.00', NULL, 10, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(261, 49, '100.00', NULL, 12, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(262, 49, '100.00', NULL, 25, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(263, 49, '100.00', NULL, 30, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(264, 49, '90.00', 1, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(265, 50, '120.00', 3, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(266, 50, '100.00', NULL, 10, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(267, 50, '100.00', NULL, 12, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(268, 50, '100.00', NULL, 25, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(269, 50, '100.00', NULL, 30, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(270, 50, '90.00', 1, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(271, 51, '120.00', 3, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(272, 51, '100.00', NULL, 10, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(273, 51, '100.00', NULL, 12, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(274, 51, '100.00', NULL, 25, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(275, 51, '100.00', NULL, 30, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(276, 51, '90.00', 1, NULL, '2020-03-06 16:37:38', NULL, NULL, 'UNPAID', 'Debit'),
(296, 2, '400.00', 3, NULL, '2020-03-06 21:51:37', '2020-03-06 21:51:37', 'AUTO', 'PAID', 'Credit'),
(297, 11, '400.00', 3, NULL, '2020-03-06 21:51:37', '2020-03-06 21:51:37', 'AUTO', 'PAID', 'Credit'),
(298, 13, '400.00', 3, NULL, '2020-03-06 21:51:37', '2020-03-06 21:51:37', 'AUTO', 'PAID', 'Credit'),
(299, 14, '400.00', 3, NULL, '2020-03-06 21:51:37', '2020-03-06 21:51:37', 'AUTO', 'PAID', 'Credit'),
(300, 20, '400.00', 3, NULL, '2020-03-06 21:51:37', '2020-03-06 21:51:37', 'AUTO', 'PAID', 'Credit'),
(301, 21, '400.00', 3, NULL, '2020-03-06 21:51:38', '2020-03-06 21:51:38', 'AUTO', 'PAID', 'Credit'),
(302, 22, '400.00', 3, NULL, '2020-03-06 21:51:38', '2020-03-06 21:51:38', 'AUTO', 'PAID', 'Credit'),
(303, 23, '400.00', 3, NULL, '2020-03-06 21:51:38', '2020-03-06 21:51:38', 'AUTO', 'PAID', 'Credit'),
(304, 24, '400.00', 3, NULL, '2020-03-06 21:51:38', '2020-03-06 21:51:38', 'AUTO', 'PAID', 'Credit'),
(305, 2, '416.00', 3, NULL, '2020-03-06 21:52:11', '2020-03-06 21:52:11', 'AUTO', 'PAID', 'Credit'),
(306, 11, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(307, 13, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(308, 14, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(309, 20, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(310, 21, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(311, 22, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(312, 23, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit'),
(313, 24, '416.00', 3, NULL, '2020-03-06 21:52:12', '2020-03-06 21:52:12', 'AUTO', 'PAID', 'Credit');

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
(1, 'Horus CRM', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 'test@gmail.com', '8866748587', 'Active', '2018-07-05 09:24:27', '2019-12-28 06:15:07', 'Admin', NULL, 'Sister', 'Brother', '50', '50', '0.00', NULL, '10816.00'),
(2, 'Milan Soni', 'Milan', 'd1f6648a66b1e7c82e34dd142e8a0330', NULL, 'ravip@gmail.com', '8866739817', 'Active', '2018-12-11 15:39:14', '2020-02-29 18:20:38', 'Advance deposite', 'Ahmedabad', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '10816.00'),
(3, 'Mehul Patel', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'snehalhello@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 08:28:17', 'Cheque', 'Kadi', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '10816.00'),
(4, 'Ronak Gajjar', 'Mehul', '5d41402abc4b2a76b9719d911017c592', NULL, 'snehalhello@gmail.com', '4455665544', 'Active', '2019-12-21 05:39:00', '2020-02-29 18:20:44', 'Cheque', 'Maninagar', 'Sister', 'Brother', '50', '50', '1500.00', NULL, '10816.00'),
(5, 'Rakesh Jangir', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:09:26', '2020-03-06 11:09:26', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(6, 'Nirav Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:09:50', '2020-03-06 11:09:50', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(7, 'Snehal Trapsiya', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:10', '2020-03-06 11:10:10', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(8, 'Avinash Singh', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:25', '2020-03-06 11:10:25', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(9, 'Devansh Shah', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:10:35', '2020-03-06 11:10:35', 'ECS', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(10, 'Khanjan Shah', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:10:47', '2020-03-06 11:10:47', 'Cheque', 'Ahmedabad', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', '10816.00'),
(11, 'Devendra Jangir', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:02', '2020-03-06 11:11:02', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(12, 'Atul Purohit', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:11:11', '2020-03-06 11:11:11', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', '10816.00'),
(13, 'Pooja Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:19', '2020-03-06 11:11:19', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(14, 'Pooja Dave', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:28', '2020-03-06 11:11:28', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(15, 'Ashish Makwana', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:40', '2020-03-06 11:11:40', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(16, 'Ravi Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:11:53', '2020-03-06 11:11:53', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(17, 'Urvi Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:05', '2020-03-06 11:12:05', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(18, 'Dhara Patadia', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:17', '2020-03-06 11:12:17', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(19, 'Jitendra Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:28', '2020-03-06 11:12:28', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(20, 'Yamin Pipadwala', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:12:45', '2020-03-06 11:12:45', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(21, 'Harsh Dalwadi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:03', '2020-03-06 11:13:03', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(22, 'Dhruv Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:22', '2020-03-06 11:13:22', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(23, 'Piyush Chokshi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:38', '2020-03-06 11:13:38', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(24, 'Rahul Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:13:48', '2020-03-06 11:13:48', 'Advance deposite', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(25, 'Mukesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:14:07', '2020-03-06 11:14:07', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', '10816.00'),
(26, 'Samir Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:15', '2020-03-06 11:14:15', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(27, 'Mohammed Zahid Mansuri', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:26', '2020-03-06 11:14:26', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(28, 'Ketan Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:37', '2020-03-06 11:14:37', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(29, 'Ketan Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:14:43', '2020-03-06 11:14:43', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(30, 'Pooja Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Deactive', '2020-03-06 11:14:59', '2020-03-06 11:14:59', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', '2019-12-10', '10816.00'),
(31, 'Vihana Dhaval Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:13', '2020-03-06 11:15:13', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(32, 'Kavya Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:26', '2020-03-06 11:15:26', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(33, 'Khyati Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:43', '2020-03-06 11:15:43', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(34, 'Darshan Sanghavi', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:15:56', '2020-03-06 11:15:56', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(35, 'Darshan Parekh', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:01', '2020-03-06 11:16:01', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(36, 'Mitul Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:12', '2020-03-06 11:16:12', 'Cheque', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(37, 'Urvish Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:22', '2020-03-06 11:16:22', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(38, 'Nainesh Makwana', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:36', '2020-03-06 11:16:36', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(39, 'Sachin Prajapati', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:16:46', '2020-03-06 11:16:46', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(40, 'Hiren Vadodariya', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:07', '2020-03-06 11:17:07', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(41, 'Dharmang Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:29', '2020-03-06 11:17:29', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(42, 'Mitesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:35', '2020-03-06 11:17:35', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(43, 'Zarna Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:17:55', '2020-03-06 11:17:55', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(44, 'Riken Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:10', '2020-03-06 11:18:10', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(45, 'Dhara Mehul Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:29', '2020-03-06 11:18:29', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(46, 'Rakesh Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:36', '2020-03-06 11:18:36', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(47, 'Sneha Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:18:45', '2020-03-06 11:18:45', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(48, 'Ronak Soni', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:15', '2020-03-06 11:19:15', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(49, 'Ronak Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:20', '2020-03-06 11:19:20', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(50, 'Vimal Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:31', '2020-03-06 11:19:31', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00'),
(51, 'Krunal Patel', NULL, NULL, NULL, NULL, '9161650505', 'Active', '2020-03-06 11:19:39', '2020-03-06 11:19:39', 'ECS', 'Sikar', 'Sister', 'Brother', '2', '2', '90.00', NULL, '10816.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
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
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
