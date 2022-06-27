<?php

namespace Jp\SindicatoTrainees\domain\dao;

use Jp\SindicatoTrainees\domain\Models\Usuario;

interface UsuarioDao
{
    public function getAll(): array;
    public function findById(): Usuario;
    public function search(...$params): Usuario;
    public function insert(): bool;
    public function update(): bool;
    public function delete(): bool;
}