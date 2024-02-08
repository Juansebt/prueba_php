<?php
include_once("../../models/cliente.php");

$clienteModel = new \modelo\Cliente();

$response = $clienteModel->getClientes();

echo json_encode($response);

unset($clienteModel);
unset($response);