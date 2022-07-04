<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home Page Sindicato</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="resources/libs/materialize/css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="resources/css/estilo.css">
	<link rel="icon" href="resources/img/indice.png">
</head>
<body class="teal accent-2">
	<nav>
		<div class="nav-wrapper">
			<a href="/" class="brand-logo left">
				<!-- <span src="/resources/img/sample-logo.png" ></span> -->
				<img src="/resources/img/sample-logo.png" alt="logo" id="img-logo">
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="listar-usuarios">Usuários do Sistema</a></li>
				<li><a href="badges.html">Empresas</a></li>
				<li><a href="collapsible.html">Filiados</a></li>
			</ul>
		</div>
	</nav>

	<header>
		<div class="container">
			<h1 class="titulo">Home Page!</h1>
			<p> 
				<?php var_dump($_SESSION); ?> 
			</p>
		</div>
	</header>

	<script src="resources/libs/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="resources/libs/materialize/js/materialize.js"></script>
</body>
</html>