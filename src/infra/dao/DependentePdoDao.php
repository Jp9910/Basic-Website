<?php

namespace Jp\SindicatoTrainees\infra\dao;

use DateTimeImmutable;
use Jp\SindicatoTrainees\domain\models\Dependente;
use Jp\SindicatoTrainees\domain\interfaces\DependenteDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class DependentePdoDao implements DependenteDao
{

	private PDO $rConexao;

	public function getConexao()
	{
		return $this->rConexao;
	}
	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM dpe_dependente';
		$stmt = $this->rConexao->query($sql);
		return $this->loadDependentes($stmt);
	}

	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM dpe_dependente LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadDependentes($stmt);
		}
	}

	public function findById(int $id): Dependente
	{
		$query = 'SELECT * FROM dpe_dependente WHERE dpe_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadDependentes($stmt)[0];
		//return new Dependente(null,'nomeDependente', 'loginDependente', 'senha', false);
	}

	public function findByFiliadoId(int $id): array
	{
		$query = 'SELECT * FROM dpe_dependente WHERE flo_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadDependentes($stmt)[0];
		//return new Dependente(null,'nomeDependente', 'loginDependente', 'senha', false);
	}

	public function insert(Dependente $oDependente): bool
	{
		$query = "INSERT INTO dpe_dependente 
                    (dpe_nome, dpe_data_nascimento, dpe_parentesco, flo_id) 
					VALUES 
                    (:nome, :dataNascimento, :parentesco, :flo_id)";

		$stmt = $this->rConexao->prepare($query);
		$nome = $oDependente->nome();
		$dataNascimento = $oDependente->dataNascimento()->format('Y-m-d');
		$parentesco = $oDependente->grauParentesco();
		$flo_id = $oDependente->flo_id();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam('dataNascimento', $dataNascimento, PDO::PARAM_STR);
		$stmt->bindParam('parentesco', $parentesco, PDO::PARAM_STR);
		$stmt->bindParam('flo_id', $flo_id, PDO::PARAM_INT);
		//$this->rConexao->beginTransaction();
		$stmt->execute();
		//$this->rConexao->commit();
		return true;
	}

	public function insertMultiple(Dependente $oDependente): bool
	{
		$query = "INSERT INTO dpe_dependente 
                    (dpe_nome, dpe_data_nascimento, dpe_parentesco, flo_id) 
					VALUES 
                    (:nome, :dataNascimento, :parentesco, :flo_id)";
	}

	public function update(Dependente $oDependente): bool
	{
		$query = 'UPDATE dpe_dependente
			SET dpe_nome = :nome, dpe_telefone = :telefone, dpe_celular = :celular,
				dpe_data_ultima_atualizacao = :dataUltimaAtualizacao,
				ema_id = :empresa, cro_id = :cargo, sto_id = :situacao
			WHERE dpe_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oDependente->id();
		$nome = $oDependente->nome();
		$telefone = $oDependente->telefone();
		$celular = $oDependente->celular();
		$dataUltimaAtualizacao = $oDependente->dataUltimaAtualizacao()->format('Y-m-d H:i:s');
		$empresa = $oDependente->empresa();
		$cargo = $oDependente->cargo();
		$situacao = $oDependente->situacao();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam('telefone', $telefone, PDO::PARAM_STR);
		$stmt->bindParam('celular', $celular, PDO::PARAM_STR);
		$stmt->bindParam('dataUltimaAtualizacao', $dataUltimaAtualizacao, PDO::PARAM_STR);
		$stmt->bindParam('empresa', $empresa, PDO::PARAM_INT);
		$stmt->bindParam('cargo', $cargo, PDO::PARAM_INT);
		$stmt->bindParam('situacao', $situacao, PDO::PARAM_INT);
		$stmt->bindParam('id', $id, PDO::PARAM_INT);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM dpe_dependente WHERE dpe_id = :id';
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
	private function loadDependentes(\PDOStatement $stmt): array
	{
		$aDependentes = $stmt->fetchAll();
		$loArrayDeDependentes = [];
		foreach ($aDependentes as $dependente) {
				$dependente = new Dependente(
						$dependente['dpe_id'],
						$dependente['dpe_nome'],
						$dependente['dpe_cpf'],
						$dependente['dpe_rg'],
						new DateTimeImmutable($dependente['dpe_data_nascimento']),
						$dependente['dpe_idade'],
						$dependente['dpe_telefone'],
						$dependente['dpe_celular'],
						new DateTimeImmutable($dependente['dpe_data_ultima_atualizacao']),
						$dependente['ema_id'],
						$dependente['cro_id'],
						$dependente['sto_id']
				);
				$loArrayDeDependentes[] = $dependente;
		}
		return $loArrayDeDependentes;
	}
}