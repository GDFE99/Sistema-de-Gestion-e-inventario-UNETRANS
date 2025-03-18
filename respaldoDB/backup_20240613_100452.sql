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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO auditoria VALUES ('1', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-22 18:20:01', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('2', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-22 18:20:14', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('3', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-22 18:20:18', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('4', '112', 'Juan', 'categoria', 'INSERT', '2024-05-22 18:20:32', 'Categoría creada. Nombre: dsadsadff, Ubicación: dsadasdsadff');
INSERT INTO auditoria VALUES ('5', '112', 'Juan', 'categoria', 'DELETE', '2024-05-22 18:34:51', 'Categoria eliminada. Nombre:  sadsadasdd');
INSERT INTO auditoria VALUES ('6', '112', 'Juan', 'categoria', 'UPDATE', '2024-05-22 18:36:19', 'Categoria actualizada. Nombre: aaaaaaaaaa');
INSERT INTO auditoria VALUES ('7', '112', 'Juan', 'producto', 'INSERT', '2024-05-22 18:36:46', 'Producto registrado. Nombre: dsadasd');
INSERT INTO auditoria VALUES ('8', '112', 'Juan', 'producto', 'UPDATE', '2024-05-22 18:36:52', 'Producto actualizado. Nombre: faf');
INSERT INTO auditoria VALUES ('9', '112', 'Juan', 'producto', 'DELETE', '2024-05-22 18:37:52', 'Producto eliminado. Nombre: aaaaaaaaaaa');
INSERT INTO auditoria VALUES ('10', '112', 'Juan', 'profesor', 'INSERT', '2024-05-22 18:38:05', 'Profesor registrado. Nombre: jose');
INSERT INTO auditoria VALUES ('11', '112', 'Juan', 'profesor', 'DELETE', '2024-05-22 18:38:11', 'Profesor eliminado. Nombre: jose');
INSERT INTO auditoria VALUES ('12', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-22 18:40:12', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('13', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-22 18:41:16', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('14', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-22 18:41:17', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('15', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-22 18:41:28', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('16', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-22 18:42:24', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('17', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-22 18:42:27', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('18', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-22 18:45:05', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('19', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-22 18:45:08', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('20', '111', 'Joselito', 'usuarios', 'INSERT', '2024-05-22 18:45:26', 'Usuario registrado. Nombre: Gokusss');
INSERT INTO auditoria VALUES ('21', '111', 'Joselito', 'usuarios', 'INSERT', '2024-05-22 18:46:50', 'Usuario registrado. Nombre: GOkussse');
INSERT INTO auditoria VALUES ('22', '111', 'Joselito', 'usuarios', 'DELETE', '2024-05-22 18:48:28', 'Usuario eliminado. Nombre: Gokussse');
INSERT INTO auditoria VALUES ('23', '111', 'Joselito', 'usuarios', 'UPDATE', '2024-05-22 18:50:35', 'Usuario actualizado. Usuario: Juan');
INSERT INTO auditoria VALUES ('24', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-22 18:53:54', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('25', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-22 18:53:56', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('26', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-22 18:53:57', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('27', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-22 18:53:59', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('28', '112', 'Juanae', 'prestamos', 'INSERT', '2024-05-22 18:59:43', 'Prestamo realizado. Nombre: 70, 1 por 76');
INSERT INTO auditoria VALUES ('29', '112', 'Juanae', 'prestamos', 'INSERT', '2024-05-22 19:02:36', 'Prestamo realizado. Nombre: , 1 por ');
INSERT INTO auditoria VALUES ('30', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-23 00:11:00', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('31', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-23 00:11:05', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('32', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-23 00:11:08', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('33', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:16:06', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('34', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:17:23', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('35', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:17:24', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('36', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:21:41', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('37', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:21:43', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('38', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:21:46', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('39', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:22:22', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('40', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:22:27', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('41', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:22:29', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('42', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:22:56', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('43', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:22:57', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('44', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:22:59', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('45', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:23:00', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('46', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:23:32', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('47', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:23:33', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('48', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-25 17:24:54', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('49', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-25 17:24:58', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('50', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:15:20', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('51', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:15:29', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('52', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:15:32', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('53', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:18:29', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('54', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:18:37', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('55', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:21:48', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('56', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:24:16', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('57', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:24:18', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('58', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:24:27', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('59', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-30 19:24:29', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('60', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-30 19:24:42', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('61', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-30 19:24:43', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('62', '112', 'Juanae', 'usuarios', 'INSERT', '2024-05-30 19:25:39', 'Usuario registrado. Usuario: Terance');
INSERT INTO auditoria VALUES ('63', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-30 19:25:40', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('64', '116', 'Terance', 'usuarios', 'Inicio de sesión', '2024-05-30 19:25:54', 'Usuario: Terance inició sesión.');
INSERT INTO auditoria VALUES ('65', '116', 'Terance', 'usuarios', 'Cierre de sesión', '2024-05-30 19:26:04', 'Usuario: Terance cerró sesión.');
INSERT INTO auditoria VALUES ('66', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-30 19:32:08', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('67', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:32:12', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('68', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 19:34:16', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('69', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 19:34:17', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('70', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 20:03:36', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('71', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 20:03:39', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('72', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 20:03:40', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('73', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 20:03:41', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('74', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 20:04:34', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('75', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 20:04:36', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('76', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-30 20:08:37', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('77', '111', 'Joselito', 'usuarios', 'Inicio de sesión', '2024-05-30 20:10:45', 'Usuario: Joselito inició sesión.');
INSERT INTO auditoria VALUES ('78', '111', 'Joselito', 'usuarios', 'Cierre de sesión', '2024-05-31 00:25:25', 'Usuario: Joselito cerró sesión.');
INSERT INTO auditoria VALUES ('79', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-31 00:25:30', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('80', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-31 00:27:17', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('81', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-31 00:27:40', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('82', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-05-31 00:28:34', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('83', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-31 00:28:44', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('84', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-05-31 00:33:41', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('85', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-12 17:52:29', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('86', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 17:52:31', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('87', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-12 18:27:23', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('88', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 18:27:44', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('89', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-12 18:28:41', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('90', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 18:28:42', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('91', '112', 'Juanae', 'producto', 'UPDATE', '2024-06-12 18:46:27', 'Producto actualizado. Nombre: dsadasd');
INSERT INTO auditoria VALUES ('92', '112', 'Juanae', 'categoria', 'INSERT', '2024-06-12 18:46:39', 'Prestamo creado. por: , ');
INSERT INTO auditoria VALUES ('93', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-12 23:25:08', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('94', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 23:25:40', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('95', '112', 'Juanae', 'categoria', 'INSERT', '2024-06-12 23:28:52', 'Prestamo creado. por: , ');
INSERT INTO auditoria VALUES ('96', '112', 'Juanae', 'usuarios', 'INSERT', '2024-06-12 23:37:22', 'Usuario registrado. Usuario: Rodolius');
INSERT INTO auditoria VALUES ('97', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 23:42:12', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('98', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 23:42:16', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('99', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 23:42:24', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('100', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-12 23:44:46', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('101', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 00:07:06', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('102', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 00:07:55', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('103', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 00:08:12', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('104', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 01:15:15', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('105', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 02:56:20', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('106', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 02:56:21', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('107', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 02:59:00', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('108', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 02:59:37', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('109', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:00:17', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('110', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:00:28', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('111', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:05:15', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('112', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:05:18', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('113', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:05:19', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('114', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:05:20', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('115', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:05:21', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('116', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:05:22', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('117', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:05:23', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('118', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:14:15', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('119', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:29:18', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('120', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:29:31', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('121', '112', 'Juan', 'usuarios', 'Cierre de sesión', '2024-06-13 03:29:42', 'Usuario: Juan cerró sesión.');
INSERT INTO auditoria VALUES ('122', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:30:18', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('123', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:37:34', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('124', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:40:04', 'Usuario: Juan inició sesión.');
INSERT INTO auditoria VALUES ('125', '112', 'Juan', 'usuarios', 'Inicio de sesión', '2024-06-13 03:41:37', 'Usuario: Juan inició sesión.');

DROP TABLE IF EXISTS categoria;
CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO categoria VALUES ('22', 'dsadsa', 'dewqeq');
INSERT INTO categoria VALUES ('23', 'ewew', 'weweewe');
INSERT INTO categoria VALUES ('24', 'aaaaaaaaaa', 'aaaaaaaaaaaa');
INSERT INTO categoria VALUES ('25', 'dsadsad', 'dsadsad');
INSERT INTO categoria VALUES ('26', 'ewqeqw', 'eeqweq');
INSERT INTO categoria VALUES ('27', 'dsadsade', 'dasdsae');
INSERT INTO categoria VALUES ('28', 'dsadsadefdf', 'dasdsaefd');
INSERT INTO categoria VALUES ('29', 'sadsadasd', 'adsadadsasd');
INSERT INTO categoria VALUES ('31', 'dsadsadff', 'dsadasdsadff');

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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO prestamos VALUES ('75', '2', '2024-05-21', '2024-05-30', '65', '76');
INSERT INTO prestamos VALUES ('77', '1', '2024-05-22', '2024-05-24', '70', '76');
INSERT INTO prestamos VALUES ('78', '1', '2024-05-22', '2024-05-28', '66', '76');
INSERT INTO prestamos VALUES ('79', '1', '2024-05-22', '2024-05-31', '70', '76');
INSERT INTO prestamos VALUES ('80', '1', '2024-05-22', '2024-05-31', '70', '76');
INSERT INTO prestamos VALUES ('81', '1', '2024-05-22', '2024-05-31', '73', '76');
INSERT INTO prestamos VALUES ('82', '1', '2024-05-22', '2024-05-31', '73', '76');
INSERT INTO prestamos VALUES ('83', '1', '2024-05-22', '2024-05-31', '73', '76');
INSERT INTO prestamos VALUES ('84', '1', '2024-06-12', '2024-06-19', '73', '76');
INSERT INTO prestamos VALUES ('85', '1', '2024-06-12', '2024-06-21', '73', '76');

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO producto VALUES ('65', 'dasdad44', 'dsaf44', '0', 'dsaf44_54.jpg', '24', '111');
INSERT INTO producto VALUES ('66', 'dasdad445', 'dsaf445', '0', 'dsaf445_83.jpg', '22', '111');
INSERT INTO producto VALUES ('70', 'eqwewqee', 'faf', '0', '', '22', '112');
INSERT INTO producto VALUES ('73', 'dsada', 'dsadasd', '-1', '', '22', '112');

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
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
  `is_admin` enum('0','1','2') DEFAULT '0',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_cedula` (`usuario_cedula`),
  UNIQUE KEY `usuario_usuario` (`usuario_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO usuario VALUES ('1', 'administrador', 'administrador', 'administrador', '$2y$10$OqjyQbzSzijFXSXoF5h/8.8HFjn8WvlS.78ikGnHmew1BrQViDSUu', 'administrador@gmail.com', '303030', 'Electricidad', 'administrador', 'administrador', 'administrador', 'administrador', '1');
INSERT INTO usuario VALUES ('111', 'Joselito', 'Joselito', 'Joselito', '$2y$10$KUtwUCEaLrCA14LcknTtLefJYFB4c18cWS2gOE4keLlErq.E/ih.K', 'Joselito@Joselito.Joselito', '333333333', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'Joselito', 'Joselito', '2');
INSERT INTO usuario VALUES ('112', 'Juanae', 'Mujica', 'Juan', '$2y$10$VexPzKqgMcvJ3elhvnJCF.I7CM0OqkE7o3nm8rTHOpMTszy/9C4ia', 'juan@juan.com', '30182565', 'Telecomunicaciones', 'Cuándo es tu cumpleaños', 'Color Favorito', 'dsad', 'dsad', '1');
INSERT INTO usuario VALUES ('114', 'Gokusss', 'GOkusss', 'GOkusss', '$2y$10$vnO9eU5qRjFblI2AECFiJ.kkSWjAhicGTLwTlIG53UMfu3JZ2Gmz6', 'GOkusss@GOkusss.GOkusss', '312414124', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'GOkusss', 'GOkusss', '0');
INSERT INTO usuario VALUES ('116', 'Terance', 'Terance', 'Terance', '$2y$10$EBQZqpWYddYTaPpwFXawt.MrafPB76WMzYpju9ihUBHELGMsylnS2', 'Terance@Terance.Terance', '312341', 'Electronica', '¿Color Favorito?', '¿Cuándo es tu cumpleaños?', 'Terance', 'Terance', '2');
INSERT INTO usuario VALUES ('117', 'Rodolius', 'Rodolius', 'Rodolius', '$2y$10$L4bkdyhpuXbEUy.p3UWQ..ZhCEm/KOM4mNv1nRnTbpVc5rZhtC.XC', 'Rodolius@Rodolius.Rodolius', '4241124', 'Electronica', '¿Cuándo es tu cumpleaños?', '¿Color Favorito?', 'Rodolius', 'Rodolius', '0');

