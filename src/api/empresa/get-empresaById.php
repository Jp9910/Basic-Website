<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);

// 0 == false? --> true
// 0 === false? --> false

// Comparar com false para o caso de retornar 0 (o que já seria 
// inválido pq não existe id 0 nas tabelas, mas falha menos rápido)
if($id === false) {
    //http_response_code(401); //<-- Enviar apenas o código de status
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro."); //<-- Enviar mais informações
    echo "Bad Request. Id deve ser um inteiro.";
    exit();
}

// @TODO: Falta lidar com o erro de consultar um ID que não existe
header('Content-Type: application/json');

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new EmpresaController();
$oEmpresa = $oController->getEmpresaById($request['id']);

echo json_encode($oEmpresa);