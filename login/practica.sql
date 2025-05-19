-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-05-2025 a las 02:32:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escaneos`
--

CREATE TABLE `escaneos` (
  `id` int(11) NOT NULL,
  `lista_id` int(11) NOT NULL,
  `codigo_1` varchar(100) DEFAULT NULL,
  `codigo_2` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escaneos`
--

INSERT INTO `escaneos` (`id`, `lista_id`, `codigo_1`, `codigo_2`, `fecha`) VALUES
(4, 1, '123123123123', '21312312312312', '2025-05-02 19:22:02'),
(5, 1, '3123213123213', '13123213123', '2025-05-02 19:22:06'),
(6, 1, '3123123123123', '3123123123123', '2025-05-02 19:22:09'),
(7, 1, '13123123123123', '312321312312312', '2025-05-02 19:22:12'),
(8, 1, '123123123123', '213213123123', '2025-05-02 19:22:15'),
(9, 2, '131290483284903', '1231242141234124', '2025-05-02 21:46:57'),
(10, 2, '321312312312312', '213123123123123', '2025-05-02 21:47:03'),
(11, 2, '321312312312312', '213123123123123', '2025-05-02 21:47:15'),
(12, 3, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-02 21:54:20'),
(13, 3, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-02 21:54:26'),
(15, 8, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-03 10:51:23'),
(16, 8, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-04 00:38:54'),
(17, 8, '131290483284903', '21312312312312', '2025-05-04 00:38:58'),
(18, 9, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-04 00:42:35'),
(21, 13, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-18 18:18:27'),
(22, 13, '123123123123', 'IU3I1O2U3OI12U3', '2025-05-18 18:18:31'),
(23, 12, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-18 18:20:39'),
(24, 12, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-18 18:20:53'),
(25, 12, '131290483284903', 'IU3I1O2U3OI12U3', '2025-05-18 18:20:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE `listas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(6) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listas`
--

INSERT INTO `listas` (`id`, `codigo`, `nombre`, `fecha`) VALUES
(1, '000001', 'Lista 000001', '2025-05-02 19:15:15'),
(2, '000002', 'Lista 000002', '2025-05-02 21:25:52'),
(3, '000003', 'Lista 000003', '2025-05-02 21:29:08'),
(4, '000004', 'Lista 000004', '2025-05-03 10:35:04'),
(5, '000005', 'Lista 000005', '2025-05-03 10:37:58'),
(6, '000006', 'Lista 000006', '2025-05-03 10:43:27'),
(7, '000007', 'Lista 000007', '2025-05-03 10:46:05'),
(8, '000008', 'Lista 000008', '2025-05-03 10:49:42'),
(9, '000009', 'Lista 000009', '2025-05-04 00:42:27'),
(10, '000010', 'Lista 000010', '2025-05-04 19:36:34'),
(11, '000011', 'Lista 000011', '2025-05-04 19:39:19'),
(12, '000012', 'Lista 000012', '2025-05-11 11:50:31'),
(13, '000013', 'Lista 000013', '2025-05-11 11:51:14'),
(14, '000014', 'Lista 000014', '2025-05-18 18:00:39'),
(15, '000015', 'Lista 000015', '2025-05-18 18:00:46'),
(16, '000016', 'Lista 000016', '2025-05-18 18:06:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'rolando', '$2y$10$E3Ccnt4b15khRgX4ZUfmie395eoJqx70BkIx1uCTqrqzVBE.5/yNO'),
(3, '', '$2y$10$KkwyE9y2jWQOXtKlFDSkHeoQ6JgSmFpq82ZkXG0FBuc.D5OR71St2'),
(4, 'Juan', '$2y$10$EMuiZ36a/Xj5uzjNqkDib.8gObHrXLIl/ApE2W.vBiBL5dzsI.ubu'),
(5, 'cgarpi', '$2y$10$JSxGCos5pnVwBXESI8af3.NDhf1UWGZzsvBjANqDT55gDSQppTtc.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `escaneos`
--
ALTER TABLE `escaneos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lista_id` (`lista_id`);

--
-- Indices de la tabla `listas`
--
ALTER TABLE `listas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escaneos`
--
ALTER TABLE `escaneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `listas`
--
ALTER TABLE `listas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `escaneos`
--
ALTER TABLE `escaneos`
  ADD CONSTRAINT `escaneos_ibfk_1` FOREIGN KEY (`lista_id`) REFERENCES `listas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
