-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 09:49:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdnestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id`, `nombre`) VALUES
(1, 'Distrito 1'),
(2, 'Distrito 2'),
(3, 'Distrito 3'),
(4, 'Distrito 4'),
(5, 'Distrito 5'),
(6, 'Distrito 6'),
(7, 'Distrito 7'),
(8, 'Distrito 8'),
(9, 'Distrito 9'),
(10, 'Distrito 10'),
(11, 'Distrito 11'),
(12, 'Distrito 12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `distrito_id` int(11) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `ci`, `distrito_id`, `zona_id`) VALUES
(2, 'María', 'Gómez', '8460199', 8, 13),
(3, 'Carlos', 'Rodríguez', '789012', 4, 6),
(4, 'Nestor', 'Alvarez', '123456', 12, 18),
(5, 'Claudia', 'Gómez', '654321', 10, 15),
(6, 'Pedro', 'Rodríguez', '789012', 6, 10),
(9, 'David', 'Villa', '789012', 4, 5),
(10, 'Alejandro', 'Castillo', '4848444', 10, 16),
(11, 'Marco', 'Castillo', '5234322', 7, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad`
--

CREATE TABLE `propiedad` (
  `id` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `codigo_catastral` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedad`
--

INSERT INTO `propiedad` (`id`, `direccion`, `tipo`, `id_persona`, `codigo_catastral`) VALUES
(3, 'Av. Munoz Reyes Cota Cota', 'Privada', 2, '3HSDS'),
(4, 'San Miguel', 'Publica', 4, '1DFDFKS'),
(5, 'Obrajes', 'Publica', 3, '2BVCFR'),
(6, 'San Pedro', 'Privada', 9, '3INNDE'),
(7, 'Ceja', 'Privada', 5, '2IOOSD'),
(8, 'Achumani', 'Publica', 6, '1POSDSD'),
(9, 'Obrajes', 'Publica', 10, '103MKD'),
(10, 'Chasquipampa', 'Privada', 11, '1PSDSD1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('funcionario','persona') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `tipo_usuario`) VALUES
(1, 'funcionario1', '482c811da5d5b4bc6d497ffa98491e38', 'funcionario'),
(2, 'persona1', '482c811da5d5b4bc6d497ffa98491e38', 'persona'),
(3, 'Nestor', '81dc9bdb52d04dc20036dbd8313ed055', 'funcionario'),
(4, 'Ariana', '81dc9bdb52d04dc20036dbd8313ed055', 'persona'),
(5, 'persona2', '482c811da5d5b4bc6d497ffa98491e38', 'persona'),
(6, 'persona3', '482c811da5d5b4bc6d497ffa98491e38', 'persona'),
(7, 'persona4', '482c811da5d5b4bc6d497ffa98491e38', 'persona'),
(8, 'persona5', '482c811da5d5b4bc6d497ffa98491e38', 'persona'),
(9, 'juana', '482c811da5d5b4bc6d497ffa98491e38', 'persona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `distrito_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre`, `distrito_id`) VALUES
(1, 'Sopocachi', 1),
(2, 'Sopocachi Bajo', 1),
(3, 'Miraflores', 2),
(4, 'San Pedro', 3),
(5, 'Villa Fátima', 4),
(6, 'Villa El Carmen', 4),
(7, 'Obrajes', 5),
(8, 'Achumani', 5),
(9, 'Calacoto', 6),
(10, 'Cota Cota', 6),
(11, 'Chasquipampa', 7),
(12, 'Alto Irpavi', 7),
(13, 'Ciudad Satélite', 8),
(14, 'El Tejar', 9),
(15, 'Pura Pura', 10),
(16, 'Munaypata', 10),
(17, 'Villa Armonía', 11),
(18, 'Villa Copacabana', 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distrito_id` (`distrito_id`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indices de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distrito_id` (`distrito_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD CONSTRAINT `propiedad_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `zonas_ibfk_1` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
