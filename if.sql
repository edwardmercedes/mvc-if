-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-04-2012 a las 21:51:20
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `if`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Caca-Cola'),
(3, 'Pepsi'),
(4, 'Cola Real'),
(5, 'Imperio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `Id_estado` int(2) NOT NULL,
  `id_pago` bigint(20) NOT NULL,
  `tipo` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalles`
--

CREATE TABLE IF NOT EXISTS `factura_detalles` (
  `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factura` bigint(20) NOT NULL,
  `precio` decimal(9,3) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_estados`
--

CREATE TABLE IF NOT EXISTS `factura_estados` (
  `id_estado` int(5) NOT NULL AUTO_INCREMENT,
  `estado` varchar(40) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `factura_estados`
--

INSERT INTO `factura_estados` (`id_estado`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Paga'),
(3, 'cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_pago`
--

CREATE TABLE IF NOT EXISTS `factura_pago` (
  `id_pago` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_factura` bigint(20) NOT NULL,
  `pago` decimal(10,3) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `estado` int(1) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id_items` int(10) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` int(10) NOT NULL,
  `existen` int(10) DEFAULT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`id_items`),
  KEY `fk_id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_items`, `id_categoria`, `nombre`, `precio`, `existen`, `estatus`) VALUES
(8, 1, 'Caca-Cola', 35, 182, 0),
(9, 3, 'Pepsi lata 20 oz', 33, 115, 0),
(10, 1, 'Contry CLub 20 oz', 35, 75, 0),
(11, 1, 'Merengue', 35, 48, 0),
(12, 4, 'ColaReal Roja 20 oz', 27, 200, 0),
(13, 4, 'ColaReal Uva 20 oz', 27, 150, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(5) NOT NULL AUTO_INCREMENT,
  `estado` enum('A','D','C') NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `estado`, `nombre`) VALUES
(1, 'A', 'Julio'),
(2, 'A', 'Edward');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resta`
--

CREATE TABLE IF NOT EXISTS `resta` (
  `id_resta` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` int(5) NOT NULL,
  `precio` decimal(9,3) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resta`),
  KEY `fk_resta_item` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suma`
--

CREATE TABLE IF NOT EXISTS `suma` (
  `id_suma` int(5) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) NOT NULL,
  `id_proveedor` int(5) NOT NULL,
  `fecha` date DEFAULT NULL,
  `precio` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_suma`),
  KEY `fk_suma_item` (`id_item`),
  KEY `fk_suma_proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resta`
--
ALTER TABLE `resta`
  ADD CONSTRAINT `fk_resta_item` FOREIGN KEY (`id_item`) REFERENCES `inventario` (`id_items`) ON DELETE CASCADE;

--
-- Filtros para la tabla `suma`
--
ALTER TABLE `suma`
  ADD CONSTRAINT `fk_suma_item` FOREIGN KEY (`id_item`) REFERENCES `inventario` (`id_items`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_suma_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
