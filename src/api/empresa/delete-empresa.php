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
header("HTTP/1.1 200 Empresa Excluida.");