-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2025 a las 11:35:49
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
-- Base de datos: `bdbuses`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `averias`
--

CREATE TABLE `averias` (
  `id_averia` int(11) NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `coste` decimal(10,2) NOT NULL,
  `reparada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `averias`
--

INSERT INTO `averias` (`id_averia`, `matricula`, `descripcion`, `fecha`, `coste`, `reparada`) VALUES
(1, '2222BBB', 'Cambio de aceite', '2025-01-08 00:00:00', 129.99, 0),
(2, '1234CRR', 'Cambio de frenos', '2025-01-08 00:00:00', 250.00, 1),
(3, '1234CRR', 'Cambio de neumáticos', '2025-01-08 10:23:45', 150.00, 1),
(4, '1234CRR', 'Fallo en motor', '2025-01-08 14:37:12', 300.00, 0),
(5, '2222BBB', 'Rotura de faros', '2025-01-08 19:12:30', 75.50, 1),
(6, '2222BBB', 'Reparación del retrovisor derecho', '2025-01-08 16:46:51', 55.00, 0),
(7, '1234CRR', 'Reparación del retrovisor izquierdo', '2025-01-01 23:53:50', 57.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `matricula` varchar(7) NOT NULL,
  `capacidad` int(3) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`matricula`, `capacidad`, `modelo`, `imagen`) VALUES
('1111AAA', 60, 'BYD Electric Bus', 'BYD-Electric-Bus.png'),
('1111QQQ', 30, 'gmc', 'sinImg.png'),
('1234CRR', 11, 'Carrera', 'Brazilian GP 2024 Desktop Wallpaper 3.jpg'),
('1234GDD', 17, 'Opel Zafira', 'opelZafira.png'),
('2222BBB', 50, 'Scania K320', 'scania-k320.png'),
('3333CCC', 70, 'Irizar i6s', 'irizarI6s.png'),
('6969MER', 77, 'Mercy benz', 'mercy.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombre`, `email`, `telefono`, `password`) VALUES
('12121212Q', 'sss', 's@gmail.com', '232323', '........'),
('12345678A', 'Simon FZ', 'saidfcb2@gmail.com', '643205666', '........');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_ticket` int(11) UNSIGNED NOT NULL,
  `dni` varchar(9) NOT NULL,
  `id_ruta` int(11) UNSIGNED NOT NULL,
  `num_asiento` int(3) UNSIGNED NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `opinion` varchar(300) DEFAULT NULL,
  `fecha_opinion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_ticket`, `dni`, `id_ruta`, `num_asiento`, `fecha_reserva`, `opinion`, `fecha_opinion`) VALUES
(205, '12345678A', 19, 3, '2024-12-24 07:15:14', 'Muy bien servicio', '2025-01-12 13:32:09'),
(207, '12345678A', 19, 11, '2024-12-23 00:00:00', 'Muy bien servicio', '2025-01-12 13:32:09'),
(208, '12345678A', 19, 10, '2024-12-23 00:00:00', 'Muy bien servicio', '2025-01-12 13:32:09'),
(209, '12345678A', 28, 6, '2025-01-11 21:09:27', NULL, NULL),
(210, '12345678A', 14, 1, '2025-01-11 21:30:36', NULL, NULL),
(211, '12121212Q', 19, 5, '2024-12-12 00:00:00', NULL, NULL),
(212, '12345678A', 10, 9, '2025-01-12 13:41:51', NULL, NULL),
(213, '12345678A', 10, 11, '2025-01-12 13:42:33', NULL, NULL),
(214, '12345678A', 10, 13, '2025-01-12 13:42:33', NULL, NULL),
(215, '12345678A', 10, 3, '2025-01-12 13:44:21', NULL, NULL),
(216, '12345678A', 10, 4, '2025-01-12 13:44:21', NULL, NULL),
(218, '12345678A', 10, 16, '2025-01-12 14:09:59', NULL, NULL),
(219, '12345678A', 10, 2, '2025-01-12 14:09:59', NULL, NULL),
(220, '12345678A', 21, 58, '2025-01-12 15:26:44', NULL, NULL),
(221, '12121212Q', 22, 18, '2025-01-12 15:35:51', NULL, NULL),
(222, '12121212Q', 12, 66, '2025-01-12 15:36:50', NULL, NULL),
(223, '12121212Q', 12, 99, '2025-01-12 15:37:23', NULL, NULL),
(224, '12121212Q', 12, 47, '2025-01-12 15:39:20', NULL, NULL),
(225, '12121212Q', 12, 9999, '2025-01-12 15:41:02', NULL, NULL),
(226, '12121212Q', 23, 2, '2025-01-12 16:02:51', NULL, NULL),
(227, '12121212Q', 12, 44, '2025-01-12 16:03:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) UNSIGNED NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `ciudad_origin` varchar(50) NOT NULL,
  `ciudad_destino` varchar(50) NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `hora_llegada` time DEFAULT NULL,
  `tarifa` double NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `matricula`, `ciudad_origin`, `ciudad_destino`, `hora_salida`, `hora_llegada`, `tarifa`, `fecha`) VALUES
(10, '1234GDD', 'Vitoria-Gasteiz', 'Donostia-San Sebastian', '07:30:00', '08:50:00', 12.75, '2025-01-20'),
(11, '1234GDD', 'Donostia-San Sebastian', 'Vitoria-Gasteiz', '17:30:00', '18:50:00', 12.75, '2025-01-20'),
(12, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '10:00:00', '11:30:00', 7.25, '2025-01-20'),
(13, '3333CCC', 'Bilbao', 'Vitoria-Gasteiz', '15:30:00', '17:00:00', 7.25, '2025-01-20'),
(14, '3333CCC', 'Bilbao', 'Donostia-San Sebastian', '09:30:00', '10:30:00', 6, '2025-01-12'),
(15, '3333CCC', 'Bilbao', 'Vitoria-Gasteiz', '08:00:00', '09:30:00', 7.25, '2025-01-20'),
(16, '3333CCC', 'Bilbao', 'Vitoria-Gasteiz', '10:00:00', '11:30:00', 7.25, '2025-01-20'),
(17, '3333CCC', 'Bilbao', 'Vitoria-Gasteiz', '12:00:00', '13:30:00', 7.25, '2025-01-20'),
(18, '3333CCC', 'Bilbao', 'Vitoria-Gasteiz', '14:00:00', '15:30:00', 7.25, '2025-01-20'),
(19, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '08:00:00', '09:30:00', 7.25, '2025-01-01'),
(20, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '10:00:00', '11:50:00', 7.25, '2025-01-20'),
(21, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '12:00:00', '13:30:00', 7.25, '2025-01-20'),
(22, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '14:00:00', '15:30:00', 7.25, '2025-01-20'),
(23, '3333CCC', 'Vitoria-Gasteiz', 'Bilbao', '16:00:00', '17:30:00', 7.25, '2025-01-20'),
(26, '1234GDD', 'Vitoria-Gasteiz', 'Santander', '12:00:00', '14:00:00', 9.99, '2025-01-21'),
(27, '1234GDD', 'Santander', 'Bilbao', '20:00:00', '20:50:00', 4.99, '2025-01-22'),
(28, '2222BBB', 'Santander', 'Bilbao', '18:00:00', '23:50:00', 5.99, '2025-01-10'),
(33, '1234CRR', 'tst', 'sts', '10:00:00', '11:00:00', 10, '2025-01-27'),
(39, '1234GDD', 'gzza', 'gzooo', '23:00:00', '23:20:00', 8, '2025-01-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `averias`
--
ALTER TABLE `averias`
  ADD PRIMARY KEY (`id_averia`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `FK_reservas_1` (`dni`),
  ADD KEY `FK_reservas_2` (`id_ruta`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `FK_rutas_1` (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `averias`
--
ALTER TABLE `averias`
  MODIFY `id_averia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_ticket` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `averias`
--
ALTER TABLE `averias`
  ADD CONSTRAINT `averias_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `buses` (`matricula`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `clientes` (`dni`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_ruta`) REFERENCES `rutas` (`id_ruta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `FK_rutas_1` FOREIGN KEY (`matricula`) REFERENCES `buses` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
