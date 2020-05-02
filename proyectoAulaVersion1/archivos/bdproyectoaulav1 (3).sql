-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2020 a las 00:13:35
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdproyectoaulav1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `nombre` varchar(45) NOT NULL,
  `documento` varchar(45) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_retiro` date NOT NULL,
  `salario_basico` varchar(45) NOT NULL,
  `deduccion` double NOT NULL,
  `foto` varchar(100) NOT NULL,
  `hoja_vida` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefono` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `inactivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`nombre`, `documento`, `fecha_ingreso`, `fecha_retiro`, `salario_basico`, `deduccion`, `foto`, `hoja_vida`, `email`, `telefono`, `celular`, `inactivo`) VALUES
('prueba', '00000000000000000000000000', '2020-04-17', '2020-04-08', '45678', 324, 'archivoiOrue', 'CV', 'natalia@gmail.com', 2147483647, 2147483647, 0),
('PRUEBA345', '101723466', '2020-04-10', '2020-04-17', '345.000', 1200, 'FOTO', 'CV', 'astridchavarria@gmail.com', 2147483647, 2172422, 0),
('prueba12', '1017269278', '0000-00-00', '0000-00-00', '12345', 1.2, 'archivoiOrue', 'CV', 'astridchavarria@gmail.com', 2147483647, 2172435, 0),
('prueba', '199999', '0000-00-00', '0000-00-00', '789', 1.2, 'FOTO', 'CV', 'astridchavarria@gmail.com', 2147483647, 2147483647, 0),
('actualizacionRealizada', '456', '2020-04-17', '2020-04-30', '3.200', 1200, 'FOTO', 'CV', 'astridchavarria@gmail.com', 2147483647, 23444, 0),
('a', '578009876', '0000-00-00', '0000-00-00', '45678', 1200, '../archivos/ActividadFormulacion.docx', '../archivos/ALTERNATIVAS DE SOLUCION.docx', 'astridchavarria@gmail.com', 2147483647, 2147483647, 0),
('pruebaKevin', '987654', '2020-04-18', '2020-04-30', '876543', 1.2, 'FOTO', 'CV', 'astridchavarria@gmail.com', 2147483647, 2172422, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `clave` varchar(50) NOT NULL,
  `nivel` int(4) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`clave`, `nivel`, `usuario`) VALUES
('123', 1, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`clave`,`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
