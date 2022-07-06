<?php

namespace Jp\SindicatoTrainees\api\cargo;

use Jp\SindicatoTrainees\domain\controllers\CargoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new CargoController();
$oCargo = $oController->getCargoById($request['id']);

echo json_encode($oCargo);