-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-05-2024 a las 19:45:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doginn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarios_disponibilidad`
--

CREATE TABLE `calendarios_disponibilidad` (
  `id horario` int(254) NOT NULL,
  `id guarderia` int(254) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id factura` int(254) NOT NULL,
  `id usuario` int(254) NOT NULL,
  `id reserva` int(254) NOT NULL,
  `total` int(254) NOT NULL,
  `fecha` date NOT NULL,
  `nombre_guarderia` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guarderias`
--

CREATE TABLE `guarderias` (
  `id_guarderia` int(254) NOT NULL,
  `nombre_guarderia` varchar(254) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `imagen_url` longblob NOT NULL,
  `correo_electronico` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guarderias`
--

INSERT INTO `guarderias` (`id_guarderia`, `nombre_guarderia`, `direccion`, `telefono`, `imagen_url`, `correo_electronico`, `password`) VALUES
(1, 'VIVE PET RESORT', 'Las Rozas de Madrid Ctra. El Escorial, 19', '659190913', 0x696d672f5649564520504554205245534f52542e706e67, '', ''),
(2, 'DOG CAMP', 'Calle Bellavista, 0 Km 31, Autovía de los Pantanos, M-501, Brunete, 28212', '692727101', 0x696d672f646f6763616e2e706e67, '', ''),
(3, 'GRANJA LA LUNA', 'Camino Tierra de Agua, 2, Belmonte de Tajo, Madrid (España), 28', '918747354', 0x696d672f4752414e4a41204c41204c554e412e706e67, '', ''),
(5, 'La Viilla Encantada', 'C. Arroyo Tres Cantos, 11, 28189 Torremocha de Jarama, Madrid', '+34 605 618 111', 0x696d672f6c612076696c6c6120656e63616e746164612e706e67, '', ''),
(38, 'villamantilla3', 'asd', 'asd', 0x696d672f656d61696c5f6c6f676f2e706e67, 'villamantilla@gmail.com', '$2y$10$ieOJmBL3OO3CNApxtbQYoOV9o82DHCVctPTODHWzKyobnhnMbrP5O'),
(39, 'brunete', 'sd', 'sd', 0x696d672f6c6f676f66616365626f6f6b2e706e67, 'brunete@gmail.com', '$2y$10$EOpIiZ2HSJWDHh4f/ecgNeNqwitu27aAbmKAc4DJ/MAsu4a3hHFh2'),
(40, 'brunete', 'sd', 'sd', 0x696d672f6c6f676f66616365626f6f6b2e706e67, 'brunete@gmail.com', '$2y$10$Cvnk.gFIhVROSW0U.vtWQuaggEJiGSQ9uR/qoUPcUuEt0aqkeVbE6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_guarderia`
--

CREATE TABLE `imagenes_guarderia` (
  `id` int(11) NOT NULL,
  `id_guarderia` int(11) DEFAULT NULL,
  `imagen_url` longblob DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `id perro` int(254) NOT NULL,
  `id usuario` int(254) NOT NULL,
  `nombre` varchar(254) NOT NULL,
  `raza` text NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id reserva` int(254) NOT NULL,
  `id usuario` int(254) NOT NULL,
  `id perro` int(254) NOT NULL,
  `fecha` date NOT NULL,
  `nombre_guarderia` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `primer_apellido` varchar(200) NOT NULL,
  `segundo_apellido` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `primer_apellido`, `segundo_apellido`, `email`, `password`) VALUES
(1, 'root', 'root', '', 'root@email.com', ''),
(4, 'Julio', '', '', 'julio@gmail.com', '$2y$10$yoZnigTp5OsjZsmvkmomReGLOL8s6x8hoixB4cJHhebJ2ZzYyde/W'),
(18, 'kilo3', 'kilo3', 'kilo3', 'kilo10@gmail.com', '$2y$10$J6ynhEMrkVgb95r7NM.7cuqsB4uGGCJLorv764PND/GP8Qk1nzoZa'),
(19, 'sergio', 'sergio', 'sergio', 'sergio@gmail.com', '$2y$10$8804iMLfZ1nNpxMvY/cYRu4.4DPw9/qw.gm10cEZffTDf7FEelyNi'),
(20, 'diana', 'diana', 'diana', 'diana@gmail.com', '$2y$10$SM0tZmmNYd.C8KiQmhDKfePNEgUQStb5DdQRoOe3r7/QPb/ji3thm'),
(21, 'carlos', 'eguis', 'eguis', 'carlos@gmail.com', '$2y$10$vZUtu7djWnYmMcsRZFg1j.CiljxK9qR1lVFlw0LmfLVNWzLjYri16'),
(22, 'gaabi', 'gabi', 'gabi', 'gabi@gmail.com', '$2y$10$KbL8IPnZ7Gxn8teorvB7cucQZi1ZHD5KyXB1n9oOZDncSnB1wPyte'),
(23, 'fabian', 'fabian', 'fabian', 'fabian@gmail.com', '$2y$10$shLvK5wwoRmLA4Hj5xSaheWm1iYJS/JguppMLbFoS2rlqigCfAi/S');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendarios_disponibilidad`
--
ALTER TABLE `calendarios_disponibilidad`
  ADD PRIMARY KEY (`id guarderia`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id factura`);

--
-- Indices de la tabla `guarderias`
--
ALTER TABLE `guarderias`
  ADD PRIMARY KEY (`id_guarderia`);

--
-- Indices de la tabla `imagenes_guarderia`
--
ALTER TABLE `imagenes_guarderia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`id perro`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id reserva`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendarios_disponibilidad`
--
ALTER TABLE `calendarios_disponibilidad`
  MODIFY `id guarderia` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id factura` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guarderias`
--
ALTER TABLE `guarderias`
  MODIFY `id_guarderia` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `imagenes_guarderia`
--
ALTER TABLE `imagenes_guarderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `id perro` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id reserva` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
