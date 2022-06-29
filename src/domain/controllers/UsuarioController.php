<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use Jp\SindicatoTrainees\infra\dao\UsuarioPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;

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

	public function login(string $usuario, string $senha): string
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		$oUsuario = $rDao->searchLogin($usuario, $senha);
		if (isset($oUsuario)) {
			$result = [
				'status' => 200,
				'status_text' => 'success'
			];
		} else {
			$result = [
				'status' => 400,
				'status_text' => 'Bad Request'
			];
		}
		return json_encode($result);
	}

	/*
	* @TODO
	*/
	public function criarUsuario()
	{
		echo 'usuario: ';
		echo htmlspecialchars($_REQUEST['usuario'] . PHP_EOL);
		echo 'senha: ';
		echo htmlspecialchars($_REQUEST['senha'] . PHP_EOL);
		//criar conexao com o banco de dados e inserir um novo usuario
		$rPdo = DBConnector::createConnection();
		$rDao = new UsuarioPdoDao($rPdo);
		//$rDao->insert($usuario, $senha);
		$result = [
			'status' => 200,
			'status_text' => 'success'
		];
		return json_encode($result);
	}

	/**
	 * @TODO
	 */
	public function deletarUsuario()
	{

	}
}