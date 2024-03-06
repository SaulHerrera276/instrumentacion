-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2024 a las 17:21:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instrumentacion2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `co2` varchar(500) NOT NULL,
  `refrigeracion` varchar(500) NOT NULL,
  `calderas` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrumentacion`
--

CREATE TABLE `instrumentacion` (
  `id_instrumentacion` bigint(255) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `marca` varchar(500) NOT NULL,
  `variable` varchar(500) NOT NULL,
  `calibracion_conforme` varchar(500) NOT NULL,
  `codigo` varchar(500) NOT NULL,
  `ultima_calibracion` date NOT NULL,
  `proxima_calibracion` date NOT NULL,
  `int_cal` varchar(500) NOT NULL,
  `informe` varchar(500) NOT NULL,
  `observacion` varchar(500) NOT NULL,
  `pdf` varchar(500) NOT NULL,
  `area` varchar(500) NOT NULL,
  `maquina` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instrumentacion`
--

INSERT INTO `instrumentacion` (`id_instrumentacion`, `nombre`, `marca`, `variable`, `calibracion_conforme`, `codigo`, `ultima_calibracion`, `proxima_calibracion`, `int_cal`, `informe`, `observacion`, `pdf`, `area`, `maquina`) VALUES
(1, 'manometro_de_tuberia', 'dewit', '0-1.0 Mpa\r\n', 'si', '10266440', '2023-06-25', '2024-06-24', '1.5 a 9 BAR', '140000772047', '32208027', 'si', 'co2', 'compresor_co2_mehre03'),
(2, 'sensor_de_nada', 'dewit', '0-100 Kg-cm / psi', 'si', '102213334', '2023-11-27', '2024-11-28', '15 a 90 psi', '140000798409', '32208027', 'si', 'co2', 'bomba_centrifuga_02'),
(3, 'manometro_de_tuberia', 'dewit', '0-1.0 mpa', 'si', '10266416', '2023-02-28', '2024-02-28', '1.5 a 9 bar', '140000800420', '32208027', 'si', 'co2', 'compresor_co2_mehre01'),
(4, 'manometro_de_tuberia', 'dewit', '0-1.0 Mpa', 'si', '10266456', '2023-10-20', '2024-10-22', '1.5 a 9.0 BAR', '140000792118', '32208027', 'si', 'co2', 'compresor_co2_mehre05'),
(5, 'manometro_de_tuberia', 'dewit', '0-1.0 Mpa', 'si', '10266464', '2023-12-13', '2024-12-22', '1.5 a 9 BAR', '400008004420', '32208027', 'si', 'co2', 'compresor_co2_mehre06'),
(7, 'manometro_de_presion', 'wika', '0-25 bar', 'si', '10267618', '2023-07-21', '2024-07-15', '3a 18 BAR', '140000776225', '32208027', 'si', 'co2', 'purificadora_de_co2 2.1'),
(8, 'manometro_de_temperatura', 'wika', '0-300°C', 'si', '10267620', '2023-07-21', '2024-07-15', '150°C', '140000776235', '32208027', 'si', 'co2', 'purificadora_de_co2 2.1'),
(9, 'sensor_de_presion', 'mpm', '-', 'si', '10267615', '2023-07-21', '2024-07-15', '3 a 18 BAR', '140000776230', '32208027', 'si', 'co2', 'purificadora_de_co2 2.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` enum('admin','invitado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `pass`, `rol`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'invitado', 'invitado', 'invitado'),
(13, 'aaaaa', 'aaaaa', 'invitado'),
(14, '12345', '12345', 'invitado'),
(15, 'Saul Herrera', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instrumentacion`
--
ALTER TABLE `instrumentacion`
  ADD PRIMARY KEY (`id_instrumentacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instrumentacion`
--
ALTER TABLE `instrumentacion`
  MODIFY `id_instrumentacion` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
