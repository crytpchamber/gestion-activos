-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 14:01:49
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--
DROP DATABASE `mydb`;
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

DROP TABLE IF EXISTS `activos`;
CREATE TABLE IF NOT EXISTS `activos` (
  `idActivos` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `tiempo_depre` int(11) NOT NULL DEFAULT '0',
  `valor_adquisicion` decimal(18,3) NOT NULL DEFAULT '0.000',
  `fecha_registro` date NOT NULL,
  `fecha_ini_deprec` date NOT NULL,
  `codActivo` varchar(100) NOT NULL,
  `serial` varchar(45) NOT NULL,
  `estado` char(1) NOT NULL,
  `ubicacion_idUbicacion` int(11) NOT NULL,
  `categorias_idCategoria` int(11) NOT NULL,
  `idSubCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idActivos`),
  KEY `fk_activos_ubicacion1_idx` (`ubicacion_idUbicacion`),
  KEY `Categoria_idCategoria` (`categorias_idCategoria`),
  KEY `idSubCategoria` (`idSubCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`idActivos`, `Descripcion`, `fecha_adquisicion`, `tiempo_depre`, `valor_adquisicion`, `fecha_registro`, `fecha_ini_deprec`, `codActivo`, `serial`, `estado`, `ubicacion_idUbicacion`, `categorias_idCategoria`, `idSubCategoria`) VALUES
(1, 'Laptop Dell E6510', '2016-03-15', 6, '250001.000', '2016-10-07', '2011-04-14', '', '', 'A', 2, 2, 1),
(2, 'prueba', '2016-11-13', 3, '123123.000', '2016-11-13', '2016-11-13', '1luyhq', '12345', 'A', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `Descripcion`) VALUES
(1, 'Maquinarias'),
(2, 'Teconologicos'),
(3, 'Articulos de Oficina'),
(4, 'Servicios Generales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_acceso`
--

DROP TABLE IF EXISTS `mapas_acceso`;
CREATE TABLE IF NOT EXISTS `mapas_acceso` (
  `idmapas_acceso` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `puedeEliminar` tinyint(1) DEFAULT NULL,
  `puedeModificar` tinyint(1) DEFAULT NULL,
  `puedeGuardar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idmapas_acceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mapas_acceso`
--

INSERT INTO `mapas_acceso` (`idmapas_acceso`, `Descripcion`, `puedeEliminar`, `puedeModificar`, `puedeGuardar`) VALUES
(0, 'SuperUsuario', 1, 1, 1),
(1, 'Auditor', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `idmodulos` int(11) NOT NULL,
  `descModulo` varchar(45) DEFAULT NULL,
  `mapas_acceso_idmapas_acceso` int(11) NOT NULL,
  `ubicacion` tinyint(4) DEFAULT '0',
  `sucursal` tinyint(4) DEFAULT '0',
  `activos` tinyint(4) DEFAULT '0',
  `responsable` tinyint(4) DEFAULT '0',
  `categorias` int(11) NOT NULL,
  PRIMARY KEY (`idmodulos`),
  KEY `fk_modulos_mapas_acceso1_idx` (`mapas_acceso_idmapas_acceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idmodulos`, `descModulo`, `mapas_acceso_idmapas_acceso`, `ubicacion`, `sucursal`, `activos`, `responsable`, `categorias`) VALUES
(1, 'SuperUsuario', 0, 1, 1, 1, 1, 1),
(2, 'Auditor', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistasauditoria`
--

DROP TABLE IF EXISTS `pistasauditoria`;
CREATE TABLE IF NOT EXISTS `pistasauditoria` (
  `idpistasAuditoria` int(11) NOT NULL,
  `fechaPista` date DEFAULT NULL,
  `tipo_operacion` char(1) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpistasAuditoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pistasauditoria`
--

INSERT INTO `pistasauditoria` (`idpistasAuditoria`, `fechaPista`, `tipo_operacion`, `modulo`, `observacion`, `usuario`) VALUES
(18, '2016-10-29', 'I', 'Categorias', 'Se registro la categoria: 4. ', 41),
(19, '2016-10-29', 'E', 'Categorias', 'Se elimino la categoria: 4. ', 41),
(20, '2016-10-29', 'I', 'Sub-Categorias', 'Se registro la Sub-Categoria: 3. ', 41),
(21, '2016-10-29', 'E', 'Sub-Categoria', 'Se elimino la Sub-Categoria: 3. ', 41),
(22, '2016-10-29', 'I', 'Ubicaciones', 'se registro la Sucursal: 3', 41),
(23, '2016-10-29', 'E', 'Ubicaciones', 'se elimino la Ubicacion: 3', 41),
(24, '2016-10-29', 'I', 'Sucursales', 'se registro la Sucursal: 4', 41),
(25, '2016-10-29', 'E', 'Sucursales', 'se elimino la Sucursal: 4', 41),
(26, '2016-10-29', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(27, '2016-10-29', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(28, '2016-10-29', 'I', 'Activos', 'se registro el activo: 124', 41),
(29, '2016-10-29', 'M', 'Activos', 'Se modifico la fecha de adquisicion de 2016-10-26 -> 2016-10-25. ', 41),
(30, '2016-10-29', 'I', 'Gestion de Activos', 'se registro la Asignacion de Activo: 2', 41),
(31, '2016-10-29', 'E', 'Gestion de Activos', 'se elimino la Asignacion de Activo: 2', 41),
(32, '2016-10-29', 'E', 'Activos', 'se elimino el Activo: 3', 41),
(33, '2016-11-03', 'E', 'Activos', 'se elimino el Activo: 2', 41),
(34, '2016-11-03', 'I', 'Activos', 'se registro el activo: 123456', 41),
(35, '2016-11-03', 'I', 'Activos', 'se registro el activo: 1234567', 41),
(36, '2016-11-03', 'E', 'Sucursales', 'se elimino la Sucursal: 3', 41),
(37, '2016-11-07', 'I', 'Ubicaciones', 'se registro la Sucursal: 3', 41),
(38, '2016-11-07', 'I', 'Categorias', 'Se registro la categoria: 4. ', 41),
(39, '2016-11-07', 'I', 'Sub-Categorias', 'Se registro la Sub-Categoria: 3. ', 41),
(40, '2016-11-07', 'I', 'Activos', 'se registro el activo: prueba1', 41),
(41, '2016-11-12', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(42, '2016-11-12', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(43, '2016-11-12', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(44, '2016-11-12', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(45, '2016-11-12', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(46, '2016-11-12', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(47, '2016-11-12', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(48, '2016-11-12', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(49, '2016-11-12', 'I', 'Activos', 'se registro el activo: 1luyhq', 41),
(50, '2016-11-12', 'E', 'Sucursales', 'se elimino la Sucursal: 2', 41),
(51, '2016-11-12', 'I', 'Sucursales', 'se registro la Sucursal: 2', 41),
(52, '2016-11-12', 'E', 'Categorias', 'Se elimino la categoria: 1. ', 41),
(53, '2016-11-12', 'I', 'Categorias', 'Se registro la categoria: 5. ', 41),
(54, '2016-11-12', 'E', 'Activos', 'se elimino el Activo: 5', 41),
(55, '2016-11-12', 'E', 'Activos', 'se elimino el Activo: 4', 41),
(56, '2016-11-12', 'E', 'Activos', 'se elimino el Activo: 3', 41),
(57, '2016-11-12', 'E', 'Activos', 'se elimino el Activo: 2', 41),
(58, '2016-11-13', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(59, '2016-11-13', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(60, '2016-11-13', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(61, '2016-11-13', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(62, '2016-11-13', 'I', 'Responsables', 'se registro el Responsable: 2', 41),
(63, '2016-11-13', 'E', 'Responsables', 'se elimino el Responsable: 2', 41),
(64, '2016-11-13', 'I', 'Sucursales', 'se registro la Sucursal: 3', 41),
(65, '2016-11-13', 'E', 'Sucursales', 'se elimino la Sucursal: 3', 41),
(66, '2016-11-13', 'I', 'Sucursales', 'se registro la Sucursal: 3', 41),
(67, '2016-11-13', 'E', 'Sucursales', 'se elimino la Sucursal: 3', 41),
(68, '2016-11-13', 'I', 'Activos', 'se registro el activo: 1luyhq', 41),
(69, '2016-11-13', 'E', 'Activos', 'se elimino el Activo: 2', 41),
(70, '2016-11-13', 'I', 'Activos', 'se registro el activo: 1luyhq', 41),
(71, '2016-11-13', 'I', 'Categorias', 'Se registro la categoria: 5. ', 41),
(72, '2016-11-13', 'E', 'Categorias', 'Se elimino la categoria: 5. ', 41),
(73, '2016-11-13', 'I', 'Sub-Categorias', 'Se registro la Sub-Categoria: 4. ', 41),
(74, '2016-11-13', 'E', 'Sub-Categoria', 'Se elimino la Sub-Categoria: 4. ', 41),
(75, '2016-11-13', 'I', 'Sub-Categorias', 'Se registro la Sub-Categoria: 4. ', 41),
(76, '2016-11-13', 'E', 'Sub-Categoria', 'Se elimino la Sub-Categoria: 4. ', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionactivos`
--

DROP TABLE IF EXISTS `relacionactivos`;
CREATE TABLE IF NOT EXISTS `relacionactivos` (
  `idRelacionActivos` int(11) NOT NULL,
  `Activos_idActivos` int(11) NOT NULL,
  `Resposable_idResposable` int(11) NOT NULL,
  PRIMARY KEY (`idRelacionActivos`),
  KEY `fk_RelacionActivos_Activos1_idx` (`Activos_idActivos`),
  KEY `fk_RelacionActivos_Resposable1_idx` (`Resposable_idResposable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relacionactivos`
--

INSERT INTO `relacionactivos` (`idRelacionActivos`, `Activos_idActivos`, `Resposable_idResposable`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resposable`
--

DROP TABLE IF EXISTS `resposable`;
CREATE TABLE IF NOT EXISTS `resposable` (
  `idResposable` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Cedula` varchar(15) DEFAULT NULL,
  `ubicacion_idUbicacion` int(11) NOT NULL,
  PRIMARY KEY (`idResposable`),
  KEY `fk_resposable_ubicacion1_idx` (`ubicacion_idUbicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resposable`
--

INSERT INTO `resposable` (`idResposable`, `Nombre`, `Apellido`, `Cedula`, `ubicacion_idUbicacion`) VALUES
(1, 'Carlos', 'Bermudez', 'V-15.060.580', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `idSubCategoria` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idSubCategoria`),
  KEY `Categoria_idCategoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idSubCategoria`, `Descripcion`, `idCategoria`) VALUES
(1, 'Laptop', 2),
(2, 'Articulos de Oficina', 3),
(3, 'Microondas', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idsucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `Descripcion`) VALUES
(1, 'Region Occidente'),
(2, 'Region Centro-Occidente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idTipo_Usuario` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `modulos_idmodulos` int(11) NOT NULL,
  PRIMARY KEY (`idTipo_Usuario`),
  KEY `fk_Tipo_Usuario_modulos1_idx` (`modulos_idmodulos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idTipo_Usuario`, `descripcion`, `modulos_idmodulos`) VALUES
(0, 'Super Usuario', 1),
(1, 'Auditor', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
CREATE TABLE IF NOT EXISTS `ubicacion` (
  `idUbicacion` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `sucursal_idsucursal` int(11) NOT NULL,
  PRIMARY KEY (`idUbicacion`),
  KEY `fk_Ubicacion_sucursal_idx` (`sucursal_idsucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `Descripcion`, `sucursal_idsucursal`) VALUES
(1, 'Administracion Occidente', 1),
(2, 'TI Occidente', 1),
(3, 'Base', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Cedula` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `Tipo_Usuario_idTipo_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `fk_Usuarios_Tipo_Usuario1_idx` (`Tipo_Usuario_idTipo_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `usuario`, `clave`, `Nombre`, `Apellido`, `Cedula`, `foto`, `Tipo_Usuario_idTipo_Usuario`) VALUES
(41, 'admin', 'admin', 'Carlos', 'Bermudez', 'V-15.060.580', 'carlos.jpg', 0),
(42, 'dchavez', '123', 'Daniel', 'Chavez', '2398334', 'default.jpg', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activos`
--
ALTER TABLE `activos`
  ADD CONSTRAINT `fk_activos_categorias1` FOREIGN KEY (`categorias_idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activos_subcategoria1` FOREIGN KEY (`idSubCategoria`) REFERENCES `subcategoria` (`idSubCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activos_ubicacion1` FOREIGN KEY (`ubicacion_idUbicacion`) REFERENCES `ubicacion` (`idUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `fk_modulos_mapas_acceso1` FOREIGN KEY (`mapas_acceso_idmapas_acceso`) REFERENCES `mapas_acceso` (`idmapas_acceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `relacionactivos`
--
ALTER TABLE `relacionactivos`
  ADD CONSTRAINT `fk_RelacionActivos_Activos1` FOREIGN KEY (`Activos_idActivos`) REFERENCES `activos` (`idActivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RelacionActivos_Resposable1` FOREIGN KEY (`Resposable_idResposable`) REFERENCES `resposable` (`idResposable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resposable`
--
ALTER TABLE `resposable`
  ADD CONSTRAINT `fk_resposable_ubicacion1` FOREIGN KEY (`ubicacion_idUbicacion`) REFERENCES `ubicacion` (`idUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subcategoria_categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD CONSTRAINT `fk_Tipo_Usuario_modulos1` FOREIGN KEY (`modulos_idmodulos`) REFERENCES `modulos` (`idmodulos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD CONSTRAINT `fk_Ubicacion_sucursal` FOREIGN KEY (`sucursal_idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Usuarios_Tipo_Usuario1` FOREIGN KEY (`Tipo_Usuario_idTipo_Usuario`) REFERENCES `tipo_usuario` (`idTipo_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
