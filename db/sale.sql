-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2020 at 11:11 AM
-- Server version: 5.7.24
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
-- Database: `sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` int(50) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `c_quantity` varchar(50) NOT NULL,
  `c_price` varchar(50) NOT NULL,
  `deadline` varchar(100) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_branch` varchar(50) NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `product_id`, `product_name`, `c_quantity`, `c_price`, `deadline`, `employee_name`, `employee_branch`) VALUES
(1, '1', 'CPU Cooler', '0', '1400', '2019-09-19', 'Md Ushaed', 'bhola'),
(2, '2', 'Intel CPU', '20', '7000', '2019-09-19', 'Rahat Reza', 'Badda'),
(3, '2', 'Intel CPU', '0', '7000', '2019-09-19', 'Md Ushaed', 'bhola'),
(4, '1', 'CPU Cooler', '10', '1400', '2019-09-19', 'Rahat Reza', 'Badda'),
(5, '1', 'CPU Cooler', '50', '1400', '2019-09-19', 'Md Ushaed', 'bhola');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `buy_cost` varchar(50) NOT NULL,
  `per_buy_cost` varchar(50) NOT NULL,
  `per_sell_cost` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `quantity`, `buy_cost`, `per_buy_cost`, `per_sell_cost`) VALUES
(1, 'CPU Cooler', 260, '500000', '1000', '1400'),
(2, 'Intel CPU', 320, '2500000', '5000', '7000');

-- --------------------------------------------------------

--
-- Table structure for table `profit_report`
--

DROP TABLE IF EXISTS `profit_report`;
CREATE TABLE IF NOT EXISTS `profit_report` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `buying_cost` varchar(50) NOT NULL,
  `selling_cost` varchar(50) NOT NULL,
  `employee_commission` varchar(50) NOT NULL,
  `employee_salary` varchar(50) NOT NULL,
  `profit` varchar(50) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `sell_time` varchar(100) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profit_report`
--

INSERT INTO `profit_report` (`r_id`, `product_name`, `quantity`, `buying_cost`, `selling_cost`, `employee_commission`, `employee_salary`, `profit`, `employee_name`, `sell_time`) VALUES
(1, 'CPU Cooler', '50', '50000', '70000', '10', '7000', '13000', 'Md Ushaed', '2019-09-11'),
(2, 'Intel CPU', '50', '250000', '350000', '10', '35000', '65000', 'Rahat Reza', '2019-09-11'),
(3, 'CPU Cooler', '70', '70000', '98000', '10', '9800', '18200', 'Rahat Reza', '2019-09-11'),
(4, 'Intel CPU', '90', '450000', '630000', '10', '63000', '117000', 'Md Ushaed', '2019-09-11'),
(5, 'CPU Cooler', '10', '10000', '14000', '10', '1400', '2600', 'Rahat Reza', '2019-09-12'),
(6, 'Intel CPU', '10', '50000', '70000', '10', '7000', '13000', 'Rahat Reza', '2019-09-11'),
(7, 'Intel CPU', '10', '50000', '70000', '10', '7000', '13000', 'Rahat Reza', '2019-09-12'),
(8, 'CPU Cooler', '50', '50000', '70000', '10', '7000', '13000', 'Md Ushaed', '2019-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `worker_info`
--

DROP TABLE IF EXISTS `worker_info`;
CREATE TABLE IF NOT EXISTS `worker_info` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker_info`
--

INSERT INTO `worker_info` (`worker_id`, `worker_name`, `designation`, `phone`, `username`, `password`, `branch`) VALUES
(1, 'zim', 'manager', '11122', 'zim', '123', 'dhaka'),
(3, 'Md Ushaed', 'employee', '01761963922', 'ushaed', '123', 'bhola'),
(4, 'Rahat Reza', 'employee', '01716405334', 'rahat', '123', 'Badda');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
