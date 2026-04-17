<?php
    session_start();
    require_once '../../src/clases/BD.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = BD::getInstancia();

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && hash_equals($usuario['password'], md5($password))) {

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['nombre'] = $usuario['nombre'];

        header("Location: ../../views/dashboard.php");
        exit;

    } else {
        echo "Email o contraseña incorrectos";
    }
