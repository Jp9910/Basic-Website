<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Filiado;

interface FiliadoDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Filiado;
	public function findByEmpresa(int $id): array;
	public function findByCargo(int $id): array;
	public function findBySituacao(int $id): array;
	public function search(...$params): array;
	public function insert(Filiado $filiado): bool;
	public function update(Filiado $filiado): bool;
	public function delete(int $id): bool;
}