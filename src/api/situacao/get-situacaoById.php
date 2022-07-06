<?php

namespace Jp\SindicatoTrainees\api\situacao;

use Jp\SindicatoTrainees\domain\controllers\SituacaoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

header('Content-Type: application/json');
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new SituacaoController();
$oSituacao = $oController->getSituacaoById($request['id']);

echo json_encode($oSituacao);