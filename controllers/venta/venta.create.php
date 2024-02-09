<?php
include_once("../../models/venta.php");

$producto = $_POST["producto"];
$cliente = $_POST["cliente"];
$cantidad = $_POST["cantidadProducto"];
$total = $_POST["totalVenta"];
$observacion = $_POST["observacionVenta"];

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