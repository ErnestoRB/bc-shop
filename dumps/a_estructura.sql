-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: database:3306
-- Tiempo de generación: 08-12-2022 a las 22:16:34
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `development`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `codigo` varchar(50) NOT NULL,
  `porcentaje` int NOT NULL,
  `minim` int DEFAULT NULL,
  `maximo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`codigo`, `porcentaje`, `minim`, `maximo`) VALUES
('LLEGAMOS10', 10, 1000, NULL),
('NEWSHOES10', 10, NULL, NULL),
('QUINCEOFF', 15, 10000, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id`, `nombre`, `costo`) VALUES
(5, 'Recoger en tienda', 0),
(6, 'Envío estándar', 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idCategoria` int NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `existencia` int NOT NULL,
  `agregado` datetime DEFAULT CURRENT_TIMESTAMP,
  `precio` int NOT NULL,
  `imagen` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idusuario` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cuenta` char(20) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `admin` tinyint DEFAULT '0',
  `correo` varchar(50) NOT NULL,
  `bloqueo` tinyint(1) NOT NULL DEFAULT '0',
  `fallidos` tinyint(1) NOT NULL DEFAULT '0',
  `passgenerado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idusuario`, `nombre`, `apellidos`, `cuenta`, `contraseña`, `admin`, `correo`, `bloqueo`, `fallidos`, `passgenerado`) VALUES
(4, 'Administrador', 'Desarrollo', 'admin', '$2a$12$4Yh9ADohi28GQEn6ZGdCdOGWofYPWKsHrHjXM/exkU0S9oLPv/S5i', 1, 'no_reply_bc@outlook.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int NOT NULL,
  `idUsuario` int NOT NULL,
  `fecha` date NOT NULL,
  `idEnvio` int NOT NULL,
  `pago` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas`
--

CREATE TABLE `Ventas` (
  `ID_Venta` char(5) DEFAULT NULL,
  `Prenda` varchar(50) DEFAULT NULL,
  `Cantidad` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Ventas`
--

INSERT INTO `Ventas` (`ID_Venta`, `Prenda`, `Cantidad`) VALUES
('001', 'Camisa', 65),
('002', 'Pantalon', 201),
('003', 'Camiseta', 99),
('004', 'Calcetines', 106),
('005', 'Corbata', 54),
('006', 'Vestido', 322),
('007', 'Falda', 201),
('008', 'Collar', 48),
('009', 'Blusa', 196),
('010', 'Playera', 24),
('011', 'Zapatillas', 12),
('012', 'Sueter', 80),
('013', 'Sudadera', 89),
('014', 'Tennis', 213),
('015', 'Jeans', 299);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_cupon`
--

CREATE TABLE `venta_cupon` (
  `idVenta` int NOT NULL,
  `idCupon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `idProducto` int NOT NULL,
  `idVenta` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_oferta` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `idProducto_2` (`idProducto`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `Email` (`correo`),
  ADD UNIQUE KEY `id` (`idusuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idEnvio` (`idEnvio`);

--
-- Indices de la tabla `venta_cupon`
--
ALTER TABLE `venta_cupon`
  ADD PRIMARY KEY (`idVenta`,`idCupon`),
  ADD KEY `idCupon` (`idCupon`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`idProducto`,`idVenta`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idusuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idEnvio`) REFERENCES `envio` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `venta_cupon`
--
ALTER TABLE `venta_cupon`
  ADD CONSTRAINT `venta_cupon_ibfk_1` FOREIGN KEY (`idCupon`) REFERENCES `cupones` (`codigo`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `venta_cupon_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE CASCADE,
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;