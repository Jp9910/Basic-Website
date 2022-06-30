<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

//header('Content-Type: application/json');

$oController = new UsuarioController();
$json = $oController->criarUsuario($_REQUEST['nome'], $_REQUEST['login'], $_REQUEST['senha']);

$status = json_decode($json);
if ($status->status === 200) {
    header("Location: /login");
    die();
}
echo $json;