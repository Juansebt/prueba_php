<?php
include_once("../../models/venta.php");

$id = $_GET["idVenta"];

$ventaModel = new \modelo\Venta();
$ventaModel->setIdVenta($id);

$response = $ventaModel->getVentasById();

echo json_encode($response);

unset($ventaModel);
unset($response);