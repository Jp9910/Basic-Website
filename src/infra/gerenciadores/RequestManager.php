<?php

namespace Jp\SindicatoTrainees\infra\gerenciadores;

class RequestManager {

    private static RequestManager $instance;

    //design pattern singleton usa o private para impedir a classe de ser instanciada livremente
    private function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance() : RequestManager
    {
        if(!isset(self::$instance)) //criar apenas se não houver (singleton)
            new RequestManager();

        return self::$instance;
    }

    public function getSessao(): array
    {
        return $_REQUEST;
    }

    public function setRequestVariable(string $key, mixed $value)
    {
        $_REQUEST[$key] = $value;
    }
}