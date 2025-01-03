-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2020 a las 20:34:57
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `permisosuser`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `idFormulario` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ubicacion` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`idFormulario`, `descripcion`, `ubicacion`) VALUES
(1, 'Usuarios', 'usuarios.php'),
(2, 'Pantallas', 'formularios.php'),
(3, 'Asignar Rol', 'asignarRol.php'),
(4, 'Permisos de Pantalla', 'permisos.php'),
(5, 'Roles', 'roles.php'),
(6, 'Uno', 'uno.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_rol`
--

CREATE TABLE `formulario_rol` (
  `idFormularioRol` int(11) NOT NULL,
  `idFormulario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `formulario_rol`
--

INSERT INTO `formulario_rol` (`idFormularioRol`, `idFormulario`, `idRol`) VALUES
(2, 4, 1),
(3, 2, 1),
(4, 3, 1),
(5, 5, 1),
(12, 1, 1),
(13, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `descripcion`) VALUES
(1, 'Administrador General'),
(4, 'Contador'),
(5, 'Vendedor'),
(6, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `celular` bigint(20) NOT NULL,
  `usuario` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `correo`, `celular`, `usuario`, `clave`) VALUES
(2, 'Jesus Ariel', 'jesus@areil', 3052391123, 'JesusAriel', '$argon2i$v=19$m=65536,t=4,p=1$QkhwdS9OSFFqQ0Ztd0Jkcw$Gbq0zaa0nHcRDlrocMRCgeBy/yEvOc69k8NSCkUt8RI'),
(3, 'Maria Paula Mora', 'maria@paula', 3113145624, 'mariapaula', '$argon2i$v=19$m=65536,t=4,p=1$VHBBMGhCaWNHSHplakJlcQ$+XbiLfYFUTrynUtUhQUMa56f66BmM0y5Owb1ewhJ4hU'),
(6, 'Juan Silva', 'juan@silva', 3112119638, 'Juan29Silva', '$argon2i$v=19$m=65536,t=4,p=1$RkdWNG5hYUNXaWxWNFNlTg$X7W88Trjl9vOxeb4QAdINPkUWSY/2er/WwHNNBn3XlY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `idUsuarioRol` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`idUsuarioRol`, `idUsuario`, `idRol`) VALUES
(2, 6, 1),
(3, 3, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`idFormulario`);

--
-- Indices de la tabla `formulario_rol`
--
ALTER TABLE `formulario_rol`
  ADD PRIMARY KEY (`idFormularioRol`),
  ADD KEY `idFormulario` (`idFormulario`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`idUsuarioRol`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `idFormulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `formulario_rol`
--
ALTER TABLE `formulario_rol`
  MODIFY `idFormularioRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `idUsuarioRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formulario_rol`
--
ALTER TABLE `formulario_rol`
  ADD CONSTRAINT `formulario_rol_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formulario_rol_ibfk_2` FOREIGN KEY (`idFormulario`) REFERENCES `formulario` (`idFormulario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
