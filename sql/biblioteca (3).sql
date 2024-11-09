-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2024 a las 00:01:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `asignatura` varchar(50) DEFAULT NULL,
  `semestre` varchar(20) DEFAULT NULL,
  `calificacion` decimal(5,2) DEFAULT NULL,
  `estado` enum('Aprobado','Reprobado') DEFAULT 'Aprobado',
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `cedula` int(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `cedula`, `nombre`, `apellido`, `carrera`, `telefono`, `fecha_ingreso`) VALUES
(1, 12345678, 'Juan', 'Pérez', 'Sistemas', '04121234567', '2022-01-15'),
(2, 23456789, 'Maria', 'Rodriguez', 'Telecomunicaciones', '04141234567', '2022-02-18'),
(3, 34567890, 'Carlos', 'Gomez', 'Sistemas', '04241234567', '2023-03-20'),
(4, 45678901, 'Ana', 'Martinez', 'Telecomunicaciones', '04161234567', '2023-04-10'),
(5, 56789012, 'Luis', 'Fernandez', 'Sistemas', '04261234567', '2023-05-05'),
(6, 67890123, 'Elena', 'Lopez', 'Telecomunicaciones', '04121234568', '2023-06-01'),
(7, 78901234, 'José', 'Gonzalez', 'Sistemas', '04141234568', '2023-07-15'),
(8, 89012345, 'Sara', 'Hernandez', 'Telecomunicaciones', '04241234568', '2023-08-25'),
(9, 90123456, 'Ricardo', 'Ramirez', 'Sistemas', '04161234568', '2023-09-30'),
(10, 1234567, 'Patricia', 'Rojas', 'Telecomunicaciones', '04261234568', '2023-10-12'),
(11, 11234567, 'Andres', 'Diaz', 'Sistemas', '04121234569', '2022-11-10'),
(12, 22345678, 'Paola', 'Morales', 'Telecomunicaciones', '04141234569', '2022-12-21'),
(13, 33456789, 'Javier', 'Castillo', 'Sistemas', '04241234569', '2022-01-17'),
(14, 44567890, 'Gabriela', 'Suarez', 'Telecomunicaciones', '04161234569', '2022-02-22'),
(15, 55678901, 'Miguel', 'Gutierrez', 'Sistemas', '04261234569', '2022-03-29'),
(16, 66789012, 'Natalia', 'Pena', 'Telecomunicaciones', '04121234570', '2022-04-15'),
(17, 77890123, 'Sergio', 'Vega', 'Sistemas', '04141234570', '2022-05-19'),
(18, 88901234, 'Carmen', 'Mendoza', 'Telecomunicaciones', '04241234570', '2022-06-25'),
(19, 99012345, 'Diana', 'Rivas', 'Sistemas', '04161234570', '2022-07-30'),
(20, 10234567, 'Victor', 'Torres', 'Telecomunicaciones', '04261234570', '2022-08-14'),
(21, 21234567, 'Monica', 'Peralta', 'Sistemas', '04121234571', '2022-09-16'),
(22, 32345678, 'Enrique', 'Navarro', 'Telecomunicaciones', '04141234571', '2022-10-20'),
(23, 43456789, 'Daniela', 'Campos', 'Sistemas', '04241234571', '2022-11-30'),
(24, 54567890, 'Armando', 'Romero', 'Telecomunicaciones', '04161234571', '2022-12-15'),
(25, 65678901, 'Lorena', 'Mendez', 'Sistemas', '04261234571', '2023-01-10'),
(26, 76789012, 'Oscar', 'Santos', 'Telecomunicaciones', '04121234572', '2023-02-14'),
(27, 87890123, 'Liliana', 'Silva', 'Sistemas', '04141234572', '2023-03-22'),
(28, 98901234, 'Ramiro', 'Montilla', 'Telecomunicaciones', '04241234572', '2023-04-11'),
(29, 19012345, 'Isabel', 'Galindo', 'Sistemas', '04161234572', '2023-05-13'),
(30, 29012346, 'Mario', 'Vargas', 'Telecomunicaciones', '04261234572', '2023-06-16'),
(31, 39012347, 'Alicia', 'Bustamante', 'Sistemas', '04121234573', '2023-07-19'),
(32, 49012348, 'Luis', 'Villalobos', 'Telecomunicaciones', '04141234573', '2023-08-21'),
(33, 59012349, 'Gloria', 'Castro', 'Sistemas', '04241234573', '2023-09-28'),
(34, 69012340, 'Fabio', 'Perez', 'Telecomunicaciones', '04161234573', '2023-10-15'),
(35, 79012341, 'Martha', 'Duran', 'Sistemas', '04261234573', '2023-11-19'),
(36, 89012342, 'Victor', 'Meza', 'Telecomunicaciones', '04121234574', '2023-12-22'),
(37, 99012343, 'Ines', 'Pino', 'Sistemas', '04141234574', '2023-01-27'),
(38, 9123444, 'Raul', 'Ortega', 'Telecomunicaciones', '04241234574', '2023-02-18'),
(39, 19123445, 'Karina', 'Palacio', 'Sistemas', '04161234574', '2023-03-20'),
(40, 29123446, 'Jesus', 'Chavez', 'Telecomunicaciones', '04261234574', '2023-04-15'),
(41, 39123447, 'Sonia', 'Salas', 'Sistemas', '04121234575', '2023-05-10'),
(42, 49123448, 'Camilo', 'Oliva', 'Telecomunicaciones', '04141234575', '2023-06-08'),
(43, 59123449, 'Vanessa', 'Quiroz', 'Sistemas', '04241234575', '2023-07-21'),
(44, 69123440, 'Felix', 'Ruiz', 'Telecomunicaciones', '04161234575', '2023-08-23'),
(45, 79123441, 'Susana', 'Vivas', 'Sistemas', '04261234575', '2023-09-25'),
(46, 89123442, 'Roberto', 'Valdez', 'Telecomunicaciones', '04121234576', '2023-10-29'),
(47, 99123443, 'Estela', 'Rincon', 'Sistemas', '04141234576', '2023-11-30'),
(48, 9234544, 'Julio', 'Brito', 'Telecomunicaciones', '04241234576', '2023-12-05'),
(49, 19234545, 'Yesenia', 'Carrillo', 'Sistemas', '04161234576', '2024-01-12'),
(50, 29234546, 'Marcos', 'Fajardo', 'Telecomunicaciones', '04261234576', '2024-02-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `correo`, `contrasena`) VALUES
(6, 'josue', 'henriquez', 'zona gamers', 'henriquezjosue384@gmail.com', '$2y$10$OgUJhAM7/K3dVUAc7IRbQOwMdpiMkoV6xJPWLgM863BuUWvODGvYa'),
(7, 'josue', 'henriquez', 'zona gamersasdsad', 'henriquezjosue384213@gmail.com', '$2y$10$BvK39Jawwk1/67VVdGIxeeV/sKLh2iu0c7mn.SkTgvN6KzUgbJFv2'),
(8, 'sadsad', 'Henriquez', 'explosion544', 'henriquezjosue3845@gmail.com', '$2y$10$pukr4e70/38J57NxHE24Ke5VnXffQtfXKDy4CnxeewFKV6h2.APjK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
