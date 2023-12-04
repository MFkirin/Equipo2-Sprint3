-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Tiempo de generación: 04-12-2023 a las 10:49:00
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
-- Base de datos: `beta_db_bhec_23112023`
--

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
  `gear_shift` varchar(255) NOT NULL,
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

INSERT INTO `vehicle` (`id`, `plate`, `observed_damages`, `kilometers`, `buy_price`, `sell_price`, `fuel`, `iva`, `description`, `chassis_number`, `gear_shift`, `is_new`, `transport_included`, `color`, `registration_date`, `provider_id`, `model_id`, `order_id`) VALUES
(1, '0000AAAA', 'gfhfghfghfg', 10000, 8000, 9999, 'Electric', 23, 'ffsdfsdfsd', '34242343', '4', 0, 1, 'Red', '2015-11-17', 1, 40, 1),
(6, '', '', 0, 0, 0, 'gasolina', 0, '', '', '', 1, 1, '', '2023-11-29', 1, 37, NULL),
(7, 'AAA 321', 'dsadasd', 23888, 54322, 7000, 'gasolina', 21, 'dasdasd', '31212313S', '5', 1, 1, 'Yellow', '2023-11-29', 1, 41, NULL),
(8, 'AAA 321', '', 0, 0, 0, 'gasolina', 0, '', '', '', 1, 1, '', '2023-12-04', 1, 37, NULL),
(10, 'FTT555', '', 0, 0, 0, 'gasolina', 0, '', '', '', 1, 1, '', '2023-12-04', 1, 37, NULL);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

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
