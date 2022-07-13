<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;

$quantidade = filter_input(INPUT_GET,'quantidade', FILTER_VALIDATE_INT);
if(is_null($quantidade) or $quantidade === false) {
	header("HTTP/1.1 400 Bad Request. É preciso especificar uma quantidade de empresas.");
	exit();
}
$pagina = filter_input(INPUT_GET,'pagina', FILTER_VALIDATE_INT);
if(is_null($pagina) or $pagina === false) {
	header("HTTP/1.1 400 Bad Request. É preciso especificar a pagina a ser visualizada.");
	exit();
}

header('Content-Type: application/json');

$oController = new EmpresaController();
$loEmpresas = $oController->getEmpresasPagina($pagina, $quantidade);

echo json_encode($loEmpresas);