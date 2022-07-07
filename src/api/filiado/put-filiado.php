<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request_body = file_get_contents('php://input');
parse_str($request_body, $dataPayload);
// $request = $requestManager->getRequest();

$oController = new FiliadoController();
$sResultadoJson = $oController->editarFiliado(
    $dataPayload['id'],
    $dataPayload['nome'],
    $dataPayload['telefone'],
    $dataPayload['celular'],
    $dataPayload['empresa'],
    $dataPayload['cargo'],
    $dataPayload['situacao']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");