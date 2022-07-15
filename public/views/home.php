<?php
use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;
$sessionManager = SessionManager::getInstance();
$sessao = $sessionManager->getSessao();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home Page Sindicato</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="resources/libs/materialize/css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="public/css/estilo.css">
	<link rel="icon" href="public/img/indice.png">
</head>
<body class="">
	<div id="navbar"></div>

	<header>
		<div class="container center">
			<div class="row">
				<img src="public/img/sample-logo-crop.png" alt="Banner principal"/>
				<h2 class="titulo" id="titulo-home">Sindicato dos Trainees</h2>
				<h5> 
					<?php
					//var_dump($_SESSION);
					if (isset($sessao['mensagem']) and isset($sessao['logado'])) {
						echo $sessao['mensagem'] . PHP_EOL;
						echo "Bem-vindo, " . $sessao['usuario_nome'] . ". ";
						$sessionManager->unsetSessionVariable('mensagem');
						$sessionManager->unsetSessionVariable('tipo_mensagem');
					}
					?>
					<br>
					<?php
					if (isset($sessao['logado'])) {
						echo "Logado como ";
						if ($sessao['usuario_isAdmin'])
							echo "Administrador";
						else
							echo "Usuário comum";
					}
					?>
					<p style="font-size: 16px;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
						tempor incididunt ut labore et dolore magna aliqua.
					</p>
					<br>
					<?php if (!isset($sessao['logado'])): ?>
						<button
							id="botao-logar"
							type="button"
							class="btn waves-effect waves-light"
							onclick="location.href='login'"
						>
						Fazer login
						<i class="material-icons right">arrow_right</i>
					</button>
					<?php endif; ?>
				</h5>
			</div>
		</div>
	</header>

	<script src="resources/libs/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="resources/libs/materialize/js/materialize.js"></script>
	<script type="text/javascript"> $('#navbar').load('/navbar'); </script>
</body>
</html>