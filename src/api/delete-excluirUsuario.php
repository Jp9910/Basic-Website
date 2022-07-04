<?php

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

$oController = new UsuarioController();
$sResultadoJson = $oController->deletarUsuario($id);

// $status = json_decode($sResultadoJson);
// if ($status->status === 200) {
//     header("Location: /listar-usuarios");
//     exit();
// }
// echo $sResultadoJson;