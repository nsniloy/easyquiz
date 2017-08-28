-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2017 at 06:31 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.6.29-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easyquize`
--

-- --------------------------------------------------------

--
-- Table structure for table `answered`
--

CREATE TABLE IF NOT EXISTS `answered` (
  `a_serial_no` int(11) NOT NULL AUTO_INCREMENT,
  `qus_no` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`a_serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `serial_no` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(500) NOT NULL,
  `option_1` varchar(100) NOT NULL,
  `option_2` varchar(100) NOT NULL,
  `option_3` varchar(100) NOT NULL,
  `option_4` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`serial_no`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `point`) VALUES
(1, 'Which version of PHP introduced Try/catch Exception?', 'PHP 4', 'PHP 6', 'PHP 7', 'PHP 5', 'PHP 5', 1),
(2, 'Which of the following is/are a PHP code editor?', 'Notepad++', 'Notepad', 'Adobe Dreamweaver', 'All of the mentioned.', 'All of the mentioned.', 1),
(3, 'PHP files have a default file extension of..', '.py', '.html', '.php', '.ph', '.php', 1),
(4, 'What does PHP stand for?', 'Hypertext Preprocesso', 'Pretext Home Page', 'Pretext Hypertext Processor', 'Preprocessor Home Page', 'Hypertext Preprocesso', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `role`, `email`, `total_point`) VALUES
('admin', 'admin', 'ADMIN', 'admin@gmail.com', 0),
('sazin', '123', 'USER', 'sazin@gmail.com', 0),
('dipta', '123', 'USER', 'dipta@gmail.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
