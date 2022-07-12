<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new UsuarioController();
$sResultadoJson = $oController->criarUsuario(
    $request['nome'],
    $request['login'],
    $request['senha'],
    $request['tipo_usuario']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
// Redirecionar para a lista de usuários (redirecionar para o login?)
if ($status->status === 200) {
    header("Location: /listar-usuarios", false, 302);
    exit();
}