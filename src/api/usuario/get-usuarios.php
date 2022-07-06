<?php

/**
 * API GET - Retorna todos os usuários no BD em forma de JSON.
 */

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

header('Content-Type: application/json');

$oController = new UsuarioController();
$loUsuarios = $oController->getUsuarios();

//var_dump($usuarios);
echo json_encode($loUsuarios);