-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2017 a las 06:24:08
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `reactivo` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `opc1` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `opc2` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `opc3` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `opc4` varchar(90) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `tipo`, `reactivo`, `respuesta`, `opc1`, `opc2`, `opc3`, `opc4`) VALUES
(1, 1, 'esto', 'res', 'opc1', 'opc2', 'opc3', 'op4 2222'),
(2, 1, 'esto', 'res', 'opc1', 'opc2', 'opc3', '111op4 2'),
(3, 0, '', '', '', '', '', ''),
(4, 0, '', '', '', '', '', ''),
(5, 0, '', '', '', '', '', ''),
(6, 0, '', '', '', '', '', ''),
(7, 0, '', '', '', '', '', ''),
(8, 0, '', '', '', '', '', ''),
(9, 0, '', '', '', '', '', ''),
(10, 0, '', '', '', '', '', ''),
(11, 0, '', '', '', '', '', ''),
(12, 0, '', '', '', '', '', ''),
(13, 0, '', '', '', '', '', ''),
(14, 0, '', '', '', '', '', ''),
(15, 0, '', '', '', '', '', ''),
(16, 0, '', '', '', '', '', ''),
(17, 0, '', '', '', '', '', ''),
(18, 0, '', '', '', '', '', ''),
(19, 0, '', '', '', '', '', ''),
(20, 0, '', '', '', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
