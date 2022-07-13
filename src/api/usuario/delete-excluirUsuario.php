<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

// id está sendo passado dinamicamente na url (sem ser como parâmetro get)
$id = filter_var($id, FILTER_VALIDATE_INT);
if (is_null($id) or $id === false) {
	header("HTTP/1.1 400 Bad Request. Id deve ser um inteiro.");
	exit();
}

$oController = new UsuarioController();
$sResultadoJson = $oController->deletarUsuario($id);

// Enviar resposta
$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");