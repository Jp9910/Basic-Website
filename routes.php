<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

//---require_once('src/domain/controllers/UsuarioController.php');
require_once 'vendor/autoload.php';
// $func = 'Jp\SindicatoTrainees\domain\controllers\UsuarioController::criarUsuario';
// if(is_callable($func))
//     echo 'ok';
// else echo 'erro';
// exit();

// Static GET
// In the URL -> http://localhost
// The output -> Index
post('/users', '', 'Jp\SindicatoTrainees\domain\controllers\UsuarioController::criarUsuario');
get('/', 'resources/views/index.html');
get('/home', 'resources/views/home.html');
get('/teste', 'src/teste.php');
//post('/users', 'src/domain/controllers/UsuarioController.php');
delete('/users/$id', 'src/domain/controllers/usuarioController.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
get('/user/$id', 'user.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in user.php
// The $last_name will be available in user.php
get('/user/$name/$last_name', 'user.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
get('/product/$type/color/$color', 'product.php');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
get('/item/$name', 'items.php');


// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','resources/views/404.html');