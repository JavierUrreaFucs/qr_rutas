-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2024 a las 17:10:03
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rutas_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `nombre_facultad` varchar(50) CHARACTER SET utf8 NOT NULL,
  `activo_facultad` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre_facultad`, `activo_facultad`) VALUES
(0, 'sin dato', 0),
(1, 'Facultad de Enfermería', 1),
(2, 'Facultad de Tecnologías', 1),
(3, 'Facultad de Medicina', 1),
(4, 'Facultad Instrumentación', 1),
(5, 'Facultad Ciencias Sociales y de Educación', 1),
(6, 'Facultad de Ciencias del Movimiento', 1),
(7, 'Facultad de Ciencias Administrativas en Salud', 1),
(8, 'Personal Administrativo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int(10) NOT NULL,
  `nombre_login` varchar(100) CHARACTER SET utf8 NOT NULL,
  `login_id_tipo` int(2) NOT NULL DEFAULT 1,
  `correo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `facultad_nombre` varchar(30) NOT NULL,
  `terminos_condiciones` int(2) NOT NULL,
  `fecha_creo_login` datetime NOT NULL,
  `fecha_actualizacion_login` datetime NOT NULL,
  `fecha_ultimo_ingreso` datetime NOT NULL,
  `activo_login` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `nombre_login`, `login_id_tipo`, `correo`, `password`, `facultad_nombre`, `terminos_condiciones`, `fecha_creo_login`, `fecha_actualizacion_login`, `fecha_ultimo_ingreso`, `activo_login`) VALUES
(25, 'Javier Pruebas', 1, 'jhurrea@fucsalud.edu.co', '$2y$10$969E/2kX5zzcGZ1M/J25JOlqantgZOtb/ARsXQpwbZhd5bTu31SAa', 'Personal Administrativo', 0, '2023-12-27 20:18:43', '2023-12-27 20:18:43', '2024-09-19 14:28:14', 1),
(26, 'Prueba de campos', 2, 'ejemplo@gmail.com', '$2y$10$tAj2sWEA.p9smEaGxDkrCeINq5uusk89Kwb1kiB9ScH.JAQ3dn2TG', 'Facultad de Ciencias Administr', 0, '2023-12-28 16:56:41', '2023-12-28 16:56:41', '2024-01-03 21:23:22', 1),
(27, 'Prueba javier fecha', 4, 'casi@gmail.com', '$2y$10$TdQhQG6ySpo37DGk6Gd9v.YByCv7b1fRX98JxLyKxpdHre/YozTmG', 'Personal Administrativo', 0, '2023-12-28 17:12:16', '2023-12-28 17:12:16', '2023-12-28 17:12:16', 1),
(28, 'Usuario 2', 4, 'usuario3@gmail.com', '$2y$10$JbWTaSoCK7gloexA4byT5.BwnCjIketDRhi8cGq41FakJdzbFQXTq', 'Facultad de Enfermería', 0, '2023-12-29 17:41:56', '2023-12-29 17:41:56', '2023-12-29 17:45:49', 1),
(29, 'Javier prueba', 2, 'prueba@fucsalud.edu.co', '$2y$10$Hy6tQaYUPVupPPXT8w9D7Oq89EIqsvnXaYuQgjfDRRvgk6dDhAHiG', 'Facultad de Medicina', 0, '2024-01-05 09:50:02', '2024-01-05 09:50:02', '2024-01-05 09:50:20', 1),
(30, 'Prueba fucs', 1, 'mi@fucsalud.edu.co', '$2y$10$Zcd3rd.qcqDiSIilPF745OD7flTjaXV0GIBrzaPJRr9johI9BWQ0K', 'Personal Administrativo', 0, '2024-09-19 14:59:03', '2024-09-19 14:59:03', '2024-09-19 14:59:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(12) NOT NULL,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cedula_reserva` int(15) NOT NULL,
  `correo_reserva` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo_login_nombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nombre_facultad` varchar(100) CHARACTER SET utf8 NOT NULL,
  `rutas_id_rutas` int(10) NOT NULL,
  `destino_ruta` varchar(50) CHARACTER SET utf8 NOT NULL,
  `horario_ruta` varchar(10) NOT NULL,
  `reserva_cupo` int(1) NOT NULL DEFAULT 1,
  `valor_pagar` int(20) DEFAULT NULL,
  `reserva_pago` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `nombre_usuario`, `cedula_reserva`, `correo_reserva`, `fecha_solicitud`, `tipo_login_nombre`, `nombre_facultad`, `rutas_id_rutas`, `destino_ruta`, `horario_ruta`, `reserva_cupo`, `valor_pagar`, `reserva_pago`) VALUES
(11, 'Javier Pruebas', 111222333, 'jhurrea@fucsalud.edu.co', '2024-01-03 19:36:34', 'Administrativo', 'Personal Administrativo', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 0, 'Pagado'),
(12, 'Prueba de campos', 111111, 'ejemplo@gmail.com', '2024-09-18 18:48:51', 'Estudiante', 'Facultad de Ciencias Administr', 2, 'Sede centro - Sede norte', '12:30 p.m', 1, 2000, 'Pagado'),
(13, 'Prueba de campos', 111111, 'ejemplo@gmail.com', '2024-09-18 18:49:20', 'Estudiante', 'Facultad de Ciencias Administr', 4, 'Sede norte - Sede centro', '1:10 p.m.', 1, 2000, 'Pagado'),
(14, 'Usuario 2', 333333, 'usuario3@gmail.com', '2024-01-03 19:36:38', 'Administrativo', 'Facultad de Enfermería', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 0, 'Pagado'),
(19, 'Usuario 2', 333333, 'usuario3@gmail.com', '2023-12-29 22:57:03', 'Administrativo', 'Facultad de Enfermería', 2, 'Sede norte - Sede centro', '12:30 p.m', 1, 0, 'Pagado'),
(20, 'Prueba de campos', 111111, 'ejemplo@gmail.com', '2024-01-03 19:36:41', 'Estudiante', 'Facultad de Ciencias Administr', 4, 'Sede centro - Sede norte', '1:10 p.m', 1, 2000, 'Pendiente pago'),
(21, 'Prueba de campos', 111111, 'ejemplo@gmail.com', '2023-12-29 23:19:47', 'Estudiante', 'Facultad de Ciencias Administr', 2, 'Sede centro - Sede norte', '12:30 p.m', 1, 2000, 'Pendiente pago'),
(22, 'Prueba de campos', 111111, 'ejemplo@gmail.com', '2024-01-03 21:23:31', 'Estudiante', 'Facultad de Ciencias Administr', 4, 'Sede centro - Sede norte', '1:10 p.m', 1, 2000, 'Pendiente pago'),
(23, 'Javier Pruebas', 111222333, 'jhurrea@fucsalud.edu.co', '2024-01-04 19:45:49', 'Administrador', 'Personal Administrativo', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 0, 'Pagado'),
(25, 'Javier Pruebas', 111222333, 'jhurrea@fucsalud.edu.co', '2024-01-04 13:56:37', 'Administrador', 'Personal Administrativo', 3, 'Sede norte - Sede centro', '12:00 m', 1, 0, 'Pagado'),
(26, 'Javier Pruebas', 111222333, 'jhurrea@fucsalud.edu.co', '2024-01-04 13:56:43', 'Administrador', 'Personal Administrativo', 4, 'Sede norte - Sede centro', '1:10 p.m', 1, 0, 'Pagado'),
(27, 'Javier prueba', 123456789, 'prueba@fucsalud.edu.co', '2024-01-05 14:50:31', 'Estudiante', 'Facultad de Medicina', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 2000, 'Pendiente pago'),
(28, 'Javier prueba', 123456789, 'prueba@fucsalud.edu.co', '2024-01-05 14:50:42', 'Estudiante', 'Facultad de Medicina', 2, 'Sede centro - Sede norte', '12:30 p.m', 1, 2000, 'Pendiente pago'),
(29, 'Javier prueba', 123456789, 'prueba@fucsalud.edu.co', '2024-01-05 14:50:48', 'Estudiante', 'Facultad de Medicina', 3, 'Sede norte - Sede centro', '12:00 m', 1, 2000, 'Pendiente pago'),
(30, 'Javier prueba', 123456789, 'prueba@fucsalud.edu.co', '2024-01-05 14:50:54', 'Estudiante', 'Facultad de Medicina', 4, 'Sede norte - Sede centro', '1:10 p.m', 1, 2000, 'Pendiente pago'),
(31, 'Javier Pruebas', 111222333, 'jhurrea@fucsalud.edu.co', '2024-09-18 20:56:07', 'Administrador', 'Personal Administrativo', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 0, 'Pagado'),
(32, 'Prueba fucs', 12345678, 'jhurrea@fucsalud.edu.co', '2024-09-19 12:28:44', 'Estudiante', '8', 1, 'Sede centro - Sede norte', '11:20 a.m', 1, 1000, 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_rutas` int(10) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `horario` varchar(10) NOT NULL,
  `cupo` int(20) NOT NULL,
  `ubicacion_recogida` varchar(50) DEFAULT NULL,
  `presentar` varchar(30) DEFAULT NULL,
  `activo_rutas` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_rutas`, `destino`, `horario`, `cupo`, `ubicacion_recogida`, `presentar`, `activo_rutas`) VALUES
(1, 'Sede centro - Sede norte', '11:20 a.m', 7, 'Resonancia magnética - HSJ', 'Ficha color amarillo', 1),
(2, 'Sede centro - Sede norte', '12:30 p.m', 18, 'Resonancia magnética - HSJ', 'Ficha color azul', 1),
(3, 'Sede norte - Sede centro', '12:00 m', 16, 'Frente edificio fisiología', 'Carné FUCS', 1),
(4, 'Sede norte - Sede centro', '1:10 p.m', 16, 'Frente edificio fisiología', 'Carné FUCS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_login`
--

CREATE TABLE `tipo_login` (
  `id_tipo_login` int(2) NOT NULL,
  `nombre_tipo_login` varchar(20) NOT NULL,
  `activo_tipo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_login`
--

INSERT INTO `tipo_login` (`id_tipo_login`, `nombre_tipo_login`, `activo_tipo`) VALUES
(1, 'Administrador', 2),
(2, 'Estudiante', 1),
(3, 'Docente', 1),
(4, 'Administrativo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`id_facultad`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_login_id_tipo` (`login_id_tipo`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_rutas`) USING BTREE;

--
-- Indices de la tabla `tipo_login`
--
ALTER TABLE `tipo_login`
  ADD PRIMARY KEY (`id_tipo_login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tipo_login`
--
ALTER TABLE `tipo_login`
  MODIFY `id_tipo_login` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
