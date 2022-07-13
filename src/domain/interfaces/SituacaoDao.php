<?php

namespace Jp\SindicatoTrainees\domain\interfaces;

use Jp\SindicatoTrainees\domain\models\Situacao;

interface SituacaoDao
{
	public function getAll(): array;
	public function getPagina(?int $pagina, ?int $quantidade): array;
	public function findById(int $id): Situacao;
	public function insert(Situacao $situacao): bool;
	public function update(Situacao $situacao): bool;
	public function delete(int $id): bool;
}