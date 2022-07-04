<?php 

/**
 * API POST - Faz a checagem da informação de login e retorna o status em json.
 */

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;
use Jp\SindicatoTrainees\infra\SessionManager;

//header('Content-Type: application/json');

$oController = new UsuarioController();
$json = $oController->login($_REQUEST['login'], $_REQUEST['senha']);

$status = json_decode($json);

if ($status->status === 200) {
    $sessionManager = SessionManager::getInstance();
    $sessionManager->endSessao();
    $sessionManager->startSessao();
    $sessionManager->setSessionVariable('usuario_id', $status->usuario->id);
    $sessionManager->setSessionVariable('usuario_login', $status->usuario->login);
    $sessionManager->setSessionVariable('usuario_nome', $status->usuario->nome);
    $sessionManager->setSessionVariable('usuario_isAdmin', $status->usuario->isAdmin);
    $sessionManager->setSessionVariable('logado', true);
    //$sessao = $sessionManager->getSessao();
    //var_dump($sessao);
    header("Location: /home");
    exit();
}
var_dump($status);
var_dump($_SESSION);
//echo $json;