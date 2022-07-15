<?php

namespace Jp\SindicatoTrainees\api\dependente;

use Jp\SindicatoTrainees\domain\controllers\DependenteController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new DependenteController();
$sResultadoJson = $oController->criarDependente(
	$request['nome'],
	$request['dataNascimento'],
	$request['parentesco']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
