-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 12:09 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_logistik`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `id_item` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `dimensions` int(11) NOT NULL,
  `id_typeitem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`id_item`, `name`, `dimensions`, `id_typeitem`) VALUES
(2, 'Beras Raskin', 20, 2),
(7, 'Knalpot Resing', 50, 2),
(10, 'Sosis', 15, 1),
(16, 'Ayam', 211, 1),
(17, 'Es', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_typeitem`
--

CREATE TABLE `m_typeitem` (
  `id_typeitem` int(11) NOT NULL,
  `name_item` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_typeitem`
--

INSERT INTO `m_typeitem` (`id_typeitem`, `name_item`) VALUES
(1, 'Frozen'),
(2, 'Dry Goods');

-- --------------------------------------------------------

--
-- Table structure for table `m_typewarehouse`
--

CREATE TABLE `m_typewarehouse` (
  `id_typewarehouse` int(11) NOT NULL,
  `nametype` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_typewarehouse`
--

INSERT INTO `m_typewarehouse` (`id_typewarehouse`, `nametype`) VALUES
(1, 'Frozen'),
(2, 'Dry Goods');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `username`, `password`, `email`, `created_at`, `update_at`, `deleted_at`) VALUES
('4h6jzmd3-rtw8-840j-xw9v2jnkgozxlf7p', 'admin', '$2y$10$Rrmoyvq.jcKlMnWN9iqkP.A13h8eQ9zcGVoHw.29oxUBXVKESQ3H.', 'admin@gmail.com', '2020-11-23 07:11:35', NULL, NULL),
('8ptf04ov-e3lf-n10y-reqdbhty8d695un1', 'tes', '$2y$10$IJTde8yKxKYqByFk8H.fIesZHrIbhISASRNRx6rWipYV.AADWKk6G', 'tes@gmail.com', '2020-11-24 01:11:40', NULL, '2020-11-25 05:11:35'),
('8qf5owsu-svca-8ruk-srzg6mqyidh8vk0w', 'adiyat', '$2y$10$cX82j4lt5U.9mkqDNNcFjOYOF5sgBPhdkY9xToBr5.riMgmp16pK6', 'adiyat@gmail.com', '2020-11-27 07:11:03', NULL, NULL),
('qj6h2xkl-ld5q-uqd6-5racvrnky4odfgeb', 'Adiyatzzz', '$2y$10$DCR27fdqH1/tlITAhWBKvOMYyjoxQHIlgLT3l8UYPDurjygt7EIZO', 'adiyat@gmail.com', '2020-11-24 01:11:42', '2020-11-24 02:11:50', '2020-11-25 05:11:47'),
('v342e1y0-1dqy-caz4-nyoj4fukv237j98c', 'utuh', '$2y$10$P3Net4Xp/lEJgUMgK5zXte4fjJBLOOc56W.z1nDb0Z8420lOUaslK', 'utuh@gmail.com', '2020-11-24 01:11:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_warehouse`
--

CREATE TABLE `m_warehouse` (
  `id_warehouse` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `capacity` int(11) NOT NULL,
  `address` varchar(45) NOT NULL,
  `id_typewarehouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_warehouse`
--

INSERT INTO `m_warehouse` (`id_warehouse`, `name`, `capacity`, `address`, `id_typewarehouse`) VALUES
(1, 'Warehouse Utuh', 500, 'Jl. Lurus', 1),
(3, 'Warehouse Agung', 555, 'Olala', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_warehousestorage`
--

CREATE TABLE `m_warehousestorage` (
  `id_warehousestorage` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_warehouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_warehousestorage`
--

INSERT INTO `m_warehousestorage` (`id_warehousestorage`, `id_item`, `id_warehouse`) VALUES
(1, 2, 3),
(3, 7, 3),
(5, 10, 1),
(11, 16, 3),
(12, 17, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_typeitem` (`id_typeitem`);

--
-- Indexes for table `m_typeitem`
--
ALTER TABLE `m_typeitem`
  ADD PRIMARY KEY (`id_typeitem`);

--
-- Indexes for table `m_typewarehouse`
--
ALTER TABLE `m_typewarehouse`
  ADD PRIMARY KEY (`id_typewarehouse`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  ADD PRIMARY KEY (`id_warehouse`),
  ADD KEY `id_typewarehouse` (`id_typewarehouse`);

--
-- Indexes for table `m_warehousestorage`
--
ALTER TABLE `m_warehousestorage`
  ADD PRIMARY KEY (`id_warehousestorage`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_warehouse` (`id_warehouse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_item`
--
ALTER TABLE `m_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_typeitem`
--
ALTER TABLE `m_typeitem`
  MODIFY `id_typeitem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_typewarehouse`
--
ALTER TABLE `m_typewarehouse`
  MODIFY `id_typewarehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  MODIFY `id_warehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_warehousestorage`
--
ALTER TABLE `m_warehousestorage`
  MODIFY `id_warehousestorage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_item`
--
ALTER TABLE `m_item`
  ADD CONSTRAINT `m_item_ibfk_1` FOREIGN KEY (`id_typeitem`) REFERENCES `m_typeitem` (`id_typeitem`);

--
-- Constraints for table `m_warehouse`
--
ALTER TABLE `m_warehouse`
  ADD CONSTRAINT `m_warehouse_ibfk_1` FOREIGN KEY (`id_typewarehouse`) REFERENCES `m_typewarehouse` (`id_typewarehouse`);

--
-- Constraints for table `m_warehousestorage`
--
ALTER TABLE `m_warehousestorage`
  ADD CONSTRAINT `m_warehousestorage_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `m_item` (`id_item`),
  ADD CONSTRAINT `m_warehousestorage_ibfk_2` FOREIGN KEY (`id_warehouse`) REFERENCES `m_warehouse` (`id_warehouse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
