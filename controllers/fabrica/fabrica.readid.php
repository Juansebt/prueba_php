<?php
include_once("../../models/cliente.php");

$id = $_GET["idFabrica"];

$fabricaModel = new \modelo\Fabrica();
$fabricaModel->setIdFabrica($id);

$response = $fabricaModel->getFabricaById();

echo json_encode($response);

unset($fabricaModel);
unset($response);