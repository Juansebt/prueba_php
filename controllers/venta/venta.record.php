<?php
include_once("../../models/venta.php");

$ventaModel = new \modelo\Venta();

$response = $ventaModel->getVentasProductos();

echo json_encode($response);

unset($ventaModel);
unset($response);