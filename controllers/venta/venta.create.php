<?php
include_once("../../models/venta.php");

$producto = $_POST["cbProductoVenta"];
$cliente = $_POST["cbClienteVenta"];
$cantidad = $_POST["txtCantidadProductoVenta"];
$total = $_POST["txtTotalVenta"];
$observacion = $_POST["txtObservacionesVenta"];

if (empty($producto) || empty($cliente) || empty($cantidad) || empty($total)) {
    $response = "Por favor, complete los campos requeridos.";
} else {
    $ventaModel = new \modelo\Venta();
    
    $ventaModel->setProductoVenta($producto);
    $ventaModel->setClienteVenta($cliente);
    $ventaModel->setCantidadProductoVenta($cantidad);
    $ventaModel->setTotalVenta($total);
    $ventaModel->setObservacionVenta($observacion);

    $response = $ventaModel->create();
}

echo json_encode($response);

unset($ventaModel);
unset($response);