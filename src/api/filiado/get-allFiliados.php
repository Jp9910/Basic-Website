<?php

namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;

header('Content-Type: application/json');

$oController = new FiliadoController();
$loFiliados = $oController->getFiliados();

echo json_encode($loFiliados);
