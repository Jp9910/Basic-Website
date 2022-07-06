<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$requestManager->getRequest();

$request = $requestManager->getRequest();

$oController = new EmpresaController();
$sResultadoJson = $oController->deletarEmpresa(
    $request['id']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");