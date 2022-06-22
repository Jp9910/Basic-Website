<?php

namespace Moobi\Avaliacao;
use Moobi\Avaliacao\Core\Router;
use PDO;

$connection = new PDO('mysql:host=db;dbname=sindicato_trainees','root','password');
echo 'Conectado' . PHP_EOL;

$sql = 'SELECT * FROM sindicato_trainees.tse_teste';

$statement = $connection->query($sql);

$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($resultado);