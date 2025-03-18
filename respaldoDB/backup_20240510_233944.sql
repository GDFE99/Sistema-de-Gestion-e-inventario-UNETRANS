DROP TABLE IF EXISTS categoria;
CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS prestamos;
CREATE TABLE `prestamos` (
  `prestamo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(255) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `profesor_id` int(10) NOT NULL,
  PRIMARY KEY (`prestamo_id`),
  KEY `producto_id` (`producto_id`),
  KEY `prestamos_ibfk_3` (`profesor_id`),
  CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`producto_id`),
  CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`profesor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS producto;
CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `producto_stock` int(255) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS profesores;
CREATE TABLE `profesores` (
  `profesor_id` int(10) NOT NULL AUTO_INCREMENT,
  `profesor_nombre` varchar(40) NOT NULL,
  `profesor_apellido` varchar(40) NOT NULL,
  `profesor_cargo` varchar(50) NOT NULL,
  `profesor_departamento` varchar(50) NOT NULL,
  `profesor_cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`profesor_id`),
  UNIQUE KEY `profesor_cedula` (`profesor_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

DROP TABLE IF EXISTS usuario;
CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_departamento` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pregunta1` varchar(255) NOT NULL,
  `pregunta2` varchar(255) NOT NULL,
  `respuesta1` varchar(255) NOT NULL,
  `respuesta2` varchar(255) NOT NULL,
  `is_admin` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_cedula` (`usuario_cedula`),
  UNIQUE KEY `usuario_usuario` (`usuario_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO usuario VALUES ('1', 'administrador', 'administrador', 'administrador', '$2y$10$kJel3Dhh3BoOrGJfaNVPlOmQC/R/E5hj413qk/A3C17L.j1zbH1p6', 'administrador@gmail.com', '303030', 'Electricidad', 'administrador', 'administrador', 'administrador', 'administrador', '1');
INSERT INTO usuario VALUES ('111', 'Joselito', 'Joselito', 'Joselito', '$2y$10$KUtwUCEaLrCA14LcknTtLefJYFB4c18cWS2gOE4keLlErq.E/ih.K', 'Joselito@Joselito.Joselito', '333333333', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'Joselito', 'Joselito', '0');

