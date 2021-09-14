-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla laravel.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` tinyint(4) NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_category_id_foreign` (`category_id`),
  CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.categories: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT IGNORE INTO `categories` (`id`, `name`, `description`, `slug`, `default`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Uncategorized', NULL, 'uncategorized', 1, NULL, '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.category_post
CREATE TABLE IF NOT EXISTS `category_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_post_post_id_foreign` (`post_id`),
  KEY `category_post_category_id_foreign` (`category_id`),
  CONSTRAINT `category_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.category_post: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `category_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_post` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.comments: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.comment_post
CREATE TABLE IF NOT EXISTS `comment_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_post_post_id_foreign` (`post_id`),
  KEY `comment_post_comment_id_foreign` (`comment_id`),
  CONSTRAINT `comment_post_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.comment_post: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comment_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_post` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.general_settings
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `webTittle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `homeVideo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localVideo` tinyint(4) NOT NULL DEFAULT '1',
  `adminEmail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowRegister` tinyint(4) NOT NULL DEFAULT '0',
  `pinnedOrder` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Desc',
  `defaultRole` int(10) unsigned NOT NULL,
  `bgLogin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bgRegister` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxPostsToDisplay` int(10) unsigned NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `general_settings_defaultrole_foreign` (`defaultRole`),
  CONSTRAINT `general_settings_defaultrole_foreign` FOREIGN KEY (`defaultRole`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.general_settings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `general_settings` DISABLE KEYS */;
INSERT IGNORE INTO `general_settings` (`id`, `webTittle`, `homeVideo`, `localVideo`, `adminEmail`, `allowRegister`, `pinnedOrder`, `defaultRole`, `bgLogin`, `bgRegister`, `maxPostsToDisplay`, `created_at`, `updated_at`) VALUES
	(1, 'Feragon', NULL, 1, 'admin@demo.com', 0, 'Desc', 2, 'http://localhost/blog-feragon-full/public/storage/uploads/photos/backgrounds/background-2.jpg', 'http://localhost/blog-feragon-full/public/storage/uploads/photos/backgrounds/background-1.jpg', 10, NULL, NULL);
/*!40000 ALTER TABLE `general_settings` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.migrations: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2021_07_16_000000_create_sidebar_images', 1),
	(6, '2021_07_25_150712_create_visibility_options_table', 1),
	(7, '2021_07_26_203815_create_posts_table', 1),
	(8, '2021_08_01_204234_create_categories_table', 1),
	(9, '2021_08_02_010726_create_permissions_post_table', 1),
	(10, '2021_08_02_011019_create_permissionsPost_post_table', 1),
	(11, '2021_08_02_155234_create_category_post_table', 1),
	(12, '2021_08_07_201448_create_roles_table', 1),
	(13, '2021_08_07_202235_create_role_user_table', 1),
	(14, '2021_08_09_175048_create_comments_table', 1),
	(15, '2021_08_09_202537_create_comments_posts_table', 1),
	(16, '2021_08_10_155240_create_status_table', 1),
	(17, '2021_08_10_165432_create_tasks_table', 1),
	(18, '2021_08_18_203504_create_general_settings_table', 1),
	(19, '2021_08_19_150253_create_social_settings_table', 1),
	(20, '2021_08_21_193644_create_user_experience_table', 1),
	(21, '2021_08_26_162756_create_public_views_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT IGNORE INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('admin@material.com', '$2y$10$2McOrPIfmfWQ8loAXUkh2OxAhdL/Z/cVvhSwj1UfyMmPQ6k2BhgjK', '2021-09-06 22:53:29');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.permission_posts
CREATE TABLE IF NOT EXISTS `permission_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.permission_posts: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_posts` DISABLE KEYS */;
INSERT IGNORE INTO `permission_posts` (`id`, `permission`, `created_at`, `updated_at`) VALUES
	(1, 'pinned', '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(2, 'allowComments', '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(3, 'restricted', '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `permission_posts` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.permission_post_post
CREATE TABLE IF NOT EXISTS `permission_post_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `permission_post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_post_post_post_id_foreign` (`post_id`),
  KEY `permission_post_post_permission_post_id_foreign` (`permission_post_id`),
  CONSTRAINT `permission_post_post_permission_post_id_foreign` FOREIGN KEY (`permission_post_id`) REFERENCES `permission_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_post_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.permission_post_post: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_post_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_post_post` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tittle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `author_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_author_id_foreign` (`author_id`),
  KEY `posts_visibility_foreign` (`visibility`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_visibility_foreign` FOREIGN KEY (`visibility`) REFERENCES `visibility_options` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.posts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.public_views
CREATE TABLE IF NOT EXISTS `public_views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) unsigned DEFAULT NULL,
  `post_tittle` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_views_post_id_foreign` (`post_id`),
  CONSTRAINT `public_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.public_views: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `public_views` DISABLE KEYS */;
INSERT IGNORE INTO `public_views` (`id`, `page`, `post_id`, `post_tittle`, `views`, `created_at`, `updated_at`) VALUES
	(1, 'home', NULL, NULL, 9, '2021-09-06 20:17:47', '2021-09-06 22:54:32'),
	(2, 'about', NULL, NULL, 110, '2021-09-06 23:17:09', '2021-09-06 23:42:26');
/*!40000 ALTER TABLE `public_views` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.roles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT IGNORE INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Administrador', '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(2, 'User', 'Usuario', '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.role_user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT IGNORE INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.sidebar_images
CREATE TABLE IF NOT EXISTS `sidebar_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.sidebar_images: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `sidebar_images` DISABLE KEYS */;
INSERT IGNORE INTO `sidebar_images` (`id`, `image`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'http://localhost/blog-feragon-full/public/storage/uploads/photos/sidebar-images/sidebar-1.jpg', 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(2, 'http://localhost/blog-feragon-full/public/storage/uploads/photos/sidebar-images/sidebar-2.jpg', 1, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(3, 'http://localhost/blog-feragon-full/public/storage/uploads/photos/sidebar-images/sidebar-3.jpg', 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(4, 'http://localhost/blog-feragon-full/public/storage/uploads/photos/sidebar-images/sidebar-4.jpg', 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(5, NULL, 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(6, NULL, 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(7, NULL, 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(8, NULL, 0, '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `sidebar_images` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.social_settings
CREATE TABLE IF NOT EXISTS `social_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedIn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.social_settings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `social_settings` DISABLE KEYS */;
INSERT IGNORE INTO `social_settings` (`id`, `facebook`, `twitter`, `linkedIn`, `youtube`, `instagram`, `github`, `twitch`, `created_at`, `updated_at`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `social_settings` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.statuses: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT IGNORE INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Created', NULL, NULL),
	(2, 'In Progress', NULL, NULL),
	(3, 'Completed', NULL, NULL);
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `task_id` int(10) unsigned DEFAULT NULL,
  `date_to_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_status_id_foreign` (`status_id`),
  KEY `tasks_task_id_foreign` (`task_id`),
  CONSTRAINT `tasks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.tasks: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `hierarchy` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `show` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `description`, `skills`, `email`, `email_verified_at`, `password`, `image`, `hierarchy`, `admin`, `show`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Admin', NULL, NULL, 'admin@material.com', '2021-09-06 20:17:32', '$2y$10$kY.qUzlIwfPpJ9bbU6Gh1.94SwE2ohDGQRS15ZuSDl86RCkjwRtqG', NULL, NULL, 1, 1, '471sPew1k4GHsU6kR7AjAMFuMLziLGjjPrNjKfth5qlVfB2IMBYCU0AbSfxG', '2021-09-06 20:17:32', '2021-09-06 20:17:32'),
	(2, 'Admin2 Admin', NULL, NULL, 'admin@material2.com', '2021-09-06 20:17:32', '$2y$10$kY.qUzlIwfPpJ9bbU6Gh1.94SwE2ohDGQRS15ZuSDl86RCkjwRtqG', NULL, NULL, 1, 0, '471sPew1k4GHsU6kR7AjAMFuMLziLGjjPrNjKfth5qlVfB2IMBYCU0AbSfxG', '2021-09-06 20:17:32', '2021-09-06 20:17:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.user_experience
CREATE TABLE IF NOT EXISTS `user_experience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_experience_user_id_foreign` (`user_id`),
  CONSTRAINT `user_experience_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.user_experience: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `user_experience` DISABLE KEYS */;
INSERT IGNORE INTO `user_experience` (`id`, `company`, `occupation`, `from`, `to`, `logo`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Coord1', '2021-09-06', '2021-09-06', NULL, 1, NULL, NULL),
	(2, NULL, 'Coord2', '2021-09-06', '2021-09-06', NULL, 2, NULL, NULL);
/*!40000 ALTER TABLE `user_experience` ENABLE KEYS */;

-- Volcando estructura para tabla laravel.visibility_options
CREATE TABLE IF NOT EXISTS `visibility_options` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `visibility` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla laravel.visibility_options: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `visibility_options` DISABLE KEYS */;
INSERT IGNORE INTO `visibility_options` (`id`, `visibility`, `created_at`, `updated_at`) VALUES
	(1, 'Draft', NULL, NULL),
	(2, 'Public', NULL, NULL),
	(3, 'Private', NULL, NULL);
/*!40000 ALTER TABLE `visibility_options` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
