-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table tracking2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.cache: ~0 rows (approximately)

-- Dumping structure for table tracking2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.cache_locks: ~0 rows (approximately)

-- Dumping structure for table tracking2.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.divisions: ~10 rows (approximately)
INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Cutting', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(2, 'Sablon', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(3, 'Bordir', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(4, 'RnD', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(5, 'Sewing Custom', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(6, 'Sewing Qonita', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(7, 'Sewing Toheto', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(8, 'Lubang/Pasang Kancing', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(9, 'QC', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(10, 'Packing', '2024-12-12 00:39:53', '2024-12-12 00:39:53');

-- Dumping structure for table tracking2.division_outputs
CREATE TABLE IF NOT EXISTS `division_outputs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `division_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `unit_size_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `input_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `division_outputs_division_id_foreign` (`division_id`),
  KEY `division_outputs_product_id_foreign` (`product_id`),
  KEY `division_outputs_unit_size_id_foreign` (`unit_size_id`),
  CONSTRAINT `division_outputs_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `division_outputs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `division_outputs_unit_size_id_foreign` FOREIGN KEY (`unit_size_id`) REFERENCES `size_units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.division_outputs: ~2 rows (approximately)
INSERT INTO `division_outputs` (`id`, `division_id`, `product_id`, `unit_size_id`, `qty`, `input_date`, `created_at`, `updated_at`) VALUES
	(11, 1, 6, 2, 15, '2024-12-12', '2024-12-12 00:42:32', '2024-12-12 00:42:32'),
	(19, 5, 6, 3, 5, '2025-01-06', '2025-01-06 00:54:18', '2025-01-06 00:54:18');

-- Dumping structure for table tracking2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table tracking2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.jobs: ~0 rows (approximately)

-- Dumping structure for table tracking2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.job_batches: ~0 rows (approximately)

-- Dumping structure for table tracking2.kategoris
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoris_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.kategoris: ~3 rows (approximately)
INSERT INTO `kategoris` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Baju Anak', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(2, 'PDL/PDH/Korsa/Kemeja', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(3, 'Kemko', '2024-12-12 00:39:53', '2024-12-12 00:39:53');

-- Dumping structure for table tracking2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_12_04_163527_create_size_units_table', 1),
	(5, '2024_12_04_163547_create_kategoris_table', 1),
	(6, '2024_12_04_163632_create_divisions_table', 1),
	(7, '2024_12_04_163651_create_products_table', 1),
	(8, '2024_12_04_163700_create_sizes_table', 1),
	(9, '2024_12_04_163714_create_division_outputs_table', 1),
	(10, '2024_12_16_034031_create_product_divisons_table', 2);

-- Dumping structure for table tracking2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table tracking2.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_product_unique` (`code_product`),
  KEY `products_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `products_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.products: ~2 rows (approximately)
INSERT INTO `products` (`id`, `code_product`, `name_product`, `customer`, `deadline`, `kategori_id`, `created_at`, `updated_at`) VALUES
	(6, 'dz-123', 'kemko', 'dzikrayaat', '2025-01-10', 2, '2024-12-12 00:41:59', '2025-01-03 01:54:27'),
	(9, 'kht', 'kemko2', 'sdads', '2025-01-23', 2, '2025-01-06 01:08:24', '2025-01-06 01:08:24');

-- Dumping structure for table tracking2.product_divisons
CREATE TABLE IF NOT EXISTS `product_divisons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `division_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_divisons_product_id_foreign` (`product_id`),
  KEY `product_divisons_division_id_foreign` (`division_id`),
  CONSTRAINT `product_divisons_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_divisons_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.product_divisons: ~0 rows (approximately)

-- Dumping structure for table tracking2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('VggHwZywp45t5UKsCRAIhydoWz6HLiha6ZBKSGnj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHR5TnlZb2FpSmVsMjRuTkdxQWFZdjRYekZVNHN1R2VaWG1lVE15bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly90cmFja2luZzIudGVzdC9zaXpldW5pdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1736151020);

-- Dumping structure for table tracking2.sizes
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `size_unit_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sizes_product_id_foreign` (`product_id`),
  KEY `sizes_size_unit_id_foreign` (`size_unit_id`),
  CONSTRAINT `sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sizes_size_unit_id_foreign` FOREIGN KEY (`size_unit_id`) REFERENCES `size_units` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.sizes: ~5 rows (approximately)
INSERT INTO `sizes` (`id`, `product_id`, `size_unit_id`, `qty`, `created_at`, `updated_at`) VALUES
	(26, 6, 2, 21, '2025-01-06 00:31:48', '2025-01-06 00:31:48'),
	(27, 6, 3, 10, '2025-01-06 00:31:48', '2025-01-06 00:31:48'),
	(28, 6, 1, 15, '2025-01-06 00:31:48', '2025-01-06 00:31:48'),
	(29, 9, 1, 15, '2025-01-06 01:08:24', '2025-01-06 01:08:24'),
	(30, 9, 2, 50, '2025-01-06 01:08:24', '2025-01-06 01:08:24');

-- Dumping structure for table tracking2.size_units
CREATE TABLE IF NOT EXISTS `size_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `size_units_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.size_units: ~3 rows (approximately)
INSERT INTO `size_units` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'S', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(2, 'M', '2024-12-12 00:39:53', '2024-12-12 00:39:53'),
	(3, 'L', '2024-12-12 00:39:53', '2024-12-12 00:39:53');

-- Dumping structure for table tracking2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tracking2.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', '2024-12-12 00:39:53', '$2y$12$mJzJaOaiCyK9C0DrjQBBR.NK7LzvHBBLjr7y2IqtA0bHEExW.SsEO', 'v5zBTg7KDF', '2024-12-12 00:39:53', '2024-12-12 00:39:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
