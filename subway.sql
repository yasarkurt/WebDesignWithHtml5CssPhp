-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 May 2019, 08:59:51
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `subway`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `ct_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`ct_id`, `category_name`, `category_link`) VALUES
(1, '3D Oyunlar', '3d-oyunlar'),
(2, 'Ameliyat Oyunları', 'ameliyat-oyunlari'),
(3, 'Araba Oyunları', 'araba-oyunlari'),
(4, 'Barbie Barbi Oyunları', 'barbie-barbi-oyunlari'),
(5, 'Beceri Oyunları', 'beceri-oyunlari'),
(6, 'Ben 10 Oyunları', 'ben-10-oyunlari'),
(7, 'Bilgi Oyunları', 'bilgi-oyunlari'),
(8, 'Oguz Oyunları', 'oguz-oyunlari');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`comment_id`, `game_id`, `user_id`, `comment`) VALUES
(31, 1, 5, 'selam'),
(32, 1, 5, 'selamün a'),
(33, 1, 5, 'selamün a'),
(34, 1, 5, 'selamün a'),
(35, 1, 5, 'ad'),
(36, 2, 2, 'oguz'),
(37, 2, 2, 'selam kanka nasılsın');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `commentsofcomment`
--

CREATE TABLE `commentsofcomment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `c_comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `commentsofcomment`
--

INSERT INTO `commentsofcomment` (`comment_id`, `user_id`, `c_comment`) VALUES
(31, 5, 'aleyküm selam'),
(31, 5, 'as'),
(31, 5, 'selam kardaş'),
(32, 2, 'as'),
(36, 2, 'selam kanka');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dislikes`
--

CREATE TABLE `dislikes` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `dislikes`
--

INSERT INTO `dislikes` (`user_id`, `game_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(200) NOT NULL,
  `game_desc` varchar(1000) NOT NULL,
  `ct_id` int(11) NOT NULL,
  `game_img` varchar(200) NOT NULL,
  `game_link` varchar(200) NOT NULL,
  `game_address` varchar(5000) NOT NULL,
  `game_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `game_desc`, `ct_id`, `game_img`, `game_link`, `game_address`, `game_date`) VALUES
(1, 'Minecraft Koşusu Oyunu', 'Sitemizde Minecraft Koşusu Oyunu oynayabilir ve ayrıca Subway Surfers Oyunları içinden, Minecraft Koşusu Oyunu sizler için subway surfers , subway surfers oyna , subway surf , subway surf oyna sitemizde.', 1, 'minecraft-kosusu-oyunu.jpg', 'minecraft-kosusu-oyunu', '<iframe src=\"https://www.bestgames.com/games/Minecraft-Endless-Runner/index.html\" width=\"966px\" height=\"600px\" scrolling=\"No\" frameborder=\"0\"></iframe>', '2019-05-08 21:52:46'),
(2, '3D Yeni Suç Şehri Oyunu', 'Sitemizde 3D Yeni Suç Şehri Oyunu oynayabilir ve ayrıca 3D Oyunlar içinden, 3D Yeni Suç Şehri Oyunu sizler için subway surfers , subway surfers oyna , subway surf , subway surf oyna sitemizde.', 1, '3d-yeni-suc-sehri-oyunu.png', '3d-yeni-suc-sehri-oyunu', '<iframe allowfullscreen=\"allowfullscreen\" class=\"resizable\" frameborder=\"0\" height=\"680\" id=\"html5-content\" scrolling=\"no\" src=\"http://media2.y8.com/y8-studio/unity_webgl_games/u53/Joll/crime_city_2_v35/?ratio_tolerant=true\" width=\"965\"></iframe>', '2019-05-08 21:54:52'),
(3, 'Temple Run Oyunu Oyna', 'Sitemizde Temple Run Oyunu Oyna oynayabilir ve ayrıca 3D Oyunlar içinden, Temple Run Oyunu Oyna sizler için subway surfers , subway surfers oyna , subway surf , subway surf oyna sitemizde.', 1, 'temple-run-oyunu-oyna.jpg', 'temple-run-oyunu-oyna', '<iframe height=\"640\" width=\"640\" src=\"http://www.miniclip.com/games/rail-rush-worlds/en/webgame.php\" scrolling=\"no\" frameborder=\"0\" id=\"iframepage\" name=\"iframepage\"></iframe>', '2019-05-08 21:57:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `likes`
--

INSERT INTO `likes` (`user_id`, `game_id`) VALUES
(3, 1),
(4, 1),
(5, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likesofcomment`
--

CREATE TABLE `likesofcomment` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `likesofcomment`
--

INSERT INTO `likesofcomment` (`user_id`, `comment_id`) VALUES
(5, 31),
(2, 31),
(3, 31),
(4, 31),
(2, 32),
(2, 36);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_gender` tinyint(1) NOT NULL,
  `user_pp` varchar(200) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `online_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `user_email`, `user_gender`, `user_pp`, `register_date`, `online_date`) VALUES
(2, 'ipekakpnr', 'c853e13e473819b2a9e8b57ab04da574', 'ugrgcr@gmail.com', 0, 'avatar-none', '2019-05-09 22:23:28', '2019-05-10 06:57:59'),
(3, 'ugurgucer', '25d55ad283aa400af464c76d713c07ad', 'ipekakpnr@gmail.com', 1, 'avatar-7', '2019-05-10 04:29:04', '2019-05-10 06:58:16'),
(4, 'ipekakpnrrr', '25d55ad283aa400af464c76d713c07ad', 'ipekakpnrrrr@gmail.com', 0, 'avatar-8', '2019-05-10 04:51:42', '2019-05-10 07:01:51'),
(5, 'yasar.kurt', '25d55ad283aa400af464c76d713c07ad', 'yasar.kurt46@outlook.com', 1, 'avatar-3', '2019-05-10 04:52:11', '2019-05-10 06:54:51'),
(6, 'ogzkaras', '25d55ad283aa400af464c76d713c07ad', '374763@ogr.ktu.edu.tr', 1, 'avatar-4', '2019-05-10 04:52:59', '2019-05-10 04:52:59');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ct_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `commentsofcomment`
--
ALTER TABLE `commentsofcomment`
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `dislikes`
--
ALTER TABLE `dislikes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Tablo için indeksler `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `ct_id` (`ct_id`);

--
-- Tablo için indeksler `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Tablo için indeksler `likesofcomment`
--
ALTER TABLE `likesofcomment`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Tablo kısıtlamaları `commentsofcomment`
--
ALTER TABLE `commentsofcomment`
  ADD CONSTRAINT `commentsofcomment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `commentsofcomment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Tablo kısıtlamaları `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`),
  ADD CONSTRAINT `dislikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Tablo kısıtlamaları `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`ct_id`) REFERENCES `categories` (`ct_id`);

--
-- Tablo kısıtlamaları `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`);

--
-- Tablo kısıtlamaları `likesofcomment`
--
ALTER TABLE `likesofcomment`
  ADD CONSTRAINT `likesofcomment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likesofcomment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
