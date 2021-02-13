-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 04:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `h_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `created_at`) VALUES
(1, 'Python', 'Python is an interpreted, high-level and general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', '2021-01-16 17:02:46'),
(2, 'Javascript', 'JavaScript is the world\'s most popular programming language. JavaScript is the programming language of the Web.', '2021-01-16 17:04:16'),
(3, 'Django', 'Django is a high-level Python Web framework that encourages rapid development and clean, pragmatic design. Built by experienced developers, it takes care of much of the hassle of Web development.\r\n', '2021-01-16 18:21:52'),
(4, 'Flask', 'This is a python framework. Flask is a lightweight WSGI web application framework. It is designed to make getting started quick and easy, with the ability to scale up to complex applications.', '2021-01-16 18:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `text_comment` text NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `text_comment`, `thread_id`, `comment_by`, `comment_time`) VALUES
(4, 'Looking to quickly add Bootstrap to your project? Use jsDelivr, a free open source CDN. Using a package manager or need to download the source files? Head to the downloads page.\r\nCSS', 1, 3, '2021-01-26 20:08:56'),
(7, 'jQuery', 9, 2, '2021-01-29 12:40:41'),
(10, 'google kr lo', 6, 2, '2021-01-29 20:14:04'),
(11, '<i>refer code with harry</i>', 14, 2, '2021-01-29 20:21:56'),
(12, '&lt;i&gt;refer code with harry&lt;/i&gt;', 14, 2, '2021-01-29 20:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `title`, `description`, `user_id`, `category_id`, `timestamp`) VALUES
(1, 'Unable to install jupyter notebook', 'I am unable to install jupyter notebook on windows operating system', 1, 1, '2021-01-23 16:50:51'),
(2, 'Not able to use python', 'Please help me', 1, 1, '2021-01-23 17:07:43'),
(3, 'python', 'python problem', 2, 1, '2021-01-23 18:54:55'),
(5, 'use of map function', '', 2, 1, '2021-01-26 19:31:44'),
(8, 'install problem', '', 5, 1, '2021-01-28 20:35:25'),
(9, 'events in jQuery', '', 5, 2, '2021-01-29 12:13:39'),
(10, 'ML', '', 2, 1, '2021-01-29 12:46:36'),
(11, 'beginner in flask', '', 2, 4, '2021-01-29 20:15:10'),
(12, '&lt;i&gt;i am lost &lt;/&gt;', '', 2, 1, '2021-01-29 20:19:09'),
(14, '&lt;i&gt;how to create a website in django&lt;/i&gt;', '&lt;i&gt;please help&lt;/i&gt;', 2, 3, '2021-01-29 20:21:28'),
(15, 'get_dummies fn in sklearn', '', 5, 1, '2021-01-30 13:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'harry', 'harry@gmail.com', '$2y$10$La9vpE75S4qV8JLOgzBsSOdqBZ96rEsqyStv4iqWTMipRmfHx1gq2', '2021-01-26 22:12:45'),
(2, 'vaishu', 'vaishnavij2000@gmail.com', '$2y$10$rR8mI3luF92D2li5cn0MQ.fJJ7Dxq.aT37VSVnm0k9IPqzYSv30Mi', '2021-01-26 22:15:14'),
(3, 'rohan', 'rohas@gmail.com', '$2y$10$DrvV4TH27OEzwYjzjOIJru9tia5fxfZUpAASOx2GKwmbcQsHu1QGS', '2021-01-26 22:18:45'),
(5, 'harry', 'harry@try.com', '$2y$10$zeQ4Ly8jVVeM1gPOAYiVz.K9SKcuxkFgeFKP5WN9I5n4GY59xaK92', '2021-01-27 19:51:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
