<?php

require_once __DIR__ . '/../app/controllers/AuthController.php';

$authController = new AuthController();

session_start();

$ruta = $_GET['ruta'] ?? 'inicio';

switch ($ruta){
    case 'inicio':
        require_once __DIR__ . '/../app/views/inicio.view.html';
        break;

    case 'config':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cantidad = $_POST['cantidad'] ?? 2;
            $_SESSION['cantidad'] = $cantidad; // guardamos en session
            header("Location: index.php?ruta=login");
            exit;
        }
        require_once __DIR__ . '/../app/views/login.view.php';
        break;

    case 'login':
            $authController->login();
        break;

    case 'tablero':
            $authController->IniciarPartida();
        break;

    case 'logoutL':
            $authController->logoutL();
        break;

    case 'logout':
            $authController->logout();
        break;

    case 'registro':
            require_once __DIR__ . '/../app/views/registro.view.php';
        break;

    case 'signin':
            $authController->signin();
            break;

    case 'finpartida':
            $authController -> finpartida();
        break;

    case 'resultados':
            require_once __DIR__ . '/../app/views/resultados.view.php';
        break;

    case 'usuario':
            require_once __DIR__ . '/../app/views/usuario.view.php';
        break;

    case 'loginL':
            $authController -> loginL();
        break;

    case 'ajustes':
            $authController -> ajustesUsuario();
        break;
    
    case 'cambiarContrasena':
            $authController -> cambiarContrasena();
        break;

    default:
        echo "<h1>Error 404</h1>";
        break;

}

