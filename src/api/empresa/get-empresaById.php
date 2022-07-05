<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new EmpresaController();
$oEmpresa = $oController->getEmpresaById($request['id']);

echo json_encode($oEmpresa);