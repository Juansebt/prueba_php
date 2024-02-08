<?php
include_once("../../models/producto.php");

$productoModel = new \modelo\Producto();

$response = $productoModel->getProductos();

echo json_encode($response);

unset($productoModel);
unset($response);