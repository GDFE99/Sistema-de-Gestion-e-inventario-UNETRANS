-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2024 a las 22:56:13
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
-- Base de datos: `pdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(2, 'Caja', 'Contenedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `electricidad` int(11) NOT NULL,
  `informatica` int(11) NOT NULL,
  `química` int(11) NOT NULL,
  `procesos químicos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `prestamo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `producto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`prestamo_id`, `usuario_id`, `cantidad`, `fecha_solicitud`, `estado`, `producto_id`) VALUES
(1, 62, 1.00, '2024-03-08', 'nuevo', 8),
(2, 3, 4.00, '2024-03-08', 'nuevo', 6),
(3, 3, 10.00, '2024-03-08', 'nuevo', 7),
(4, 3, 10.00, '2024-03-08', 'nuevo', 6),
(7, 3, 10.00, '2024-03-08', 'nuevo', 8),
(11, 3, 4.00, '2024-03-08', 'nuevo', 6),
(12, 68, 3.00, '2024-03-08', 'nuevo', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`) VALUES
(6, '333333', 'Objeto', 4, 'Objeto_52.jpg', 2, 3),
(7, '45664', 'Esponja', 4, 'Esponja_15.jpg', 2, 3),
(8, 'ads', 'ddasdsa', 3, 'ddasdsa_92.jpg', 2, 66),
(9, '5', 'ter', 5, 'ter_85.jpg', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_departamento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `admin` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `usuario_cedula`, `usuario_departamento`, `admin`) VALUES
(3, 'administradora', 'administradora', 'administradora', '$2y$10$m/8ACQdQv2UT5yyJFUE68uhM9.1QWZh06vShAPTAYv9JIkd0YFF4.', 'administradora@gmai.com', 'administrador', 'departamento1', '1'),
(61, 'Juanito', 'Perez', 'Juanita', '$2y$10$lZlqKZZ4oQESVOq2knihpezywUMaLS9JQHRTCHyJRUYQKo5gKmSgu', 'Juanito@Juanito.Juanito', '30182555', 'Juanito', '0'),
(62, 'Pedro', 'Pedro', 'Pedro', '$2y$10$XVqXfmypVrwgwm9lxWqhQuVnUZSIHHfAugNBakBq4Y3KnhtJGR8nq', 'Pedro@Pedro.Pedro', '1111111111', 'Pedro', '0'),
(63, 'Goku', 'Goku', 'Goku', 'Goku123', 'Goku@Goku.Goku', '3030303030', 'Goku', '1'),
(65, 'Prueba', 'Prueba', 'Prueba', '$2y$10$.kOcKs5KKd72czAYv1h2Qe/xuLwX3sthHXNHJ0luU6WwLxf2MSw1u', 'Prueba@Prueba.Prueba', '123123123', 'Prueba', '0'),
(66, 'Jose', 'Miguel', 'Gokusss', '$2y$10$07rbAqfhsXob.PVhoO.SI.jMBpzM991gTvqe4eYQdRN/qbqQi/JT6', 'Jose@gmail.com', '30182955', 'Informatica', '0'),
(67, 'Miguel', 'Jose', 'Josemig', '$2y$10$PwnAGUo4FoANXeMKwEAMEOl1PaPQC8WouBU3HmX8w1pD2TYpfHiDC', 'Joseleto@gmail.com', '14141114', 'Electricidad', '0'),
(68, 'Administrador', 'Jose', 'Administrador', '$2y$10$nUbPhY4T/kGoU7PPWkeh5uf.pOjSyCEjVI6LvT4zJc1o.A4sVsgRS', 'Administrador@gmail.com', '141411143', 'Electricidades', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`prestamo_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `usuario_cedula` (`usuario_cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `prestamo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
