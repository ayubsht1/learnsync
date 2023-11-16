-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 08:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `address`, `contact`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$Y8ImHOpvAmzw1wJrWGIY4eenmwJUwMCxKrtRm8b5jWQlKQRRyDF56', 'chochhen', 1234567899);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `up_date` date NOT NULL DEFAULT current_timestamp(),
  `aId` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `stuId` int(11) NOT NULL,
  `verify` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `uploaddate` datetime NOT NULL DEFAULT current_timestamp(),
  `subId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `duedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `name`, `file`, `uploaddate`, `subId`, `teacherId`, `duedate`) VALUES
(1, 'ada', 'Class.docx', '2023-09-24 00:00:00', 2, 2, '2023-09-25'),
(2, 'assignment2', '1.docx', '2023-09-25 00:00:00', 2, 1, '2023-09-26'),
(3, 'assignment1', 'Assignment DBMS.pdf', '2023-10-09 00:00:00', 4, 1, '2023-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `subId`, `teacherId`, `date`, `name`, `file`) VALUES
(5, 2, 1, '2023-09-21', 'sad', 'Program to implement Gauss Jacobi Method.docx'),
(12, 2, 1, '2023-09-24', '12', 'Program to implement Gauss Jacobi Method.docx'),
(13, 2, 1, '2023-09-24', 'ndgshjfg', '1.docx'),
(14, 2, 1, '2023-09-24', 'aa', 'Class.docx'),
(15, 2, 2, '2023-09-24', 'hello2', 'Class.docx'),
(18, 8, 1, '2023-10-11', 'JHGDSJH', 'Program to implement Gauss Jacobi Method.docx');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semID` int(11) NOT NULL,
  `sem_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semID`, `sem_name`) VALUES
(8, 'eighth'),
(5, 'fifth'),
(1, 'first'),
(4, 'fourth'),
(2, 'second'),
(7, 'seventh'),
(6, 'sixth'),
(3, 'third');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` bigint(10) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `verify` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `semester`, `address`, `email`, `password`, `contact`, `gender`, `verify`) VALUES
(2, 'Ayub Shrestha', '1', 'bhaktapur', 'ayubsht1@gmail.com', '$2y$10$4VR5pBhVuhHMGdG4bnw9YulwQgEDtQz4yi67KWJRyRnfW1k5LFe/G', 9803086711, 'male', 'yes'),
(6, 'rojan dumaru', '1', 'bhaktapur, kamalbinak', 'rojan@gmail.com', '$2y$10$6dYG806Xl.Lhn3ums5z2euwrdSP.wrxYSzQGiD4cLumEzENOtEQAC', 2424242424, 'male', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subCode` varchar(8) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `subCode`, `semester`) VALUES
(2, 'Computers fundamentals', 'cacs', 1),
(3, 'Microprocessor', 'hdsjf', 2),
(4, 'Digital logic', '', 1),
(8, 'Mathematics II', '', 2),
(9, 'C programming', '', 2),
(10, 'English II', '', 2),
(11, 'Account', '', 2),
(22, 'oop in java', '', 3),
(23, 'web technology', '', 3),
(24, 'data structure and algorithm', '', 3),
(25, 'prbability and statistics', '', 3),
(26, 'system analysis and design', '', 3),
(37, 'numerical method', '', 4),
(38, 'software engineering', '', 4),
(39, 'scripting language', '', 4),
(40, 'Database management system', '', 4),
(41, 'operating system', '', 4),
(44, 'Math I', '', 1),
(45, 'English I', '', 1),
(46, 'Society and Technology', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` bigint(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `address`, `contact`, `gender`, `password`, `verify`) VALUES
(1, 'Ayub Shrestha', 'a@gmail.com', 'kathmandu', 9803086711, 'male', '$2y$10$fL1Vj7eaNW66XRh3RcommuEz6Nmb4rDngCRRtqvu..CZpn4CHlom6', 'yes'),
(2, 'bijay', 'bijay@gmail.com', 'kathmandu', 2424242424, 'male', '$2y$10$I/c29YLWkRA9KojJo402.OTOX6wY5guGbuMM92EDo.CAOR./bK02e', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stuId` (`stuId`),
  ADD KEY `tablefk` (`subId`),
  ADD KEY `aId` (`aId`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subId` (`subId`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherId` (`teacherId`),
  ADD KEY `note_ibfk_2` (`subId`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semID`),
  ADD UNIQUE KEY `sem_name` (`sem_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`stuId`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`aId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tablefk` FOREIGN KEY (`subId`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`subId`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`subId`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`semester`) REFERENCES `semester` (`semID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
