-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 08:49 PM
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
-- Database: `gamestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Console'),
(2, 'Controller'),
(3, 'Game'),
(4, 'Headphone'),
(5, 'Chair'),
(6, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(5, 1, 'PlayStation 5', 'The PlayStation 5 is powered by a custom system on a chip (SoC) designed in tandem by AMD and Sony, integrating a custom 7 nm AMD Zen 2 CPU with eight cores running at a variable frequency capped at 3.5 GHz.', 48000.00, 'images/console4.jpg', '2024-09-23 13:20:09', '2024-09-23 13:20:09'),
(6, 1, 'Xbox X', 'Both Xbox Series X|S consoles deliver next-generation capabilities powered by the Xbox Velocity Architecture, such as faster loading, the ability to seamlessly switch between multiple games with Quick Resume, richer and more dynamic worlds, and frame rates up to 120 FPS.', 45000.00, 'images/console1.jpg', '2024-09-23 13:36:54', '2024-09-23 13:36:54'),
(7, 1, 'Xbox S', 'Both Xbox Series X|S consoles deliver next-generation capabilities powered by the Xbox Velocity Architecture, such as faster loading, the ability to seamlessly switch between multiple games with Quick Resume, richer and more dynamic worlds, and frame rates up to 120 FPS.', 38000.00, 'images/console2.jpg', '2024-09-23 13:37:20', '2024-09-23 13:37:20'),
(8, 1, 'PlayStation 4', 'The console features a hardware on-the-fly zlib decompression module. The original PS4 model supports up to 1080p and 1080i video standards, while the Pro model supports 4K resolution. The console includes a 500 gigabyte hard drive for additional storage, which can be upgraded by the user.', 35000.00, 'images/console3.jpg', '2024-09-23 13:38:14', '2024-09-23 13:38:14'),
(9, 2, 'Xbox controller Blue', 'The Xbox controller features dual vibration motors and a layout similar to the contemporary GameCube controller: two analog triggers, two analog sticks (both are also digitally clickable buttons), a digital directional pad, a Back button, a Start button, two accessory slots and six 8-bit analog action buttons.', 4500.00, 'images/controller2.jpg', '2024-09-23 14:31:12', '2024-09-23 14:31:12'),
(10, 2, 'Xbox controller Red', 'The Xbox controller features dual vibration motors and a layout similar to the contemporary GameCube controller: two analog triggers, two analog sticks (both are also digitally clickable buttons), a digital directional pad, a Back button, a Start button, two accessory slots and six 8-bit analog action buttons.', 4500.00, 'images/controller3.jpg', '2024-09-23 14:31:49', '2024-09-23 14:31:49'),
(12, 2, 'DualSense White', 'Get an edge in gameplay with remappable buttons, tuneable triggers and sticks, changeable stick caps, back buttons, and more. Built with high performance and personalisation in mind, the controller also retains all the immersive features of the DualSense wireless controller.', 5000.00, 'images/controller1.jpg', '2024-09-23 14:34:29', '2024-09-23 14:34:29'),
(13, 2, 'DualSense Black', 'Get an edge in gameplay with remappable buttons, tuneable triggers and sticks, changeable stick caps, back buttons, and more. Built with high performance and personalisation in mind, the controller also retains all the immersive features of the DualSense wireless controller.', 5000.00, 'images/controller6.jpg', '2024-09-23 14:36:29', '2024-09-23 14:36:29'),
(14, 2, 'DualSense Red', 'Get an edge in gameplay with remappable buttons, tuneable triggers and sticks, changeable stick caps, back buttons, and more. Built with high performance and personalisation in mind, the controller also retains all the immersive features of the DualSense wireless controller.', 5000.00, 'images/controller7.jpg', '2024-09-23 14:36:57', '2024-09-23 14:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
