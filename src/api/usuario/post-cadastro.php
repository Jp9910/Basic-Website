<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

$oController = new UsuarioController();
$sResultadoJson = $oController->criarUsuario(
    $_REQUEST['nome'],
    $_REQUEST['login'],
    $_REQUEST['senha'],
    $_REQUEST['tipo_usuario']
);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
// Redirecionar para o login
if ($status->status === 200) {
    header("Location: /login; Content-Type: text/html; charset=UTF-8", false, 302);
    exit();
}