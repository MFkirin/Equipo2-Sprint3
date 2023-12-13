-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Tiempo de generación: 06-12-2023 a las 19:45:29
-- Versión del servidor: 10.11.5-MariaDB-1:10.11.5+maria~ubu2204
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beta_db_bhec_06122023`
--
CREATE DATABASE IF NOT EXISTS `beta_db_bhec_06122023` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `beta_db_bhec_06122023`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrative`
--

CREATE TABLE `administrative` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Ford'),
(2, 'Toyota'),
(3, 'Honda'),
(4, 'Chevrolet'),
(5, 'Volkswagen'),
(6, 'Nissan'),
(7, 'BMW'),
(8, 'Mercedes-Benz'),
(9, 'Audi'),
(10, 'Hyundai'),
(11, 'Kia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `bussiness_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `name`, `lastname`, `address`, `dni`, `phone`, `bussiness_name`, `email`, `login_id`) VALUES
(1, 'Carlos', 'Estalrich', 'Calle Falsa 123', '12345678A', '123456789', 'CarlosSA', 'carlos@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`id`, `filename`, `vehicle_id`) VALUES
(1, 'honda-accord.jpg', 5),
(2, 'Ford-Bronco.jpg', 7),
(3, 'chevrolet-camaro.jpg', 15),
(4, 'toyota-camry.jpg', 1),
(5, 'honda-civic.jpg', 4),
(6, 'Toyota-Corolla.jpg', 8),
(7, 'Honda-CRV.jpg', 10),
(8, 'Chevrolet-Equinox.jpg', 14),
(9, 'Ford-Escape.jpg', 22),
(10, 'ford-focus.jpg', 20),
(11, 'VW-Golf.jpg', 18),
(12, 'Toyota-Highlander.jpg', 3),
(13, 'chevrolet-malibu.jpg', 17),
(14, 'Ford-Mustang.jpg', 21),
(15, 'Honda-Pilot.jpg', 11),
(16, 'Toyota-Prius.jpg', 2),
(17, 'toyota-rav4.jpg', 9),
(18, 'chevrolet-silverado.jpg', 13),
(19, 'Chevrolet-Traverse.jpg', 16),
(20, 'VW-Tiguan.jpg', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `number`, `price`, `date`, `customer_id`, `order_id`) VALUES
(2, '1234A', 8500, '2023-11-04', 1, 1),
(14, '23ACV', 33143, '2023-01-23', 1, 1),
(15, '3', 35000, '2023-01-03', 1, 1),
(16, '4', 27000, '2023-01-04', 1, 1),
(17, '5', 32000, '2023-01-05', 1, 1),
(18, '6', 38000, '2023-01-06', 1, 1),
(19, '7', 28000, '2023-01-07', 1, 1),
(20, '555AA', 52300, '2023-01-08', 1, 1),
(21, '1433A', 33333, '2023-01-09', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `role`) VALUES
(1, 'carlos', '$2y$10$gmujwC6am6kK5XB53xTi8eZfzGmoYQPlx49wVkbBSJq8w3l8/ZJy6', 'administrator'),
(3, 'carest23', '$2y$10$ttjU9opnW8WzkcNcI9y/1enK/dMHHHtj1NPfplhast7MJATVUu8Oa', 'administrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enginePower` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `model`
--

INSERT INTO `model` (`id`, `name`, `enginePower`, `description`, `brand_id`, `year`) VALUES
(1, 'Focus', '130cv', 'ST Line', 1, 2016),
(2, 'Mustang', '150cv', 'Sports Car', 1, 2023),
(3, 'Escape', '115cv', 'SUV', 1, 2022),
(4, 'Explorer', '115cv', 'SUV', 1, 2023),
(5, 'Fusion', '115cv', 'Sedan', 1, 2022),
(6, 'Bronco', '135cv', 'Off-Road SUV', 1, 2023),
(7, 'Corolla', '115cv', 'Sedan', 2, 2022),
(8, 'Rav4', '135cv', 'SUV', 2, 2023),
(9, 'Camry', '115cv', 'Sedan', 2, 2023),
(10, 'Prius', '78KWh', 'Hatchback', 2, 2022),
(11, 'Highlander', '135cv', 'SUV', 2, 2023),
(12, 'Civic', '115cv', 'Sedan', 3, 2022),
(13, 'Accord', '115cv', 'Sedan', 3, 2023),
(14, 'CR-V', '135cv', 'SUV', 3, 2023),
(15, 'Pilot', '115cv', 'SUV', 3, 2022),
(16, 'Fit', '115cv', 'Hatchback', 3, 2022),
(17, 'Silverado', '135cv', 'Pickup Truck', 4, 2023),
(18, 'Equinox', '115cv', 'SUV', 4, 2022),
(19, 'Camaro', '150cv', 'Sports Car', 4, 2023),
(20, 'Traverse', '115cv', 'SUV', 4, 2022),
(21, 'Malibu', '135cv', 'Sedan', 4, 2023),
(22, 'Golf', '135cv', 'Hatchback', 5, 2022),
(23, 'Tiguan', '135cv', 'SUV', 5, 2023),
(24, 'Passat', '135cv', 'Sedan', 5, 2022),
(25, 'Atlas', '115cv', 'SUV', 5, 2023),
(26, 'Arteon', '115cv', 'Sedan', 5, 2022),
(27, 'Altima', '115cv', 'Sedan', 6, 2023),
(28, 'Rogue', '115cv', 'SUV', 6, 2022),
(29, 'Pathfinder', '115cv', 'SUV', 6, 2023),
(30, 'Maxima', '115cv', 'Sedan', 6, 2022),
(31, 'Titan', '135cv', 'Pickup Truck', 6, 2023),
(32, '3 Series', '115cv', 'Sedan', 7, 2022),
(33, 'X3', '135cv', 'SUV', 7, 2023),
(34, '5 Series', '135cv', 'Sedan', 7, 2022),
(35, 'X5', '135cv', 'SUV', 7, 2023),
(36, 'M4', '150cv', 'Sports Car', 7, 2022),
(37, 'C-Class', '135cv', 'Sedan', 8, 2023),
(38, 'GLC', '135cv', 'SUV', 8, 2022),
(39, 'E-Class', '135cv', 'Sedan', 8, 2023),
(40, 'GLE', '135cv', 'SUV', 8, 2022),
(41, 'S-Class', '135cv', 'Luxury Sedan', 8, 2023),
(42, 'A3', '135cv', 'Hatchback', 9, 2022),
(43, 'Q5', '135cv', 'SUV', 9, 2023),
(44, 'A4', '135cv', 'Sedan', 9, 2022),
(45, 'Q7', '135cv', 'SUV', 9, 2023),
(46, 'R8', '135cv', 'Sports Car', 9, 2022),
(47, 'Elantra', '115cv', 'Sedan', 10, 2023),
(48, 'Tucson', '115cv', 'SUV', 10, 2022),
(49, 'Kona', '115cv', 'SUV', 10, 2023),
(50, 'Santa Fe', '115cv', 'SUV', 10, 2022),
(51, 'Veloster', '120cv', 'Hatchback', 10, 2023),
(52, 'Forte', '115cv', 'Sedan', 11, 2022),
(53, 'Sportage', '115cv', 'SUV', 11, 2023),
(54, 'Soul', '115cv', 'Hatchback', 11, 2022),
(55, 'Telluride', '115cv', 'SUV', 11, 2023),
(56, 'Stinger', '115cv', 'Sports Car', 11, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `state`, `customer_id`) VALUES
(1, 'pending', 1),
(12, 'pending', 1),
(13, 'shipped', 1),
(14, 'delivered', 1),
(15, 'pending', 1),
(16, 'shipped', 1),
(17, 'delivered', 1),
(18, 'pending', 1),
(19, 'shipped', 1),
(20, 'delivered', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `private`
--

CREATE TABLE `private` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professional`
--

CREATE TABLE `professional` (
  `id` int(11) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `manager_nif` varchar(20) NOT NULL,
  `lopd` varchar(255) NOT NULL,
  `constitution_writing` varchar(255) NOT NULL,
  `subscription` tinyint(1) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bank_title` varchar(255) NOT NULL,
  `manager_nif` varchar(20) NOT NULL,
  `lopd_doc` varchar(255) NOT NULL,
  `constitution_article` varchar(255) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`id`, `email`, `phone`, `dni`, `cif`, `address`, `bank_title`, `manager_nif`, `lopd_doc`, `constitution_article`, `login_id`) VALUES
(1, 'carlos@gmail.com', '123456789', '12345678A', '12345678A', 'Calle Falsa 123', '', '12345678A', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `observed_damages` varchar(255) NOT NULL,
  `kilometers` int(11) NOT NULL,
  `buy_price` float NOT NULL,
  `sell_price` float NOT NULL,
  `fuel` varchar(255) NOT NULL,
  `iva` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `chassis_number` varchar(255) NOT NULL,
  `gearbox` varchar(255) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `transport_included` tinyint(1) NOT NULL,
  `color` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `provider_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehicle`
--

INSERT INTO `vehicle` (`id`, `plate`, `observed_damages`, `kilometers`, `buy_price`, `sell_price`, `fuel`, `iva`, `description`, `chassis_number`, `gearbox`, `is_new`, `transport_included`, `color`, `registration_date`, `provider_id`, `model_id`, `order_id`) VALUES
(1, '7777GGG', 'Ninguno', 18000, 12000, 17000, 'Gasolina', 21, 'Sedán, Cómodo', 'GGG666666777777HH', 'Automático', 1, 0, 'Plateado', '2023-12-30', 1, 9, NULL),
(2, '8888HHH', 'Ligero golpe en la parte trasera', 10000, 15000, 19000, 'Eléctrico', 21, 'Deportivo, Rápido y Furioso', 'HHH777777888888II', 'Automático', 0, 1, 'Blanco', '2023-01-04', 1, 10, NULL),
(3, '9999III', 'Ninguno', 12000, 13000, 17000, 'Gasolina', 21, 'SUV, Espacioso', 'III888888999999JJ', 'Automático', 1, 0, 'Rojo Brillante', '2023-01-09', 1, 11, NULL),
(4, '1010JJJ', 'Ninguno', 6000, 20000, 24000, 'Híbrido', 21, 'Sedán, Tecnológico', 'JJJ999999101010KK', 'Automático', 1, 0, 'Gris Grafito', '2023-01-14', 1, 12, NULL),
(5, '1111KKK', 'Ninguno', 9000, 14000, 18000, 'Gasolina', 21, 'Familiar, Espacioso', 'KKK101010111111LL', 'Automático', 1, 0, 'Azul', '2023-01-19', 1, 13, NULL),
(7, '4444DDD', 'Ligero rasguño en el parachoques trasero', 8000, 19000, 23000, 'Gasolina', 21, 'SUV, Todo Terreno', 'DDD333333444444EE', 'Automático', 0, 1, 'Negro', '2023-12-15', 1, 6, NULL),
(8, '5555EEE', 'Ninguno', 15000, 14000, 18000, 'Diésel', 21, 'Hatchback, Compacto', 'EEE444444555555FF', 'Automático', 1, 0, 'Gris Oscuro', '2023-12-20', 1, 7, NULL),
(9, '6666FFF', 'Rayón en la puerta trasera izquierda', 7000, 17000, 21000, 'Gasolina', 21, 'Coupé, Estilo Deportivo', 'FFF555555666666GG', 'Automático', 0, 1, 'Azul', '2023-12-25', 1, 8, NULL),
(10, '1212LLL', 'Ninguno', 11000, 16000, 20000, 'Diésel', 21, 'Coupé, Estilo Deportivo', 'LLL111111222222MM', 'Automático', 1, 0, 'Negro', '2023-12-25', 1, 14, NULL),
(11, '1313MMM', 'Pequeño abollón en la parte delantera', 13000, 18000, 22000, 'Gasolina', 21, 'Hatchback, Compacto', 'MMM222222333333NN', 'Automático', 0, 1, 'Rojo', '2023-12-30', 1, 15, NULL),
(13, '1515OOO', 'Rayón en el lateral izquierdo', 7000, 19000, 23000, 'Gasolina', 21, 'Coupé, Estilo Deportivo', 'OOO444444555555PP', 'Automático', 0, 1, 'Azul Oscuro', '2023-01-09', 1, 17, NULL),
(14, '1616PPP', 'Ninguno', 9000, 17000, 21000, 'Gasolina', 21, 'Deportivo, Rápido y Furioso', 'PPP555555666666QQ', 'Automático', 1, 0, 'Gris Oscuro', '2023-01-14', 1, 18, NULL),
(15, '1717QQQ', 'Desgaste normal, bien mantenido', 11000, 14000, 18000, 'Diésel', 21, 'Familiar, Espacioso', 'QQQ666666777777RR', 'Automático', 0, 1, 'Plateado', '2023-01-19', 1, 19, NULL),
(16, '1818RRR', 'Ninguno', 13000, 12000, 17000, 'Gasolina', 21, 'SUV, Espacioso', 'RRR777777888888SS', 'Automático', 1, 0, 'Blanco Perla', '2023-01-24', 1, 20, NULL),
(17, '1919SSS', 'Pequeño abollón en el parachoques trasero', 15000, 13000, 17000, 'Gasolina', 21, 'Coupé, Estilo Deportivo', 'SSS888888999999TT', 'Automático', 0, 1, 'Negro', '2023-01-29', 1, 21, NULL),
(18, '2020TTT', 'Ninguno', 7000, 19000, 23000, 'Diésel', 21, 'Hatchback, Compacto', 'TTT999999000000UU', 'Automático', 1, 0, 'Rojo Brillante', '2023-02-03', 1, 22, NULL),
(19, '2121UUU', 'Rayón en el lateral izquierdo', 9000, 14000, 18000, 'Gasolina', 21, 'Sedán, Cómodo', 'UUU000000111111VV', 'Automático', 0, 1, 'Gris Grafito', '2023-02-08', 1, 23, NULL),
(20, '2222VVV', 'Ninguno', 11000, 16000, 20000, 'Diésel', 21, 'Coupé, Estilo Deportivo', 'VVV111111222222WW', 'Automático', 1, 0, 'Negro', '2023-12-25', 1, 1, NULL),
(21, '2323WWW', 'Pequeño abollón en la parte trasera', 13000, 18000, 22000, 'Gasolina', 21, 'Hatchback, Compacto', 'WWW222222333333XX', 'Automático', 0, 1, 'Rojo', '2023-12-30', 1, 2, NULL),
(22, '2424XXX', 'Ninguno', 15000, 12000, 17000, 'Diésel', 21, 'SUV, Todo Terreno', 'XXX333333444444YY', 'Automático', 1, 0, 'Blanco', '2023-01-04', 1, 3, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `administrative`
--
ALTER TABLE `administrative`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`) USING BTREE;

--
-- Indices de la tabla `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indices de la tabla `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `professional`
--
ALTER TABLE `professional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indices de la tabla `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administrative`
--
ALTER TABLE `administrative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `private`
--
ALTER TABLE `private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `professional`
--
ALTER TABLE `professional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `administrative`
--
ALTER TABLE `administrative`
  ADD CONSTRAINT `administrative_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Filtros para la tabla `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Filtros para la tabla `private`
--
ALTER TABLE `private`
  ADD CONSTRAINT `private_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `professional`
--
ALTER TABLE `professional`
  ADD CONSTRAINT `professional_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `provider_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `vehicle_ibfk_4` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `vehicle_ibfk_5` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
