-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 04:40 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokobuah`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(64) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `image` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `image`) VALUES
('5c5ff9eca8609', 'Buah tropis', '5c5ff9eca8609.jpg'),
('5c60e6ef708b5', 'Buah buahan', 'default.jpg'),
('5c61fffe218cf', 'Buah import', '5c61fffe218cf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `description` text NOT NULL,
  `category_id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `description`, `category_id`) VALUES
('5c60f0096f1e6', 'Durian Montong', 50000, '5c60f0096f1e6.jpg', 'Buah nya tebal, lembut, rasanya manis, segar dan aromanya harum', '5c5ff9eca8609'),
('5c61ffa46b5bc', 'Rambutan', 10000, 'default.jpg', 'Rasanya manis dan segar, buahnya tebal', '5c60e6ef708b5'),
('5c62003608c93', 'Anggur Prancis', 40000, '5c62003608c93.jpg', 'Buah anggur dari perkebunan prancis, masih segar, buahnya besar dan rasanya manis', '5c61fffe218cf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `avatar` varchar(68) NOT NULL DEFAULT 'default.jpg',
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `avatar`, `username`, `password`, `status`) VALUES
('1', 'Inant Kharisma', 'inant@test.com', 'default.jpg', 'inant', '', 'Active'),
('5c59379f103a6', 'Gerro', 'gerro@mail.test', 'default.jpg', 'gerro', '78c408a17424fb92ad2ae0f22650e16f', 'Active'),
('5c5938821b7bf', 'Jakfar', 'jakfar@mail.test', '5c5938821b7bf.jpg', 'jakfar', '', 'Inactive'),
('5c598da94e42b', 'Pak Agus', 'agus@mail.com', '5c598da94e42b.png', 'agus', 'd6a569626ff4cca88408e842c83b9e7e', 'Active'),
('5c5a036275182', 'Rofik', 'rofik@mail.test', '5c5a036275182.png', 'rofik', '1603a3c393e8bda6c498d9f7bda76093', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
