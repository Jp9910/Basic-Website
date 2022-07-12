<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
if($id === false) {
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
    exit();
}

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new FiliadoController();
$sResultadoJson = $oController->deletarFiliado(
    $request['id']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");