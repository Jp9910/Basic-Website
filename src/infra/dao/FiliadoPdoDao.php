<?php

namespace Jp\SindicatoTrainees\infra\dao;

use DateTimeImmutable;
use Jp\SindicatoTrainees\domain\models\Filiado;
use Jp\SindicatoTrainees\domain\interfaces\FiliadoDao;
use PDO;

/**
 * @version 1.0.0 - Versionamento inicial da classe
 */
class FiliadoPdoDao implements FiliadoDao
{

	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	public function getAll(): array
	{
		$sql = 'SELECT * FROM flo_filiado';
		$stmt = $this->rConexao->query($sql);
		return $this->loadFiliados($stmt);
	}

	public function findById(int $id): Filiado
	{
		$query = 'SELECT * FROM flo_filiado WHERE flo_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	public function findByEmpresa(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE ema_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	public function findByCargo(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE cro_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	public function findBySituacao(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE sto_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	public function search(...$params): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE :flo_id = ? 
								and :flo_nome = ? and :flo_login = ? and :flo_senha = ?';
		$stmt = $this->rConexao->prepare($query);
		//$stmt->bindParam();
		//$stmt->bindValue(1, $id, PDO::PARAM_INT);
		//$stmt->execute();
		return [new Filiado(null,'nome','CPF','RG',new DateTimeImmutable(),20,'7912345678','79912345678',new DateTimeImmutable(),1,1,1)];
	}

	public function insert(Filiado $oFiliado): bool
	{
		$query = "INSERT INTO flo_filiado 
                    (flo_nome, flo_cpf, flo_rg, flo_data_nascimento, flo_idade,
                     flo_telefone, flo_celular, flo_data_ultima_atualizacao,
                     ema_id, cro_id, sto_id) 
					VALUES 
                    (:nome, :cpf, :rg, :data_nascimento, :idade,
                    :telefone, :celular, :data_ultima_atualizacao,
                    :empresa, :cargo, :situacao)";

		$stmt = $this->rConexao->prepare($query);
		$nome = $oFiliado->nome();
		$CPF = $oFiliado->CPF();
		$RG = $oFiliado->RG();
		$dataNascimento = $oFiliado->dataNascimento()->format('Y-m-d');
		$idade = $oFiliado->idade();
		$telefone = $oFiliado->telefone();
		$celular = $oFiliado->celular();
		$dataUltimaAtualizacao = $oFiliado->dataUltimaAtualizacao()->format('Y-m-d');
		$empresa = $oFiliado->empresa();
		$cargo = $oFiliado->cargo();
		$situacao = $oFiliado->situacao();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam('cpf', $CPF, PDO::PARAM_STR);
		$stmt->bindParam('rg', $RG, PDO::PARAM_STR);
		$stmt->bindParam('data_nascimento', $dataNascimento, PDO::PARAM_STR);
		$stmt->bindParam('idade', $idade, PDO::PARAM_INT);
		$stmt->bindParam('telefone', $telefone, PDO::PARAM_STR);
		$stmt->bindParam('celular', $celular, PDO::PARAM_STR);
		$stmt->bindParam('data_ultima_atualizacao', $dataUltimaAtualizacao, PDO::PARAM_STR);
		$stmt->bindParam('empresa', $empresa, PDO::PARAM_INT);
		$stmt->bindParam('cargo', $cargo, PDO::PARAM_INT);
		$stmt->bindParam('situacao', $situacao, PDO::PARAM_INT);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function update(Filiado $oFiliado): bool
	{
		$query = 'UPDATE flo_filiado
			SET flo_nome = :nome, flo_telefone = :telefone, flo_celular = :celular,
				flo_data_ultima_atualizacao = :data_ultima_atualizacao,
				ema_id = :empresa, cro_id = :cargo, sto_id = :situacao
			WHERE flo_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oFiliado->id();
		$nome = $oFiliado->nome();
		$telefone = $oFiliado->telefone();
		$celular = $oFiliado->celular();
		$dataUltimaAtualizacao = $oFiliado->dataUltimaAtualizacao();
		$empresa = $oFiliado->empresa();
		$cargo = $oFiliado->cargo();
		$situacao = $oFiliado->situacao();
		$stmt->bindParam('nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam('telefone', $telefone, PDO::PARAM_STR);
		$stmt->bindParam('celular', $celular, PDO::PARAM_STR);
		$stmt->bindParam('data_ultima_atualizacao', $dataUltimaAtualizacao, PDO::PARAM_STR);
		$stmt->bindParam('empresa', $empresa, PDO::PARAM_INT);
		$stmt->bindParam('cargo', $cargo, PDO::PARAM_INT);
		$stmt->bindParam('situacao', $situacao, PDO::PARAM_INT);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	public function delete(int $id): bool
	{
		$query = 'DELETE FROM flo_filiado WHERE flo_id = :id';
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
	private function loadFiliados(\PDOStatement $stmt): array
	{
		$aFiliados = $stmt->fetchAll();
		$loArrayDeFiliados = [];
		foreach ($aFiliados as $filiado) {
				$filiado = new Filiado(
						$filiado['flo_id'],
						$filiado['flo_nome'],
						$filiado['flo_cpf'],
						$filiado['flo_rg'],
						new DateTimeImmutable($filiado['flo_data_nascimento']),
						$filiado['flo_idade'],
						$filiado['flo_telefone'],
						$filiado['flo_celular'],
						new DateTimeImmutable($filiado['flo_data_ultima_atualizacao']),
						$filiado['ema_id'],
						$filiado['cro_id'],
						$filiado['sto_id']
				);
				$loArrayDeFiliados[] = $filiado;
		}
		return $loArrayDeFiliados;
	}
}