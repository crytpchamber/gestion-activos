-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2016 a las 04:28:30
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
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `idActivos` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `tiempo_depre` int(11) NOT NULL DEFAULT '0',
  `valor_adquisicion` decimal(18,3) NOT NULL DEFAULT '0.000',
  `fecha_registro` date NOT NULL,
  `fecha_ini_deprec` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`idActivos`, `Descripcion`, `fecha_adquisicion`, `tiempo_depre`, `valor_adquisicion`, `fecha_registro`, `fecha_ini_deprec`) VALUES
(1, 'Prueba de Activo', '2016-10-06', 5, '125050.550', '2016-10-06', '2016-10-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_acceso`
--

CREATE TABLE `mapas_acceso` (
  `idmapas_acceso` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `puedeEliminar` tinyint(1) DEFAULT NULL,
  `puedeModificar` tinyint(1) DEFAULT NULL,
  `puedeGuardar` tinyint(1) DEFAULT NULL,
  `sucursales` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mapas_acceso`
--

INSERT INTO `mapas_acceso` (`idmapas_acceso`, `Descripcion`, `puedeEliminar`, `puedeModificar`, `puedeGuardar`, `sucursales`) VALUES
(1, 'Mapa Principal', 1, 1, 1, '[Todas]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `idmodulos` int(11) NOT NULL,
  `descModulo` varchar(45) DEFAULT NULL,
  `mapas_acceso_idmapas_acceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idmodulos`, `descModulo`, `mapas_acceso_idmapas_acceso`) VALUES
(1, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistasauditoria`
--

CREATE TABLE `pistasauditoria` (
  `idpistasAuditoria` int(11) NOT NULL,
  `fechaPista` date DEFAULT NULL,
  `tipo_operacion` char(1) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `observacion` text,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionactivos`
--

CREATE TABLE `relacionactivos` (
  `idRelacionActivos` int(11) NOT NULL,
  `Ubicacion_idUbicacion` int(11) NOT NULL,
  `Activos_idActivos` int(11) NOT NULL,
  `Resposable_idResposable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resposable`
--

CREATE TABLE `resposable` (
  `idResposable` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Cedula` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resposable`
--

INSERT INTO `resposable` (`idResposable`, `Nombre`, `Apellido`, `Cedula`) VALUES
(1, 'Carlos', 'Garcia', 'V-15.060.580');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `Descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `Descripcion`) VALUES
(1, 'Region Occidente'),
(2, 'Region Centro Occidente'),
(3, 'Region Andina'),
(4, 'Region Centro'),
(5, 'Region Capital');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idTipo_Usuario` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `modulos_idmodulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idTipo_Usuario`, `descripcion`, `modulos_idmodulos`) VALUES
(1, 'Administrador', 1),
(3, 'Auditor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `idUbicacion` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `sucursal_idsucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`idUbicacion`, `Descripcion`, `sucursal_idsucursal`) VALUES
(1, 'Administracion', 1),
(2, 'PCP/SHA', 1),
(3, 'Almacen', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

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
(10, 'cbermudez', 'xrhhce', 'Carlos', 'Bermudez', 'V-15.060.580', 'carlos.jpg', 1),
(40, 'dbermudez', '123', 'Daniel', 'Bermudez', 'V-15.060.580', 'daniel.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`idActivos`);

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
  ADD KEY `fk_RelacionActivos_Ubicacion1_idx` (`Ubicacion_idUbicacion`),
  ADD KEY `fk_RelacionActivos_Activos1_idx` (`Activos_idActivos`),
  ADD KEY `fk_RelacionActivos_Resposable1_idx` (`Resposable_idResposable`);

--
-- Indices de la tabla `resposable`
--
ALTER TABLE `resposable`
  ADD PRIMARY KEY (`idResposable`);

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
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Restricciones para tablas volcadas
--

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
  ADD CONSTRAINT `fk_RelacionActivos_Resposable1` FOREIGN KEY (`Resposable_idResposable`) REFERENCES `resposable` (`idResposable`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RelacionActivos_Ubicacion1` FOREIGN KEY (`Ubicacion_idUbicacion`) REFERENCES `ubicacion` (`idUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
