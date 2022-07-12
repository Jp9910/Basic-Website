<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use Jp\SindicatoTrainees\infra\dao\EmpresaPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;
use Jp\SindicatoTrainees\domain\models\Empresa;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class EmpresaController extends Controller
{
	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Retorna a lista de empresas cadastradas no sistema
	*
	* Cria uma conexão com o BD e usa o DAO para consultar os usuários no sistema.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return array
	*/
	public function getEmpresas(): array
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new EmpresaPdoDao($rPdo);
		$loEmpresas = $rDao->getAll();
		return $loEmpresas;
	}

	public function getEmpresaById(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new EmpresaPdoDao($rPdo);
		$oEmpresa = $rDao->findById($id);
		return $oEmpresa;
	}

	public function editarEmpresa(int $id, string $sNome)
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
		$rDao = new EmpresaPdoDao($rPdo);
		$oEmpresa = new Empresa($id, $sNome);
		if ($rDao->update($oEmpresa)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Empresa editada.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function criarEmpresa(string $sNome)
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
		$rDao = new EmpresaPdoDao($rPdo);
		if ($rDao->insert(new Empresa(null, $sNome))){
			return json_encode([
				'status' => 200,
				'status_text' => 'Empresa criada.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function deletarEmpresa(int $id)
	{
		// Retorna string mesmo que o input seja int
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new EmpresaPdoDao($rPdo);
		if ($rDao->delete($id)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Empresa excluida.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}
}