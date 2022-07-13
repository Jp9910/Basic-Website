<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Model;

interface DaoInterface
{
	public function getAll(?int $quantidade): array;
	public function findById(int $id): Model;
	public function insert(Model $model): bool;
	public function update(Model $model): bool;
	public function delete(int $id): bool;
}