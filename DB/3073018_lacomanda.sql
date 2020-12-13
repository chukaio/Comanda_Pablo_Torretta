-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2020 at 06:03 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3073018_lacomanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `ID_empleado` int(11) NOT NULL,
  `ID_tipo_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_ultimo_login` datetime DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_operaciones` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`ID_empleado`, `ID_tipo_empleado`, `nombre_empleado`, `usuario`, `clave`, `fecha_registro`, `fecha_ultimo_login`, `estado`, `cantidad_operaciones`) VALUES
(18, 5, 'Primus', 'socio000', 'socio000', '2020-12-11 22:23:25', '2020-12-11 22:30:46', 'A', 46),
(20, 1, 'Maccadam', 'bartender1', 'bartender1', '2020-12-11 22:36:01', '2020-12-12 00:49:41', 'A', 2),
(21, 2, 'Swerve', 'cervecero1', 'cervecero1', '2020-12-11 22:37:24', NULL, 'A', 0),
(22, 2, 'Trailbreaker', 'cervecero2', 'cervecero2', '2020-12-11 22:37:43', '2020-12-12 00:48:38', 'A', 0),
(23, 3, 'Unicron', 'cocinero1', 'cocinero1', '2020-12-11 22:53:17', '2020-12-12 00:44:52', 'A', 2),
(24, 4, 'Lickety-Split', 'mozo1', 'mozo1', '2020-12-11 22:56:50', '2020-12-12 00:30:51', 'A', 5),
(25, 4, 'Whirl', 'Mozo2', 'mozo2', '2020-12-11 22:57:36', NULL, 'B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `puntuacion_mesa` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `puntuacion_restaurante` int(11) NOT NULL,
  `puntuacion_mozo` int(11) NOT NULL,
  `idMozo` int(11) NOT NULL,
  `puntuacion_cocinero` int(11) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `encuestas`
--

INSERT INTO `encuestas` (`id`, `puntuacion_mesa`, `codigoMesa`, `puntuacion_restaurante`, `puntuacion_mozo`, `idMozo`, `puntuacion_cocinero`, `comentario`, `fecha`) VALUES
(3, 10, 'TP013', 10, 10, 24, 10, 'Primer encuesta exitosa', '2020-12-12 01:26:22'),
(4, 10, 'TP013', 10, 10, 24, 10, 'Primer encuesta exitosa', '2020-12-12 01:29:37'),
(5, 10, 'TP013', 10, 10, 24, 10, 'Primer', '2020-12-12 01:53:07'),
(6, 10, 'TP013', 10, 10, 24, 10, 'Primer', '2020-12-12 01:54:20'),
(7, 10, 'TP013', 10, 10, 24, 10, 'Primer', '2020-12-12 01:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `estado_pedidos`
--

CREATE TABLE `estado_pedidos` (
  `id_estado_pedidos` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id_estado_pedidos`, `descripcion`) VALUES
(1, 'Pendiente'),
(2, 'En Preparacion'),
(3, 'Listo para Servir'),
(4, 'Entregado'),
(5, 'Cancelado'),
(6, 'Finalizado');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `idFactura` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`idFactura`, `importe`, `codigoMesa`, `fecha`) VALUES
(9, 300, 'TP013', '2020-12-12 01:36:51'),
(10, 999, 'TP013', '2020-12-12 01:50:20'),
(11, 0, 'TP013', '2020-12-12 01:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `id_sector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `precio`, `id_sector`) VALUES
(1, 'Pizza', 500, 3),
(2, 'Cerveza', 180, 2),
(3, 'Empanadas', 300, 3),
(4, 'Vino', 300, 1),
(5, 'Milanesa', 187, 3),
(6, 'Milanesa con pure', 250, 3),
(7, 'Tortilla de papas', 250, 3),
(8, 'Energon', 999, 3),
(10, 'Dark Energon', 999999, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mesas`
--

CREATE TABLE `mesas` (
  `codigo_mesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `mesas`
--

INSERT INTO `mesas` (`codigo_mesa`, `estado`, `foto`) VALUES
('TP001', 'Cerrada', NULL),
('TP002', 'Cerrada', NULL),
('TP003', 'Cerrada', NULL),
('TP004', 'Cerrada', NULL),
('TP005', 'Cerrada', NULL),
('TP006', 'Cerrada', NULL),
('TP007', 'Cerrada', NULL),
('TP008', 'Cerrada', NULL),
('TP009', 'Cerrada', NULL),
('TP010', 'Cerrada', NULL),
('TP011', 'Cerrada', NULL),
('TP012', 'Cerrada', NULL),
('TP013', 'Cerrada', './Fotos/Mesas/TP013..jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_estado_pedidos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_entrega_estimada` time DEFAULT NULL,
  `hora_entrega_real` time DEFAULT NULL,
  `id_mesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_mozo` int(11) NOT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `id_estado_pedidos`, `fecha`, `hora_inicial`, `hora_entrega_estimada`, `hora_entrega_real`, `id_mesa`, `id_menu`, `id_mozo`, `id_encargado`, `nombre_cliente`) VALUES
('h3qh0', 6, '2020-12-12 00:00:00', '00:36:00', '10:52:00', '01:05:00', 'TP013', 4, 24, 20, 'Lestat'),
('uo6v5', 6, '2020-12-12 00:00:00', '01:42:00', '11:45:00', '01:45:00', 'TP013', 8, 24, 23, 'Lestat'),
('wbg1u', 5, '2020-12-12 00:00:00', '00:40:00', NULL, NULL, 'TP013', 4, 24, NULL, 'Lestat');

-- --------------------------------------------------------

--
-- Table structure for table `tipoempleado`
--

CREATE TABLE `tipoempleado` (
  `ID_tipo_empleado` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tipoempleado`
--

INSERT INTO `tipoempleado` (`ID_tipo_empleado`, `descripcion`, `estado`) VALUES
(1, 'Bartender', 'A'),
(2, 'Cervecero', 'A'),
(3, 'Cocinero', 'A'),
(4, 'Mozo', 'A'),
(5, 'Socio', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_empleado`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indexes for table `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id_estado_pedidos`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`codigo_mesa`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipoempleado`
--
ALTER TABLE `tipoempleado`
  ADD PRIMARY KEY (`ID_tipo_empleado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `ID_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipoempleado`
--
ALTER TABLE `tipoempleado`
  MODIFY `ID_tipo_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
