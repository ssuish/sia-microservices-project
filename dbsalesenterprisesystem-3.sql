-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2024 at 03:50 AM
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
  `currency` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productID`, `name`, `type`, `price`, `size`, `color`, `thickness`, `warranty`, `thumbnail`, `currency`) VALUES
(1, 'Uratex Classic Mattress', 'Mattresses', 2899, 'Single (36\" x 75\")', 'Polycotton - Blue', '4\"', '5', '', 'Php'),
(2, 'wdaWD', 'Mattresses', 232, 'DSFAD', 'DASD', 'SDAD', 'DSAD', 'black shirt.png', 'USD'),
(3, 'pillow original', 'Pillows', 500, '40x40', 'blue', '20', '10', 'Image.jpeg', 'PHP'),
(4, 'Cover', 'Pillows', 550, '20', 'ecru', '30', '5', 'Image.jpeg', 'USD'),
(5, 'Best Seller Mattress', 'Accessories', 1000, '80', 'white', '60', '10', 'Image.jpeg', 'PHP');

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
  `userRole` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccounts`
--

INSERT INTO `tbluseraccounts` (`userID`, `firstName`, `lastName`, `username`, `email`, `userRole`, `password`, `Date`) VALUES
(1, 'Dan', 'Angelo', 'dan_angelo', 'dan_angelo@gmail.com', 'retailer', 'andelo.1234', '2024-07-03 09:45:02'),
(2, 'Adrean', 'Quidor', 'QUIDS', 'adrean@gmail.com', 'retailer', 'f537597e14733031fd5b325d315b88aad89d9405', '2024-07-03 09:54:29'),
(3, 'Adrr', 'quii', 'QUID', 'adr@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-03 10:01:20'),
(4, 'cyrus', 'cyrus', 'cyrus', 'cyrus@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-03 10:02:36'),
(7, 'bayla', 'bayla', 'mjjj', 'bayla@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:40:56'),
(8, 'bayla', 'bayla', 'mjjjj', 'bayla@gmail.com', 'customer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:41:02'),
(9, 'Admin', 'Admin', 'Admin', 'Adminsupplier@gmail.com', 'SupplierAdmin', '123456', '2024-07-04 08:55:47'),
(10, 'Admin', 'Admin', 'Admin', 'Adminretailer@gmail.com', 'RetailerAdmin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-04 08:55:47'),
(11, 'testing', 'testing', 'testing', 'testing@gmail.com', 'retailer', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(12, 'testing', 'testing', 'testing', 'testing@gmail.com', 'customer', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(13, 'customer1', 'customer1', 'customer1', 'customer1@gmail.com', 'customer', 'dc724af18fbdd4e59189f5fe768a5f8311527050', '2024-07-05 10:18:02'),
(14, 'Justin', 'Mayuga', 'Mayugs', 'justin@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-05 13:02:29'),
(15, 'samama', 'gogogo', 'sam.go', 'sam.go@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-08 09:37:36'),
(16, 'tony', 'tony', 'tony.tony', 'tony.tony@gmail.com', 'retailer', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-07-08 09:40:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tbluseraccounts`
--
ALTER TABLE `tbluseraccounts`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbluseraccounts`
--
ALTER TABLE `tbluseraccounts`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
