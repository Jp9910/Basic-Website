<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Empresa;

interface EmpresaDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Empresa;
	public function insert(Empresa $empresa): bool;
	public function update(Empresa $empresa): bool;
	public function delete(int $id): bool;
}