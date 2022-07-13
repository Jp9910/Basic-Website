<?php

namespace Jp\SindicatoTrainees\api\cargo;

use Jp\SindicatoTrainees\domain\controllers\CargoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new CargoController();
$sResultadoJson = $oController->criarCargo(
	$request['nome']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
