<?php

namespace Jp\SindicatoTrainees\infra\dao;

use Jp\SindicatoTrainees\domain\models\Situacao;
use Jp\SindicatoTrainees\domain\interfaces\SituacaoDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class SituacaoPdoDao implements SituacaoDao
{

	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM sto_situacao';
		$stmt = $this->rConexao->query($sql);
		return $this->loadSituacaos($stmt);
	}

	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM sto_situacao LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadSituacaos($stmt);
		}
	}

	public function findById(int $id): Situacao
	{
		$query = 'SELECT * FROM sto_situacao WHERE sto_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadSituacaos($stmt)[0];
	}

	public function insert(Situacao $oSituacao): bool
	{
		$query = "INSERT INTO sto_situacao (sto_nome) 
					VALUES (:nome)";
		$stmt = $this->rConexao->prepare($query);
		$nome = $oSituacao->sNome();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function update(Situacao $oSituacao): bool
	{
        $query = 'UPDATE sto_situacao
            SET sto_nome = :nome
            WHERE sto_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oSituacao->id();
		$nome = $oSituacao->sNome();
		$stmt->bindParam('id', $id);
		$stmt->bindParam('nome', $nome);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM sto_situacao WHERE sto_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return true;
	}

	/*
	* Realiza o ORM para situacao
	*
	* Transforma as informações do BD em objetos de Situacao.
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
	private function loadSituacaos(\PDOStatement $stmt): array
	{
		$aSituacaos = $stmt->fetchAll();
		$loArrayDeSituacaos = [];
		foreach ($aSituacaos as $situacao) {
				$situacao = new Situacao(
						$situacao['sto_id'],
						$situacao['sto_nome']
				);
				$loArrayDeSituacaos[] = $situacao;
		}
		return $loArrayDeSituacaos;
	}
}