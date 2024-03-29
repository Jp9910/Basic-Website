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

	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM uso_usuarios LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadUsuarios($stmt);
		}
	}

	public function findById(int $id): Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE uso_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadUsuarios($stmt)[0];
		//return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha', false);
	}

	public function search(...$params): Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE :uso_id = ? 
								and :uso_nome = ? and :uso_login = ? and :uso_senha = ?';
		$stmt = $this->rConexao->prepare($query);
		//$stmt->bindParam();
		//$stmt->bindValue(1, $id, PDO::PARAM_INT);
		//$stmt->execute();
		return new Usuario(null,'nomeUsuario', 'loginUsuario', 'senha', false);
	}

	public function searchLogin(string $usuario): ?Usuario
	{
		$query = 'SELECT * FROM uso_usuarios WHERE uso_login = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $usuario, PDO::PARAM_STR);
		$stmt->execute();
		$oUsuario = $this->loadUsuarios($stmt);
		if (isset($oUsuario[0]))
			return $oUsuario[0];
		return null;
	}

	// public function searchLoginSenha(string $usuario, string $senha): ?Usuario
	// {
	// 	$query = 'SELECT * FROM uso_usuarios WHERE uso_login = ? and uso_senha = SHA1(?)';
	// 	$stmt = $this->rConexao->prepare($query);
	// 	$stmt->bindValue(1, $usuario, PDO::PARAM_STR);
	// 	$stmt->bindValue(2, $senha, PDO::PARAM_STR);
	// 	$stmt->execute();
	// 	$oUsuario = $this->loadUsuarios($stmt);
	// 	if (isset($oUsuario[0]))
	// 		return $oUsuario[0];
	// 	return null;
	// }

	public function insert(Usuario $oUsuario): bool
	{
		$query = "INSERT INTO uso_usuarios (uso_nome, uso_login, uso_senha, uso_isAdmin) 
					VALUES (:nome, :login, :senha, :isAdmin)";
		$stmt = $this->rConexao->prepare($query);
		$nome = $oUsuario->sNome();
		$login = $oUsuario->sLogin();
		$senha = $oUsuario->sSenha();
		$isAdmin = $oUsuario->isAdmin();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam('login', $login);
		$stmt->bindParam('senha', $senha);
		$stmt->bindParam('isAdmin', $isAdmin);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function update(Usuario $oUsuario): bool
	{
		$senhavazia = false;
		if (empty($oUsuario->sSenha()))
			$senhavazia = true;
		if ($senhavazia) {
			$query = 'UPDATE uso_usuarios
				SET uso_nome = :nome, uso_login = :login, uso_isAdmin = :isAdmin
				WHERE uso_id = :id';
		} else {
			$query = 'UPDATE uso_usuarios
				SET uso_nome = :nome, uso_login = :login, uso_senha = :senha, uso_isAdmin = :isAdmin
				WHERE uso_id = :id';
		}
		$stmt = $this->rConexao->prepare($query);
		$id = $oUsuario->id();
		$nome = $oUsuario->sNome();
		$login = $oUsuario->sLogin();
		$senha = $oUsuario->sSenha();
		$isAdmin = $oUsuario->isAdmin();
		$stmt->bindParam('id', $id);
		$stmt->bindParam('nome', $nome);
		$stmt->bindParam('login', $login);
		if(!$senhavazia)
			$stmt->bindParam('senha', $senha);
		$stmt->bindParam('isAdmin', $isAdmin);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM uso_usuarios WHERE uso_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
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
						$usuario['uso_senha'],
						$usuario['uso_isAdmin']
				);
				$loArrayDeUsuarios[] = $usuario;
		}
		return $loArrayDeUsuarios;
	}
}