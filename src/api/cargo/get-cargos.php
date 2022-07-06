<?php

namespace Jp\SindicatoTrainees\api\cargo;

use Jp\SindicatoTrainees\domain\controllers\CargoController;

header('Content-Type: application/json');

$oController = new CargoController();
$loCargos = $oController->getCargos();

echo json_encode($loCargos);