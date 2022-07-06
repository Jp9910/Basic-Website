<?php

namespace Jp\SindicatoTrainees\api\cargo;

use Jp\SindicatoTrainees\domain\controllers\CargoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$requestManager->getRequest();

$request = $requestManager->getRequest();

$oController = new CargoController();
$sResultadoJson = $oController->editarCargo(
    $request['id'],
    $request['nome']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");