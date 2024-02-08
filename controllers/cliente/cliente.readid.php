<?php
include_once("../../models/cliente.php");

$id = $_GET["idCliente"];

$clienteModel = new \modelo\Cliente();
$clienteModel->setIdCliente($id);

$response = $clienteModel->getClienteById();

echo json_encode($response);

unset($clienteModel);
unset($response);