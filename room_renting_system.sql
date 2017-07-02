-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2017 at 05:05 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_renting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `renter_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `renter_id`, `room_id`, `booking_status`) VALUES
(28, 4, 3, 10, 0),
(29, 4, 1, 5, 1),
(30, 4, 1, 5, 1),
(31, 4, 1, 6, 1),
(37, 2, 1, 5, 1),
(38, 2, 1, 5, 1),
(39, 2, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `account_type` varchar(7) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `username`, `gender`, `contact`, `address`, `account_type`, `city`, `password`) VALUES
(1, 'Nishan', 'Dhungana', 'nishandhungana41@gmail.com', 'Male', '+9779823597146', 'Koteshower,Kathmandu', 'Owner', 'Kathmandu', 'nishan'),
(2, 'Micheal', 'Jackson', 'dhungana41nishan@gmail.com', 'Male', '+9779861211775', 'America', 'Seeker', 'Kathmandu', 'micheal'),
(3, 'Harry', 'Style', 'harrystyle@gmail.com', 'Male', '+9823597146', 'London, UK', 'Owner', 'Kathmandu', 'harry'),
(4, 'Nirmala', 'Dhungana', 'nirmala@gmail.com', 'Female', '+9779849859923', 'Panchkhal-7, Hokse', 'Seeker', 'Kathmandu', 'nirmala'),
(5, 'Rajan', 'Kharel', 'rajankharel09@gmail.com', 'Male', '+9779863646837', 'Koshipari', 'Seeker', 'Kathmandu', '*Rajan@09#'),
(6, 'Barik', 'Ansari', 'barik@gmail.com', 'Male', '986021345678', 'Kathmandu', 'Seeker', 'Kathmandu', 'barik');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `messages`) VALUES
(33, 4, 1, 'hello sir k xa khabar'),
(34, 1, 4, 'thik xa ni'),
(35, 4, 1, 'ka ta ho sir tapai'),
(36, 2, 1, 'Hello sir k xa khabar');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `customer_id`, `room_id`) VALUES
(1, 'IMG_20161027_080954.jpg', 1, NULL),
(2, '2 (2).jpg', 1, 5),
(3, '1.jpg', 1, 6),
(4, '2.jpg', 1, 7),
(5, '3_ianrdjohnson_autumnatmountloftysouthaustralia.jpg', 1, 8),
(6, '13.jpg', 2, NULL),
(7, '20.jpg', 1, 9),
(8, 'IMG_20160413_103446.jpg', 3, NULL),
(9, '59.jpg', 3, 10),
(10, 'IMG_20151021_082617.jpg', 4, NULL),
(11, 'SAM_9469.JPG', 5, NULL),
(12, 'CA-olwp4.jpg', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `no_of_rooms` int(2) NOT NULL,
  `price` double NOT NULL,
  `location` varchar(50) NOT NULL,
  `features` varchar(500) NOT NULL,
  `renter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `size`, `no_of_rooms`, `price`, `location`, `features`, `renter_id`) VALUES
(1, '19*8', 3, 1450, 'baneshwor', 'This is how india play againt pakistan.', 1),
(2, '19*8', 3, 1450, 'baneshwor', 'This is how india play againt pakistan.', 1),
(3, '78*96', 2, 4500, 'kathmandu', 'Spacious, bright and outward facing rooms measuring 27 m2 and totally refurbished. The room comes with double bed or twin beds with Dreamax mattress (manufactured and designed exclusively by Flex for Meliá Hotels International), a modern, fully equipped bathroom finished in top quality bronze coloured ceramics and an independent entrance. It also has a home automation system which automatically regulates the temperature of the room based on guest presence or absence from the room.', 1),
(4, '56*79', 2, 4500, 'anamnagar', 'Hiwla alskdfasff lasdkfja lsfkjalskj alsdjfalsk ', 1),
(5, '8*9', 2, 4500, 'baneshwor', 'Spacious, bright and outward facing rooms measuring 19 m2 and totally refurbished. The room comes with Dreamax bed (manufactured and designed exclusively by Flex for Meliá Hotels International), a modern, fully equipped bathroom finished in top quality bronze coloured ceramics and an independent entrance. It also has a home automation system which automatically regulates the temperature of the room based on guest presence or absence from the room.', 1),
(6, '5*8', 1, 4500, 'baneshwor', 'Spacious, bright and outward facing rooms measuring 27 m2 and with views of Plaza España and Parque de Maria Luisa. Totally refurbished, the room comes with double bed or twin beds with Dreamax mattress (manufactured and designed exclusively by Flex for Meliá Hotels International), a modern, fully equipped bathroom finished in top quality bronze coloured ceramics and an independent entrance. It also has a home automation system which automatically regulates the temperature', 1),
(7, '8*9', 1, 4500, 'baneshwor', 'Spacious, bright and outward facing rooms measuring 27 m2 and with views of Plaza España and Parque de Maria Luisa. Totally refurbished, the room comes with double bed or twin beds with Dreamax mattress (manufactured and designed exclusively by Flex for Meliá Hotels International), a modern, fully equipped bathroom finished in top quality bronze coloured ceramics and an independent entrance. It also has a home automation system', 1),
(8, '45*78', 1, 4500, 'pokhara', 'The exclusive Meliá The Level rooms measuring 27 m2 with a view of Plaza de España and María Luisa Park are superior guestrooms that complement the services and features of Meliá rooms with the exclusive Service The Level. Completely renovated, these rooms are equipped with a double bed or two individual beds with Dreammax ', 1),
(9, '45', 1, 5, 'asd', 'Located on the 9th floor and offering views of Plaza España and Parque de Maria Luisa, these superior category suites measure 51 m2 and come with the services and facilities of the Junior Suite with the exclusive The Level service. Spacious, bright, outward facing rooms and totally refurbished, these rooms come with double bed or twin beds ', 1),
(10, '20*40', 1, 5000, 'Panchkhal', 'The Machiavelli Suite is located on the Machiavelli villa top floor of the royal wing. This opulent suite offers individually decorated style bedroom with king sized bed and modern bathrooms. The suite offers a separate living area and private in room dining area.', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `renter_id` (`renter_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `customer_id` (`sender_id`),
  ADD KEY `renter_id` (`receiver_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `photos_ibfk_2` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `renter_id` (`renter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`renter_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`renter_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
