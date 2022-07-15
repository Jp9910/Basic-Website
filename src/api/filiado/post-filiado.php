<?php

namespace Jp\SindicatoTrainees\api\filiado;

use DateTimeImmutable;
use DateTimeZone;
use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request = $requestManager->getRequest();
$request_body = file_get_contents('php://input');
parse_str($request_body, $dataPayload);
foreach ($dataPayload as $campo) {
	if (empty($campo)){
		header("HTTP/1.1 400 Não pode haver campos vazios");
		exit();
	}
}

$oController = new FiliadoController();
$sResultadoJson = $oController->criarFiliado(
	$dataPayload['nome'],
	$dataPayload['CPF'],
	$dataPayload['RG'],
	new DateTimeImmutable($dataPayload['dataNascimento'], new DateTimeZone('Brazil/East')),
	$dataPayload['idade'],
	$dataPayload['telefone'],
	$dataPayload['celular'],
	new DateTimeImmutable(date('Y-m-d H:i:s'), new DateTimeZone('Brazil/East')),
	$dataPayload['empresa'],
	$dataPayload['cargo'],
	$dataPayload['situacao']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
