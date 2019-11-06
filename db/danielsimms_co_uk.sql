-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2018 at 05:56 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daniqlfw_content-bidder`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `stars` int(1) NOT NULL,
  `description` text NOT NULL,
  `collabs` int(11) NOT NULL,
  `language` varchar(50) NOT NULL,
  `catagory` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `profile_image` varchar(50) DEFAULT 'default_profile_image.png',
  `lowest_bid` decimal(10,2) DEFAULT NULL,
  `time_posted` int(11) NOT NULL,
  `accepted_job` varchar(5) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `user_id`, `username`, `stars`, `description`, `collabs`, `language`, `catagory`, `price`, `profile_image`, `lowest_bid`, `time_posted`, `accepted_job`) VALUES
(5, 4, 'Barry122', 2, 'I own a blog but need someone to write about babies', 39, 'Arabic', 'Baby & Nursery', '0.20', 'default_profile_image.png', NULL, 2147483647, 'false'),
(8, 4, 'Barry122', 2, 'In need of some content for a school website to talk about the dangers of dangerous things', 39, 'Arabic', 'Education', '0.20', 'default_profile_image.png', NULL, 2147483647, 'false'),
(11, 1, 'dannyghandi', 5, 'This is my very good job description', 10, 'English', 'Baby & Nursery', '0.10', 'default_profile_image.png', NULL, 2147483647, 'false'),
(17, 3, 'BGeldofff', 1, 'testing the test thing', 88, 'Afrikaans', 'Food & Restaurants', '0.35', 'default_profile_image.png', NULL, 2147483647, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `stars` int(1) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `bio` text,
  `price` decimal(10,2) DEFAULT NULL,
  `online` varchar(5) DEFAULT 'false',
  `collabs` int(11) DEFAULT NULL,
  `profile_image` varchar(50) DEFAULT 'default_profile_image.png',
  `speciality` varchar(50) DEFAULT NULL,
  `profile_complete` varchar(5) NOT NULL DEFAULT 'false',
  `profile_warning` varchar(15) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `user_id`, `role_id`, `username`, `stars`, `age`, `language`, `bio`, `price`, `online`, `collabs`, `profile_image`, `speciality`, `profile_complete`, `profile_warning`) VALUES
(1, 1, 2, 'dannyghandi', 5, 24, 'English', 'I am danny and i am cool', '0.10', 'true', 10, 'default_profile_image.png', 'Baby & Nursery', 'true', 'false'),
(2, 2, 2, 'Stevoo123', 1, 26, 'English', 'My name is Steve and i am from London and i like to write', '0.60', 'true', 59, 'default_profile_image.png', 'Sports & Leisure', 'true', 'false'),
(3, 3, 1, 'BGeldofff', 1, 22, 'Bulgarian', 'My name is bob and i am cool as cat', '0.35', 'true', 88, 'default_profile_image.png', 'Food & Restaurants', 'true', 'false'),
(4, 4, 1, 'Barry122', 2, 29, 'Arabic', 'This is my BIO', '0.20', 'false', 39, 'default_profile_image.png', 'Baby & Nursery', 'true', 'false'),
(5, 5, 2, 'iAMkelly', 4, 30, 'English', 'i will bring you website to life! Fun and energetic', '0.90', 'true', 71, 'default_profile_image.png', 'Jewellery & Watches', 'true', 'false'),
(6, 6, 2, 'notSAMsmith', 1, 43, 'Latin', 'i like to write about everything, but i like clothing to most. king of fashion', '0.30', 'true', 42, 'default_profile_image.png', 'Clothing', 'true', 'false'),
(7, 7, 2, 'harryShotta', 4, 16, 'Hindi', 'i am a poet who knows it, and so shall all of you, cows go moo', '0.70', 'true', 52, 'default_profile_image.png', 'Toys', 'true', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL DEFAULT '2',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `activation` varchar(50) DEFAULT NULL,
  `forgot_password_expired` varchar(5) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `permission_id`, `firstname`, `lastname`, `email`, `password`, `activation`, `forgot_password_expired`) VALUES
(1, 1, 'Daniel', 'Simms', 'danny_ghandi@hotmail.co.uk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(2, 2, 'Steve', 'Smith', 'steve@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(3, 2, 'Bob', 'Geldof', 'bob@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(4, 2, 'Barry', 'Scott', 'barry@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(5, 2, 'Kelly', 'Keys', 'kelly@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(6, 2, 'Sam', 'Appleyard', 'sam@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true'),
(7, 2, 'Harry', 'styles', 'harry@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
