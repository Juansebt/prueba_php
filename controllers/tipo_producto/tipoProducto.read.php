<?php
include_once("../../models/tipo_producto.php");

$tipoProductoModel = new \modelo\Tipo_producto();

$response = $tipoProductoModel->getTiposProductos();

echo json_encode($response);

unset($tipoProductoModel);
unset($response);