-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 04, 2021 at 12:11 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_entry`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_category` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `book_price` bigint(20) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_id`, `book_name`, `book_category`, `author_name`, `publisher_name`, `book_price`, `cover_image`) VALUES
(48, '60e191f932924', 'The King of Drugs', 'Biographies', 'Nora Barett', 'Tata McGraw', 690, '60e191f932924.jpg'),
(50, '60e19b3b0c0d8', 'C Programming', 'Science and Maths', 'Dennis Ritchie', 'Pearson', 250, '60e19b3b0c0d8.jpg'),
(51, '60e19dec50a98', 'C++ Programming', 'Computer and Technology', 'Dennis Ritchie', 'Pearson', 890, '60e19dec50a98.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `gender`, `email`) VALUES
(3, 'ashishvegan', 'Ashish Vegan', '8cb2237d0679ca88db6464eac60da96345513964', 'Male', 'ashishvegan@gmial.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
