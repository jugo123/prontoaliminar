-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-06-2024 a las 13:01:56
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cargas_familiares`
--

INSERT INTO `cargas_familiares` (`id`, `trabajador_id`, `nombre`, `parentesco`, `genero`, `rut`) VALUES
(48, 48, 'kim', 'prima', 'Femenino', '12.234.422-2'),
(45, 45, '', '', '', ''),
(47, 47, '', '', '', ''),
(49, 49, 'sapolio', 'calzado', 'Masculino', '12.234.422-2'),
(50, 29, 'pim', 'amigo', 'Masculino', '19.999.333-4');

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
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contactos_emergencia`
--

INSERT INTO `contactos_emergencia` (`id`, `trabajador_id`, `nombre`, `relacion`, `telefono`) VALUES
(57, 48, 'opa', 'eco', 'tambien'),
(56, 48, 'sexy to somebody', 'house', '13'),
(54, 49, 'asd', 'asdas', 'asdasd'),
(58, 29, 'pim', 'amigo', '222222222222');

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
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_laborales`
--

INSERT INTO `datos_laborales` (`id`, `trabajador_id`, `cargo`, `fecha_ingreso`, `area`, `departamento`) VALUES
(60, 48, 'puta', '2024-06-07', 'sorra', 'vunt'),
(2, 2, 'recursos inhumanos ', '2024-02-15', 'Departamento de Reclutamiento y Selección', 'HHRR'),
(29, 29, 'recepcionistas', '2024-06-06', 'oncologia', 'admin'),
(61, 49, 'Profesora', '2024-06-23', 'Serving cunt', 'tens');

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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `nombre`, `rut`, `genero`, `direccion`, `telefono`) VALUES
(50, 'admin', '20.994.432-3', 'Masculino', 'fake streeth #123', '222'),
(48, 'perrota', '20.200.200-1', 'Masculino', 'que era esto?', '344333'),
(49, 'elsapito', '12.322.333-3', 'Femenino', 'fake streeth #123', '9999993');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `correo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rut`, `contrasena`, `correo`) VALUES
(2, '20.200.200-2', 'asd123', 'tuki@gmail.com'),
(48, '20.200.200-1', 'asd123', 'cosas@gmail.com'),
(49, '12.322.333-3', 'asd123', 'cositas@gmail.com'),
(29, '20.994.432-3', 'asd123', 'pumba@gmail.com'),
(50, '', 'cargador1', 'pablo@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
