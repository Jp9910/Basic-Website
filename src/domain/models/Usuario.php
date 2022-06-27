<?php

namespace Jp\SindicatoTrainees\domain\models;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

class Usuario
{
    private ?int $id;
    private string $nome;
    private string $login;
    private string $senha;

    public function __construct(?int $id, string $nome, string $login, string $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function login(): string
    {
        return $this->login;
    }

    public function senha(): string
    {
        return $this->senha;
    }

    public function defineId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você só pode definir o ID uma vez');
        }
        $this->id = $id;
    }
}