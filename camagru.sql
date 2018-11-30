-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2018 at 11:53 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(255) NOT NULL,
  `user_img_id` int(255) NOT NULL,
  `friend_id` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_img_id`, `friend_id`, `comment`, `time_stamp`, `img_id`) VALUES
(12, 5, 5, 'Like my picture dude', '2018-11-27 08:20:02', 11),
(13, 5, 3, 'bitch ass', '2018-11-27 08:20:38', 10),
(14, 5, 1, '☹️', '2018-11-27 12:42:03', 14),
(15, 7, 7, 'ghost face killer', '2018-11-28 06:30:50', 16),
(16, 7, 7, 'werwrwer', '2018-11-28 06:39:03', 17),
(17, 7, 7, '', '2018-11-28 06:39:04', 17);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`img_id`, `img_name`, `user_id`, `time_stamp`) VALUES
(9, 'images/gallary/user_5_image_1.png', 5, '2018-11-27 08:19:19'),
(10, 'images/gallary/user_5_image_2.png', 5, '2018-11-27 08:19:33'),
(11, 'images/gallary/user_5_image_3.png', 5, '2018-11-27 08:19:42'),
(12, 'images/gallary/user_5_image_4.png', 5, '2018-11-27 08:27:15'),
(13, 'images/gallary/user_5_image_5.png', 5, '2018-11-27 08:39:30'),
(14, 'images/gallary/user_5_image_6.png', 5, '2018-11-27 08:39:37'),
(15, 'images/gallary/user_7_image_1.png', 7, '2018-11-28 06:05:21'),
(16, 'images/gallary/user_7_image_2.png', 7, '2018-11-28 06:05:31'),
(17, 'images/gallary/user_7_image_3.png', 7, '2018-11-28 06:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `img_id` int(11) NOT NULL,
  `likers_id` int(11) NOT NULL,
  `like_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`img_id`, `likers_id`, `like_status`) VALUES
(15, 7, 1),
(16, 7, 1),
(17, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(255) NOT NULL DEFAULT '0',
  `ver_code` varchar(255) NOT NULL,
  `notify` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passwd`, `email`, `joined`, `active`, `ver_code`, `notify`) VALUES
(3, 'test', 'e75a071d19d6f149291d69ab0b075a1a25241878b19f39061d075ea6e66042d9e11b6fb50deef64110d059273e4c50929e222342b2d5398493500cd1c2c69eea', 'tidilotsotlhe@gmail.com', '2018-11-27 08:46:32', 1, '', 0),
(4, 'Claudz', 'f2ee4da48059ae73696a1d21fd0732f040b11f7d44252cf9295c77d4c742ff7002f09953d41410b65c385a30ddfbdeb2d4a187054e95138c83193fa01a384cc2', 'claudiamabuza0@gmail.com', '2018-11-27 08:47:26', 1, '', 0),
(5, 'Blue', 'c540ab51cd38dd645beb61242d274988934279be0447a48a25c77d17dbb43fb409324a6fb25de8b269263259991999fca6c42bf7ce52ff22b7fba37a436aae3d', 'makwakwa.lunga9712@gmail.com', '2018-11-27 10:17:30', 1, '', 0),
(7, 'Tyler', '3de1244694191a92f1b0a516df476cb6df269aa1b9047643fdd671dde008a80433ab9aa5d6b7cdd940fd7535c51b8fb0c53c60c320a65a2c7fa08514008d00f9', 'zahoxudule@rsvhr.com', '2018-11-28 08:03:45', 1, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `del_com` (`img_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD UNIQUE KEY `img_id` (`img_id`,`likers_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `img_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `del_com` FOREIGN KEY (`img_id`) REFERENCES `gallery` (`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `del_likes` FOREIGN KEY (`img_id`) REFERENCES `gallery` (`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
