<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

header('Content-Type: application/json');

$oController = new UsuarioController();
$oUsuario = $oController->getUsuarioById($id);

//var_dump($usuarios);
echo json_encode($oUsuario);