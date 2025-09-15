<?php

define("USER", "admin");
define("PASS", "1234");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Aquí puedes agregar la lógica para verificar el usuario y la contraseña
    // Por simplicidad, vamos a aceptar cualquier usuario y contraseña no vacíos
    if ($usuario === USER && $contrasena === PASS) {
        $_SESSION['usuario'] = $usuario;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
}

require_once __DIR__ . '/../views/login.view.php';



