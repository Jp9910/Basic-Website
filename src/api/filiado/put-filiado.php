<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request_body = file_get_contents('php://input');
parse_str($request_body, $dataPayload);
// $request = $requestManager->getRequest();

// id está sendo passado dinamicamente na url (sem ser como parâmetro get)
$dataPayload['id'] = filter_var($dataPayload['id'], FILTER_VALIDATE_INT);
if (is_null($dataPayload['id']) or $dataPayload['id'] === false) {
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
    exit();
}

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