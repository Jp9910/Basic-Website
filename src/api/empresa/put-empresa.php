<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
if($id === false) {
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
    exit();
}

$requestManager = RequestManager::getInstance();
$requestManager->getRequest();
$request = $requestManager->getRequest();

if (empty($request['nome'])) {
    header("HTTP/1.1 400 Nome nao pode ser vazio");
    exit();
}

$oController = new EmpresaController();
$sResultadoJson = $oController->editarEmpresa(
    $request['id'],
    $request['nome']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");