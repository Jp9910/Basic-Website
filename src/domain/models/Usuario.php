<?php

namespace Jp\SindicatoTrainees\domain\models;

use JsonSerializable;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
class Usuario implements JsonSerializable
{
	private ?int $id;
	private string $sNome;
	private string $sLogin;
	private string $sSenha;

	public function __construct(?int $id, string $sNome, string $sLogin, string $sSenha)
	{
		$this->id = $id;
		$this->sNome = $sNome;
		$this->sLogin = $sLogin;
		$this->sSenha = $sSenha;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id(),
			'nome' => $this->sNome(),
			'login' => $this->sLogin()
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

	public function sLogin(): string
	{
		return $this->sLogin;
	}

	public function sSenha(): string
	{
		return $this->sSenha;
	}

	public function defineId(int $id): void
	{
		if (!is_null($this->id)) {
			throw new \DomainException('Você só pode definir o ID uma vez');
		}
		$this->id = $id;
	}
}