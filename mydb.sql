-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2016 at 11:43 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `fecha`
--

CREATE TABLE IF NOT EXISTS `fecha` (
  `id_fecha` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `allDay` varchar(255) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_fecha`,`users_id`),
  KEY `fk_fecha_users1_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `fecha`
--

INSERT INTO `fecha` (`id_fecha`, `title`, `start`, `end`, `users_id`, `description`, `allDay`, `color`) VALUES
(31, 'fgfgf', '2016-05-31 00:00:00', '2016-06-01 00:00:00', 1, '', NULL, '#4986e7'),
(32, 'rere', '2016-05-31 00:00:00', '2016-06-01 00:00:00', 1, '', NULL, '#4986e7'),
(33, 'hola', '2016-05-19 00:00:00', '2016-05-20 00:00:00', 1, '', NULL, '#4986e7'),
(34, 'hola', '2016-05-26 00:00:00', '2016-05-27 00:00:00', 1, '', NULL, '#4986e7'),
(35, 'hola', '2016-05-27 00:00:00', '2016-05-28 00:00:00', 1, '', NULL, '#f83a22'),
(36, 'hola', '2016-05-30 00:00:00', '2016-05-31 00:00:00', 1, 'goasds\n', NULL, '#16a765');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `nota` varchar(45) DEFAULT NULL,
  `ponderacion` varchar(45) DEFAULT NULL,
  `ramo_id_ramo` int(11) NOT NULL,
  `ramo_users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_nota`,`ramo_id_ramo`,`ramo_users_id`),
  KEY `fk_nota_ramo1_idx` (`ramo_id_ramo`,`ramo_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `nota`, `ponderacion`, `ramo_id_ramo`, `ramo_users_id`) VALUES
(1, '6', '0.1', 1, 1),
(2, '4.4', '0.25', 1, 1),
(3, '2', '0.1', 2, 1),
(4, '5', '0.12', 7, 1),
(5, '3', '0.2', 2, 1),
(6, '5.2', '0.3', 1, 1),
(32, '5.5', '0.15', 7, 1),
(33, '5.2', '0.10', 7, 1),
(34, '6.6', '0.12', 1, 1),
(35, '2', '0.2', 8, 2),
(36, '5', '0.2', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ramo`
--

CREATE TABLE IF NOT EXISTS `ramo` (
  `id_ramo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_ramo` varchar(45) DEFAULT NULL,
  `dificultad_ramo` float DEFAULT NULL,
  `promedio_ramo` float DEFAULT NULL,
  `promedio_objetivo` float DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_ramo`,`users_id`),
  KEY `fk_ramo_users_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ramo`
--

INSERT INTO `ramo` (`id_ramo`, `nombre_ramo`, `dificultad_ramo`, `promedio_ramo`, `promedio_objetivo`, `users_id`) VALUES
(1, 'Matematica', 4, 4.052, 5, 1),
(2, 'Lenguaje', 2, 0.8, 5, 1),
(7, 'Ingles', 6, 1.945, 7, 1),
(8, 'Matematica', 2, 1.4, 0, 2),
(9, 'Fisica', NULL, 0, NULL, 2),
(10, 'Ingles', NULL, 0, NULL, 2),
(11, 'Lenguaje', 5, 0, NULL, 2),
(12, 'Ingles', 7, 0, NULL, 3),
(13, 'Matematica', NULL, NULL, NULL, 3),
(14, 'Fisica', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `trn_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(1, 'Daniela', 'ddaviu@gmail.com', 'b0fc08a18d29407428cbac5d2e5cc682', '2016-05-09 16:01:43'),
(2, 'Nicolas', 'nvial@uai.cl', '202cb962ac59075b964b07152d234b70', '2016-05-09 18:16:52'),
(3, 'Fernando', 'fderda@gmail.com', 'b0fc08a18d29407428cbac5d2e5cc682', '2016-05-25 07:04:14');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fecha`
--
ALTER TABLE `fecha`
  ADD CONSTRAINT `fk_fecha_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_ramo1` FOREIGN KEY (`ramo_id_ramo`, `ramo_users_id`) REFERENCES `ramo` (`id_ramo`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ramo`
--
ALTER TABLE `ramo`
  ADD CONSTRAINT `fk_ramo_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
