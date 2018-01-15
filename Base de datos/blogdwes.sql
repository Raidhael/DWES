-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2018 a las 04:28:32
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blogdwes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `idEntrada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `autor` int(11) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `idEntrada`, `fecha`, `autor`, `texto`) VALUES
(26, 13, '2018-01-15', 9, 'Comentario de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cuerpo` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `titulo`, `usuario`, `cuerpo`, `fecha`) VALUES
(1, '1- ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2014-01-11'),
(2, '2- ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2015-05-11'),
(3, '3-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2015-06-11'),
(4, '4-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2015-07-11'),
(5, '5-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2016-08-11'),
(6, '6-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2016-09-11'),
(7, '7-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2017-08-11'),
(8, '8-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2017-09-11'),
(9, '9-ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2017-10-11'),
(10, '10- ENTRADA MANUAL PRUEBA', 9, 'ESTO ES UNA ENTRADA DE PRUEBA BLABLABLABLABLABLA', '2017-11-11'),
(13, 'Primera entrada insertada mediante la web', 9, 'Lorem ipsum dolor sit amet<br> consectetur adipisicing elit. Corporis eveniet, <br>itaque blanditiis ullam labore facilis exercitationem cumqu<br>e adipisci a reprehenderit numquam minima, doloribus dolo<br>r alias sequi tempora<br>maxime<br> cum? Ad.', '2018-01-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `idFav` int(11) NOT NULL,
  `idEntrada` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fav` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('usuario','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `nombre`, `clave`, `rol`) VALUES
(9, 'Sergio24', '$2y$10$pPzCIgCpLkFbYDcgGYx/Beo7.un/PnGBOpIF5vReaFu8anuah0NOW', 'administrador'),
(10, 'SergioNormal', '$2y$10$L97qKUEZUVPxDDm6Y8w3h.ju1unhEpv2fdp9R6iXicg7CYYQ5FONq', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`,`idEntrada`,`autor`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idEntrada` (`idEntrada`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`,`usuario`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`idFav`,`idEntrada`,`idUser`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idEntrada` (`idEntrada`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `idFav` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`idEntrada`) REFERENCES `entrada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`idEntrada`) REFERENCES `entrada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
