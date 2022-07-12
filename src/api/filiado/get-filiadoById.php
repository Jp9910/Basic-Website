<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
if($id === false) {
    header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
    exit();
}

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new FiliadoController();
$oFiliado = $oController->getFiliadoById($request['id']);

echo json_encode($oFiliado);