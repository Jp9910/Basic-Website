<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use DateTimeImmutable;
use DateTimeZone;
use Jp\SindicatoTrainees\infra\dao\DependentePdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;
use Jp\SindicatoTrainees\domain\models\Dependente;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class DependenteController extends Controller
{
	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Retorna a lista de dependentes cadastradas no sistema
	*
	* Cria uma conexão com o BD e usa o DAO para consultar as dependentes no sistema.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return array
	*/
	public function getDependentes(): array
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		$loDependentes = $rDao->getAll();
		return $loDependentes;
	}

	public function getDependentesPagina(?int $pagina, ?int $qntPorPag): array
	{
		$qntPorPag = filter_var($qntPorPag, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		$loDependentes = $rDao->getPagina($pagina, $qntPorPag);
		return $loDependentes;
	}

	public function getDependenteById(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		$oDependente = $rDao->findById($id);
		return $oDependente;
	}

	public function editarDependente(int $id, string $sNome)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
		//@Nota: Checagem de nome nulo é mais apropriada nesta api ou no controller?
		if (empty($sNome)) {
            return json_encode([
                'status' => 400,
                'status_text' => 'Nome não pode ser vazio.'
            ]);
        }
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		$oDependente = new Dependente($id, $sNome);
		if ($rDao->update($oDependente)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Dependente editada.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function criarDependente(string $sNome)
	{
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
		//@Nota: Checagem de nome nulo é mais apropriada nesta api ou no controller?
		if (empty($sNome)) {
            return json_encode([
                'status' => 400,
                'status_text' => 'Nome não pode ser vazio.'
            ]);
        }
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		if ($rDao->insert(new Dependente(null, $sNome))){
			return json_encode([
				'status' => 200,
				'status_text' => 'Dependente criada.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function criarDependentes(array $aDependentes)
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		$conexao = $rDao->getConexao();
		$conexao->beginTransaction();
		foreach ($aDependentes as $aDependente) {
			$aDependente['nome'] = filter_var($aDependente['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
			$aDependente['dataNascimento'] = filter_var($aDependente['dataNascimento'], FILTER_SANITIZE_SPECIAL_CHARS);
			$aDependente['parentesco'] = filter_var($aDependente['parentesco'], FILTER_SANITIZE_SPECIAL_CHARS);
			if (empty($aDependente['nome']) or empty($aDependente['dataNascimento']) or empty($aDependente['parentesco'])) {
				return json_encode([
					'status' => 400,
					'status_text' => "Dependente não pode conter campos vazios."
				]);
			}
			$rDao->insert(new Dependente(
				null,
				$aDependente['nome'],
				new DateTimeImmutable($aDependente['dataNascimento'], new DateTimeZone('Brazil/East')),
				$aDependente['parentesco'],
				$aDependente['flo_id']
			));
		}
		$conexao->commit();
		return json_encode([
			'status' => 200,
			'status_text' => 'Dependente(s) criados.'
		]);
	}

	public function deletarDependente(int $id)
	{
		// Retorna string mesmo que o input seja int
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new DependentePdoDao($rPdo);
		if ($rDao->delete($id)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Dependente excluida.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}
}