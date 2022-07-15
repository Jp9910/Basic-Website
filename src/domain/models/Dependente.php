<?php

namespace Jp\SindicatoTrainees\domain\models;

use DateTimeInterface;
use JsonSerializable;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class Dependente extends Model implements JsonSerializable
{
	private ?int $id;
	private string $sNome;
	private ?DateTimeInterface $oDataNascimento;
	private string $sGrauParentesco;
	private int $flo_id;

	public function __construct(?int $id, string $sNome, ?DateTimeInterface $oDataNascimento, string $sGrauParentesco, int $flo_id)
	{
		$this->id = $id;
		$this->sNome = $sNome;
		$this->oDataNascimento = $oDataNascimento;
		$this->sGrauParentesco = $sGrauParentesco;
		$this->flo_id = $flo_id;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id(),
			'nome' => $this->nome(),
			'dataNascimento' => $this->dataNascimento(),
			'grauParentesco' => $this->grauParentesco(),
			'flo_id' => $this->flo_id()
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

	public function dataNascimento(): DateTimeInterface
	{
		return $this->oDataNascimento;
	}

	public function grauParentesco(): string
	{
		return $this->sGrauParentesco;
	}

	public function flo_id(): ?int
	{
		return $this->flo_id;
	}
}