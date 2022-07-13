<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Cargo;

interface CargoDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Cargo;
	public function insert(Cargo $cargo): bool;
	public function update(Cargo $cargo): bool;
	public function delete(int $id): bool;
}