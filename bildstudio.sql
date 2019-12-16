-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 11:11 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bildstudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `DeviceTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `Name`, `DeviceTypeId`) VALUES
(2, 'HP 260e12q', 1),
(3, 'HP ProBook 454031q', 2),
(8, 'asdq', 2),
(9, 'raq', 1),
(17, 'Yogaaq', 4),
(20, 'kkk', 4),
(22, 'ra', 2);

-- --------------------------------------------------------

--
-- Table structure for table `device_property_values`
--

CREATE TABLE `device_property_values` (
  `id` int(11) NOT NULL,
  `DeviceTypePropertyId` int(11) NOT NULL,
  `DeviceId` int(11) NOT NULL,
  `Vrijednost` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_property_values`
--

INSERT INTO `device_property_values` (`id`, `DeviceTypePropertyId`, `DeviceId`, `Vrijednost`) VALUES
(1, 3, 2, 'Ljuboe12'),
(2, 2, 2, 'Rje12'),
(4, 5, 3, '8 GB131'),
(5, 6, 3, 'Windows 10131'),
(6, 7, 3, 'Intel I7131'),
(7, 4, 3, '15.6131'),
(21, 1, 9, 'wqeqw1'),
(22, 2, 9, 'qweqwe1'),
(23, 3, 9, 'qweqwe1'),
(25, 5, 8, 'asdasd'),
(26, 6, 8, 'asdasd'),
(27, 7, 8, 'adsdad'),
(28, 1, 2, 'Radee12'),
(45, 8, 17, '123'),
(47, 8, 20, 'kkk'),
(49, 7, 22, 'asda');

-- --------------------------------------------------------

--
-- Table structure for table `device_types`
--

CREATE TABLE `device_types` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ParentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_types`
--

INSERT INTO `device_types` (`id`, `Name`, `ParentId`) VALUES
(1, 'Racunar1', NULL),
(2, 'Laptop', 1),
(4, 'Yoga', 2),
(36, 'rade', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device_type_property`
--

CREATE TABLE `device_type_property` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `DeviceTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_type_property`
--

INSERT INTO `device_type_property` (`id`, `Name`, `DeviceTypeId`) VALUES
(1, 'Ram', 1),
(2, 'OS', 1),
(3, 'Procesor1', 1),
(4, 'Dijagonala', 2),
(5, 'RAM', 2),
(6, 'OS', 2),
(7, 'Procesor', 2),
(8, 'Fold', 4),
(43, '12', 36),
(44, '21', 36),
(45, '123', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DeviceTypeId` (`DeviceTypeId`);

--
-- Indexes for table `device_property_values`
--
ALTER TABLE `device_property_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DeviceId` (`DeviceId`),
  ADD KEY `DeviceTypePropertyId` (`DeviceTypePropertyId`);

--
-- Indexes for table `device_types`
--
ALTER TABLE `device_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ParentId` (`ParentId`);

--
-- Indexes for table `device_type_property`
--
ALTER TABLE `device_type_property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DeviceTypeId` (`DeviceTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `device_property_values`
--
ALTER TABLE `device_property_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `device_types`
--
ALTER TABLE `device_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `device_type_property`
--
ALTER TABLE `device_type_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`DeviceTypeId`) REFERENCES `device_types` (`id`);

--
-- Constraints for table `device_property_values`
--
ALTER TABLE `device_property_values`
  ADD CONSTRAINT `device_property_values_ibfk_1` FOREIGN KEY (`DeviceId`) REFERENCES `devices` (`id`),
  ADD CONSTRAINT `device_property_values_ibfk_2` FOREIGN KEY (`DeviceTypePropertyId`) REFERENCES `device_type_property` (`id`);

--
-- Constraints for table `device_types`
--
ALTER TABLE `device_types`
  ADD CONSTRAINT `device_types_ibfk_1` FOREIGN KEY (`ParentId`) REFERENCES `device_types` (`id`);

--
-- Constraints for table `device_type_property`
--
ALTER TABLE `device_type_property`
  ADD CONSTRAINT `device_type_property_ibfk_1` FOREIGN KEY (`DeviceTypeId`) REFERENCES `device_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
