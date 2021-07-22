-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 09:42 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(3, 'Hash', 'Hash', 'hash@hash.com', '$2y$10$lwEFwLI4rLqG7I9pXO8iKOPAOgS6BS3jxmlrkzzZF/dyw7.NWea46', '1', NULL),
(6, 'Aaron ', 'Edwards', 'edw15013@byui.edu', '$2y$10$9THHqBnJbo8sdQn03vhOtuSsDd3wg68nzDIihT2xeZH6yMMaNWXY2', '1', NULL),
(7, 'Jacob', 'Edwards', 'thereimer2011@gmail.com', '$2y$10$PVFVonLEli9/1iAx5KXipeF6DaMVeCZ8ZqJ6XOaw9hzIMaRrPkHYK', '1', NULL),
(8, 'Admin', 'User', 'admin@cse340.net', '$2y$10$RztuqweVZ8eF.ako3DGZ8.Lk672/GXh6QbLKX18Pd69LZHx/VXv76', '3', NULL),
(9, 'New', 'User', 'newuser@email.com', '$2y$10$2cXHUDfH/OQzEdWjB0N6kOeo4Bx2/Mzc9Q96hD7pEoODUTh2PLfU2', '1', NULL),
(10, 'lower', 'user', 'loweruser@email.com', '$2y$10$mNyHKZUnhBwWWShov75nqOgoovSPVvcDD/OQGSZtLDmzYE6VXRXNK', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(11) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(41, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-03-21 05:04:25', 1),
(42, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-03-21 05:04:25', 1),
(43, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-03-21 05:04:42', 1),
(44, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-03-21 05:04:42', 1),
(45, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-03-21 05:04:59', 1),
(46, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-03-21 05:04:59', 1),
(47, 3, 'aventador_alt.jpg', '/phpmotors/images/vehicles/aventador_alt.jpg', '2021-03-21 05:05:06', 0),
(48, 3, 'aventador_alt-tn.jpg', '/phpmotors/images/vehicles/aventador_alt-tn.jpg', '2021-03-21 05:05:06', 0),
(49, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-03-21 05:05:18', 1),
(50, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-03-21 05:05:18', 1),
(51, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-03-21 05:05:32', 1),
(52, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-03-21 05:05:32', 1),
(53, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-03-21 05:05:43', 1),
(54, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-03-21 05:05:43', 1),
(55, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-03-21 05:05:54', 1),
(56, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-03-21 05:05:54', 1),
(57, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-03-21 05:06:04', 1),
(58, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-03-21 05:06:04', 1),
(59, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2021-03-21 05:06:16', 1),
(60, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2021-03-21 05:06:16', 1),
(61, 9, 'victoria_alt.jpg', '/phpmotors/images/vehicles/victoria_alt.jpg', '2021-03-21 05:06:32', 0),
(62, 9, 'victoria_alt-tn.jpg', '/phpmotors/images/vehicles/victoria_alt-tn.jpg', '2021-03-21 05:06:32', 0),
(63, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-03-21 05:06:43', 1),
(64, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-03-21 05:06:43', 1),
(65, 10, 'camaro_alt.jpg', '/phpmotors/images/vehicles/camaro_alt.jpg', '2021-03-21 05:07:08', 0),
(66, 10, 'camaro_alt-tn.jpg', '/phpmotors/images/vehicles/camaro_alt-tn.jpg', '2021-03-21 05:07:08', 0),
(67, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-03-21 05:07:22', 1),
(68, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-03-21 05:07:22', 1),
(69, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-03-21 05:07:37', 1),
(70, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-03-21 05:07:37', 1),
(71, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-03-21 05:07:57', 1),
(72, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-03-21 05:07:57', 1),
(73, 17, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-03-21 05:08:08', 1),
(74, 17, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-03-21 05:08:08', 1),
(75, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-03-21 05:09:51', 1),
(76, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-03-21 05:09:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045.00', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100.00', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000.00', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000.00', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000001.00', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000.00', 1, 'Green', 1),
(17, 'DMC', 'DeLorean', 'Back to the Future', '/images/no-image.png', '/images/no-image.png', '121000.00', 1, 'gray', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(7, 'lamborgini review from admin', '2021-04-03 19:18:50', 3, 8),
(12, 'test', '2021-04-03 19:34:20', 3, 8),
(15, ' lamborgini review from admin 2', '2021-04-03 19:44:32', 3, 8),
(16, ' working review from admin', '2021-04-03 19:45:09', 3, 8),
(17, ' working review from admin', '2021-04-03 19:46:45', 3, 8),
(18, ' working review from admin', '2021-04-03 19:47:11', 3, 8),
(19, ' working review from admin', '2021-04-03 19:55:56', 3, 8),
(20, ' working review from admin', '2021-04-03 19:58:17', 3, 8),
(21, ' working review from admin', '2021-04-03 20:00:21', 3, 8),
(22, ' working review from admin', '2021-04-03 20:02:27', 3, 8),
(23, ' working review from admin', '2021-04-03 20:02:40', 3, 8),
(24, ' working review from admin', '2021-04-03 20:03:33', 3, 8),
(25, ' review', '2021-04-03 20:06:24', 3, 8),
(26, ' test comment', '2021-04-03 20:07:02', 3, 8),
(27, ' test comment', '2021-04-03 20:07:26', 3, 8),
(28, ' test comment', '2021-04-03 20:07:46', 3, 8),
(29, ' test comment', '2021-04-03 20:09:07', 3, 8),
(30, ' test comment', '2021-04-03 20:12:13', 3, 8),
(31, ' test comment', '2021-04-03 20:25:58', 3, 8),
(32, ' test comment', '2021-04-03 20:31:06', 3, 8),
(33, ' test output', '2021-04-03 20:36:30', 3, 8),
(34, ' test output 2', '2021-04-03 20:36:51', 3, 8),
(35, ' test output 2', '2021-04-03 20:38:52', 3, 8),
(36, ' test output 2', '2021-04-03 20:39:07', 3, 8),
(37, ' test output 2', '2021-04-03 20:49:48', 3, 8),
(38, ' test output 2', '2021-04-03 20:52:00', 3, 8),
(39, ' test output 2', '2021-04-03 20:56:11', 3, 8),
(40, ' test output 2', '2021-04-03 21:01:15', 3, 8),
(41, ' is it fixed now?', '2021-04-03 21:01:39', 3, 8),
(42, ' test for admin', '2021-04-04 02:01:27', 3, 8),
(43, ' test  for message', '2021-04-04 02:03:59', 3, 8),
(47, ' SCOOOBY DOOOOO', '2021-04-04 19:56:26', 7, 8),
(48, ' new user review', '2021-04-04 20:04:53', 3, 9),
(49, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim est pretium, euismod erat condimentum, accumsan ligula. Vestibulum mattis quam eget turpis gravida accumsan. Sed non lorem vel lectus feugiat imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec ex diam, commodo eu convallis quis, vehicula at odio. Sed scelerisque arcu justo, a tincidunt turpis rhoncus at. Duis enim sapien, cursus a nisi a, convallis viverra lorem. Pellentesque posuere, libero id bibendum condimentum, sem nisi euismod ante, ac condimentum mi arcu et enim. Suspendisse laoreet nisl nec turpis dapibus tincidunt. Cras imperdiet est augue, nec tincidunt nunc sagittis sit amet. Aenean malesuada, tortor at ullamcorper lacinia, dolor quam viverra nibh, vel pellentesque urna eros sit amet tortor. Ut condimentum quis metus sit amet fermentum. Duis hendrerit neque nec consectetur feugiat. Fusce id dui a nisl vulputate congue. ', '2021-04-05 03:07:42', 9, 8),
(53, 'NEW REVIEW', '2021-04-06 18:47:36', 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `user_password`) VALUES
(32, 'some_username', '$2y$10$r0302G9FpLY.NI0F61IKPexpuSuwbljeADrH9rsAe6y.iGNqiyN8y'),
(33, 'some_username', '$2y$10$KJGNl4ydwMO3isUUrb7SH.RnVw/xk/TKa7PKQHhPdwZgaTyjTVDBm'),
(34, 'some_username', '$2y$10$jdv0hh3HcjNyU2O/3PoUSe8njDFyNAL76TOzwAkpyf.tB0Ea3AySu'),
(35, 'some_username', '$2y$10$Noi3JKdVvYDRekbwAevYR.C5QgCqJrf0BAPzzsXf8gaGyWbq2xPd.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
