-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-06-2024 a las 20:30:49
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargas_familiares`
--

DROP TABLE IF EXISTS `cargas_familiares`;
CREATE TABLE IF NOT EXISTS `cargas_familiares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trabajador_id` int DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `parentesco` varchar(255) NOT NULL,
  `genero` enum('Masculino','Femenino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rut` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trabajador_id` (`trabajador_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cargas_familiares`
--

INSERT INTO `cargas_familiares` (`id`, `trabajador_id`, `nombre`, `parentesco`, `genero`, `rut`) VALUES
(46, 46, 'wqe', 'wqr', 'Masculino', '908765432'),
(45, 45, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_emergencia`
--

DROP TABLE IF EXISTS `contactos_emergencia`;
CREATE TABLE IF NOT EXISTS `contactos_emergencia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trabajador_id` int DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `relacion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trabajador_id` (`trabajador_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contactos_emergencia`
--

INSERT INTO `contactos_emergencia` (`id`, `trabajador_id`, `nombre`, `relacion`, `telefono`) VALUES
(46, 46, 'wqee', 'wwrqwr', '214'),
(45, 45, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_laborales`
--

DROP TABLE IF EXISTS `datos_laborales`;
CREATE TABLE IF NOT EXISTS `datos_laborales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trabajador_id` int DEFAULT NULL,
  `cargo` varchar(255) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `area` varchar(255) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trabajador_id` (`trabajador_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_laborales`
--

INSERT INTO `datos_laborales` (`id`, `trabajador_id`, `cargo`, `fecha_ingreso`, `area`, `departamento`) VALUES
(58, 46, 'dsf', '1111-11-11', 'gh', 'gh'),
(57, 45, '', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

DROP TABLE IF EXISTS `datos_personales`;
CREATE TABLE IF NOT EXISTS `datos_personales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `rut` varchar(20) NOT NULL,
  `genero` enum('Masculino','Femenino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `nombre`, `rut`, `genero`, `direccion`, `telefono`) VALUES
(46, 'asd', '908765432', 'Masculino', 'asd', '234'),
(45, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rut`, `contrasena`) VALUES
(1, '', '$2y$10$0aLMq/pT4uD86Kb0Dm.1nOZocDEj00ZmINxodMs3U6mPjkcW5Jfvm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
