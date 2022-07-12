<?php

namespace Jp\SindicatoTrainees\api\cargo;

use Jp\SindicatoTrainees\domain\controllers\CargoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
if($id === false) {
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
    exit();
}

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new CargoController();
$oCargo = $oController->getCargoById($request['id']);

echo json_encode($oCargo);