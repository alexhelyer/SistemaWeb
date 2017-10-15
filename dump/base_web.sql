-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2017 a las 05:38:36
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `nombre_adm` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos_adm` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_adm` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pass_adm` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `date_login` datetime NOT NULL,
  `date_logout` datetime NOT NULL,
  `correo_adm` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_adm`, `nombre_adm`, `apellidos_adm`, `tipo`, `usuario_adm`, `pass_adm`, `date_login`, `date_logout`, `correo_adm`) VALUES
(1, 'Administrador', 'Sistema', 'root', 'administrador', '81dc9bdb52d04dc20036dbd8313ed055', '2017-10-14 22:36:33', '2017-10-14 23:00:33', 'alexhelyer7@gmail.com'),
(2, 'Alejandro', 'Martinez', 'root', 'alexmtz', '534b44a19bf18d20b71ecc4eb77c572f', '2017-09-04 01:08:44', '2017-08-01 00:00:00', 'alexhelyer7@gmail.com'),
(3, 'Jair', 'Moreno', 'root', 'jairmg', '03e6dd4fe209818a8609a7879436c75a', '2017-09-04 01:08:57', '2017-08-01 00:00:00', 'jair.mg.27@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `usuario`, `correo`, `password`, `nombre`, `genero`, `localidad`, `edad`, `fecha_registro`) VALUES
(1, 'jair', 'jair.mg.27@gmail.com', '1234', 'jair', 'masculino', 'mexico', 12, '2017-05-01'),
(2, 'alejandra', 'ale@hotmail.com', '1234', 'alejandra', 'femenino', 'cdmx', 12, '2017-05-05'),
(3, 'diego', 'diego@hotmail.com', 'sfasdf', 'diego', 'masculino', 'cdmx', 14, '2017-09-03'),
(4, 'paulina', 'pau@hotmail.com', 'sdfas', 'pau', 'femenino', 'bajacalifornias', 13, '2017-05-12'),
(5, 'diana', 'diana@hotmail.com', '1234', 'diana', 'femenino', 'veracruz', 11, '2017-05-15'),
(6, 'peimbert', 'erick@hotmail.com', '12345', 'erick', 'masculino', 'oaxaca', 15, '2017-05-19'),
(7, 'manolo', 'mano@hotmail.com', '1234', 'manolo', 'masculino', 'veracruz', 11, '2017-05-22');

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
(1, 0, '2+2', '4', '1', '2', '3', '5'),
(2, 1, 'esto', 'res', 'opc1', 'opc2', 'opc3', 'op4 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivos`
--

CREATE TABLE `reactivos` (
  `id_reactivo` int(11) NOT NULL,
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reactivos`
--

INSERT INTO `reactivos` (`id_reactivo`, `tipo`) VALUES
(1, 'falso verdadero'),
(2, 'opcion multiple'),
(3, 'opcion abierta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivo_abierto`
--

CREATE TABLE `reactivo_abierto` (
  `id_reactivo_abierto` int(11) NOT NULL,
  `tema` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `subtema` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `grado` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `reactivo` varchar(254) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` float NOT NULL,
  `visto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reactivo_abierto`
--

INSERT INTO `reactivo_abierto` (`id_reactivo_abierto`, `tema`, `subtema`, `grado`, `nivel`, `reactivo`, `respuesta`, `visto`, `fecha`) VALUES
(4, 'aritmetica', 'decimales', 1, 1, 'Cuanto es 1.1 mas 2.3', 3.4, 0, '2017-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivo_multiple`
--

CREATE TABLE `reactivo_multiple` (
  `id_reactivo_multiple` int(11) NOT NULL,
  `tema` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `subtema` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `grado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `reactivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `incorrecta1` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `incorrecta2` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `incorrecta3` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `visto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reactivo_multiple`
--

INSERT INTO `reactivo_multiple` (`id_reactivo_multiple`, `tema`, `subtema`, `grado`, `nivel`, `reactivo`, `respuesta`, `incorrecta1`, `incorrecta2`, `incorrecta3`, `visto`, `fecha`) VALUES
(3, 'aritmetica', 'decimales', '1', 1, '2.3 + 3.5', '5.8', '4.8', '5.3', '3.9', 0, '2017-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivo_verdadero_falso`
--

CREATE TABLE `reactivo_verdadero_falso` (
  `id_reactivo_vf` int(11) NOT NULL,
  `tema` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `subtema` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `reactivo` varchar(254) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` int(11) NOT NULL,
  `visto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `reactivo_verdadero_falso`
--

INSERT INTO `reactivo_verdadero_falso` (`id_reactivo_vf`, `tema`, `subtema`, `grado`, `nivel`, `reactivo`, `respuesta`, `visto`, `fecha`) VALUES
(15, 'aritmetica', 'decimales', 1, 1, '2 + 1 = 3 ?', 1, 0, '2017-09-01'),
(13, 'aritmetica', 'decimales', 1, 1, '2 + 2 = 5 ?', 0, 0, '2017-09-01'),
(14, 'aritmetica', 'decimales', 1, 1, '2 + 2 = 4 ?', 1, 0, '2017-09-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reactivos`
--
ALTER TABLE `reactivos`
  ADD PRIMARY KEY (`id_reactivo`);

--
-- Indices de la tabla `reactivo_abierto`
--
ALTER TABLE `reactivo_abierto`
  ADD PRIMARY KEY (`id_reactivo_abierto`);

--
-- Indices de la tabla `reactivo_multiple`
--
ALTER TABLE `reactivo_multiple`
  ADD PRIMARY KEY (`id_reactivo_multiple`);

--
-- Indices de la tabla `reactivo_verdadero_falso`
--
ALTER TABLE `reactivo_verdadero_falso`
  ADD PRIMARY KEY (`id_reactivo_vf`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reactivo_abierto`
--
ALTER TABLE `reactivo_abierto`
  MODIFY `id_reactivo_abierto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reactivo_multiple`
--
ALTER TABLE `reactivo_multiple`
  MODIFY `id_reactivo_multiple` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reactivo_verdadero_falso`
--
ALTER TABLE `reactivo_verdadero_falso`
  MODIFY `id_reactivo_vf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
