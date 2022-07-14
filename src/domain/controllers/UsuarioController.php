<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use Exception;
use Jp\SindicatoTrainees\infra\dao\UsuarioPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;
use Jp\SindicatoTrainees\domain\models\Usuario;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class UsuarioController extends Controller
{
	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Retorna a lista de usuários cadastrados no sistema
	*
	* Cria uma conexão com o BD e usa o DAO para consultar os usuários no sistema.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return array
	*/
	public function getUsuarios(): array
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$loUsuarios = $rDao->getAll();
		return $loUsuarios;
	}

	public function getUsuariosPagina(?int $pagina=1, ?int $qntPorPag=3): array
	{
		$qntPorPag = filter_var($qntPorPag, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$loEmpresas = $rDao->getPagina($pagina, $qntPorPag);
		return $loEmpresas;
	}

	public function getUsuarioById(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$oUsuario = $rDao->findById($id);
		return $oUsuario;
	}

	public function editarUsuario(int $id, string $sNome, string $sLogin, string $sSenha, int $isAdmin)
	{
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		if (!empty($sSenha))
			$sSenha = password_hash($sSenha, PASSWORD_DEFAULT);
		$oUsuario = new Usuario($id, $sNome, $sLogin, $sSenha , $isAdmin);
		if ($rDao->update($oUsuario)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'success'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function login(string $sLogin, string $sSenhaDigitada): string
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		// procurar pelo usuário digitado no bd e retornar a senha, e depois 
		// checar se a senha salva corresponde com o hash da senha digitada
		$oUsuario = $rDao->searchLogin($sLogin);
		if (!isset($oUsuario)) {
			// Usuário não existe
			return json_encode([
				'status' => 400,
				'status_text' => 'Usuário não existe'
			]);
		}
		if ($oUsuario->verificarSenha($sSenhaDigitada)) {
			// Usuário existe e senha está correta.
			return json_encode([
				'status' => 200,
				'status_text' => 'Login efetuado com sucesso.',
				'usuario' => $oUsuario
			]);
		}
		// Usuário existe mas senha está incorreta.
		return json_encode([
			'status' => 403,
			'status_text' => 'Senha incorreta'
		]);
	}

	public function criarUsuario(string $sNome, string $sLogin, string $sSenha, int $isAdmin)
	{
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
		$sLogin = filter_var($sLogin, FILTER_SANITIZE_SPECIAL_CHARS);
		$isAdmin = filter_var($isAdmin, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$senha_hashed = password_hash($sSenha, PASSWORD_DEFAULT);
		if ($rDao->insert(new Usuario(null, $sNome, $sLogin, $senha_hashed, $isAdmin))){
			return json_encode([
				'status' => 200,
				'status_text' => 'success'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function deletarUsuario(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		if ($rDao->delete($id)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'success'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}
}