<?php

namespace Jp\SindicatoTrainees\infra\gerenciadores;

class SessionManager {

	private static SessionManager $instance;

	//design pattern singleton usa o private para impedir a classe de ser instanciada livremente
	private function __construct()
	{
		self::$instance = $this;
	}

	public static function getInstance() : SessionManager
	{
		if(!isset(self::$instance)) //criar apenas se não houver (singleton)
			new SessionManager();

		return self::$instance;
	}

	public function getSessao(): array
	{
		return $_SESSION;
	}

	public function endSessao(): void
	{
		session_destroy();
		$_SESSION = array();
	}

	public function &startSessao(): array
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		return $_SESSION;
	}

	public function setSessionVariable(string $key, mixed $value)
	{
		$_SESSION[$key] = $value;
	}

	public function unsetSessionVariable(string $key)
	{
		unset($_SESSION[$key]);
	}
}