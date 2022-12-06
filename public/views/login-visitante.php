<?php
use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;
$sessionManager = SessionManager::getInstance();
$sessao = $sessionManager->getSessao();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login de visitantes</title>
	<link rel="icon" href="public/img/indice.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="resources/libs/materialize/css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="public/css/estilo.css">
</head>
<body>
	<div id="navbar"></div>
	<h3 class="center">Sindicato dos Trainees - Login Visitante</h3>
	<br>
	<div class="center">
		<div class="center">
			<p class="alert" id="p-info">
				<?php 
				// Flash message usando a session
				if (isset($sessao['mensagem'])) {
					echo $sessao['mensagem'];
					$sessionManager->unsetSessionVariable('mensagem');
					$sessionManager->unsetSessionVariable('tipo_mensagem');
				}
				?>
			</p>
		</div>
		<form class="col s12" action="/criar-sessao-visitante" method="post">
			<div class="row">
				<div class="input-field col s2 offset-s5">
					<i class="material-icons prefix">account_circle</i>
					<input required placeholder="Digite seu nome" id="first_name" name="nome" type="text" class="validate">
					<label for="first_name">Nome</label>
				</div>
			</div>
			<div class="row">
				<button type="submit" class="btn waves-effect waves-light">
					Entrar como visitante
					<i class="material-icons right">arrow_forward</i>
				</button>
			</div>
		</form>
	</div>

	<script src="resources/libs/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="resources/libs/materialize/js/materialize.js"></script>
	<script type="text/javascript"> $('#navbar').load('/navbar'); </script>
</body>
</html>