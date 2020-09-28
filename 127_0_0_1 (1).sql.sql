-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2020 at 09:44 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp5`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon`
--

DROP TABLE IF EXISTS `addon`;
CREATE TABLE IF NOT EXISTS `addon` (
  `AddOnID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) NOT NULL,
  `AddOnMenuID` int(11) NOT NULL,
  `AddOnQuantity` int(11) NOT NULL,
  PRIMARY KEY (`AddOnID`),
  KEY `AddOnMenuID` (`AddOnMenuID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `addon`
--

INSERT INTO `addon` (`AddOnID`, `OrderID`, `AddOnMenuID`, `AddOnQuantity`) VALUES
(1, 1, 2, 100),
(2, 1, 1, 150),
(49, 79, 1, 40),
(56, 82, 2, 80),
(57, 83, 2, 130),
(58, 85, 1, 50),
(59, 86, 1, 40),
(60, 89, 1, 60),
(61, 90, 1, 30),
(62, 91, 1, 70),
(63, 91, 5, 40),
(64, 91, 7, 30),
(65, 91, 11, 30),
(66, 92, 1, 20),
(67, 92, 3, 20),
(68, 92, 6, 20),
(69, 92, 8, 20),
(70, 92, 11, 30),
(71, 93, 1, 50),
(72, 93, 6, 50),
(73, 93, 8, 50),
(74, 94, 1, 30),
(75, 94, 2, 200),
(76, 95, 1, 50),
(77, 96, 2, 80),
(78, 96, 4, 60),
(79, 97, 1, 30),
(80, 97, 3, 10),
(81, 97, 8, 110),
(82, 97, 10, 110),
(83, 98, 2, 70),
(84, 99, 1, 80),
(85, 104, 1, 10),
(86, 104, 2, 80),
(87, 105, 1, 30),
(88, 106, 1, 10),
(89, 106, 2, 80),
(90, 107, 1, 30),
(91, 108, 1, 10),
(92, 108, 2, 80),
(93, 109, 1, 30),
(94, 110, 1, 10),
(95, 110, 2, 80),
(96, 111, 1, 30),
(97, 112, 1, 10),
(98, 112, 2, 80),
(99, 113, 1, 30),
(100, 114, 1, 10),
(101, 114, 2, 80),
(102, 115, 1, 30),
(103, 116, 1, 10),
(104, 116, 2, 80),
(105, 117, 1, 30),
(106, 118, 1, 10),
(107, 118, 2, 80),
(108, 119, 1, 30),
(109, 119, 4, 120),
(110, 120, 1, 10),
(111, 120, 2, 80),
(112, 121, 1, 30),
(113, 121, 4, 120);

-- --------------------------------------------------------

--
-- Table structure for table `addonmenu`
--

DROP TABLE IF EXISTS `addonmenu`;
CREATE TABLE IF NOT EXISTS `addonmenu` (
  `AddOnMenuID` int(11) NOT NULL AUTO_INCREMENT,
  `AddOnMenuName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `AddOnPricePer10g` float NOT NULL,
  `AddOnCalories` float NOT NULL,
  `AddOnCarbohydrates` float NOT NULL,
  `AddOnProtein` float NOT NULL,
  `AddOnFats` float NOT NULL,
  `AddOnFibre` float NOT NULL,
  PRIMARY KEY (`AddOnMenuID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `addonmenu`
--

INSERT INTO `addonmenu` (`AddOnMenuID`, `AddOnMenuName`, `AddOnPricePer10g`, `AddOnCalories`, `AddOnCarbohydrates`, `AddOnProtein`, `AddOnFats`, `AddOnFibre`) VALUES
(1, 'Salmon', 0.7, 19, 0, 2.5, 0.9, 0),
(2, 'Chicken Breast', 0.4, 15, 0, 3, 0.3, 0),
(3, 'White Rice', 0.1, 13, 2.8, 0.2, 0.02, 0.03),
(4, 'Stir-fried mushroom', 0.2, 5.6, 1.4, 0.15, 0.02, 0.21),
(5, 'Spaghetti', 0.3, 16, 3, 0.5, 0.09, 0.18),
(6, 'Boiled egg', 0.2, 15, 0.1, 1.2, 1, 0),
(7, 'Lettuce', 0.2, 1.4, 0.3, 0.09, 0.1, 0.12),
(8, 'Corn', 0.4, 9, 2, 0.3, 0.1, 0.24),
(10, 'Shrimp', 0.8, 10, 0, 2.4, 0.02, 0),
(11, 'Potato cubes', 0.2, 12.5, 2, 0.2, 0.4, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Age` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `ActivityLevel` float NOT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CustPicture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `TDEE` int(11) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `UserID`, `FirstName`, `LastName`, `Gender`, `Age`, `Weight`, `Height`, `ActivityLevel`, `Address`, `Phone`, `CustPicture`, `TDEE`) VALUES
(1, 3, 'Customer', '1', 'Male', 24, 68, 175, 1, 'Customer 1\'s house address', '0198852024', 'img/profpic/default.png', 2500),
(20, 7, 'Wong', 'Tai Wei', 'Male', 20, 70, 180, 1, 'Wong Tai Wei\'s house address', '0102222024', 'img/profpic/default.png', 2500),
(21, 16, 'SAS', 'SAS', 'Male', 18, 68, 167, 1, '78, jalan 52', '012345699', 'img/profpic/default.png', 2436),
(22, 17, 'q', 'wqrqw', 'Female', 0, 0, 0, 1, 'qweqw', 'qwe', 'img/profpic/default.png', 274),
(23, 18, 'yyy', 'yyy', 'Female', 19, 68, 170, 1, '213213124', '12412312', 'img/profpic/default.png', 3427),
(24, 19, 'sasd', 'sad', 'Female', 21, 81, 169, 1, 'adsas', '123141', 'img/profpic/default.png', 3258),
(25, 20, 'abc', 'abc', 'Male', 17, 63, 170, 1, 'sdaadasfa', '3124123', 'img/profpic/default.png', 2716),
(26, 22, 'saddsa', 'dsadsa', 'Male', 20, 68, 167, 1, 'dsadsfesfesaf', '21421453', 'img/profpic/default.png', 2744),
(27, 23, 'qqq', 'qqq', 'Female', 31, 63, 167, 1, 'dsadsafdsf', '21312214', 'img/profpic/default.png', 3185),
(28, 24, 'qwe', 'qwe', 'Female', 21, 46, 156, 1, '213', '213', 'img/profpic/default.png', 2233),
(29, 25, 'asd', 'asd', 'Female', 41, 56, 152, 1, '213', '213', 'img/profpic/default.png', 2490),
(30, 26, 'zxc', 'zxc', 'Male', 12, 42, 132, 0, '2134', '213451', 'img/profpic/default.png', 0),
(31, 27, 'sdf', 'sdf', 'Male', 31, 101, 167, 1, '2131564564', '534532', 'img/profpic/default.png', 2264),
(32, 28, 'wer', 'wer', 'Male', 16, 64, 152, 1, '1265745', '7623243', 'img/profpic/default.png', 2250),
(33, 29, 'xcv', 'xcv', 'Male', 16, 62, 158, 1, 'dsadsa', '12312451', 'img/profpic/default.png', 1821),
(34, 30, 'qer', 'qer', 'Male', 17, 72, 168, 0, '21312421', '6457642', 'img/profpic/default.png', 0),
(35, 31, 'adf', 'adf', 'Male', 19, 72, 168, 1, '214314125', '99999999', 'img/profpic/default.png', 2497),
(36, 32, 'zcv', 'zcv', 'Male', 19, 72, 191, 0, '2155', '0000', 'img/profpic/default.png', 0),
(37, 33, 'qwr', 'qwr', 'Male', 19, 67, 167, 1, '123', '098', 'img/profpic/default.png', 2735),
(38, 34, 'asf', 'asf', 'Male', 18, 65, 164, 1, '444', '555', 'img/profpic/default.png', 1890),
(39, 35, 'wong', 'wong', 'Male', 20, 70, 176, 0, 'Lot 2024,Desa Bahagia\\r\\nBandar Baru Permyjaya', '102662024', 'img/profpic/default.png', 0),
(42, 38, 'v', 'v', 'Male', 1, 1, 1, 1.2, 'Jalan Teknologi 6', '102662024', 'img/profpic/default.png', 8),
(43, 39, 'Wong', 'Wei', 'Female', 1, 1, 1, 1.3, 'Lot 2024,Desa Bahagia\\r\\nBandar Baru Permyjaya', '123', 'img/profpic/default.png', 224);

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE IF NOT EXISTS `meal` (
  `MealID` int(11) NOT NULL AUTO_INCREMENT,
  `MealName` varchar(100) NOT NULL,
  `MealDesc` varchar(200) NOT NULL,
  `MealPricePerUnit` float NOT NULL,
  `MealCalories` float NOT NULL,
  `MealCarbohydrates` float NOT NULL,
  `MealProtein` float NOT NULL,
  `MealFats` float NOT NULL,
  `MealFibre` float NOT NULL,
  `MealPicture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`MealID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`MealID`, `MealName`, `MealDesc`, `MealPricePerUnit`, `MealCalories`, `MealCarbohydrates`, `MealProtein`, `MealFats`, `MealFibre`, `MealPicture`, `CategoryID`) VALUES
(2, 'Chicken Rice', 'White Rice 200g with 200g skinless boneless chicken breast, sides broccoli and boiled egg', 7.9, 430, 42, 44, 9, 5.1, 'img/chickenrice.jpg', 1),
(4, 'Egg sandwich', '2 slices of sandwich bread with the filling of egg mayo sides with some fresh lettuce', 4.9, 350, 37, 29, 12, 2.2, 'img/eggmayosandwich.jpg', 3),
(5, 'Bolognese Pasta with minced chicken', 'Pasta with minced chicken breast meat and tomato pesto', 7.9, 511, 60, 25, 19, 5, 'img/bolognesepasta', 1),
(6, 'Pasta with chicken breast', 'Spaghetti with 200g grilled succulent chicken breast with mixed herbs and tomato ', 8.9, 503, 60, 30, 15, 5, 'img/chickenpasta.jpg', 1),
(8, 'Salad with Chicken Breast', 'Fresh coral lettuce salad with 200g grilled juicy chicken breast and with one whole boiled egg and some cherry tomatoes', 7.9, 322, 11, 16, 11, 2.5, 'img/chickensalad.jpg', 1),
(9, 'Tortilla wrap with chicken', 'Soft tortilla wrap with 150g grilled chicken breast sides with fresh salad of the day', 8.9, 464, 56, 31, 14, 11, 'img/chickenwrap.jpg', 1),
(10, 'Red Tomato Shrimp with Rice', '150g of shell-less shrimp cooked in a tomato broth, sides with rice and some salad vegetables and egg', 16.9, 380, 36, 39, 4, 5, 'img/shrimprice.jpg', 2),
(11, 'Mushroom Couscous', 'Rice stewed with fresh shiitake mushroom and a hell lot variety of vegetables', 15.9, 380, 30, 35, 8, 7, 'img/mushroomcouscous.jpg', 3),
(12, 'Mushroom Salad', 'Stir-fried mushroom salad sides with some fresh steamed corn', 7.9, 278, 40, 16, 8, 8, 'img/mushroomsalad.jpg', 3),
(13, 'Grilled Salmon with Stir-fried mushroom rice', '150g of grilled salmon with stir-fried rice that contain mushroom, bell peppers, cherry tomatoes and sides with some fresh vegetables', 12.9, 430, 40, 30, 8, 4, 'img/grilledsalmonwithmushroomrice.jpg', 2),
(14, 'Grilled Salmon with Spaghetti', '150g of grilled salmon with 150g of spaghetti, topped with some stir-fried garlic and sides with fresh vegetables', 13.9, 400, 48, 32, 6, 3, 'img/salmonspaghetti', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mealcategory`
--

DROP TABLE IF EXISTS `mealcategory`;
CREATE TABLE IF NOT EXISTS `mealcategory` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mealcategory`
--

INSERT INTO `mealcategory` (`CategoryID`, `CategoryName`) VALUES
(1, 'ChickenMain'),
(2, 'FishMain'),
(3, 'VegeMain');

-- --------------------------------------------------------

--
-- Table structure for table `orderfood`
--

DROP TABLE IF EXISTS `orderfood`;
CREATE TABLE IF NOT EXISTS `orderfood` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `MealID` int(11) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `TotalCalories` float NOT NULL,
  `TotalCarbohydrates` float NOT NULL,
  `TotalProtein` float NOT NULL,
  `TotalFats` float NOT NULL,
  `TotalFibre` float NOT NULL,
  `TotalOrderPrice` float DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `DeliveryDate` date NOT NULL,
  `OrderStatus` varchar(20) NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `MealID` (`MealID`),
  KEY `StaffID` (`StaffID`),
  KEY `PaymentID` (`PaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderfood`
--

INSERT INTO `orderfood` (`OrderID`, `CustomerID`, `MealID`, `Remarks`, `TotalCalories`, `TotalCarbohydrates`, `TotalProtein`, `TotalFats`, `TotalFibre`, `TotalOrderPrice`, `OrderDate`, `DeliveryDate`, `OrderStatus`, `StaffID`, `PaymentID`) VALUES
(1, 1, 2, 'wadadwjvhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhwadadwjvhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhwadadwjvhhhhhhhh', 6969, 12, 34, 56, 78, 88, '2020-08-13', '2020-08-15', 'OrderDelivered', 2, 2),
(76, 20, 9, 'No remarks', 464, 56, 31, 14, 11, 8.9, '2020-08-21', '2020-08-15', 'OrderDelivered', 5, 2),
(78, 20, 2, 'No remarks', 430, 42, 44, 9, 5.1, NULL, '2020-08-24', '2020-08-20', 'OrderDelivered', 5, 1),
(79, 20, 2, 'dsadafsafasfeqwdasdqwdqwda', 506, 42, 54, 12, 5, 10.7, '2020-08-27', '2020-08-29', 'OrderDelivered', 2, 1),
(81, 20, 9, 'dsad', 464, 56, 31, 14, 11, 8.9, '2020-09-06', '2020-09-17', 'Order Received', NULL, NULL),
(82, 21, 2, 'chicken seaprate', 550, 42, 68, 11.4, 5.1, 11.1, '2020-09-07', '2020-09-10', 'OrderReceived', 1, 3),
(83, 21, 8, 'no tomato, tomato is bad', 517, 11, 55, 14.9, 2.5, 13.1, '2020-09-07', '2020-09-24', 'Order Received', NULL, 4),
(84, 21, 6, '', 503, 60, 30, 15, 5, 8.9, '2020-09-07', '2020-09-25', 'Order Received', NULL, 5),
(85, 22, 2, '', 525, 42, 56.5, 13.5, 5.1, 11.4, '2020-09-07', '2020-09-10', 'Order Received', NULL, 7),
(86, 23, 2, '', 506, 42, 54, 12.6, 5.1, 10.7, '2020-09-07', '2020-09-18', 'Order Received', NULL, 8),
(87, 25, 2, '', 430, 42, 44, 9, 5.1, 7.9, '2020-09-07', '2020-09-25', 'Order Received', NULL, 9),
(88, 26, 2, '', 430, 42, 44, 9, 5.1, 7.9, '2020-09-07', '2020-09-26', 'Order Received', NULL, 10),
(89, 27, 11, '', 494, 30, 50, 13.4, 7, 20.1, '2020-09-08', '2020-09-26', 'Order Received', NULL, 12),
(90, 27, 8, '', 379, 11, 23.5, 13.7, 2.5, 10, '2020-09-08', '2020-09-26', 'Order Received', NULL, 16),
(91, 28, 9, '', 702.7, 74.9, 51.37, 22.16, 13.28, 16.2, '2020-09-08', '2020-09-26', 'Order Received', NULL, 18),
(92, 29, 14, '', 549.5, 63.8, 41, 11.24, 4.74, 17.3, '2020-09-08', '2020-09-26', 'Order Received', NULL, 19),
(93, 30, 12, '', 493, 50.5, 36, 18, 9.2, 14.4, '2020-09-08', '2020-09-26', 'Order Received', NULL, 20),
(94, 31, 4, '', 707, 37, 96.5, 20.7, 2.2, 15, '2020-09-08', '2020-09-26', 'Order Received', NULL, 21),
(95, 32, 9, '', 559, 56, 43.5, 18.5, 11, 12.4, '2020-09-08', '2020-09-26', 'Order Received', NULL, 22),
(96, 33, 10, '', 530, 42, 63, 6, 5, 21.3, '2020-09-08', '2020-09-26', 'Order Received', NULL, 23),
(97, 34, 12, '', 557, 64.8, 53.4, 12.04, 10.67, 23.3, '2020-09-09', '2020-09-26', 'Order Received', NULL, 24),
(98, 35, 13, '', 535, 40, 51, 10.1, 4, 15.7, '2020-09-09', '2020-09-26', 'Order Received', NULL, 25),
(99, 36, 11, '', 532, 30, 55, 15.2, 7, 21.5, '2020-09-09', '2020-09-26', 'Order Received', NULL, 26),
(100, 20, 2, '', 430, 42, 44, 9, 5.1, 7.9, '2020-09-09', '2020-09-25', 'Order Received', NULL, 27),
(101, 20, 5, '', 511, 60, 25, 19, 5, 7.9, '2020-09-09', '2020-09-17', 'Order Received', NULL, 28),
(102, 20, 5, '', 511, 60, 25, 19, 5, 7.9, '2020-09-09', '2020-09-12', 'Order Received', NULL, 29),
(103, 20, 5, 'wad', 511, 60, 25, 19, 5, 7.9, '2020-09-09', '2020-09-12', 'Order Received', NULL, 29),
(104, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 30),
(105, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 30),
(106, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 31),
(107, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 31),
(108, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 32),
(109, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 32),
(110, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 33),
(111, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 33),
(112, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 34),
(113, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 34),
(114, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 35),
(115, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 35),
(116, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 36),
(117, 20, 2, '', 487, 42, 50, 9, 5, 10, '2020-09-10', '2020-09-19', 'Order Received', NULL, 36),
(118, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 37),
(119, 20, 2, '', 547, 54, 50, 9, 5, 12.4, '2020-09-10', '2020-09-19', 'Order Received', NULL, 37),
(120, 20, 5, '', 650, 60, 51, 19, 5, 11.8, '2020-09-10', '2020-09-19', 'Order Received', NULL, 38),
(121, 20, 2, '', 547, 54, 50, 9, 5, 12.4, '2020-09-10', '2020-09-19', 'Order Received', NULL, 38);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `PaymentDate` date DEFAULT NULL,
  `PaidAmount` float DEFAULT NULL,
  PRIMARY KEY (`PaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentDate`, `PaidAmount`) VALUES
(1, '2020-09-23', 125),
(2, '2020-09-18', 69),
(3, '2020-09-07', 12),
(4, '2020-09-07', 123),
(5, '2020-09-07', 213),
(6, '2020-09-07', 213),
(7, '2020-09-07', 23),
(8, '2020-09-07', 21),
(9, '2020-09-07', 41),
(10, '2020-09-07', 213),
(11, '2020-09-08', 41),
(12, '2020-09-08', 32),
(13, '2020-09-08', 324),
(14, '2020-09-08', 51),
(15, '2020-09-08', 43),
(16, '2020-09-08', 34),
(17, '2020-09-08', 431),
(18, '2020-09-08', 53),
(19, '2020-09-08', 43),
(20, '2020-09-08', 41),
(21, '2020-09-08', 53),
(22, '2020-09-08', 53.13),
(23, '2020-09-08', 43),
(24, '2020-09-09', 234),
(25, '2020-09-09', 23),
(26, '2020-09-09', 10),
(27, '2020-09-09', 10),
(28, '2020-09-09', 20),
(29, '2020-09-09', 15.8),
(30, '2020-09-10', 43),
(31, '2020-09-10', 43),
(32, '2020-09-10', 32),
(33, '2020-09-10', 43),
(34, '2020-09-10', 21.8),
(35, '2020-09-10', 21.8),
(36, '2020-09-10', 21.8),
(37, '2020-09-10', 24.2),
(38, '2020-09-10', 24.2);

-- --------------------------------------------------------

--
-- Table structure for table `rolename`
--

DROP TABLE IF EXISTS `rolename`;
CREATE TABLE IF NOT EXISTS `rolename` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(20) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rolename`
--

INSERT INTO `rolename` (`RoleID`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` int(11) NOT NULL AUTO_INCREMENT,
  `StaffFName` varchar(50) NOT NULL,
  `StaffLName` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`StaffID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffFName`, `StaffLName`, `UserID`) VALUES
(1, 'admin', '1', 1),
(2, 'staff', '1', 2),
(5, 'Wong', 'SIck', 12),
(7, '1', 'z', 40),
(8, '123', '12', 41),
(9, '1231', '123', 42),
(10, '123', '123', 43);

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

DROP TABLE IF EXISTS `useraccount`;
CREATE TABLE IF NOT EXISTS `useraccount` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(158) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `RoleID` int(11) NOT NULL,
  `Hashemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `LoginCookieHash` varchar(255) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserID`, `Username`, `Password`, `Email`, `RoleID`, `Hashemail`, `LoginCookieHash`, `Active`) VALUES
(1, 'admin', '$2y$10$f2jTTDEnDbrCqSfCJDkdtOyctcNLTrTEv5prWS0/9E1MoRUcPEK0C', 'admin@mail.com', 1, NULL, NULL, 1),
(2, 'staff', '$2y$10$TGSXpQZylPwLB.xojsQlceHXMRMhQX.VmzfanjnYsze8B4GuQVT8u', 'staff@mail.com', 1, NULL, NULL, 1),
(3, 'customer', '$2y$10$UyAzrn0PAk0bT2v/Df/RjOpHMAEMT3Ck/qe4TuyNFLc/4F3qibNUy', 'customer@mail.com', 3, NULL, NULL, 1),
(7, 'a', '$2y$10$UyAzrn0PAk0bT2v/Df/RjOpHMAEMT3Ck/qe4TuyNFLc/4F3qibNUy', 'wei050297@gmail.com', 3, '72da7fd6d1302c0a159f6436d01e9eb0', '$2y$10$5O25hB/KRO092n1WzdX0suZ6/cKtSCbPFSVkhsO4ZKIX1DIiGKXXq', 1),
(9, 'b', '$2y$10$uEs5l7oicin8mA6Nf0jaTuVgs/6aJT6YFzYC9u.NLHOWMe0LQj9zW', 'b@mail.com', 3, 'e4bb4c5173c2ce17fd8fcd40041c068f', NULL, 0),
(12, 'staff1', '$2y$10$tsp2KPZinWw3usA4RWzQVeydmtkcn/BK7BAix6dTKJ.EhkWRwe7CC', 'mingtyre@gmail.com', 2, NULL, NULL, 1),
(13, 'gary', '$2y$10$Oyy3oLuUKdfiRf8PykBTSO2TkPVJ3qZJYLsCN9WfctD4EsGgPO9A2', 'gary@mail.com', 3, '6e7b33fdea3adc80ebd648fffb665bb8', NULL, 0),
(14, 'student', '$2y$10$xo3hwJcqhlCVTPk2tTX40Oi28T3bRqaHW2iBKZUc4dRMVsSL4WYhG', 'student@mail.com', 3, '9908279ebbf1f9b250ba689db6a0222b', NULL, 0),
(15, 'sss', '$2y$10$Ptwaf6Ja3H9J1ZDFedWXG.YKfQ2XbXaSE4C5o1gpF0qD.CWRkOale', 'sss@mail.com', 3, '16c222aa19898e5058938167c8ab6c57', NULL, 1),
(16, 'sas', '$2y$10$jA2TxA3rC73BsGf5P2uLTONQxiVHh/h3BW0alb3vTVazT8umOVovW', 'sas@mail.com', 3, 'c6e19e830859f2cb9f7c8f8cacb8d2a6', NULL, 1),
(17, 'qwerty', '$2y$10$BY/SvRpL3ICfD7CdaYC.Qed3mf3FY3I3XFIYWpoZhFg.8qwPa0r9a', 'qwerty@mail.com', 3, 'ed3d2c21991e3bef5e069713af9fa6ca', NULL, 1),
(18, 'yyy', '$2y$10$588lQz1kuXCovqcdwZXteenCFb9jteUMA9EbQxgtgpjqV61aPLbMa', 'yyy@mail.com', 3, '4b0a59ddf11c58e7446c9df0da541a84', NULL, 1),
(19, 'sad', '$2y$10$UdqL7oyor/KbMRV5FfWGwuilZ9BOII5ds/PG5YhITCW9JQ8AxqZV6', 'sad@mail.com', 3, '250cf8b51c773f3f8dc8b4be867a9a02', NULL, 1),
(20, '123', '$2y$10$SEjjgUgrYU7A428B99nwp.yyq.0DaTTNK0VjM3ffn78MG1pxixyvG', '123@mail.com', 3, 'f57a2f557b098c43f11ab969efe1504b', NULL, 1),
(22, '555', '$2y$10$HHkX.YxCAYzEiCYKXP457OvotiJ1w0J5/NIS3GCzeFStb3qFaDx3S', '555@mail.come', 3, '0ff8033cf9437c213ee13937b1c4c455', NULL, 1),
(23, 'qqq', '$2y$10$CMIx1T5X3ky16dXRT.Wpz.c5Bo8dfHZI21fVNRpS630Cyy9E5ZOiy', 'qqq@mail.com', 3, '6081594975a764c8e3a691fa2b3a321d', NULL, 1),
(24, 'qwe', '$2y$10$qQB8W994PDV1jbq71t242usTnlZYzPs.NcChOnJOQOOvZ8CIcOtO2', 'qwe@mail.com', 3, 'a8c88a0055f636e4a163a5e3d16adab7', NULL, 1),
(25, 'asd', '$2y$10$/lOoeb8zH9rajhqQLApVrer3lkhb1tfcXjzM2BUKhfPPi7z9tRzLi', 'asd@mail.com', 3, '303ed4c69846ab36c2904d3ba8573050', NULL, 1),
(26, 'zxc', '$2y$10$6RhaABetf84phJb.sMnb6uaHWRVsGrv72kAp7S6ffAk98e7pCs67y', 'zxc@mail.com', 3, '5a4b25aaed25c2ee1b74de72dc03c14e', NULL, 1),
(27, 'sdf', '$2y$10$XnCGwwXyqpIqQXkPo7.a5uE1yIFIwGd6j.5iHS0vGVbquPzQMpDpO', 'sdf@mail.com', 3, '3295c76acbf4caaed33c36b1b5fc2cb1', NULL, 1),
(28, 'wer', '$2y$10$guyVMcpokjNIXsMDJ1bHtO/ZtlSMGIUjsD5xffc1IzjMRGJDaxb.S', 'wer@mail.com', 3, '3b8a614226a953a8cd9526fca6fe9ba5', NULL, 1),
(29, 'xcv', '$2y$10$/u0BXQgaVZDBTebI.ARnN.pLEFGhEur803R5QQjqiDKWuBFn.Icb6', 'xcv@mail.com', 3, 'eae27d77ca20db309e056e3d2dcd7d69', NULL, 1),
(30, 'qer', '$2y$10$Jv/0jprzJN05GW8WqjNyA.HutW8w4h43W2oxqnWBHxHIh/tiE1eee', 'qer@mail.com', 3, 'e205ee2a5de471a70c1fd1b46033a75f', NULL, 1),
(31, 'adf', '$2y$10$LyFIPI0rcmLYPlefIWvqAezWo/YIyZeUcvFFle8skj7hNxnyDzZRC', 'adf@mail.com', 3, '556f391937dfd4398cbac35e050a2177', '$2y$10$KyKDWY/hssYMCXR6avdfmOdXtJfb/VAg8Wer3GIe21D92o4jBicVW', 1),
(32, 'zcv', '$2y$10$col41rfK/Z5Jq7388RmuXu398ri9YZ0FxIWlo671OJXauew4161nO', 'zcv@mail.com', 3, '555d6702c950ecb729a966504af0a635', NULL, 1),
(33, 'qwr', '$2y$10$SEGaDPIS4r8.a64UTh4uuuDbYs72zk74ykGS3hE6YnvDkLng7MtFe', 'qwr@mail.com', 3, '84d9ee44e457ddef7f2c4f25dc8fa865', NULL, 1),
(34, 'asf', '$2y$10$92NL2gtjkA5KMi9xH1ANjO/183ty4mYyGR2z36z3uQF8lhculBR5y', 'asf@mail.com', 3, 'c24cd76e1ce41366a4bbe8a49b02a028', NULL, 1),
(35, 'wong', '$2y$10$5IhPSL1En68pXVB0T158.eW3JwTjtNY2CNRo5D.LPo5pIFDTOpeye', 'wong050297@gmail.com', 3, '69cb3ea317a32c4e6143e665fdb20b14', NULL, 1),
(38, 'v', '$2y$10$k0u8ygfN6KsQW/d/x97Xl.zQhjDMIzznh3E3ohF3Ci1qx7iHLV.wq', 'v@gmail.com', 3, '07c5807d0d927dcd0980f86024e5208b', NULL, 1),
(39, 'q', '$2y$10$BW/JsMLyer7skidmmGhpL.KmHUeGBX/hZOgLkkz9xXlvGrlnu1.di', 'b@mail.com', 3, 'a666587afda6e89aec274a3657558a27', NULL, 1),
(40, 'z', '$2y$10$bFVv/Z/KehzrYei6dNn0Te1HPXbsGs5gKPLsq4q9dS.IZYPMjJdLK', 'z@mail.cpm', 2, NULL, NULL, 1),
(41, '12', '$2y$10$oArQ/XViZGATPesqAbR8NegH2PdVy1R1o0Z65i4gsinN3wQaTzwt2', '12@mail.com', 2, NULL, NULL, 1),
(42, 'awdaw', '$2y$10$uGDr9aIoq.T.ZKMKE1DBWe6SUQg5tus2uBuHs3g4nDPRz585l2wBy', '123123123@mail.com', 2, NULL, NULL, 1),
(43, '123123', '$2y$10$86JC7SaNpKbZPMs/gwqOf.e.f4kcq5P18vAiyVqAYkNKTRXHTVsey', '123123123@mail.com', 2, NULL, NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `useraccount` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal`
--
ALTER TABLE `meal`
  ADD CONSTRAINT `meal_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `mealcategory` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderfood`
--
ALTER TABLE `orderfood`
  ADD CONSTRAINT `orderfood_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderfood_ibfk_2` FOREIGN KEY (`MealID`) REFERENCES `meal` (`MealID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderfood_ibfk_3` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderfood_ibfk_4` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `useraccount` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD CONSTRAINT `useraccount_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `rolename` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
