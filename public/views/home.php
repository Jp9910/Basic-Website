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
	<link rel="icon" href="public/img/indice.png">
</head>
<body class="teal accent-2">
	<div id="navbar"></div>

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
	<script type="text/javascript"> $('#navbar').load('/navbar'); </script>
</body>
</html>