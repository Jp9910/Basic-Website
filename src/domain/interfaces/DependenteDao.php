<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Dependente;

interface DependenteDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Dependente;
	public function insert(Dependente $Dependente): bool;
	public function update(Dependente $Dependente): bool;
	public function delete(int $id): bool;
}