<?php
include_once("../../models/producto.php");

$id = $_GET["idProducto"];

$productoModel = new \modelo\Producto();
$productoModel->setIdProducto($id);

$response = $productoModel->getProductoById();

echo json_encode($response);

unset($productoModel);
unset($response);