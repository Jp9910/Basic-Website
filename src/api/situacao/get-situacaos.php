<?php

namespace Jp\SindicatoTrainees\api\situacao;

use Jp\SindicatoTrainees\domain\controllers\SituacaoController;

header('Content-Type: application/json');

$oController = new SituacaoController();
$loSituacaos = $oController->getSituacaos();

echo json_encode($loSituacaos);