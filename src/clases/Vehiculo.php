<?php

require_once __DIR__ . '/../../exceptions/VehiculoException.php';  

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
        $this->setMarca($marca);
        $this->setModelo($modelo);
        $this->setAnio($anio);
        $this->setPrecio($precio);
        $this->setTipo($tipo);
        $this->setColor($color);
        $this->setImagen($imagen);
        $this->setUsuarioId($usuario_id);
        $this->setTransmision($transmision);
    }

       public function getMarca() {
        return $this->marca;

    }

    public function getModelo() {
        return $this->modelo;

    }

    public function getAnio() {
         return $this->anio;

    }

    public function getPrecio() {
        return $this->precio;

    }

    public function getTipo() {
        return $this->tipo;

    }

    public function getColor() {
        return $this->color;

    }

    public function getImagen() {
         return $this->imagen;

    }

    public function getUsuarioId() {
         return $this->usuario_id;

    }

    public function getTransmision() {
        return $this->transmision;

    }
    public function setMarca(string $marca): void {
        if (!empty($marca)) {
            $this->marca = $marca;
        } else {
            throw new VehiculoException("Marca inválida");
        }
    }

    public function setModelo(string $modelo): void {
        if (!empty($modelo)) {
            $this->modelo = $modelo;
        } else {
            throw new VehiculoException("Modelo inválido");
        }
    }

    public function setAnio(int $anio): void {
        $anioActual = date("Y");
        if ($anio >= 1886 && $anio <= $anioActual) {
            $this->anio = $anio;
        } else {
            throw new VehiculoException("Año inválido");
        }
    }

    public function setPrecio(float $precio): void {
        if ($precio > 0) {
            $this->precio = $precio;
        } else {
            throw new VehiculoException("Precio inválido");
        }
    }

    public function setTipo(string $tipo): void {
        if (!empty($tipo)) {
            $this->tipo = $tipo;
        } else {
            throw new VehiculoException("Tipo inválido");
        }
    }

    public function setColor(string $color): void {
        if (!empty($color)) {
            $this->color = $color;
        } else {
            throw new VehiculoException("Color inválido");
        }
    }

    public function setImagen(string $imagen): void {
        if (!empty($imagen)) {
            $this->imagen = $imagen;
        } else {
            throw new VehiculoException("Imagen inválida");
        }
    }

    public function setUsuarioId(int $usuario_id): void {
        if ($usuario_id > 0) {
            $this->usuario_id = $usuario_id;
        } else {
            throw new VehiculoException("Usuario inválido");
        }
    }

    public function setTransmision(string $transmision): void {
        if (!empty($transmision)) {
            $this->transmision = $transmision;
        } else {
            throw new VehiculoException("Transmisión inválida");
        }
    }



    

    
}

