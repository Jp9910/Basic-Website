<?php
use Jp\SindicatoTrainees\infra\gerenciadores\SessionManager;
$sessao = SessionManager::getInstance()->getSessao();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
		<div class="nav-wrapper">
			<a href="/" class="brand-logo left">
				<!-- <span src="/resources/img/sample-logo.png" ></span> -->
				<img src="/resources/img/sample-logo.png" alt="logo" id="img-logo">
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<?php if (!isset($sessao['logado']) or $sessao['logado'] === false): ?>
					<li><a href="login">Login</a></li>
				<?php else: ?><li><a href="teste">teste logout</a></li>
				<?php endif; ?>
				<?php if (isset($sessao['usuario_isAdmin']) and $sessao['usuario_isAdmin'] === 1): ?>
					<li><a href="cadastro">Cadastrar Usuário</a></li>
					<li><a href="listar-usuarios">Ver Usuários do Sistema</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</body>
</html>