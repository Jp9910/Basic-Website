<?php

namespace Jp\SindicatoTrainees\api;

use Exception;
use Jp\SindicatoTrainees\domain\controllers\UsuarioController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

// Processar os parâmetros usando a URL. Em vez disso, usarei o RequestManager
// para pegar os parâmetros pela global $_REQUEST
    // Initialize URL to the variable
    // $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // $url_components = parse_url($url);
    // parse_str($url_components['query'], $params);
    // var_dump($params);
    // var_dump($_REQUEST);
    // exit();

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

// $rv = $requestManager->getRequestVariable('name');
// echo $rv;
// $request['asdf'] = 'asdf';
// var_dump($request);
// var_dump($_REQUEST);exit();

$oController = new UsuarioController();
$sResultadoJson = $oController->editarUsuario(
    $id,
    $request['nome'],
    $request['login'],
    $request['senha'],
    $request['tipo_usuario']
);

//var_dump($usuarios);
$sStatus = json_decode($sResultadoJson);
// if ($sStatus->status === 200) {
//     header("Location: /login");
//     die();
// }
var_dump($sStatus);