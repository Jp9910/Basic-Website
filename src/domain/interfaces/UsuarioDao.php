<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Usuario;

interface UsuarioDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Usuario;
	public function search(...$params): Usuario;
	public function insert(Usuario $usuario): bool;
	public function update(Usuario $usuario): bool;
	public function delete(int $id): bool;
}