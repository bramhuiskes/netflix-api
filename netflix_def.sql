-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Gegenereerd op: 15 jan 2025 om 14:00
-- Serverversie: 10.7.8-MariaDB-1:10.7.8+maria~ubu2004
-- PHP-versie: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netflix`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `failed_jobs`
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
-- Tabelstructuur voor tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_year` year(4) NOT NULL,
  `viewer_indications` text DEFAULT NULL,
  `genres` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `movie_quality_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_year`, `viewer_indications`, `genres`, `created_at`, `updated_at`, `movie_quality_id`) VALUES
(1, 'Inception', '2010', 'Parental guidance suggested; intense scenes', 'Sci-Fi, Thriller', NULL, NULL, NULL),
(2, 'The Lion King', '1994', 'Suitable for all audiences', 'Animation, Family, Adventure', NULL, NULL, NULL),
(3, 'The Godfather', '1972', 'Mature audiences only; violence, language', 'Crime, Drama', NULL, NULL, NULL),
(4, 'Avengers: Endgame', '2019', 'PG-13; action and violence', 'Action, Adventure, Sci-Fi', NULL, NULL, NULL),
(5, 'Frozen', '2013', 'Suitable for all audiences', 'Animation, Family, Musical', NULL, NULL, NULL),
(6, 'Interstellar', '2014', 'Parental guidance suggested; intense scenes', 'Sci-Fi, Adventure, Drama', NULL, NULL, NULL),
(7, 'Parasite', '2019', 'Mature audiences only; language, violence', 'Drama, Thriller', NULL, NULL, NULL),
(8, 'The Dark Knight', '2008', 'PG-13; intense sequences of violence', 'Action, Crime, Drama', NULL, NULL, NULL),
(9, 'Toy Story', '1995', 'Suitable for all audiences', 'Animation, Family, Comedy', NULL, NULL, NULL),
(10, 'Schindler\'s List', '1993', 'Mature audiences only; intense themes', 'Drama, History', NULL, NULL, NULL),
(12, 'FNAF', '2022', '16', 'Horror', '2024-12-17 16:36:23', '2024-12-17 16:36:23', NULL),
(16, 'FNAF2', '2025', '16', 'Horror', '2025-01-08 10:30:25', '2025-01-08 10:30:25', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `movie_qualities`
--

CREATE TABLE `movie_qualities` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `quality_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) DEFAULT NULL,
  `tokenable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(256) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', NULL, 'API Token', 'a6a172e27997f18fa96cddef9cb9ff59712b7c65f11e9b0caadd98e8bbf60017', '[\"*\"]', NULL, NULL, '2024-12-09 11:36:00', '2024-12-09 11:36:00'),
(2, 'App\\Models\\User', NULL, 'API Token', 'c789d8041dd08e7eeba3e90e555a1b1c794f0d26581e61987fb26058d0426c7a', '[\"*\"]', NULL, NULL, '2024-12-09 11:37:08', '2024-12-09 11:37:08'),
(3, 'App\\Models\\User', NULL, 'API Token', '837a26a87fb4750ca59893f5dea842ca0330924158aeac37bc77a00340b3a664', '[\"*\"]', NULL, NULL, '2024-12-09 11:37:19', '2024-12-09 11:37:19'),
(4, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', '673e0f0027b431d018702352c723a2389d5f5e926a6bb514a41055f06c31dde4', '[\"*\"]', NULL, NULL, '2024-12-09 11:39:47', '2024-12-09 11:39:47'),
(5, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', '39b97197852933bcc7654288e00a9ad301fb1232cd1040b314e50030dcc1894c', '[\"*\"]', NULL, NULL, '2024-12-09 11:40:52', '2024-12-09 11:40:52'),
(6, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'a3502fa78fbd62e4647082cdef55da4530135b183cb19d7ff323d07b6b5cc1ec', '[\"*\"]', NULL, NULL, '2024-12-09 11:56:59', '2024-12-09 11:56:59'),
(7, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', '8be095272442407096fa777f437a4e73434904b8a50399e4dad2fa7daa61a3ca', '[\"*\"]', NULL, NULL, '2024-12-09 11:59:25', '2024-12-09 11:59:25'),
(8, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'c15428be3a5ddc53680e7c02071f2d08167321d82a8d893a6eab320721d741cf', '[\"*\"]', NULL, NULL, '2024-12-09 12:01:56', '2024-12-09 12:01:56'),
(9, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'd6ca96af6f7cd0e882c606cf0c8aa369585d3898eec104a9ef3069689e4e7681', '[\"*\"]', NULL, NULL, '2024-12-09 12:04:42', '2024-12-09 12:04:42'),
(10, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'd21f0e18523d8a158871fc453c73aa14432c9b5d006d22c1674864e696698e37', '[\"*\"]', NULL, NULL, '2024-12-09 12:08:05', '2024-12-09 12:08:05'),
(11, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'c1acabb4ab2243138a014d2043d4baf099f9bd9732b33ea3ab1961c3ac43c4e2', '[\"*\"]', NULL, NULL, '2024-12-09 12:10:51', '2024-12-09 12:10:51'),
(12, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '9632a63d28fce865b075164181beb9871c5228d611667f11fc58779e50666ca5', '[\"*\"]', NULL, NULL, '2024-12-09 12:11:24', '2024-12-09 12:11:24'),
(13, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '82b7ba9840447d6917f6f89f521a52b1ce2048befaba2dd294a1d3099f68b035', '[\"*\"]', NULL, NULL, '2024-12-09 12:12:38', '2024-12-09 12:12:38'),
(14, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '3ab258a76a771fe1a502c05eb1d9cc0460e39f956da3aa3ed2251cc7e2938e2e', '[\"*\"]', NULL, NULL, '2024-12-10 13:43:37', '2024-12-10 13:43:37'),
(15, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '920c1664bf3b5c66e4286d30b2d7cf50efdbe40e0c52404dd975f9fe572df7cd', '[\"*\"]', NULL, NULL, '2024-12-10 13:44:24', '2024-12-10 13:44:24'),
(16, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '27fab4fcf71d69614f3f87eedcf01166b0189cdefe7e0a8f104e5b56bef12eb6', '[\"*\"]', NULL, NULL, '2024-12-10 14:02:15', '2024-12-10 14:02:15'),
(17, 'App\\Models\\User', NULL, 'API Token for test2@test.nl', '451d6c846633d545b3969bfbc5019f7f022e714a0fcfb5089c9ee1c49a28f7fb', '[\"*\"]', NULL, NULL, '2024-12-12 08:54:23', '2024-12-12 08:54:23'),
(18, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', '99c382c1eeb1cdf3ddddc43fb0f5412521503c2406c4684ea7ddf1980a28d007', '[\"*\"]', NULL, NULL, '2024-12-12 09:05:24', '2024-12-12 09:05:24'),
(19, 'App\\Models\\User', NULL, 'API Token for test1@test.nl', 'a27a8e5d132261240f11ee404728b5418c26bb07b3d0d567bb46a3fcea90544f', '[\"*\"]', NULL, NULL, '2024-12-12 09:05:53', '2024-12-12 09:05:53'),
(20, 'App\\Models\\User', 4, 'API Token for test1@test.nl', '3b41e803d3bfa5b0c87d33b593fe845af5d0822e2b4bbeb2d68f2a9a4dca13ed', '[\"*\"]', NULL, NULL, '2024-12-12 10:36:09', '2024-12-12 10:36:09'),
(21, 'App\\Models\\User', 10, 'API Token for test4@test.nl', '2a1f8bed369bf11d8ed2795010bad1742b6fdd5a564dfe4b68f85817967c6d83', '[\"*\"]', NULL, NULL, '2024-12-12 10:44:10', '2024-12-12 10:44:10'),
(22, 'App\\Models\\User', 11, 'API Token for test5@test.nl', 'd7508eabfca9753c7011180cbfce8505cb1f28eb236ce72f0f3e06911f8be32e', '[\"*\"]', '2024-12-12 14:52:14', NULL, '2024-12-12 11:12:12', '2024-12-12 14:52:14'),
(23, 'App\\Models\\User', 9, 'API Token for test3@test.nl', 'fb5067bf1a52d350fdbe6a9090a927d8e8c3ead3252b7002e2da083411bf2668', '[\"*\"]', '2024-12-12 11:38:42', NULL, '2024-12-12 11:34:09', '2024-12-12 11:38:42'),
(24, 'App\\Models\\User', 10, 'API Token for test4@test.nl', 'acbb49680837719385420b03e549db44ea671e015cc7fba0e6afea5be92442f9', '[\"*\"]', NULL, NULL, '2024-12-12 11:40:43', '2024-12-12 11:40:43'),
(25, 'App\\Models\\User', 10, 'API Token for test4@test.nl', '59eac736e6e2d288860194f8ea4579fe08aad0ca0fb86de117fe43d721818b74', '[\"*\"]', '2024-12-16 14:43:31', NULL, '2024-12-12 14:52:31', '2024-12-16 14:43:31'),
(27, 'App\\Models\\User', 12, 'API Token for martijn.pomp@nhlstenden.com', 'cc56956b46bd1ff34299dd2dd2eeffe33d1cab5f1e9a4d384812fbf4cda779f5', '[\"*\"]', '2024-12-16 14:38:31', NULL, '2024-12-16 14:08:46', '2024-12-16 14:38:31'),
(28, 'App\\Models\\User', 12, 'API Token for martijn.pomp@nhlstenden.com', 'a412f92d385f46387dd93e6fc70c7643d7aa474bdb521d954130db9d9a93ce08', '[\"*\"]', NULL, NULL, '2024-12-16 14:29:41', '2024-12-16 14:29:41'),
(29, 'App\\Models\\User', 12, 'API Token for martijn.pomp@nhlstenden.com', '9a8f5444f67b975531aa873db0522a1edc096db62f90f16ef5ea7dbe9499d3c4', '[\"*\"]', '2024-12-17 16:56:15', NULL, '2024-12-16 14:30:00', '2024-12-17 16:56:15'),
(30, 'App\\Models\\User', 12, 'API Token for martijn.pomp@nhlstenden.com', 'fd3eea46f331ee3624fc4406a3c11b77a5714194a905df381f59bd66b0444c26', '[\"*\"]', NULL, NULL, '2024-12-17 09:35:11', '2024-12-17 09:35:11'),
(31, 'App\\Models\\User', 10, 'API Token for test4@test.nl', 'e83bf87bb14c9a34e440ca3a2d87e23b7589ae636116f04a14c2a6b5f2cf6542', '[\"*\"]', NULL, NULL, '2025-01-07 08:37:15', '2025-01-07 08:37:15'),
(32, 'App\\Models\\User', 10, 'API Token for test4@test.nl', '5d729f478583c2adcb1c6dd589863ab3306ca906e61d2e8700034cdf2230a7e5', '[\"*\"]', '2025-01-07 16:49:37', NULL, '2025-01-07 16:48:01', '2025-01-07 16:49:37'),
(33, 'App\\Models\\User', 15, 'API Token for test@test.nl', '4acbf71b447ed125d3cb89edb672fc7db3118ba52a70fd1c5781d07c5c8d4ea9', '[\"*\"]', '2025-01-08 09:19:16', NULL, '2025-01-08 09:16:15', '2025-01-08 09:19:16'),
(34, 'App\\Models\\User', 15, 'API Token for test@test.nl', 'ce36e57ed334fb583eb0ec9626a9846e70613921af414b222eb4de24ec799066', '[\"*\"]', '2025-01-08 10:57:29', NULL, '2025-01-08 10:29:46', '2025-01-08 10:57:29'),
(35, 'App\\Models\\User', 15, 'API Token for test@test.nl', '10a4eab7bb42bf556bfe1e0b37e13e63582998ed4d574b5f70dc66a85bb0bfd8', '[\"*\"]', '2025-01-08 15:20:47', NULL, '2025-01-08 15:15:26', '2025-01-08 15:20:47'),
(36, 'App\\Models\\User', 15, 'API Token for test@test.nl', '0cd0f9a9f3d887ab4e8b1fb922ec8c8e94f66f337659d6587b8a9a3315821859', '[\"*\"]', '2025-01-15 13:57:23', NULL, '2025-01-15 13:56:46', '2025-01-15 13:57:23');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `preference_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `quality_types`
--

CREATE TABLE `quality_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `resolution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referrer_user_id` bigint(20) UNSIGNED NOT NULL,
  `referred_user_id` bigint(20) UNSIGNED NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `status` enum('Active','Expired') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_year` year(4) NOT NULL,
  `viewer_indications` text DEFAULT NULL,
  `genres` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quality_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Bmtu57bO5K8MSdT9JFYItvL6jpzLUa3LwBVxTImP', NULL, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDdRUjNtRWNzV1J0b1R1STI0dVlNT0FtaFROZnYyS2xIQlNZRGc2YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733150600),
('gWboKOfrzHjK8n7VCe9M1gqD7BO5bb9PdwG7Z6PF', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVJka0ZSdnRpU3NSSTFya3h2M2tzWjNpaTlYcTBQMkxlSGNtcFMxaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732549517),
('O9fHJ6BNVsTXnxNyWWNF2DCh9DT77gKs8km4wDC9', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTVHc1RxUXBPdUt4TUZEUDF5dlpWVlBkajROcW11SURVZXlaVGlSYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733149934);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_type_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `billing_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subtitles`
--

CREATE TABLE `subtitles` (
  `id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `content_type` enum('Movies','Series') NOT NULL,
  `language` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_status` enum('Active','Blocked','PendingActivation') NOT NULL DEFAULT 'PendingActivation',
  `trial_status` enum('Active','Expired') NOT NULL DEFAULT 'Active',
  `referralCode` varchar(50) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_active`, `is_blocked`, `created_at`, `updated_at`, `account_status`, `trial_status`, `referralCode`, `role_id`) VALUES
(4, 'test1@test.nl', '$2y$12$OdG.BgRWVb/UyVm5FrdvY.78eGDmeHhIr4RwosejzbgqMLy6HCJti', 0, 1, '2024-12-09 11:03:02', '2024-12-09 11:03:02', 'PendingActivation', 'Active', NULL, 2),
(7, 'test2@test.nl', '$2y$12$l9Xs/1p0e1UtqODbquOQyOD1tY1lG6TvSwQHDKu7rGWSw.13zFs6u', 0, 0, '2024-12-09 12:11:08', '2024-12-09 12:11:08', 'PendingActivation', 'Active', NULL, 2),
(9, 'test3@test.nl', '$2y$12$a5LyLsJxRMKJ074EulffNekoLgxa.hCbiXmqkay62YMyT6fmH34NG', 0, 0, '2024-12-12 09:06:07', '2024-12-12 11:33:58', 'PendingActivation', 'Active', NULL, 2),
(10, 'test4@test.nl', '$2y$12$HrHXCMt5O09jFCBjLgpVnOBhnnBzD0oTB6tvYe3I1ygPw7JVbTO4C', 1, 0, '2024-12-12 10:43:14', '2024-12-12 14:55:47', 'PendingActivation', 'Active', NULL, 2),
(11, 'test5@test.nl', '$2y$12$VzyDThvi5kdd4zyOH2SSLOOMljEkbVfUl5sABlN6/srzoQZVUv9wG', 1, 0, '2024-12-12 11:03:04', '2024-12-12 11:14:33', 'PendingActivation', 'Active', NULL, 2),
(12, 'martijn.pomp@nhlstenden.com', '$2y$12$YXdGTp7V1APCjdz4b2qwDusQwzrbpiPiXJHWhPPlhW8FuU1gCI2g6', 1, 0, '2024-12-13 07:59:13', '2024-12-13 08:03:04', 'PendingActivation', 'Active', NULL, 2),
(13, 'martijn.pomp@nhlstenden', '$2y$12$yyt0afZWGhB4f97uHITBquDVkeKGM3188AVMwOe7NZhEcuqehFKjW', 0, 0, '2024-12-13 08:01:19', '2024-12-13 08:01:19', 'PendingActivation', 'Active', NULL, 2),
(14, 'f@gmail.com', '$2y$12$tApSJFWRBabS7RVbUZuSL.AuLxttkcHAZY90Q8C2nQqRT1meJjxWS', 0, 0, '2025-01-07 08:36:56', '2025-01-07 08:36:56', 'PendingActivation', 'Active', NULL, 2),
(15, 'test@test.nl', '$2y$12$qlR0L3TxrZ.Omb6jZZX5luxJhJ7oVxFZSpbJ53QPP6rSrzat9T.1O', 1, 0, '2025-01-08 09:16:00', '2025-01-08 15:20:47', 'PendingActivation', 'Active', NULL, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `view_histories`
--

CREATE TABLE `view_histories` (
  `id` int(11) NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `content_id` int(11) NOT NULL,
  `content_type` enum('Movie','Episode') NOT NULL,
  `watch_date` date NOT NULL,
  `watch_duration` int(11) DEFAULT NULL,
  `completion_status` enum('Completed','Paused','InProgress') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `watchlists`
--

CREATE TABLE `watchlists` (
  `id` int(11) NOT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content_id` int(11) NOT NULL,
  `content_type` enum('Movies','Series') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexen voor tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexen voor tabel `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_series_FK` (`series_id`);

--
-- Indexen voor tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexen voor tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexen voor tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movies_movie_quality_FK` (`movie_quality_id`);

--
-- Indexen voor tabel `movie_qualities`
--
ALTER TABLE `movie_qualities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_quality_movies_FK` (`movie_id`),
  ADD KEY `movie_quality_quality_type_FK` (`quality_type_id`);

--
-- Indexen voor tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexen voor tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexen voor tabel `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferences_profiles_FK` (`profile_id`);

--
-- Indexen voor tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`),
  ADD KEY `profiles_preferences_FK` (`preference_id`);

--
-- Indexen voor tabel `quality_types`
--
ALTER TABLE `quality_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_users_FK` (`referrer_user_id`),
  ADD KEY `referrals_users_FK_1` (`referred_user_id`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_movie_quality_FK` (`quality_id`);

--
-- Indexen voor tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_users_FK` (`user_id`),
  ADD KEY `subscriptions_subscription_type_FK` (`subscription_type_id`);

--
-- Indexen voor tabel `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `subtitles`
--
ALTER TABLE `subtitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roles_FK` (`role_id`);

--
-- Indexen voor tabel `view_histories`
--
ALTER TABLE `view_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_histories_profiles_FK` (`profile_id`);

--
-- Indexen voor tabel `watchlists`
--
ALTER TABLE `watchlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `watchlists_profiles_FK` (`profile_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `movie_qualities`
--
ALTER TABLE `movie_qualities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `subscription_types`
--
ALTER TABLE `subscription_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT voor een tabel `view_histories`
--
ALTER TABLE `view_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `watchlists`
--
ALTER TABLE `watchlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_series_FK` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`);

--
-- Beperkingen voor tabel `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_movie_quality_FK` FOREIGN KEY (`movie_quality_id`) REFERENCES `movie_qualities` (`id`);

--
-- Beperkingen voor tabel `movie_qualities`
--
ALTER TABLE `movie_qualities`
  ADD CONSTRAINT `movie_quality_movies_FK` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `movie_quality_quality_type_FK` FOREIGN KEY (`quality_type_id`) REFERENCES `quality_types` (`id`);

--
-- Beperkingen voor tabel `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_profiles_FK` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`);

--
-- Beperkingen voor tabel `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_preferences_FK` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`),
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_users_FK` FOREIGN KEY (`referrer_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `referrals_users_FK_1` FOREIGN KEY (`referred_user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_movie_quality_FK` FOREIGN KEY (`quality_id`) REFERENCES `movie_qualities` (`id`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_subscription_type_FK` FOREIGN KEY (`subscription_type_id`) REFERENCES `subscription_types` (`id`),
  ADD CONSTRAINT `subscriptions_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Beperkingen voor tabel `view_histories`
--
ALTER TABLE `view_histories`
  ADD CONSTRAINT `view_histories_profiles_FK` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`);

--
-- Beperkingen voor tabel `watchlists`
--
ALTER TABLE `watchlists`
  ADD CONSTRAINT `watchlists_profiles_FK` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- 1. Movies and Series Adder
DROP USER IF EXISTS 'movie_series_adder'@'%';
CREATE USER 'movie_series_adder'@'%' IDENTIFIED BY 'password1';
GRANT INSERT ON netflix.movies TO 'movie_series_adder'@'%';
GRANT INSERT ON netflix.series TO 'movie_series_adder'@'%';
FLUSH PRIVILEGES;

-- 2. User Manager
DROP USER IF EXISTS 'user_manager'@'%';
CREATE USER 'user_manager'@'%' IDENTIFIED BY 'password2';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.users TO 'user_manager'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.profiles TO 'user_manager'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.preferences TO 'user_manager'@'%';
FLUSH PRIVILEGES;

-- 3. Viewer Data Analyst
DROP USER IF EXISTS 'viewer_analyst'@'%';
CREATE USER 'viewer_analyst'@'%' IDENTIFIED BY 'password3';
GRANT SELECT ON netflix.view_histories TO 'viewer_analyst'@'%';
GRANT SELECT ON netflix.watchlists TO 'viewer_analyst'@'%';
GRANT SELECT ON netflix.users TO 'viewer_analyst'@'%';
FLUSH PRIVILEGES;

-- 4. Admin Auditor
DROP USER IF EXISTS 'admin_auditor'@'%';
CREATE USER 'admin_auditor'@'%' IDENTIFIED BY 'password4';
GRANT SELECT ON netflix.* TO 'admin_auditor'@'%';
FLUSH PRIVILEGES;

-- 5. Junior User
DROP USER IF EXISTS 'junior'@'%';
CREATE USER 'junior'@'%' IDENTIFIED BY 'password5';
GRANT SELECT ON netflix.movies TO 'junior'@'%';
GRANT SELECT ON netflix.series TO 'junior'@'%';
GRANT SELECT ON netflix.users TO 'junior'@'%';
FLUSH PRIVILEGES;

-- 6. Medium User
DROP USER IF EXISTS 'medium'@'%';
CREATE USER 'medium'@'%' IDENTIFIED BY 'password6';
GRANT SELECT, INSERT ON netflix.movies TO 'medium'@'%';
GRANT SELECT, INSERT ON netflix.series TO 'medium'@'%';
GRANT SELECT, INSERT ON netflix.users TO 'medium'@'%';
GRANT SELECT, INSERT ON netflix.profiles TO 'medium'@'%';
GRANT SELECT, INSERT ON netflix.preferences TO 'medium'@'%';
FLUSH PRIVILEGES;

-- 7. Senior User
DROP USER IF EXISTS 'senior'@'%';
CREATE USER 'senior'@'%' IDENTIFIED BY 'password7';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.movies TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.series TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.users TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.profiles TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.preferences TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.view_histories TO 'senior'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON netflix.watchlists TO 'senior'@'%';
FLUSH PRIVILEGES;

DELIMITER //

CREATE PROCEDURE AddUser(
    IN user_name VARCHAR(100),
    IN user_email VARCHAR(100),
    IN user_password VARCHAR(255),
    IN user_role_id INT,
    IN user_referral_code VARCHAR(50)
)
BEGIN
    -- Set the desired isolation level for this procedure
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;

START TRANSACTION;
BEGIN
        -- Check if the email already exists
        IF EXISTS (SELECT 1 FROM users WHERE email = user_email) THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Email already exists';
ELSE
            -- Add the new user
            INSERT INTO users (
                name,
                email,
                password,
                is_active,
                is_blocked,
                created_at,
                updated_at,
                account_status,
                trial_status,
                referral_code,
                role_id
            )
            VALUES (
                user_name,
                user_email,
                user_password,
                TRUE,
                FALSE,
                NOW(),
                NOW(),
                'PendingActivation',
                'Active',
                user_referral_code,
                user_role_id
            );
END IF;
END;
COMMIT;
END;
//

DELIMITER //

CREATE PROCEDURE AddMovie(
    IN movie_title VARCHAR(255),
    IN movie_genres VARCHAR(255),
    IN movie_release_year YEAR,
    IN movie_viewer_indications TEXT,
    IN movie_quality_id INT
)
BEGIN
    -- Set the desired isolation level for this procedure
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

START TRANSACTION;
BEGIN
        -- Check if the movie already exists
        IF EXISTS (SELECT 1 FROM movies WHERE title = movie_title AND release_year = movie_release_year) THEN
            ROLLBACK;
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Movie already exists';
ELSE
            -- Add the new movie
            INSERT INTO movies (
                title,
                genres,
                release_year,
                viewer_indications,
                movie_quality_id,
                created_at,
                updated_at
            )
            VALUES (
                movie_title,
                movie_genres,
                movie_release_year,
                movie_viewer_indications,
                movie_quality_id,
                NOW(),
                NOW()
            );
END IF;
END;
COMMIT;
END;
//

DELIMITER ;
