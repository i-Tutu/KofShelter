-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 11:05 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kofshelter`
--

-- --------------------------------------------------------

--
-- Table structure for table `img_tb`
--

CREATE TABLE `img_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img` varchar(60) NOT NULL,
  `name_img` varchar(100) NOT NULL,
  `up_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `img_tb`
--

INSERT INTO `img_tb` (`id`, `user_id`, `img`, `name_img`, `up_date`) VALUES
(10, 8, 'post8-1575240058', '81575240058room.jpg', '01/12/2019'),
(11, 9, 'post9-1575240421', '91575240421two bed.jpg', '01/12/2019'),
(12, 10, 'post10-1575240754', '101575240754single room.jpg', '01/12/2019');

-- --------------------------------------------------------

--
-- Table structure for table `post_ad`
--

CREATE TABLE `post_ad` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rent_category` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` varchar(80) NOT NULL,
  `place` varchar(250) NOT NULL,
  `img` varchar(100) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_ad`
--

INSERT INTO `post_ad` (`id`, `user_id`, `rent_category`, `description`, `price`, `place`, `img`, `time`) VALUES
(32, 8, 'Single Room with Potch', 'A nice and affordable house for rent. Bath and toilet behind the house. Peace environment.', '850 per year', 'Mile 50', 'post8-1575240058', '2019-12-01 22:40:58.487909'),
(33, 9, 'Self-Contained', 'A good and beautiful house for rent. Two bed rooms, kitchen, bath and toilet inside. Nice surroundings and peaceful environment.\r\nDon\'t hesitate to call me if you need it.', '2500 per year', 'Adweso Estate', 'post9-1575240421', '2019-12-01 22:47:01.339238'),
(34, 10, 'Apartment', 'Great and awesome apartment for rent. Three bed room with kitchen, toilet and bath.', '3100 per year', 'Jumapo', 'post10-1575240754', '2019-12-01 22:52:34.219721');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone_number`, `password`, `time`) VALUES
(8, 'Boabeng', 'Kwesi', 'boabengkwesi22@gmail.com', '0547146671', '$2y$10$FfEnEM3iiPeI6He42x1GCerAYKL9Owh7i7YhXjWoRKY21XgLMzzl6', '2019-12-01 22:37:15.149048'),
(9, 'Olivia', 'Inkoom', 'oliviainkoom@gmail.com', '0262828395', '$2y$10$EgPI/EMX4Qq0tQJbWDbosuXvD26K7DYqk7BEu794JPsmiCdwjhKX2', '2019-12-01 22:43:04.687774'),
(10, 'Foster', 'Aboagye', 'fostera@gmail.com', '0234456340', '$2y$10$uVf46/13Kd1Ziw8XR75jdedFPcD71Hj.exy/uav0gcIChuDt9a6RK', '2019-12-01 22:49:56.060273'),
(11, 'Igna', 'Tutu', 'ignatiustutu@gmail.com', '0540395650', '$2y$10$6.KUyZB77XjLhn55diROSOY0olCa2tM.xA/sFx/IV1lzTmpwzWcQO', '2020-01-31 14:14:59.792044');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `img_tb`
--
ALTER TABLE `img_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postad_id` (`img`);

--
-- Indexes for table `post_ad`
--
ALTER TABLE `post_ad`
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
-- AUTO_INCREMENT for table `img_tb`
--
ALTER TABLE `img_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_ad`
--
ALTER TABLE `post_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_ad`
--
ALTER TABLE `post_ad`
  ADD CONSTRAINT `post_ad_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
