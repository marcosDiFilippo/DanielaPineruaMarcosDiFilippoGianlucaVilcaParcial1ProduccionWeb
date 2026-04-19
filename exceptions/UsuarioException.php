<?php

class UsuarioException extends Exception
{
    public function __construct(string $mensaje = 'Ha ocurrido un error al gestionar los usuarios')
    {
        parent::__construct($mensaje);
    }
}