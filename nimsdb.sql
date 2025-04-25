-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 06:26 PM
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
-- Database: `nimsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$Kz7WFp0vXcMvSJssDuyQYu1DVH6/76hnE0Iu443CpwUnSTbkT71sm', '2025-04-02 18:52:32'),
(4, 'alam', '$2y$10$oodHnuA/dMP/UKgj6zz4HOPx26PXo3gnYrOMgGQSPJQxApULong1q', '2025-04-04 18:15:37'),
(5, 'afzal', '$2y$10$PScOsuj4DeLUP9FtJ4bZ/.3BYn./NSz3I/I.z10ITCOZY7Z/46Ag6', '2025-04-04 18:17:39'),
(6, 'admin@gmail.com', '$2y$10$vLiO3hFMI5gFoZ9kbH9n9ewRKXzYDcRrIuX/Kw8UtGMAIkOJxztym', '2025-04-04 18:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `image`, `category`, `created_at`) VALUES
(4, 'pizza', 'magi is the best food', 1000.00, 'home-img-1.png', 'Veg', '2025-04-02 23:54:23'),
(5, 'bargur', 'scslckslck', 1000.00, 'home-img-2.png', 'Veg', '2025-04-03 00:10:28'),
(6, 'CHIKEN', 'chiken danturi', 500.00, 'home-img-3.png', 'Non-Veg', '2025-04-03 10:47:23'),
(7, 'ice', 'it is ice', 100.00, 'cat-4.png', 'Dessert', '2025-04-03 17:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'Burger', 'Delicious spicy burger', 99.00, 'burger.jpg', '2025-04-03 06:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`, `status`) VALUES
(3, 2, 'Your table booking has been Confirmed.', 1, '2025-04-04 07:24:27', 'Confirmed'),
(4, 2, 'Your table booking has been Rejected.', 1, '2025-04-04 07:26:42', 'Rejected'),
(5, 2, 'Your table booking has been Confirmed.', 1, '2025-04-04 11:28:55', 'Confirmed'),
(7, 22, 'Your table booking has been Confirmed.', 1, '2025-04-04 18:05:47', 'Confirmed'),
(13, 22, 'Your table booking has been Confirmed.', 0, '2025-04-05 02:59:50', 'Confirmed'),
(14, 1, 'Your table booking has been Confirmed.', 1, '2025-04-05 03:00:04', 'Confirmed'),
(15, 2, 'Your table booking has been Confirmed.', 1, '2025-04-05 03:04:52', 'Confirmed'),
(16, 2, 'Your table booking has been Rejected.', 1, '2025-04-05 03:05:15', 'Rejected'),
(17, 2, 'Your table booking has been Confirmed.', 1, '2025-04-05 03:05:38', 'Confirmed'),
(18, 25, 'Your table booking has been Confirmed.', 1, '2025-04-05 04:50:45', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `user_phone`, `user_address`, `total_price`, `status`, `created_at`) VALUES
(4, 0, 'alam', '9590337483', 'c b bellary', 1000.00, 'Out for Delivery', '2025-04-04 16:55:58'),
(7, 1, 'alam23', '95903374823', 'c b bellary23', 100.00, 'Confirmed', '2025-04-04 18:38:01'),
(8, 1, 'alam23', '95903374823', 'c b bellary23', 1000.00, 'cancelled', '2025-04-04 20:12:08'),
(9, 1, 'alam23', '95903374823', 'c b bellary23', 100.00, 'Pending', '2025-04-04 21:45:44'),
(10, 1, 'alam23', '95903374823', 'c b bellary23', 2000.00, 'Confirmed', '2025-04-04 21:50:28'),
(11, 1, 'alam234', '959033748234', 'c b bellary234', 1000.00, 'Pending', '2025-04-04 21:54:34'),
(12, 1, 'alam2345', '9590337485', 'c b bellary2345', 500.00, 'Pending', '2025-04-04 21:56:02'),
(13, 22, 'afzal2345', '815001706', 'c b bellary81500', 600.00, 'Out for Delivery', '2025-04-04 23:27:20'),
(14, 22, 'afzal2345', '815001706', 'c b bellary81500', 2000.00, 'Confirmed', '2025-04-04 23:33:17'),
(15, 1, 'afzal2345', '815001706', 'c b bellary81500', 700.00, 'Delivered', '2025-04-05 08:14:36'),
(17, 25, 'afzal2345', '815001706', 'c b bellary81500', 1500.00, 'cancelled', '2025-04-05 10:11:40'),
(18, 25, 'afzal2395', '815001706', 'c b bellary81500', 100.00, 'Pending', '2025-04-05 10:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_name`, `quantity`, `price`) VALUES
(4, 4, 'pizza', 1, 1000.00),
(7, 7, 'ice', 1, 100.00),
(8, 8, 'CHIKEN', 2, 500.00),
(9, 9, 'ice', 1, 100.00),
(10, 10, 'bargur', 2, 1000.00),
(11, 11, 'pizza', 1, 1000.00),
(12, 12, 'CHIKEN', 1, 500.00),
(13, 13, 'ice', 1, 100.00),
(14, 13, 'CHIKEN', 1, 500.00),
(15, 14, 'pizza', 2, 1000.00),
(16, 15, 'cold drink', 2, 100.00),
(17, 15, 'CHIKEN', 1, 500.00),
(19, 17, 'CHIKEN', 3, 500.00),
(20, 18, 'ice', 1, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_notifications`
--

CREATE TABLE `order_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('booking','order') NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_notifications`
--

INSERT INTO `order_notifications` (`id`, `user_id`, `type`, `message`, `status`, `created_at`) VALUES
(20, 0, 'order', 'Your order #4 status has been updated to Confirmed.', 'unread', '2025-04-04 11:26:26'),
(21, 0, 'order', 'Your order #5 status has been updated to Confirmed.', 'unread', '2025-04-04 11:42:02'),
(22, 0, 'order', 'Your order #5 status has been updated to Out for Delivery.', 'unread', '2025-04-04 11:45:12'),
(23, 4, 'order', 'Your order #6 status has been updated to Confirmed.', 'unread', '2025-04-04 12:09:18'),
(24, 0, 'order', 'Your order #5 status has been updated to Out for Delivery.', 'unread', '2025-04-04 12:20:38'),
(25, 4, 'order', 'Your order #6 status has been updated to Delivered.', 'unread', '2025-04-04 12:20:44'),
(26, 0, 'order', 'Your order #4 status has been updated to Out for Delivery.', 'unread', '2025-04-04 12:24:13'),
(28, 1, 'order', 'Your order #7 status has been updated to Out for Delivery.', 'read', '2025-04-04 14:35:22'),
(29, 1, 'order', 'Your order #8 status has been updated to Confirmed.', 'read', '2025-04-04 14:42:21'),
(30, 1, 'order', 'Your order #7 status has been updated to Confirmed.', 'read', '2025-04-04 14:47:15'),
(31, 1, 'order', 'Your order #10 status has been updated to Confirmed.', 'read', '2025-04-04 16:21:39'),
(32, 22, 'order', 'Your order #13 status has been updated to Confirmed.', 'read', '2025-04-04 18:02:00'),
(33, 22, 'order', 'Your order #14 status has been updated to Confirmed.', 'read', '2025-04-04 18:03:41'),
(34, 22, 'order', 'Your order #13 status has been updated to Out for Delivery.', 'read', '2025-04-04 18:03:46'),
(35, 1, 'order', 'Your order #15 status has been updated to Confirmed.', 'read', '2025-04-05 02:45:51'),
(36, 1, 'order', 'Your order #15 status has been updated to Out for Delivery.', 'read', '2025-04-05 02:46:42'),
(37, 1, 'order', 'Your order #15 status has been updated to Delivered.', 'read', '2025-04-05 02:47:07'),
(39, 25, 'order', 'Your order #17 status has been updated to Confirmed.', 'read', '2025-04-05 04:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `table_bookings`
--

CREATE TABLE `table_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `guests` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` varchar(100) NOT NULL,
  `status` enum('Pending','Confirmed','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_bookings`
--

INSERT INTO `table_bookings` (`id`, `user_id`, `name`, `phone`, `guests`, `date`, `time`, `message`, `status`, `created_at`, `notified`) VALUES
(1, 1, 'gg', '55555', 4, '2025-04-16', '01:00:00', '', 'Confirmed', '2025-04-04 07:10:56', 0),
(2, 2, 'yyy', '20202020', 6, '2025-04-18', '11:00:00', '', 'Confirmed', '2025-04-04 07:20:32', 0),
(4, 2, 'rrr', '0909', 5, '2025-04-09', '03:00:00', '', 'Confirmed', '2025-04-04 07:26:13', 0),
(5, 2, 'fvf ', '54454211', 3, '2025-04-22', '01:00:00', '', 'Confirmed', '2025-04-04 11:28:15', 0),
(6, 1, 'Alam Nawaz sha', '9590337483', 4, '2025-04-30', '12:00:00', '', 'Confirmed', '2025-04-04 15:21:56', 0),
(7, 22, 'afzal', '8150011706', 7, '2025-04-10', '11:00:00', '', 'Confirmed', '2025-04-04 18:05:20', 0),
(9, 25, 'alam nawaz', '22255555', 4, '2025-04-17', '11:00:00', '', 'Rejected', '2025-04-05 04:50:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `address`, `role`, `reset_token`, `reset_token_expiry`) VALUES
(1, 'Alam Nawaz sha', 'alamalam83802@gmail.com', '$2y$10$kgbSndC.o82hobMsnCRQkOfwK9pjrST38LEWQp0HFZyDO4hAantTS', '09590337483', 'Door No 63 Ward No 24, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', '51f95c80fd2b6de6797c16abb3a5501c8f5b137f647b45adf2eb32b1ea77a5f39ad9986616ac129c0cf515734ac7ccabf022', NULL),
(2, 'Alam ', 'alamalam838@gmail.com', '$2y$10$8oKiE13qw89hMVD.r4zgguMlhTpR6FWu1/ahgGVGa9Z0LaFFbI/Ee', '09590337485', 'Door No 63 Ward No 24, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(13, 'samuuu', 'alamala802@gmail.com', '$2y$10$yPJMAVWGcyleQw0FqOvP4ui1AGFqWekSVorlLteXQW2xJ6ErQBBWS', '09540337086', 'Door No 65 Ward No 28, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(14, 'aaaaaaaaa', 'aaaaaaa802@gmail.com', '$2y$10$A1jS1JjVz0XmhO2YnOB2w.c4ezyr4rTj6004u5Xv0JRLfwbFkoBKa', '0000000', 'Door No 65 Ward No 28, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(16, 'aaaaaaaab', 'bbb802@gmail.com', '$2y$10$wMsJP81WmsEFYGN2Ar.NAu.8GYdK72wdJ0FHxRIpkdPAXdOniGjqm', '00000001', 'Door No 65 Ward No 28, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(17, 'bbbb', 'alam83802@gmail.com', '$2y$10$CFCKnH7MdAqHtTeb2IjPYORZxfYYMrTSk8KZHRMyFheQF8zUFTIfi', '09590337483', 'Door No 63 Ward No 24, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(22, 'afzal3', 'afzal383802@gmail.com', '$2y$10$VrlW7zxZRJYA42lXm3JxCO22wE1gXkyERqvbmkNnoMOj8xNxImSYS', '8150011703', 'Door No 83 Ward No 24, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL),
(25, 'nims', 'nims83802@gmail.com', '$2y$10$h5mYKAlII1QxYLkS20N17eZpubY4XaDp0mJnjKKy4a4HJq2pG0Toy', '8150011706', 'Door No 53 Ward No 24, Near Sai Baba Temple, Bellary, 583101, Bellary, Karnataka, India', 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_notifications`
--
ALTER TABLE `order_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_bookings`
--
ALTER TABLE `table_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_notifications`
--
ALTER TABLE `order_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `table_bookings`
--
ALTER TABLE `table_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
