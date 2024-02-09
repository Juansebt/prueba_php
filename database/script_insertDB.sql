-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba`;

-- Volcando estructura para tabla prueba.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementado del cliente registrado',
  `nombreCliente` varchar(45) COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Nombre del cliente, example: Exito, Alkosto, Alkomprar, La catorce',
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.cliente: ~4 rows (aproximadamente)
INSERT INTO `cliente` (`idCliente`, `nombreCliente`) VALUES
	(1, 'Exito'),
	(2, 'Alkosto'),
	(3, 'Alkomprar'),
	(4, 'La catorce');

-- Volcando estructura para tabla prueba.fabrica
CREATE TABLE IF NOT EXISTS `fabrica` (
  `idFabrica` int NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementado de la fabrica',
  `nombreFabrica` varchar(45) COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Nombre de la fabrica',
  PRIMARY KEY (`idFabrica`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.fabrica: ~16 rows (aproximadamente)
INSERT INTO `fabrica` (`idFabrica`, `nombreFabrica`) VALUES
	(1, 'Coca-Cola Company'),
	(2, 'Cooperativa Colanta'),
	(3, 'Colcafé S.A.'),
	(4, 'Alpina Productos Alimenticios S.A.'),
	(5, 'Colombina S.A.'),
	(6, 'Grupo Nutresa S.A.'),
	(7, 'Industria De Alimentos Zenú S.A.S.'),
	(8, 'Nestlé Colombia'),
	(9, 'Grupo Bimbo Colombia'),
	(10, 'Quala S.A.'),
	(11, 'Postobón S.A.'),
	(12, 'Grupo Familia S.A.'),
	(13, 'Qualipet'),
	(14, 'Bocadeli S.A'),
	(15, 'Alimentos Polar Colombia S.A.S.'),
	(16, 'Grupo Bimbo S.A.');

-- Volcando estructura para tabla prueba.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementado del producto registrado',
  `nombreProducto` varchar(45) COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Nombre del producto registrado',
  `codigoProducto` varchar(45) COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Código unico del producto registrado',
  `precioProducto` int NOT NULL COMMENT 'Precio de producto registrado',
  `fechaFabricacionProducto` date NOT NULL COMMENT 'Fecha de fabricación del producto registrado',
  `imagenProducto` varchar(500) COLLATE utf8mb3_spanish_ci DEFAULT NULL COMMENT 'Imagen del producto',
  `tipoProducto` int NOT NULL COMMENT 'Fk tipo_producto, id del tipo_producto al que pertenece el producto',
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `codigoProducto_UNIQUE` (`codigoProducto`),
  KEY `fk_producto_tipo` (`tipoProducto`),
  CONSTRAINT `fk_producto_tipo` FOREIGN KEY (`tipoProducto`) REFERENCES `tipo_producto` (`idTipoProducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.producto: ~21 rows (aproximadamente)
INSERT INTO `producto` (`idProducto`, `nombreProducto`, `codigoProducto`, `precioProducto`, `fechaFabricacionProducto`, `imagenProducto`, `tipoProducto`) VALUES
	(1, 'Leche entera', '00001A', 5000, '2024-01-01', 'https://www.bazzarbog.com/85254-large_default/leche-en-caja-alpina.jpg', 2),
	(2, 'Leche en polvo', '00002A', 15000, '2024-01-01', 'https://beta1.cruzverde.com.co/on/demandware.static/-/Sites-masterCatalog_Colombia/default/dw9f8b4018/images/large/126175-1-BABY-1--0-A-6-MESES--POLV-SUSP-ORAL-ALPINA-TAR-X-900GR.jpg', 2),
	(3, 'Leche condensada', '00003A', 9500, '2024-01-01', 'https://web.superboom.net/web/image/product.template/35722/image_1024?unique=f31c36f', 2),
	(4, 'Yogur griego', '00004A', 4000, '2024-01-01', 'https://vaquitaexpress.com.co/media/catalog/product/cache/e89ece728e3939ca368b457071d3c0be/7/7/7702001163892_23.jpg', 2),
	(5, 'Pan de trigo', '00001B', 8000, '2024-01-06', 'https://media.f2h.shop/media/catalog/product/cache/ab45d104292f1bb63d093e6be8310c97/p/a/pan_hamb_artesano_bimbo_240g__1.jpg', 3),
	(6, 'Pan integral', '00002B', 11000, '2024-01-06', 'https://m.media-amazon.com/images/I/817ZbWQU3DL.jpg', 3),
	(7, 'Galletas saladas', '00003B', 13000, '2024-01-06', 'https://farmaciasleyva.com/cdn/shop/products/7501030458883_fa2c291a-75eb-4efd-931c-dfd813353be1.jpg?v=1701900416', 3),
	(8, 'Granola', '00001C', 22000, '2024-01-10', 'https://emdadx.com/wp-content/uploads/2023/09/Nestle-Fitness-Granola-Honey-Cerbag-Box-Of-6-Pieces-450-G.jpg', 6),
	(9, 'Avena', '00002C', 3000, '2024-01-10', 'https://i5.walmartimages.com.mx/gr/images/product-images/img_large/00750105862653L.jpg?odnHeight=612&odnWidth=612&odnBg=FFFFFF', 6),
	(10, 'Carne de res', '00001D', 15000, '2024-02-01', 'https://liderdelivery.com/wp-content/uploads/2020/06/unnamed-1-14.jpg', 5),
	(11, 'Carne de pollo', '00002D', 10000, '2024-02-01', 'https://avinews.com/wp-content/uploads/2023/04/PERU-PRECIO-POLLO.jpg', 5),
	(12, 'Carne de cerdo', '00003D', 17000, '2024-02-01', 'https://i0.wp.com/goula.lat/wp-content/uploads/2022/09/carne-de-cerdo-.jpg?fit=1000%2C796&ssl=1', 5),
	(13, 'Salchichas', '00004D', 13000, '2024-02-01', 'https://lavaquita.co/cdn/shop/products/supermercados_la_vaquita_supervaquita_salchicha_zenu_450gr_tradicional_carnes_frias_a8cf16eb-48cd-4205-a48d-d23498faad6d_1024x1024.jpg?v=1620407820', 5),
	(14, 'Camarones', '00005D', 42000, '2024-02-01', 'https://static.wixstatic.com/media/9da313_30c3645913e143c08da491e73d10d440~mv2.jpg/v1/fill/w_640,h_512,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/9da313_30c3645913e143c08da491e73d10d440~mv2.jpg', 5),
	(15, 'Atún enlatado', '00006D', 7000, '2024-02-01', 'https://villavoexpress.com/rails/active_storage/blobs/proxy/eyJfcmFpbHMiOnsiZGF0YSI6MTAwMzQyLCJwdXIiOiJibG9iX2lkIn19--9e9fc1c56716a377d511745a26178e72e81e7d07/zenu-atun-aceite-de-girasol.png?locale=es', 5),
	(16, 'Gaseosa', '00001E', 6000, '2024-02-14', 'https://media.chevronextramile.com/uploads/2021/04/26095210/Coke_20oz-800x800.jpg', 1),
	(17, 'Chocolate negro', '00001F', 23000, '2024-02-07', 'https://colombinacontentmanager-prd.s3.us-east-1.amazonaws.com/Chocolate/7702011082305_A1R1_es.jpg', 4),
	(18, 'Café instantáneo', '00002F', 3000, '2024-02-07', 'https://tiendanestle.pe/cdn/shop/products/NESCAFESTICK.jpg?v=1634138402&width=1445', 4),
	(19, 'Empanadas', '00003F', 2000, '2024-02-07', 'https://i0.wp.com/www.empanadasenvigadenas.com/wp-content/uploads/2020/05/Certificate-en-DIgitopuntiura-8-2.png?fit=1080%2C1080&ssl=1', 9),
	(20, 'Alimento seco para perros', '00001G', 7000, '2024-02-20', 'https://www.superaki.mx/cdn/shop/files/7501856502265_110823_94e0871b-611d-4cbd-ae9a-536a24254c17_300x300.webp?v=1692888006', 10),
	(21, 'Alimento húmedo para gatos', '00002G', 5000, '2024-02-20', 'https://www.agrocampo.com.co/media/catalog/product/cache/d51e0dc10c379a6229d70d752fc46d83/1/1/111103351_ed-min.jpg', 10);

-- Volcando estructura para tabla prueba.tipo_producto
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `idTipoProducto` int NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementado del tipo de producto',
  `nombreTipoProducto` varchar(45) COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Nombre del tipo de producto',
  `fabricaTipoProducto` int NOT NULL COMMENT 'Fk fabrica, id de la fabrica al que pertenece el tipo de producto',
  PRIMARY KEY (`idTipoProducto`),
  KEY `fk_fabrica_tipoProducto` (`fabricaTipoProducto`),
  CONSTRAINT `fk_fabrica_tipoProducto` FOREIGN KEY (`fabricaTipoProducto`) REFERENCES `fabrica` (`idFabrica`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.tipo_producto: ~10 rows (aproximadamente)
INSERT INTO `tipo_producto` (`idTipoProducto`, `nombreTipoProducto`, `fabricaTipoProducto`) VALUES
	(1, 'Bebidas', 1),
	(2, 'Lácteos', 4),
	(3, 'Panificación', 16),
	(4, 'Confitería', 5),
	(5, 'Productos cárnicos', 7),
	(6, 'Productos de cereales', 8),
	(7, 'Productos de cuidado personal', 12),
	(8, 'Productos de panadería', 14),
	(9, 'Alimentos procesados', 15),
	(10, 'Alimentos para animales', 13);

-- Volcando estructura para tabla prueba.venta
CREATE TABLE IF NOT EXISTS `venta` (
  `idVenta` int NOT NULL AUTO_INCREMENT COMMENT 'Id autoincrementado ',
  `productoVenta` int NOT NULL COMMENT 'Producto que se le registro una venta, Fk producto,  id del producto que se esta registrando la venta',
  `clienteVenta` int NOT NULL COMMENT 'Cliente quien adquiere el producto, Fk cliente, id del cliente que realizá la compra del producto',
  `cantidadProductoVenta` int NOT NULL COMMENT 'Cantidad del producto que se vendió',
  `totalVenta` int NOT NULL COMMENT 'Precio total de la venta, calculado (precio del producto * la cantidad del producto adquirido)',
  `observacionVenta` varchar(45) COLLATE utf8mb3_spanish_ci DEFAULT NULL COMMENT 'Observaciones de la venta registrada',
  PRIMARY KEY (`idVenta`),
  KEY `fk_producto_venta` (`productoVenta`),
  KEY `fk_cliente_venta` (`clienteVenta`),
  CONSTRAINT `fk_cliente_venta` FOREIGN KEY (`clienteVenta`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_venta` FOREIGN KEY (`productoVenta`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla prueba.venta: ~5 rows (aproximadamente)
INSERT INTO `venta` (`idVenta`, `productoVenta`, `clienteVenta`, `cantidadProductoVenta`, `totalVenta`, `observacionVenta`) VALUES
	(4, 16, 1, 1, 6000, '...'),
	(7, 19, 1, 10, 20000, 'No data'),
	(8, 9, 3, 3, 9000, 'La prote'),
	(9, 14, 1, 2, 84000, 'Mariscos'),
	(13, 13, 1, 1, 13000, 'Para el Hot dog del viernes damn');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
