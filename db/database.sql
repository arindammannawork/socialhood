-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2025 at 02:36 AM
-- Server version: 11.4.4-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialhood`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `from_username` varchar(50) NOT NULL,
  `to_username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from_username`, `to_username`, `message`, `sent_at`) VALUES
(1, 'akash', 'arindam', 'hello', '2025-02-16 05:47:01'),
(2, 'akash', 'arindam', 'hi', '2025-02-16 06:05:40'),
(3, 'arindam', 'akash', 'hello akash', '2025-02-16 06:06:27'),
(4, 'akash', 'arindam', 'hi', '2025-02-16 06:08:58'),
(5, 'akash', 'arindam', 'hi', '2025-02-16 06:14:19'),
(6, 'arindam', 'akash', 'kire vai', '2025-02-16 06:14:33'),
(7, 'arindam', 'akash', 'kamon achis', '2025-02-16 06:14:40'),
(8, 'arindam', 'akash', 'kalabo janis', '2025-02-16 06:14:46'),
(9, 'arindam', 'akash', 'hi', '2025-02-16 06:14:48'),
(10, 'arindam', 'akash', 'hi', '2025-02-16 06:14:49'),
(11, 'arindam', 'akash', 'hi', '2025-02-16 06:14:52'),
(12, 'arindam', 'akash', 'hmmmmmm', '2025-02-16 06:15:08'),
(13, 'arindam', 'akash', 'hehehehe', '2025-02-16 06:15:25'),
(14, 'arindam', 'akash', 'hi', '2025-02-16 06:18:46'),
(15, 'arindam', 'akash', 'kamon achis', '2025-02-16 06:18:52'),
(16, 'akash', 'arindam', 'hi', '2025-02-16 06:26:35'),
(17, 'arindam', 'akash', 'hello', '2025-02-16 06:26:52'),
(18, 'arindam', 'akash', 'hello', '2025-02-16 06:27:49'),
(19, 'arindam', 'akash', 'kalabo janis', '2025-02-16 06:27:54'),
(20, 'arindam', 'akash', 'hi', '2025-02-16 06:28:03'),
(21, 'akash', 'arindam', 'rrrr', '2025-02-16 06:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `username` varchar(255) NOT NULL,
  `friend_username` varchar(255) NOT NULL,
  `status` enum('pending','accepted','declined') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`username`, `friend_username`, `status`) VALUES
('souvik', 'arindam', 'accepted'),
('akash', 'arindam', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `msg` mediumtext NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'p',
  `dop` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`pid`, `uid`, `msg`, `image`, `type`, `dop`) VALUES
(1, 2, 'hello world\r\n', NULL, 'p', '2025-02-10 12:02:34'),
(2, 1, 'hey friends', '67aa089ff1004.jpg', 'p', '2025-02-10 14:09:35'),
(3, 1, 'sss', '67ab423984025.png', 'p', '2025-02-11 12:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `profile_pic` varchar(50) DEFAULT NULL,
  `cover_pic` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `email`, `password`, `status`, `profile_pic`, `cover_pic`) VALUES
(1, 'arindam', 'Arindam', 'Manna', 'arindammannawork@gmail.com', '$1$$iC.dUsGpxNNJGeOm1dFio/', 0, NULL, NULL),
(2, 'souvik', 'souvik', 'samanta', 'souvik@gmail.com', '$1$$iC.dUsGpxNNJGeOm1dFio/', 0, '67ad7fd97a8dd.jpg', '67ad7fd97c75a.png'),
(3, 'akash', 'Akash', 'Koley', 'akash@gmail.com', '$1$$iC.dUsGpxNNJGeOm1dFio/', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `user_post` (`uid`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_post` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
