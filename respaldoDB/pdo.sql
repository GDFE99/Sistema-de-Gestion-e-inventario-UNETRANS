DROP TABLE IF EXISTS auditoria;
CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `usuario_usuario` varchar(20) DEFAULT NULL,
  `tabla_afectada` varchar(255) DEFAULT NULL,
  `operacion` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `detalle` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO auditoria VALUES ('14', '111', '', 'producto', 'INSERT', '2024-05-13 19:39:40', '');
INSERT INTO auditoria VALUES ('15', '111', '', 'producto', 'INSERT', '2024-05-13 19:39:43', '');
INSERT INTO auditoria VALUES ('16', '111', '', 'producto', 'DELETE', '2024-05-13 19:45:12', '');
INSERT INTO auditoria VALUES ('17', '', '', 'producto', 'DELETE', '2024-05-13 19:55:07', '');
INSERT INTO auditoria VALUES ('18', '112', '', 'producto', 'INSERT', '2024-05-13 20:06:16', '');
INSERT INTO auditoria VALUES ('19', '112', '', 'producto', 'INSERT', '2024-05-13 20:06:20', '');
INSERT INTO auditoria VALUES ('20', '112', '', 'producto', 'INSERT', '2024-05-13 20:06:22', '');
INSERT INTO auditoria VALUES ('26', '111', '', 'producto', 'INSERT', '2024-05-13 21:00:18', '');
INSERT INTO auditoria VALUES ('27', '111', '', 'producto', 'DELETE', '2024-05-13 21:00:26', 'Producto eliminado. ID: 56');
INSERT INTO auditoria VALUES ('28', '111', '', 'producto', 'DELETE', '2024-05-14 19:34:13', 'Producto eliminado. ID: 57');
INSERT INTO auditoria VALUES ('29', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 19:34:13', 'Producto eliminado. ID: 57');
INSERT INTO auditoria VALUES ('30', '111', '', 'producto', 'DELETE', '2024-05-14 19:35:13', 'Producto eliminado. ID: 58');
INSERT INTO auditoria VALUES ('31', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 19:35:13', 'Producto eliminado. ID: 58');
INSERT INTO auditoria VALUES ('32', '112', '', 'producto', 'INSERT', '2024-05-14 19:35:57', '');
INSERT INTO auditoria VALUES ('33', '112', '', 'producto', 'INSERT', '2024-05-14 19:36:00', '');
INSERT INTO auditoria VALUES ('34', '112', '', 'producto', 'INSERT', '2024-05-14 19:36:03', '');
INSERT INTO auditoria VALUES ('35', '112', '', 'producto', 'INSERT', '2024-05-14 19:36:05', '');
INSERT INTO auditoria VALUES ('38', '112', '', 'producto', 'DELETE', '2024-05-14 19:38:48', 'Producto eliminado. ID: 62');
INSERT INTO auditoria VALUES ('39', '111', 'Joselito', 'producto', 'DELETE', '2024-05-14 19:38:48', 'Producto eliminado. ID: 62');
INSERT INTO auditoria VALUES ('40', '111', 'Joselito', 'producto', 'DELETE', '2024-05-14 19:41:11', 'Producto eliminado. ID: 60');
INSERT INTO auditoria VALUES ('41', '111', '', 'producto', 'INSERT', '2024-05-14 19:44:00', '');
INSERT INTO auditoria VALUES ('42', '111', '', 'producto', 'INSERT', '2024-05-14 19:44:25', '');
INSERT INTO auditoria VALUES ('43', '111', '', 'producto', 'INSERT', '2024-05-14 19:45:20', '');
INSERT INTO auditoria VALUES ('44', '111', '', 'producto', 'INSERT', '2024-05-14 19:45:21', 'Producto eliminado. ID: ');
INSERT INTO auditoria VALUES ('45', '111', '', 'producto', 'INSERT', '2024-05-14 19:46:21', '');
INSERT INTO auditoria VALUES ('46', '111', '', 'producto', 'INSERT', '2024-05-14 19:58:30', '');
INSERT INTO auditoria VALUES ('47', '111', 'Joselito', 'producto', 'INSERT', '2024-05-14 19:58:30', 'Producto registrado. Nombre: dsaf445rd');
INSERT INTO auditoria VALUES ('48', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 19:59:26', 'Producto eliminado. ID: 61');
INSERT INTO auditoria VALUES ('49', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 19:59:28', 'Producto eliminado. ID: 63');
INSERT INTO auditoria VALUES ('50', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 19:59:41', 'Producto eliminado. ID: 67');
INSERT INTO auditoria VALUES ('51', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 20:02:21', 'Producto eliminado. ID: dsaf4');
INSERT INTO auditoria VALUES ('52', '112', '', 'producto', 'INSERT', '2024-05-14 20:02:41', '');
INSERT INTO auditoria VALUES ('53', '112', 'Juan', 'producto', 'INSERT', '2024-05-14 20:02:41', 'Producto registrado. Nombre: asdssad');
INSERT INTO auditoria VALUES ('54', '112', 'Juan', 'producto', 'INSERT', '2024-05-14 20:03:40', 'Producto registrado. Nombre: asdssad4');
INSERT INTO auditoria VALUES ('55', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 20:03:46', 'Producto eliminado. Nombre: asdssad4');
INSERT INTO auditoria VALUES ('57', '112', 'Juan', 'producto', 'UPDATE', '2024-05-14 20:08:55', 'Producto actualizado. Nombre: asdssad');
INSERT INTO auditoria VALUES ('58', '112', '', 'profesores', 'INSERT', '2024-05-14 20:12:15', 'Nuevo profesor insertado. ID: 74');
INSERT INTO auditoria VALUES ('59', '112', 'Juan', 'profesor', 'INSERT', '2024-05-14 20:12:15', 'Profesor registrado. Nombre: das');
INSERT INTO auditoria VALUES ('60', '112', 'Juan', 'producto', 'DELETE', '2024-05-14 20:19:32', 'Producto eliminado. Nombre: asdssad');
INSERT INTO auditoria VALUES ('61', '112', 'Juan', 'profesor', 'DELETE', '2024-05-14 20:20:02', 'Profesor eliminado. Nombre: das');
INSERT INTO auditoria VALUES ('62', '112', 'Juan', 'profesor', 'INSERT', '2024-05-14 20:20:11', 'Profesor registrado. Nombre: dsad');
INSERT INTO auditoria VALUES ('63', '112', 'Juan', 'profesor', 'DELETE', '2024-05-14 20:20:15', 'Profesor eliminado. Nombre: dsad');
INSERT INTO auditoria VALUES ('64', '112', 'Juan', 'producto', 'INSERT', '2024-05-21 14:46:16', 'Producto registrado. Nombre: faf');
INSERT INTO auditoria VALUES ('65', '112', 'Juan', 'producto', 'INSERT', '2024-05-21 14:53:08', 'Producto registrado. Nombre: aaaaaaaaaaa');
INSERT INTO auditoria VALUES ('66', '112', 'Juan', 'producto', 'UPDATE', '2024-05-21 14:54:17', 'Producto actualizado. Nombre: aaaaaaaaaaa');
INSERT INTO auditoria VALUES ('67', '112', 'Juan', 'producto', 'UPDATE', '2024-05-21 14:54:24', 'Producto actualizado. Nombre: dsaf44');
INSERT INTO auditoria VALUES ('68', '112', 'Juan', 'profesor', 'INSERT', '2024-05-21 15:47:47', 'Profesor registrado. Nombre: dasd');
INSERT INTO auditoria VALUES ('69', '111', 'Joselito', 'producto', 'INSERT', '2024-05-21 16:12:03', 'Producto registrado. Nombre: dsada');
INSERT INTO auditoria VALUES ('70', '112', 'Juan', 'producto', 'DELETE', '2024-05-21 16:12:16', 'Producto eliminado. Nombre: dsada');
INSERT INTO auditoria VALUES ('71', '112', 'Juan', 'producto', 'UPDATE', '2024-05-21 16:12:30', 'Producto actualizado. Nombre: aaaaaaaaaaa');

DROP TABLE IF EXISTS categoria;
CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO categoria VALUES ('22', 'dsadsa', 'dewqeq');
INSERT INTO categoria VALUES ('23', 'ewew', 'weweewe');
INSERT INTO categoria VALUES ('24', 'aaaaaaaaa', 'aaaaaaaaaaaa');

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO prestamos VALUES ('75', '2', '2024-05-21', '2024-05-30', '65', '76');

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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO producto VALUES ('65', 'dasdad44', 'dsaf44', '0', 'dsaf44_54.jpg', '24', '111');
INSERT INTO producto VALUES ('66', 'dasdad445', 'dsaf445', '4', 'dsaf445_83.jpg', '22', '111');
INSERT INTO producto VALUES ('70', 'eqwewqe', 'faf', '4', '', '22', '112');
INSERT INTO producto VALUES ('71', 'aaaaaa', 'aaaaaaaaaaa', '5', '', '23', '112');

DROP TABLE IF EXISTS profesores;
CREATE TABLE `profesores` (
  `profesor_id` int(10) NOT NULL AUTO_INCREMENT,
  `profesor_nombre` varchar(40) NOT NULL,
  `profesor_apellido` varchar(40) NOT NULL,
  `profesor_cargo` varchar(50) NOT NULL,
  `profesor_departamento` varchar(50) NOT NULL,
  `profesor_cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario_id` int(10) NOT NULL,
  PRIMARY KEY (`profesor_id`),
  UNIQUE KEY `profesor_cedula` (`profesor_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO profesores VALUES ('76', 'dasd', 'dsad', 'Profesor', 'Telecomunicaciones', '2141', '112');

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO usuario VALUES ('1', 'administrador', 'administrador', 'administrador', '$2y$10$OqjyQbzSzijFXSXoF5h/8.8HFjn8WvlS.78ikGnHmew1BrQViDSUu', 'administrador@gmail.com', '303030', 'Electricidad', 'administrador', 'administrador', 'administrador', 'administrador', '1');
INSERT INTO usuario VALUES ('111', 'Joselito', 'Joselito', 'Joselito', '$2y$10$KUtwUCEaLrCA14LcknTtLefJYFB4c18cWS2gOE4keLlErq.E/ih.K', 'Joselito@Joselito.Joselito', '333333333', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'Joselito', 'Joselito', '0');
INSERT INTO usuario VALUES ('112', 'Juan', 'Mujica', 'Juan', '$2y$10$g8B3vOdzOTLsNkeKAE0lbuAz/ip2esfT8xp4F7Qa619K0uLsPmwSO', 'juan@juan.com', '30182565', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'azul', 'octubre', '0');

