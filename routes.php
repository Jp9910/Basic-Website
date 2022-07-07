<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

require_once 'vendor/autoload.php';

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'resources/views/home.php');
get('/home', 'resources/views/home.php');
get('/teste', 'src/teste.php');

// LOGIN
get('/login', 'resources/views/login.html');
post('/criar-sessao', 'src/api/post-login.php');

// USUARIOS
    // views
    get('/cadastro', 'resources/views/usuario/cadastro.html');
    get('/listar-usuarios', 'resources/views/usuario/lista-usuarios.html');
    //?usar url dinamica ou usar um parametro get e pega-lo usando o php/javascript?
    get('/editar-usuario', 'resources/views/usuario/editar-usuario.html');
    // api
    get('/usuarios', 'src/api/usuario/get-usuarios.php'); //instanciar o controller e chamar a função para pegar os usuários
    get('/usuario/$id', 'src/api/usuario/get-usuarioById.php');
    post('/criar-usuario', 'src/api/usuario/post-cadastro.php');
    put('/usuario/$id', 'src/api/usuario/put-editarUsuario.php');
    delete('/usuario/$id', 'src/api/usuario/delete-excluirUsuario.php');


// NAVBAR
get('/navbar','resources/views/navbar.php');

// EMPRESA
    // views
    get('/empresas', 'resources/views/empresa/empresa.html');
    get('/editar-empresa', 'resources/views/empresa/editar-empresa.html');
    // api
    get('/lista-empresas', 'src/api/empresa/get-empresas.php');
    get('/empresa', 'src/api/empresa/get-empresaById.php');
    post('/empresa', 'src/api/empresa/post-empresa.php');
    put('/empresa', 'src/api/empresa/put-empresa.php');
    delete('/empresa', 'src/api/empresa/delete-empresa.php');


// CARGO
    // views
    get('/cargos', 'resources/views/cargo/cargo.html');
    get('/editar-cargo', 'resources/views/cargo/editar-cargo.html');
    // api
    get('/lista-cargos', 'src/api/cargo/get-cargos.php');
    get('/cargo', 'src/api/cargo/get-cargoById.php');
    post('/cargo', 'src/api/cargo/post-cargo.php');
    put('/cargo', 'src/api/cargo/put-cargo.php');
    delete('/cargo', 'src/api/cargo/delete-cargo.php');


// SITUAÇÃO
    // views
    get('/situacoes', 'resources/views/situacao/situacao.html');
    get('/editar-situacao', 'resources/views/situacao/editar-situacao.html');
    // api
    get('/lista-situacaos', 'src/api/situacao/get-situacaos.php');
    get('/situacao', 'src/api/situacao/get-situacaoById.php');
    post('/situacao', 'src/api/situacao/post-situacao.php');
    put('/situacao', 'src/api/situacao/put-situacao.php');
    delete('/situacao', 'src/api/situacao/delete-situacao.php');

// FILIADO
    // views
    get('/cadastro-filiado', 'resources/views/filiado/cadastro-filiado.html');
    get('/listar-filiados', 'resources/views/filiado/lista-filiados.html');
    get('/editar-filiado', 'resources/views/filiado/editar-filiado.html');
    // api
    get('/filiados', 'src/api/filiado/get-filiados.php');
    get('/filiado', 'src/api/filiado/get-filiadoById.php');
    post('/filiado', 'src/api/filiado/post-filiado.php');
    put('/filiado', 'src/api/filiado/put-editarFiliado.php');
    delete('/filiado', 'src/api/filiado/delete-excluirFiliado.php');

//chamar função: post('/criarUsuario', '', 'Jp\SindicatoTrainees\domain\controllers\UsuarioController::criarUsuario');

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