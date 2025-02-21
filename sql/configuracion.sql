-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2025 a las 23:08:54
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
-- Base de datos: `enviarex_enviar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `dato` varchar(60) DEFAULT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `campo` varchar(30) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `dato`, `descripcion`, `campo`, `fecha_registro`, `fecha_actualizacion`, `estado`) VALUES
(1, '0', 'stock_naranja', 'number', '2025-01-26 14:26:52', '2025-01-26 14:26:52', 1),
(2, '5', 'stock_rojo', 'number', '2025-01-26 14:26:52', '2025-01-26 14:26:52', 1),
(3, 'Enviar Express', 'nombre', 'text', '2025-01-26 14:28:07', '2025-01-26 14:28:07', 1),
(4, '#38761d', 'color', 'text', '2025-01-26 14:28:07', '2025-01-26 14:28:07', 1),
(5, 'testcorreo@gmail.com', 'correo', 'text', '2025-01-26 14:28:15', '2025-01-26 14:28:15', 1),
(6, '123', 'contrasena', 'text', '2025-01-26 14:28:15', '2025-01-26 14:28:15', 1),
(7, '777', 'smtp', 'text', '2025-01-26 14:28:15', '2025-01-26 14:28:15', 1),
(8, '27', 'port', 'text', '2025-01-26 14:28:15', '2025-01-26 14:28:15', 1),
(9, 'test@gmail.com', 'correo_entrega', 'email', '2025-02-04 02:48:50', '2025-02-04 02:48:50', 1),
(10, 'test2@gmail.com', 'correo_venta', 'email', '2025-02-04 02:48:50', '2025-02-04 02:48:50', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;