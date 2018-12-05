-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2018 a las 17:15:11
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pf_agenda_php`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardarNuevoUsuario` (IN `id` TINYINT(4), IN `email` VARCHAR(100), IN `nombre` VARCHAR(100), IN `password` VARCHAR(100))  BEGIN
	INSERT INTO usuarios values(id,email,nombre,password);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` tinyint(4) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `ini` date NOT NULL,
  `fin` date DEFAULT NULL,
  `ini_hora` time DEFAULT NULL,
  `fin_hora` time DEFAULT NULL,
  `dia_completo` varchar(1) DEFAULT NULL,
  `id_usuario` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `ini`, `fin`, `ini_hora`, `fin_hora`, `dia_completo`, `id_usuario`) VALUES
(3, 'cita', '2018-11-22', '2018-11-22', '00:00:00', '05:30:00', '0', 2),
(4, 'cita', '2018-12-05', '2018-12-05', '07:00:00', '07:30:00', '0', 3),
(8, 'prueba', '2018-12-13', NULL, '00:00:00', NULL, '1', 1),
(11, 'mar', '2018-12-08', '2018-12-08', '07:00:00', '09:00:00', '0', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` tinyint(4) NOT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nombre`, `password`) VALUES
(1, 'juanp@gmail.com', 'Juan Pablo Perez', '202cb962ac59075b964b07152d234b70'),
(2, 'daniflores@gmail.com', 'Daniela Flores Rico', '202cb962ac59075b964b07152d234b70'),
(3, 'eliasp@hotmail.com', 'Elias Perez', '202cb962ac59075b964b07152d234b70');
-- El password encriptado corresponde a '123'
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_evento_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_evento_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
