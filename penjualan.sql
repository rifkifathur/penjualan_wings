-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 03:12 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `password`) VALUES
(1, 'Smit', '_sm1t_OK');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `discount` int(6) DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`) VALUES
('GVSBRU', 'Giv Biru', 11000, 'IDR', NULL, '13 cm x 10 cm', 'PCS'),
('SKUSKILNP', 'So klin pewangi', 15000, 'IDR', 10, '13 cm x 10 cm', 'PCS'),
('SKUSKIQD', 'So klin liquid', 18000, 'IDR', NULL, '13 cm x 10 cm', 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(50) NOT NULL,
  `code_doc` varchar(3) NOT NULL,
  `doc_number` varchar(10) NOT NULL,
  `code_product` varchar(18) NOT NULL,
  `quantity` int(6) DEFAULT NULL,
  `sub_total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `code_doc`, `doc_number`, `code_product`, `quantity`, `sub_total`) VALUES
(9, 'TRX', '001', 'SKUSKILNP', 1, 13500),
(10, 'TRX', '001', 'SKUSKIQD', 2, 36000),
(11, 'TRX', '002', 'GVSBRU', 1, 11000),
(12, 'TRX', '002', 'SKUSKIQD', 2, 36000),
(13, 'TRX', '003', 'SKUSKILNP', 2, 27000),
(14, 'TRX', '003', 'SKUSKIQD', 3, 54000),
(15, 'TRX', '004', 'SKUSKILNP', 2, 27000),
(16, 'TRX', '004', 'SKUSKIQD', 1, 18000),
(17, 'TRX', '005', 'SKUSKILNP', 2, 27000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_header`
--

CREATE TABLE `transaction_header` (
  `id` int(50) NOT NULL,
  `doc_code` varchar(3) NOT NULL,
  `doc_number` varchar(10) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `total` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_header`
--

INSERT INTO `transaction_header` (`id`, `doc_code`, `doc_number`, `user_id`, `total`, `date`) VALUES
(5, 'TRX', '001', '1', 49500, '2023-09-13'),
(6, 'TRX', '002', '1', 47000, '2023-09-13'),
(7, 'TRX', '003', '1', 81000, '2023-09-13'),
(8, 'TRX', '004', '1', 45000, '2023-09-13'),
(9, 'TRX', '005', '1', 27000, '2023-09-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaction_header`
--
ALTER TABLE `transaction_header`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
