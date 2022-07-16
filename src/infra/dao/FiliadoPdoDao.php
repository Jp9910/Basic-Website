<?php

namespace Jp\SindicatoTrainees\infra\dao;

use DateTimeImmutable;
use Jp\SindicatoTrainees\domain\models\Filiado;
use Jp\SindicatoTrainees\domain\interfaces\FiliadoDao;
use PDO;

/**
 * @version 1.1.0 - Função para ORM com nome de empresa, de cargo e de situação
 */
class FiliadoPdoDao implements FiliadoDao
{
	private PDO $rConexao;

	public function __construct(PDO $connection)
	{
		//dependency injection
		$this->rConexao = $connection;
	}

	/*
	* Pega todos os filiados no banco.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* @return array
	*/
	public function getAll(): array
	{
		$sql = 'SELECT * FROM flo_filiado
				JOIN ema_empresa ON flo_filiado.ema_id = ema_empresa.ema_id
				JOIN cro_cargo ON flo_filiado.cro_id = cro_cargo.cro_id
				JOIN sto_situacao ON flo_filiado.sto_id = sto_situacao.sto_id';
		$stmt = $this->rConexao->query($sql);
		return $this->loadFiliadosJoin($stmt);
	}

	/*
	* Pega uma certa quantidade de filiados no BD para preencher uma página,
	* de acordo com a página e a quantidade de resultados por página
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* 
	* @param int $pagina número da página
	* @param int $quantidade quantidade de resultados por página
	* @return array
	*/
	public function getPagina(?int $pagina, ?int $quantidade): array
	{
		if (isset($pagina) and isset($quantidade)) {
			$sql = 'SELECT * FROM flo_filiado
					JOIN ema_empresa ON flo_filiado.ema_id = ema_empresa.ema_id
					JOIN cro_cargo ON flo_filiado.cro_id = cro_cargo.cro_id
					JOIN sto_situacao ON flo_filiado.sto_id = sto_situacao.sto_id
					LIMIT ? OFFSET ?';
			$stmt = $this->rConexao->prepare($sql);
			$stmt->bindValue(1, ($quantidade), PDO::PARAM_INT);
			$stmt->bindValue(2, (($pagina*$quantidade)-$quantidade), PDO::PARAM_INT);
			$stmt->execute();
			return $this->loadFiliadosJoin($stmt);
		}
	}

	/*
	* Pega um filiado no banco de acordo com o ID passado.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* 
	* @param int $id ID do filiado
	* @return array
	*/
	public function findById(int $id): Filiado
	{
		$query = 'SELECT * FROM flo_filiado WHERE flo_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
	}

	// @TODO
	public function findByEmpresa(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE ema_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	// @TODO
	public function findByCargo(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE cro_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	// @TODO
	public function findBySituacao(int $id): array
	{
		$query = 'SELECT * FROM flo_filiado WHERE sto_id = ?';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->execute();
		return $this->loadFiliados($stmt)[0];
		//return new Filiado(null,'nomeFiliado', 'loginFiliado', 'senha', false);
	}

	// @TODO
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

	/*
	* Insere um filiado no BD
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* 
	* @param Filiado $filiado objeto de filiado contendo os dados a serem guardados
	* @return array
	*/
	public function insert(Filiado $oFiliado): bool
	{
		$query = "INSERT INTO flo_filiado 
                    (flo_nome, flo_cpf, flo_rg, flo_data_nascimento, flo_idade,
                     flo_telefone, flo_celular, flo_data_ultima_atualizacao,
                     ema_id, cro_id, sto_id) 
					VALUES 
                    (:nome, :cpf, :rg, :dataNascimento, :idade,
                    :telefone, :celular, :dataUltimaAtualizacao,
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
		$stmt->bindParam('dataNascimento', $dataNascimento, PDO::PARAM_STR);
		$stmt->bindParam('idade', $idade, PDO::PARAM_INT);
		$stmt->bindParam('telefone', $telefone, PDO::PARAM_STR);
		$stmt->bindParam('celular', $celular, PDO::PARAM_STR);
		$stmt->bindParam('dataUltimaAtualizacao', $dataUltimaAtualizacao, PDO::PARAM_STR);
		$stmt->bindParam('empresa', $empresa, PDO::PARAM_INT);
		$stmt->bindParam('cargo', $cargo, PDO::PARAM_INT);
		$stmt->bindParam('situacao', $situacao, PDO::PARAM_INT);
		$this->rConexao->beginTransaction();
		$stmt->execute();
		$this->rConexao->commit();
		return true;
	}

	/*
	* Atualiza os campos do filiado no BD de acordo com o objeto passado
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* 
	* @param Filiado $filiado objeto de filiado contendo os dados a serem atualizados
	* @return array
	*/
	public function update(Filiado $oFiliado): bool
	{
		$query = 'UPDATE flo_filiado
			SET flo_nome = :nome, flo_telefone = :telefone, flo_celular = :celular,
				flo_data_ultima_atualizacao = :dataUltimaAtualizacao,
				ema_id = :empresa, cro_id = :cargo, sto_id = :situacao
			WHERE flo_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$id = $oFiliado->id();
		$nome = $oFiliado->nome();
		$telefone = $oFiliado->telefone();
		$celular = $oFiliado->celular();
		$dataUltimaAtualizacao = $oFiliado->dataUltimaAtualizacao()->format('Y-m-d H:i:s');
		$empresa = $oFiliado->empresa();
		$cargo = $oFiliado->cargo();
		$situacao = $oFiliado->situacao();
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

	/*
	* Remove um filiado do BD a partir do seu ID
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* 
	* @param int $id ID do filiado.
	* @return array
	*/
	public function delete(int $id): bool
	{
		$query = 'DELETE FROM flo_filiado WHERE flo_id = :id';
		$stmt = $this->rConexao->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return true;
	}

	/*
	* Realiza o ORM para filiado
	*
	* Transforma as informações do BD em objetos de Filiado.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* @see https://developer.locaweb.com.br/documentacoes/smtp/php/
	* 
	* @param PDOStatement $stmt statement do PDO contendo a query
	* @return array
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

	/*
	* Realiza o ORM para filiado com nome da empresa, do cargo e da situação
	*
	* Transforma as informações do BD em objetos de Filiado.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	* @see https://developer.locaweb.com.br/documentacoes/smtp/php/
	* 
	* @param PDOStatement $stmt statement do PDO contendo a query
	* @return array
	*/
	private function loadFiliadosJoin(\PDOStatement $stmt): array
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
						$filiado['ema_nome'],
						$filiado['cro_nome'],
						$filiado['sto_nome']
				);
				$loArrayDeFiliados[] = $filiado;
		}
		return $loArrayDeFiliados;
	}
}