-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 07:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviebooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `is_active`) VALUES
(1, 'admin', 'admin', '$2y$10$dbRt7igECNTReORritCCQeLdb2EBny5cnOF24LnwHtHkU1x5M6frK', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `seats` varchar(50) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `seats`, `total_seats`, `booking_date`, `showtime_id`, `total_price`) VALUES
(1, 2, 'A3, D4', 2, '2023-11-10', 1, 0.00),
(11, 2, 'D3, A4', 10, '2023-11-14', 1, 100.00),
(13, 7, 'D3, A4', 10, '2023-11-14', 1, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(1, 'testuser', 'testuser@gmail.com', 'test'),
(3, 'Test', 'test@gmail.com', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genre_name`) VALUES
(1, 'Science'),
(2, 'Adventure '),
(3, 'Drama'),
(4, ' Historical'),
(5, 'Comedy'),
(6, 'Action'),
(7, 'Biographical War');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '0',
  `director` varchar(100) NOT NULL DEFAULT '0',
  `release_date` date NOT NULL,
  `genre_id` int(11) NOT NULL DEFAULT 0,
  `language` varchar(100) NOT NULL DEFAULT '0',
  `trailer_link` varchar(255) NOT NULL DEFAULT '0',
  `description` varchar(300) NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  `running` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `director`, `release_date`, `genre_id`, `language`, `trailer_link`, `description`, `image`, `status`, `running`) VALUES
(1, 'Black Panther: Wakanda Forever', 'Kevin Feige', '2020-11-11', 2, 'English', 'https://www.youtube.com/embed/RlOB3UALvrQ', 'Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with Nakia and Everett Ross to forge a new path for their bel', 'Wankanda.jpg', 1, 1),
(2, 'Avengers', 'Kevin Feige', '2012-04-11', 1, 'English', 'https://www.youtube.com/embed/eOrNdBpGMv8', 'The Avengers began as a group of extraordinary individuals who were assembled to defeat Loki and his Chitauri army in New York City. Since then, the team has expanded its roster and faced a host of new threats, while dealing with their own turmoil.', 'aven.jpg', 1, 1),
(3, 'Chaal Jeevi Laiye', 'Vipul Mehta', '2019-01-07', 3, 'Gujarati', 'https://www.youtube.com/embed/y1NoFZPVTr0', '                Chaal Jeevi Laiye is a story of a Father-Son’s unplanned journey to escape a workaholic existence. The duo, Aditya Parikh and his father Bipin Chandra Parikh explore the meaning of life as they meet a stranger traveler named Ketki, who takes them on a journey of surprises and realiza', 'chaal-jivi-laiye.jpg', 1, 1),
(4, 'Playing With Fire ', 'Andrea Sedlackova', '2019-11-06', 5, 'English', 'https://www.youtube.com/embed/fd5GlZUpfaM', ' Playing with Fire is a 2019 American family comedy film directed by Andy Fickman from a screenplay by Dan Ewen and Matt Lieberman based on a story by Ewen. The film stars John Cena, Keegan-Michael Key, John Leguizamo, Dennis Haysbert, Brianna Hildebrand and Judy Greer, and follows a ', 'movieposter_en.jpg', 1, 1),
(5, 'Black Adam', 'Warner Bros', '2020-10-03', 4, 'English', 'https://www.youtube.com/embed/Fva_W_AF0IM?si=PhwudSNX7azpd_1Y', 'Black Adam was originally depicted as a supervillain and the ancient magical champion predecessor of Captain Marvel, who fought his way to modern times to challenge the hero and his Marvel Family associates.', 'blackadam.jpg', 1, 1),
(6, 'Spider-Man: No Way Home', 'Jon Watts', '2021-12-17', 6, 'English', 'https://www.youtube.com/embed/JfVOs4VSpmA?si=g7oPJhyfn9g2ZHFt', 'With Spider-Mans identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear, forcing Peter to discover what it truly means to be Spider-Man.', 'spiderman.jpg', 1, 1),
(7, 'Ant-Man and the Wasp: Quantumania', 'Peyton Reed', '2023-05-16', 7, 'English', 'https://www.youtube.com/embed/ZlNFpri-Y40?si=40E7qGgvqqPKTzaJ', 'The movie will see super-hero couple Scott Lang (Paul Rudd) and Hope van Dyne (Evangeline Lilly) reprise their roles as Ant-Man and the Wasp. They are joined by Michael Douglas and Michelle Pfeiffer, who return as Hopes parents, Hank Pym and Janet van Dyne. Kathryn Newton joins the cast as Cassie La', 'nguoikien.jpg', 1, 1),
(8, 'Aquaman and the Lost Kingdom', 'DC Studios', '2023-12-22', 6, 'English', 'https://www.youtube.com/embed/FV3bqvOHRQo?si=jloFhthFfHm1a9Ek', 'Aquaman and the Lost Kingdom is the much-anticipated sequel to 2018s Aquaman. It will once again be directed by James Wan, but well have to wait just that little bit longer to see it on our screens.', 'aquaman.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) DEFAULT 0,
  `screen_number` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `theater_id`, `screen_number`) VALUES
(1, 1, 1),
(2, 1, 2),
(7, 1, 3),
(6, 1, 4),
(17, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `showtime` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `movie_id`, `theater_id`, `screen_id`, `showtime`, `price`) VALUES
(1, 9, 1, 1, '2023-11-15 15:36:00', 10.00),
(3, 9, 1, 1, '2023-11-10 17:21:00', 0.00),
(5, 21, 1, 1, '2023-11-15 23:34:00', 0.00),
(7, 9, 1, 1, '2023-11-16 00:21:00', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `theater_name` varchar(50) DEFAULT NULL,
  `theater_address` varchar(100) DEFAULT NULL,
  `theater_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `theater_name`, `theater_address`, `theater_phone`) VALUES
(1, 'AZIR 2D', 'Nha Trang', '0123456789'),
(2, 'AZID 3D', 'Test sdas', '0928282828'),
(4, 'AZID 4D', 'Test', '0928282828'),
(11, 'AZIR 8D', 'test', '10248129840'),
(12, 'AZIR 9D', 'test', '10248129840'),
(13, 'AZIR 9D', 'test', '10248129840'),
(15, 'AZIR 11D', 'Test2', '0931322323');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `birthday`, `image`, `gender`) VALUES
(2, 'testuser', 'Test', 'testuser@gmail.com', '$2y$10$TX1iiEctUEHXeZvpxXjeieKZWineWiK81VqodvXmVKxHDpZ8DvePa', '0929322222', '2023-11-16', '64349336_422464855151892_7422161348181622784_n.jpg', b'1'),
(7, 'tindan', 'Jin Pham', 'tindan@gmail.com', '$2y$10$tnG7n.Tl8/YWtF4WH9qwbu6l5.N1bQx5ApcucfFlaYVSsBHku2ypC', '02931322322', '2023-11-09', '391757454_718135037010319_7638684070599160427_n.jpg', b'1'),
(10, 'tindan2', 'tindan', 'tindan@gmail.com', '$2y$10$Yu8Syazb9/WY0HK70WOi0u6p5IFQhmLn/N6Qw7EFi4YrvFN8YP0S6', '02931322322', '2023-11-15', '118914956_1313702765640982_9209319587640248673_n.jpg', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`),
  ADD KEY `showtime_id` (`showtime_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `theater_screen_id` (`theater_id`,`screen_number`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `threater_id` (`theater_id`),
  ADD KEY `screen_id` (`screen_id`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Constraints for table `screens`
--
ALTER TABLE `screens`
  ADD CONSTRAINT `screens_ibfk_1` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
