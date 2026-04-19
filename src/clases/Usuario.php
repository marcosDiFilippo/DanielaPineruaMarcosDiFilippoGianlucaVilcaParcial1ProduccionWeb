<?php

require_once '../../exceptions/UsuarioException.php';

class Usuario {
    private ?int $id;
    private string $nombre;
    private string $email;
    private string $password;
    private string $rol;

    public function __construct(?int $id, string $nombre, string $email, string $password = '', string $rol = 'usuario') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setNombre(string $nombre): void {
        if (!empty($nombre)) {
            $this->nombre = $nombre;
        } else {
            throw new UsuarioException("Nombre inválido");
        }
    }

    public function setEmail(string $email): void {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new UsuarioException("Email inválido");
        }
    }

    public function setPassword(string $password): void {
    if (empty($password) || strlen($password) >= 6) {
        $this->password = $password;
    } else {
        throw new UsuarioException("Contraseña inválida (mínimo 6 caracteres)");
    }
}

   public function setRol(string $rol): void {
    $this->rol = $rol;
}

}