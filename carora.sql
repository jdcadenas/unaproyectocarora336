-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2019 a las 10:34:25
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `sucursal_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 2, 5),
(2, 1, 3, 10),
(3, 2, 4, 100),
(4, 2, 14, 100),
(5, 1, 15, 15),
(6, 2, 16, 100),
(7, 3, 17, 123),
(8, 5, 20, 77),
(9, 1, 22, 20),
(10, 6, 23, 40),
(11, 6, 24, 113),
(12, 3, 25, 123),
(13, 4, 26, 25),
(14, 1, 27, 55),
(15, 3, 28, 12),
(16, 1, 29, 22),
(17, 1, 30, 12),
(18, 1, 31, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_det_venta` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_det_venta`, `producto_id`, `cantidad`, `precio_venta`, `venta_id`) VALUES
(4, 3, 10, 15500, 15),
(5, 2, 10, 15500, 16),
(6, 7, 1, 22000, 16),
(7, 11, 22, 23, 19),
(11, 2, 1, 15500, 22),
(12, 2, 10, 15500, 23),
(13, 11, 2, 23, 23),
(14, 4, 10, 26000, 24),
(15, 3, 10, 15500, 25),
(16, 2, 33, 15500, 26),
(17, 3, 4, 15500, 26),
(18, 15, 4, 12000, 26),
(19, 4, 1, 26000, 27),
(20, 4, 5, 26000, 28),
(21, 14, 5, 4555, 29),
(22, 3, 23, 15500, 30),
(23, 15, 9, 12000, 30),
(24, 15, 1, 12000, 31),
(25, 22, 2, 32, 32),
(26, 23, 10, 13000, 33),
(27, 24, 7, 4500, 33),
(28, 23, 15, 13000, 34),
(29, 2, 9, 15500, 34),
(30, 16, 23, 124, 35),
(31, 2, 5, 15500, 36),
(32, 3, 10, 15500, 36),
(33, 15, 15, 12000, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `cedula`, `nombre`, `apellido`, `telefono`, `correo`, `usuario`, `clave`, `rol_id`, `sucursal_id`, `estado`) VALUES
(1, 6, 'José', 'Cadenas', '1342', 'jdcadenas@gmail.com', '1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, 1, 1),
(2, 2, 'Vicente', 'Perez', '2', 'perez@gmail.com', '2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 2, 0),
(3, 211, 'Vicente219', 'Perez9', '29', 'perez21@gmail.com9', '399', '666', 4, 3, 1),
(4, 3, 'Super3', 'Visor', '3', '3@gmail.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, 1, 1),
(5, 31, 'Super', 'Visor', '31', '3@gmail.com', '', '31', 3, 1, 1),
(6, 4, 'vend', 'edor', '4', '4@gmail.com', '', '4', 4, 1, 0),
(7, 41, 'Oto', 'vendedor', '41', '41#gmail.com', '', '41', 4, 1, 0),
(8, 43, 'vend 43', 'edor', '4', '4@gmail.com', '', '4', 4, 1, 1),
(9, 42, 'Oto42', 'vendedor', '41', '41#gmail.com', '', '41', 4, 1, 1),
(10, 22, 'gerenoeste', 'te', '2', '2@gmail.com', '', '2', 2, 1, 1),
(11, 24, 'gerenoeste', 'te', '2', '2@gmail.com', '', '2', 2, 1, 1),
(13, 98, '9888', '98888', '9999', '999', '9', '9', 4, 1, 1),
(14, 78, '7878', '787', '78', '787', '787', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 4, 6, 1),
(15, 123123, 'pepe', 'grillo', '22342', 'hjh@gmail.com', '123', '123', 4, 2, 1),
(16, 333, '33', '33', '33', 'hjh@gmail.com', '333', '333', 4, 1, 1),
(17, 23449, '13419', '31419', '249', '249', '239', '0ade7c2cf97f75d009975f4d720d1fa6c19f4897', 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id_linea` int(11) NOT NULL,
  `nombre_linea` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`id_linea`, `nombre_linea`, `estado`) VALUES
(1, 'Brillo de seda88', 1),
(2, 'Aceite brillante', 0),
(3, 'Para Exteriores', 1),
(4, 'Aceite Mate', 1),
(5, 'Al agua vv', 0),
(6, 'Secado rápido', 1),
(7, 'para Metal', 1),
(8, 'Antioxidante varias', 1),
(9, 'linea nueva', 1),
(10, 'linea antigua', 1),
(11, 'otra linea', 1),
(12, 'Brillo de seda nueva', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` float(12,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen_producto` varchar(255) NOT NULL,
  `linea` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo`, `nombre`, `precio`, `cantidad`, `imagen_producto`, `linea`, `estado`) VALUES
(2, '12009', 'Pintura para radiadores satinada', 15500.00, 10, 'assets/images/productos/12009.jpg', 1, 0),
(3, '2343', 'Pintura pastosa Rojaxx', 15500.00, 20, 'assets/images/productos/2343.jpg', 4, 0),
(4, '3434', 'Pintura marca XYZ', 26000.00, 20, 'assets/images/productos/3434.jpg', 1, 1),
(5, '343455', 'Pintura La Otra', 22000.00, 30, '', 3, 1),
(6, '7654', 'Pintura marca XYZ', 26000.00, 20, '', 1, 1),
(7, '432', 'Pintura La Otra', 22000.00, -169, '', 3, 1),
(8, '1005', 'Pintura para tubod', 12500.00, 4, '', 1, 1),
(9, '1234', 'Pintura', 3002.00, 44, '', 10, 1),
(10, '123456', 'Pintura de carton', 1000.00, 10, '', 11, 1),
(11, '1111', 'pintura rara', 23.22, 4, '', 6, 1),
(12, '9999', 'material', 99.99, 88, '', 9, 1),
(13, '777', 'otro producto', 55.00, 66, '', 3, 1),
(14, '777', 'otro producto', 4555.00, 123, 'assets/images/productos/777.jpg', 3, 1),
(15, '10006', 'pintura blanca', 12000.00, 30, '', 4, 1),
(16, '1', 'mi cool399', 123.99, 1239, 'assets/images/productos/1.jpg', 10, 1),
(17, '1231232', '123', 123.00, 129, '', 9, 1),
(18, '123222', '22222', 222.00, 222, '', 9, 1),
(19, '123222', '22222', 222.00, 222, '', 9, 1),
(20, '8989', '778877', 77.00, 77, '', 9, 1),
(21, '100002009', 'uturr', 776.00, 669, '', 6, 1),
(22, '23323', 'producto 22', 32.00, 22, '', 11, 1),
(23, '6000213', 'Pinturas color azul', 13000.00, 50, '', 3, 1),
(24, '600999', 'Pintura amarilla', 4500.00, 120, '', 3, 1),
(25, '213', '13419', 123.00, 123, 'assets/images/productos/2133.jpg', 4, 0),
(26, '400034', 'Pintura para radiadores blanco satinado ', 50500.00, 25, 'assets/images/productos/400034.jpg', 7, 1),
(27, '11000', 'pintura mate sat', 29800.00, 5, '', 7, 1),
(28, '12322233', '223', 2321.00, 12, 'assets/images/productos/12322233.jpg', 3, 0),
(29, '1011000', 'Pintura Para Madera', 12333.00, 22, '', 11, 1),
(30, '12233456', '444', 12.00, 12, 'assets/images/productos/12233456.jpg', 3, 1),
(31, '122990000', 'Pintura negra', 12000.00, 34, 'assets/images/productos/122990000.jpg', 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'Gerente Ventas'),
(3, 'Supervisor Sucursal'),
(4, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `ubicacion`, `estado`) VALUES
(1, 'sede centraluu', 'principalio', 1),
(2, 'oeste', 'miralejos', 1),
(3, 'este', 'vereste', 1),
(4, 'norte', 'miralejos Norte', 1),
(5, 'Sur', 'verSur', 1),
(6, 'sede capital barq', 'barquisimeto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total` float(12,2) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `fecha_venta`, `total`, `empleado_id`, `sucursal_id`) VALUES
(2, '2019-04-20', 17360.00, 1, 1),
(4, '2018-04-05', 17360.00, 2, 2),
(8, '2018-04-03', 17360.00, 3, 1),
(9, '2019-03-29', 17360.00, 11, 1),
(10, '2019-04-01', 8520.00, 9, 1),
(11, '2019-04-06', 8460.00, 5, 1),
(12, '2019-06-30', 4000.00, 4, 1),
(13, '2019-04-23', 500.00, 3, 1),
(14, '2019-04-23', 9500.00, 3, 1),
(15, '2019-04-03', 1000.00, 3, 1),
(16, '2019-04-10', 5000.00, 5, 1),
(19, '2019-05-03', 572.14, 3, 2),
(20, '2019-05-03', 572.14, 3, 2),
(21, '2019-05-03', 17052.00, 1, 2),
(22, '2019-05-03', 1052.00, 1, 2),
(23, '2019-05-03', 1752.00, 1, 2),
(24, '2019-05-03', 2910.00, 1, 2),
(25, '2019-05-04', 1700.00, 14, 1),
(26, '2019-05-05', 8300.00, 1, 1),
(27, '2019-05-04', 29120.00, 1, 2),
(28, '2019-05-05', 0.00, 3, 2),
(29, '2019-05-05', 0.00, 1, 2),
(30, '2019-05-05', 520240.00, 1, 1),
(31, '2019-05-06', 13440.00, 1, 1),
(32, '2019-04-27', 71.68, 1, 1),
(33, '2019-03-06', 180880.00, 14, 6),
(34, '2019-05-05', 374640.00, 17, 3),
(35, '2019-05-06', 3193.98, 15, 2),
(36, '2019-05-06', 462000.00, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_suc` (`sucursal_id`),
  ADD KEY `fk_prod` (`producto_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_det_venta`),
  ADD KEY `pro` (`producto_id`),
  ADD KEY `vent` (`venta_id`),
  ADD KEY `vend` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `rolindex` (`rol_id`),
  ADD KEY `sucu1` (`sucursal_id`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `lin` (`linea`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `vend` (`empleado_id`),
  ADD KEY `sucursal_id` (`sucursal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_det_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `rel_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `rel_suc` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detarest` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `qwe` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restroles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`linea`) REFERENCES `lineas` (`id_linea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleados` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
