<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");
require_once 'vendor/autoload.php';

// Home
	get('/', 'public/views/home.php');
	get('/home', 'public/views/home.php');

// LOGIN
	get('/login', 'public/views/login.php');
	post('/criar-sessao', 'src/api/post-login.php');
	get('/logout', 'src/api/logout.php');

// NAVBAR
	get('/navbar','public/views/navbar.php');

if ( isset($_SESSION['logado']) and $_SESSION['logado'] == true and $_SESSION['usuario_isAdmin']) {
// USUARIOS
	// views
	get('/cadastro', 'public/views/usuario/cadastro.html');
	get('/listar-usuarios', 'public/views/usuario/lista-usuarios.html');
	//?usar url dinamica ou usar um parametro get e pega-lo usando o php/javascript?
	get('/editar-usuario', 'public/views/usuario/editar-usuario.html');
	// api
	get('/usuarios', 'src/api/usuario/get-usuarios.php'); //instanciar o controller e chamar a função para pegar os usuários
	get('/usuario/$id', 'src/api/usuario/get-usuarioById.php');
	post('/criar-usuario', 'src/api/usuario/post-cadastro.php');
	put('/usuario/$id', 'src/api/usuario/put-editarUsuario.php');
	delete('/usuario/$id', 'src/api/usuario/delete-excluirUsuario.php');
}
if ( isset($_SESSION['logado']) and $_SESSION['logado'] == true ) {
// EMPRESA
	// views
	get('/empresas', 'public/views/empresa/empresa.html');
	get('/editar-empresa', 'public/views/empresa/editar-empresa.html');
	// api
	get('/lista-empresas', 'src/api/empresa/get-empresas.php');
	get('/empresa', 'src/api/empresa/get-empresaById.php');
	post('/empresa', 'src/api/empresa/post-empresa.php');
	put('/empresa', 'src/api/empresa/put-empresa.php');
	delete('/empresa', 'src/api/empresa/delete-empresa.php');

// CARGO
	// views
	get('/cargos', 'public/views/cargo/cargo.html');
	get('/editar-cargo', 'public/views/cargo/editar-cargo.html');
	// api
	get('/lista-cargos', 'src/api/cargo/get-cargos.php');
	get('/cargo', 'src/api/cargo/get-cargoById.php');
	post('/cargo', 'src/api/cargo/post-cargo.php');
	put('/cargo', 'src/api/cargo/put-cargo.php');
	delete('/cargo', 'src/api/cargo/delete-cargo.php');

// SITUAÇÃO
	// views
	get('/situacoes', 'public/views/situacao/situacao.html');
	get('/editar-situacao', 'public/views/situacao/editar-situacao.html');
	// api
	get('/lista-situacaos', 'src/api/situacao/get-situacaos.php');
	get('/situacao', 'src/api/situacao/get-situacaoById.php');
	post('/situacao', 'src/api/situacao/post-situacao.php');
	put('/situacao', 'src/api/situacao/put-situacao.php');
	delete('/situacao', 'src/api/situacao/delete-situacao.php');

// FILIADO
	// views
	get('/cadastro-filiado', 'public/views/filiado/cadastro-filiado.html');
	get('/listar-filiados', 'public/views/filiado/lista-filiados.html');
	get('/editar-filiado', 'public/views/filiado/editar-filiado.html');
	// api
	get('/filiados', 'src/api/filiado/get-filiados.php');
	get('/filiado', 'src/api/filiado/get-filiadoById.php');
	post('/filiado', 'src/api/filiado/post-filiado.php');
	put('/filiado', 'src/api/filiado/put-filiado.php');
	delete('/filiado', 'src/api/filiado/delete-filiado.php');
}
//chamar função: post('/criarUsuario', '', 'Jp\SindicatoTrainees\domain\controllers\UsuarioController::criarUsuario');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
get('/item/$name', 'items.php');

// "any" can be used for GETs or POSTs
// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','public/views/404.html');