-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 01:26 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cozastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `description` tinytext,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'گوشی هوشمند', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-18 23:02:25', '2018-10-18 23:03:18'),
(2, NULL, 'لوازم خانگی', 'برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '2018-10-18 23:03:10', '2018-10-19 06:05:22'),
(3, NULL, 'لباس', 'را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو', '2018-10-18 23:03:55', '2018-10-18 23:03:55'),
(4, NULL, 'ساعت', 'حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری', '2018-10-18 23:03:10', '2018-10-18 23:03:10'),
(5, NULL, 'زیور آلات', 'در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری ', '2018-10-18 23:03:55', '2018-10-18 23:03:55'),
(7, 1, 'سامسونگ', 'گوشی های هوشمند زیرمجموعه برند سامسونگ', '2018-10-18 23:38:06', '2018-10-18 23:38:06'),
(8, NULL, 'خوراکی', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '2018-10-20 00:53:14', '2018-11-01 14:40:57'),
(9, 1, 'سونی ویرایش', 'گوشی های هوشمند زیرمجموعه برند سونی', '2018-10-18 23:39:03', '2018-10-19 06:03:26'),
(10, 1, 'ارتباطات hh', 'گوشی های هوشمند زیرمجموعه برند ژیائومی', '2018-10-18 23:39:03', '2018-10-20 00:36:51'),
(11, 3, 'زنانه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 00:16:32', '2018-10-19 00:16:32'),
(12, 3, 'مردانه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 00:16:32', '2018-10-19 00:16:32'),
(13, 3, 'پسرانه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 00:16:50', '2018-10-19 00:16:50'),
(14, 3, 'دخترانه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 00:16:50', '2018-10-19 00:16:50'),
(15, 7, 'پرچمدار', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 01:27:07', '2018-10-19 01:27:07'),
(16, 7, 'میان رده', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 01:27:07', '2018-10-19 01:27:07'),
(17, 15, '2017', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. ', '2018-10-19 01:39:28', '2018-10-19 01:39:28'),
(18, 15, 'جدید', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '2018-10-19 01:39:28', '2018-10-19 22:40:14'),
(41, 54, 'تک درب', '', '2018-10-19 03:18:20', '2018-10-19 03:18:20'),
(53, 2, 'تلوزیون', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '2018-10-19 03:17:21', '2018-10-19 03:17:21'),
(54, 2, 'یخچال', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '2018-10-19 03:17:43', '2018-10-19 03:17:43'),
(731, 54, 'ساید بای ساید', '', '2018-10-19 03:17:55', '2018-10-19 03:17:55'),
(732, 53, 'تک درب', '', '2018-10-19 03:18:08', '2018-10-19 03:18:08'),
(733, 5, 'مردانه', '', '2018-10-19 03:23:21', '2018-10-19 03:23:21'),
(8855, 4, 'مردانه', '', '2018-10-19 03:33:46', '2018-10-19 03:33:46'),
(8857, 2, 'امیر خدنگی', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '2018-10-29 12:16:31', '2018-10-29 12:16:31'),
(8858, 1, 'یک گروه تصادفی', NULL, '2018-10-29 12:21:08', '2018-10-29 12:21:08'),
(8859, 3, 'یک گروه تصادفی', NULL, '2018-10-29 12:21:39', '2018-10-29 12:21:39'),
(8860, 3, 'یک گروه تصادفی', NULL, '2018-10-29 12:26:01', '2018-10-29 12:26:01'),
(8861, 3, 'یک گروه تصادفی', NULL, '2018-10-29 12:26:10', '2018-10-29 12:26:10'),
(8862, 3, 'یک گروه تصادفی', NULL, '2018-10-29 12:27:18', '2018-10-29 12:27:18'),
(8863, 3, 'امیر خدنگی', NULL, '2018-10-29 12:28:16', '2018-10-29 12:28:16'),
(8864, NULL, 'امیر خدنگی', NULL, '2018-10-29 13:13:22', '2018-10-29 13:13:22'),
(8865, NULL, 'امیر خدنگی 2', NULL, '2018-10-29 13:35:12', '2018-10-29 13:35:12'),
(8866, NULL, 'تنقلات', NULL, '2018-11-01 14:41:19', '2018-11-01 14:41:19'),
(8867, 8, 'تنقلات', NULL, '2018-11-02 00:13:16', '2018-11-02 00:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `value` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `name`, `created_at`, `updated_at`) VALUES
(6, NULL, 'مشخصات کلی', '2018-10-19 23:14:01', '2018-10-19 23:14:01'),
(7, NULL, 'پردازنده مرکزی', '2018-10-19 23:14:35', '2018-10-20 00:49:16'),
(8, NULL, 'حافظه', '2018-10-19 23:14:35', '2018-10-19 23:14:35'),
(9, NULL, 'صفحه نمایش', '2018-10-19 23:15:06', '2018-10-19 23:15:06'),
(11, 6, 'ابعاد', '2018-10-19 23:15:40', '2018-10-19 23:15:40'),
(12, 6, 'وزن', '2018-10-19 23:15:40', '2018-10-19 23:15:40'),
(13, 7, 'تراشه پردازنده', '2018-10-19 23:16:09', '2018-10-20 00:49:27'),
(14, 7, 'نوع پردازنده', '2018-10-19 23:16:09', '2018-10-19 23:16:09'),
(578, 9, 'اندازه', '2018-10-19 23:49:23', '2018-10-19 23:49:23'),
(579, 9, 'ابعاد', '2018-10-19 23:49:36', '2018-10-19 23:49:36'),
(583, 8, 'نوع', '2018-10-20 00:19:35', '2018-10-20 00:19:35'),
(584, 8, 'مقدار', '2018-10-20 01:30:23', '2018-10-20 01:30:23'),
(585, NULL, 'Test Edited', '2018-10-29 20:29:03', '2018-10-29 20:54:37'),
(586, 585, 'test child', '2018-10-29 20:30:26', '2018-10-29 20:30:26'),
(587, NULL, 'test2', '2018-10-29 20:31:22', '2018-10-29 20:31:22'),
(588, 9, 'تکنولوژی', '2018-11-04 09:54:22', '2018-11-04 09:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8mb4_persian_ci,
  `photo` varchar(15) COLLATE utf8mb4_persian_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'iphone_x_full', 'یک توضیح تصادفی', '021e6161.jpg', '2018-11-02 01:56:15', '2018-11-02 01:56:15'),
(3, 'Apple Watch New', 'برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', '1bdc9dea.jpg', '2018-11-02 02:03:22', '2018-11-02 03:36:23'),
(4, 'Galaxy Note 5 full', 'برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.', 'f4d51f85.jpg', '2018-11-02 02:04:05', '2018-11-02 02:04:05'),
(5, 'Galaxy Note 5 back and front', 'گوشی های هوشمند زیرمجموعه برند سامسونگ', '15599363.jpg', '2018-11-02 02:04:43', '2018-11-02 02:04:43'),
(6, 'iphon x in hands', NULL, '66dd91b0.jpg', '2018-11-02 02:05:46', '2018-11-02 02:05:46'),
(7, 'LG v30', NULL, '28b440b2.jpg', '2018-11-02 02:06:11', '2018-11-02 02:06:11'),
(8, NULL, NULL, 'b9360097.jpg', '2018-11-02 02:07:40', '2018-11-02 02:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_persian_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'slider', '[{\"photo\":\"slide-01.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9 \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f\\u0631 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"\\/link1\"},{\"photo\":\"slide-02.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648 \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f\\u0631 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"\\/link2\"},{\"photo\":\"slide-03.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647 \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f\\u0631 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"\\/link3\"}]', '2018-11-05 15:48:03', '0000-00-00 00:00:00'),
(2, 'posters', '[{\"photo\":\"banner-01.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9 \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0647\\u0627 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"\\/link1\"},{\"photo\":\"banner-02.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648 \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0647\\u0627 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"\\/link2\"},{\"photo\":\"banner-03.jpg\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"description\":\"\\u0627\\u06cc\\u0646 \\u06cc\\u06a9 \\u062a\\u0648\\u0636\\u06cc\\u062d \\u062f\\u0631\\u0628\\u0627\\u0631\\u0647 \\u062a\\u0635\\u0648\\u06cc\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647 \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0647\\u0627 \\u0627\\u0633\\u062a\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"\\/link3\"}]', '2018-11-05 15:49:21', '0000-00-00 00:00:00'),
(3, 'site_name', 'Hico Store', '2018-11-05 15:49:41', '0000-00-00 00:00:00'),
(4, 'site_description', 'این یک توضیح خیلی کوتاه و تصادفی درباره فروشگاه و کسب و کار کوچک هایکو استور میباشد که توسط مدیر قابل تعویض است', '2018-11-05 15:50:28', '0000-00-00 00:00:00'),
(5, 'site_logo', 'logo-01.png', '2018-11-05 15:52:45', '0000-00-00 00:00:00'),
(6, 'shop_phone', '0912345678', '2018-11-05 15:54:08', '0000-00-00 00:00:00'),
(7, 'shop_address', 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1', '2018-11-05 15:54:08', '0000-00-00 00:00:00'),
(8, 'social_link', '{\"instagram\":\"https:\\/\\/instagram.com\\/\",\"telegram\":\"https:\\/\\/telegram.com\\/\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\"}', '2018-11-05 15:55:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(8) NOT NULL,
  `buyer` varchar(8) NOT NULL,
  `admin_description` tinytext,
  `buyer_description` tinytext,
  `destination` tinytext NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `offer` int(11) NOT NULL DEFAULT '0',
  `shipping_cost` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment` datetime DEFAULT NULL,
  `datetimes` mediumtext,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `buyer`, `admin_description`, `buyer_description`, `destination`, `postal_code`, `offer`, `shipping_cost`, `total`, `status`, `created_at`, `payment`, `datetimes`, `updated_at`) VALUES
('e3fb7077', '5016d134', 'این یک توضیح تصادفی است 3ADASDjlkjklj', 'با سلام\r\nمن شدیدا به این محصولات نیاز دارم ، ممنون میشم هرچه سریعتر فاکتور من رو آماده کنید و به دستم برسونید\r\n\r\nسپاسگذارم', 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1', '3254124375', 0, 0, 0, 7, '2018-11-05 12:45:51', NULL, '{\"refund\":null,\"Pending\":null,\"packing\":null,\"sending\":1541367499,\"sended\":null,\"pending\":1541367489,\"posted\":1541409287,\"canceled\":1541409351}', '2018-11-05 09:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order` varchar(8) NOT NULL,
  `product` varchar(8) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order`, `product`, `color`, `count`, `created_at`, `updated_at`) VALUES
(28, 'e3fb7077', '5c5a18d0', NULL, 3, '2018-11-04 20:53:00', '2018-11-04 20:53:00'),
(29, 'e3fb7077', '1aa35928', NULL, 2, '2018-11-04 20:53:00', '2018-11-04 20:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` varchar(8) NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `short_description` tinytext,
  `aparat_video` varchar(8) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `unit` tinyint(1) NOT NULL DEFAULT '0',
  `offer` int(2) NOT NULL DEFAULT '0',
  `colors` mediumtext,
  `status` int(11) NOT NULL DEFAULT '0',
  `full_description` text,
  `keywords` mediumtext,
  `photo` varchar(15) DEFAULT NULL,
  `gallery` mediumtext,
  `advantages` mediumtext,
  `disadvantages` mediumtext,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `parent_category`, `category`, `name`, `code`, `short_description`, `aparat_video`, `price`, `unit`, `offer`, `colors`, `status`, `full_description`, `keywords`, `photo`, `gallery`, `advantages`, `disadvantages`, `created_at`, `updated_at`) VALUES
('08866797', NULL, NULL, 'تلوزیون', NULL, NULL, NULL, 780, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-11-02 09:41:53', '2018-11-02 10:01:44'),
('0e20584d', NULL, NULL, 'Test Feature', NULL, NULL, NULL, 50, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 17:10:21', '2018-11-02 13:33:15'),
('1aa35928', NULL, NULL, 'تلوزیون', NULL, 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', NULL, 170000, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 04:38:08', '2018-11-02 13:33:15'),
('4923db7c', NULL, NULL, 'Testst', NULL, NULL, NULL, 213, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 06:49:35', '2018-11-02 13:33:15'),
('54a41cf6', 4, 8855, 'تلوزیون Edited', NULL, NULL, NULL, 34, 1, 0, 'green,brown', 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', 'ویژگی,ویژگی2,تست', 'عیب,عیب 2', '2018-10-30 17:29:27', '2018-11-02 13:33:15'),
('55059c16', 2, 731, 'Test Color', NULL, NULL, '', 230000, 1, 0, 'orange', 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 05:50:44', '2018-11-02 11:30:29'),
('5c3be19f', NULL, NULL, 'Apple Watch', NULL, NULL, NULL, 19999, 1, 0, NULL, 0, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 05:43:46', '2018-11-02 13:33:15'),
('5c5a18d0', 1, 18, 'Galaxy Note 8', 'N904-G', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', 'm4Jjr', 350, 1, 2, 'blue,yellow,orange', 1, '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"data:image/jpeg;base64,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\" alt=\"\" width=\"252\" height=\"200\" /></p>\r\n<p style=\"text-align: right;\">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای ع<strong>لی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طرا</strong>حی اساسا مورد استفاده قرار گیرد.</p>', 'Samsung,Galaxy,Galaxy note 5,note 8', 'f4d51f85.jpg', 'f4d51f85.jpg,15599363.jpg,021e6161.jpg', 'باتری قوی,شارژ دهی خیلی بالا,امکانات خیلی جدید,رابط کاربری شکیل', 'قیمت بالا,کیفیت ساخت معمولی', '2018-10-30 16:07:54', '2018-11-02 11:29:39'),
('622078b8', 1, 7, 'گوشی موبایل Apple iPhone XS', 'hyvq5', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.', '', 18000000, 1, 5, 'green,yellow,brown,red', 1, '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 'Apple,iphone,iPhone,iphone x,گوشی هوشمند', '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', 'باتری قوی,صفحه نمایش فوق العاده', 'قیمت بالا', '2018-10-30 05:49:05', '2018-11-02 14:24:40'),
('9596dca4', NULL, NULL, 'Testst', NULL, NULL, NULL, 213, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 06:42:38', '2018-11-02 13:33:15'),
('95ae243b', 1, 1, 'امیر خدنگی', '951271', 'شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام', '', 170000, 0, 12, 'yellow', 1, '<p>&nbsp;&nbsp;شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام&nbsp;</p>', 'asd,as,v', '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', 'asd,vf,d,va', 'zdfbcv,b,dzfs,x', '2018-10-30 04:34:22', '2018-11-02 14:24:42'),
('976c1319', 4, 8855, 'ساعت هوشمند Apple Watch', NULL, NULL, '', 250, 1, 0, NULL, 1, NULL, NULL, '1bdc9dea.jpg', '1bdc9dea.jpg,b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 08:45:08', '2018-11-02 14:24:31'),
('9c91ab6b', NULL, NULL, 'Test Feature', NULL, NULL, '', 50, 1, 0, NULL, 1, NULL, NULL, 'b9360097.jpg', 'b9360097.jpg,021e6161.jpg', NULL, NULL, '2018-10-30 17:13:44', '2018-11-04 04:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` int(11) NOT NULL,
  `product` varchar(8) NOT NULL,
  `feature` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `join_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`id`, `product`, `feature`, `value`, `join_at`) VALUES
(21, '54a41cf6', 12, '150 گرم', '2018-11-01 13:37:15'),
(22, '54a41cf6', 11, '13 * 42 * 12 میلیمتر', '2018-11-01 13:37:15'),
(43, '5c5a18d0', 13, 'Snapdragon', '2018-11-02 14:59:39'),
(44, '5c5a18d0', 12, '250 گرم', '2018-11-02 14:59:39'),
(45, '5c5a18d0', 11, '13 * 15', '2018-11-02 14:59:39'),
(46, '5c5a18d0', 578, '6.3 اینچ', '2018-11-02 14:59:39'),
(47, '9c91ab6b', 11, '2342', '2018-11-04 07:52:45'),
(48, '9c91ab6b', 13, 'asdf23', '2018-11-04 07:52:45'),
(49, '9c91ab6b', 12, '2refsdf', '2018-11-04 07:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user` varchar(8) DEFAULT NULL,
  `product` varchar(8) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(15) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `review` mediumtext NOT NULL,
  `answer` mediumtext,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user`, `product`, `fullname`, `email`, `avatar`, `rating`, `review`, `answer`, `seen`, `created_at`, `updated_at`) VALUES
(2, NULL, '5c5a18d0', 'امیرخدنگی', 'AmirKhadangi920@Gmail.com', NULL, 4, 'این فقط یک نظر تصادفی است :)', NULL, 0, '2018-10-31 15:01:13', '2018-10-31 15:01:13'),
(3, NULL, '5c5a18d0', 'رضا غلامی', 'sx6080@gmail.com', NULL, 0, 'این یک پیام تصادفی دیگر است', NULL, 0, '2018-10-31 15:17:57', '2018-10-31 15:17:57'),
(4, NULL, '5c5a18d0', 'جعفر کاظمی', 'metromarket920@gmail.com', NULL, 2, 'گوشی واقعا خوبی هست ، من که خریدم واقعا راضی ام :)', NULL, 0, '2018-11-01 09:01:53', '2018-11-01 09:01:53'),
(5, NULL, '5c5a18d0', 'رضا غلامی', 'sx6080@gmail.com', NULL, 3, 'شسیبشسیب', NULL, 0, '2018-11-01 10:22:34', '2018-11-01 10:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(8) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `avatar` varchar(15) DEFAULT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` tinytext NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `avatar`, `state`, `city`, `address`, `postal_code`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
('32sd4f12', 'رضا', 'غلامی', '0912345678', 'sx6080@gmail.com', '', NULL, 'خراسان رضوی', 'مشهد', 'بین دستغیب 15 و 17 ، پلاک 231', '3241532415', 1, '', '2018-11-02 21:16:17', '2018-11-02 21:16:17'),
('5016d134', 'امیر', 'خدنگی', '09105009868', 'AmirKhadangi920@Gmail.com', '$2y$10$O4Dp6z70mIAX9QpObrhMoOng.6/xd9FeAaYUBDO2QhvTqL3IAIzAS', NULL, 'خراسان رضوی', 'مشهد', 'بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1', '3254124375', 1, 'x8m5SUPZnjqhlfQIkFLMOixNZ1UJPLt7Yy5FL9pcjh0xGgVtxGXpL6kIjlNq', '2018-11-03 08:48:09', '2018-11-03 08:48:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer` (`buyer`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order` (`order`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `group` (`category`),
  ADD KEY `parent_category` (`parent_category`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `feature` (`feature`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8868;
--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`);

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`title`) REFERENCES `features` (`id`) ON UPDATE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_features`
--
ALTER TABLE `product_features`
  ADD CONSTRAINT `product_features_ibfk_1` FOREIGN KEY (`feature`) REFERENCES `features` (`id`),
  ADD CONSTRAINT `product_features_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
