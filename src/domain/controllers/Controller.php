<?php

namespace Jp\SindicatoTrainees\domain\controllers;

abstract class Controller
{
    // @TODO: Implementar PSR-15 e PSR-7
    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     *
     */
    public function callAction($method, $parameters)
    {
        return $method(...array_values($parameters));
    }
}