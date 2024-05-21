-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 12:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `quantity` int(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `brand`, `description`, `image`) VALUES
(45, 'Vegetables Grater', '2000', 5, 'Anex', 'The Anex vegetables grater is a versatile kitchen tool that effortlessly shreds and grates vegetables with its sharp stainless steel blades, making meal preparation a breeze. Its compact design and easy-to-use functionality make it a must-have for every kitchen.', 'Vegetables Grater.jpg'),
(46, 'Watch', '500', 10, 'Rado', 'The Rado watch is a sophisticated timepiece that combines impeccable craftsmanship with elegant design.', 'rado-watch.jpg'),
(47, 'Iphone 14 pro max', '465000', 2, 'Apple', 'The Apple iPhone 14 Pro Max is a flagship smartphone with exceptional performance, a stunning display, and a versatile camera system, offering a premium mobile experience for tech enthusiasts.', 'Apple-iPhone-14-Pro-Max.jpg'),
(48, 'Soap', '150', 50, 'Lux', 'Lux soap is a renowned beauty bar that indulges the senses with its rich, creamy lather and enchanting fragrances.', 'lux-soap.jpg'),
(49, 'Oats', '220', 15, 'Nature&#039;s Own', 'Nature&#039;s Own oats are a wholesome and nutritious breakfast staple, packed with fiber and essential nutrients. These hearty oats offer a comforting and filling meal, promoting a healthy start to your day.', 'oats.jpg'),
(50, 'Toy', '55000', 3, 'Lego', 'Lego toys are beloved building sets that inspire creativity and imagination in children and adults alike.', 'lego-toy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `selected_products`
--

CREATE TABLE `selected_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_brand` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selected_products`
--

INSERT INTO `selected_products` (`id`, `user_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_brand`, `product_description`, `product_image`, `created_at`) VALUES
(41, 2, 45, 'Vegetables Grater', '2000.00', 5, 'Anex', 'The Anex vegetables grater is a versatile kitchen tool that effortlessly shreds and grates vegetables with its sharp stainless steel blades, making meal preparation a breeze. Its compact design and easy-to-use functionality make it a must-have for every kitchen.', 'Vegetables Grater.jpg', '2023-06-16 09:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `type`) VALUES
(1, 'Admin', 'admin@smartmart.com.pk', '+923002252255', 'islamabad', '$2y$10$J273Dgrjj.NNnUuMMcNwHulN2SMmuFJJ2dCh0aPW97eLlOMw/gw.u', 'A'),
(2, 'Rafaqat Ahmad', '24784@students.riphah.edu.pk', '03451306043', 'islamabad', '$2y$10$ElKQn1RT/yjkPi.BjN6Jmed3nD2VM9Ns5mGhLfNwLu3L2hRrh0Dka', 'U'),
(3, 'Salman Afaq', '24775@students.riphah.edu.pk', '03041068860', 'Rawalpindi', '$2y$10$lgidxfcjHVLDzm6wsMFag.Jg8y.fv3oPLuDCsIJtr9lyuyiFP.w4G', 'U'),
(4, 'Usman Afaq', '24779@students.riphah.edu.pk', '03334781813', 'Islamabad', '$2y$10$.Rvxy7GbKvFeOY7OwEy7IuiflEAxk7SblbvzHAuibLWf3o8TQtkH.', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_products`
--
ALTER TABLE `selected_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `selected_products`
--
ALTER TABLE `selected_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `selected_products`
--
ALTER TABLE `selected_products`
  ADD CONSTRAINT `selected_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
