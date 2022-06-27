<?php

namespace Jp\SindicatoTrainees\domain\Models;

use Jp\SindicatoTrainees\domain\controllers\UsuarioController;

class Usuario
{
    private ?int $id;
    private string $nome;
    private string $login;

    public function __construct(?int $id, string $nome, string $login)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->login = $login;
    }

    public function defineId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você só pode definir o ID uma vez');
        }
        $this->id = $id;
    }
}