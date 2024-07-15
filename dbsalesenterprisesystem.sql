-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2024 at 03:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsalesenterprisesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccessoriesThreadCount`
--

CREATE TABLE `AccessoriesThreadCount` (
  `id` int(10) NOT NULL,
  `Count` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Currency`
--

CREATE TABLE `Currency` (
  `id` int(11) NOT NULL,
  `Currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Currency`
--

INSERT INTO `Currency` (`id`, `Currency`) VALUES
(1, 'PHP'),
(2, 'USD'),
(3, 'EUR'),
(4, 'GBP'),
(5, 'JPY'),
(6, 'AUD'),
(7, 'CAD'),
(8, 'CHF'),
(9, 'CNY'),
(10, 'INR');

-- --------------------------------------------------------

--
-- Table structure for table `MattressProductSize`
--

CREATE TABLE `MattressProductSize` (
  `id` int(10) NOT NULL,
  `Size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MattressProductSize`
--

INSERT INTO `MattressProductSize` (`id`, `Size`) VALUES
(1, 'Single (36\" x 75\")'),
(2, 'Double (48\" x 75\")'),
(3, 'Full Double (54\" x 75\")'),
(4, 'Queen (60\" x 75\")'),
(5, 'Standard Pillow (18\" x 28\")'),
(6, 'Body Pillow (20\" x 54\")'),
(7, 'Neck Pillow (12\" x 16\")'),
(8, 'Throw Pillow (18\" x 18\")'),
(9, 'Bolster Pillow (7\" x 20\")'),
(10, 'Euro Pillow (26\" x 26\")'),
(11, 'Mattress Protector - Twin (39\" x 75\")'),
(12, 'Mattress Protector - Full (54\" x 75\")'),
(13, 'Mattress Protector - Queen (60\" x 80\")'),
(14, 'Twin (39\" x 75\")');

-- --------------------------------------------------------

--
-- Table structure for table `ProductLength`
--

CREATE TABLE `ProductLength` (
  `id` int(10) NOT NULL,
  `Size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ProductLength`
--

INSERT INTO `ProductLength` (`id`, `Size`) VALUES
(1, '52\" x 84\"'),
(2, '52\" x 92\"');

-- --------------------------------------------------------

--
-- Table structure for table `ProductsType`
--

CREATE TABLE `ProductsType` (
  `id` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ProductsType`
--

INSERT INTO `ProductsType` (`id`, `Type`) VALUES
(1, 'Mattresses'),
(2, 'Pillows'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `productID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `thickness` varchar(50) NOT NULL,
  `warranty` varchar(50) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ItemID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productID`, `name`, `type`, `price`, `size`, `color`, `thickness`, `warranty`, `thumbnail`, `currency`, `Quantity`, `ItemID`) VALUES
(1, 'Uratex Classic Mattress', 'Mattresses', 2899, 'Single (36\" x 75\")', 'Polycotton - Blue', '4\"', '5', '', 'Php', 5, 'UCM-S'),
(2, 'wdaWD', 'Mattresses', 232, 'DSFAD', 'DASD', 'SDAD', 'DSAD', 'black shirt.png', 'USD', 5, NULL),
(3, 'pillow original', 'Pillows', 500, '40x40', 'blue', '20', '10', 'Image.jpeg', 'PHP', 5, 'PO - 40'),
(4, 'Cover', 'Pillows', 550, '20', 'ecru', '30', '5', 'Image.jpeg', 'USD', 5, 'CV - 20'),
(5, 'Best Seller Mattress', 'Accessories', 1000, '80', 'white', '60', '10', 'Image.jpeg', 'PHP', 5, 'BSM - 80');

-- --------------------------------------------------------

--
-- Table structure for table `tblSupplierAccounts`
--

CREATE TABLE `tblSupplierAccounts` (
  `ID` int(11) NOT NULL,
  `UserID` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblSupplierAccounts`
--

INSERT INTO `tblSupplierAccounts` (`ID`, `UserID`, `firstName`, `lastName`, `username`, `email`, `password`, `Date`) VALUES
(1, '1', 'Adrean', 'Quidor', 'SupplierFirstUser', 'Hello@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-09 02:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccounts`
--

CREATE TABLE `tbluseraccounts` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccounts`
--

INSERT INTO `tbluseraccounts` (`userID`, `firstName`, `lastName`, `username`, `email`, `password`, `Date`) VALUES
(1, 'Dan', 'Angelo', 'dan_angelo', 'dan_angelo@gmail.com', 'andelo.1234', '2024-07-03 09:45:02'),
(2, 'Adrean', 'Quidor', 'QUIDS', 'adrean@gmail.com', 'f537597e14733031fd5b325d315b88aad89d9405', '2024-07-03 09:54:29'),
(3, 'Adrr', 'quii', 'QUID', 'adr@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-03 10:01:20'),
(4, 'cyrus', 'cyrus', 'cyrus', 'cyrus@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-03 10:02:36'),
(7, 'bayla', 'bayla', 'mjjj', 'bayla@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:40:56'),
(8, 'bayla', 'bayla', 'mjjjj', 'bayla@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:41:02'),
(9, 'Admin', 'Admin', 'Admin', 'Adminsupplier@gmail.com', '123456', '2024-07-04 08:55:47'),
(10, 'Admin', 'Admin', 'Admin', 'Adminretailer@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:55:47'),
(11, 'testing', 'testing', 'testing', 'testing@gmail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(12, 'testing', 'testing', 'testing', 'testing@gmail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(13, 'customer1', 'customer1', 'customer1', 'customer1@gmail.com', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(14, 'Justin', 'Mayuga', 'Mayugs', 'justin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-05 13:02:29'),
(15, 'samama', 'gogogo', 'sam.go', 'sam.go@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-08 09:37:36'),
(16, 'tony', 'tony', 'tony.tony', 'tony.tony@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-08 09:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `Thickness`
--

CREATE TABLE `Thickness` (
  `id` int(11) NOT NULL,
  `thickness` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Thickness`
--

INSERT INTO `Thickness` (`id`, `thickness`) VALUES
(1, '2\"'),
(2, '3\"'),
(3, '4\"'),
(4, '8\"'),
(5, '10\"'),
(6, '11\"'),
(7, '12\"'),
(8, '14\"'),
(9, '18\"'),
(10, '20\"');

-- --------------------------------------------------------

--
-- Table structure for table `Warranty`
--

CREATE TABLE `Warranty` (
  `id` int(11) NOT NULL,
  `Warranty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Warranty`
--

INSERT INTO `Warranty` (`id`, `Warranty`) VALUES
(1, 1),
(2, 2),
(3, 5),
(4, 10),
(5, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AccessoriesThreadCount`
--
ALTER TABLE `AccessoriesThreadCount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Currency`
--
ALTER TABLE `Currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MattressProductSize`
--
ALTER TABLE `MattressProductSize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductLength`
--
ALTER TABLE `ProductLength`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductsType`
--
ALTER TABLE `ProductsType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tblSupplierAccounts`
--
ALTER TABLE `tblSupplierAccounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluseraccounts`
--
ALTER TABLE `tbluseraccounts`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `Thickness`
--
ALTER TABLE `Thickness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Warranty`
--
ALTER TABLE `Warranty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AccessoriesThreadCount`
--
ALTER TABLE `AccessoriesThreadCount`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Currency`
--
ALTER TABLE `Currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `MattressProductSize`
--
ALTER TABLE `MattressProductSize`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ProductLength`
--
ALTER TABLE `ProductLength`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ProductsType`
--
ALTER TABLE `ProductsType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblSupplierAccounts`
--
ALTER TABLE `tblSupplierAccounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluseraccounts`
--
ALTER TABLE `tbluseraccounts`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Thickness`
--
ALTER TABLE `Thickness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Warranty`
--
ALTER TABLE `Warranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
