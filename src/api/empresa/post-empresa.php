<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Exception;
use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new EmpresaController();
$sResultadoJson = $oController->criarEmpresa(
	$request['nome']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
