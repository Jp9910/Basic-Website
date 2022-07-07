<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new FiliadoController();
$oFiliado = $oController->getFiliadoById($request['id']);

echo json_encode($oFiliado);