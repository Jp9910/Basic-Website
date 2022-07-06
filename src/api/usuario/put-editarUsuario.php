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
$request_body = file_get_contents('php://input');
parse_str($request_body, $dataPayload);
$requestManager->setRequestVariable('nome', $dataPayload['nome']);
$requestManager->setRequestVariable('login', $dataPayload['login']);
$requestManager->setRequestVariable('senha', $dataPayload['senha']);
$requestManager->setRequestVariable('tipo_usuario', $dataPayload['tipo_usuario']);

$request = $requestManager->getRequest();
// $rv = $requestManager->getRequestVariable('name');
// echo $rv;
// $request['asdf'] = 'asdf';

// var_dump($request);
// var_dump($_REQUEST);
// $request_body = file_get_contents('php://input');
// var_dump($request_body);
// parse_str($request_body, $payload);
// var_dump($payload);
// exit();

$oController = new UsuarioController();
$sResultadoJson = $oController->editarUsuario(
    $id,
    $request['nome'],
    $request['login'],
    $request['senha'],
    $request['tipo_usuario']
);

//var_dump($usuarios);
//--$sStatus = json_decode($sResultadoJson);
// if ($sStatus->status === 200) {
//     header("Location: /login");
//     die();
// }
//--var_dump($sStatus);

// https://reqbin.com/req/orjagaoq/http-put-request
// https://stackoverflow.com/questions/6782230/ajax-passing-data-to-php-script
// https://stackoverflow.com/questions/8236903/retrieving-post-data-from-ajax-call-to-php
// https://stackoverflow.com/questions/27941207/http-protocols-put-and-delete-and-their-usage-in-php
// https://stackoverflow.com/questions/9597052/how-to-retrieve-request-payload

// Enviar resposta
// header("HTTP/1.1 200 OK");
$httpStatusCode = 200;
$httpStatusMsg  = 'Usuario Editado.';
$phpSapiName    = substr(php_sapi_name(), 0, 3);
if ($phpSapiName == 'cgi' || $phpSapiName == 'fpm') {
    header('Status: '.$httpStatusCode.' '.$httpStatusMsg);
} else {
    $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
    header($protocol.' '.$httpStatusCode.' '.$httpStatusMsg);
}
