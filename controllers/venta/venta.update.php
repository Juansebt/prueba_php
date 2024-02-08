<?php
include_once("../../models/venta.php");

$producto = ($_POST["cbProductoVenta"]);
$cliente = ($_POST["cbClienteVenta"]);
$cantidad = ($_POST["txtCantidadProductoVenta"]);
$total = ($_POST["txtTotalVenta"]);
$observacion = ($_POST["txtObservacionesVenta"]);
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