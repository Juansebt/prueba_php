<?php
include_once("../../models/venta.php");

$producto = ($_POST["producto"]);
$cliente = ($_POST["cliente"]);
$cantidad = ($_POST["cantidad"]);
$total = ($_POST["totalVenta"]);
$observacion = ($_POST["observacionVenta"]);
$id = ($_POST["idVenta"]);

$ventaModel = new \modelo\Venta();

$ventaModel->setProductoVenta($producto);
$ventaModel->setClienteVenta($cliente);
$ventaModel->setCantidadProductoVenta($cantidad);
$ventaModel->setTotalVenta($total);
$ventaModel->setObservacionVenta($observacion);
$ventaModel->setIdVenta($id);

$response = $ventaModel->update();

echo json_encode($response);

unset($ventaModel);
unset($response);