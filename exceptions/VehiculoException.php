<?php

class VehiculoException extends Exception
{
    public function __construct(string $mensaje = 'Ha ocurrido un error al gestionar los vehiculos')
    {
        parent::__construct($mensaje);
    }
}