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

	/*
	* @TODO
	*/
	public function criarUsuario()
	{
		echo 'ok';
		//criar conexao com o banco de dados e inserir um novo administrador
	}

	/**
	 * @TODO
	 */
	public function deletarUsuario()
	{

	}
}