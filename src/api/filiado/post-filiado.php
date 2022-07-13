<?php

namespace Jp\SindicatoTrainees\api\filiado;

use DateTimeImmutable;
use DateTimeZone;
use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
use Jp\SindicatoTrainees\infra\gerenciadores\RequestManager;

$requestManager = RequestManager::getInstance();
$request_body = file_get_contents('php://input');
parse_str($request_body, $dataPayload);
// foreach datapayload?
	// $requestManager->setRequestVariable('nome', $dataPayload['nome']);
	// $requestManager->setRequestVariable('CPF', $dataPayload['CPF']);

// $request = $requestManager->getRequest();

$oController = new FiliadoController();
$sResultadoJson = $oController->criarFiliado(
	$dataPayload['nome'],
	$dataPayload['CPF'],
	$dataPayload['RG'],
	new DateTimeImmutable($dataPayload['dataNascimento']),//, new DateTimeZone(DateTimeZone::AMERICA)),
	$dataPayload['idade'],
	$dataPayload['telefone'],
	$dataPayload['celular'],
	new DateTimeImmutable(),
	$dataPayload['empresa'],
	$dataPayload['cargo'],
	$dataPayload['situacao']
);

$status = json_decode($sResultadoJson);
header("HTTP/1.1 $status->status $status->status_text");
