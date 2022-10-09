-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 02:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `user_id` varchar(5) NOT NULL,
  `post_id` varchar(5) NOT NULL,
  `body` varchar(5000) NOT NULL,
  `time_created` time NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` varchar(5) NOT NULL,
  `categories` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `categories`) VALUES
('F0001', 'C++'),
('F0002', 'Python'),
('F0003', 'Java'),
('F0004', 'Ruby'),
('F0005', 'SQL'),
('F0006', 'PHP'),
('F0007', 'C'),
('F0008', 'Javascript');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(5) NOT NULL,
  `title` varchar(300) NOT NULL,
  `body` mediumtext NOT NULL,
  `like_ammount` int(11) NOT NULL,
  `comment_ammount` int(11) NOT NULL,
  `time_created` time NOT NULL,
  `date_created` date NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `forum_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `like_ammount`, `comment_ammount`, `time_created`, `date_created`, `user_id`, `forum_id`) VALUES
('p0001', 'test', 'dkfa[fdkakadf[psafdoapsdofsd[a', 0, 0, '00:00:09', '2007-10-22', '00001', 'F0001'),
('p0002', 'testing 2', 'bla bla bla', 0, 0, '00:00:11', '2007-10-22', '00001', 'F0002'),
('p0003', 'CAWDSA', 'infromatika is good', 0, 0, '00:00:02', '2007-10-22', '00001', 'F0004'),
('p0004', 'testing, testing', '迪诶吾娜迪娜诶迪诶吾迪娜诶诶迪弗尺艾尺吉诶弗勒艾艾吉艾迪艾诶娜迪艾勒艾艾诶娜迪屁艾勒艾艾诶娜迪艾', 0, 0, '00:00:04', '2022-10-08', '00001', 'F0008'),
('p0005', 'AUTO FISHING WEB', 'fish', 0, 0, '00:00:05', '2022-10-08', '00003', 'F0002'),
('p0006', 'FISHING 2', 'fish fish', 0, 0, '00:00:06', '2022-10-08', '00003', 'F0004'),
('p0007', 'FISHING 3', 'fish fish fish', 0, 0, '00:00:06', '2022-10-08', '00003', 'F0002'),
('p0008', 'suk dik ', 'adwasdsafafdfasfsasdfdfasasdfsdfasf', 0, 0, '00:00:07', '2022-10-08', '00004', 'F0007'),
('p0009', 'suk dik mor', 'adwasdsafafdfasfsasdfdfasasdfsdfasf dassdaasd ', 0, 0, '00:00:07', '2022-10-08', '00004', 'F0005');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_key` varchar(30) NOT NULL,
  `encrypted_password` varchar(50) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `user_key`, `encrypted_password`, `img`, `name`) VALUES
('00001', 'ivanhalim', 'ivanhalim888@gmail.com', '49sN7Ea!ri8c9jLy870J', 'qvfcj9saXZ3cODtHF3V48yNLNQ82', '00001.jpg', 'ivan2'),
('00002', 'svan', 'ivanhalim888@gmail.com', 'A60XJf!Ydj5ig9mfkT6A', 'bLZNsa!3cQQrz20Gwkb', '00002.jpg', 'ivanhalim'),
('00003', 'ikan', 'ikan@gmail.com', 'mE5946K9pfAsb8Uet9sn', '1tjKC5LZ1qeoYWDlyzHOw8R', '00003.jpg', 'tongkol'),
('00004', 'agustinus', 'agus@gmail.com', 'R7ZR83jxIHKNpu6w!hws', '6GgTn6IRhREmw3UUbLClbD', '00004.jpg', 'Latihan1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
