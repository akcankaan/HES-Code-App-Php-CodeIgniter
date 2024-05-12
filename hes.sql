-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 06 May 2023, 17:32:48
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hes`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_settings`
--

DROP TABLE IF EXISTS `email_settings`;
CREATE TABLE IF NOT EXISTS `email_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `port` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `from` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `to` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `email_settings`
--

INSERT INTO `email_settings` (`id`, `protocol`, `host`, `port`, `user`, `password`, `from`, `to`, `user_name`, `isActive`, `createdAt`) VALUES
(1, 'smtp', 'ssl://smtp.gmail.com', '465', 'kaan4119akcankaan@gmail.com', 'akcan5226', 'kaan4119akcankaan@gmail.com', 'kaan.akcan@outlook.com', 'Hayat Eve Sığar', 1, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hes_codes`
--

DROP TABLE IF EXISTS `hes_codes`;
CREATE TABLE IF NOT EXISTS `hes_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `isVirusStatus` int(11) NOT NULL DEFAULT '2',
  `hes_code` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hes_code_UNIQUE` (`hes_code`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hes_codes`
--

INSERT INTO `hes_codes` (`id`, `user_id`, `isVirusStatus`, `hes_code`, `createdAt`, `isActive`) VALUES
(1, 1, 2, '1631587347', '2023-05-06 13:52:33', 1),
(2, 3, 2, '1207589222', '2023-05-06 13:52:33', 1),
(4, 5, 2, '1545653567', '2023-05-06 20:21:12', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinceName` varchar(255) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `provinces`
--

INSERT INTO `provinces` (`id`, `provinceName`, `isActive`) VALUES
(1, 'ADANA', 1),
(2, 'ADIYAMAN', 1),
(3, 'AFYONKARAHİSAR', 1),
(4, 'AĞRI', 1),
(5, 'AMASYA', 1),
(6, 'ANKARA', 1),
(7, 'ANTALYA', 1),
(8, 'ARTVİN', 1),
(9, 'AYDIN', 1),
(10, 'BALIKESİR', 1),
(11, 'BİLECİK', 1),
(12, 'BİNGÖL', 1),
(13, 'BİTLİS', 1),
(14, 'BOLU', 1),
(15, 'BURDUR', 1),
(16, 'BURSA', 1),
(17, 'ÇANAKKALE', 1),
(18, 'ÇANKIRI', 1),
(19, 'ÇORUM', 1),
(20, 'DENİZLİ', 1),
(21, 'DİYARBAKIR', 1),
(22, 'EDİRNE', 1),
(23, 'ELAZIĞ', 1),
(24, 'ERZİNCAN', 1),
(25, 'ERZURUM', 1),
(26, 'ESKİŞEHİR', 1),
(27, 'GAZİANTEP', 1),
(28, 'GİRESUN', 1),
(29, 'GÜMÜŞHANE', 1),
(30, 'HAKKARİ', 1),
(31, 'HATAY', 1),
(32, 'ISPARTA', 1),
(33, 'MERSİN', 1),
(34, 'İSTANBUL', 1),
(35, 'İZMİR', 1),
(36, 'KARS', 1),
(37, 'KASTAMONU', 1),
(38, 'KAYSERİ', 1),
(39, 'KIRKLARELİ', 1),
(40, 'KIRŞEHİR', 1),
(41, 'KOCAELİ', 1),
(42, 'KONYA', 1),
(43, 'KÜTAHYA', 1),
(44, 'MALATYA', 1),
(45, 'MANİSA', 1),
(46, 'KAHRAMANMARAŞ', 1),
(47, 'MARDİN', 1),
(48, 'MUĞLA', 1),
(49, 'MUŞ', 1),
(50, 'NEVŞEHİR', 1),
(51, 'NİĞDE', 1),
(52, 'ORDU', 1),
(53, 'RİZE', 1),
(54, 'SAKARYA', 1),
(55, 'SAMSUN', 1),
(56, 'SİİRT', 1),
(57, 'SİNOP', 1),
(58, 'SİVAS', 1),
(59, 'TEKİRDAĞ', 1),
(60, 'TOKAT', 1),
(61, 'TRABZON', 1),
(62, 'TUNCELİ', 1),
(63, 'ŞANLIURFA', 1),
(64, 'UŞAK', 1),
(65, 'VAN', 1),
(66, 'YOZGAT', 1),
(67, 'ZONGULDAK', 1),
(68, 'AKSARAY', 1),
(69, 'BAYBURT', 1),
(70, 'KARAMAN', 1),
(71, 'KIRIKKALE', 1),
(72, 'BATMAN', 1),
(73, 'ŞIRNAK', 1),
(74, 'BARTIN', 1),
(75, 'ARDAHAN', 1),
(76, 'IĞDIR', 1),
(77, 'YALOVA', 1),
(78, 'KARABÜK', 1),
(79, 'KİLİS', 1),
(80, 'OSMANİYE', 1),
(81, 'DÜZCE', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `provinceID` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hes_code` int(11) DEFAULT NULL,
  `user_role_id` int(11) DEFAULT '2',
  `permissions` text COLLATE utf8_turkish_ci,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `user_name`, `full_name`, `date_of_birth`, `provinceID`, `email`, `password`, `hes_code`, `user_role_id`, `permissions`, `isActive`, `createdAt`) VALUES
(1, 'mehmetkaanakcan', 'Mehmet Kaan AKCAN', '2002-09-22', 41, 'kaan.akcan@outlook.com', 'fcea920f7412b5da7be0cf42b8c93759', 1, 1, NULL, 1, '2023-05-05 17:31:26'),
(3, 'farukerdem', 'Faruk Erdem', '2023-05-03', 41, 'faruk.erdem@outlook.com', 'fcea920f7412b5da7be0cf42b8c93759', 2, 2, NULL, 1, '2023-05-05 21:19:18'),
(4, 'alperen', 'Alperen AKCAN', '2007-03-23', 34, 'alperen.akcan@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 2, NULL, 1, '2023-05-06 14:37:17'),
(5, 'mehmetcan', 'Mehmetcan Filiz', '2000-01-06', 41, 'mehmetcan@hotmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 4, 2, NULL, 1, '2023-05-06 17:20:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `permissions` text COLLATE utf8_turkish_ci,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`, `permissions`, `isActive`, `createdAt`) VALUES
(1, 'Admin', '{\"dashboard\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"emailsettings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"userop\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"users\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"user_roles\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"virusstatus\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, '2023-05-06 13:37:45'),
(2, 'Kullanıcı', '{\"dashboard\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, '2023-05-06 13:37:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `virus_status`
--

DROP TABLE IF EXISTS `virus_status`;
CREATE TABLE IF NOT EXISTS `virus_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virus_status` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `virus_status`
--

INSERT INTO `virus_status` (`id`, `virus_status`, `isActive`) VALUES
(1, 'Pozitif', 1),
(2, 'Negatif', 1),
(3, 'Belirsiz', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
