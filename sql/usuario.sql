-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2025 a las 23:09:34
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
-- Base de datos: `gec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `fecha` date DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) DEFAULT NULL,
  `img` varchar(100) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `init_sesion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_rol`, `nombre`, `contrasena`, `email`, `fecha`, `telefono`, `fecha_registro`, `fecha_actualizacion`, `estado`, `img`, `id_sucursal`, `ip`, `init_sesion`) VALUES
(1, 1, 'admin', '$2y$10$dom.I6UjqgGNkrhl44c1a.w.xSkObgPh5zolg8TO2vDethyzAeRT6', 'admin@gmail.com', '2024-05-01', '123', '2024-05-31 05:02:02', '2024-09-24 13:46:24', 1, 'tL3hsyvHWF8WyCRagCPR.jpg', NULL, '::1', '2025-02-03 18:33:22');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
