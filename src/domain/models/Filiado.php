<?php

namespace Jp\SindicatoTrainees\domain\models;

use DateTimeInterface;
use JsonSerializable;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class Filiado implements JsonSerializable
{
	private ?int $id;
	private string $sNome;
	private string $sCPF;
	private string $sRG;
    private DateTimeInterface $oDataNascimento;
    private int $iIdade;
    private string $sTelefone;
    private string $sCelular;
    private DateTimeInterface $oDataUltimaAtualizacao;
	private int $iEmpresa;
	private int $iCargo;
	private int $iSituacao;

	public function __construct(
		?int $id,
		string $sNome,
		string $sCPF,
		string $sRG,
		DateTimeInterface $oDataNascimento,
		int $iIdade,
		string $sTelefone,
		string $sCelular,
		DateTimeInterface $oDataUltimaAtualizacao,
		int $iEmpresa,
		int $iCargo,
		int $iSituacao
	){
		$this->id = $id;
		$this->sNome = $sNome;
		$this->sCPF = $sCPF;
		$this->sRG = $sRG;
		$this->oDataNascimento = $oDataNascimento;
		$this->iIdade = $iIdade;
		$this->sTelefone = $sTelefone;
		$this->sCelular = $sCelular;
		$this->oDataUltimaAtualizacao = $oDataUltimaAtualizacao;
		$this->iEmpresa = $iEmpresa;
		$this->iCargo = $iCargo;
		$this->iSituacao = $iSituacao;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id(),
			'nome' => $this->nome(),
			'CPF' => $this->CPF(),
			'RG' => $this->RG(),
			'dataNascimento' => $this->dataNascimento(),
			'idade' => $this->idade(),
			'telefone' => $this->telefone(),
			'celular' => $this->celular(),
			'dataUltimaAtualizacao' => $this->dataUltimaAtualizacao(),
			'empresa' => $this->empresa(),
			'cargo' => $this->cargo(),
			'situacao' => $this->situacao()
		];
	}

	public function id(): ?int
	{
		return $this->id;
	}

	public function nome(): string
	{
		return $this->sNome;
	}

	public function CPF(): string
	{
		return $this->sCPF;
	}

	public function RG(): string
	{
		return $this->sRG;
	}
	
	public function dataNascimento(): DateTimeInterface
	{
		return $this->oDataNascimento;
	}

	public function idade(): int
	{
		return $this->iIdade;
	}

	public function telefone(): string
	{
		return $this->sTelefone;
	}

	public function celular(): string
	{
		return $this->sCelular;
	}

	public function dataUltimaAtualizacao(): DateTimeInterface
	{
		return $this->oDataUltimaAtualizacao;
	}

	public function empresa(): int
	{
		return $this->iEmpresa;
	}

	public function cargo(): int
	{
		return $this->iCargo;
	}

	public function situacao(): int
	{
		return $this->iSituacao;
	}
}