-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 05:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

CREATE DATABASE IF NOT EXISTS development;
USE development;

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria`
(
  `idCategoria` int
(11) NOT NULL,
  `nombre` varchar
(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cupones`
--

CREATE TABLE `cupones`
(
  `codigo` varchar
(50) NOT NULL,
  `porcentaje` int
(11) NOT NULL,
  `minim` int
(11) NOT NULL,
  `maximo` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cupones`
ADD PRIMARY KEY
(`codigo`);


-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos`
(
  `idProducto` int
(10) NOT NULL,
  `nombre` varchar
(100) NOT NULL,
  `idCategoria` int
(5) NOT NULL,
  `descripcion` varchar
(100) NOT NULL,
  `existencia` int
(5) NOT NULL,
`agregado` datetime DEFAULT CURRENT_TIMESTAMP,
  `precio` int
(5) NOT NULL,
  `imagen` varchar
(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
  `idusuario` int
(11) NOT NULL,
  `nombre` varchar
(50) NOT NULL,
  `apellidos` varchar
(50) NOT NULL,
  `cuenta` char
(20) NOT NULL,
  `contraseña` varchar
(100) NOT NULL,
`admin` TINYINT DEFAULT 0,
  `correo` varchar
(50) NOT NULL,
  `bloqueo` tinyint
(1) NOT NULL DEFAULT 0,
  `fallidos` tinyint
(1) NOT NULL DEFAULT 0,
  `passgenerado` tinyint
(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta`
(
  `idVenta` int
(11) NOT NULL,
  `idUsuario` int
(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `venta_producto`
--

CREATE TABLE `venta_producto`
(
  `idProducto` int
(11) NOT NULL,
  `idVenta` int
(11) NOT NULL,
  `cantidad` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
ADD PRIMARY KEY
(`idCategoria`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
ADD UNIQUE KEY `idProducto_2`
(`idProducto`),
ADD KEY `idProducto`
(`idProducto`),
ADD KEY `idCategoria`
(`idCategoria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`idusuario`),
ADD UNIQUE KEY `Email`
(`correo`),
ADD UNIQUE KEY `id`
(`idusuario`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
ADD PRIMARY KEY
(`idVenta`),
ADD KEY `idUsuario`
(`idUsuario`),
ADD KEY `idVenta`
(`idVenta`);

--
-- Indexes for table `venta_producto`
--
ALTER TABLE `venta_producto`
ADD KEY `idVenta`
(`idVenta`),
ADD KEY `idProducto`
(`idProducto`);

ALTER TABLE `venta_producto`
ADD PRIMARY KEY
(`idProducto`, `idVenta`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `productos` CHANGE `idProducto` `idProducto` INT NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusuario` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int
(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--

ALTER TABLE `productos`
ADD PRIMARY KEY
(`idProducto`);

ALTER TABLE `productos`
ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY
(`idCategoria`) REFERENCES `categoria`
(`idCategoria`) ON
UPDATE CASCADE;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY
(`idUsuario`) REFERENCES `users`
(`idusuario`) ON
DELETE CASCADE;

--
-- Constraints for table `venta_producto`
--
ALTER TABLE `venta_producto`
ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY
(`idVenta`) REFERENCES `venta`
(`idVenta`) ON
DELETE CASCADE,
ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY
(`idProducto`) REFERENCES `productos`
(`idProducto`) ON
DELETE CASCADE;
COMMIT;

INSERT INTO `categoria` (`nombre`)
VALUES
  ('Hombre'),
  ('Mujer'),
  ('Infantil');

INSERT INTO `cupones` (`codigo`,
`porcentaje`,
`minim`,
`maximo`)
VALUES
('LLEGAMOS10',10,1000,NULL),
('QUINCEOFF',15,10000,NULL);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE Ventas
(
	ID_Venta CHAR(5),
	Prenda VARCHAR(50),
	Cantidad INT
);

INSERT INTO Ventas
	(ID_Venta, Prenda, Cantidad)
VALUES
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
	('015', 'Jeans', 299)
