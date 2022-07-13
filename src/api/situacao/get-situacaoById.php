<?php

namespace Jp\SindicatoTrainees\api\situacao;

use Jp\SindicatoTrainees\domain\controllers\SituacaoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
if($id === false) {
	header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
	exit();
}

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new SituacaoController();
$oSituacao = $oController->getSituacaoById($request['id']);

echo json_encode($oSituacao);