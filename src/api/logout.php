<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;

$sessionManager = SessionManager::getInstance();
$sessionManager->endSessao();
$sessao = $sessionManager->startSessao();
$sessionManager->setSessionVariable('mensagem', 'Até a próxima!');
$sessionManager->setSessionVariable('tipo_mensagem', 'success');

header('Location: /login', true, 302);