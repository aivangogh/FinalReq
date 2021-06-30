-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 01:39 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `college_id` varchar(5) NOT NULL,
  `college_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college_id`, `college_name`) VALUES
('COA', 'College of Administration'),
('CAS', 'College of Arts and Sciences'),
('COB', 'College of Business'),
('COE', 'College of Education'),
('COL', 'College of Law'),
('CON', 'College of Nursing'),
('COT', 'College of Technologies');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `college_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `college_id`) VALUES
('BAEcon', 'BA Economics', 'CAS'),
('BAEL', 'BA English Language', 'CAS'),
('BAPsy', 'BA Philosophy', 'CAS'),
('BASoc', 'BA Sociology', 'CAS'),
('BASS', 'BA Social Science', 'CAS'),
('BBE', 'Bachelor of Elementary Education', 'COE'),
('BECE', 'Bachelor of Early Childhood Education', 'COE'),
('BPA', 'BP Administration major in Local Goverance', 'COA'),
('BPE', 'Bachelor of Physical Education', 'COE'),
('BSA', 'BS Accountancy', 'COB'),
('BSAT', 'BS Automotive Technology', 'COT'),
('BSB-MB', 'BS Biology Major in Biotechnology', 'CAS'),
('BSBA-MFM', 'BS Business Administration major in Financial Management', 'COB'),
('BSCD', 'BS Community Development', 'CAS'),
('BSDC', 'BS Development Communication', 'CAS'),
('BSEd-ME', 'Bachelor of Secondary Education Major in English', 'COE'),
('BSEd-MF', 'Bachelor of Secondary Education Major in Filipino', 'COE'),
('BSEd-MM', 'Bachelor of Secondary Education Major in Mathematics', 'COE'),
('BSEd-MS', 'Bachelor of Secondary Education Major in Science', 'COE'),
('BSEd-MSS', 'Bachelor of Secondary Education Major in Social Science', 'COE'),
('BSEH-MEHS', 'BS Environmental Science major in Environmental Heritage Studies', 'CAS'),
('BSEMC-MDAT', 'BS Entertainment and Multimedia Computing major in Digital Animation Technology', 'COT'),
('BSET', 'BS Electronics Technology', 'COT'),
('BSFT', 'BS Food Technology', 'COT'),
('BSHM', 'BS Hospitality Management', 'COB'),
('BSIT', 'BS Information Technology', 'COT'),
('BSM', 'BS Mathematics', 'CAS'),
('BSN', 'BS Nursing', 'CON'),
('JD', 'Juris Doctor', 'COL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(72) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `year_level` int(1) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`college_id`),
  ADD UNIQUE KEY `COLLEGE_NAME` (`college_name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `COURSE_NAME` (`course_name`),
  ADD KEY `COLLEGE_ID` (`college_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL` (`email`),
  ADD KEY `FULL_NAME` (`first_name`,`middle_name`,`last_name`),
  ADD KEY `PHONE` (`phone`),
  ADD KEY `GENDER` (`gender`),
  ADD KEY `ROLE` (`role`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `year_level` (`year_level`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
