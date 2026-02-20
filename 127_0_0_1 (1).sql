-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: February 20, 2026 at 19:23
-- Server Version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course`
--
CREATE DATABASE IF NOT EXISTS `course` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `course`;

-- -----------------------------------------------------

--
-- Structure of the `users` table
--

CREATE TABLE `users` ( 
`id` int(10) UNSIGNED NOT NULL, 
`name` varchar(50) NOT NULL, 
`email` varchar(100) NOT NULL, 
`password` varchar(64) NOT NULL, 
`date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

---- Return or import table data `users`
--
INSERT INTO `users` (`id`, `name`, `email`, `password`, `date_created`) VALUES
(1, 'Ali Haji', 'ALihaci55553@gmail.com', 'Password1', '2026-02-10 00:01:54'),
(2, 'John Doe', 'John@example.com', 'password2', '2026-02-10 00:03:50'),
(3, 'Jane Smith', 'Jane@example.com', 'password3', '2026-02-10 00:04:27'),
(4, 'Mike Johnson', 'Mike@example.com', 'password4', '2026-02-10 00:05:10'),
(5, 'Emily Davis', 'Emily@example.com', 'password5', '2026-02-10 00:05:39'),
(6, 'David Brown', 'David@example.com', 'password6', '2026-02-10 00:06:11'),
(7, 'Sophia Wilson', 'Sophia@example.com', 'password7', '2026-02-10 00:06:59'),
(8, 'Chris Lee', 'Chris@example.com', 'password8', '2026-02-10 00:07:59'),
(9, 'Isabella Moore', (10, 'Oliver Taylor', 'Oliver@example.com', 'password9', '2026-02-10 00:08:28'),

(15, 'Ali Serok', 'Alihaci221@icloud.com', '$2y$10$16XAOQN0PahtR7EMHc0WQOt39TnsOwT4MhwI.OUX96MVZuPS5Ua..', '2026-02-19 21:21:07'),
(17, 'Ali Haji', 'ALihaci93@gmail.com', '$2y$10$z1ngCB21H8fKrs2rQ3s1zeiOnFwVNE2HkwM6r/ieVUW61sihCvei2', '2026-02-20 01:23:54'),

(20, 'Serok ali', 'ALihaci94@gmail.com', '$2y$10$nZdFn4JGtT4OmB3v/ea0UO0wP7V7pa7iU7jzJvxUP4ElQDpGX.DCK', '2026-02-20 01:27:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users` 
ADD PRIMARY KEY (`id`), 
ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` 
MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- -----------------------------------------------------

--
-- Table structure `pma__bookmark`
--

CREATE TABLE `pma__bookmark` ( 
`id` int(10) UNSIGNED NOT NULL, 
`dbase` varchar(255) NOT NULL DEFAULT '', 
`user` varchar(255) NOT NULL DEFAULT '', 
`label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '', 
`query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- -----------------------------------------------------

--
-- Structure of the table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` ( 
`db_name` varchar(64) NOT NULL, 
`col_name` varchar(64) NOT NULL, 
`col_type` varchar(64) NOT NULL, 
`col_length` text DEFAULT NULL, 
`col_collation` varchar(64) NOT NULL, 
`col_isNull` tinyint(1) NOT NULL, 
`col_extra` varchar(255) DEFAULT '', 
`col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- -----------------------------------------------------

--
-- Structure of the table `pma__column_info`
--

CREATE TABLE `pma__column_info` ( 
`id` int(5) UNSIGNED NOT NULL, 
`db_name` varchar(64) NOT NULL DEFAULT '', 
`table_name` varchar(64) NOT NULL DEFAULT '', 
`column_name` varchar(64) NOT NULL DEFAULT '', 
`comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '', 
`mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '', 
`transformation` varchar(255) NOT NULL DEFAULT '', 
`transformation_options` varchar(255) NOT NULL DEFAULT '', 
`input_transformation` varchar(255) NOT NULL DEFAULT '', 
`input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
`username` varchar(64) NOT NULL,

`settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure `pma__export_templ`