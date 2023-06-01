-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2023 pada 04.59
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gits_capstone`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_products`
--

CREATE TABLE `cart_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_checkout` tinyint(1) NOT NULL DEFAULT 1,
  `product_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `type`, `status`, `created_at`, `updated_at`) VALUES
('1', 'Kaos', 'Meliputi Produk berjenis Kaos dan lain-lain', 'product', 'Aktif', '2023-05-31 01:51:41', '2023-05-31 01:51:41'),
('2', 'Jaket', 'Meliputi Produk berjenis Jacket dan lain-lain', 'product', 'Aktif', '2023-05-31 01:51:41', '2023-05-31 02:07:35'),
('3', 'Sablon Kaos', 'Meliputi Layanan Jasa Sablon Kaos dan lain-lain', 'service', 'Aktif', '2023-05-31 01:51:41', '2023-05-31 01:51:41'),
('4', 'Konveksi Baju', 'Meliputi Layanan Jasa Konveksi Baju dan lain-lain', 'service', 'Aktif', '2023-05-31 01:51:41', '2023-05-31 01:51:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_08_013730_create_categories_table', 1),
(6, '2023_04_08_013749_create_products_table', 1),
(7, '2023_05_04_020342_create_services_table', 1),
(8, '2023_05_09_014240_create_promo_banners_table', 1),
(9, '2023_05_11_005006_create_shop_ratings_table', 1),
(10, '2023_05_12_012014_create_product_ratings_table', 1),
(11, '2023_05_12_012027_create_service_ratings_table', 1),
(12, '2023_05_17_060648_create_cart_products_table', 1),
(13, '2023_05_17_062457_create_order_services_table', 1),
(14, '2023_05_23_065449_create_transaction_orders_table', 1),
(15, '2023_05_25_023553_create_tracking_logs_table', 1),
(16, '2023_05_25_060826_create_order_details_table', 1),
(17, '2023_05_25_062448_create_transaction_details_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `material` varchar(20) NOT NULL,
  `deadline` date NOT NULL DEFAULT (curdate() + interval 7 day),
  `service_id` varchar(255) NOT NULL,
  `transaction_order_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_services`
--

CREATE TABLE `order_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_checkout` tinyint(1) NOT NULL DEFAULT 1,
  `material` varchar(20) DEFAULT NULL,
  `custom_design` varchar(255) DEFAULT NULL,
  `deadline` date NOT NULL DEFAULT (curdate() + interval 7 day),
  `service_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `condition` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `price`, `stock`, `condition`, `status`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
('1', 'Men Letter Graphic Drop Shoulder Varsity Jacket Without Hoodie', 'public/product/wosvgNQd8maL32B3lZJUslI8hCPX186NyHmV8fWA.webp', 320000, 40, 'New', 'Tersedia', 'Color: Navy Blue.\r\n            Style: Casual.\r\n            Pattern Type: Colorblock, Letter.\r\n            Details: Pocket, Button Front.\r\n            Type: Varsity.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Hand wash or professional dry clean.', '2', '2023-05-31 01:51:41', '2023-05-31 01:54:36'),
('2', 'Men Slogan & Cartoon Graphic Tee Ver One', 'public/product/81CIFdQsM0mY2VRftPe8zFrPMhm9cL4IbWL06dkK.webp', 140000, 75, 'New', 'Tersedia', 'Color:	Black.\r\n            Style: Casual.\r\n            Pattern Type: Slogan.\r\n            Material: Fabric.\r\n            Composition: 95% Polyester, 5% Elastane.\r\n            Care Instructions: Hand wash,do not dry clean.', '1', '2023-05-31 01:51:41', '2023-05-31 01:54:00'),
('3', 'Men Slogan & Cartoon Graphic Tee Ver Two', 'public/product/LZMt2103nmYurlXtdZ4J5gZrdZasllrLKU2JGBXz.webp', 145000, 65, 'New', 'Tersedia', 'Color: Black.\r\n            Style: Street.\r\n            Pattern Type: Slogan.\r\n            Material:	Fabric\r\n            Composition: 95% Polyester, 5% Elastane.\r\n            Care Instructions: Hand wash,do not dry clean.', '1', '2023-05-31 01:51:41', '2023-05-31 01:54:14'),
('4', 'Men Letter Graphic Two Tone Varsity Jacket Without Hoodie', 'public/product/1BWlrg1BBjhESdLp8syWJbgHihWo5xjtxlVHYsuc.webp', 300000, 70, 'New', 'Tersedia', 'Color: Black and White.\r\n            Style: Casual.\r\n            Pattern Type: Colorblock, Letter.\r\n            Details: Pocket, Button Front.\r\n            Type: Varsity.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Hand wash or professional dry clean.', '2', '2023-05-31 01:51:41', '2023-05-31 01:54:57'),
('5', 'SHEIN Men Colorblock Letter Patched Striped Trim Varsity Jacket', 'public/product/hSPrj8d9YVSjQYYCCl8PiOCuKL87ISl0d2TuMj7r.webp', 280000, 35, 'New', 'Tersedia', 'Color: Multicolor.\r\n            Style: Casual.\r\n            Pattern Type: Colorblock, Letter.\r\n            Details: Patched, Pocket, Button Front.\r\n            Type: Varsity.\r\n            Material: Knitted Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '2', '2023-05-31 01:51:41', '2023-05-31 01:55:31'),
('6', 'Men Cartoon Graphic Tee', 'public/product/PfUzgcsQqHVXSR8nonxTfB8ZEyG5n4p1ekzGjTXv.jpg', 135000, 40, 'New', 'Tersedia', 'Color: Blue.\r\n            Style: Casual.\r\n            Pattern Type: Cartoon.\r\n            Material: Fabric.\r\n            Composition: 95% Polyester, 5% Elastane.\r\n            Care Instructions: Hand wash,do not dry clean.', '1', '2023-05-31 01:51:41', '2023-05-31 02:05:48'),
('7', 'SHEIN Men Japanese Letter & Cartoon Graphic Tee', 'public/product/t4pvhxuftXcUU7EeimRD0WGtjTYg6fSPk3eMataF.webp', 160000, 84, 'New', 'Tersedia', 'Color: Black.\r\n            Style: Casual.\r\n            Pattern Type: Letter, Cartoon.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '1', '2023-05-31 01:51:41', '2023-05-31 01:56:08'),
('8', 'Men Slogan Graphic Jacket Without Hoodie', 'public/product/BFW76NYEX7MK5CYvrYXtUntU3aNLNkz94l6W04Ks.webp', 375000, 55, 'New', 'Tersedia', 'Color: Apricot.\r\n            Style: Casual.\r\n            Pattern Type: Cartoon, Slogan.\r\n            Details: Pocket, Button Front.\r\n            Type: Varsity.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Hand wash or professional dry clean.', '2', '2023-05-31 01:51:41', '2023-05-31 01:56:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 1,
  `comment` text DEFAULT NULL,
  `rating_date` date NOT NULL DEFAULT curdate(),
  `product_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `rating`, `comment`, `rating_date`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Produk Keren banget!', '2023-06-01', '1', 3, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(2, 5, 'Produk Keren banget!', '2023-06-01', '2', 4, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(3, 5, 'Produk Keren banget!', '2023-06-01', '3', 3, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(4, 5, 'Produk Keren banget!', '2023-06-01', '4', 4, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(5, 5, 'Produk Keren banget!', '2023-06-01', '5', 4, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(6, 5, 'Produk Keren banget!', '2023-06-01', '6', 3, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(7, 5, 'Produk Keren banget!', '2023-06-01', '7', 4, '2023-05-31 19:41:10', '2023-05-31 19:41:10'),
(8, 5, 'Produk Keren banget!', '2023-06-01', '8', 3, '2023-05-31 19:41:10', '2023-05-31 19:41:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo_banners`
--

CREATE TABLE `promo_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `promo_banners`
--

INSERT INTO `promo_banners` (`id`, `title`, `photo`, `status`, `product_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Promo Free Ongkir - Special Eid Mubarak 1444 H', 'public/promo-banner/McKez4zSPfjzx8y05N7qWzxnl9t9J0wIuRi7Vn3j.png', 'Aktif', NULL, NULL, '2023-05-31 18:31:07', '2023-05-31 18:56:26'),
(2, 'Promo Terbatas Free Jasa Pelayanan Order Jasa', 'public/promo-banner/QIZugGYh6MXb0fZx387gc3JaeMnXflntZhbnx3Pc.png', 'Aktif', NULL, NULL, '2023-05-31 18:31:07', '2023-05-31 18:56:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price_per_pcs` int(10) UNSIGNED NOT NULL,
  `price_per_dozen` int(10) UNSIGNED NOT NULL,
  `estimation` int(10) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `name`, `photo`, `price_per_pcs`, `price_per_dozen`, `estimation`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
('1', 'Men Cartoon Graphic Drop Shoulder Tee', 'public/service/6WqeFrBGlXd0awExjW87DZ8hnfItNohWPvxbIsBc.webp', 115000, 1350000, 4, 'Color: Grey.\r\n            Style: Casual.\r\n            Pattern Type: Cartoon.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '3', '2023-05-31 01:51:41', '2023-05-31 02:00:10'),
('2', 'Men Color Block Graphic Embroidery Polo Shirt', 'public/service/kFpDDL3RtbVPFxVjJBtXFFXr0nXu6BeEXCUKcDDx.webp', 90000, 1000000, 7, 'Color: Navy Blue.\r\n            Style: Casual.\r\n            Pattern Type: Graphic.\r\n            Material: Fabric.\r\n            Composition: 97% Polyester, 3% Spandex.\r\n            Care Instructions: Machine wash or professional dry clean.', '4', '2023-05-31 01:51:41', '2023-05-31 01:59:38'),
('3', 'Men Cartoon & Slogan Graphic Drop Shoulder Tee', 'public/service/VzauI4aqJHvTQsws7mwPkwrOfrWpjaWxRayQgRqM.webp', 120000, 1400000, 4, 'Color: White.\r\n            Style: Casual.\r\n            Pattern Type: Cartoon, Slogan.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '3', '2023-05-31 01:51:41', '2023-05-31 02:00:22'),
('4', 'Men Gold Plaid Print Shirt', 'public/service/hdkeOtyIOjzuCLU1wMj3uynzGSA5IPx48Nb6NqnF.webp', 145000, 1700000, 7, 'Color: Navy Blue.\r\n            Style: Work.\r\n            Pattern Type: Plaid.\r\n            Type: Shirt.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '4', '2023-05-31 01:51:41', '2023-05-31 02:00:49'),
('5', 'Men Astronaut & Letter Graphic Tee', 'public/service/UtfF0uUtlpn6cUixPTsIcsLe9TgjWzRCCBZ1Nlaj.webp', 150000, 1750000, 5, 'Color: Blue.\r\n            Style: Casual.\r\n            Pattern Type: Letter, Figure.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '3', '2023-05-31 01:51:41', '2023-05-31 02:01:09'),
('6', 'Men Figure & Letter Graphic Tee', 'public/service/XghcCmmd4VBXGZ92WEiqAAaFUlUxVRToJ0CJrno0.webp', 125000, 1450000, 5, 'Color: Khaki.\r\n            Style: Casual.\r\n            Pattern Type: Figure.\r\n            Material: Fabric.\r\n            Composition: 95% Polyester, 5% Elastane.\r\n            Care Instructions: Machine wash, do not dry clean.', '3', '2023-05-31 01:51:41', '2023-05-31 02:01:23'),
('7', 'Men Plaid Print Pocket Patched Shirt', 'public/service/uiVNXJYfwHmStjKU3b9kGp1GodD0G9t9HOPnxmtT.jpg', 230000, 2700000, 7, 'Color: Navy Blue.\r\n            Style: Casual.\r\n            Pattern Type: Plaid.\r\n            Type: Shirt.\r\n            Material: Fabric.\r\n            Composition: 100% Polyester.\r\n            Care Instructions: Machine wash or professional dry clean.', '4', '2023-05-31 01:51:41', '2023-05-31 02:01:45'),
('8', 'Men Contrast Panel Polo Shirt', 'public/service/u8LAqeNvUsSUZrR8rJNOtUoQqi4CQEtEu8i58izR.webp', 100000, 1200000, 7, 'Color: Multicolor.\r\n            Style: Casual.\r\n            Pattern Type: Colorblock.\r\n            Material: Fabric.\r\n            Composition: 97% Polyester, 3% Spandex.\r\n            Care Instructions: Machine wash or professional dry clean.', '4', '2023-05-31 01:51:41', '2023-05-31 02:02:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_ratings`
--

CREATE TABLE `service_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 1,
  `comment` text DEFAULT NULL,
  `rating_date` date NOT NULL DEFAULT curdate(),
  `service_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `service_ratings`
--

INSERT INTO `service_ratings` (`id`, `rating`, `comment`, `rating_date`, `service_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 5, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '1', 3, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(3, 4, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '2', 4, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(4, 4, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '3', 3, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(5, 5, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '4', 4, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(6, 4, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '5', 4, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(7, 5, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '6', 3, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(8, 4, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '7', 3, '2023-05-31 19:56:29', '2023-05-31 19:56:29'),
(9, 5, 'Pelayanan Jasa Cepat dan Sangat Bagus!', '2023-06-01', '8', 4, '2023-05-31 19:56:29', '2023-05-31 19:56:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shop_ratings`
--

CREATE TABLE `shop_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 1,
  `comment` text DEFAULT NULL,
  `rating_date` date NOT NULL DEFAULT curdate(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shop_ratings`
--

INSERT INTO `shop_ratings` (`id`, `rating`, `comment`, `rating_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Toko sangat keren dan memiliki banyak produk menarik', '2023-06-01', 3, '2023-05-31 19:06:22', '2023-05-31 19:06:22'),
(2, 4, 'Pelayanan Jasa toko bagus, dan promo yang ditawarkan cukup menarik', '2023-06-01', 4, '2023-05-31 19:06:22', '2023-05-31 19:06:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracking_logs`
--

CREATE TABLE `tracking_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) DEFAULT 'Sistem',
  `note` text DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `is_complete` varchar(20) NOT NULL DEFAULT 'No',
  `transaction_order_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` varchar(255) NOT NULL,
  `transaction_order_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_orders`
--

CREATE TABLE `transaction_orders` (
  `id` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_address` text NOT NULL,
  `order_note` text DEFAULT NULL,
  `type_transaction_order` varchar(10) NOT NULL,
  `prof_order_payment` varchar(255) NOT NULL DEFAULT 'empty',
  `order_confirmed` varchar(20) NOT NULL DEFAULT 'No',
  `delivery_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_price_transaction_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `track_delivery_location` varchar(100) DEFAULT NULL,
  `status_delivery` varchar(30) NOT NULL,
  `delivery_complete` varchar(20) NOT NULL DEFAULT 'No',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'empty',
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `birthdate` date NOT NULL DEFAULT '2000-01-01',
  `gender` varchar(20) NOT NULL DEFAULT 'Laki-laki',
  `phone` varchar(12) NOT NULL DEFAULT '081234567890',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `photo`, `role`, `birthdate`, `gender`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Print-Shop', 'public/user/wtak8Rrln1BM6BPO15n0ZKwi01Y0aUTZa0unobQa.jpg', 'admin', '2000-01-01', 'Laki-laki', '081234567890', 'admin@gmail.com', NULL, '$2y$10$aFEY0NotDSMdEjyQlYXAA..a1ZU/YS8LWe/hPdbBesxq/bvH9m.mm', NULL, '2023-05-31 01:51:40', '2023-05-31 01:57:02'),
(2, 'Manager Print-Shop', 'empty', 'admin', '2000-01-01', 'Laki-laki', '081234567890', 'manager@gmail.com', NULL, '$2y$10$wMlWlzxa62qeU0lTskCJYONp0qCehT096gdH4M17.k.uTvWeip67m', NULL, '2023-05-31 01:51:40', '2023-05-31 01:51:40'),
(3, 'Customer Rabbit', 'public/user/5GB20rmPcgJZE4sZ6Mq9Nlu7k3z5pynGq0UFj9Ol.png', 'customer', '2000-01-01', 'Laki-laki', '081234567890', 'customerrabbit@gmail.com', NULL, '$2y$10$OdMvZ.hgHFxB/fre/WdNk.cAl8B.1/TWtSrIBimhgC2/AC2BoSh5G', NULL, '2023-05-31 01:51:40', '2023-05-31 19:25:13'),
(4, 'Customer Bunny', 'public/user/Bv5LkmsAG8mSZa2oSsBeboKzNNms0e7QcnsybAAr.png', 'customer', '2000-01-01', 'Laki-laki', '081234567890', 'customerbunny@gmail.com', NULL, '$2y$10$M5asv83TI0F4sh1hGu1M3.ITNu2Eq2c./jLCq/ojFJqbD8xeAciT6', NULL, '2023-05-31 01:51:41', '2023-05-31 19:17:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_products_product_id_foreign` (`product_id`),
  ADD KEY `cart_products_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_service_id_foreign` (`service_id`),
  ADD KEY `order_details_transaction_order_id_foreign` (`transaction_order_id`);

--
-- Indeks untuk tabel `order_services`
--
ALTER TABLE `order_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_services_service_id_foreign` (`service_id`),
  ADD KEY `order_services_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`),
  ADD KEY `product_ratings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `promo_banners`
--
ALTER TABLE `promo_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_banners_product_id_foreign` (`product_id`),
  ADD KEY `promo_banners_service_id_foreign` (`service_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_ratings_service_id_foreign` (`service_id`),
  ADD KEY `service_ratings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `shop_ratings`
--
ALTER TABLE `shop_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_ratings_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tracking_logs`
--
ALTER TABLE `tracking_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracking_logs_transaction_order_id_foreign` (`transaction_order_id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`),
  ADD KEY `transaction_details_transaction_order_id_foreign` (`transaction_order_id`);

--
-- Indeks untuk tabel `transaction_orders`
--
ALTER TABLE `transaction_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_services`
--
ALTER TABLE `order_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `promo_banners`
--
ALTER TABLE `promo_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `service_ratings`
--
ALTER TABLE `service_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `shop_ratings`
--
ALTER TABLE `shop_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tracking_logs`
--
ALTER TABLE `tracking_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_transaction_order_id_foreign` FOREIGN KEY (`transaction_order_id`) REFERENCES `transaction_orders` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_services`
--
ALTER TABLE `order_services`
  ADD CONSTRAINT `order_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promo_banners`
--
ALTER TABLE `promo_banners`
  ADD CONSTRAINT `promo_banners_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promo_banners_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `service_ratings`
--
ALTER TABLE `service_ratings`
  ADD CONSTRAINT `service_ratings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shop_ratings`
--
ALTER TABLE `shop_ratings`
  ADD CONSTRAINT `shop_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tracking_logs`
--
ALTER TABLE `tracking_logs`
  ADD CONSTRAINT `tracking_logs_transaction_order_id_foreign` FOREIGN KEY (`transaction_order_id`) REFERENCES `transaction_orders` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_transaction_order_id_foreign` FOREIGN KEY (`transaction_order_id`) REFERENCES `transaction_orders` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_orders`
--
ALTER TABLE `transaction_orders`
  ADD CONSTRAINT `transaction_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
