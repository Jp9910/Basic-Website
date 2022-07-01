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

	public function getUsuarioById(int $id)
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$oUsuario = $rDao->findById($id);
		return $oUsuario;
	}

	public function editarUsuario(int $id, string $sNome, string $sLogin, string $sSenha, int $isAdmin)
	{
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

	public function login(string $sLogin, string $sSenha): string
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
		if (password_verify($sSenha, $oUsuario->sSenha())) {
			// Usuário existe e senha está correta.
			return json_encode([
				'status' => 200,
				'status_text' => 'success',
				'usuario' => $oUsuario
			]);
		}
		// Usuário existe mas senha está incorreta.
		return json_encode([
			'status' => 403,
			'status_text' => 'Senha incorreta'
		]);
	}

	/*
	* @TODO
	*/
	public function criarUsuario(string $sNome, string $sLogin, string $sSenha, int $isAdmin)
	{
		//criar conexao com o banco de dados e inserir um novo usuario
		// throw new Exception('teste');
		// exit();
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

	/**
	 * @TODO
	 */
	public function deletarUsuario()
	{

	}
}