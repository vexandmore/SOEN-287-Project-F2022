-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 07:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AssignmentID` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`AssignmentID`, `Name`) VALUES
(1, 'Assignment1'),
(2, 'Assignment2'),
(3, 'Assignment3');

-- --------------------------------------------------------

--
-- Table structure for table `final grades`
--

CREATE TABLE `final grades` (
  `StudentID` int(11) NOT NULL,
  `FinalGrade` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final grades`
--

INSERT INTO `final grades` (`StudentID`, `FinalGrade`) VALUES
(40275648, 'B-'),
(40291824, 'B'),
(40215874, 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `AssignmentID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Grade` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`AssignmentID`, `StudentID`, `Grade`) VALUES
(2, 40291824, 92),
(3, 40291824, 82),
(3, 40215874, 75),
(1, 40275648, 80),
(2, 40275648, 95),
(3, 40275648, 81),
(2, 40215874, 91),
(1, 40212004, 1),
(1, 40291824, 100),
(1, 40215874, 99);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `LastName` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Password`, `Email`) VALUES
(40215874, 'Phillipe', 'Tremblay', 'asdf', 'phil@gmail.com'),
(40275648, 'Thomas', 'Lavoie', 'abc', 'thom314@outlook.com'),
(40291824, 'William', 'Lee', 'qwer', 'wilLee@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `FirstName` varchar(128) NOT NULL,
  `LastName` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `TeacherID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`FirstName`, `LastName`, `Email`, `Password`, `TeacherID`) VALUES
('Luke', 'Lawson', 'a@a.com', 'sss', 402999),
('Marc', 'Scattolin', 'marcscattolin@gmail.com', '1234', 4021204);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AssignmentID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
