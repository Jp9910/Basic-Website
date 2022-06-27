<?php

namespace Jp\SindicatoTrainees\domain\dao;

use Jp\SindicatoTrainees\domain\models\Usuario;

interface UsuarioDao
{
    public function getAll(): array;
    public function findById(int $id): Usuario;
    public function search(...$params): Usuario;
    public function insert(Usuario $usuario): bool;
    public function update(Usuario $usuario): bool;
    public function delete(Usuario $usuario): bool;
}