-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2023 a las 02:59:09
-- Versión del servidor: 8.0.27
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratorio_dacb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_alumnos`
--

CREATE TABLE `acceso_alumnos` (
  `idAcceso_Alumnos` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora_entrada` time DEFAULT NULL,
  `Hora_salida` time DEFAULT NULL,
  `En_uso` tinyint DEFAULT NULL,
  `fkMatricula_Alumno` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fkMatricula_Profesor` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idCategoria` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `acceso_alumnos`
--

INSERT INTO `acceso_alumnos` (`idAcceso_Alumnos`, `Fecha`, `Hora_entrada`, `Hora_salida`, `En_uso`, `fkMatricula_Alumno`, `fkMatricula_Profesor`, `idCategoria`) VALUES
(1, '2023-01-05', '13:04:00', '14:04:00', 0, '192H20654', 'PROF_01', 3),
(2, '2022-12-19', '13:04:00', '14:04:00', 0, '192H21384', 'PROF_01', 3),
(3, '2023-01-06', '18:30:38', '18:50:40', 0, '192H20654', 'PROF_01', 3),
(4, '2023-01-06', '18:51:08', '18:51:17', 0, '192H21384', 'PROF_01', 3),
(5, '2023-01-06', '19:05:11', '19:40:46', 0, '192H92435', 'PROF_01', 3),
(6, '2023-01-06', '19:56:35', '20:12:13', 0, '192H46821', 'PROF_01', 3),
(7, '2023-01-07', '16:13:20', NULL, 1, '192H20654', 'PROF_01', 3),
(8, '2023-01-08', '17:55:06', '17:56:29', 0, '192H20654', 'PROF_01', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_profesores`
--

CREATE TABLE `acceso_profesores` (
  `idAcceso_Profesores` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora_entrada` time DEFAULT NULL,
  `Hora_salida` time DEFAULT NULL,
  `En_uso` tinyint DEFAULT NULL,
  `fkMatricula_Profesor` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idCategoria` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `acceso_profesores`
--

INSERT INTO `acceso_profesores` (`idAcceso_Profesores`, `Fecha`, `Hora_entrada`, `Hora_salida`, `En_uso`, `fkMatricula_Profesor`, `idCategoria`) VALUES
(1, '2023-01-02', '13:04:00', '14:04:00', 0, 'PROF_01', 3),
(2, '2023-01-05', '08:00:00', '19:39:08', 0, '192H17020', 2),
(3, '2023-01-06', '19:40:35', '19:41:29', 0, '192H17020', 2),
(4, '2023-01-06', '19:48:20', '19:51:29', 0, 'PROF_01', 2),
(5, '2023-01-07', '16:00:39', NULL, 1, 'PROF_01', 2),
(6, '2023-01-08', '17:52:31', '17:56:05', 0, 'PROF_01', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Matricula_Administrador` varchar(10) NOT NULL,
  `Password` varchar(10) DEFAULT NULL,
  `idPersona` int DEFAULT NULL,
  `idCategoria` int DEFAULT NULL,
  `idNivel_Academico` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Matricula_Administrador`, `Password`, `idPersona`, `idCategoria`, `idNivel_Academico`) VALUES
('192H17020', '123456', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Matricula_Alumno` varchar(10) NOT NULL,
  `Carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Semestre` int NOT NULL,
  `idPersona` int NOT NULL,
  `idNivel_Academico` int NOT NULL,
  `idCategoria` int NOT NULL,
  `Matricula_Profesor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Matricula_Alumno`, `Carrera`, `Semestre`, `idPersona`, `idNivel_Academico`, `idCategoria`, `Matricula_Profesor`) VALUES
('192H20654', 'Lic. QFB', 2, 3, 1, 3, 'PROF_01'),
('192H21384', 'Lic. Ética', 2, 7, 1, 3, 'PROF_01'),
('192H31564', 'Maestría en computación', 3, 9, 2, 3, 'PROF_01'),
('192H34681', 'Lic. en contaduría', 6, 10, 1, 3, 'PROF_01'),
('192H46821', 'Maestría en QFB', 3, 4, 2, 3, 'PROF_01'),
('192H61357', 'Lic. Ética', 1, 8, 1, 3, 'PROF_01'),
('192H92435', 'Doctorado en Artes', 4, 5, 3, 3, 'PROF_01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int NOT NULL,
  `Nombre_categoria` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Descripcion_categoria` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nombre_categoria`, `Descripcion_categoria`) VALUES
(1, 'Administrador', 'Nivel máximo'),
(2, 'Profesor', 'Nivel medio'),
(3, 'Alumno', 'Nivel inferior');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fallos`
--

CREATE TABLE `fallos` (
  `idFallo` int NOT NULL,
  `Asunto` varchar(45) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Fecha` date NOT NULL,
  `fkMatricula_Profesor` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `fallos`
--

INSERT INTO `fallos` (`idFallo`, `Asunto`, `Descripcion`, `Fecha`, `fkMatricula_Profesor`) VALUES
(1, 'Prueba', 'Esto es una prueba', '2023-01-06', '192H17020'),
(2, '', 'Esto es solo una prueba', '2023-01-06', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `idNivel_Academico` int NOT NULL,
  `Nombre_nivel` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Descripcion_nivel` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `nivel_academico`
--

INSERT INTO `nivel_academico` (`idNivel_Academico`, `Nombre_nivel`, `Descripcion_nivel`) VALUES
(1, 'Licenciatura', 'Primer nivel académico'),
(2, 'Maestria ', 'Segundo nivel académico'),
(3, 'Doctorado', 'Tercer nivel académico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `no_autorizados`
--

CREATE TABLE `no_autorizados` (
  `idNo_Autorizados` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `no_autorizados`
--

INSERT INTO `no_autorizados` (`idNo_Autorizados`, `Fecha`, `Hora`) VALUES
(1, '2022-12-19', '13:06:05'),
(2, '2023-01-06', '13:06:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `ApellidoP` varchar(45) NOT NULL,
  `ApellidoM` varchar(45) DEFAULT NULL,
  `Edad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `Nombre`, `ApellidoP`, `ApellidoM`, `Edad`) VALUES
(1, 'Adry Moisés', 'Arias', 'Morales', 21),
(2, 'Javier', 'Arias', 'Morales', 20),
(3, 'Alejandro', 'Arias', 'Morales', 21),
(4, 'Hilda', 'Arias', 'Morales', 31),
(5, 'Lorena', 'Arias', 'Morales', 31),
(7, 'José', 'López', 'Hernández', 25),
(8, 'Mario', 'Perez', 'Ruiz', 18),
(9, 'Hernesto', 'Gomez', 'Cruz', 28),
(10, 'José Carlos', 'Rivera', 'Diaz', 22),
(11, 'Roberto', 'Cruz', 'Gonzales', 50),
(12, 'sdgf', 'stbre', 'sb', 21),
(13, 'Jose Angel', 'Medez', 'Cruz', 20),
(14, 'Jose Angel', 'Medez', 'Cruz', 21),
(15, 'wqe', 'qewe', 'weq', 21),
(16, 'hs', 'se56g', 'hs', 21),
(17, 'gbdx', 'zdgv', 'gxb', 21),
(18, 'svet', 'ves', 'esvt', 21),
(19, 'wear', 'faew', 'arew', 21),
(20, 'svbt', 'areg', 'vst', 21),
(21, 'sryb', 'esgt', 'set', 21),
(22, 'vset', 'warv', 'vaw', 21),
(23, 'NTY', 'TY', 'TNY', 21),
(24, '12', 'rew', '12', 21),
(25, 'yrht', 'trehbe', 'hes', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `Matricula_Profesor` varchar(10) NOT NULL,
  `Email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL,
  `idNivel_Academico` int DEFAULT NULL,
  `idPersona` int DEFAULT NULL,
  `idCategoria` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`Matricula_Profesor`, `Email`, `Password`, `idNivel_Academico`, `idPersona`, `idCategoria`) VALUES
('192H17020', 'adrymoises.arias.morales@gmail.com', 'KdZpFRcVbe', 1, 1, 2),
('PROF_01', 'javier@email.com', '123456', 3, 2, 2),
('PROF_02', 'roberto@email.com', 'aM8#4fmoBt', 3, 11, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso_alumnos`
--
ALTER TABLE `acceso_alumnos`
  ADD PRIMARY KEY (`idAcceso_Alumnos`),
  ADD KEY `Matricula_Alumno` (`fkMatricula_Alumno`),
  ADD KEY `Matricula_Profesor` (`fkMatricula_Profesor`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `acceso_profesores`
--
ALTER TABLE `acceso_profesores`
  ADD PRIMARY KEY (`idAcceso_Profesores`),
  ADD KEY `Matricula_Profesor` (`fkMatricula_Profesor`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Matricula_Administrador`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idNivel_Academico` (`idNivel_Academico`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`Matricula_Alumno`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idNivel_Academico` (`idNivel_Academico`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `Matricula_Profesor` (`Matricula_Profesor`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `fallos`
--
ALTER TABLE `fallos`
  ADD PRIMARY KEY (`idFallo`);

--
-- Indices de la tabla `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`idNivel_Academico`);

--
-- Indices de la tabla `no_autorizados`
--
ALTER TABLE `no_autorizados`
  ADD PRIMARY KEY (`idNo_Autorizados`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`Matricula_Profesor`),
  ADD KEY `idNivel_Academico` (`idNivel_Academico`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso_alumnos`
--
ALTER TABLE `acceso_alumnos`
  MODIFY `idAcceso_Alumnos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `acceso_profesores`
--
ALTER TABLE `acceso_profesores`
  MODIFY `idAcceso_Profesores` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fallos`
--
ALTER TABLE `fallos`
  MODIFY `idFallo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nivel_academico`
--
ALTER TABLE `nivel_academico`
  MODIFY `idNivel_Academico` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `no_autorizados`
--
ALTER TABLE `no_autorizados`
  MODIFY `idNo_Autorizados` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso_alumnos`
--
ALTER TABLE `acceso_alumnos`
  ADD CONSTRAINT `acceso_alumnos_ibfk_1` FOREIGN KEY (`fkMatricula_Alumno`) REFERENCES `alumnos` (`Matricula_Alumno`),
  ADD CONSTRAINT `acceso_alumnos_ibfk_2` FOREIGN KEY (`fkMatricula_Profesor`) REFERENCES `profesores` (`Matricula_Profesor`),
  ADD CONSTRAINT `acceso_alumnos_ibfk_3` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `acceso_profesores`
--
ALTER TABLE `acceso_profesores`
  ADD CONSTRAINT `acceso_profesores_ibfk_1` FOREIGN KEY (`fkMatricula_Profesor`) REFERENCES `profesores` (`Matricula_Profesor`),
  ADD CONSTRAINT `acceso_profesores_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `administrador_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `administrador_ibfk_3` FOREIGN KEY (`idNivel_Academico`) REFERENCES `nivel_academico` (`idNivel_Academico`);

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`idNivel_Academico`) REFERENCES `nivel_academico` (`idNivel_Academico`),
  ADD CONSTRAINT `alumnos_ibfk_3` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `alumnos_ibfk_4` FOREIGN KEY (`Matricula_Profesor`) REFERENCES `profesores` (`Matricula_Profesor`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `idNivel_Academico` FOREIGN KEY (`idNivel_Academico`) REFERENCES `nivel_academico` (`idNivel_Academico`),
  ADD CONSTRAINT `idPersona` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
