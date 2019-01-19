-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-09-2017 a las 10:55:16
-- Versión del servidor: 5.7.19-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.31-4+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `itutor`
--
CREATE DATABASE IF NOT EXISTS `itutor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `itutor`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `aula` varchar(200) DEFAULT NULL,
  `porcentajepruebas` int(11) DEFAULT '80',
  `porcentajefaltas` int(11) DEFAULT '10',
  `porcentajecomportamiento` int(11) DEFAULT '10',
  `maximofaltas` int(11) DEFAULT '10',
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comportamiento`
--

DROP TABLE IF EXISTS `comportamiento`;
CREATE TABLE `comportamiento` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario`
--

DROP TABLE IF EXISTS `diario`;
CREATE TABLE `diario` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `actividad` varchar(3000) DEFAULT NULL,
  `udidactica` varchar(200) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id`, `titulo`, `fechaini`, `fechafin`, `observaciones`, `activo`, `updated_at`) VALUES
(1, 'Primeros - Primera Evaluación', '2017-09-07', '2017-11-17', '', 1, '2017-09-08 10:35:33'),
(2, 'Primeros - Segunda Evaluación', '2017-11-20', '2018-02-23', '', 1, '2017-09-08 10:36:05'),
(3, 'Primeros - Tercera Evaluación', '2018-02-26', '2018-06-01', '', 1, '2017-09-08 10:36:39'),
(4, 'Segundos - Segunda Evaluación', '2017-11-20', '2018-02-19', '', 1, '2017-09-08 10:39:20'),
(5, 'Terceros - Primera Evaluación', '2017-09-07', '2017-10-20', '', 1, '2017-09-08 10:41:07'),
(6, 'Terceros - Segunda Evaluación', '2017-10-20', '2017-12-21', '', 1, '2017-09-08 10:42:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `falta`
--

DROP TABLE IF EXISTS `falta`;
CREATE TABLE `falta` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `justificado` int(11) DEFAULT '0',
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `festivo`
--

DROP TABLE IF EXISTS `festivo`;
CREATE TABLE `festivo` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `motivo` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `grupoevaluacion`
--

DROP TABLE IF EXISTS `grupoevaluacion`;
CREATE TABLE `grupoevaluacion` (
  `id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `hora`
--

DROP TABLE IF EXISTS `hora`;
CREATE TABLE `hora` (
  `id` int(11) NOT NULL,
  `tramo` varchar(200) DEFAULT NULL,
  `descanso` int(11) DEFAULT '0',
  `descripcion` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`id`, `tramo`, `descanso`, `descripcion`, `activo`, `updated_at`) VALUES
(1, '8:15-9:10', 0, '', 1, '2012-09-03 11:28:13'),
(2, '9:10-10:05', 0, '', 1, '2012-09-03 11:28:29'),
(3, '10:05-11:00', 0, '', 1, '2012-09-03 11:28:54'),
(4, '11:00-11:30', 1, '', 1, '2016-09-10 11:27:50'),
(5, '11:30-12:25', 0, '', 1, '2016-09-10 11:28:03'),
(6, '12:25-13:20', 0, '', 1, '2016-09-10 11:28:14'),
(7, '13:20-14:15', 0, '', 1, '2016-09-10 11:28:24'),
(14, '18:30-19:20', 0, '', 1, '2011-09-06 13:46:20'),
(15, '19:20-20:10', 0, '', 1, '2011-09-06 13:46:29'),
(16, '20:10-20:20', 1, '', 1, '2011-09-06 13:46:39'),
(17, '20:20-21:10', 0, '', 1, '2011-09-06 13:46:49'),
(18, '21:10-22:00', 0, '', 1, '2011-09-06 13:46:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horaperfil`
--

DROP TABLE IF EXISTS `horaperfil`;
CREATE TABLE `horaperfil` (
  `id` int(11) NOT NULL,
  `hora_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horaperfil`
--

INSERT INTO `horaperfil` (`id`, `hora_id`, `perfil_id`, `orden`, `activo`, `updated_at`) VALUES
(1, 1, 4, 1, 1, '2011-09-07 16:28:00'),
(2, 2, 4, 2, 1, '2011-09-07 16:28:06'),
(3, 3, 4, 3, 1, '2011-09-07 16:28:11'),
(4, 4, 4, 4, 1, '2011-09-07 16:28:16'),
(5, 5, 4, 5, 1, '2011-09-07 16:28:20'),
(6, 6, 4, 6, 1, '2011-09-07 16:28:24'),
(7, 7, 4, 7, 1, '2011-09-07 16:28:28'),
(12, 14, 4, 12, 1, '2011-09-07 16:28:51'),
(13, 15, 4, 13, 1, '2011-09-07 16:28:56'),
(14, 16, 4, 14, 1, '2011-09-07 16:29:00'),
(15, 17, 4, 15, 1, '2011-09-07 16:29:05'),
(16, 18, 4, 16, 1, '2011-09-07 16:29:10'),
(17, 1, 5, 1, 1, '2011-09-07 16:27:04'),
(18, 2, 5, 2, 1, '2011-09-07 16:27:07'),
(19, 3, 5, 3, 1, '2011-09-07 16:27:11'),
(20, 4, 5, 4, 1, '2011-09-07 16:27:16'),
(21, 5, 5, 5, 1, '2011-09-07 16:27:20'),
(22, 6, 5, 6, 1, '2011-09-07 16:27:30'),
(23, 7, 5, 7, 1, '2011-09-07 16:27:38'),
(28, 14, 6, 4, 1, '2011-09-07 16:26:22'),
(29, 15, 6, 5, 1, '2011-09-07 16:26:27'),
(30, 16, 6, 6, 1, '2011-09-07 16:26:37'),
(31, 17, 6, 7, 1, '2011-09-07 16:26:42'),
(32, 18, 6, 8, 1, '2011-09-07 16:26:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaevaluacion`
--

DROP TABLE IF EXISTS `notaevaluacion`;
CREATE TABLE `notaevaluacion` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaprueba`
--

DROP TABLE IF EXISTS `notaprueba`;
CREATE TABLE `notaprueba` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `prueba_id` int(11) DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `descripcion`, `activo`, `updated_at`) VALUES
(4, 'FP-Diurno-Nocturno', '', 1, '2011-09-06 13:48:42'),
(5, 'FP-Diurno', '', 1, '2011-09-06 13:48:51'),
(6, 'FP-Nocturno', '', 1, '2011-09-06 13:49:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE `profesor` (
  `id` int(11) NOT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(128) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `prueba`
--

DROP TABLE IF EXISTS `prueba`;
CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `porcentaje` int(11) DEFAULT '100',
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retraso`
--

DROP TABLE IF EXISTS `retraso`;
CREATE TABLE `retraso` (
  `id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `justificado` int(11) DEFAULT '0',
  `observaciones` varchar(3000) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_group`
--

DROP TABLE IF EXISTS `sf_guard_group`;
CREATE TABLE `sf_guard_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sf_guard_group`
--

INSERT INTO `sf_guard_group` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator group');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_group_permission`
--

DROP TABLE IF EXISTS `sf_guard_group_permission`;
CREATE TABLE `sf_guard_group_permission` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sf_guard_group_permission`
--

INSERT INTO `sf_guard_group_permission` (`group_id`, `permission_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_permission`
--

DROP TABLE IF EXISTS `sf_guard_permission`;
CREATE TABLE `sf_guard_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sf_guard_permission`
--

INSERT INTO `sf_guard_permission` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator permission');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_remember_key`
--

DROP TABLE IF EXISTS `sf_guard_remember_key`;
CREATE TABLE `sf_guard_remember_key` (
  `user_id` int(11) NOT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `sf_guard_user`
--

DROP TABLE IF EXISTS `sf_guard_user`;
CREATE TABLE `sf_guard_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `codigo` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_super_admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sf_guard_user`
--

INSERT INTO `sf_guard_user` (`id`, `username`, `algorithm`, `salt`, `password`, `codigo`, `nombre`, `created_at`, `last_login`, `is_active`, `is_super_admin`) VALUES
(1, 'admin', 'sha1', '99703e2b0147dd2f146597ed38d3843b', '88d0b9d998d95fd377542f243c4c42066c95fa2c', '0', 'Admin', '2011-09-06 13:42:05', '2017-09-09 10:26:49', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_user_group`
--

DROP TABLE IF EXISTS `sf_guard_user_group`;
CREATE TABLE `sf_guard_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sf_guard_user_group`
--

INSERT INTO `sf_guard_user_group` (`user_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf_guard_user_permission`
--

DROP TABLE IF EXISTS `sf_guard_user_permission`;
CREATE TABLE `sf_guard_user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_FI_1` (`grupo_id`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asignatura_FI_1` (`profesor_id`);

--
-- Indices de la tabla `comportamiento`
--
ALTER TABLE `comportamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comportamiento_FI_1` (`alumno_id`),
  ADD KEY `comportamiento_FI_2` (`evaluacion_id`),
  ADD KEY `comportamiento_FI_3` (`asignatura_id`);

--
-- Indices de la tabla `diario`
--
ALTER TABLE `diario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diario_FI_1` (`evaluacion_id`),
  ADD KEY `diario_FI_2` (`asignatura_id`),
  ADD KEY `diario_FI_3` (`grupo_id`),
  ADD KEY `diario_FI_4` (`profesor_id`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `falta`
--
ALTER TABLE `falta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `falta_FI_1` (`evaluacion_id`),
  ADD KEY `falta_FI_2` (`alumno_id`),
  ADD KEY `falta_FI_3` (`asignatura_id`);

--
-- Indices de la tabla `festivo`
--
ALTER TABLE `festivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festivo_FI_1` (`evaluacion_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_FI_1` (`profesor_id`);

--
-- Indices de la tabla `grupoevaluacion`
--
ALTER TABLE `grupoevaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupoevaluacion_FI_1` (`grupo_id`),
  ADD KEY `grupoevaluacion_FI_2` (`evaluacion_id`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horaperfil`
--
ALTER TABLE `horaperfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horaperfil_FI_1` (`hora_id`),
  ADD KEY `horaperfil_FI_2` (`perfil_id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horario_FI_1` (`profesor_id`),
  ADD KEY `horario_FI_2` (`asignatura_id`),
  ADD KEY `horario_FI_3` (`grupo_id`);

--
-- Indices de la tabla `notaevaluacion`
--
ALTER TABLE `notaevaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notaevaluacion_FI_1` (`evaluacion_id`),
  ADD KEY `notaevaluacion_FI_2` (`alumno_id`),
  ADD KEY `notaevaluacion_FI_3` (`asignatura_id`);

--
-- Indices de la tabla `notaprueba`
--
ALTER TABLE `notaprueba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notaprueba_FI_1` (`alumno_id`),
  ADD KEY `notaprueba_FI_2` (`prueba_id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_FI_1` (`perfil_id`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prueba_FI_1` (`evaluacion_id`),
  ADD KEY `prueba_FI_2` (`asignatura_id`);

--
-- Indices de la tabla `retraso`
--
ALTER TABLE `retraso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retraso_FI_1` (`evaluacion_id`),
  ADD KEY `retraso_FI_2` (`alumno_id`),
  ADD KEY `retraso_FI_3` (`asignatura_id`);

--
-- Indices de la tabla `sf_guard_group`
--
ALTER TABLE `sf_guard_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sf_guard_group_name_unique` (`name`);

--
-- Indices de la tabla `sf_guard_group_permission`
--
ALTER TABLE `sf_guard_group_permission`
  ADD PRIMARY KEY (`group_id`,`permission_id`),
  ADD KEY `sf_guard_group_permission_FI_2` (`permission_id`);

--
-- Indices de la tabla `sf_guard_permission`
--
ALTER TABLE `sf_guard_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sf_guard_permission_name_unique` (`name`);

--
-- Indices de la tabla `sf_guard_remember_key`
--
ALTER TABLE `sf_guard_remember_key`
  ADD PRIMARY KEY (`user_id`,`ip_address`);

--
-- Indices de la tabla `sf_guard_user`
--
ALTER TABLE `sf_guard_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sf_guard_user_username_unique` (`username`);

--
-- Indices de la tabla `sf_guard_user_group`
--
ALTER TABLE `sf_guard_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `sf_guard_user_group_FI_2` (`group_id`);

--
-- Indices de la tabla `sf_guard_user_permission`
--
ALTER TABLE `sf_guard_user_permission`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `sf_guard_user_permission_FI_2` (`permission_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comportamiento`
--
ALTER TABLE `comportamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `diario`
--
ALTER TABLE `diario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `falta`
--
ALTER TABLE `falta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `festivo`
--
ALTER TABLE `festivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `grupoevaluacion`
--
ALTER TABLE `grupoevaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `hora`
--
ALTER TABLE `hora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `horaperfil`
--
ALTER TABLE `horaperfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notaevaluacion`
--
ALTER TABLE `notaevaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notaprueba`
--
ALTER TABLE `notaprueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `retraso`
--
ALTER TABLE `retraso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sf_guard_group`
--
ALTER TABLE `sf_guard_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sf_guard_permission`
--
ALTER TABLE `sf_guard_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sf_guard_user`
--
ALTER TABLE `sf_guard_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
