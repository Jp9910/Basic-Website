<?php 

/**
 * API POST - Faz a checagem da informação de login e retorna o status em json.
 */

namespace Jp\SindicatoTrainees\api;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

//header('Content-Type: application/json');

$oController = new UsuarioController();
$json = $oController->login($_REQUEST['usuario'], $_REQUEST['senha']);

$status = json_decode($json);
if ($status->status === 200) {
    $_SESSION = array(); // Unset all of the session variables
    session_destroy();
    session_start();
    $_SESSION['usuario_id'] = $status->usuario->id;
    $_SESSION['usuario_login'] = $status->usuario->login;
    $_SESSION['usuario_nome'] = $status->usuario->nome;
    $_SESSION['logado'] = true;
    //header("Location: /home");
    //die();
}
var_dump($_SESSION);
//echo $json;