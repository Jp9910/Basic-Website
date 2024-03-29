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
	<title>Login Sindicato Trainees</title>
	<link rel="icon" href="public/img/indice.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="resources/libs/materialize/css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="public/css/estilo.css">
</head>
<body>
	<div id="navbar"></div>
	<h3 class="center">Sindicato dos Trainees - Login</h3>
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
		<form class="col s12" action="/criar-sessao" method="post">
			<div class="row">
				<div class="input-field col s3 offset-s4">
					<i class="material-icons prefix">account_circle</i>
					<input required id="first_name" name="login" type="text" class="validate">
					<label for="first_name">Usuário</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s3 offset-s4">
					<i class="material-icons prefix">lock_outline</i>
					<input required id="password" name="senha" type="password" class="validate">
					<label for="password">Senha</label>
				</div>
			</div>
			<div class="row">
				<button type="submit" class="btn waves-effect waves-light">
					Entrar
					<i class="material-icons right">arrow_forward</i>
				</button>
			</div>
			<div class="row">
				<a href="/login-visitante">
					<button id="botao-visitante" type="button" class="btn waves-effect waves-light">
						Entrar como visitante (wip)
						<i class="material-icons right">visibility</i>
					</button>
				</a>
			</div>
		</form>
	</div>

	<script src="resources/libs/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="resources/libs/materialize/js/materialize.js"></script>
	<script type="text/javascript"> $('#navbar').load('/navbar'); </script>
</body>
</html>