<?php
include_once("../../models/fabrica.php");

$fabricaModel = new \modelo\Fabrica();

$response = $fabricaModel->getFabricas();

echo json_encode($response);

unset($fabricaModel);
unset($response);