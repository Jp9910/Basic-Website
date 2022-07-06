<?php

namespace Jp\SindicatoTrainees\api\situacao;

use Jp\SindicatoTrainees\domain\controllers\SituacaoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$requestManager->getRequest();

$request = $requestManager->getRequest();

$oController = new SituacaoController();
$sResultadoJson = $oController->editarSituacao(
    $request['id'],
    $request['nome']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");