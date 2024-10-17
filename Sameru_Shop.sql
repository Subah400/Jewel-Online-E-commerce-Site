
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Database: `Sameru Shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(30) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Sameru', 'sameru@gmail.com', '12345');


--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(115, '66.00', 'paid', 1, 123456789, 'Dhaka ', 'BD', '2023-06-23 09:08:54'),
(118, '30.00', 'paid', 1, 123456789, 'Dhaka  ', 'BD', '2023-06-23 10:23:03'),
(119, '50.00', 'paid', 1, 123456789, 'Dhaka  ', 'BD', '2023-06-23 10:27:08'),
(120, '92.00', 'paid', 6, 123456789, 'Dhaka  ', 'BD', '2023-06-27 21:01:12'),
(121, '92.00', 'not paid', 9, 2147483647, 'Dhaka ', 'Bangladesh', '2023-07-06 12:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_quantity` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(15, 115, '10', 'Simple Bracelet', 'bracelet1.png', 10, 3, 1, '2023-06-23 09:08:54'),
(16, 115, '13', 'Pink Dress', 'cloth1.png', 18, 2, 1, '2023-06-23 09:08:54'),
(17, 116, '10', 'Orange Bag', 'feature2.jpg', 10, 3, 1, '2023-06-23 09:21:23'),
(18, 116, '13', 'Formal Dress', 'cloth4.png', 18, 2, 1, '2023-06-23 09:21:23'),
(19, 117, '10', 'Brown Lather Bag', 'feature1.jpg', 10, 3, 1, '2023-06-23 09:24:01'),
(20, 117, '13', 'Dimondcut Bracelet', 'bracelet2.png', 18, 2, 1, '2023-06-23 09:24:01'),
(21, 118, '10', 'Flowery Bracelet', 'bracelet3.png', 10, 3, 1, '2023-06-23 10:23:03'),
(22, 119, '11', 'Green Frock', 'cloth3.png', 50, 1, 1, '2023-06-23 10:27:08'),
(23, 120, '19', 'Golden Bracelet', 'bracelet4', 92, 1, 6, '2023-06-27 21:01:12'),
(24, 121, '19', 'White Gown', 'cloth2.png', 92, 1, 9, '2023-07-06 12:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(1, 115, 1, '8', '2023-06-23 13:46:37'),
(2, 118, 1, '1CD478092N0662708', '2023-06-23 10:25:35'),
(3, 119, 1, '8DG9287045811064W', '2023-06-23 10:27:20'),
(4, 120, 6, '3WW59610J1866850M', '2023-06-27 21:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(16, 'Simple Bracelet', 'Bracelet', 'Elegent bracelet for elegant womens', 'bracelet1.png', '', '', '', '739.20', 0, ''),
(17, 'Brown Lather Bag', 'Bag', 'Branded bag', 'feature1.jpg', '', '', '', '739.20', 0, ''),
(18, 'Red Bag', 'Bag', 'Branded bag', 'feature3.jpg', '', '', '', '739.20', 0, ''),
(19, 'Orange bag', 'Bag', 'Branded bag', 'feature2.jpg', '', '', '', '739.20', 0, ''),
(20, 'Pink Dress', 'Dress', 'Comfortable Dress', 'cloth1.png', '', '', '', '739.20', 0, ''),
(21, 'White Gown', 'Dress', 'Comfortable Dress', 'cloth2.png', '', '', '', '739.20', 0, ''),
(22, 'Green Frock', 'Dress', 'Comfortable Dress', 'cloth3.png', '', '', '', '739.20', 0, ''),
(23, 'Formal Dress', 'Dress', 'Comfortable Dress', 'cloth4.png', '', '', '', '739.20', 0, ''),
(24, 'Dimondcut Bracelet', 'Bracelet', 'Elegent bracelet for elegant womens', 'bracelet2.png', '', '', '', '739.20', 0, ''),
(25, 'FLowery Bracelet', 'Bracelet', 'Elegent bracelet for elegant womens', 'bracelet3.png', '', '', '', '739.20', 0, ''),
(26, 'Golden Bracelet', 'Bracelet', 'Elegent bracelet for elegant womens', 'bracelet4.png', '', '', '', '739.20', 0, ''),
(27, 'Chrisbella Bag', 'Bag', 'Branded bag', 'feature5.png', '', '', '', '739.20', 0, '');




--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_number` int(11) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_state` varchar(255) NOT NULL,
  `user_zip` int(5) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`,  `user_name`, `user_number`, `user_address`, `user_state`, `user_zip`, `user_email`, `user_password`, `date`) VALUES
(1,  'Methila', 1827004074, 'Bangladesh', 'Dhaka', 7052, 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-28 14:59:29'),
(4,  'Ipty', 2147483647, 'Bangladesh', 'Dhaka', 7052, '', '', '2023-06-27 16:46:14'),
(5,  'Runa', 2147483647, 'Bangladesh', 'Dhaka', 7052, '', '', '2023-06-27 16:47:19'),
(6,  'Mahir', 1827004074, 'Bangladesh', 'Dhaka', 7052, 'mahir106@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-28 16:32:15'),
(7,  'Rana', 1827004074, 'Bangladesh', 'Dhaka', 7052, 'zarif@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-28 15:31:43'),
(8,  'Zarif', 1827004074, 'Bangladesh', 'Dhaka', 7052, 'users@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-29 04:40:25'),
(9,  'Tanvir', 0, '', '', 0, 'user12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-07-06 10:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);



--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;


