<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

// if (!isset($_REQUEST['_method']) or $_REQUEST['_method'] !== 'put') {
//     //header("Location: /404");
//     throw new Exception('Apenas método put é permitido');
//     exit();
// }

// Initialize URL to the variable
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);
// parse_str($url_components['query'], $params);
// var_dump($params);

$oController = new UsuarioController();
$sResultadoJson = $oController->editarUsuario(
    $id,
    $_REQUEST['nome'],
    $_REQUEST['login'],
    $_REQUEST['senha'],
    $_REQUEST['tipo_usuario']
);

//var_dump($usuarios);
$sStatus = json_decode($sResultadoJson);
// if ($sStatus->status === 200) {
//     header("Location: /login");
//     die();
// }
var_dump($sStatus);