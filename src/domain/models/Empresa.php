<?php

namespace Jp\SindicatoTrainees\domain\models;

use JsonSerializable;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class Empresa implements JsonSerializable
{
	private ?int $id;
	private string $sNome;

	public function __construct(?int $id, string $sNome)
	{
		$this->id = $id;
		$this->sNome = $sNome;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id(),
			'nome' => $this->sNome()
		];
	}

	public function id(): ?int
	{
		return $this->id;
	}

	public function sNome(): string
	{
		return $this->sNome;
	}
}