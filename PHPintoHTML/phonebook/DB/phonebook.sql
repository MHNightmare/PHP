-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 03:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `phonebook`
--

DROP TABLE IF EXISTS `phonebook`;
CREATE TABLE `phonebook` (
  `EID` int(11) NOT NULL,
  `FName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Num` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `PName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Tlgrm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Data` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Rell` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phonebook`
--

INSERT INTO `phonebook` (`EID`, `FName`, `LName`, `Num`, `PName`, `Tlgrm`, `Data`, `Date`, `Rell`) VALUES
(1, 'هری', 'پاتر', '09131234569', 'profilePhoto.gif', 'harry2000', 'پسر برگزیده', '1397 / 1 / 15', 1),
(2, 'رون', 'ویزلی', '09126644785', 'profilePhoto.gif', 'ronald_w', 'خنگ مو قرمز', '1397 / 1 / 14', 1),
(3, 'هرمیون', 'گرنجر', '09117778523', 'profilePhoto.gif', 'hermione_poffi', 'خرررررخون', '1397 / 1 / 15', 2),
(4, 'جینی', 'ویزلی', '09133639385', 'profilePhoto.gif', 'jiny2000', 'خوش شانس', '1397 / 1 / 15', 2),
(8, 'آلبوس', 'دامبلدور', '09133332457', 'profilePhoto.gif', 'a.v.p.b.dumbeldor', 'مدیریت', '1397 / 1 / 15', 3);

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `RID` int(11) NOT NULL,
  `RName` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`RID`, `RName`) VALUES
(1, 'خانواده'),
(2, 'دوستان'),
(3, 'شغلی');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `UName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `UName`, `Pass`) VALUES
(1, 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phonebook`
--
ALTER TABLE `phonebook`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phonebook`
--
ALTER TABLE `phonebook`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
