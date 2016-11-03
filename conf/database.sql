-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2016 a las 14:31:18
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
CREATE TABLE `activos` (
  `idActivos` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `tiempo_depre` int(11) NOT NULL DEFAULT '0',
  `valor_adquisicion` decimal(18,3) NOT NULL DEFAULT '0.000',
  `fecha_registro` date NOT NULL,
  `fecha_ini_deprec` date NOT NULL,
  `serial` varchar(45) NOT NULL,
  `ubicacion_idUbicacion` int(11) NOT NULL,
  `categorias_idCategoria` int(11) NOT NULL,
  `idSubCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`idActivos`, `Descripcion`, `fecha_adquisicion`, `tiempo_depre`, `valor_adquisicion`, `fecha_registro`, `fecha_ini_deprec`, `serial`, `ubicacion_idUbicacion`, `categorias_idCategoria`, `idSubCategoria`) VALUES
(1, 'Laptop Dell E6510', '2016-03-15', 6, '250001.000', '2016-10-07', '2011-04-14', '', 2, 1, 1),
(2, 'Boligrafo Azul', '2016-10-07', 3, '1050.000', '2016-10-07', '2016-10-07', '', 2, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `Descripcion`) VALUES
(1, 'Maquinarias'),
(2, 'Teconologicos'),
(3, 'Articulos de Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_acceso`
--

DROP TABLE IF EXISTS `mapas_acceso`;
CREATE TABLE `mapas_acceso` (
  `idmapas_acceso` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `puedeEliminar` tinyint(1) DEFAULT NULL,
  `puedeModificar` tinyint(1) DEFAULT NULL,
  `puedeGuardar` tinyint(1) DEFAULT NULL
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
CREATE TABLE `modulos` (
  `idmodulos` int(11) NOT NULL,
  `descModulo` varchar(45) DEFAULT NULL,
  `mapas_acceso_idmapas_acceso` int(11) NOT NULL,
  `ubicacion` tinyint(4) DEFAULT '0',
  `sucursal` tinyint(4) DEFAULT '0',
  `activos` tinyint(4) DEFAULT '0',
  `responsable` tinyint(4) DEFAULT '0',
  `categorias` int(11) NOT NULL
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
CREATE TABLE `pistasauditoria` (
  `idpistasAuditoria` int(11) NOT NULL,
  `fechaPista` date DEFAULT NULL,
  `tipo_operacion` char(1) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
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
(32, '2016-10-29', 'E', 'Activos', 'se elimino el Activo: 3', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionactivos`
--

DROP TABLE IF EXISTS `relacionactivos`;
CREATE TABLE `relacionactivos` (
  `idRelacionActivos` int(11) NOT NULL,
  `Activos_idActivos` int(11) NOT NULL,
  `Resposable_idResposable` int(11) NOT NULL
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
CREATE TABLE `resposable` (
  `idResposable` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Cedula` varchar(15) DEFAULT NULL,
  `ubicacion_idUbicacion` int(11) NOT NULL
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
CREATE TABLE `subcategoria` (
  `idSubCategoria` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idSubCategoria`, `Descripcion`, `idCategoria`) VALUES
(1, 'Laptop', 2),
(2, 'Articulos de Oficina', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `Descripcion`) VALUES
(1, 'Region Occidente'),
(2, 'Region Centro-Occidente'),
(3, 'RegiÃ³n Andina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `idTipo_Usuario` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `modulos_idmodulos` int(11) NOT NULL
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
CREATE TABLE `ubicacion` (
  `idUbicacion` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `sucursal_idsucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `Descripcion`, `sucursal_idsucursal`) VALUES
(1, 'Administracion Occidente', 1),
(2, 'TI Occidente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Cedula` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `Tipo_Usuario_idTipo_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `usuario`, `clave`, `Nombre`, `Apellido`, `Cedula`, `foto`, `Tipo_Usuario_idTipo_Usuario`) VALUES
(41, 'admin', 'admin', 'Carlos', 'Bermudez', 'V-15.060.580', 'carlos.jpg', 0),
(42, 'dchavez', '123', 'Daniel', 'Chavez', '2398334', 'default.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`idActivos`),
  ADD KEY `fk_activos_ubicacion1_idx` (`ubicacion_idUbicacion`),
  ADD KEY `Categoria_idCategoria` (`categorias_idCategoria`),
  ADD KEY `idSubCategoria` (`idSubCategoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `mapas_acceso`
--
ALTER TABLE `mapas_acceso`
  ADD PRIMARY KEY (`idmapas_acceso`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`idmodulos`),
  ADD KEY `fk_modulos_mapas_acceso1_idx` (`mapas_acceso_idmapas_acceso`);

--
-- Indices de la tabla `pistasauditoria`
--
ALTER TABLE `pistasauditoria`
  ADD PRIMARY KEY (`idpistasAuditoria`);

--
-- Indices de la tabla `relacionactivos`
--
ALTER TABLE `relacionactivos`
  ADD PRIMARY KEY (`idRelacionActivos`),
  ADD KEY `fk_RelacionActivos_Activos1_idx` (`Activos_idActivos`),
  ADD KEY `fk_RelacionActivos_Resposable1_idx` (`Resposable_idResposable`);

--
-- Indices de la tabla `resposable`
--
ALTER TABLE `resposable`
  ADD PRIMARY KEY (`idResposable`),
  ADD KEY `fk_resposable_ubicacion1_idx` (`ubicacion_idUbicacion`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSubCategoria`),
  ADD KEY `Categoria_idCategoria` (`idCategoria`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idTipo_Usuario`),
  ADD KEY `fk_Tipo_Usuario_modulos1_idx` (`modulos_idmodulos`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`idUbicacion`),
  ADD KEY `fk_Ubicacion_sucursal_idx` (`sucursal_idsucursal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `fk_Usuarios_Tipo_Usuario1_idx` (`Tipo_Usuario_idTipo_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
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
