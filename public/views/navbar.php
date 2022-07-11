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
				<!-- <span src="/public/img/sample-logo.png" ></span> -->
				<img src="/public/img/sample-logo.png" alt="logo" id="img-logo">
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<?php if (isset($sessao['logado']) and $sessao['logado'] === true): ?>
					<li><a href="empresas">Empresas</a>
					<li><a href="cargos">Cargos</a>
					<li><a href="situacoes">Situações</a>
					<li><a href="listar-filiados">Filiados</a>
					<li><a href="logout">Logout</a>
					<?php if (isset($sessao['usuario_isAdmin']) and $sessao['usuario_isAdmin'] === 1): ?>
						<li><a href="cadastro">Cadastrar Usuário</a></li>
						<li><a href="listar-usuarios">Ver Usuários do Sistema</a></li>
					<?php endif; ?>
				<?php else: ?>
					<li><a href="login">Login</a></li></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</body>
</html>