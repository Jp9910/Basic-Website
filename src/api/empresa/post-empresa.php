<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

//@Nota: Checagem de nome nulo é mais apropriada nesta api ou no controller?
if (empty($sNome)) {
    header("HTTP/1.1 400 Nome nao pode ser vazio");
    exit();
}
$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new EmpresaController();
$sResultadoJson = $oController->criarEmpresa(
    $request['nome']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
