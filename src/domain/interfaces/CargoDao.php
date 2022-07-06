<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Cargo;

interface CargoDao
{
	public function getAll(): array;
	public function findById(int $id): Cargo;
	public function insert(Cargo $empresa): bool;
	public function update(Cargo $empresa): bool;
	public function delete(int $id): bool;
}