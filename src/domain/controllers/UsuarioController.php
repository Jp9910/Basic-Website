<?php

namespace Jp\SindicatoTrainees\domain\controllers;

require_once 'vendor/autoload.php';
//require_once('src/domain/controllers/Controller.php');

use Jp\SindicatoTrainees\domain\controllers\Controller;

class UsuarioController extends Controller
{
    public static function criarUsuario()
    {
        echo 'ok';
        //criar conexao com o banco de dados e inserir um novo administrador
    }

    public static function deletarUsuario()
    {

    }
}