-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 10.38
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
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
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
  `type` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `type`, `status`, `created_at`, `updated_at`) VALUES
('1', 'Kaos', 'Meliputi Distro, Oblong dan lain-lain', 'product', 'Aktif', '2023-05-03 23:54:06', '2023-05-03 23:54:06'),
('2', 'Outfit', 'Meliputi setelan baju outfit dan lain-lain', 'product', 'Aktif', '2023-05-03 23:54:06', '2023-05-03 23:54:06'),
('3', 'Sablon Kaos', 'Meliputi jasa pemesanan baju untuk sablon kaos', 'service', 'Aktif', '2023-05-03 23:54:06', '2023-05-03 23:54:06'),
('4', 'Konveksi Baju', 'Meliputi jasa konveksi baju atau kaos', 'service', 'Aktif', '2023-05-03 23:54:06', '2023-05-03 23:54:06');

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
(7, '2023_04_10_071134_create_carts_table', 1),
(8, '2023_04_11_053644_create_transactions_table', 1),
(9, '2023_04_11_053655_create_transaction_details_table', 1),
(10, '2023_05_04_020342_create_services_table', 1);

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
('da3e0112-cc2a-467a-9680-1505158871c0', 'WHO IN SHOP Men Graphic Shirts Short Sleeve Button Up Hawaiian Graffiti Shirts', 'public/product/CltXsaeHL4ZIaouIjUghc0wGL8sq1ZO1upwoGMSB.jpg', 278000, 34, 'New', 'Tersedia', 'Brand: WHO IN SHOP. Style: Casual, Vintage. Sleeve Type: Short Sleeve. Collar: Spread Collar. Edition Type: Rugular Fit. Fabric: 95% Polyester and 5% Spandex. Gender: Male, Men. Size: Small, Medium, Large, X-Large, XX-Large, XXX-Large', '2', '2023-05-03 23:54:06', '2023-05-03 23:57:02'),
('ec07b619-8171-460d-a4ca-09051cca55ce', 'Amazon Essentials Men Short-Sleeve Crewneck T-Shirt', 'public/product/34hODipHSYk7XIuK7TJIMwWU9ySNPrEvqOQXwBhs.jpg', 160000, 22, 'New', 'Tersedia', 'Solids: 100% Cotton; Heathers: 60% Cotton, 40% Polyester. Imported. No Closure closure. Machine Wash.', '1', '2023-05-03 23:54:06', '2023-05-03 23:57:10');

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
  `estimation` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `name`, `photo`, `price_per_pcs`, `price_per_dozen`, `estimation`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
('1d6f893b-b517-40ff-81b9-475c4fca4c62', 'Men Letter Graphic Tee', 'public/service/mgiwc6q7OPKV3a9RbnCgAskcOQWwiY2UKURNAodL.jpg', 30000, 540000, '4 Hari', 'Black Casual Short Sleeve Polyester Letter Embellished Slight Stretch Summer Men Tops', '3', '2023-05-03 23:54:06', '2023-05-04 00:39:13'),
('9245f0ad-521c-42dd-9cec-82f49f454745', 'Men Sun & Japanese Letter Graphic Tee', 'public/service/ZFmybsI6vpkAOVFw1ZDBARltO1O0Bk3ubhBpB0vu.jpg', 45000, 540000, '5 Hari', 'White Casual Short Sleeve Polyester Graphic Letter Slight Stretch Summer Men Tops', '4', '2023-05-03 23:54:06', '2023-05-04 01:10:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
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
  `phone` varchar(12) NOT NULL DEFAULT 'empty',
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
(1, 'Admin', 'empty', 'admin', '2000-01-01', 'Laki-laki', 'empty', 'admin@gmail.com', NULL, '$2y$10$fcLmsJ/IBYSnAa7XypM/uO4cxn2TiEcH0.iJjr9/l86WbV2UaQkvy', NULL, '2023-05-03 23:54:06', '2023-05-03 23:54:06'),
(2, 'Customer', 'empty', 'customer', '2000-01-01', 'Laki-laki', 'empty', 'customer@gmail.com', NULL, '$2y$10$Lo5/l2uo.dx2XzhgHexS4eVi5zWEZo4YqgFVb6cfL4w0YPmLCZICS', NULL, '2023-05-03 23:54:06', '2023-05-03 23:54:06'),
(3, 'Taufik Hidayat', 'empty', 'customer', '2001-09-12', 'Laki-laki', '082332743884', 'taufikhidayat@gmail.com', NULL, '$2y$10$.OrbIpRtXaf7wMNvaX.BWOzMWW6w1FpVbesUEY6ytiptTcxSB2WCi', NULL, '2023-05-03 23:54:06', '2023-05-03 23:54:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

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
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
