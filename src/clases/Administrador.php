<?php

require_once('BD.php');
require_once 'Usuario.php';

class Administrador extends Usuario {

    public function __construct(int $id, string $nombre, string $email, string $password, string $rol) {
        parent::__construct($id, $nombre, $email, $password, $rol);
    }

    public function crear (Usuario $usuario) {
        $conexion = BD::getInstancia();

        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':nombre' => $usuario->getNombre(),
                ':email' => $usuario->getEmail(),
                ':password' => md5($usuario->getPassword()),
                ':rol' => $usuario->getRol()
        ]);
    }

    public function actualizar (Usuario $usuario) {
        $conexion = BD::getInstancia();
            $sql = "UPDATE usuarios SET 
                nombre = :nombre, 
                email = :email, 
                rol = :rol 
                WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':nombre' => $usuario->getNombre(),
                ':email' => $usuario->getEmail(),
                ':rol' => $usuario->getRol(),
                ':id' => (int) $usuario->getId()
            ]);
    }

    public function eliminar ($id) {
        $conexion = BD::getInstancia();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
    }

    //metodo que no se cuando se usa
    public function gestionarUsuarios() {
        return "El administrador puede gestionar usuarios";
    }
}