<?php 

/**
 * API POST - Faz a checagem da informação de login e retorna o status em json.
 */

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;
use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new UsuarioController();
$json = $oController->login($request['login'], $request['senha']);

$status = json_decode($json);

// Informar o usuário o status da requisição do login.
// Usar uma flash message usando a session.
// Poderia/Deveria ser feito no javascript, mas por propósitos de aprendizado,
// farei usando a session do php.

if ($status->status === 200) {
    $sessionManager = SessionManager::getInstance();
    $sessionManager->endSessao();
    $sessionManager->startSessao();
    $sessionManager->setSessionVariable('usuario_id', $status->usuario->id);
    $sessionManager->setSessionVariable('usuario_login', $status->usuario->login);
    $sessionManager->setSessionVariable('usuario_nome', $status->usuario->nome);
    $sessionManager->setSessionVariable('usuario_isAdmin', $status->usuario->isAdmin);
    $sessionManager->setSessionVariable('logado', true);
    $sessionManager->setSessionVariable('mensagem', $status->status_text);
    $sessionManager->setSessionVariable('tipo_mensagem', 'sucess');
    //$sessao = $sessionManager->getSessao();
    //var_dump($sessao);
    header("Location: /home", true, 302);
    exit();
}
$sessionManager = SessionManager::getInstance();
//$sessionManager->endSessao();
$sessionManager->startSessao();
$sessionManager->setSessionVariable('mensagem', $status->status_text);
$sessionManager->setSessionVariable('tipo_mensagem', 'error');
header("Location: /login", true, 302);
exit();