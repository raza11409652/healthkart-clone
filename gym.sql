-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 02:39 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_product` int(11) NOT NULL,
  `cart_user` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_ip`
--

CREATE TABLE `cart_ip` (
  `cart_ip_id` int(11) NOT NULL,
  `cart_ip_product` int(11) NOT NULL,
  `cart_ip_qty` int(11) NOT NULL,
  `cart_address` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

CREATE TABLE `delivery_status` (
  `delivery_status_id` int(11) NOT NULL,
  `delivery_status_val` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_status`
--

INSERT INTO `delivery_status` (`delivery_status_id`, `delivery_status_val`) VALUES
(1, 'Order Placed'),
(2, 'Order dispatch'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_uid` varchar(1024) NOT NULL,
  `orders_value` int(11) NOT NULL,
  `orders_address` int(11) NOT NULL,
  `orders_user` int(11) NOT NULL,
  `orders_status` tinyint(1) NOT NULL,
  `orders_delivery_status` int(11) NOT NULL DEFAULT 1,
  `orders_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_uid`, `orders_value`, `orders_address`, `orders_user`, `orders_status`, `orders_delivery_status`, `orders_date`) VALUES
(1, 'GK1', 2340, 1, 12, 1, 3, '2019-11-01 18:31:13'),
(3, 'GK3', 5520, 3, 12, 1, 1, '2019-11-03 16:43:22'),
(4, 'GK4', 12960, 4, 12, 1, 1, '2019-11-04 17:54:51'),
(5, 'GK5', 2760, 5, 12, 1, 1, '2019-11-04 17:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_detail_product` int(11) NOT NULL,
  `order_detail_price` int(11) NOT NULL,
  `order_detail_qty` int(11) NOT NULL,
  `order_detail_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_detail_product`, `order_detail_price`, `order_detail_qty`, `order_detail_ref`) VALUES
(6, 1, 2340, 1, 1),
(7, 2, 2760, 2, 3),
(8, 1, 2340, 2, 4),
(9, 2, 2760, 3, 4),
(10, 2, 2760, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `prodcut_desc`
--

CREATE TABLE `prodcut_desc` (
  `prodcut_desc_id` int(11) NOT NULL,
  `prodcut_desc_val` text NOT NULL,
  `prodcut_desc_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodcut_desc`
--

INSERT INTO `prodcut_desc` (`prodcut_desc_id`, `prodcut_desc_val`, `prodcut_desc_ref`) VALUES
(1, 'Comes with Enhanced absorption formula (EAF) that provides 50% higher protein absorption and 60% higher BCAA absorption when compared to other whey proteins', 1),
(2, 'Biozyme Whey Protein by Muscleblaze is India\'s first clinically tested Whey Protein product which is proven and tested for Indian bodies', 1),
(5, 'Biozyme Whey Protein lowers the stomach discomfort in the consumers due to enhanced protein absorption', 1),
(6, 'The product delivers 25g of protein per 33g serving which is roughly 76% protein content and is powered by a combination of Whey Protein Isolate and Whey Protein Concentrate', 1),
(7, 'The delectable Ice Cream Chocolate flavour ensures the customer gets the best of both the worlds in terms of taste and efficacy', 1),
(8, 'MuscleBlaze® Super Gainer XXL Chocolate is exquisitely crafted for elite fitness enthusiasts who strive to gain huge muscles with a sturdy physique as this gainer formula has protein to carbohydrates ratio of 1:5 which boosts your body with a much-needed fuel', 2),
(9, 'Each serving of MuscleBlaze® Super Gainer XXL provides 22.50g of protein obtained from various sources of slow and fast release proteins', 2),
(12, 'With 112g of complex carbohydrates per serving, this Gainer ensures a robust and sustained release of calories to fuel your muscles for long hours', 2),
(13, 'Contains 27 essential vitamins and minerals which boost the immunity and regulate the enzymes in the body', 2),
(14, 'In delectable Chocolate flavor, this Super Gainer XXL does not contain any trans fats or any kind of added sugar', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(1024) NOT NULL,
  `product_image` text NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_price` varchar(512) NOT NULL,
  `product_discount` varchar(256) NOT NULL,
  `product_veg` tinyint(1) NOT NULL DEFAULT 1,
  `product_flavour` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_type`, `product_price`, `product_discount`, `product_veg`, `product_flavour`) VALUES
(1, 'MuscleBlaze Biozyme Whey Protein', 'prd_1058259-MuscleBlaze-Biozyme-Whey-Protein.webp', 3, '2599', '10', 1, 'Ice cream Chocolate'),
(2, 'MuscleBlaze Super Gainer XXL', 'prd_959781-MuscleBlaze-Super-Gainer-XXL-11-lb-Chocolate_o.webp', 5, '4599', '40', 1, 'Chocolate');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_image_url` text NOT NULL,
  `product_image_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_image_url`, `product_image_ref`) VALUES
(1, 'prd_1002441-MuscleBlaze-Biozyme-Whey-Protein-4.webp', 1),
(2, 'prd_998909-MuscleBlaze-Biozyme-Whey-Protein-4.webp', 1),
(3, 'prd_998895-MuscleBlaze-Biozyme-Whey-Protein-4.webp', 1),
(4, 'prd_1058259-MuscleBlaze-Biozyme-Whey-Protein.webp', 1),
(5, 'prd_959781-MuscleBlaze-Super-Gainer-XXL-11-lb-Chocolate_o.webp', 2),
(6, 'prd_959775-MuscleBlaze-Super-Gainer-XXL-11-lb-Chocolate_o.jpg', 2),
(7, 'prd_959769-MuscleBlaze-Super-Gainer-XXL-11-lb-Chocolate_o.jpg', 2),
(8, 'prd_409741-MuscleBlaze-Super-Gainer-XXL-11-lb-Chocolate_o.webp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `product_type_val` varchar(1024) NOT NULL,
  `product_type_image` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_type_val`, `product_type_image`) VALUES
(3, 'Whey Protein', 'protein.svg'),
(4, 'Protein Bars', 'bar-p.svg'),
(5, 'Weight Gainers', 'vitamins.svg'),
(6, 'Creatine', 'medicines.svg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_mode` text NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_mode`, `transaction_date`, `transaction_ref`) VALUES
(1, 'COD (Cash on delivery)', '2019-11-03 11:13:22', 3),
(2, 'COD (Cash on delivery)', '2019-11-04 12:24:51', 4),
(3, 'COD (Cash on delivery)', '2019-11-04 12:27:11', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(1024) NOT NULL,
  `user_email` varchar(1024) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `user_password` text NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_status`) VALUES
(12, 'Khalid', 'hackdroidbykhan@gmail.com', '9835555982', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_address_id` int(11) NOT NULL,
  `user_address_pin` varchar(256) NOT NULL,
  `user_address_val` text NOT NULL,
  `user_address_ref` int(11) NOT NULL,
  `user_address_mobile` varchar(256) NOT NULL,
  `user_address_email` varchar(256) NOT NULL,
  `user_address_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_address_id`, `user_address_pin`, `user_address_val`, `user_address_ref`, `user_address_mobile`, `user_address_email`, `user_address_name`) VALUES
(1, '144411', 'Address Lpu Jalandhar', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'Md Khalid'),
(2, '144411', 'Locationn', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'Khalid'),
(3, '144411', 'Locationn', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'Khalid'),
(4, '144411', 'Address Goes here', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'Khalid'),
(5, '851134', 'Address', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'khalid'),
(6, '851134', 'Address', 12, '9835555982', 'hackdroidbykhan@gmail.com', 'khalid');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `user_token_id` int(11) NOT NULL,
  `user_token_val` text NOT NULL,
  `user_token_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`user_token_id`, `user_token_val`, `user_token_ref`) VALUES
(12, 'dcf93600bbba2cf6f214349c39588527', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_product` (`cart_product`),
  ADD KEY `cart_user` (`cart_user`);

--
-- Indexes for table `cart_ip`
--
ALTER TABLE `cart_ip`
  ADD PRIMARY KEY (`cart_ip_id`),
  ADD KEY `cart_ip_product` (`cart_ip_product`);

--
-- Indexes for table `delivery_status`
--
ALTER TABLE `delivery_status`
  ADD PRIMARY KEY (`delivery_status_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD UNIQUE KEY `orders_uid` (`orders_uid`),
  ADD KEY `orders_user` (`orders_user`),
  ADD KEY `orders_address` (`orders_address`),
  ADD KEY `orders_delivery_status` (`orders_delivery_status`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_detail_ref` (`order_detail_ref`),
  ADD KEY `order_detail_product` (`order_detail_product`);

--
-- Indexes for table `prodcut_desc`
--
ALTER TABLE `prodcut_desc`
  ADD PRIMARY KEY (`prodcut_desc_id`),
  ADD KEY `prodcut_desc_ref` (`prodcut_desc_ref`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type` (`product_type`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_image_ref` (`product_image_ref`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_ref` (`transaction_ref`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_address_id`),
  ADD KEY `user_address_ref` (`user_address_ref`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`user_token_id`),
  ADD KEY `user_token_ref` (`user_token_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart_ip`
--
ALTER TABLE `cart_ip`
  MODIFY `cart_ip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_status`
--
ALTER TABLE `delivery_status`
  MODIFY `delivery_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prodcut_desc`
--
ALTER TABLE `prodcut_desc`
  MODIFY `prodcut_desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `user_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_product`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_user`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cart_ip`
--
ALTER TABLE `cart_ip`
  ADD CONSTRAINT `cart_ip_ibfk_1` FOREIGN KEY (`cart_ip_product`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`orders_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`orders_address`) REFERENCES `user_address` (`user_address_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`orders_delivery_status`) REFERENCES `delivery_status` (`delivery_status_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_detail_ref`) REFERENCES `orders` (`orders_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_detail_product`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `prodcut_desc`
--
ALTER TABLE `prodcut_desc`
  ADD CONSTRAINT `prodcut_desc_ibfk_1` FOREIGN KEY (`prodcut_desc_ref`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_type`) REFERENCES `product_type` (`product_type_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_image_ref`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`transaction_ref`) REFERENCES `orders` (`orders_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_address_ref`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_ibfk_1` FOREIGN KEY (`user_token_ref`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
