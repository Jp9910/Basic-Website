<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use Jp\SindicatoTrainees\infra\dao\CargoPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;
use Jp\SindicatoTrainees\domain\models\Cargo;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class CargoController extends Controller
{
	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Retorna a lista de cargos cadastradas no sistema
	*
	* Cria uma conexão com o BD e usa o DAO para consultar os cargos no sistema.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return array
	*/

	public function getCargos(): array
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		$loCargos = $rDao->getAll();
		return $loCargos;
	}

	public function getCargosPagina(?int $pagina=1, ?int $qntPorPag=3): array
	{
		$qntPorPag = filter_var($qntPorPag, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		$loEmpresas = $rDao->getPagina($pagina, $qntPorPag);
		return $loEmpresas;
	}

	public function getCargoById(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		$oCargo = $rDao->findById($id);
		return $oCargo;
	}

	public function editarCargo(int $id, string $sNome)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($sNome)) {
            return json_encode([
                'status' => 400,
                'status_text' => 'Nome não pode ser vazio.'
            ]);
        }
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		$oCargo = new Cargo($id, $sNome);
		if ($rDao->update($oCargo)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Cargo editado.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function criarCargo(string $sNome)
	{
		//@Nota: Checagem de nome nulo é mais apropriada no handler da api ou aqui no controller?
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($sNome)) {
            return json_encode([
                'status' => 400,
                'status_text' => 'Nome não pode ser vazio.'
            ]);
        }
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		if ($rDao->insert(new Cargo(null, $sNome))){
			return json_encode([
				'status' => 200,
				'status_text' => 'Cargo criado.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function deletarCargo(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new CargoPdoDao($rPdo);
		if ($rDao->delete($id)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Cargo excluido.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}
}