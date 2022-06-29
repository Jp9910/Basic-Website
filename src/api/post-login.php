<?php 

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

header('Content-Type: application/json');

$oController = new UsuarioController();
$json = $oController->login($_REQUEST['usuario'], $_REQUEST['senha']);

echo $json;