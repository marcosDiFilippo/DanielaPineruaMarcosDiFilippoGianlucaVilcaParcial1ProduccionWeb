<?php

class Vehiculo {
    private string $marca;
    private string $modelo;
    private int $anio;
    private float $precio;
    private string $tipo;
    private string $color;
    private string $imagen;
    private int $usuario_id;
    private string $transmision;

    public function __construct(
        string $marca,
        string $modelo,
        int $anio,
        float $precio,
        string $tipo,
        string $color,
        string $imagen,
        int $usuario_id,
        string $transmision
    ) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->color = $color;
        $this->imagen = $imagen;
        $this->usuario_id = $usuario_id;
        $this->transmision = $transmision;
    }
}
