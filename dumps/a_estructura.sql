-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 05:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
USE development;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria`
(
  `idCategoria` int
(11) NOT NULL,
  `nombre` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cupones`
--

CREATE TABLE `cupones`
(
  `codigo` int
(15) NOT NULL,
  `porcentaje` int
(11) NOT NULL,
  `minim` int
(11) NOT NULL,
  `maximo` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos`
(
  `idProducto` int
(10) NOT NULL,
  `nombre` int
(50) NOT NULL,
  `id_categoría` int
(5) NOT NULL,
  `descripción` varchar
(100) NOT NULL,
  `existencia` int
(5) NOT NULL,
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
  `nombre` char
(50) NOT NULL,
  `apellidos` char
(50) NOT NULL,
  `cuenta` char
(20) NOT NULL,
  `contraseña` varchar
(100) NOT NULL,
  `correo` varchar
(50) NOT NULL,
  `bloqueo` tinyint
(1) NOT NULL DEFAULT 1
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
ADD KEY `id_categoría`
(`id_categoría`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`idusuario`),
ADD UNIQUE KEY `Email`
(`correo`),
ADD UNIQUE KEY `Email_2`
(`correo`),
ADD UNIQUE KEY `Email_3`
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

--
-- AUTO_INCREMENT for dumped tables
--

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
ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY
(`id_categoría`) REFERENCES `categoria`
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
