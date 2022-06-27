<?php
namespace Jp\SindicatoTrainees\resources\views;
require_once 'vendor/autoload.php';

use Jp\SindicatoTrainees\infra\dao\UsuarioPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;

$pdo = DBConnector::createConnection();
$dao = new UsuarioPdoDao($pdo);
$usuarios = $dao->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sindicato dos Trainees - Usuarios</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="resources/libs/materialize/css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
</head>
<body>
    <section class="tabela">
        <h5 class="center">Lista de usuários cadastrados no sistema</h5>
        <table class="centered">
            <thead>
                <th>Nome</th>
                <th>Login</th>
                <th>Editar</th>
            </thead>
            <tbody>
                <!-- montar a tabela dinamicamente usando javascript? --> 
            </tbody>
        </table>
    </section>
    <ul class="center">
        <?php foreach($usuarios as $usu){ ?>
            <li><?php echo $usu->nome(); ?></li>
        <?php } ?>
    </ul>
    <script src="resources/libs/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="resources/libs/materialize/js/materialize.js"></script>
</body>
</html>