<?php

namespace Jp\SindicatoTrainees\domain\controllers;

use Jp\SindicatoTrainees\infra\dao\SituacaoPdoDao;
use Jp\SindicatoTrainees\infra\DBConnector;
use Jp\SindicatoTrainees\domain\controllers\Controller;
use Jp\SindicatoTrainees\domain\models\Situacao;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class SituacaoController extends Controller
{
	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Retorna a lista de situacaos cadastradas no sistema
	*
	* Cria uma conexão com o BD e usa o DAO para consultar os situacaos no sistema.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return array
	*/

	// @NOTE: Not yet used
	public function getSituacaos(): array
	{
		$rPdo = DBConnector::createConnection();
		$rDao = new SituacaoPdoDao($rPdo);
		$loSituacaos = $rDao->getAll();
		return $loSituacaos;
	}

	public function getSituacaosPagina(?int $pagina=1, ?int $qntPorPag=3): array
	{
		$qntPorPag = filter_var($qntPorPag, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new SituacaoPdoDao($rPdo);
		$loEmpresas = $rDao->getPagina($pagina, $qntPorPag);
		return $loEmpresas;
	}

	public function getSituacaoById(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new SituacaoPdoDao($rPdo);
		$oSituacao = $rDao->findById($id);
		return $oSituacao;
	}

	public function editarSituacao(int $id, string $sNome)
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
		$rDao = new SituacaoPdoDao($rPdo);
		$oSituacao = new Situacao($id, $sNome);
		if ($rDao->update($oSituacao)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Situacao editado.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function criarSituacao(string $sNome)
	{
		$sNome = filter_var($sNome, FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($sNome)) {
            return json_encode([
                'status' => 400,
                'status_text' => 'Nome não pode ser vazio.'
            ]);
        }
		$rPdo = DBConnector::createConnection();
		$rDao = new SituacaoPdoDao($rPdo);
		if ($rDao->insert(new Situacao(null, $sNome))){
			return json_encode([
				'status' => 200,
				'status_text' => 'Situacao criado.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}

	public function deletarSituacao(int $id)
	{
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$rPdo = DBConnector::createConnection();
		$rDao = new SituacaoPdoDao($rPdo);
		if ($rDao->delete($id)) {
			return json_encode([
				'status' => 200,
				'status_text' => 'Situacao excluido.'
			]);
		}
		return json_encode([
			'status' => 500,
			'status_text' => 'Ops, algo deu errado...'
		]);
	}
}