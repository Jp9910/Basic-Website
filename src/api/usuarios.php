<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

header('Content-Type: application/json');

$controller = new UsuarioController();
$usuarios = $controller->getUsuarios();

//var_dump($usuarios);
echo json_encode($usuarios);