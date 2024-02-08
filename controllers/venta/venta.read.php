<?php
include_once("../../models/venta.php");

$ventaModel = new \modelo\Venta();

$response = $ventaModel->getVentas();

echo json_encode($response);

unset($ventaModel);
unset($response);