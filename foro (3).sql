-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2025 a las 09:47:06
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `ide_pos` int(11) NOT NULL,
  `ide_usu` int(11) NOT NULL,
  `tit_pos` varchar(255) NOT NULL,
  `tex_pos` varchar(100) NOT NULL,
  `fec_pos` datetime DEFAULT current_timestamp(),
  `can_pos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`ide_pos`, `ide_usu`, `tit_pos`, `tex_pos`, `fec_pos`, `can_pos`) VALUES
(1, 1, 'Mi primer post sobre Programacion', 'El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al cont', '2024-01-01 10:00:00', 6),
(2, 2, 'Aprendiendo Html y Css', 's de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ip', '2024-01-02 12:30:00', 2),
(3, 3, 'Consejos de programación en Java', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteracione', '2024-01-03 15:45:00', 2),
(4, 4, 'Base de datos NO relacionales', 'El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquello', '2024-01-04 18:20:00', 3),
(5, 5, 'Errores comunes en SQL', 'sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un dicciona', '2024-01-05 20:10:00', 3),
(6, 6, 'Buenas prácticas en Android Studio', 'Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante e', '2024-01-06 09:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `ide_res` int(11) NOT NULL,
  `ide_pos` int(11) NOT NULL,
  `ide_usu` int(11) NOT NULL,
  `tex_res` text NOT NULL,
  `fec_res` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`ide_res`, `ide_pos`, `ide_usu`, `tex_res`, `fec_res`) VALUES
(1, 1, 2, 'Buen artículo, me sirvió mucho.', '2024-01-01 11:00:00'),
(2, 1, 3, 'Gracias por compartir.', '2024-01-01 11:30:00'),
(3, 2, 4, 'SQL es fundamental en desarrollo.', '2024-01-02 14:00:00'),
(4, 3, 1, 'Muy buenos consejos, los aplicaré.', '2024-01-03 16:10:00'),
(5, 4, 5, 'Gran aporte sobre bases de datos.', '2024-01-04 19:00:00'),
(6, 5, 6, 'Interesante, desconocía algunos errores.', '2024-01-05 21:00:00'),
(20, 5, 16, 'Muy buena aportacion', '2025-02-13 08:48:04'),
(21, 1, 16, 'Buena aportacion', '2025-02-13 08:48:32'),
(22, 1, 16, 'Lo tendré en cuenta', '2025-02-13 09:00:29'),
(23, 2, 16, 'Yo siempre utilizo Css', '2025-02-13 09:00:48'),
(24, 3, 16, 'Yo recomiendo utilizar NetBeans', '2025-02-13 09:02:13'),
(25, 4, 16, 'MongoDb', '2025-02-13 09:02:34'),
(26, 4, 16, 'Mysql es base de datos relacional', '2025-02-13 09:02:48'),
(27, 5, 16, 'Es importante utilizar Workbench para depurar errores', '2025-02-13 09:03:33'),
(28, 6, 16, 'Android Studio me gusta mucho', '2025-02-13 09:03:59'),
(29, 1, 17, 'Para programar hay que tener paciencia', '2025-02-13 09:06:27'),
(35, 1, 18, 'ES UNA RESPUESTA', '2025-02-13 09:44:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ide_usu` int(11) NOT NULL,
  `nom_usu` varchar(100) NOT NULL,
  `ema_usu` varchar(100) NOT NULL,
  `con_usu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ide_usu`, `nom_usu`, `ema_usu`, `con_usu`) VALUES
(1, 'javi', 'javi@javi', '123'),
(2, 'lima', 'usu1@lim', '123'),
(3, 'Juan Pérez', 'juan@example.com', 'password123'),
(4, 'María García', 'maria@example.com', 'clave456'),
(5, 'Carlos López', 'carlos@example.com', 'segura789'),
(6, 'Ana Martínez', 'ana@example.com', 'pass2023'),
(7, 'David Fernández', 'david@example.com', 'davidpass'),
(8, 'Laura Sánchez', 'laura@example.com', 'laurasec'),
(9, 'Pedro', 'pedro@pedro.com', '1234'),
(10, 'JOSEEEE', 'JOSEEEE@JOSEEEE.COM', '1234'),
(11, 'FALSOO', 'FALSAO@FRGF', '123'),
(12, 'ELENA', 'ELENA@ELENA', '123'),
(13, '121212', '121212@121212', '121212'),
(14, 'NUEVOUSUARIO', 'nuevo@nuevo', '1234'),
(15, 'NUEVOUSUARIO', '1@1', '1111'),
(16, 'javier123', 'javier123@javier123.com', 'javier123'),
(17, 'alvaro6565', 'alvaro6565@alvaro6565.es', 'alvaro6565'),
(18, 'SaraR1235', 'Sara@gmail.com', 'Pasword34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ide_pos`),
  ADD KEY `ide_usu` (`ide_usu`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ide_res`),
  ADD KEY `ide_pos` (`ide_pos`),
  ADD KEY `ide_usu` (`ide_usu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ide_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `ide_pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ide_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ide_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`ide_usu`) REFERENCES `usuarios` (`ide_usu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`ide_pos`) REFERENCES `posts` (`ide_pos`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`ide_usu`) REFERENCES `usuarios` (`ide_usu`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
