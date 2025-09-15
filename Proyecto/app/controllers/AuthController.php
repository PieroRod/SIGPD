<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuario;

    
    public function login() {
        $error = '';
        $cantidad = $_SESSION['cantidad'] ?? 2;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // se repite por la cantidad de jugadores
            for ($i = 1; $i <= $cantidad; $i++) {
                $accion = $_POST['accion'][$i] ?? null;

                if ($accion === 'invitado') {
                    // si es un invitado, se asigna un nombre de invitado
                    $_SESSION['jugadores'][$i] = "Invitado $i";
                    continue;

                }elseif ($accion === 'login') {
                    // si no es invitado, se intenta iniciar sesión con el nombre y contraseña proporcionados
                    $nombre = $_POST["usuario$i"] ?? '';
                    $contrasena = $_POST["contrasena$i"] ?? '';


                    if (empty($nombre) || empty($contrasena)) {
                        $error = "Por favor, complete todos los campos";
                        continue;
                    }

                    // si el jugador ya inició sesión, error
                    for ($x = 1; $x <= $cantidad; $x++){
                        if (!empty($_SESSION['jugadores'][$x]) && $_SESSION['jugadores'][$x] === $nombre) {
                            $jugador = $_SESSION['jugadores'][$x];
                            $error = "El jugador $jugador ya ha iniciado sesión.";
                            continue 2;
                        }
                    }

                    // se busca el usuario en la base de datos
                    if ($nombre && $contrasena) {
                        $usuario = (new Usuario())->buscarPorNombre($nombre);

                        // si se encuentra y la contraseña es correcta
                        if ($usuario && $contrasena === $usuario['contrasena']) {
                            // guarda en sesión que este jugador inició sesión
                            $_SESSION['jugadores'][$i] = $usuario['nombre'];
                            break;
                        } else {
                            $error = "Usuario o contraseña incorrectos para jugador $i";
                        }
                    }
                }
            }
        }

        require_once __DIR__ . '/../views/login.view.php';
    }

    public function IniciarPartida() {
        // verificar que todas las fichas estén llenas
        $error = '';
        $logeados = true;
        $cantidad = $_SESSION['cantidad'] ?? 2;
        for ($i = 1; $i <= $cantidad; $i++) {
            if (empty($_SESSION['jugadores'][$i])) {
                $logeados = false;
            }
        }

        if ($logeados) {
            // si todas las fichas están llenas, iniciar partida
            require_once __DIR__ . '/../views/tableros.view.html';
            exit;
        }else{
            // si alguna ficha está vacía, redirigir a config con error
            $error = "Por favor, complete todos los jugadores antes de iniciar la partida.";
            require_once __DIR__ . '/../views/login.view.php';
            exit;   
        }
    }

    public function signin(){
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];

            // si no se llenaron todos los campos, error
            if (empty($nombre) || empty($contrasena)) {
                $error = "Por favor, complete todos los campos";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }elseif ((new Usuario())->buscarPorNombre($nombre)) { // si el nombre ya existe, error
                $error = "El nombre de usuario ya existe. Por favor, elija otro.";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }
            // si todo está bien, crear el usuario
            (new Usuario())->crear($nombre, $contrasena);
            require_once __DIR__ . '/../views/inicio.view.html';
        }
    }

    public function logout() {
        // Cerrar sesión
        session_unset();
        session_destroy();
        header("Location: index.php?ruta=inicio");
    }

    public function logoutL() {
        // Cerrar sesión para solo un jugador
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jugador = $_POST['jugador'] ?? null;

            if ($jugador !== null && isset($_SESSION['jugadores'][$jugador])) {
                unset($_SESSION['jugadores'][$jugador]);
            }
        }

        header("Location: index.php?ruta=config");
        exit;
    }
}