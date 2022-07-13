<?php

namespace Jp\SindicatoTrainees\domain\models;

/**
 * @version 1.0.0 Versionamento inicial da classe
 */
abstract class Model
{
	private ?int $id;

	public function id(): ?int
	{
		return $this->id;
	}
}