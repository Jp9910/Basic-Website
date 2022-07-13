<?php

namespace Jp\SindicatoTrainees\infra\dao;

use Jp\SindicatoTrainees\domain\models\Empresa;
use Jp\SindicatoTrainees\domain\interfaces\EmpresaDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class EmpresaPdoDao implements EmpresaDao
{

	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM ema_empresa';
		$stmt = $this->rConexao->query($sql);
		return $this->loadEmpresas($stmt);
	}

	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM ema_empresa LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadEmpresas($stmt);
		}
	}

	public function findById(int $id): Empresa
	{
		$query = 'SELECT * FROM ema_empresa WHERE ema_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadEmpresas($stmt)[0];
	}

	public function insert(Empresa $oEmpresa): bool
	{
		$query = "INSERT INTO ema_empresa (ema_nome) 
					VALUES (:nome)";
		$stmt = $this->rConexao->prepare($query);
		$nome = $oEmpresa->sNome();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function update(Empresa $oEmpresa): bool
	{
        $query = 'UPDATE ema_empresa
            SET ema_nome = :nome
            WHERE ema_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oEmpresa->id();
		$nome = $oEmpresa->sNome();
		$stmt->bindParam('id', $id);
		$stmt->bindParam('nome', $nome);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM ema_empresa WHERE ema_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return true;
	}

	/*
	* Realiza o ORM para empresa
	*
	* Transforma as informações do BD em objetos de Empresa.
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
	private function loadEmpresas(\PDOStatement $stmt): array
	{
		$aEmpresas = $stmt->fetchAll();
		$loArrayDeEmpresas = [];
		foreach ($aEmpresas as $empresa) {
				$empresa = new Empresa(
						$empresa['ema_id'],
						$empresa['ema_nome']
				);
				$loArrayDeEmpresas[] = $empresa;
		}
		return $loArrayDeEmpresas;
	}
}