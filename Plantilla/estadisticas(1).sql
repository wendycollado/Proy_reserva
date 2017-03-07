-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2016 a las 03:54:40
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `estadisticas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

CREATE TABLE IF NOT EXISTS `campeonato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaInicio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechaClausura` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `anio` int(11) NOT NULL,
  `categoria` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`id`, `nombre`, `fechaInicio`, `fechaClausura`, `anio`, `categoria`) VALUES
(1, 'PRIMERA DE HONOR', '2016-06-19', '2017-06-23', 2016, 'DAMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `rama` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `fecha`, `rama`, `color`) VALUES
(1, 'MILLENIUM', '10/02/2005', 'DAMAS', 'NARANJA Y PLOMO'),
(2, 'ORCA', '23/09/2010', 'DAMAS', 'AMARILLO Y VERDE'),
(3, 'UPSA', '23/03/2005', 'DAMAS', 'CELESTE'),
(4, 'UDABOL', '22/04/2006', 'DAMAS', 'ROJO Y NEGRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE IF NOT EXISTS `estadistica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simple` int(11) NOT NULL,
  `tci1` int(11) DEFAULT NULL,
  `doble` int(11) NOT NULL,
  `tci2` int(11) DEFAULT NULL,
  `triple` int(11) NOT NULL,
  `tci3` int(11) DEFAULT NULL,
  `faltaRecibida` int(11) DEFAULT NULL,
  `faltaCometida` int(11) DEFAULT NULL,
  `perdidaBalon` int(11) DEFAULT NULL,
  `asistencia` int(11) DEFAULT NULL,
  `reboteDef` int(11) DEFAULT NULL,
  `reboteOfe` int(11) DEFAULT NULL,
  `partido` int(11) DEFAULT NULL,
  `jugador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_estadistica` (`partido`),
  KEY `FK_estadistica1` (`jugador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `estadistica`
--

INSERT INTO `estadistica` (`id`, `simple`, `tci1`, `doble`, `tci2`, `triple`, `tci3`, `faltaRecibida`, `faltaCometida`, `perdidaBalon`, `asistencia`, `reboteDef`, `reboteOfe`, `partido`, `jugador`) VALUES
(1, 1, 2, 1, 3, 2, 2, 2, 3, 4, 5, 1, 2, 1, 1),
(2, 2, 4, 6, 7, 1, 3, 4, 3, 2, 2, 3, 2, 1, 2),
(4, 2, 3, 1, 1, 2, 3, 1, 4, 3, 0, 0, 0, 1, 3),
(5, 0, 1, 3, 4, 0, 1, 3, 2, 2, 3, 0, 1, 1, 4),
(6, 1, 1, 2, 3, 1, 1, 2, 4, 2, 5, 0, 3, 1, 17),
(7, 1, 3, 3, 4, 3, 3, 4, 5, 1, 4, 2, 1, 1, 5),
(8, 0, 1, 1, 3, 3, 4, 3, 1, 2, 3, 1, 2, 1, 6),
(9, 2, 2, 4, 6, 2, 2, 5, 2, 2, 5, 0, 1, 1, 7),
(10, 0, 2, 3, 4, 1, 1, 3, 2, 1, 3, 0, 0, 1, 8),
(11, 4, 5, 0, 2, 1, 4, 1, 4, 2, 0, 1, 1, 1, 18),
(12, 3, 3, 1, 2, 0, 1, 0, 3, 0, 2, 0, 2, 2, 9),
(13, 0, 0, 0, 2, 2, 3, 2, 2, 1, 2, 1, 0, 2, 10),
(14, 5, 5, 2, 3, 1, 3, 3, 3, 1, 5, 1, 1, 2, 11),
(15, 0, 1, 1, 3, 2, 2, 1, 2, 2, 1, 0, 0, 2, 12),
(16, 1, 1, 0, 3, 1, 2, 1, 4, 3, 1, 2, 3, 2, 19),
(17, 0, 0, 0, 0, 1, 2, 0, 1, 0, 0, 0, 1, 2, 13),
(18, 2, 2, 1, 3, 2, 2, 2, 2, 1, 0, 0, 1, 2, 14),
(19, 3, 4, 0, 0, 1, 1, 1, 1, 0, 2, 1, 0, 2, 15),
(20, 0, 2, 0, 1, 2, 3, 1, 3, 0, 0, 0, 1, 2, 16),
(23, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, 1, 2, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campeonato` int(11) NOT NULL,
  `equipo` int(11) NOT NULL,
  `fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`,`campeonato`,`equipo`),
  KEY `campeonato` (`campeonato`),
  KEY `idequipo` (`equipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `campeonato`, `equipo`, `fecha`) VALUES
(1, 1, 1, '16/06/2016'),
(2, 1, 2, '17/06/2016'),
(3, 1, 3, '17/06/2016'),
(4, 1, 4, '18/06/2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE IF NOT EXISTS `jugador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanac` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` int(11) DEFAULT NULL,
  `nrocamiseta` int(11) DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `equipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idequipo` (`equipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id`, `nombre`, `fechanac`, `ci`, `nrocamiseta`, `estado`, `fecha`, `equipo`) VALUES
(1, 'MARIOLY JIMENEZ', '1987-11-20', 1000558, 4, 'ACTIVO', '2016-06-16', 1),
(2, 'GABRIELA PEREIRA', '1990-03-13', 1000024, 9, 'ACTIVO', '2016-06-16', 1),
(3, 'CLEDY CARDOZO', '1989-05-22', 1000157, 11, 'ACTIVO', '2016-06-16', 1),
(4, 'MARIA ARGENTINA MORON', '1989-10-01', 4311456, 6, 'ACTIVO', '2016-06-16', 1),
(5, 'LILIANA CASTELLON', '1989-07-22', 1000007, 10, 'ACTIVO', '2016-06-17', 2),
(6, 'DALMA BALCAZAR', '1992-11-02', 1000026, 4, 'ACTIVO', '2016-06-17', 2),
(7, 'ANA MARIA VIERA', '1987-10-16', 1060020, 8, 'ACTIVO', '2016-06-17', 2),
(8, 'CRISTINA PAZ', '1989-08-23', 10005454, 12, 'ACTIVO', '2016-06-17', 2),
(9, 'ALICIA FERNANDEZ', '1986-12-11', 1000184, 13, 'ACTIVO', '2016-06-17', 3),
(10, 'FERNANDA GUTIERREZ', '1993-01-25', 1232892, 11, 'ACTIVO', '2016-06-17', 3),
(11, 'ANDREA CARRANZA', '1993-04-12', 6456543, 12, 'ACTIVO', '2016-06-17', 3),
(12, 'ANDREA FERRUFINO', '1989-01-01', 10230000, 14, 'ACTIVO', '2016-06-18', 3),
(13, 'YANINE CUELLAR', '1999-09-21', 24340017, 12, 'ACTIVO', '2016-06-18', 4),
(14, 'PAMELA ZAMBRANA', '1998-03-28', 10032434, 2, 'ACTIVO', '2016-06-18', 4),
(15, 'BRENDA BUSTAMANTE', '1995-11-09', 63243423, 4, 'ACTIVO', '2016-06-18', 4),
(16, 'LILIANA CARDONA', '1987-12-14', 6456456, 10, 'ACTIVO', '2016-06-18', 4),
(17, 'LORENA GUTIERREZ LOPEZ', '1987-11-25', 5465768, 5, 'ACTIVO', '2016-06-19', 1),
(18, 'MARTA LOZANO RUIZ', '1995-08-20', 6577898, 9, 'ACTIVO', '2016-06-19', 2),
(19, 'BELINDA RODRIGUEZ SOLIZ', '1997-07-11', 8799878, 10, 'ACTIVO', '2016-06-19', 3),
(20, 'FABIOLA ROJAS ROMERO', '1988-10-29', 6587769, 8, 'ACTIVO', '2016-06-19', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `resultadoA` int(11) NOT NULL,
  `resultadoB` int(11) NOT NULL,
  `equipoA` int(11) NOT NULL,
  `equipoB` int(11) NOT NULL,
  `campeonato` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipoA` (`equipoA`),
  KEY `equipoB` (`equipoB`),
  KEY `idcampeonato` (`campeonato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `fecha`, `hora`, `resultadoA`, `resultadoB`, `equipoA`, `equipoB`, `campeonato`) VALUES
(1, '2016-06-19', '19:00', 50, 59, 1, 2, 1),
(2, '2016-06-19', '20:00', 35, 28, 3, 4, 1),
(3, '2016-06-23', '19:00', 0, 0, 2, 3, 1),
(4, '2016-06-23', '20:00', 0, 0, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_ganado` int(11) NOT NULL,
  `p_perdido` int(11) NOT NULL,
  `pto_contra` int(11) NOT NULL,
  `pto_favor` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `equipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ranking` (`equipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`id`, `p_ganado`, `p_perdido`, `pto_contra`, `pto_favor`, `puntos`, `equipo`) VALUES
(1, 0, 1, 9, 50, 2, 1),
(2, 1, 0, 0, 59, 2, 2),
(3, 1, 0, 0, 35, 2, 3),
(4, 0, 1, 7, 28, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE IF NOT EXISTS `resultado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiro` float NOT NULL,
  `defensivo` float NOT NULL,
  `ofensivo` float NOT NULL,
  `libres` float NOT NULL,
  `faltas` float NOT NULL,
  `controlB` float NOT NULL,
  `jugador` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `partido` int(11) NOT NULL,
  `estadistica` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `resultado`
--

INSERT INTO `resultado` (`id`, `tiro`, `defensivo`, `ofensivo`, `libres`, `faltas`, `controlB`, `jugador`, `partido`, `estadistica`) VALUES
(1, 9, 0.11, 0.17, 0.5, 0.67, 1.25, 'MARIOLY JIMENEZ', 1, 1),
(2, 17, 0.33, 0.16, 1, 1.33, 1, 'GABRIELA PEREIRA', 1, 2),
(3, 10, 0, 0.08, 1.33, 0.25, 0, 'CLEDY CARDOZO', 1, 3),
(4, 6, 0, 0, 0, 1.5, 1.5, 'MARIA ARGENTINA MORON', 1, 4),
(5, 8, 0, 0.25, 1, 0.5, 2.5, 'LORENA GUTIERREZ', 1, 5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD CONSTRAINT `FK_estadistica` FOREIGN KEY (`partido`) REFERENCES `partido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_estadistica1` FOREIGN KEY (`jugador`) REFERENCES `jugador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `campeonato` FOREIGN KEY (`campeonato`) REFERENCES `campeonato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idequipo` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `equipo` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `equipoA` FOREIGN KEY (`equipoA`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `equipoB` FOREIGN KEY (`equipoB`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idcampeonato` FOREIGN KEY (`campeonato`) REFERENCES `campeonato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `FK_ranking` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
