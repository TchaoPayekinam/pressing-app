-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 08:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pressing_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_depot` date NOT NULL,
  `date_livraison` date NOT NULL,
  `frais_livraison` double(8,2) DEFAULT NULL,
  `adresse_livraison` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remise` double(8,2) NOT NULL,
  `nom_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `express` tinyint(4) NOT NULL DEFAULT 0,
  `statut` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `date_depot`, `date_livraison`, `frais_livraison`, `adresse_livraison`, `remise`, `nom_client`, `prenom_client`, `adresse_client`, `tel_client`, `express`, `statut`, `created_at`, `updated_at`) VALUES
(1, '2021-10-11', '2021-10-15', 1000.00, 'Adétikopé', 0.00, 'ANAKPA', NULL, 'Agoè Téléssou', '92140526', 1, 0, '2021-10-11 10:16:37', '2021-10-11 17:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `details_commande`
--

CREATE TABLE `details_commande` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `vetement_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` int(11) NOT NULL,
  `laver` tinyint(4) NOT NULL DEFAULT 0,
  `repasser` tinyint(4) NOT NULL DEFAULT 0,
  `retoucher` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `details_commande`
--

INSERT INTO `details_commande` (`id`, `commande_id`, `vetement_id`, `nombre`, `laver`, `repasser`, `retoucher`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 1, 1, 0, 0, NULL, NULL),
(2, 1, 12, 12, 1, 0, 0, NULL, NULL),
(3, 1, 6, 4, 1, 0, 1, NULL, NULL),
(4, 1, 10, 1, 1, 0, 0, NULL, NULL),
(5, 1, 11, 3, 1, 0, 0, NULL, NULL),
(6, 1, 8, 2, 1, 0, 0, NULL, NULL),
(7, 1, 7, 5, 1, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id`, `commande_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_27_164643_create_vetements_table', 1),
(6, '2021_09_29_145654_create_commandes_table', 1),
(7, '2021_09_29_152946_create_details_commande_table', 1),
(8, '2021_10_11_150452_create_factures_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tchao', 'tpayekinam@gmail.com', NULL, '$2y$10$Gx0vHniS/FdOkv/7xDjd.eppmB5ie7A/m7Ptv6EYklzdD7mTP8lcO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vetements`
--

CREATE TABLE `vetements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix_lavage` double(8,2) NOT NULL,
  `prix_repassage` double(8,2) NOT NULL,
  `prix_retouche` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vetements`
--

INSERT INTO `vetements` (`id`, `designation`, `prix_lavage`, `prix_repassage`, `prix_retouche`, `created_at`, `updated_at`) VALUES
(4, 'Boubou', 1000.00, 300.00, 300.00, '2021-10-11 08:42:14', '2021-10-11 08:42:14'),
(5, 'Chaussette', 200.00, 0.00, 0.00, '2021-10-11 08:42:40', '2021-10-11 08:42:40'),
(6, 'Chemise', 400.00, 200.00, 200.00, '2021-10-11 08:43:02', '2021-10-11 08:43:02'),
(7, 'Complet', 800.00, 300.00, 300.00, '2021-10-11 08:43:41', '2021-10-11 08:43:41'),
(8, 'Culotte', 300.00, 150.00, 200.00, '2021-10-11 08:44:09', '2021-10-11 08:44:09'),
(9, 'Drap', 700.00, 300.00, 300.00, '2021-10-11 08:44:36', '2021-10-11 08:44:36'),
(10, 'Habit', 300.00, 150.00, 150.00, '2021-10-11 08:45:17', '2021-10-11 08:45:17'),
(11, 'Pagne', 300.00, 150.00, 150.00, '2021-10-11 08:45:52', '2021-10-11 08:45:52'),
(12, 'Pantalon', 400.00, 200.00, 200.00, '2021-10-11 08:46:10', '2021-10-11 08:46:10'),
(13, 'Pullover', 500.00, 300.00, 200.00, '2021-10-11 08:46:46', '2021-10-11 08:46:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `details_commande_commande_id_foreign` (`commande_id`),
  ADD KEY `details_commande_vetement_id_foreign` (`vetement_id`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factures_commande_id_foreign` (`commande_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vetements`
--
ALTER TABLE `vetements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vetements`
--
ALTER TABLE `vetements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_commande_vetement_id_foreign` FOREIGN KEY (`vetement_id`) REFERENCES `vetements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
