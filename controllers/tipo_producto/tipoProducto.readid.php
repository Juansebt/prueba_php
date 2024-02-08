<?php
include_once("../../models/tipo_producto.php");

$id = $_GET["idTipoProducto"];

$tipoProductoModel = new \modelo\Tipo_producto();
$tipoProductoModel->setIdTipoProducto($id);

$response = $tipoProductoModel->getTipoProductosById();

echo json_encode($response);

unset($tipoProductoModel);
unset($response);