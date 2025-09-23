-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 02:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youbee-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `name`, `comment`, `parent_id`, `created_at`) VALUES
(16, 13, 4, 'elie', 'hello', NULL, '2025-01-27 19:29:47'),
(17, 13, 5, 'elie', 'new comment', 16, '2025-01-27 19:42:01'),
(18, 13, 5, 'hasan', 'hello students', 17, '2025-01-27 19:43:11'),
(19, 13, 5, 'hasan', 'hello seeeeetudents', NULL, '2025-01-27 19:44:56'),
(20, 13, 5, 'elie', 'hi', NULL, '2025-01-29 18:11:01'),
(21, 13, 5, 'elie', '21212', 19, '2025-01-29 18:11:14'),
(22, 13, 5, 'elie', 'hello', 19, '2025-01-29 18:11:26'),
(23, 13, 5, 'elie', 'HASAN', 20, '2025-01-29 18:11:36'),
(24, 13, 5, 'ELIE', 'HASAN', NULL, '2025-01-29 18:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_deleted` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `subject`, `content`, `date_created`, `id_deleted`, `user_id`) VALUES
(4, 'post 2', 'elie  jh dhf hbfh fhd fdf df df dfd', '2025-01-22 17:21:20', 0, 8),
(5, 'POST 3', 'PPPPPPPPPPPPPPPPPPPPPPPPPP', '2025-01-22 17:26:24', 0, 12),
(6, 'posts 1', 'lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', '2025-01-22 17:01:56', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `profile`, `is_admin`, `created_at`) VALUES
(8, 'elie@gmail.com', 'elie', '$2y$10$IJBbdhoLBJpmVOIDysvtxup3rhvVgdwsKgbBEF7eQ5HRC5ItQtvRO', 'uploads/touch-800x800-1.jpg', b'0', '2025-01-21 18:58:44'),
(12, 'amin@gmail.com', 'amin', '$2y$10$PWWV1rc6HzV6waVHPjIv7unK8PIkVybO6WhHpBZq3zK9LFpo7L89y', '', b'0', '2025-01-22 19:25:57'),
(13, 'hasan@gmail.com', 'hasan', '$2y$10$OqAZMmSNSqSsOF71uRJ0kewY6mOEtw6hWsIkLRHydRnrm3Dbt/inG', '', b'0', '2025-01-27 18:17:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `comments_ibfk_2` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
