<?php

namespace Jp\SindicatoTrainees\infra\dao;

use Jp\SindicatoTrainees\domain\models\Usuario;
use Jp\SindicatoTrainees\domain\interfaces\UsuarioDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class UsuarioPdoDao implements UsuarioDao
{

	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM uso_usuarios';
		$stmt = $this->rConexao->query($sql);
		return $this->loadUsuarios($stmt);
	}

	public function findById(int $id): Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE uso_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha');
	}

	public function search(...$params): Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE :uso_id = ? 
								and :uso_nome = ? and :uso_login = ? and :uso_senha = ?';
		$stmt = $this->rConexao->prepare($query);
		//$stmt->bindParam();
		//$stmt->bindValue(1, $id, PDO::PARAM_INT);
		//$stmt->execute();
		return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha');
	}

	public function searchLogin(string $usuario, string $senha): ?Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE uso_login = ? and uso_senha = SHA1(?)';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $usuario, PDO::PARAM_STR);
		$stmt->bindValue(2, $senha, PDO::PARAM_STR);
		$stmt->execute();
		$oUsuario = $this->loadUsuarios($stmt);
		if (isset($oUsuario[0]))
			return $oUsuario[0];
		return null;
	}

	public function insert(Usuario $usuario): bool
	{

		$this->rConexao->beginTransaction();
		return true;
		$this->rConexao->commit();
	}

	public function update(Usuario $usuario): bool
	{
		return true;
	}

	public function delete(Usuario $usuario): bool
	{
		return true;
	}

	/*
	* Realiza o ORM para usuário
	*
	* Transforma as informações do BD em objetos de Usuário.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* @see https://developer.locaweb.com.br/documentacoes/smtp/php/
	* 
	* @param PDOStatement $stmt statement do PDO contendo a query
	* @return array
	*
	* @throws Exception
	* 
	*/
	private function loadUsuarios(\PDOStatement $stmt): array
	{
		$aUsuarios = $stmt->fetchAll();
		$loArrayDeUsuarios = [];
		foreach ($aUsuarios as $usuario) {
				$usuario = new Usuario(
						$usuario['uso_id'],
						$usuario['uso_nome'],
						$usuario['uso_login'],
						$usuario['uso_senha']
				);
				$loArrayDeUsuarios[] = $usuario;
		}
		return $loArrayDeUsuarios;
	}
}