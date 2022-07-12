<?php

namespace Jp\SindicatoTrainees\domain\models;

use JsonSerializable;

/**
 * @version 1.1.0 Função para verificar se a senha digitada está correta
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

	/*
	* @since 1.1.0 Função para verificar se a senha digitada está correta
	*
	* Verifica se a senha passada corresponde com a senha do usuário.
	* Retorna true caso seja, ou false caso não.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return bool
	*/
	public function verificarSenha(string $sSenhaDigitada): bool
	{
		return password_verify($sSenhaDigitada, $this->sSenha);
	}

	/*
	* @since 1.0.0 Definição do versionamento da função
	*
	* Define um ID para o objeto de usuário.
	*
	* @author Joao Paulo joaopaulo@moobitech.com.br
	*
	* @return void
	*/
	public function defineId(int $id): void
	{
		if (!is_null($this->id)) {
			throw new \DomainException('Você só pode definir o ID uma vez');
		}
		$this->id = $id;
	}
}