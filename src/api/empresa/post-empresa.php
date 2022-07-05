<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

//@TODO: checar se o nome é nulo
$oController = new EmpresaController();
$sResultadoJson = $oController->criarEmpresa(
    $request['nome']
);

$status = json_decode($sResultadoJson);
if ($status->status === 200) {
    header("HTTP/1.1 200 Empresa criada.");
} else {
    header("HTTP/1.1 500 Ops... Algo deu errado.");
}
