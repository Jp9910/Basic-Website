<?php

namespace Jp\SindicatoTrainees\api\empresa;

use Jp\SindicatoTrainees\domain\controllers\EmpresaController;

header('Content-Type: application/json');

$oController = new EmpresaController();
$loEmpresas = $oController->getEmpresas();

echo json_encode($loEmpresas);