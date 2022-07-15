<?php


namespace Jp\SindicatoTrainees\api\filiado;

use Jp\SindicatoTrainees\domain\controllers\FiliadoController;
// use DateTimeImmutable;
// use DateTimeZone;
header('Content-Type: application/json');

$oController = new FiliadoController();
$loFiliados = $oController->getFiliados();

echo json_encode($loFiliados);

// date_default_timezone_set('Brazil/East');
// $data = date('d/m/Y H:i:s');
// $data2 = date('Y-m-d H:i:s');
// var_dump($data);
// var_dump($data2);
// var_dump(new DateTimeImmutable(date('Y-m-d H:i:s'), new DateTimeZone('Brazil/East')));
