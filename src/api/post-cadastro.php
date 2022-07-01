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

$status = json_decode($sResultadoJson);
if ($status->status === 200) {
    header("Location: /login");
    die();
}
echo $sResultadoJson;