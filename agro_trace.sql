-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2026 at 02:06 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agro_trace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

DROP TABLE IF EXISTS `admin_detail`;
CREATE TABLE IF NOT EXISTS `admin_detail` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'admin', 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

DROP TABLE IF EXISTS `cart_detail`;
CREATE TABLE IF NOT EXISTS `cart_detail` (
  `cart_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `cart_quantity` int(10) NOT NULL,
  `cart_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_id`, `product_id`, `cart_quantity`, `cart_price`) VALUES
(1, 1, 5, 30),
(2, 1, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `cart_master`
--

DROP TABLE IF EXISTS `cart_master`;
CREATE TABLE IF NOT EXISTS `cart_master` (
  `cart_id` int(10) NOT NULL,
  `cart_date` date NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_master`
--

INSERT INTO `cart_master` (`cart_id`, `cart_date`) VALUES
(1, '2026-03-26'),
(2, '2026-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `category_name`) VALUES
(1, 'Fresh Vegetables'),
(2, 'Fresh Fruits'),
(3, 'Grains '),
(4, 'Pulses'),
(6, 'Spices and Condiments');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

DROP TABLE IF EXISTS `customer_detail`;
CREATE TABLE IF NOT EXISTS `customer_detail` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `customer_mobile` varchar(10) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_pass` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`customer_id`, `customer_name`, `customer_address`, `customer_city`, `customer_mobile`, `customer_email`, `customer_pass`) VALUES
(1, 'prince', 'valsad', 'valsad', '1234567890', 'prince@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_detail`
--

DROP TABLE IF EXISTS `farmer_detail`;
CREATE TABLE IF NOT EXISTS `farmer_detail` (
  `farmer_id` int(10) NOT NULL AUTO_INCREMENT,
  `farmer_name` varchar(50) NOT NULL,
  `farmer_address` varchar(200) NOT NULL,
  `farmer_city` varchar(50) NOT NULL,
  `farmer_mobile` varchar(10) NOT NULL,
  `farmer_email` varchar(50) NOT NULL,
  `farmer_pass` varchar(10) NOT NULL,
  `farmer_status` varchar(20) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`farmer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer_detail`
--

INSERT INTO `farmer_detail` (`farmer_id`, `farmer_name`, `farmer_address`, `farmer_city`, `farmer_mobile`, `farmer_email`, `farmer_pass`, `farmer_status`) VALUES
(1, 'farmer', 'valsad', 'valsad', '1234567890', 'farmer@gmail.com', '123456', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `order_mobile` varchar(10) NOT NULL,
  `order_amount` int(10) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `order_date`, `cart_id`, `customer_id`, `order_address`, `order_mobile`, `order_amount`) VALUES
(1, '2026-03-26', 1, 1, 'valsad halar', '1209778091', 150),
(2, '2026-03-26', 2, 1, 'tithal raod', '9876543210', 30);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE IF NOT EXISTS `product_detail` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `farmer_id` int(10) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_id`, `product_name`, `category_id`, `product_description`, `product_price`, `product_unit`, `product_image`, `farmer_id`) VALUES
(1, 'Tomato', 1, 'Fresh red farm tomatoes, juicy and rich in flavor', 30, 'kg', 'perfume_img/1774528360.png', 1),
(2, 'Potato', 1, 'Medium-sized fresh potatoes, ideal for daily cooking', 25, 'kg', 'perfume_img/1774528437.png', 1),
(3, 'Onion', 1, 'Strong-flavored onions, perfect for Indian dishes', 28, 'kg', 'perfume_img/1774528577.png', 1),
(4, 'Spinach', 1, 'Fresh green leafy spinach, rich in iron', 20, 'Grams', 'perfume_img/1774528700.png', 1),
(5, 'Mango', 2, 'Sweet and premium quality mangoes directly from farm', 120, 'kg', 'perfume_img/1774528764.png', 1),
(6, 'Banana', 2, 'Naturally ripened bananas, soft and nutritious', 40, 'Dozen', 'perfume_img/1774528824.png', 1),
(7, 'Apple', 2, 'Juicy and crispy apples from hill farms', 150, 'kg', 'perfume_img/1774528914.png', 1),
(8, 'Papaya', 2, 'Sweet and fresh papaya, rich in vitamins', 35, 'kg', 'perfume_img/1774529019.png', 1),
(9, 'Wheat', 3, 'High-quality whole wheat grains for flour', 30, 'kg', 'perfume_img/1774529291.png', 1),
(10, 'Basmati Rice', 3, 'Long grain aromatic rice, premium quality', 90, 'kg', 'perfume_img/1774529371.png', 1),
(11, 'Toor Dal', 4, 'Clean and processed pigeon peas for daily meals', 110, 'kg', 'perfume_img/1774529424.png', 1),
(12, 'Moong Dal', 4, 'Light and healthy green gram, easy to digest', 120, 'kg', 'perfume_img/1774529504.png', 1),
(13, 'Tumeric', 6, 'Pure and natural turmeric with strong aroma', 90, 'kg', 'perfume_img/1774529766.png', 1),
(14, 'Red Chilli', 6, 'Dried red chillies with strong spice level', 120, 'kg', 'perfume_img/1774529859.png', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_product` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
