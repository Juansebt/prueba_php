<?php
include_once("../../models/venta.php");

$id = $_GET["idVenta"];

$ventaModel = new \modelo\Venta();
$ventaModel->setIdVenta($id);

$reponse = $ventaModel->delete();

echo json_encode($reponse);

unset($ventaModel);
unset($reponse);