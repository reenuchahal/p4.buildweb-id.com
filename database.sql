-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 01:18 PM
-- Server version: 5.1.68-cll
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `buildweb_p4`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `liked` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bookmark_id` int(11) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`bookmark_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`, `profile_image`, `active`) VALUES
(95, 1387254343, 1387348536, '66740c9f7aca8cf9497338393897aec2128b2d4b', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, 0, 'Reenu', 'Chahal', 'reenuchahal@hotmail.com', '', 1),
(96, 1387300231, 1387300231, '02f357a57b64570817e5590ae2999f0d6708b8ef', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, 0, 'Smith', 'Jones', 'reenuchahal@icloud.com', '59755e53338509d1fd477a809aca620f.png', 1),
(97, 1387664545, 1387664837, 'dde820c4ae24cc58fc321b25514fe49e5b648aee', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, 0, 'Maggie', 'Cleland', 'reenuchahal@gmail.com', '', 1),
(98, 1387665323, 1387665323, 'ea84f397faf832d91c503ff2968cb071950c5524', '56d1c31698b4032a43962db09b6ae6de64a1dea9', 0, 0, 'user', 'test', 'user@test.com', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'follower',
  `user_id_followed` int(11) NOT NULL COMMENT 'followed',
  PRIMARY KEY (`user_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=195 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(192, 1387664340, 96, 95),
(193, 1387664658, 97, 96),
(194, 1387664784, 97, 95);

-- --------------------------------------------------------

--
-- Table structure for table `user_bookmarks`
--

CREATE TABLE IF NOT EXISTS `user_bookmarks` (
  `bookmark_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `notes` text NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`bookmark_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `user_bookmarks`
--

INSERT INTO `user_bookmarks` (`bookmark_id`, `user_id`, `title`, `notes`, `created`, `modified`, `url`) VALUES
(37, 96, 'PHP Explode Function', 'Returns an array of strings, each of which is a substring of string formed by splitting it on boundaries formed by the string delimiter.', 1387664396, 1387664396, 'http://www.php.net/manual/en/function.explode.php'),
(38, 97, 'HTML entities', 'Entities are used to implement reserved characters or to express characters that cannot easily be entered with the keyboard.\\r\\n', 1387664763, 1387664763, 'http://www.w3schools.com/tags/ref_entities.asp');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`bookmark_id`) REFERENCES `user_bookmarks` (`bookmark_id`),
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `users_users`
--
ALTER TABLE `users_users`
  ADD CONSTRAINT `users_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD CONSTRAINT `user_bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
