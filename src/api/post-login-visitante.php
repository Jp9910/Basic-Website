<?php 

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;
use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();

$oController = new UsuarioController();
$json = $oController->loginVisitante($request['nome']);

$status = json_decode($json);

// Informar o usuário o status da requisição do login.
// Usar uma flash message usando a session.
// Poderia/Deveria ser feito no javascript, mas por propósitos de aprendizado,
// farei usando a session do php.

if ($status->status === 200) {
	$sessionManager = SessionManager::getInstance();
	$sessionManager->endSessao();
	$sessionManager->startSessao();
	$sessionManager->setSessionVariable('usuario_nome', $status->nome);
	$sessionManager->setSessionVariable('usuario_isAdmin', false);
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