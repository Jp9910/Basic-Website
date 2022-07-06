<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

//header('Content-Type: application/json');

$oController = new UsuarioController();
$sResultadoJson = $oController->criarUsuario(
    $_REQUEST['nome'],
    $_REQUEST['login'],
    $_REQUEST['senha'],
    $_REQUEST['tipo_usuario'],
    //$_REQUEST['email']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
// Redirecionar para o login
if ($status->status === 200) {
    header("Location: /login");
    exit();
}