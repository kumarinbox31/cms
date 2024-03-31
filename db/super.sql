-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: sdb-f.hosting.stackcp.net
-- Generation Time: Mar 31, 2024 at 04:06 AM
-- Server version: 10.4.26-MariaDB-log
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webfire_super-313834a166`
--

-- --------------------------------------------------------

--
-- Table structure for table `ab_admins`
--

CREATE TABLE `ab_admins` (
  `id` int(11) NOT NULL,
  `type` enum('admin','reseller') NOT NULL,
  `name` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `_email` varchar(100) NOT NULL,
  `_pass` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_admins`
--

INSERT INTO `ab_admins` (`id`, `type`, `name`, `domain`, `_email`, `_pass`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Abhijeet Singh', 'super.webfire.in', 'kumarinbox31@gmail.com', 'd4918105a415eb6f58a621a0c9b97c8a', '1', '2024-02-05 13:54:01', '2024-02-05 13:54:31'),
(2, 'admin', 'i-tech guru solution', 'super.itechgurusolution.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '2024-02-05 13:54:01', '2024-03-01 13:42:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ab_admins`
--
ALTER TABLE `ab_admins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ab_admins`
--
ALTER TABLE `ab_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
