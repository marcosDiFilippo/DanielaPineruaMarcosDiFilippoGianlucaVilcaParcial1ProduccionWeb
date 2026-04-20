<?php

require_once 'Usuario.php';

class Empleado extends Usuario {

    public function __construct(int $id, string $nombre, string $email, string $password, string $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }

    public function obtenerVehiculosSubidos () {
        $conexion = BD::getInstancia();

        $sql = "SELECT * FROM vehiculos WHERE usuario_id = :usuario_id";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ":usuario_id" => $this->getId()
        ]);

        $vehiculosSubidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $vehiculosSubidos;
    }
}