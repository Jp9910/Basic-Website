<?php

namespace Jp\SindicatoTrainees\infra\dao;

use Jp\SindicatoTrainees\domain\models\Cargo;
use Jp\SindicatoTrainees\domain\interfaces\CargoDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class CargoPdoDao implements CargoDao
{

	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM cro_cargo';
		$stmt = $this->rConexao->query($sql);
		return $this->loadCargos($stmt);
	}

	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM cro_cargo LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadCargos($stmt);
		}
	}

	public function findById(int $id): Cargo
	{
		$query = 'SELECT * FROM cro_cargo WHERE cro_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadCargos($stmt)[0];
	}

	public function insert(Cargo $oCargo): bool
	{
		$query = "INSERT INTO cro_cargo (cro_nome) 
					VALUES (:nome)";
		$stmt = $this->rConexao->prepare($query);
		$nome = $oCargo->sNome();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function update(Cargo $oCargo): bool
	{
        $query = 'UPDATE cro_cargo
            SET cro_nome = :nome
            WHERE cro_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oCargo->id();
		$nome = $oCargo->sNome();
		$stmt->bindParam('id', $id);
		$stmt->bindParam('nome', $nome);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM cro_cargo WHERE cro_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return true;
	}

	/*
	* Realiza o ORM para cargo
	*
	* Transforma as informações do BD em objetos de Cargo.
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
	private function loadCargos(\PDOStatement $stmt): array
	{
		$aCargos = $stmt->fetchAll();
		$loArrayDeCargos = [];
		foreach ($aCargos as $cargo) {
				$cargo = new Cargo(
						$cargo['cro_id'],
						$cargo['cro_nome']
				);
				$loArrayDeCargos[] = $cargo;
		}
		return $loArrayDeCargos;
	}
}