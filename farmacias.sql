-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2018 a las 18:52:01
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmacias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buys`
--

CREATE TABLE `buys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `pay_mode` enum('efectivo','punto') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double(15,2) NOT NULL,
  `iva_config` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `buys`
--

INSERT INTO `buys` (`id`, `user_id`, `pay_mode`, `total`, `iva_config`, `created_at`, `updated_at`) VALUES
(1, 4, 'efectivo', 1100000.00, 0, '2018-01-10 04:39:53', '2018-01-10 04:39:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy_details`
--

CREATE TABLE `buy_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `buy_id` int(10) UNSIGNED NOT NULL,
  `providers_id` int(10) UNSIGNED NOT NULL,
  `stocktaking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `total` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `buy_details`
--

INSERT INTO `buy_details` (`id`, `buy_id`, `providers_id`, `stocktaking_id`, `user_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 4, 100, 1000.00, 100000.00, '2018-01-10 04:39:53', '2018-01-10 04:39:53'),
(2, 1, 1, 1, 4, 100, 10000.00, 1000000.00, '2018-01-10 04:39:53', '2018-01-10 04:39:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy_temporals`
--

CREATE TABLE `buy_temporals` (
  `id` int(10) UNSIGNED NOT NULL,
  `providers_id` int(10) UNSIGNED NOT NULL,
  `stocktaking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `total` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `cedula` int(11) NOT NULL,
  `name_complete` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('masculino','femenino') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `users_id`, `cedula`, `name_complete`, `gender`, `address`, `number`, `email`, `created_at`, `updated_at`) VALUES
(2, 4, 3886100, 'Domingo Antonio Guedez Cresp', 'masculino', 'Ciudad Jardín Calle 3-9 casa # 6', '04144636869', 'alvaro.develoop@gmail.com', '2017-12-30 00:06:11', '2017-12-30 00:06:11'),
(3, 4, 21202500, 'Alvaro Antonio Guedez Crespo', 'femenino', 'Ciudad Jardín', '04124362753', NULL, '2017-12-30 03:10:54', '2017-12-30 03:10:54'),
(4, 4, 4825451, 'Norma Milagros', 'femenino', 'Ciudad Jardín calle 3-9 casa # 6', '04161371687', NULL, '2018-01-16 04:43:45', '2018-01-16 04:43:45'),
(5, 4, 24420507, 'Argenis Guedez', 'masculino', 'Ciudad Jardion', '04262350800', 'argenis_guedez192@hotmail.com', '2018-01-16 04:46:40', '2018-01-16 04:46:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_farmacia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iva_porcentaje` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `nombre_farmacia`, `director`, `director_number`, `director_email`, `logo`, `iva_porcentaje`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Farmacía Sass', 'Alvaro Guedez', '04124362753', 'alvaro.develoop@gmail.com', '1515631118.jpg', 12, 4, '2017-12-29 03:52:45', '2018-01-11 04:38:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_currencies`
--

CREATE TABLE `config_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `percentage` double(15,2) NOT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `config_currencies`
--

INSERT INTO `config_currencies` (`id`, `percentage`, `type`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 12.00, '1', 4, '2017-12-28 23:23:02', '2017-12-28 23:23:02'),
(2, 10.00, '2', 4, '2017-12-28 23:23:48', '2017-12-28 23:23:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detail_sales`
--

CREATE TABLE `detail_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `sales_id` int(10) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `price` double(15,2) NOT NULL,
  `config_currencies_iva` int(11) NOT NULL DEFAULT '0',
  `config_currencies_discount` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `total` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detail_sales`
--

INSERT INTO `detail_sales` (`id`, `sales_id`, `products_id`, `price`, `config_currencies_iva`, `config_currencies_discount`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 5000.00, 0, 0, 1000, 5000000.00, '2017-12-30 03:06:51', '2017-12-30 03:06:51'),
(2, 3, 1, 20000.00, 12, 10, 50, 1008000.00, '2017-12-30 03:06:51', '2017-12-30 03:06:51'),
(3, 4, 1, 20000.00, 12, 10, 5, 100800.00, '2017-12-30 03:10:54', '2017-12-30 03:10:54'),
(4, 4, 2, 5000.00, 0, 0, 1, 5000.00, '2017-12-30 03:10:54', '2017-12-30 03:10:54'),
(5, 5, 1, 20000.00, 12, 10, 5, 100800.00, '2017-12-30 03:16:25', '2017-12-30 03:16:25'),
(6, 5, 2, 5000.00, 0, 0, 9, 45000.00, '2017-12-30 03:16:25', '2017-12-30 03:16:25'),
(7, 6, 2, 5000.00, 0, 0, 10, 50000.00, '2017-12-30 03:22:31', '2017-12-30 03:22:31'),
(8, 6, 1, 20000.00, 12, 10, 10, 201600.00, '2017-12-30 03:22:32', '2017-12-30 03:22:32'),
(9, 7, 2, 5000.00, 0, 0, 10, 50000.00, '2017-12-30 03:24:27', '2017-12-30 03:24:27'),
(10, 7, 1, 20000.00, 12, 10, 10, 201600.00, '2017-12-30 03:24:28', '2017-12-30 03:24:28'),
(11, 8, 2, 5000.00, 0, 0, 20, 100000.00, '2017-12-30 03:26:41', '2017-12-30 03:26:41'),
(12, 8, 1, 20000.00, 12, 10, 1, 20160.00, '2017-12-30 03:26:41', '2017-12-30 03:26:41'),
(13, 9, 2, 5000.00, 0, 0, 50, 250000.00, '2017-12-30 03:28:04', '2017-12-30 03:28:04'),
(14, 9, 1, 20000.00, 12, 10, 19, 383040.00, '2017-12-30 03:28:05', '2017-12-30 03:28:05'),
(15, 10, 2, 5000.00, 0, 0, 5, 25000.00, '2018-01-11 19:40:52', '2018-01-11 19:40:52'),
(16, 10, 1, 20000.00, 12, 10, 10, 201600.00, '2018-01-11 19:40:52', '2018-01-11 19:40:52'),
(17, 11, 1, 20000.00, 12, 10, 2, 40320.00, '2018-01-16 04:43:45', '2018-01-16 04:43:45'),
(18, 11, 2, 5000.00, 0, 0, 2, 10000.00, '2018-01-16 04:43:46', '2018-01-16 04:43:46'),
(19, 12, 1, 20000.00, 12, 10, 2, 40320.00, '2018-01-16 04:44:34', '2018-01-16 04:44:34'),
(20, 12, 2, 5000.00, 0, 0, 10, 50000.00, '2018-01-16 04:44:34', '2018-01-16 04:44:34'),
(21, 13, 1, 20000.00, 12, 10, 1, 20160.00, '2018-01-16 04:45:42', '2018-01-16 04:45:42'),
(22, 14, 2, 5000.00, 0, 0, 10, 50000.00, '2018-01-16 04:46:40', '2018-01-16 04:46:40'),
(23, 10, 1, 5000.00, 12, 0, 5, 28000.00, '2018-01-17 06:02:18', '2018-01-17 06:02:18'),
(69, 69, 2, 10000.00, 0, 3, 1, 10000.00, '2018-01-17 08:21:58', '2018-01-17 08:21:58'),
(70, 70, 7, 35000.00, 0, 0, 2, 70000.00, '2018-01-17 08:21:59', '2018-01-17 08:21:59'),
(71, 71, 2, 5000.00, 0, 0, 1, 5000.00, '2018-01-18 01:28:07', '2018-01-18 01:28:07'),
(72, 72, 7, 15000.00, 0, 0, 5, 75000.00, '2018-01-18 01:29:03', '2018-01-18 01:29:03'),
(73, 73, 1, 20000.00, 12, 10, 1, 20160.00, '2018-01-18 01:30:12', '2018-01-18 01:30:12'),
(74, 73, 2, 5000.00, 0, 0, 1, 5000.00, '2018-01-18 01:30:12', '2018-01-18 01:30:12'),
(75, 73, 7, 15000.00, 0, 0, 1, 15000.00, '2018-01-18 01:30:13', '2018-01-18 01:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `id_estado`, `estado`) VALUES
(1, 1, 'DISTRITO CAPITAL'),
(2, 2, 'ANZOATEGUI'),
(3, 3, 'APURE'),
(4, 4, 'ARAGUA'),
(5, 5, 'BARINAS'),
(6, 6, 'BOLIVAR'),
(7, 7, 'CARABOBO'),
(8, 8, 'COJEDES'),
(9, 9, 'FALCON'),
(10, 10, 'GUARICO'),
(11, 11, 'LARA'),
(12, 12, 'MERIDA'),
(13, 13, 'MIRANDA'),
(14, 14, 'MONAGAS'),
(15, 15, 'NUEVA ESPARTA'),
(16, 16, 'PORTUGUESA'),
(17, 17, 'SUCRE'),
(18, 18, 'TACHIRA'),
(19, 19, 'TRUJILLO'),
(20, 20, 'YARACUY'),
(21, 21, 'ZULIA'),
(22, 22, 'AMAZONAS'),
(23, 23, 'DELTA AMACURO'),
(24, 24, 'VARGAS'),
(25, 99, 'EMBAJADA'),
(26, 98, 'INDEFINIDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Pastillas', 4, '2017-12-28 23:12:23', '2017-12-28 23:12:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(26, '2017_12_26_015330_create_providers_table', 2),
(35, '2017_12_26_211420_create_configs_table', 3),
(36, '2017_12_27_000230_create_trademarks_table', 3),
(37, '2017_12_27_000500_create_groups_table', 3),
(38, '2017_12_27_005150_create_config_currencies_table', 3),
(52, '2017_12_27_230722_create_stocktakings_table', 4),
(53, '2017_12_28_172525_create_clients_table', 4),
(64, '2017_12_28_172554_create_sales_table', 5),
(65, '2017_12_29_180021_create_detail_sales_table', 5),
(66, '2017_12_29_180306_create_temp_sales_table', 5),
(76, '2018_01_09_172328_create_buys_table', 6),
(77, '2018_01_09_225843_create_buy_details_table', 6),
(78, '2018_01_09_232916_create_buy_temporals_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `municipio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `id_municipio`, `municipio`, `id_estado`) VALUES
(1, 6, 'SAN FERNANDO', 3),
(2, 1, 'ACHAGUAS', 3),
(3, 7, 'BIRUACA', 3),
(4, 2, 'MUÑOZ', 3),
(5, 3, 'PAEZ', 3),
(6, 4, 'PEDRO CAMEJO', 3),
(7, 5, 'ROMULO GALLEGOS', 3),
(8, 2, 'BARINAS', 5),
(9, 10, 'ANTONIO JOSE DE SUCRE', 5),
(10, 9, 'ALBERTO ARVELO TORREALBA', 5),
(11, 12, 'ANDRES ELOY BLANCO', 5),
(12, 1, 'ARISMENDI', 5),
(13, 3, 'BOLIVAR', 5),
(14, 11, 'CRUZ PAREDES', 5),
(15, 4, 'EZEQUIEL ZAMORA', 5),
(16, 5, 'OBISPOS', 5),
(17, 6, 'PEDRAZA', 5),
(18, 7, 'ROJAS', 5),
(19, 8, 'SOSA', 5),
(20, 3, 'HERES', 6),
(21, 8, 'BOLIVARIANO ANGOSTURA', 6),
(22, 1, 'CARONI', 6),
(23, 2, 'CEDEÑO', 6),
(24, 10, 'EL CALLAO', 6),
(25, 9, 'GRAN SABANA', 6),
(26, 11, 'PADRE PEDRO CHIEN', 6),
(27, 4, 'PIAR', 6),
(28, 5, 'ROSCIO', 6),
(29, 7, 'SIFONTES', 6),
(30, 6, 'SUCRE', 6),
(31, 2, 'IRIBARREN', 11),
(32, 8, 'ANDRES ELOY BLANCO', 11),
(33, 1, 'CRESPO', 11),
(34, 3, 'JIMENEZ', 11),
(35, 4, 'MORAN', 11),
(36, 5, 'PALAVECINO', 11),
(37, 9, 'SIMON PLANAS', 11),
(38, 6, 'TORRES', 11),
(39, 7, 'URDANETA', 11),
(40, 1, 'ATURES', 22),
(41, 7, 'ALTO ORINOCO', 22),
(42, 2, 'ATABAPO', 22),
(43, 5, 'AUTANA', 22),
(44, 6, 'MANAPIARE', 22),
(45, 3, 'MAROA', 22),
(46, 4, 'RIO NEGRO', 22),
(47, 3, 'BOLIVAR', 2),
(48, 1, 'ANACO', 2),
(49, 2, 'ARAGUA', 2),
(50, 4, 'BRUZUAL', 2),
(51, 5, 'CAJIGAL', 2),
(52, 18, 'CARVAJAL', 2),
(53, 6, 'FREITES', 2),
(54, 14, 'GUANIPA', 2),
(55, 15, 'GUANTA', 2),
(56, 7, 'INDEPENDENCIA', 2),
(57, 17, 'L/DIEGO BAUTISTA', 2),
(58, 8, 'LIBERTAD', 2),
(59, 20, 'MC GREGOR', 2),
(60, 9, 'MIRANDA', 2),
(61, 10, 'MONAGAS', 2),
(62, 11, 'PEÑALVER', 2),
(63, 16, 'PIRITU', 2),
(64, 19, 'SANTA ANA', 2),
(65, 12, 'SIMON RODRIGUEZ', 2),
(66, 21, 'S JUAN CAPISTRANO', 2),
(67, 13, 'SOTILLO', 2),
(68, 8, 'LIBERTADOR', 12),
(69, 1, 'ALBERTO ADRIANI', 12),
(70, 2, 'ANDRES BELLO', 12),
(71, 11, 'ANTONIO PINTO S', 12),
(72, 22, 'ARICAGUA', 12),
(73, 3, 'ARZOBISPO CHACON', 12),
(74, 4, 'CAMPO ELIAS', 12),
(75, 13, 'CARACCIOLO PARRA', 12),
(76, 14, 'CARDENAL QUINTERO', 12),
(77, 5, 'GUARAQUE', 12),
(78, 6, 'JULIO CESAR SALAS', 12),
(79, 7, 'JUSTO BRICEÑO', 12),
(80, 10, 'MIRANDA', 12),
(81, 12, 'RAMOS DE LORA', 12),
(82, 21, 'PADRE NOGUERA', 12),
(83, 15, 'PUEBLO LLANO', 12),
(84, 16, 'RANGEL', 12),
(85, 17, 'RIVAS DAVILA', 12),
(86, 9, 'SANTOS MARQUINA', 12),
(87, 18, 'SUCRE', 12),
(88, 19, 'TOVAR', 12),
(89, 20, 'TULIO F CORDERO', 12),
(90, 23, 'ZEA', 12),
(91, 8, 'SAN CRISTOBAL', 18),
(92, 18, 'ANDRES BELLO', 18),
(93, 23, 'ANTONIO ROMULO C', 18),
(94, 1, 'AYACUCHO', 18),
(95, 2, 'BOLIVAR', 18),
(96, 4, 'CARDENAS', 18),
(97, 10, 'CORDOBA', 18),
(98, 24, 'FCO DE MIRANDA', 18),
(99, 19, 'FERNANDEZ FEO', 18),
(100, 11, 'GARCIA DE HEVIA', 18),
(101, 12, 'GUASIMOS', 18),
(102, 3, 'INDEPENDENCIA', 18),
(103, 5, 'JAUREGUI', 18),
(104, 25, 'JOSE MARIA VARGA', 18),
(105, 6, 'JUNIN', 18),
(106, 20, 'LIBERTAD', 18),
(107, 14, 'LIBERTADOR', 18),
(108, 7, 'LOBATERA', 18),
(109, 13, 'MICHELENA', 18),
(110, 15, 'PANAMERICANO', 18),
(111, 16, 'PEDRO MARIA UREÑA', 18),
(112, 26, 'RAFAEL URDANETA', 18),
(113, 21, 'SAMUEL MALDONADO', 18),
(114, 29, 'SAN JUDAS TADEO', 18),
(115, 22, 'SEBORUCO', 18),
(116, 27, 'SIMON RODRIGUEZ', 18),
(117, 17, 'SUCRE', 18),
(118, 28, 'TORBES', 18),
(119, 9, 'URIBANTE', 18),
(120, 1, 'VARGAS', 24),
(121, 1, 'BLVNO LIBERTADOR', 1),
(122, 1, 'BEJUMA', 7),
(123, 2, 'CARLOS ARVELO', 7),
(124, 3, 'DIEGO IBARRA', 7),
(125, 4, 'GUACARA', 7),
(126, 5, 'MONTALVAN', 7),
(127, 6, 'JUAN JOSE MORA', 7),
(128, 7, 'PUERTO CABELLO', 7),
(129, 8, 'SAN JOAQUIN', 7),
(130, 9, 'VALENCIA', 7),
(131, 10, 'MIRANDA', 7),
(132, 11, 'LOS GUAYOS', 7),
(133, 12, 'NAGUANAGUA', 7),
(134, 13, 'SAN DIEGO', 7),
(135, 14, 'LIBERTADOR', 7),
(136, 1, 'ANZOATEGUI', 8),
(137, 2, 'TINAQUILLO', 8),
(138, 3, 'GIRARDOT', 8),
(139, 4, 'PAO S J BAUTISTA', 8),
(140, 5, 'RICAURTE', 8),
(141, 6, 'EZEQUIEL ZAMORA', 8),
(142, 7, 'TINACO', 8),
(143, 8, 'LIMA BLANCO', 8),
(144, 9, 'ROMULO GALLEGOS', 8),
(145, 1, 'ACOSTA', 9),
(146, 2, 'BOLIVAR', 9),
(147, 3, 'BUCHIVACOA', 9),
(148, 4, 'CARIRUBANA', 9),
(149, 5, 'COLINA', 9),
(150, 6, 'DEMOCRACIA', 9),
(151, 7, 'FALCON', 9),
(152, 8, 'FEDERACION', 9),
(153, 9, 'MAUROA', 9),
(154, 10, 'MIRANDA', 9),
(155, 11, 'PETIT', 9),
(156, 12, 'SILVA', 9),
(157, 13, 'ZAMORA', 9),
(158, 14, 'DABAJURO', 9),
(159, 15, 'MONS. ITURRIZA', 9),
(160, 16, 'LOS TAQUES', 9),
(161, 17, 'PIRITU', 9),
(162, 18, 'UNION', 9),
(163, 19, 'SAN FRANCISCO', 9),
(164, 20, 'JACURA', 9),
(165, 21, 'CACIQUE MANAURE', 9),
(166, 22, 'PALMA SOLA', 9),
(167, 23, 'SUCRE', 9),
(168, 24, 'URUMACO', 9),
(169, 25, 'TOCOPERO', 9),
(170, 1, 'INFANTE', 10),
(171, 2, 'MELLADO', 10),
(172, 3, 'MIRANDA', 10),
(173, 4, 'MONAGAS', 10),
(174, 5, 'RIBAS', 10),
(175, 6, 'ROSCIO', 10),
(176, 7, 'ZARAZA', 10),
(177, 8, 'CAMAGUAN', 10),
(178, 9, 'S JOSE DE GUARIBE', 10),
(179, 10, 'LAS MERCEDES', 10),
(180, 11, 'EL SOCORRO', 10),
(181, 12, 'ORTIZ', 10),
(182, 13, 'S MARIA DE IPIRE', 10),
(183, 14, 'CHAGUARAMAS', 10),
(184, 15, 'SAN GERONIMO DE G', 10),
(185, 1, 'TUCUPITA', 23),
(186, 2, 'PEDERNALES', 23),
(187, 3, 'ANTONIO DIAZ', 23),
(188, 4, 'CASACOIMA', 23),
(189, 5, 'TRUJILLO', 19),
(190, 15, 'ANDRES BELLO', 19),
(191, 2, 'BOCONO', 19),
(192, 16, 'BOLIVAR', 19),
(193, 8, 'CANDELARIA', 19),
(194, 3, 'CARACHE', 19),
(195, 4, 'ESCUQUE', 19),
(196, 17, 'JOSE FELIPE MARQUEZ CAÑIZALEZ', 19),
(197, 18, 'JUAN VICENTE CAMPO ELIAS', 19),
(198, 19, 'LA CEIBA', 19),
(199, 9, 'MIRANDA', 19),
(200, 10, 'MONTE CARMELO', 19),
(201, 11, 'MOTATAN', 19),
(202, 12, 'PAMPAN', 19),
(203, 20, 'PAMPANITO', 19),
(204, 1, 'RAFAEL RANGEL', 19),
(205, 13, 'SAN RAFAEL CARVAJAL', 19),
(206, 14, 'SUCRE', 19),
(207, 6, 'URDANETA', 19),
(208, 7, 'VALERA', 19),
(209, 1, 'BOLIVAR', 20),
(210, 2, 'BRUZUAL', 20),
(211, 3, 'NIRGUA', 20),
(212, 4, 'SAN FELIPE', 20),
(213, 5, 'SUCRE', 20),
(214, 6, 'URACHICHE', 20),
(215, 7, 'PEÑA', 20),
(216, 8, 'JOSE ANTONIO PAEZ', 20),
(217, 9, 'LA TRINIDAD', 20),
(218, 10, 'COCOROTE', 20),
(219, 11, 'INDEPENDENCIA', 20),
(220, 12, 'ARISTIDES BASTIDAS', 20),
(221, 13, 'MANUEL MONGE', 20),
(222, 14, 'VEROES', 20),
(223, 1, 'BARALT', 21),
(224, 2, 'SANTA RITA', 21),
(225, 3, 'COLON', 21),
(226, 4, 'MARA', 21),
(227, 5, 'MARACAIBO', 21),
(228, 6, 'MIRANDA', 21),
(229, 7, 'BLVNO GUAJIRA', 21),
(230, 8, 'MACHIQUES DE PERIJA', 21),
(231, 9, 'SUCRE', 21),
(232, 10, 'LA CAÑADA DE URDANETA', 21),
(233, 11, 'LAGUNILLAS', 21),
(234, 12, 'CATATUMBO', 21),
(235, 13, 'ROSARIO DE PERIJA', 21),
(236, 14, 'CABIMAS', 21),
(237, 15, 'VALMORE RODRIGUEZ', 21),
(238, 16, 'JESUS ENRIQUE LOSSADA', 21),
(239, 17, 'ALMIRANTE PADILLA', 21),
(240, 18, 'SAN FRANCISCO', 21),
(241, 19, 'JESUS MARIA SEMPRUN', 21),
(242, 20, 'FRANCISCO JAVIER PULGAR', 21),
(243, 21, 'SIMON BOLIVAR', 21),
(244, 3, 'GUAICAIPURO     ', 13),
(245, 1, 'ACEVEDO      ', 13),
(246, 14, 'ANDRES BELLO     ', 13),
(247, 16, 'BARUTA      ', 13),
(248, 2, 'BRION     ', 13),
(249, 20, 'BUROZ      ', 13),
(250, 17, 'CARRIZAL     ', 13),
(251, 18, 'CHACAO      ', 13),
(252, 12, 'CRISTOBAL ROJAS     ', 13),
(253, 19, 'EL HATILLO     ', 13),
(254, 4, 'INDEPENDENCIA     ', 13),
(255, 5, 'LANDER      ', 13),
(256, 13, 'LOS SALIAS     ', 13),
(257, 6, 'PAEZ      ', 13),
(258, 7, 'PAZ CASTILLO     ', 13),
(259, 21, 'PEDRO GUAL      ', 13),
(260, 8, 'PLAZA     ', 13),
(261, 15, 'SIMON BOLIVAR     ', 13),
(262, 9, 'SUCRE      ', 13),
(263, 10, 'URDANETA      ', 13),
(264, 11, 'ZAMORA', 13),
(265, 7, 'MATURIN     ', 14),
(266, 1, 'ACOSTA     ', 14),
(267, 11, 'AGUASAY     ', 14),
(268, 2, 'BOLIVAR     ', 14),
(269, 3, 'CARIPE     ', 14),
(270, 4, 'CEDEÑO ', 14),
(271, 5, 'EZEQUIEL ZAMORA     ', 14),
(272, 6, 'LIBERTADOR     ', 14),
(273, 8, 'PIAR     ', 14),
(274, 9, 'PUNCERES     ', 14),
(275, 12, 'SANTA BARBARA     ', 14),
(276, 10, 'SOTILLO     ', 14),
(277, 13, 'URACOA', 14),
(278, 1, 'ARISMENDI     ', 15),
(279, 10, 'ANTOLIN DEL CAMPO     ', 15),
(280, 2, 'DIAZ     ', 15),
(281, 11, 'GARCIA ', 15),
(282, 3, 'GOMEZ ', 15),
(283, 4, 'MANEIRO     ', 15),
(284, 5, 'MARCANO     ', 15),
(285, 6, 'MARIÑO     ', 15),
(286, 7, 'PENIN. DE MACANAO     ', 15),
(287, 9, 'TUBORES     ', 15),
(288, 8, 'VILLALBA I COCHE', 15),
(289, 3, 'GUANARE     ', 16),
(290, 10, 'AGUA BLANCA     ', 16),
(291, 1, 'ARAURE ', 16),
(292, 2, 'ESTELLER     ', 16),
(293, 12, 'GENARO BOCONOITO     ', 16),
(294, 4, 'GUANARITO     ', 16),
(295, 9, 'M.JOSE V DE UNDA     ', 16),
(296, 5, 'OSPINO ', 16),
(297, 6, 'PAEZ ', 16),
(298, 11, 'PAPELON     ', 16),
(299, 14, 'SANTA ROSALIA     ', 16),
(300, 13, 'RAFAEL DE ONOTO     ', 16),
(301, 7, 'SUCRE     ', 16),
(302, 8, 'TUREN', 16),
(303, 9, 'SUCRE     ', 17),
(304, 11, 'ANDRES ELOY BLANCO     ', 17),
(305, 13, 'ANDRES MATA     ', 17),
(306, 1, 'ARISMENDI     ', 17),
(307, 2, 'BENITEZ     ', 17),
(308, 3, 'BERMUDEZ     ', 17),
(309, 14, 'BOLIVAR     ', 17),
(310, 4, 'CAJIGAL     ', 17),
(311, 15, 'CRUZ S ACOSTA     ', 17),
(312, 12, 'LIBERTADOR     ', 17),
(313, 5, 'MARIÑO     ', 17),
(314, 6, 'MEJIA     ', 17),
(315, 7, 'MONTES     ', 17),
(316, 8, 'RIBERO     ', 17),
(317, 10, 'VALDEZ     ', 17),
(318, 1, 'GIRARDOT', 4),
(319, 2, 'SANTIAGO MARIÑO', 4),
(320, 3, 'JOSE FELIX RIBAS', 4),
(321, 4, 'SAN CASIMIRO', 4),
(322, 5, 'SAN SEBASTIAN', 4),
(323, 6, 'SUCRE', 4),
(324, 7, 'URDANETA', 4),
(325, 8, 'ZAMORA', 4),
(326, 9, 'LIBERTADOS', 4),
(327, 10, 'JOSE ANGEL LAMAS', 4),
(328, 11, 'BOLIVAR', 4),
(329, 12, 'SANTOS MICHELENA', 4),
(330, 13, 'MARIO BRICEÑO IRAGORRY', 4),
(331, 14, 'TOVAR', 4),
(332, 15, 'CAMATAGUA', 4),
(333, 16, 'JOSE RAFAEL REVENGA', 4),
(334, 17, 'FRANCISCO LINARES ALCANTARA', 4),
(335, 18, 'OCUMARE DE LA COSTA', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id` int(11) NOT NULL,
  `id_parroquia` int(11) DEFAULT NULL,
  `parroquia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id`, `id_parroquia`, `parroquia`, `id_municipio`, `id_estado`) VALUES
(1, 1, 'ACHAGUAS     ', 1, 3),
(2, 2, 'APURITO     ', 1, 3),
(3, 3, 'EL YAGUAL     ', 1, 3),
(4, 4, 'GUACHARA     ', 1, 3),
(5, 5, 'MUCURITAS     ', 1, 3),
(6, 6, 'QUESERAS DEL MEDIO', 1, 3),
(7, 1, 'BRUZUAL     ', 2, 3),
(8, 2, 'MANTECAL     ', 2, 3),
(9, 3, 'QUINTERO', 2, 3),
(10, 4, 'SAN VICENTE', 2, 3),
(11, 5, 'RINCON HONDO', 2, 3),
(12, 2, 'ARAMENDI     ', 3, 3),
(13, 3, 'EL AMPARO     ', 3, 3),
(14, 1, 'GUASDUALITO     ', 3, 3),
(15, 4, 'SAN CAMILO     ', 3, 3),
(16, 5, 'URDANETA', 3, 3),
(17, 2, 'CODAZZI     ', 4, 3),
(18, 3, 'CUNAVICHE ', 4, 3),
(19, 1, 'SAN JUAN DE PAYARA', 4, 3),
(20, 1, 'ELORZA     ', 5, 3),
(21, 2, 'LA TRINIDAD', 5, 3),
(22, 3, 'EL RECREO     ', 6, 3),
(23, 2, 'PEÑALVER     ', 6, 3),
(24, 1, 'SAN FERNANDO ', 6, 3),
(25, 4, 'SAN RAFAEL DE ATAMAICA ', 6, 3),
(26, 1, 'BIRUACA', 7, 3),
(27, 1, 'ARISMENDI     ', 1, 5),
(28, 2, 'GUADARRAMA     ', 1, 5),
(29, 3, 'LA UNION     ', 1, 5),
(30, 4, 'SAN ANTONIO', 1, 5),
(31, 1, 'ALFREDO ARVELO LARRIVA     ', 2, 5),
(32, 11, 'ALTO BARINAS     ', 2, 5),
(33, 2, 'BARINAS     ', 2, 5),
(34, 9, 'CORAZON DE JESUS     ', 2, 5),
(35, 14, 'DOMINGA ORTIZ DE PAEZ     ', 2, 5),
(36, 7, 'EL CARMEN     ', 2, 5),
(37, 13, 'JUAN ANTONIO RODRIGUEZ DOMINGUEZ     ', 2, 5),
(38, 12, 'MANUEL PALACIO FAJARDO     ', 2, 5),
(39, 10, 'RAMON IGNACIO MENDEZ     ', 2, 5),
(40, 8, 'ROMULO BETANCOURT     ', 2, 5),
(41, 3, 'SAN SILVESTRE     ', 2, 5),
(42, 4, 'SANTA INES     ', 2, 5),
(43, 5, 'SANTA LUCIA     ', 2, 5),
(44, 6, 'TORUNOS', 2, 5),
(45, 1, 'ALTAMIRA     ', 3, 5),
(46, 2, 'BARINITAS ', 3, 5),
(47, 3, 'CALDERAS', 3, 5),
(48, 2, 'JOSE IGNACIO DEL PUMAR     ', 4, 5),
(49, 4, 'PEDRO BRICEÑO MENDEZ     ', 4, 5),
(50, 3, 'RAMON IGNACIO MENDEZ     ', 4, 5),
(51, 1, 'SANTA BARBARA', 4, 5),
(52, 1, 'EL REAL     ', 5, 5),
(53, 2, 'LA LUZ     ', 5, 5),
(54, 4, 'LOS GUASIMITOS     ', 5, 5),
(55, 3, 'OBISPOS', 5, 5),
(56, 1, 'CIUDAD BOLIVIA     ', 6, 5),
(57, 2, 'IGNACIO BRICEÑO ', 6, 5),
(58, 4, 'JOSE FELIX RIBAS     ', 6, 5),
(59, 3, 'PAEZ', 6, 5),
(60, 1, 'DOLORES     ', 7, 5),
(61, 2, 'LIBERTAD     ', 7, 5),
(62, 3, 'PALACIO FAJARDO     ', 7, 5),
(63, 4, 'SANTA ROSA     ', 7, 5),
(64, 5, 'SIMON RODRIGUEZ', 7, 5),
(65, 1, 'CIUDAD DE NUTRIAS     ', 8, 5),
(66, 2, 'EL REGALO     ', 8, 5),
(67, 3, 'PUERTO DE NUTRIAS     ', 8, 5),
(68, 4, 'SANTA CATALINA     ', 8, 5),
(69, 5, 'SIMON BOLIVAR', 8, 5),
(70, 1, 'RODRIGUEZ DOMINGUEZ ', 9, 5),
(71, 2, 'SABANETA', 9, 5),
(72, 3, 'ANDRES BELLO     ', 10, 5),
(73, 2, 'NICOLAS PULIDO     ', 10, 5),
(74, 1, 'TICOPORO', 10, 5),
(75, 1, 'BARRANCAS     ', 11, 5),
(76, 2, 'EL SOCORRO     ', 11, 5),
(77, 3, 'MASPARRITO', 11, 5),
(78, 1, 'EL CANTON     ', 12, 5),
(79, 3, 'PUERTO VIVAS ', 12, 5),
(80, 2, 'SANTA CRUZ DE GUACAS', 12, 5),
(81, 6, 'CACHAMAY     ', 1, 6),
(82, 4, 'CHIRICA     ', 1, 6),
(83, 5, 'DALLA COSTA     ', 1, 6),
(84, 2, 'ONCE DE ABRIL     ', 1, 6),
(85, 10, 'POZO VERDE     ', 1, 6),
(86, 1, 'SIMON BOLIVAR     ', 1, 6),
(87, 8, 'UNARE     ', 1, 6),
(88, 7, 'UNIVERSIDAD     ', 1, 6),
(89, 3, 'VISTA AL SOL     ', 1, 6),
(90, 9, 'YOCOIMA', 1, 6),
(91, 1, 'CAICARA DEL ORINOCO     ', 2, 6),
(92, 3, 'ALTAGRACIA     ', 2, 6),
(93, 2, 'ASCENSION FARRERAS     ', 2, 6),
(94, 5, 'GUANIAMO     ', 2, 6),
(95, 4, 'LA URBANA ', 2, 6),
(96, 6, 'PIJIGUAOS', 2, 6),
(97, 2, 'AGUA SALADA     ', 3, 6),
(98, 1, 'CATEDRAL     ', 3, 6),
(99, 6, 'JOSE ANTONIO PAEZ     ', 3, 6),
(100, 3, 'LA SABANITA     ', 3, 6),
(101, 5, 'MARHUANTA     ', 3, 6),
(102, 7, 'ORINOCO     ', 3, 6),
(103, 8, 'PANAPANA     ', 3, 6),
(104, 4, 'VISTA HERMOSA     ', 3, 6),
(105, 9, 'ZEA', 3, 6),
(106, 1, 'CIUDAD PIAR     ', 8, 6),
(107, 3, 'BARCELONETA     ', 8, 6),
(108, 2, 'SAN FRANCISCO ', 8, 6),
(109, 4, 'SANTA BARBARA', 8, 6),
(110, 1, 'EL CALLAO', 10, 6),
(111, 1, 'SANTA ELENA DE UAIREN     ', 9, 6),
(112, 2, 'IKABARU', 9, 6),
(113, 1, 'EL PALMAR', 11, 6),
(114, 1, 'UPATA     ', 4, 6),
(115, 2, 'ANDRES ELOY BLANCO ', 4, 6),
(116, 3, 'PEDRO COVA', 4, 6),
(117, 1, 'GUASIPATI', 5, 6),
(118, 2, 'SALOM', 5, 6),
(119, 1, 'TUMEREMO     ', 7, 6),
(120, 2, 'DALLA COSTA     ', 7, 6),
(121, 3, 'SAN ISIDRO', 7, 6),
(122, 1, 'MARIPA     ', 6, 6),
(123, 2, 'ARIPAO     ', 6, 6),
(124, 5, 'GUARATARO     ', 6, 6),
(125, 3, 'LAS MAJADAS     ', 6, 6),
(126, 4, 'MOITACO', 6, 6),
(127, 8, 'AGUEDO F ALVARADO     ', 2, 11),
(128, 9, 'BUENA VISTA ', 2, 11),
(129, 1, 'CATEDRAL     ', 2, 11),
(130, 5, 'EL CUJI     ', 2, 11),
(131, 7, 'JUAN DE VILLEGAS     ', 2, 11),
(132, 10, 'JUAREZ     ', 2, 11),
(133, 2, 'LA CONCEPCION     ', 2, 11),
(134, 3, 'SANTA ROSA     ', 2, 11),
(135, 6, 'TAMACA     ', 2, 11),
(136, 4, 'UNION', 2, 11),
(137, 1, 'PIO TAMAYO ', 8, 11),
(138, 3, 'QUEBRADA HONDA DE GUACHE     ', 8, 11),
(139, 2, 'YACAMBU', 8, 11),
(140, 1, 'FREITEZ     ', 1, 11),
(141, 2, 'JOSE MARIA BLANCO', 1, 11),
(142, 8, 'CORONEL MARIANO PERAZA     ', 3, 11),
(143, 4, 'CUARA     ', 3, 11),
(144, 2, 'DIEGO DE LOZADA     ', 3, 11),
(145, 7, 'JOSE BERNARDO DORANTE     ', 3, 11),
(146, 1, 'JUAN BAUTISTA RODRIGUEZ     ', 3, 11),
(147, 5, 'PARAISO DE SAN JOSE     ', 3, 11),
(148, 3, 'SAN MIGUEL ', 3, 11),
(149, 6, 'TINTORERO', 3, 11),
(150, 2, 'ANZOATEGUI     ', 4, 11),
(151, 1, 'BOLIVAR     ', 4, 11),
(152, 3, 'GUARICO     ', 4, 11),
(153, 7, 'HILARIO LUNA Y LUNA     ', 4, 11),
(154, 4, 'HUMOCARO ALTO     ', 4, 11),
(155, 5, 'HUMOCARO BAJO     ', 4, 11),
(156, 8, 'LA CANDELARIA     ', 4, 11),
(157, 6, 'MORAN', 4, 11),
(158, 3, 'AGUA VIVA     ', 5, 11),
(159, 1, 'CABUDARE     ', 5, 11),
(160, 2, 'JOSE GREGORIO BASTIDAS', 5, 11),
(161, 3, 'BURIA     ', 9, 11),
(162, 2, 'GUSTAVO VEGAS LEON     ', 9, 11),
(163, 1, 'SARARE', 9, 11),
(164, 17, 'ALTAGRACIA     ', 6, 11),
(165, 2, 'ANTONIO DIAZ     ', 6, 11),
(166, 3, 'CAMACARO     ', 6, 11),
(167, 4, 'CASTAÑEDA     ', 6, 11),
(168, 15, 'CECILIO ZUBILLAGA     ', 6, 11),
(169, 5, 'CHIQUINQUIRA     ', 6, 11),
(170, 11, 'EL BLANCO     ', 6, 11),
(171, 6, 'ESPINOZA LOS MONTEROS     ', 6, 11),
(172, 13, 'HERIBERTO ARROYO ', 6, 11),
(173, 7, 'LARA     ', 6, 11),
(174, 14, 'LAS MERCEDES     ', 6, 11),
(175, 8, 'MANUEL MORILLO     ', 6, 11),
(176, 12, 'MONTA A VERDE     ', 6, 11),
(177, 9, 'MONTES DE OCA     ', 6, 11),
(178, 16, 'REYES VARGAS     ', 6, 11),
(179, 10, 'TORRES     ', 6, 11),
(180, 1, 'TRINIDAD SAMUEL', 6, 11),
(181, 4, 'MOROTURO     ', 7, 11),
(182, 2, 'SAN MIGUEL     ', 7, 11),
(183, 1, 'SIQUISIQUE     ', 7, 11),
(184, 3, 'XAGUAS', 7, 11),
(185, 1, 'FERNANDO GIRON TOVAR ', 1, 22),
(186, 2, 'LUIS ALBERTO GOMEZ     ', 1, 22),
(187, 3, 'PARHUEÑA     ', 1, 22),
(188, 4, 'PLATANILLAL', 1, 22),
(189, 1, 'LA ESMERALDA     ', 7, 22),
(190, 2, 'HUACHAMACARE ', 7, 22),
(191, 3, 'MARAWAKA     ', 7, 22),
(192, 4, 'MAVACA     ', 7, 22),
(193, 5, 'SIERRA PARIMA', 7, 22),
(194, 1, 'SAN FERNANDO DE ATABAPO', 2, 22),
(195, 4, 'CANAME ', 2, 22),
(196, 2, 'UCATA     ', 2, 22),
(197, 3, 'YAPACANA', 2, 22),
(198, 1, 'ISLA DE RATON     ', 5, 22),
(199, 5, 'GUAYAPO     ', 5, 22),
(200, 4, 'MUNDUAPO     ', 5, 22),
(201, 2, 'SAMARIAPO     ', 5, 22),
(202, 3, 'SIPAPO', 5, 22),
(203, 1, 'SAN JUAN DE MANAPIARE     ', 6, 22),
(204, 2, 'ALTO VENTUARI     ', 6, 22),
(205, 4, 'BAJO VENTUARI     ', 6, 22),
(206, 3, 'MEDIO VENTUARI', 6, 22),
(207, 1, 'MAROA     ', 3, 22),
(208, 3, 'COMUNIDAD ', 3, 22),
(209, 2, 'VICTORINO', 3, 22),
(210, 1, 'SAN CARLOS DE RIO NEGRO     ', 4, 22),
(211, 3, 'CASIQUIARE     ', 4, 22),
(212, 4, 'COCUY ', 4, 22),
(213, 2, 'SOLANO', 4, 22),
(214, 3, 'BERGANTIN', 3, 2),
(215, 4, 'CAIGUA', 3, 2),
(216, 1, 'EL CARMEN', 3, 2),
(217, 5, 'EL PILAR', 3, 2),
(218, 6, 'NARICUAL', 3, 2),
(219, 2, 'SAN CRISTOBAL', 3, 2),
(220, 1, 'ANACO', 1, 2),
(221, 2, 'SAN JOAQUIN', 1, 2),
(222, 1, 'CM. ARAGUA DE BARCELONA', 2, 2),
(223, 2, 'CACHIPO', 2, 2),
(224, 1, 'CLARINES', 4, 2),
(225, 2, 'GUANAPE', 4, 2),
(226, 3, 'SABANA DE UCHIRE', 4, 2),
(227, 1, 'ONOTO', 5, 2),
(228, 2, 'SAN PABLO', 5, 2),
(229, 2, 'SANTA BARBARA', 18, 2),
(230, 1, 'VALLE GUANAPE', 18, 2),
(231, 1, 'CANTAURA ', 6, 2),
(232, 2, 'LIBERTADOR', 6, 2),
(233, 3, 'SANTA ROSA', 6, 2),
(234, 4, 'URICA', 6, 2),
(235, 1, 'SAN JOSE DE GUANIPA', 14, 2),
(236, 2, 'CHORRERON', 15, 2),
(237, 1, 'GUANTA', 15, 2),
(238, 1, 'CM. SOLEDAD', 7, 2),
(239, 2, 'MAMO', 7, 2),
(240, 2, 'EL MORRO', 17, 2),
(241, 1, 'LECHERIAS', 17, 2),
(242, 1, 'SAN MATEO', 8, 2),
(243, 2, 'EL CARITO', 8, 2),
(244, 3, 'SANTA INES', 8, 2),
(245, 1, 'EL CHAPARRO', 20, 2),
(246, 2, 'TOMAS ALFARO CALATRAVA', 20, 2),
(247, 1, 'PARIAGUAN', 9, 2),
(248, 2, 'ATAPIRIRE', 9, 2),
(249, 3, 'BOCA DEL PAO', 9, 2),
(250, 4, 'EL PAO', 9, 2),
(251, 1, 'MAPIRE', 10, 2),
(252, 2, 'PIAR', 10, 2),
(253, 4, 'SANTA CLARA', 10, 2),
(254, 3, 'SN DIEGO DE CABRUTICA', 10, 2),
(255, 5, 'UVERITO', 10, 2),
(256, 6, 'ZUATA', 10, 2),
(257, 1, 'PUERTO PIRITU', 11, 2),
(258, 2, 'SAN MIGUEL', 11, 2),
(259, 3, 'SUCRE', 11, 2),
(260, 1, 'PIRITU', 16, 2),
(261, 2, 'SAN FRANCISCO', 16, 2),
(262, 2, 'PUEBLO NUEVO', 19, 2),
(263, 1, 'SANTA ANA', 19, 2),
(264, 1, 'EL TIGRE', 12, 2),
(265, 2, 'BOCA DE CHAVEZ', 21, 2),
(266, 1, 'BOCA UCHIRE', 21, 2),
(267, 2, 'PUERTO LA CRUZ', 13, 2),
(268, 1, 'POZUELOS', 13, 2),
(269, 13, 'ANTONIO SPINETTI DINI', 8, 12),
(270, 1, 'ARIAS', 8, 12),
(271, 11, 'CARACCIOLO PARRA P', 8, 12),
(272, 7, 'DOMINGO PEÑA', 8, 12),
(273, 4, 'EL LLANO', 8, 12),
(274, 14, 'EL MORRO', 8, 12),
(275, 8, 'GONZALO PICON FEBRES', 8, 12),
(276, 6, 'JACINTO PLAZA', 8, 12),
(277, 5, 'JUAN RODRIGUEZ SUAREZ', 8, 12),
(278, 10, 'LASSO DE LA VEGA', 8, 12),
(279, 15, 'LOS NEVADOS', 8, 12),
(280, 12, 'MARIANO PICON SALAS', 8, 12),
(281, 3, 'MILLA', 8, 12),
(282, 9, 'OSUNA RODRIGUEZ', 8, 12),
(283, 2, 'SAGRARIO', 8, 12),
(284, 1, 'GABRIEL PICON G', 1, 12),
(285, 2, 'HECTOR AMABLE MORA', 1, 12),
(286, 3, 'JOSE NUCETE SARDI', 1, 12),
(287, 6, 'PRESIDENTE BETANCOURT', 1, 12),
(288, 7, 'PRESIDENTE PAEZ', 1, 12),
(289, 5, 'PTE. ROMULO GALLEGOS', 1, 12),
(290, 4, 'PULIDO MENDEZ', 1, 12),
(291, 1, 'LA AZULITA', 2, 12),
(292, 1, 'STA CRUZ DE MORA', 11, 12),
(293, 2, 'MESA BOLIVAR', 11, 12),
(294, 3, 'MESA DE LAS PALMAS', 11, 12),
(295, 1, 'ARICAGUA', 22, 12),
(296, 2, 'SAN ANTONIO', 22, 12),
(297, 1, 'CANAGUA', 3, 12),
(298, 2, 'CAPURI', 3, 12),
(299, 3, 'CHACANTA', 3, 12),
(300, 4, 'EL MOLINO', 3, 12),
(301, 5, 'GUAIMARAL', 3, 12),
(302, 7, 'MUCUCHACHI', 3, 12),
(303, 6, 'MUCUTUY', 3, 12),
(304, 1, 'ACEQUIAS', 4, 12),
(305, 7, 'FERNANDEZ PEÑA', 4, 12),
(306, 2, 'JAJI', 4, 12),
(307, 3, 'LA MESA', 4, 12),
(308, 6, 'MATRIZ', 4, 12),
(309, 5, 'MONTALBAN', 4, 12),
(310, 4, 'SAN JOSE', 4, 12),
(311, 1, 'TUCANI', 13, 12),
(312, 2, 'FLORENCIO RAMIREZ', 13, 12),
(313, 1, 'SANTO DOMINGO', 14, 12),
(314, 2, 'LAS PIEDRAS', 14, 12),
(315, 1, 'GUARAQUE', 5, 12),
(316, 2, 'MESA DE QUINTERO', 5, 12),
(317, 3, 'RIO NEGRO', 5, 12),
(318, 1, 'ARAPUEY', 6, 12),
(319, 2, 'PALMIRA', 6, 12),
(320, 1, 'TORONDOY', 7, 12),
(321, 2, 'SAN CRISTOBAL DE T', 7, 12),
(322, 1, 'CHACHOPO', 10, 12),
(323, 2, 'ANDRES ELOY BLANCO', 10, 12),
(324, 4, 'LA VENTA', 10, 12),
(325, 3, 'PIÑANGO', 10, 12),
(326, 1, 'STA ELENA DE ARENALES', 12, 12),
(327, 2, 'ELOY PAREDES', 12, 12),
(328, 3, 'PQ R DE ALCAZAR', 12, 12),
(329, 1, 'STA MARIA DE CAPARO', 21, 12),
(330, 1, 'PUEBLO LLANO', 15, 12),
(331, 1, 'MUCUCHIES', 16, 12),
(332, 4, 'CACUTE', 16, 12),
(333, 5, 'LA TOMA', 16, 12),
(334, 2, 'MUCURUBA', 16, 12),
(335, 3, 'SAN RAFAEL', 16, 12),
(336, 1, 'BAILADORES', 17, 12),
(337, 2, 'GERONIMO MALDONADO', 17, 12),
(338, 1, 'TABAY', 9, 12),
(339, 1, 'LAGUNILLAS', 18, 12),
(340, 2, 'CHIGUARA', 18, 12),
(341, 3, 'ESTANQUES', 18, 12),
(342, 6, 'LA TRAMPA', 18, 12),
(343, 5, 'PUEBLO NUEVO DEL SUR', 18, 12),
(344, 4, 'SAN JUAN', 18, 12),
(345, 3, 'EL AMPARO', 19, 12),
(346, 1, 'EL LLANO', 19, 12),
(347, 4, 'SAN FRANCISCO', 19, 12),
(348, 2, 'TOVAR', 19, 12),
(349, 1, 'NUEVA BOLIVIA', 20, 12),
(350, 2, 'INDEPENDENCIA', 20, 12),
(351, 3, 'MARIA C PALACIOS', 20, 12),
(352, 4, 'SANTA APOLONIA', 20, 12),
(353, 1, 'ZEA', 23, 12),
(354, 2, 'CAÑO EL TIGRE', 23, 12),
(355, 5, 'DR. FCO. ROMERO LOBO', 8, 18),
(356, 1, 'LA CONCORDIA', 8, 18),
(357, 2, 'PEDRO MARIA MORANTES', 8, 18),
(358, 4, 'SAN SEBASTIAN', 8, 18),
(359, 3, 'SN JUAN BAUTISTA', 8, 18),
(360, 1, 'CORDERO', 18, 18),
(361, 1, 'LAS MESAS', 23, 18),
(362, 1, 'COLON', 1, 18),
(363, 2, 'RIVAS BERTI', 1, 18),
(364, 3, 'SAN PEDRO DEL RIO', 1, 18),
(365, 1, 'SAN ANT DEL TACHIRA', 2, 18),
(366, 4, 'ISAIAS MEDINA ANGARIT', 2, 18),
(367, 3, 'JUAN VICENTE GOMEZ', 2, 18),
(368, 2, 'PALOTAL', 2, 18),
(369, 1, 'TARIBA', 4, 18),
(370, 3, 'AMENODORO RANGEL LAMU', 4, 18),
(371, 2, 'LA FLORIDA', 4, 18),
(372, 1, 'STA. ANA DEL TACHIRA', 10, 18),
(373, 1, 'SAN JOSE DE BOLIVAR', 24, 18),
(374, 1, 'SAN RAFAEL DEL PINAL', 19, 18),
(375, 3, 'ALBERTO ADRIANI', 19, 18),
(376, 2, 'SANTO DOMINGO', 19, 18),
(377, 1, 'LA FRIA', 11, 18),
(378, 2, 'BOCA DE GRITA', 11, 18),
(379, 3, 'JOSE ANTONIO PAEZ', 11, 18),
(380, 1, 'PALMIRA', 12, 18),
(381, 1, 'CAPACHO NUEVO', 3, 18),
(382, 2, 'JUAN GERMAN ROSCIO', 3, 18),
(383, 3, 'ROMAN CARDENAS', 3, 18),
(384, 1, 'LA GRITA', 5, 18),
(385, 2, 'EMILIO C. GUERRERO', 5, 18),
(386, 3, 'MONS. MIGUEL A SALAS', 5, 18),
(387, 1, 'EL COBRE', 25, 18),
(388, 1, 'RUBIO', 6, 18),
(389, 2, 'BRAMON', 6, 18),
(390, 3, 'LA PETROLEA', 6, 18),
(391, 4, 'QUINIMARI', 6, 18),
(392, 1, 'CAPACHO VIEJO', 20, 18),
(393, 2, 'CIPRIANO CASTRO', 20, 18),
(394, 3, 'MANUEL FELIPE RUGELES', 20, 18),
(395, 1, 'ABEJALES', 14, 18),
(396, 3, 'DORADAS', 14, 18),
(397, 4, 'EMETERIO OCHOA', 14, 18),
(398, 2, 'SAN JOAQUIN DE NAVAY', 14, 18),
(399, 1, 'LOBATERA', 7, 18),
(400, 2, 'CONSTITUCION', 7, 18),
(401, 1, 'MICHELENA', 13, 18),
(402, 1, 'COLONCITO', 15, 18),
(403, 2, 'LA PALMITA', 15, 18),
(404, 1, 'UREÑA', 16, 18),
(405, 2, 'NUEVA ARCADIA', 16, 18),
(406, 1, 'DELICIAS', 26, 18),
(407, 1, 'LA TENDIDA', 21, 18),
(408, 2, 'BOCONO', 21, 18),
(409, 3, 'HERNANDEZ', 21, 18),
(410, 1, 'UMUQUENA', 29, 18),
(411, 1, 'SEBORUCO', 22, 18),
(412, 1, 'SAN SIMON', 27, 18),
(413, 1, 'QUENIQUEA', 17, 18),
(414, 3, 'ELEAZAR LOPEZ CONTRERA', 17, 18),
(415, 2, 'SAN PABLO', 17, 18),
(416, 1, 'SAN JOSECITO', 28, 18),
(417, 1, 'PREGONERO', 9, 18),
(418, 2, 'CARDENAS', 9, 18),
(419, 4, 'JUAN PABLO PEÑALOZA', 9, 18),
(420, 3, 'POTOSI', 9, 18),
(421, 1, 'CARABALLEDA', 1, 24),
(422, 2, 'CARAYACA', 1, 24),
(423, 11, 'CARLOS SOUBLETTE', 1, 24),
(424, 3, 'CARUAO', 1, 24),
(425, 4, 'CATIA LA MAR', 1, 24),
(426, 9, 'EL JUNKO', 1, 24),
(427, 5, 'LA GUAIRA', 1, 24),
(428, 6, 'MACUTO', 1, 24),
(429, 7, 'MAIQUETIA', 1, 24),
(430, 8, 'NAIGUATA', 1, 24),
(431, 10, 'URIMARE', 1, 24),
(432, 1, '23 DE ENERO', 1, 1),
(433, 2, 'ALTAGRACIA', 1, 1),
(434, 3, 'ANTIMANO', 1, 1),
(435, 4, 'CANDELARIA', 1, 1),
(436, 5, 'CARICUAO', 1, 1),
(437, 6, 'CATEDRAL', 1, 1),
(438, 7, 'COCHE', 1, 1),
(439, 8, 'EL JUNQUITO', 1, 1),
(440, 9, 'EL PARAISO', 1, 1),
(441, 10, 'EL RECREO', 1, 1),
(442, 11, 'EL VALLE', 1, 1),
(443, 12, 'LA PASTORA', 1, 1),
(444, 13, 'LA VEGA', 1, 1),
(445, 14, 'MACARAO', 1, 1),
(446, 15, 'SAN AGUSTIN', 1, 1),
(447, 16, 'SAN BERNARDINO', 1, 1),
(448, 17, 'SAN JOSE', 1, 1),
(449, 18, 'SAN JUAN', 1, 1),
(450, 19, 'SAN PEDRO', 1, 1),
(451, 20, 'SANTA ROSALIA', 1, 1),
(452, 21, 'SANTA TERESA', 1, 1),
(453, 22, 'SUCRE', 1, 1),
(454, 1, 'BEJUMA', 1, 7),
(455, 2, 'CANOABO', 1, 7),
(456, 3, 'SIMON BOLIVAR', 1, 7),
(457, 1, 'GUIGUE', 2, 7),
(458, 2, 'BELEN', 2, 7),
(459, 3, 'TACARIGUA', 2, 7),
(460, 1, 'MARIARA', 3, 7),
(461, 2, 'AGUAS CALIENTES ', 3, 7),
(462, 1, 'GUACARA', 4, 7),
(463, 2, 'CIUDAD ALIANZA', 4, 7),
(464, 3, 'YAGUA', 4, 7),
(465, 1, 'MONTALBAN', 5, 7),
(466, 1, 'MORON', 6, 7),
(467, 2, 'URAMA', 6, 7),
(468, 1, 'DEMOCRACIA', 7, 7),
(469, 2, 'FRATERNIDAD', 7, 7),
(470, 3, 'GOAIGOAZA', 7, 7),
(471, 4, 'JUAN JOSE FLORES', 7, 7),
(472, 5, 'BARTOLOME SALOM', 7, 7),
(473, 6, 'UNION', 7, 7),
(474, 7, 'BORBURATA', 7, 7),
(475, 8, 'PATANEMO', 7, 7),
(476, 1, 'SAN JOAQUIN', 8, 7),
(477, 1, 'CANDELARIA', 9, 7),
(478, 2, 'CATEDRAL', 9, 7),
(479, 3, 'EL SOCORRO', 9, 7),
(480, 4, 'MIGUEL PEÑA', 9, 7),
(481, 5, 'SAN BLAS', 9, 7),
(482, 6, 'SAN JOSE', 9, 7),
(483, 7, 'SANTA ROSA', 9, 7),
(484, 8, 'RAFAEL URDANETA', 9, 7),
(485, 9, 'NEGRO PRIMERO', 9, 7),
(486, 1, 'MIRANDA', 10, 7),
(487, 1, 'LOS GUAYOS', 11, 7),
(488, 1, 'NAGUANAGUA', 12, 7),
(489, 1, 'URB SAN DIEGO', 13, 7),
(490, 1, 'TOCUYITO', 14, 7),
(491, 2, 'INDEPENDENCIA', 14, 7),
(492, 1, 'COJEDES', 1, 8),
(493, 2, 'JUAN DE MATA SUAREZ', 1, 8),
(494, 1, 'TINAQUILLO', 2, 8),
(495, 1, 'EL BAUL', 3, 8),
(496, 2, 'SUCRE', 3, 8),
(497, 1, 'EL PAO', 4, 8),
(498, 1, 'LIBERTAD DE COJEDES', 5, 8),
(499, 2, 'EL AMPARO', 5, 8),
(500, 1, 'SAN CARLOS DE AUSTRIA', 6, 8),
(501, 2, 'JUAN ANGEL BRAVO', 6, 8),
(502, 3, 'MANUEL MANRIQUE', 6, 8),
(503, 1, 'GRL JEFE JOSE L SILVA', 7, 8),
(504, 1, 'MACAPO', 8, 8),
(505, 2, 'LA AGUADITA', 8, 8),
(506, 1, 'ROMULO GALLEGOS', 9, 8),
(507, 1, 'SAN JUAN DE LOS CAYOS', 1, 9),
(508, 2, 'CAPADARE', 1, 9),
(509, 3, 'LA PASTORA', 1, 9),
(510, 4, 'LIBERTADOR', 1, 9),
(511, 1, 'SAN LUIS', 2, 9),
(512, 2, 'ARACUA', 2, 9),
(513, 3, 'LA PEÑA', 2, 9),
(514, 1, 'CAPATARIDA', 3, 9),
(515, 2, 'BOROJO', 3, 9),
(516, 3, 'SEQUE', 3, 9),
(517, 4, 'ZAZARIDA', 3, 9),
(518, 5, 'BARIRO', 3, 9),
(519, 6, 'GUAJIRO', 3, 9),
(520, 1, 'NORTE', 4, 9),
(521, 2, 'CARIRUBANA', 4, 9),
(522, 3, 'PUNTA CARDON', 4, 9),
(523, 4, 'SANTA ANA', 4, 9),
(524, 1, 'LA VELA DE CORO', 5, 9),
(525, 2, 'ACURIGUA', 5, 9),
(526, 3, 'GUAIBACOA', 5, 9),
(527, 4, 'MACORUCA', 5, 9),
(528, 5, 'LAS CALDERAS', 5, 9),
(529, 1, 'PEDREGAL', 6, 9),
(530, 2, 'AGUA CLARA', 6, 9),
(531, 3, 'AVARIA', 6, 9),
(532, 4, 'PIEDRA GRANDE', 6, 9),
(533, 5, 'PURURECHE', 6, 9),
(534, 1, 'PUEBLO NUEVO', 7, 9),
(535, 2, 'ADICORA', 7, 9),
(536, 3, 'BARAIVED', 7, 9),
(537, 4, 'BUENA VISTA', 7, 9),
(538, 5, 'JADACAQUIVA', 7, 9),
(539, 6, 'MORUY', 7, 9),
(540, 7, 'EL VINCULO ', 7, 9),
(541, 8, 'EL HATO', 7, 9),
(542, 9, 'ADAURE', 7, 9),
(543, 1, 'CHURUGUARA', 8, 9),
(544, 2, 'AGUA LARGA', 8, 9),
(545, 3, 'INDEPENDENCIA', 8, 9),
(546, 4, 'MAPARARI', 8, 9),
(547, 5, 'EL PAUJI', 8, 9),
(548, 1, 'MENE DE MAUROA', 9, 9),
(549, 2, 'CASIGUA', 9, 9),
(550, 3, 'SAN FELIX', 9, 9),
(551, 1, 'SAN ANTONIO', 10, 9),
(552, 2, 'SAN GABRIEL', 10, 9),
(553, 3, 'SANTA ANA', 10, 9),
(554, 4, 'GUZMAN GUILLERMO', 10, 9),
(555, 5, 'MITARE', 10, 9),
(556, 6, 'SABANETA', 10, 9),
(557, 7, 'RIO SECO', 10, 9),
(558, 1, 'CABURE', 11, 9),
(559, 2, 'CURIMAGUA', 11, 9),
(560, 3, 'COLINA', 11, 9),
(561, 1, 'TUCACAS', 12, 9),
(562, 2, 'BOCA DE AROA', 12, 9),
(563, 1, 'PUERTO CUMAREBO', 13, 9),
(564, 2, 'LA CIENAGA', 13, 9),
(565, 3, 'LA SOLEDAD', 13, 9),
(566, 4, 'PUEBLO CUMAREBO', 13, 9),
(567, 5, 'ZAZARIDA', 13, 9),
(568, 1, 'DABAJURO', 14, 9),
(569, 1, 'CHICHIRIVICHE', 15, 9),
(570, 2, 'BOCA DE TOCUYO ', 15, 9),
(571, 3, 'TOCUYO DE LA COSTA', 15, 9),
(572, 1, 'LOS TAQUES', 16, 9),
(573, 2, 'JUDIBANA ', 16, 9),
(574, 1, 'PIRITU', 17, 9),
(575, 2, 'SAN JOSE DE LA COSTA', 17, 9),
(576, 1, 'STA.CRUZ DE BUCARAL', 18, 9),
(577, 2, 'EL CHARAL', 18, 9),
(578, 3, 'LAS VEGAS DEL TUY', 18, 9),
(579, 1, 'MIRIMIRE', 19, 9),
(580, 1, 'JACURA', 20, 9),
(581, 2, 'AGUA LINDA', 20, 9),
(582, 3, 'ARAURIMA', 20, 9),
(583, 1, 'YARACAL', 21, 9),
(584, 1, 'PALMA SOLA', 22, 9),
(585, 1, 'SUCRE', 23, 9),
(586, 2, 'PECAYA', 23, 9),
(587, 1, 'URUMACO', 24, 9),
(588, 2, 'BRUZUAL', 24, 9),
(589, 1, 'TOCOPERO', 25, 9),
(590, 1, 'VALLE DE LA PASCUA', 1, 10),
(591, 2, 'ESPINO', 1, 10),
(592, 1, 'EL SOMBRERO', 2, 10),
(593, 2, 'SOSA', 2, 10),
(594, 1, 'CALABOZO', 3, 10),
(595, 2, 'EL CALVARIO', 3, 10),
(596, 3, 'EL RASTRO', 3, 10),
(597, 4, 'GUARDATINAJAS', 3, 10),
(598, 1, 'ALTAGRACIA DE ORITUCO', 4, 10),
(599, 2, 'LEZAMA', 4, 10),
(600, 3, 'LIBERTAD DE ORITUCO', 4, 10),
(601, 4, 'SAN FCO DE MACAIRA', 4, 10),
(602, 5, 'SAN RAFAEL DE ORITUCO', 4, 10),
(603, 6, 'SOUBLETTE', 4, 10),
(604, 7, 'PASO REAL DE MACAIRA', 4, 10),
(605, 1, 'TUCUPIDO', 5, 10),
(606, 2, 'SAN RAFAEL DE LAYA', 5, 10),
(607, 1, 'SAN JUAN DE LOS MORROS', 6, 10),
(608, 2, 'PARAPARA', 6, 10),
(609, 3, 'CANTAGALLO', 6, 10),
(610, 1, 'ZARAZA', 7, 10),
(611, 2, 'SAN JOSE DE UNARE', 7, 10),
(612, 1, 'CAMAGUAN', 8, 10),
(613, 2, 'PUERTO MIRANDA', 8, 10),
(614, 3, 'UVERITO', 8, 10),
(615, 1, 'SAN JOSE DE GUARIBE', 9, 10),
(616, 1, 'LAS MERCEDES', 10, 10),
(617, 2, 'STA RITA DE MANAPIRE', 10, 10),
(618, 3, 'CABRUTA', 10, 10),
(619, 1, 'EL SOCORRO', 11, 10),
(620, 1, 'ORTIZ', 12, 10),
(621, 2, 'SAN FCO. DE TIZNADOS', 12, 10),
(622, 3, 'SAN JOSE DE TIZNADOS', 12, 10),
(623, 4, 'S LORENZO DE TIZNADOS', 12, 10),
(624, 1, 'SANTA MARIA DE IPIRE', 13, 10),
(625, 2, 'ALTAMIRA', 13, 10),
(626, 1, 'CHAGUARAMAS', 14, 10),
(627, 1, 'GUAYABAL', 15, 10),
(628, 2, 'CAZORLA', 15, 10),
(629, 1, 'SAN JOSE', 1, 23),
(630, 2, 'VIRGEN DEL VALLE', 1, 23),
(631, 3, 'SAN RAFAEL', 1, 23),
(632, 4, 'JOSE VIDAL MARCANO', 1, 23),
(633, 5, 'LEONARDO RUIZ PINEDA', 1, 23),
(634, 6, 'MONS ARGIMIRO GARCIA', 1, 23),
(635, 7, 'MCL ANTONIO J DE SUCRE', 1, 23),
(636, 8, 'JUAN MILLAN', 1, 23),
(637, 1, 'PEDERNALES', 2, 23),
(638, 1, 'LUIS B PRIETO FIGUERO', 2, 23),
(639, 1, 'CURIAPO', 3, 23),
(640, 2, 'SANTOS DE ABELGAS', 3, 23),
(641, 3, 'MANUEL RENAUD', 3, 23),
(642, 4, 'PADRE BARRAL', 3, 23),
(643, 5, 'ANICETO LUGO', 3, 23),
(644, 6, 'ALMIRANTE LUIS BRION', 3, 23),
(645, 1, 'IMATACA', 4, 23),
(646, 2, 'ROMULO GALLEGOS', 4, 23),
(647, 3, 'JUAN BAUTISTA ARISMEN', 4, 23),
(648, 4, 'MANUEL PIAR', 4, 23),
(649, 5, '5 DE JULIO', 4, 23),
(650, 6, 'ANDRES LINARES', 5, 19),
(651, 2, 'CHIQUINQUIRA', 5, 19),
(652, 1, 'CRISTOBAL MENDOZA', 5, 19),
(653, 5, 'CRUZ CARRILLO', 5, 19),
(654, 3, 'MATRIZ', 5, 19),
(655, 4, 'MONSEÑOR CARRILLO', 5, 19),
(656, 7, 'TRES ESQUINAS', 5, 19),
(657, 2, 'ARAGUANEY', 15, 19),
(658, 3, 'EL JAGUITO', 15, 19),
(659, 4, 'LA ESPERANZA', 15, 19),
(660, 1, 'SANTA ISABEL', 15, 19),
(661, 4, 'AYACUCHO', 2, 19),
(662, 1, 'BOCONO', 2, 19),
(663, 5, 'BURBUSAY', 2, 19),
(664, 2, 'EL CARMEN', 2, 19),
(665, 6, 'GENERAL RIVAS', 2, 19),
(666, 11, 'GUARAMACAL', 2, 19),
(667, 12, 'LA VEGA DE GUARAMACAL', 2, 19),
(668, 7, 'MONSEÑOR JAUREGUI', 2, 19),
(669, 3, 'MOSQUEY', 2, 19),
(670, 8, 'RAFAEL RANGEL', 2, 19),
(671, 9, 'SAN JOSE', 2, 19),
(672, 10, 'SAN MIGUEL', 2, 19),
(673, 2, 'CHEREGUE', 16, 19),
(674, 3, 'GRANADOS', 16, 19),
(675, 1, 'SABANA GRANDE', 16, 19),
(676, 7, 'ARNOLDO GABALDON', 8, 19),
(677, 4, 'BOLIVIA', 8, 19),
(678, 2, 'CARRILLO', 8, 19),
(679, 3, 'CEGARRA', 8, 19),
(680, 1, 'CHEJENDE', 8, 19),
(681, 5, 'MANUEL SALVADOR ULLOA', 8, 19),
(682, 6, 'SAN JOSE', 8, 19),
(683, 1, 'CARACHE', 3, 19),
(684, 3, 'CUICAS', 3, 19),
(685, 2, 'LA CONCEPCION', 3, 19),
(686, 4, 'PANAMERICANA', 3, 19),
(687, 5, 'SANTA CRUZ', 3, 19),
(688, 1, 'ESCUQUE', 4, 19),
(689, 3, 'LA UNION', 4, 19),
(690, 2, 'SABANA LIBRE', 4, 19),
(691, 4, 'SANTA RITA', 4, 19),
(692, 3, 'ANTONIO JOSE DE SUCRE', 17, 19),
(693, 1, 'EL SOCORRO', 17, 19),
(694, 2, 'LOS CAPRICHOS', 17, 19),
(695, 2, 'ARNOLDO GABALDON', 18, 19),
(696, 1, 'CAMPO ELIAS', 18, 19),
(697, 3, 'EL PROGRESO', 19, 19),
(698, 2, 'LA CEIBA', 19, 19),
(699, 1, 'SANTA APOLONIA', 19, 19),
(700, 4, 'TRES DE FEBRERO', 19, 19),
(701, 2, 'AGUA CALIENTE', 9, 19),
(702, 4, 'AGUA SANTA', 9, 19),
(703, 3, 'EL CENIZO', 9, 19),
(704, 1, 'EL DIVIDIVE', 9, 19),
(705, 5, 'VALERITA', 9, 19),
(706, 2, 'BUENA VISTA', 10, 19),
(707, 1, 'MONTE CARMELO', 10, 19),
(708, 3, 'STA MARIA DEL HORCON', 10, 19),
(709, 2, 'EL BAÑO', 11, 19),
(710, 3, 'JALISCO', 11, 19),
(711, 1, 'MOTATAN', 11, 19),
(712, 4, 'FLOR DE PATRIA', 12, 19),
(713, 3, 'LA PAZ', 12, 19),
(714, 1, 'PAMPAN', 12, 19),
(715, 2, 'SANTA ANA', 12, 19),
(716, 3, 'LA CONCEPCION', 20, 19),
(717, 1, 'PAMPANITO', 20, 19),
(718, 2, 'PAMPANITO II', 20, 19),
(719, 1, 'BETIJOQUE', 1, 19),
(720, 4, 'EL CEDRO', 1, 19),
(721, 2, 'JOSE G HERNANDEZ', 1, 19),
(722, 3, 'LA PUEBLITA', 1, 19),
(723, 2, 'ANTONIO N BRICEÑO', 13, 19),
(724, 3, 'CAMPO ALEGRE', 13, 19),
(725, 1, 'CARVAJAL', 13, 19),
(726, 4, 'JOSE LEONARDO SUAREZ', 13, 19),
(727, 4, 'EL PARAISO', 14, 19),
(728, 2, 'JUNIN', 14, 19),
(729, 1, 'SABANA DE MENDOZA', 14, 19),
(730, 3, 'VALMORE RODRIGUEZ', 14, 19),
(731, 5, 'CABIMBU', 6, 19),
(732, 2, 'JAJO', 6, 19),
(733, 3, 'LA MESA', 6, 19),
(734, 1, 'LA QUEBRADA', 6, 19),
(735, 4, 'SANTIAGO', 6, 19),
(736, 6, 'TUÑAME', 6, 19),
(737, 2, 'JUAN IGNACIO MONTILLA', 7, 19),
(738, 3, 'LA BEATRIZ', 7, 19),
(739, 5, 'LA PUERTA', 7, 19),
(740, 4, 'MENDOZA', 7, 19),
(741, 1, 'MERCEDES DIAZ', 7, 19),
(742, 6, 'SAN LUIS', 7, 19),
(743, 1, 'AROA', 1, 20),
(744, 1, 'CHIVACOA', 2, 20),
(745, 2, 'CAMPO ELIAS', 2, 20),
(746, 1, 'NIRGUA', 3, 20),
(747, 2, 'SALOM', 3, 20),
(748, 3, 'TEMERLA', 3, 20),
(749, 1, 'SAN FELIPE', 4, 20),
(750, 2, 'ALBARICO', 4, 20),
(751, 3, 'SAN JAVIER', 4, 20),
(752, 1, 'GUAMA', 5, 20),
(753, 1, 'URACHICHE', 6, 20),
(754, 1, 'YARITAGUA', 7, 20),
(755, 2, 'SAN ANDRES', 7, 20),
(756, 1, 'SABANA DE PARRA', 8, 20),
(757, 1, 'BORAURE', 9, 20),
(758, 1, 'COCOROTE', 10, 20),
(759, 1, 'INDEPENDENCIA', 11, 20),
(760, 1, 'SAN PABLO', 12, 20),
(761, 1, 'YUMARE', 13, 20),
(762, 1, 'FARRIAR', 14, 20),
(763, 2, 'EL GUAYABO', 14, 20),
(764, 1, 'GENERAL URDANETA', 1, 21),
(765, 2, 'LIBERTADOR', 1, 21),
(766, 3, 'MANUEL GUANIPA MATOS', 1, 21),
(767, 4, 'MARCELINO BRICEÑO', 1, 21),
(768, 5, 'SAN TIMOTEO', 1, 21),
(769, 6, 'PUEBLO NUEVO', 1, 21),
(770, 1, 'PEDRO LUCAS URRIBARRI', 2, 21),
(771, 2, 'SANTA RITA', 2, 21),
(772, 3, 'JOSE CENOVIO URRIBARRI', 2, 21),
(773, 4, 'EL MENE', 2, 21),
(774, 1, 'SANTA CRUZ DEL ZULIA', 3, 21),
(775, 2, 'URRIBARRI', 3, 21),
(776, 3, 'MORALITO', 3, 21),
(777, 4, 'SAN CARLOS DEL ZULIA', 3, 21),
(778, 5, 'SANTA BARBARA', 3, 21),
(779, 1, 'LUIS DE VICENTE', 4, 21),
(780, 2, 'RICAURTE', 4, 21),
(781, 3, 'MONSEÑOR MARCOS SERGIO GODOY', 4, 21),
(782, 4, 'SAN RAFAEL', 4, 21),
(783, 5, 'LAS PARCELAS', 4, 21),
(784, 6, 'TAMARE', 4, 21),
(785, 7, 'LA SIERRITA', 4, 21),
(786, 1, 'BOLIVAR', 5, 21),
(787, 2, 'COQUIVACOA', 5, 21),
(788, 3, 'CRISTO DE ARANZA', 5, 21),
(789, 4, 'CHIQUINQUIRA', 5, 21),
(790, 5, 'SANTA LUCIA', 5, 21),
(791, 6, 'OLEGARIO VILLALOBOS', 5, 21),
(792, 7, 'JUANA DE AVILA', 5, 21),
(793, 8, 'CARACCIOLO PARRA PEREZ', 5, 21),
(794, 9, 'IDELFONZO VASQUEZ', 5, 21),
(795, 10, 'CACIQUE MARA', 5, 21),
(796, 11, 'CECILIO ACOSTA', 5, 21),
(797, 12, 'RAUL LEONI', 5, 21),
(798, 13, 'FRANCISCO EUGENIO', 5, 21),
(799, 14, 'MANUEL DAGNINO', 5, 21),
(800, 15, 'LUIS HURTADO HIGERA', 5, 21),
(801, 16, 'VENANCIO PULGAR', 5, 21),
(802, 17, 'ANTONIO BORJAS ROMERO', 5, 21),
(803, 18, 'SAN ISIDRO', 5, 21),
(804, 1, 'FARIA', 6, 21),
(805, 2, 'SAN ANTONIO', 6, 21),
(806, 3, 'ANA MARIA CAMPOS', 6, 21),
(807, 4, 'SAN JOSE', 6, 21),
(808, 5, 'ALTA GRACIA', 6, 21),
(809, 1, 'GUAJIRA', 7, 21),
(810, 2, 'ELIAS SANCHEZ RUBIO', 7, 21),
(811, 3, 'SINAMAICA', 7, 21),
(812, 4, 'ALTA GUAJIRA', 7, 21),
(813, 1, 'SAN JOSE DE PERIJA', 8, 21),
(814, 2, 'BARTOLOME DE LAS CASAS', 8, 21),
(815, 3, 'LIBERTAD', 8, 21),
(816, 4, 'RIO NEGRO', 8, 21),
(817, 1, 'GIBRALTAR', 9, 21),
(818, 2, 'HERAS', 9, 21),
(819, 3, 'MONSEÑOR ARTURO CELESTINO ALVAREZ', 9, 21),
(820, 4, 'ROMULO GALLEGOS', 9, 21),
(821, 5, 'BOBURES', 9, 21),
(822, 6, 'EL BATEY', 9, 21),
(823, 1, 'ANDRES BELLO', 10, 21),
(824, 2, 'POTRERITOS', 10, 21),
(825, 3, 'EL CARMELO', 10, 21),
(826, 4, 'CHIQUINQUIRA', 10, 21),
(827, 5, 'CONCEPCION', 10, 21),
(828, 1, 'ELEAZAR LOPEZ CONTRERAS', 11, 21),
(829, 2, 'ALONSO DE OJEDA', 11, 21),
(830, 3, 'VENEZUELA', 11, 21),
(831, 4, 'CAMPO LARA', 11, 21),
(832, 5, 'LIBERTAD', 11, 21),
(833, 1, 'UDON PEREZ', 12, 21),
(834, 2, 'ENCONTRADOS', 12, 21),
(835, 1, 'DONALDO GARCIA', 13, 21),
(836, 2, 'SIXTO ZAMBRANO', 13, 21),
(837, 3, 'EL ROSARIO', 13, 21),
(838, 1, 'AMBROSIO', 14, 21),
(839, 2, 'GERMAN RIOS LINARES', 14, 21),
(840, 3, 'JORGE HERNANDEZ', 14, 21),
(841, 4, 'LA ROSA', 14, 21),
(842, 5, 'PUNTA GORDA', 14, 21),
(843, 6, 'CARMEN HERRERA', 14, 21),
(844, 7, 'SAN BENITO', 14, 21),
(845, 8, 'ROMULO BETANCOURT', 14, 21),
(846, 9, 'ARISTIDES CALVANI', 14, 21),
(847, 1, 'RAUL CUENCA', 15, 21),
(848, 2, 'LA VICTORIA', 15, 21),
(849, 3, 'RAFAEL URDANETA', 15, 21),
(850, 1, 'JOSE RAMON YEPEZ', 16, 21),
(851, 2, 'LA CONCEPCION', 16, 21),
(852, 3, 'SAN JOSE', 16, 21),
(853, 4, 'MARIANO PARRA LEON', 16, 21),
(854, 1, 'MONAGAS', 17, 21),
(855, 2, 'ISLA DE TOAS', 17, 21),
(856, 1, 'MARCIAL HERNANDEZ', 18, 21),
(857, 2, 'FRANCISCO OCHOA', 18, 21),
(858, 3, 'SAN FRANCISCO', 18, 21),
(859, 4, 'EL BAJO', 18, 21),
(860, 5, 'DOMITILA FLORES', 18, 21),
(861, 6, 'LOS CORTIJOS', 18, 21),
(862, 1, 'BARI', 19, 21),
(863, 2, 'JESUS MARIA SEMPRUN', 19, 21),
(864, 1, 'SIMON RODRIGUEZ', 20, 21),
(865, 2, 'CARLOS QUEVEDO', 20, 21),
(866, 3, 'FRANCISCO JAVIER PULGAR', 20, 21),
(867, 1, 'RAFAEL MARIA BARALT', 21, 21),
(868, 2, 'MANUEL MANRIQUE', 21, 21),
(869, 3, 'RAFAEL URDANETA', 21, 21),
(870, 2, 'ARAGUITA     ', 1, 13),
(871, 3, 'AREVALO GONZALEZ     ', 1, 13),
(872, 4, 'CAPAYA     ', 1, 13),
(873, 1, 'CAUCAGUA     ', 1, 13),
(874, 7, 'EL CAFE     ', 1, 13),
(875, 8, 'MARIZAPA     ', 1, 13),
(876, 5, 'PANAQUIRE     ', 1, 13),
(877, 6, 'RIBAS', 1, 13),
(878, 2, 'CURIEPE     ', 2, 13),
(879, 1, 'HIGUEROTE     ', 2, 13),
(880, 3, 'TACARIGUA', 2, 13),
(881, 7, 'ALTAGRACIA DE LA M     ', 3, 13),
(882, 2, 'CECILIO ACOSTA     ', 3, 13),
(883, 6, 'EL JARILLO     ', 3, 13),
(884, 1, 'LOS TEQUES     ', 3, 13),
(885, 3, 'PARACOTOS     ', 3, 13),
(886, 4, 'SAN PEDRO     ', 3, 13),
(887, 5, 'TACATA', 3, 13),
(888, 2, 'EL CARTANAL ', 4, 13),
(889, 1, 'STA TERESA DEL TUY', 4, 13),
(890, 2, 'LA DEMOCRACIA     ', 5, 13),
(891, 1, 'OCUMARE DEL TUY     ', 5, 13),
(892, 3, 'SANTA BARBARA', 5, 13),
(893, 2, 'EL GUAPO     ', 6, 13),
(894, 4, 'PAPARO     ', 6, 13),
(895, 1, 'RIO CHICO     ', 6, 13),
(896, 5, 'SAN FERNANDO DEL GUAPO     ', 6, 13),
(897, 3, 'TACARIGUA DE LA LAGUNA', 6, 13),
(898, 1, 'SANTA LUCIA', 7, 13),
(899, 1, 'GUARENAS', 8, 13),
(900, 3, 'CAUCAGUITA     ', 9, 13),
(901, 4, 'FILAS DE MARICHES     ', 9, 13),
(902, 5, 'LA DOLORITA     ', 9, 13),
(903, 2, 'LEONCIO MARTINEZ     ', 9, 13),
(904, 1, 'CUA     ', 10, 13),
(905, 2, 'NUEVA CUA', 10, 13),
(906, 2, 'BOLIVAR     ', 11, 13),
(907, 1, 'GUATIRE', 11, 13),
(908, 1, 'CHARALLAVE     ', 12, 13),
(909, 2, 'LAS BRISAS', 12, 13),
(910, 1, 'SAN ANTONIO DE LOS ALTOS', 13, 13),
(911, 2, 'CUMBO     ', 14, 13),
(912, 1, 'SAN JOSE DE BARLOVENTO', 14, 13),
(913, 1, 'SAN FCO DE YARE     ', 15, 13),
(914, 2, 'SAN ANTONIO DE YARE', 15, 13),
(915, 1, 'BARUTA     ', 16, 13),
(916, 2, 'EL CAFETAL     ', 16, 13),
(917, 3, 'LAS MINAS DE BARUTA', 16, 13),
(918, 1, 'CARRIZAL', 17, 13),
(919, 1, 'CHACAO', 18, 13),
(920, 1, 'EL HATILLO', 19, 13),
(921, 1, 'MAMPORAL', 20, 13),
(922, 1, 'CUPIRA     ', 21, 13),
(923, 2, 'MACHURUCUTO', 21, 13),
(924, 1, 'GUARENAS', 21, 13),
(925, 6, 'ALTO DE LOS GODOS     ', 7, 14),
(926, 7, 'BOQUERON     ', 7, 14),
(927, 3, 'EL COROZO     ', 7, 14),
(928, 1, 'EL FURRIAL     ', 7, 14),
(929, 2, 'JUSEPIN     ', 7, 14),
(930, 5, 'LA PICA     ', 7, 14),
(931, 8, 'LAS COCUIZAS     ', 7, 14),
(932, 10, 'SAN SIMON     ', 7, 14),
(933, 9, 'SANTA CRUZ     ', 7, 14),
(934, 4, 'SAN VICENTE', 7, 14),
(935, 1, 'SAN ANTONIO     ', 1, 14),
(936, 2, 'SAN FRANCISCO', 1, 14),
(937, 1, 'AGUASAY', 11, 14),
(938, 2, 'CARIPITO', 11, 14),
(939, 1, 'CARIPE     ', 3, 14),
(940, 3, 'EL GUACHARO     ', 3, 14),
(941, 5, 'LA GUANOTA     ', 3, 14),
(942, 6, 'SABANA DE PIEDRA     ', 3, 14),
(943, 4, 'SAN AGUSTIN     ', 3, 14),
(944, 2, 'TERESEN', 3, 14),
(945, 1, 'CAICARA     ', 4, 14),
(946, 2, 'AREO     ', 4, 14),
(947, 3, 'SAN FELIX     ', 4, 14),
(948, 4, 'VIENTO FRESCO', 4, 14),
(949, 1, 'PUNTA DE MATA     ', 5, 14),
(950, 2, 'EL TEJERO', 5, 14),
(951, 1, 'TEMBLADOR     ', 6, 14),
(952, 4, 'CHAGUARAMAS     ', 6, 14),
(953, 3, 'LAS ALHUACAS ', 6, 14),
(954, 2, 'TABASCA', 6, 14),
(955, 1, 'ARAGUA     ', 8, 14),
(956, 4, 'APARICIO     ', 8, 14),
(957, 2, 'CHAGUARAMAL     ', 8, 14),
(958, 6, 'EL PINTO     ', 8, 14),
(959, 3, 'GUANAGUANA     ', 8, 14),
(960, 7, 'LA TOSCANA     ', 8, 14),
(961, 5, 'TAGUAYA', 8, 14),
(962, 1, 'QUIRIQUIRE     ', 9, 14),
(963, 2, 'CACHIPO', 9, 14),
(964, 1, 'SANTA BARBARA', 12, 14),
(965, 1, 'BARRANCAS     ', 10, 14),
(966, 2, 'LOS BARRANCOS DE FAJARDO', 10, 14),
(967, 1, 'URACOA', 13, 14),
(968, 1, 'LA ASUNCION', 1, 15),
(969, 1, 'LA PLAZA DE PARAGUACHI', 10, 15),
(970, 1, 'SAN JUAN BAUTISTA     ', 2, 15),
(971, 2, 'ZABALA', 2, 15),
(972, 1, 'VALLE ESP SANTO     ', 11, 15),
(973, 2, 'FRANCISCO FAJARDO', 11, 15),
(974, 1, 'SANTA ANA     ', 3, 15),
(975, 4, 'BOLIVAR     ', 3, 15),
(976, 2, 'GUEVARA     ', 3, 15),
(977, 3, 'MATASIETE     ', 3, 15),
(978, 5, 'SUCRE', 3, 15),
(979, 1, 'PAMPATAR     ', 4, 15),
(980, 2, 'AGUIRRE', 4, 15),
(981, 1, 'JUAN GRIEGO', 5, 15),
(982, 2, 'ADRIAN', 5, 15),
(983, 1, 'PORLAMAR', 6, 15),
(984, 1, 'BOCA DEL RIO', 7, 15),
(985, 2, 'SAN FRANCISCO', 7, 15),
(986, 1, 'PUNTA DE PIEDRAS     ', 9, 15),
(987, 2, 'LOS BARALES', 9, 15),
(988, 1, 'SAN PEDRO DE COCHE     ', 8, 15),
(989, 2, 'VICENTE FUENTES', 8, 15),
(990, 1, 'GUANARE     ', 3, 16),
(991, 2, 'CORDOBA     ', 3, 16),
(992, 5, 'SAN JOSE DE LA MONTAÑA     ', 3, 16),
(993, 3, 'SAN JUAN GUANAGUANARE     ', 3, 16),
(994, 4, 'VIRGEN DE LA COROMOTO', 3, 16),
(995, 1, 'AGUA BLANCA', 10, 16),
(996, 1, 'ARAURE     ', 1, 16),
(997, 2, 'RIO ACARIGUA', 1, 16),
(998, 1, 'PIRITU     ', 2, 16),
(999, 2, 'UVERAL', 2, 16),
(1000, 1, 'BOCONOITO     ', 12, 16),
(1001, 2, 'ANTOLIN TOVAR AQUINO', 12, 16),
(1002, 1, 'GUANARITO     ', 4, 16),
(1003, 3, 'DIVINA PASTORA     ', 4, 16),
(1004, 2, 'TRINIDAD DE LA CAPILLA', 4, 16),
(1005, 1, 'CHABASQUEN     ', 9, 16),
(1006, 2, 'PEÑA BLANCA', 9, 16),
(1007, 1, 'OSPINO     ', 5, 16),
(1008, 2, 'APARICION     ', 5, 16),
(1009, 3, 'LA ESTACION', 5, 16),
(1010, 1, 'ACARIGUA     ', 6, 16),
(1011, 2, 'PAYARA     ', 6, 16),
(1012, 3, 'PIMPINELA     ', 6, 16),
(1013, 4, 'RAMON PERAZA', 6, 16),
(1014, 1, 'PAPELON     ', 11, 16),
(1015, 2, 'CAÑO DELGADITO', 11, 16),
(1016, 1, 'EL PLAYON     ', 14, 16),
(1017, 2, 'FLORIDA', 14, 16),
(1018, 1, 'SAN RAFAEL DE ONOTO     ', 13, 16),
(1019, 2, 'SANTA FE     ', 13, 16),
(1020, 3, 'THERMO MORLES', 13, 16),
(1021, 1, 'BISCUCUY     ', 7, 16),
(1022, 2, 'CONCEPCION     ', 7, 16),
(1023, 5, 'SAN JOSE DE SAGUAZ     ', 7, 16),
(1024, 3, 'SAN RAFAEL PALO ALZADO     ', 7, 16),
(1025, 4, 'UVENCIO A VELASQUEZ     ', 7, 16),
(1026, 6, 'VILLA ROSA', 7, 16),
(1027, 1, 'VILLA BRUZUAL     ', 8, 16),
(1028, 2, 'CANELONES     ', 8, 16),
(1029, 4, 'SAN ISIDRO LABRADOR     ', 8, 16),
(1030, 3, 'SANTA CRUZ', 8, 16),
(1031, 1, 'ALTAGRACIA     ', 9, 17),
(1032, 2, 'AYACUCHO     ', 9, 17),
(1033, 6, 'GRAN MARISCAL     ', 9, 17),
(1034, 7, 'RAUL LEONI     ', 9, 17),
(1035, 5, 'SAN JUAN     ', 9, 17),
(1036, 3, 'SANTA INES     ', 9, 17),
(1037, 4, 'VALENTIN VALIENTE', 9, 17),
(1038, 1, 'MARIÑO     ', 11, 17),
(1039, 2, 'ROMULO GALLEGOS', 11, 17),
(1040, 1, 'SAN JOSE DE AREOCUAR     ', 13, 17),
(1041, 2, 'TAVERA ACOSTA', 13, 17),
(1042, 5, 'ANTONIO JOSE DE SUCRE     ', 1, 17),
(1043, 4, 'EL MORRO DE PTO SANTO     ', 1, 17),
(1044, 3, 'PUERTO SANTO ', 1, 17),
(1045, 1, 'RIO CARIBE     ', 1, 17),
(1046, 2, 'SAN JUAN GALDONAS', 1, 17),
(1047, 1, 'EL PILAR     ', 2, 17),
(1048, 2, 'EL RINCON     ', 2, 17),
(1049, 6, 'GENERAL FRANCISCO A VASQUEZ     ', 2, 17),
(1050, 3, 'GUARAUNOS     ', 2, 17),
(1051, 4, 'TUNAPUICITO     ', 2, 17),
(1052, 5, 'UNION', 2, 17),
(1053, 4, 'BOLIVAR     ', 3, 17),
(1054, 5, 'MACARAPANA     ', 3, 17),
(1055, 1, 'SANTA CATALINA     ', 3, 17),
(1056, 2, 'SANTA ROSA     ', 3, 17),
(1057, 3, 'SANTA TERESA', 3, 17),
(1058, 1, 'MARIGUITAR', 14, 17),
(1059, 2, 'LIBERTAD     ', 4, 17),
(1060, 3, 'PAUJIL     ', 4, 17),
(1061, 1, 'YAGUARAPARO', 4, 17),
(1062, 1, 'ARAYA     ', 15, 17),
(1063, 3, 'CHACOPATA     ', 15, 17),
(1064, 2, 'MANICUARE', 15, 17),
(1065, 2, 'CAMPO ELIAS     ', 12, 17),
(1066, 1, 'TUNAPUY', 12, 17),
(1067, 2, 'CAMPO CLARO     ', 5, 17),
(1068, 1, 'IRAPA     ', 5, 17),
(1069, 5, 'MARABAL     ', 5, 17),
(1070, 4, 'SAN ANTONIO DE IRAPA     ', 5, 17),
(1071, 3, 'SORO', 5, 17),
(1072, 1, 'SAN ANTONIO DEL GOLFO', 6, 17),
(1073, 2, 'ARENAS     ', 7, 17),
(1074, 3, 'ARICAGUA     ', 7, 17),
(1075, 4, 'COCOLLAR     ', 7, 17),
(1076, 1, 'CUMANACOA     ', 7, 17),
(1077, 5, 'SAN FERNANDO     ', 7, 17),
(1078, 6, 'SAN LORENZO', 7, 17),
(1079, 1, 'CARIACO     ', 8, 17),
(1080, 2, 'CATUARO     ', 8, 17),
(1081, 3, 'RENDON     ', 8, 17),
(1082, 4, 'SANTA CRUZ     ', 8, 17),
(1083, 5, 'SANTA MARIA', 8, 17),
(1084, 4, 'BIDEAU     ', 10, 17),
(1085, 2, 'CRISTOBAL COLON     ', 10, 17),
(1086, 1, 'GUIRIA     ', 10, 17),
(1087, 3, 'PUNTA DE PIEDRA', 10, 17),
(1088, 7, 'ANDRÉS ELOY BLANCO', 1, 4),
(1089, 2, 'CHORONI', 1, 4),
(1090, 4, 'JOAQUIN CRESPO', 1, 4),
(1091, 6, 'JOSÉ CASANOVA GODOY', 1, 4),
(1092, 1, 'LAS DELICIAS', 1, 4),
(1093, 8, 'LOS TACARIGUAS', 1, 4),
(1094, 3, 'MADRE MARÍA DE SAN JOSÉ', 1, 4),
(1095, 5, 'PEDRO JOSÉ OVALLES', 1, 4),
(1096, 1, 'SAN MATEO', 11, 4),
(1097, 1, 'CAMATAGUA', 15, 4),
(1098, 2, 'CARMEN DE CURA', 15, 4),
(1099, 1, 'SANTA RITA', 17, 4),
(1100, 2, 'FRANCISCO DE MIRANDA', 17, 4),
(1101, 3, 'MONSEÑOR FELICIANO GONZALÉZ', 17, 4),
(1102, 1, 'SANTA CRUZ', 10, 4),
(1103, 1, 'JUAN VICENTE BOLÍVAR', 3, 4),
(1104, 4, 'CASTOR NIEVES RÍOS', 3, 4),
(1105, 5, 'LAS GUACAMAYAS', 3, 4),
(1106, 3, 'PAO DE ZARATE', 3, 4),
(1107, 2, 'ZUATA', 3, 4),
(1108, 1, 'EL CONSEJO', 16, 4),
(1109, 1, 'PALO NEGRO', 9, 4),
(1110, 2, 'SAN MARTÍN DE PORRES', 9, 4),
(1111, 1, 'EL LIMÓN', 13, 4),
(1112, 2, 'CAÑA DE AZUCAR', 13, 4),
(1113, 1, 'OCUMARE DE LA COSTA', 18, 4),
(1114, 1, 'SAN CASIMIRO', 4, 4),
(1115, 3, 'GÜIRIPA', 4, 4),
(1116, 4, 'OLLAS DE CARAMACATE', 4, 4),
(1117, 2, 'VALLE MORÍN', 4, 4),
(1118, 1, 'SAN SEBASTIAN', 5, 4),
(1119, 1, 'TURMERO', 2, 4),
(1120, 3, 'ALFREDO PACHECO MIRANDA', 2, 4),
(1121, 5, 'AREVALO APONTE', 2, 4),
(1122, 4, 'CHUAO', 2, 4),
(1123, 2, 'SAMAN DE GÜERE', 2, 4),
(1124, 1, 'LAS TEJERÍAS', 12, 4),
(1125, 2, 'TIARA', 12, 4),
(1126, 1, 'CAGUA', 6, 4),
(1127, 2, 'BELLA VISTA', 6, 4),
(1128, 1, 'COLONIA TOVAR', 14, 4),
(1129, 1, 'BARBACOAS', 7, 4),
(1130, 4, 'LAS PEÑITAS', 7, 4),
(1131, 2, 'SAN FRANCISCO DE CARA', 7, 4),
(1132, 3, 'TAGUAY', 7, 4),
(1133, 1, 'VILLA DE CURA', 8, 4),
(1134, 2, 'MAGDALENO', 8, 4),
(1135, 5, 'AUGUSTO MIJARES', 8, 4),
(1136, 3, 'SAN FRANCISCO DE ASIS', 8, 4),
(1137, 4, 'VALLES DE TUCUTUNEMO', 8, 4),
(1138, 1, 'PETARE', 9, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `name`, `number`, `email`, `address`, `rif`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Bayer', '02122365874', 'alvaro.develoop@gmail.com', 'Caracas', 'J-21202500', 4, '2017-12-27 23:07:57', '2017-12-27 23:09:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `clients_id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_mode` enum('efectivo','punto') COLLATE utf8mb4_unicode_ci NOT NULL,
  `iva_config_global` int(11) NOT NULL,
  `total` double(15,2) NOT NULL,
  `id_temporal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `users_id`, `clients_id`, `invoice`, `pay_mode`, `iva_config_global`, `total`, `id_temporal`, `created_at`, `updated_at`) VALUES
(3, 4, 2, '2017120001', 'punto', 12, 5287040.00, 0, '2017-12-30 03:06:50', '2018-01-17 08:22:00'),
(4, 4, 3, '2017120004', 'punto', 12, 93104.00, 0, '2017-12-30 03:10:54', '2018-01-17 08:22:00'),
(5, 4, 3, '2017120005', 'efectivo', 0, 145800.00, 0, '2017-12-30 03:16:25', '2018-01-17 08:22:00'),
(6, 4, 3, '2017120006', 'punto', 12, 221408.00, 0, '2017-12-30 03:22:31', '2018-01-17 08:22:00'),
(7, 4, 3, '2017120007', 'punto', 12, 221408.00, 0, '2017-12-30 03:24:27', '2018-01-17 08:22:00'),
(8, 4, 3, '2017120008', 'punto', 12, 105740.80, 0, '2017-12-30 03:26:41', '2018-01-17 08:22:00'),
(9, 4, 2, '2017120009', 'efectivo', 0, 633040.00, 0, '2017-12-30 03:28:04', '2018-01-17 08:22:00'),
(10, 4, 3, '20180100010', 'efectivo', 0, 226600.00, 0, '2018-01-11 19:40:52', '2018-01-17 08:22:00'),
(11, 4, 4, '20180100011', 'efectivo', 0, 50320.00, 0, '2018-01-16 04:43:45', '2018-01-17 08:22:00'),
(12, 4, 4, '20180100012', 'punto', 12, 123763.20, 0, '2018-01-16 04:44:34', '2018-01-17 08:22:00'),
(13, 4, 4, '20180100013', 'punto', 12, 17740.80, 0, '2018-01-16 04:45:42', '2018-01-17 08:22:00'),
(14, 4, 5, '20180100014', 'efectivo', 0, 70160.00, 0, '2018-01-16 04:46:40', '2018-01-17 08:22:00'),
(69, 4, 3, '20180100060', 'punto', 12, 10000.00, 0, '2018-01-17 08:21:54', '2018-01-17 08:22:00'),
(70, 4, 4, '20171200054', 'efectivo', 0, 70000.00, 0, '2018-01-17 08:21:55', '2018-01-17 08:22:00'),
(71, 4, 5, '20180100071', 'punto', 12, 4400.00, 0, '2018-01-18 01:28:07', '2018-01-18 01:28:07'),
(72, 4, 3, '20180100072', 'punto', 12, 66000.00, 0, '2018-01-18 01:29:02', '2018-01-18 01:29:02'),
(73, 4, 2, '20180100073', 'punto', 12, 35340.80, 0, '2018-01-18 01:30:11', '2018-01-18 01:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocktakings`
--

CREATE TABLE `stocktakings` (
  `id` int(10) UNSIGNED NOT NULL,
  `providers_id` int(10) UNSIGNED NOT NULL,
  `trademarks_id` int(10) UNSIGNED NOT NULL,
  `groups_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `component` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `quantity` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `buying_price_provider` double(15,2) NOT NULL,
  `buying_date` date NOT NULL,
  `config_currencies_iva_id` int(11) NOT NULL DEFAULT '0',
  `config_currencies_discount_id` int(11) NOT NULL DEFAULT '0',
  `date_of_expense` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stocktakings`
--

INSERT INTO `stocktakings` (`id`, `providers_id`, `trademarks_id`, `groups_id`, `users_id`, `code_product`, `product`, `component`, `quantity`, `price`, `buying_price_provider`, `buying_date`, `config_currencies_iva_id`, `config_currencies_discount_id`, `date_of_expense`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 4, '01-05', 'Pastilla Bayer 300 ml', 'acetaminofen', 2, 20000.00, 10000.00, '2017-12-12', 1, 2, '2020-01-01', '2017-12-29 23:02:06', '2018-01-18 01:30:12'),
(2, 1, 1, 1, 4, '00-1', 'Inyectadora', NULL, 238, 5000.00, 1000.00, '2017-12-08', 0, 0, '2021-01-01', '2017-12-29 23:02:38', '2018-01-18 01:30:12'),
(7, 1, 1, 1, 4, '00-2', 'Dilantyl 300 ml', 'fenitoina', 464, 15000.00, 10000.00, '2017-07-12', 0, 0, '2018-05-01', '2018-01-16 23:46:07', '2018-01-18 01:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_sales`
--

CREATE TABLE `temp_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `price` double(15,2) NOT NULL,
  `config_currencies_iva` int(11) NOT NULL DEFAULT '0',
  `config_currencies_discount` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `total` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trademarks`
--

CREATE TABLE `trademarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trademarks`
--

INSERT INTO `trademarks` (`id`, `name`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 'Bayer', 4, '2017-12-28 23:12:09', '2017-12-28 23:12:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_farmacia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` smallint(6) NOT NULL,
  `estado` mediumint(9) NOT NULL,
  `municipio` mediumint(9) NOT NULL,
  `parroquia` mediumint(9) NOT NULL,
  `status` smallint(6) NOT NULL,
  `token_validation` text COLLATE utf8mb4_unicode_ci,
  `type` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `nombre_farmacia`, `nivel`, `rol`, `estado`, `municipio`, `parroquia`, `status`, `token_validation`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$55Ad0IsbcrMVb1hsXAi0Y.BuMPNxbe8hGULZqXE6VTbvbQzU2v462', 'farmatodo', '1', 1, 4, 6, 1126, 0, NULL, 1, 'IYalWhMzoEnqwUZl6bPEP7UgBikjHKckWB0BY1TqvvMqux5FaZGUlPsvMvV7', '2017-12-26 03:24:35', '2017-12-26 03:24:35'),
(4, 'sass', '$2y$10$5yZlzMOUTTRmKFSZVCvC0u8bjgQk.0BuFkbEJGrs/xsz3kS45/VOq', 'Sass', '2', 1, 1, 1, 439, 1, '$2y$10$ilPmJeCj6vQD4.QbvTplpe6oU/avuV60XgPSwsnLKnGR4RnHNCPXG', 2, '1U16IijbALetsa6jZStiN9sYtrtkbYZH3MCtTk2eFtXsaXnBhs98MLIsjFVw', '2017-12-27 01:11:06', '2018-01-19 04:00:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buys`
--
ALTER TABLE `buys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buys_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `buy_details`
--
ALTER TABLE `buy_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_details_user_id_foreign` (`user_id`),
  ADD KEY `buy_details_providers_id_foreign` (`providers_id`),
  ADD KEY `buy_details_stocktaking_id_foreign` (`stocktaking_id`),
  ADD KEY `buy_details_buy_id_foreign` (`buy_id`);

--
-- Indices de la tabla `buy_temporals`
--
ALTER TABLE `buy_temporals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configs_director_email_unique` (`director_email`),
  ADD KEY `configs_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `config_currencies`
--
ALTER TABLE `config_currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `config_currencies_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `detail_sales`
--
ALTER TABLE `detail_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_sales_sales_id_foreign` (`sales_id`),
  ADD KEY `detail_sales_products_id_foreign` (`products_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `providers_email_unique` (`email`),
  ADD KEY `providers_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_clients_id_foreign` (`clients_id`),
  ADD KEY `sales_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `stocktakings`
--
ALTER TABLE `stocktakings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocktakings_providers_id_foreign` (`providers_id`),
  ADD KEY `stocktakings_trademarks_id_foreign` (`trademarks_id`),
  ADD KEY `stocktakings_groups_id_foreign` (`groups_id`),
  ADD KEY `stocktakings_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `temp_sales`
--
ALTER TABLE `temp_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trademarks`
--
ALTER TABLE `trademarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trademarks_users_id_foreign` (`users_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_unique` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buys`
--
ALTER TABLE `buys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `buy_details`
--
ALTER TABLE `buy_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `buy_temporals`
--
ALTER TABLE `buy_temporals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `config_currencies`
--
ALTER TABLE `config_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detail_sales`
--
ALTER TABLE `detail_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `stocktakings`
--
ALTER TABLE `stocktakings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `temp_sales`
--
ALTER TABLE `temp_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trademarks`
--
ALTER TABLE `trademarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `buys`
--
ALTER TABLE `buys`
  ADD CONSTRAINT `buys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `buy_details`
--
ALTER TABLE `buy_details`
  ADD CONSTRAINT `buy_details_buy_id_foreign` FOREIGN KEY (`buy_id`) REFERENCES `buys` (`id`),
  ADD CONSTRAINT `buy_details_providers_id_foreign` FOREIGN KEY (`providers_id`) REFERENCES `providers` (`id`),
  ADD CONSTRAINT `buy_details_stocktaking_id_foreign` FOREIGN KEY (`stocktaking_id`) REFERENCES `stocktakings` (`id`),
  ADD CONSTRAINT `buy_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `configs`
--
ALTER TABLE `configs`
  ADD CONSTRAINT `configs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `config_currencies`
--
ALTER TABLE `config_currencies`
  ADD CONSTRAINT `config_currencies_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detail_sales`
--
ALTER TABLE `detail_sales`
  ADD CONSTRAINT `detail_sales_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `stocktakings` (`id`),
  ADD CONSTRAINT `detail_sales_sales_id_foreign` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`);

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_clients_id_foreign` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `sales_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `stocktakings`
--
ALTER TABLE `stocktakings`
  ADD CONSTRAINT `stocktakings_groups_id_foreign` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `stocktakings_providers_id_foreign` FOREIGN KEY (`providers_id`) REFERENCES `providers` (`id`),
  ADD CONSTRAINT `stocktakings_trademarks_id_foreign` FOREIGN KEY (`trademarks_id`) REFERENCES `trademarks` (`id`),
  ADD CONSTRAINT `stocktakings_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `trademarks`
--
ALTER TABLE `trademarks`
  ADD CONSTRAINT `trademarks_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
