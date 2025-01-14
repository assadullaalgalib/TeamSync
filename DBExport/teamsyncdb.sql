-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 12:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamsyncdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`userid`, `firstname`, `lastname`, `username`, `email`, `password`, `roleid`) VALUES
(1, 'Md Asif', 'Chowdhury', 'NocillaX', 'asifjarif@gmail.com', '12345678Aa@', 3),
(7, 'Md Asif', 'Chowdhury', 'NocillaX', 'asifjariff@gmail.com', '12345678Aa@', 3),
(9, 'Md Asif', 'Chowdhury', 'NocillaX', 'asif@gmail.com', 'Aa@12345678', 3),
(10, 'Md Jarif', 'Chowdhury', 'sean_thomas', 'jarif@gmail.com', 'Aa@12345678', 4),
(11, 'Md Assadulla', 'Al Galib', 'maag', 'galib@gmail.com', '12345678Aa@', 4);

-- --------------------------------------------------------

--
-- Table structure for table `usr_role`
--

CREATE TABLE `usr_role` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_role`
--

INSERT INTO `usr_role` (`roleid`, `rolename`) VALUES
(1, 'Admin'),
(2, 'ProjectManager'),
(3, 'Developer'),
(4, 'Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usr_role` (`roleid`);

--
-- Indexes for table `usr_role`
--
ALTER TABLE `usr_role`
  ADD PRIMARY KEY (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usr`
--
ALTER TABLE `usr`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usr_role`
--
ALTER TABLE `usr_role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `fk_usr_role` FOREIGN KEY (`roleid`) REFERENCES `usr_role` (`roleid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
