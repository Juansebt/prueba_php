<?php
include_once("../../models/producto.php");

$nombre = $_GET["nombreProducto"];

$productoModel = new \modelo\Producto();
$productoModel->setNombreProducto($nombre);

$response = $productoModel->getProductoByName();

echo json_encode($response);

unset($productoModel);
unset($response);