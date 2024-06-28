-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `description` text NOT NULL,
  `time` varchar(500) NOT NULL,
  `time_update` varchar(500) NOT NULL,
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'thứ tự',
  `title` text NOT NULL COMMENT 'tiêu dề',
  `description` text NOT NULL COMMENT 'miêu tả',
  `images` text NOT NULL COMMENT 'ảnh',
  `slug` text NOT NULL COMMENT 'url',
  `view` int NOT NULL DEFAULT '0' COMMENT 'lượt xem',
  `view_month` int NOT NULL DEFAULT '0',
  `like_post` int NOT NULL DEFAULT '0' COMMENT 'thích',
  `dislike_post` int NOT NULL DEFAULT '0' COMMENT 'không thích',
  `time` text NOT NULL COMMENT 'thời gian đăng',
  `time_update` varchar(500) NOT NULL,
  `mp3` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'id video',
  `casi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dodai` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` int NOT NULL COMMENT 'thư mục',
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'tags bài viết',
  `hidden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `home_url` text NOT NULL COMMENT 'link web',
  `domain` text NOT NULL COMMENT 'tên miền',
  `title` text NOT NULL COMMENT 'tiêu đề web',
  `description` text NOT NULL COMMENT 'miêu tả web',
  `logo` text NOT NULL COMMENT 'logo web',
  `images` text NOT NULL,
  `server_play` text NOT NULL,
  `server_img` text NOT NULL,
  `tele` text NOT NULL,
  `script` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `setting` (`id`, `home_url`, `domain`, `title`, `description`, `logo`, `images`, `server_play`, `server_img`, `tele`, `script`) VALUES
(1,	'http://localhost',	'localhost',	'Nghe Nhạc',	'Nghe Nhạc',	'https://sexvl3x.cc/public/images/sexvl3x.png',	'https://sexvl3x.cc/public/images/7UGycTgg.jpg',	'http://localhost',	'http://localhost',	'#',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	1);

-- 2024-02-26 07:43:32
