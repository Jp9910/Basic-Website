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
	private int $isAdmin;

	public function __construct(?int $id, string $sNome, string $sLogin, string $sSenha, int $isAdmin)
	{
		$this->id = $id;
		$this->sNome = $sNome;
		$this->sLogin = $sLogin;
		$this->sSenha = $sSenha;
		$this->isAdmin = $isAdmin;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'id' => $this->id(),
			'nome' => $this->sNome(),
			'login' => $this->sLogin(),
			'isAdmin' => $this->isAdmin()
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

	public function isAdmin(): int
	{
		return $this->isAdmin;
	}

	public function defineId(int $id): void
	{
		if (!is_null($this->id)) {
			throw new \DomainException('Você só pode definir o ID uma vez');
		}
		$this->id = $id;
	}
}