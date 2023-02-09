-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2022 at 08:12 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jshoppeaccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `details` varchar(128) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Merch'),
(2, 'Album'),
(3, 'Lightstick'),
(4, 'Photobooks and Magazines'),
(5, 'Clothing'),
(7, 'Collectables');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `details` varchar(128) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_payment` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryinfo`
--

DROP TABLE IF EXISTS `deliveryinfo`;
CREATE TABLE `deliveryinfo` (
  `delivery_id` int(11) NOT NULL,
  `deliveryMethod` varchar(128) NOT NULL,
  `shipping` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryinfo`
--

INSERT INTO `deliveryinfo` (`delivery_id`, `deliveryMethod`, `shipping`) VALUES
(1, 'Provincial', '250.00'),
(2, 'Metro Manila', '150.00'),
(3, 'Meet-up', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryreport`
--

DROP TABLE IF EXISTS `inventoryreport`;
CREATE TABLE `inventoryreport` (
  `inv_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventoryreport`
--

INSERT INTO `inventoryreport` (`inv_id`, `product_name`, `product_id`, `supply_id`, `order_id`, `quantity`, `revenue`, `order_date`) VALUES
(1, 'LISA-LALISA-PHOTOBOOK [SPECIAL EDITION]', 0, 0, 0, 1, '2630.00', '2022-01-21 00:50:51'),
(2, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', 0, 0, 0, 1, '1120.00', '2022-01-21 15:53:03'),
(3, 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', 0, 0, 0, 1, '1300.00', '2022-01-22 02:33:37'),
(4, 'SUMMER DIARY 2021', 0, 0, 0, 1, '2600.00', '2022-01-22 03:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `order_status` varchar(50) DEFAULT 'pending',
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `proofImage` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `usersId`, `product_id`, `product_name`, `quantity`, `user_address`, `delivery`, `payment`, `order_status`, `shipping`, `total`, `order_date`, `proofImage`, `reference`) VALUES
(172, 1, 48, 'BLACKPINK - LISA SOLO PHOTOBOOK LE (0327) VOLUME 2 ', 1, 'Blk 9 Lot 10 & 12 Villa De Sto. Rosario Capas', '150.00, Metro Manila', 'GCASH(PRIMARY)', 'arrived in the Philippines', '150.00', '5370.00', '2022-01-22 02:30:49', '', ''),
(173, 1, 50, 'Rose Album', 1, 'Blk 9 Lot 10 & 12 Villa De Sto. Rosario Capas', '150.00, Metro Manila', 'GCASH(PRIMARY)', 'pending', '150.00', '5370.00', '2022-01-22 02:30:49', '', ''),
(174, 1, 53, 'Rose Album', 1, 'Blk 9 Lot 10 & 12 Villa De Sto. Rosario Capas', '150.00, Metro Manila', 'GCASH(PRIMARY)', 'pending', '150.00', '5370.00', '2022-01-22 02:30:49', '', ''),
(175, 3, 40, 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', 1, 'sa tabi po ng puno sa may don bosco', '150.00, Metro Manila', 'LANDBANK', 'order shipped out', '150.00', '1300.00', '2022-01-22 03:00:27', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `paymentinfo`
--

DROP TABLE IF EXISTS `paymentinfo`;
CREATE TABLE `paymentinfo` (
  `payment_id` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `paymentMethod` varchar(128) NOT NULL,
  `account_number` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`payment_id`, `client`, `paymentMethod`, `account_number`) VALUES
(1, 'JESSICA ANN ORETA', 'GCASH(PRIMARY)', '09204005752'),
(2, 'MARY-ANN ORETA', 'GCASH(SECONDARY)', '09271519897'),
(3, 'JESSICA ANN ORETA', 'BPI BANK ACCOUNT', '2829-3175-65'),
(4, 'JESSICA ANN ORETA', 'LANDBANK', '2696 1231 39'),
(5, 'JESSICA ANN ORETA', 'UNIONBANK', '109355127566'),
(6, 'JESSICA ANN ORETA', 'LBC/CEBUANA/PALAWAN', '09204005752 Makati City');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `details` varchar(128) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Not Featured'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `image`, `category_name`, `product_name`, `details`, `price`, `status`) VALUES
(35, 'bpilsa.jfif', 'Album', 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', '❗️FREEBIES FROM US❗️', '970.00', 'Featured'),
(36, 'bpilsa.jfif', 'Album', 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM 1', '❗️FREEBIES FROM US❗️', '670.00', 'Not Featured'),
(37, 'FJH-BBNVEAUqWw3.jfif', 'Album', 'BLACKPINK LALISA VINYL EXTRA SEALED LIMITED EDITION ', 'ONHAND', '2850.00', 'Featured'),
(38, 'FJH-BBNVEAUqWw3.jfif', 'Album', 'BLACKPINK LALISA VINYL EXTRA SEALED LIMITED EDITION ', 'ONHAND', '2190.00', 'Not Featured'),
(39, 'FGDYLmaVIAMSIxH.jfif', 'Photobooks and Magazines', 'LISA-LALISA-PHOTOBOOK [SPECIAL EDITION]', '💫 PRE ORDER ', '2380.00', 'Featured'),
(40, 'FGDYLmaVIAMSIxH.jfif', 'Photobooks and Magazines', 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', '💫 PRE ORDER ', '1150.00', 'Not Featured'),
(41, 'FFWuWtmVUAEWqZx.jfif', 'Album', 'SEALED - THE ALBUM LIMITED EDITION VINYL', 'w FULL INCLUSION & POB ', '9000.00', 'Featured'),
(42, 'FFWuWtmVUAEWqZx.jfif', 'Album', 'UNSEALED - THE ALBUM LIMITED EDITION VINYL', 'w FULL INCLUSION & POB ', '5000.00', 'Not Featured'),
(43, 'FFWuWtjVQAITnhr.jfif', 'Collectables', 'LISA VERSION 1 Photobook', 'with 1 PC RANDOM POB', '1800.00', 'Featured'),
(44, 'FFWuWtkVIAIpXvp.jfif', 'Collectables', 'SUMMER DIARY 2021', '', '2450.00', 'Not Featured'),
(45, 'FFWuWuMUYAU3ahw.jfif', 'Photobooks and Magazines', 'BLACKPINK SEASON GREETINGS 2021', '', '2390.00', 'Featured'),
(46, 'E8f1QTgVkAE3Ulj.jfif', 'Album', 'BLACKPINK [4+1] THE ALBUM PHOTOBOOK', '', '1520.00', 'Featured'),
(47, 'EzU-hVcUcAAQpRV.jfif', 'Photobooks and Magazines', 'BLACKPINK - 2ND WAVE | OFFICIAL LIMITED EDITION PHOTOBOOK (VERSION 1)', '', '1400.00', 'Not Featured'),
(48, 'EwpQhjAU8AEnPOT.jfif', 'Photobooks and Magazines', 'BLACKPINK - LISA SOLO PHOTOBOOK LE (0327) VOLUME 2 ', 'SPECIAL FREEBIES FROM US', '1350.00', 'Featured'),
(49, 'EwpNE9hVIAI5wCv.jfif', 'Photobooks and Magazines', 'BLACKPINK - LISA SOLO PHOTOBOOK LE ', 'SPECIAL FREEBIES FROM US', '1220.00', 'Not Featured'),
(50, 'EzTWvdzVkAIwE2H.jfif', 'Album', 'Rose Album', '', '400.00', 'Not Featured'),
(53, 'EzTWvdzVkAIwE2H.jfif', 'Album', 'Rose Album', '', '400.00', 'Not Featured');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

DROP TABLE IF EXISTS `purchase_history`;
CREATE TABLE `purchase_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`id`, `order_id`, `usersId`, `product_name`, `delivery`, `quantity`, `payment`, `shipping`, `total`, `order_status`, `order_date`) VALUES
(29, 161, 1, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', '150.00, Metro Manila', '1', 'GCASH(PRIMARY)', '150.00', '1120.00', 'Completed', '0000-00-00 00:00:00'),
(30, 170, 1, 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', '150.00, Metro Manila', '1', 'GCASH(PRIMARY)', '150.00', '5370.00', 'Completed', '0000-00-00 00:00:00'),
(31, 171, 1, 'SUMMER DIARY 2021', '150.00, Metro Manila', '1', 'GCASH(PRIMARY)', '150.00', '5370.00', 'Completed', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(9, 'mrussellguico@gmail.com', '97b844feaba9442a', '$2y$10$M64mP0DI511.MVcb/Ju5duCns.jBqwYKVDxbVDeU0dhpWrZ33Mv6C', '1641569044');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `revenue` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `shipping` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `product_name`, `product_id`, `supply_id`, `order_id`, `quantity`, `cost`, `price`, `revenue`, `order_date`, `shipping`) VALUES
(35, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', 0, 0, 0, 1, '0.00', '0.00', '1220.00', '2022-01-17 15:00:10', '250.00'),
(36, 'BLACKPINK - 2ND WAVE | OFFICIAL LIMITED EDITION PHOTOBOOK (VERSION 1)', 0, 0, 0, 1, '0.00', '0.00', '1550.00', '2022-01-19 22:46:39', '150.00'),
(37, 'LISA-LALISA-PHOTOBOOK [SPECIAL EDITION]', 0, 0, 0, 1, '0.00', '0.00', '2630.00', '2022-01-19 22:48:27', '250.00'),
(38, 'SEALED - THE ALBUM LIMITED EDITION VINYL', 0, 0, 0, 1, '0.00', '0.00', '9000.00', '2022-01-20 21:54:09', '0.00'),
(39, 'LISA-LALISA-PHOTOBOOK [SPECIAL EDITION]', 0, 0, 0, 1, '0.00', '0.00', '2630.00', '2022-01-21 00:50:51', '250.00'),
(40, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', 0, 0, 0, 1, '0.00', '0.00', '1120.00', '2022-01-21 15:53:03', '150.00'),
(41, 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', 0, 0, 0, 1, '0.00', '0.00', '1300.00', '2022-01-22 02:33:37', '150.00'),
(42, 'SUMMER DIARY 2021', 0, 0, 0, 1, '0.00', '0.00', '2600.00', '2022-01-22 03:06:19', '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

DROP TABLE IF EXISTS `shop_info`;
CREATE TABLE `shop_info` (
  `shopInfo_id` int(11) NOT NULL,
  `privacy` varchar(256) NOT NULL,
  `terms_conditions` varchar(256) NOT NULL,
  `data_policy` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`shopInfo_id`, `privacy`, `terms_conditions`, `data_policy`) VALUES
(2, 'sample privacy rule here 2', 'Before submitting the form, make sure that you\'re more than 101% sure buyer.', 'sample data policy here'),
(3, 'hello', 'Please be patient with your orders.', ''),
(4, 'sample privacy rule 2', 'We will ensure that the products will be delivered in your specific address.', ''),
(5, 'sample privacy rule 3', '\r\nAny damage made by the courier or any nature, we, Jess Shoppe are not liable in any damages.', ''),
(6, '', '\r\nWe have no controls in terms of delayed shippines due to the company (e.i., KTOWN4U, YG, and couriers.)', ''),
(7, '', 'Changes on ETA or additional feels will only depend on our supplier, we have no control over it.', ''),
(8, '', 'Please pay the amount needed on time.', ''),
(9, '', 'Everyone who ordered under this form is in LEGAL AGE, or if not, there is a consent from the parents before buying this merchandise', ''),
(10, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

DROP TABLE IF EXISTS `supplies`;
CREATE TABLE `supplies` (
  `supply_id` int(11) NOT NULL,
  `supplier_name` varchar(128) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `inventory` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`supply_id`, `supplier_name`, `product_id`, `product_name`, `inventory`, `cost`) VALUES
(23, 'YGSelect', 35, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', 2, '950.00'),
(24, 'Ktown', 36, 'BLACKPINK LISA FIRST SOLO OFFICIAL ALBUM', 5, '670.00'),
(25, 'YGSelect', 37, 'BLACKPINK LALISA VINYL EXTRA SEALED LIMITED EDITION ', 49, '2800.00'),
(26, 'Ktown', 38, 'BLACKPINK LALISA VINYL EXTRA SEALED LE ', 49, '2100.00'),
(27, 'YGSelect', 39, 'LISA-LALISA-PHOTOBOOK [SPECIAL EDITION]', 98, '2380.00'),
(28, 'Ktown', 40, 'LISA -LALISA- PHOTOBOOK [SPECIAL EDITION]', 1, '1150.00'),
(29, '', 41, 'SEALED - THE ALBUM LIMITED EDITION VINYL', 29, '9000.00'),
(30, '', 42, 'UNSEALED - THE ALBUM LIMITED EDITION VINYL', 29, '5000.00'),
(31, '', 43, 'LISA VERSION 1 Photobook', 8, '1800.00'),
(32, 'YGSelect', 44, 'SUMMER DIARY 2021', 4, '2450.00'),
(33, 'YGSelect', 45, 'BLACKPINK SEASON GREETINGS 2021', 5, '2390.00'),
(34, 'Ktown', 46, 'BLACKPINK [4+1] THE ALBUM PHOTOBOOK', 8, '1500.00'),
(35, '', 47, 'BLACKPINK - 2ND WAVE | OFFICIAL LIMITED EDITION PHOTOBOOK (VERSION 1)', 49, '1390.00'),
(36, 'YGSelect', 48, 'BLACKPINK - LISA SOLO PHOTOBOOK LE (0327) VOLUME 2 ', 20, '1350.00'),
(37, 'Ktown', 49, 'BLACKPINK - LISA SOLO PHOTOBOOK LE (0327) VOLUME 2 ', 30, '1220.00'),
(40, 'YGSelect', 50, 'Rose Album', 0, '300.00'),
(41, 'Ktown', 53, 'Rose Album', 9, '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

DROP TABLE IF EXISTS `updates`;
CREATE TABLE `updates` (
  `updates_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `photos` varchar(50) NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`updates_id`, `title`, `content`, `photos`, `date_posted`) VALUES
(1, 'Photobook', 'Limited Edition', 'EzU-hVcUcAAQpRV.jfif', '2022-01-09 21:32:31'),
(2, 'First Single', 'Limited Edition', 'FJH-BBNVEAUqWw3.jfif', '2022-01-10 20:32:31'),
(3, 'Photobook', '0327 ', 'EwpNE9hVIAI5wCv.jfif', '2022-01-10 21:32:31'),
(4, 'ONHAND', 'Summer Diary', 'FFWuWtkVIAIpXvp.jfif', '2022-01-10 21:34:52'),
(6, 'New Arrival', 'Lisa Version 2', 'EwpQhjAU8AEnPOT.jfif', '2022-01-10 22:32:42'),
(7, 'New Photocard!', 'Grab yours now!', 'FFWuWtjVQAITnhr.jfif', '2022-01-15 14:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `mobile` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `ship_address` varchar(250) NOT NULL,
  `bill_address` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL,
  `verifyImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `usertype`, `status`, `mobile`, `address`, `ship_address`, `bill_address`, `image`, `verifyImage`) VALUES
(1, 'Marc Russell', 'jisoobp@gmail.com', 'JisooBP', '$2y$10$vWbPeFG1SLz0M3Nlk4y8GuKObtdit87Vla1DioNAKyXLI7GL.dTwS', 'user', 'verified', '0916 323 2251', 'Blk 9 Lot 10 & 12 Villa De Sto. Rosario Capas', 'Same as Home Address', 'Transmitter, Navy', 'jisoo.jpg', 'license.jpg'),
(3, 'Drey', 'dreyna@gmail.com', 'Dreykun', '$2y$10$2hzcGbderHO2C0aQNj2Y9OfoBmdumWuslSJU.phvS1ZOjUmtSr.aG', 'user', 'verified', '0919 311 4392', 'sa tabi po ng puno sa may don bosco', '', '', '', ''),
(8, 'Jess', 'jshoppe@gmail.com', 'Jess', '$2y$10$Nm1bVk.1O9LieY/dNGvo1.lV5JbIVCewO1sCU3V7qXXKnNTv3B2JO', 'admin', '', '', '', '', '', 'jisoo.jpg', ''),
(9, 'Darwin', 'dmf@gmail.com', 'Marifox', '$2y$10$XS6vDdqgxJGZZ7sXPGbajOWzTUxcL0Olgd26VG6mgTwZirbEXZckG', 'user', 'verified', '', '', '', '', '', ''),
(14, 'Rakel Mira', 'michaneclaire@gmail.com', 'Mirage', '$2y$10$XjQTLidqJ4GWOwaiiVGSgOty/VALUzquc1fwCZLGqo0h2pnBsg.c2', 'user', 'verified', '0', '123', '', '', '', ''),
(21, 'Anjel', 'ajl@gmail.com', 'Anjel', '$2y$10$NeJgV/GMmAHt1Tjj7DjSZOx7TkSgeWNpTxgVEirNw8hCeiM18XlAG', 'user', 'verified', '', '', '', '', '', ''),
(22, 'Aiel Jhane', 'jhane@gmail.com', 'Blackpink', '$2y$10$pdpFj5w2KXNqMIIrXMt//eQwqwTRly2C.15mBnxJ7w3O3zY3ZmlFK', 'user', 'bogusBuyer', '0919 311 5112', 'Gerona, Tarlac Sample', '', '', '', ''),
(23, 'Ralf Amiel Cabanlong', 'sepulchure@gmail.com', 'Sepulchure', '$2y$10$6GPdSV2KjGexSwzHab1KHOeq9WnRZpWWLHQ.ecuEiXkD/AmPDIeoq', 'user', 'pending', '0921 311 1349', 'Tibag, Tarlac', '', '', 'ryujingenshin.jpg', ''),
(24, 'Deo', 'deo@gmail.com', 'Deo', '$2y$10$NZkuiSt/9J5yjvUSbRjyx.d66Vw.EC6aodSo.EGXsgv.Yp0WSI2Te', 'user', 'verified', '0916 125 2251', 'Camiling, Tarlac', '', '', '', 'drey.jpg'),
(36, 'Marc Guico', 'marcrussellguico@gmail.com', 'Marc', '$2y$10$qrYOLJdcbefrcqMycnGBX.EEB95ZoAtix8.6lgsNxko7cJA49PwiO', 'user', 'verified', '', '', '', '', '1640496464096.jpg', 'license.jpg'),
(37, 'Russell Guico', 'russell@gmail.com', 'Glimpse', '$2y$10$SMhdQLYGtdM6LVHUnQwQgOFPe7d56TV6a2OFecW6BM03C/Kco.t2e', 'user', 'bogusBuyer', '', '', '', '', 'FHtAaXPUUAAm669.jfif', 'card.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `deliveryinfo`
--
ALTER TABLE `deliveryinfo`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `inventoryreport`
--
ALTER TABLE `inventoryreport`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `paymentinfo`
--
ALTER TABLE `paymentinfo`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`shopInfo_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`supply_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`updates_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

--
-- AUTO_INCREMENT for table `deliveryinfo`
--
ALTER TABLE `deliveryinfo`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventoryreport`
--
ALTER TABLE `inventoryreport`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `paymentinfo`
--
ALTER TABLE `paymentinfo`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `shopInfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `updates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
