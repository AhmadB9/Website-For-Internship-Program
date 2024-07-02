-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 11:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `indexpage`
--

CREATE TABLE `indexpage` (
  `id` int(11) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `phonenumber` varchar(1000) NOT NULL,
  `body` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indexpage`
--

INSERT INTO `indexpage` (`id`, `location`, `email`, `phonenumber`, `body`) VALUES
(1, 'Beirut, Bir Hasan, United Nations Street.', 'ids_support@gmail.com', '96118595012', 'Unlock Your Potential with Our Online Internship Program .Join us to gain valuable experience and kickstart your career.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(255) NOT NULL,
  `fullname` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `major` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `joiningdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `fullname`, `email`, `password`, `major`, `city`, `phonenumber`, `joiningdate`) VALUES
(3, 'Sara Mohmad', 'sara@gmail.com', '1234', 'Computer Science and Communication', 'Beirut', 70233445, '2023-09-20'),
(4, 'Sami Saeed', 'Sami@gmail.com', '1234', 'Computer Science and Communication', 'Beirut', 34343422, '2023-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `intern`
--

CREATE TABLE `intern` (
  `id` int(255) NOT NULL,
  `fullname` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `university` varchar(1000) NOT NULL,
  `graduationdate` date NOT NULL,
  `major` varchar(1000) NOT NULL,
  `joiningdate` date NOT NULL,
  `cv` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intern`
--

INSERT INTO `intern` (`id`, `fullname`, `email`, `password`, `phonenumber`, `city`, `university`, `graduationdate`, `major`, `joiningdate`, `cv`) VALUES
(25, 'Mohmad Barraj', 'barraj@gmail.com', '1234', '70233445', 'Barja', 'LIU', '2024-02-03', 'Computer Science and Communication', '2023-09-25', 'CV/barraj@gmail.com'),
(26, 'Salem Kher', 'salem@gmail.com', '1234', '1236987', 'Beirut', 'AUB', '2024-05-01', 'Computer Science and Communication', '2023-09-25', 'CV/salem@gmail.com'),
(27, 'Ali Khaled', 'Ali@gmail.com', '1234', '412588484', 'Beirut', 'LAU', '2023-09-30', 'Computer Science and Communication', '2023-09-25', 'CV/Ali@gmail.com'),
(28, 'Malak Seif', 'malak@gmail.com', '1234', '1234567', 'Saida', 'LU', '2023-10-07', 'Computer Science and Communication', '2023-09-25', 'CV/malak@gmail.com'),
(29, 'khaled', 'khaled@gmail.com', '1234', '1234567', 'Saida', 'LU', '2023-10-07', 'Computer Science and Communication', '2023-09-25', 'CV/khaled@gmail.com'),
(31, 'Ahmad Barraj', 'ahmad@gmail.com', '1234', '78945614', 'Barja', 'LIU', '2023-09-30', 'Computer Science and Communication', '2023-09-25', 'CV/ahmad@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `internsinprogram`
--

CREATE TABLE `internsinprogram` (
  `id` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `internid` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internsinprogram`
--

INSERT INTO `internsinprogram` (`id`, `programid`, `internid`, `grade`) VALUES
(42, 15, 25, 90),
(43, 15, 26, 40),
(44, 15, 27, 95),
(45, 15, 28, 0),
(46, 15, 29, 0),
(48, 15, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `body` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `body`) VALUES
(1, 'about', 'Who We Are', 'Integrated Digital Systems (IDS) is a software solutions provider delivering full cycle software development services and products since 1991.\r\nWith a team of more than a hundred professionals, IDS excels in providing turnkey solutions in Information Technology to a diversified range of industries, on an international scale.\r\nToday, IDS positions itself as a key regional player in software development in the MENA region.');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` longtext NOT NULL,
  `requirement` varchar(1000) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `instructorid` int(255) NOT NULL,
  `maxcapacity` int(100) NOT NULL,
  `currentcapacity` int(100) NOT NULL,
  `classroomcode` varchar(1000) NOT NULL,
  `startregistration` date NOT NULL,
  `endregistration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `title`, `description`, `requirement`, `startdate`, `enddate`, `instructorid`, `maxcapacity`, `currentcapacity`, `classroomcode`, `startregistration`, `endregistration`) VALUES
(15, 'November PHP', ' During this program, participants typically work remotely on web development projects, guided by mentors or instructors. They learn to create dynamic and interactive websites, handle databases, and solve real-world coding challenges using PHP. This online internship allows participants to build their resume, gain hands-on experience, and prepare for a career in web development, all from the comfort of their own computer.', 'Communication Skills,Bachelor degree in computer science', '2023-11-01', '2023-11-30', 3, 10, 6, '', '2023-09-22', '2023-09-29'),
(16, 'January .NET', '\r\nAn online internship .NET program is a remote learning opportunity where individuals can acquire practical skills and knowledge related to the .NET framework. .NET is a versatile software development platform used for creating various applications, including web and desktop applications. During this program, participants typically work from their own computers, collaborating with mentors or instructors to develop software projects using .NET technologies.', 'Communication Skills,Bachelor degree in computer science', '2024-01-01', '2024-01-31', 4, 10, 0, '', '2023-12-01', '2023-12-20'),
(17, 'November .NET', 'An online internship .NET program is a remote learning opportunity where individuals can acquire practical skills and knowledge related to the .NET framework. .NET is a versatile software development platform used for creating various applications, including web and desktop applications. During this program, participants typically work from their own computers, collaborating with mentors or instructors to develop software projects using .NET technologies.', 'Communication Skills,Bachelor degree in computer science', '2023-11-01', '2023-12-31', 4, 10, 0, '', '2023-09-25', '2023-10-26'),
(18, 'August PHP', ' During this program, participants typically work remotely on web development projects, guided by mentors or instructors. They learn to create dynamic and interactive websites, handle databases, and solve real-world coding challenges using PHP. This online internship allows participants to build their resume, gain hands-on experience, and prepare for a career in web development, all from the comfort of their own computer.', 'Communication Skills,Bachelor degree in computer science', '2023-08-01', '2023-08-31', 3, 20, 0, '', '2023-07-01', '2023-07-30'),
(19, 'September PHP', ' During this program, participants typically work remotely on web development projects, guided by mentors or instructors. They learn to create dynamic and interactive websites, handle databases, and solve real-world coding challenges using PHP. This online internship allows participants to build their resume, gain hands-on experience, and prepare for a career in web development, all from the comfort of their own computer.', '', '2023-09-01', '2023-09-30', 4, 20, 0, '', '2023-08-01', '2023-08-31'),
(20, 'January PHP ', ' During this program, participants typically work remotely on web development projects, guided by mentors or instructors. They learn to create dynamic and interactive websites, handle databases, and solve real-world coding challenges using PHP. This online internship allows participants to build their resume, gain hands-on experience, and prepare for a career in web development, all from the comfort of their own computer.', 'Communication Skills,Bachelor degree in computer science', '2024-01-01', '2024-01-31', 4, 10, 0, '', '2023-12-01', '2023-12-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indexpage`
--
ALTER TABLE `indexpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `intern`
--
ALTER TABLE `intern`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `internsinprogram`
--
ALTER TABLE `internsinprogram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internsinprogram_ibfk_1` (`internid`),
  ADD KEY `internsinprogram_ibfk_2` (`programid`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING HASH;

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_ibfk_1` (`instructorid`);
ALTER TABLE `program` ADD FULLTEXT KEY `description` (`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `indexpage`
--
ALTER TABLE `indexpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `intern`
--
ALTER TABLE `intern`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `internsinprogram`
--
ALTER TABLE `internsinprogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `internsinprogram`
--
ALTER TABLE `internsinprogram`
  ADD CONSTRAINT `internsinprogram_ibfk_1` FOREIGN KEY (`internid`) REFERENCES `intern` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `internsinprogram_ibfk_2` FOREIGN KEY (`programid`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`instructorid`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
