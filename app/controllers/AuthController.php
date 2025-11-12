<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Partida.php';
require_once __DIR__ . '/../models/Partidas.php';
require_once __DIR__ . '/../models/Jugador.php';

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
                        $jugador = Usuario::buscarPorNombre($nombre);

                        // si se encuentra y la contraseña es correcta
                        if ($jugador && $contrasena === $jugador->getContrasena()) {
                            // guarda en sesión que este jugador inició sesión
                            $_SESSION['jugadores'][$i] = $jugador->getNombre();
                            break;
                        } else {
                            if (!$jugador){
                                $error = "Usuario invalido para jugador $i";
                            }else{
                                $error = "Contraseña incorrecta para jugador $i";
                            }
                        }
                    }
                }
            }
        }

        require_once __DIR__ . '/../views/login.view.php';
    }

    public function loginL(){
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST["usuario"] ?? '';
            $contrasena = $_POST["contrasena"] ?? '';


            if (empty($nombre) || empty($contrasena)) { // verifica que se llenaron todos los campos
                $error = "Por favor, complete todos los campos";
                require_once __DIR__ . '/../views/usuario.view.php';
                return;
            }

            if ($nombre && $contrasena) { // se busca el usuario en la base de datos
                $jugador = Usuario::buscarPorNombre($nombre);

                // si se encuentra y la contraseña es correcta
                if ($jugador && $contrasena === $jugador->getContrasena()) {
                    // guarda en sesión que este jugador inició sesión
                    $_SESSION['jugador'] = $jugador->getNombre();
                    header("Location: index.php?ruta=ajustes");
                            
                } else {
                    if (!$jugador){
                        $error = "Usuario invalido";
                        require_once __DIR__ . '/../views/usuario.view.php';
                    }else{
                        $error = "Contraseña incorrecta";
                        require_once __DIR__ . '/../views/usuario.view.php';
                    }
                }
             }
        }
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
            require_once __DIR__ . '/../views/tableros.view.php';
            $partida = new Partida('activa', date('Y-m-d H:i:s'), $_SESSION['cantidad']);
            $_SESSION['idpartida'] = Partidas::crearPartida($partida);
            $_SESSION['puntosLocal'] = [];
            $_SESSION['puntosGlobal'] = [];
            $_SESSION['termino'] = false;
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
            $cantidad = strlen($_POST['usuario']);

            // si no se llenaron todos los campos, error
            if (empty($nombre) || empty($contrasena)) {
                $error = "Por favor, complete todos los campos";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }elseif ($cantidad < 4){ // el nombre debe tener al menos 4 caracteres, error
                $error = "El nombre de usuario debe tener al menos 4 caracteres.";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }elseif ($cantidad > 20){ // el nombre no puede tener más de 20 caracteres, error
                $error = "El nombre de usuario no puede tener más de 20 caracteres.";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }elseif (Usuario::buscarPorNombre($nombre)) { // si el nombre ya existe, error
                $error = "El nombre de usuario ya existe. Por favor, elija otro.";
                require_once __DIR__ . '/../views/registro.view.php';
                return;
            }
            // si todo está bien, crear el usuario
            $jugador = new Jugador($nombre, $contrasena, 0, 0);
            Usuario::crear($jugador);
            header("Location: index.php?ruta=logout");
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

    public function finpartida(){

        if (!isset($_SESSION['idpartida']) || !isset($_SESSION['termino'])) {
            // si por alguna razón no se setearon (por ejemplo, invitado sin partida activa)
            $_SESSION['idpartida'] = $_SESSION['idpartida'] ?? null;
            $_SESSION['termino'] = $_SESSION['termino'] ?? false;
        }

        if ($_SESSION['termino'] === true){
            require_once __DIR__ . '/../views/resultados.view.php';
            return;
        }

        $usuario = Usuario::buscarPorNombre($_SESSION['jugadores'][1]);
        if ($usuario){
            (new Usuario())->guardarDatosJugador($_SESSION['jugadores'][1], $_POST['puntos']);
            (new Usuario())->puntosJugador($_SESSION['jugadores'][1]);
        }

        (new Partidas())->guardarPartida($_SESSION['idpartida'], $_POST['puntos'], $_SESSION['jugadores'][1]);

        $_SESSION['puntosGlobal'] = (new Partidas())->puntosGlobales(); // top 5 mejores jugadores globales
        $_SESSION['puntosLocal'] = (new Partidas())->puntosLocales($_SESSION['idpartida']); // top 5 mejores jugadores de esta partida
        $_SESSION['termino'] = true;

        require_once __DIR__ . '/../views/resultados.view.php';
    }

    public function ajustesUsuario(){
        $_SESSION['puntos'] = (new Usuario())->puntosJugador($_SESSION['jugador']);
        $_SESSION['partidas'] = (new Usuario())->partidasJugadas($_SESSION['jugador']);
        $_SESSION['topPartidas'] = (new Usuario())->obtenerTopPartidas($_SESSION['jugador']);
        require_once __DIR__ . '/../views/ajustes.view.php';
    }

    public function cambiarContrasena(){
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contra1 = $_POST['nuevacontra'];
            $contra2 = $_POST['confcontra'];

            if (empty($contra1) || empty($contra2)){ // verifica que se hayan llenado ambos campos
                $error = "Complete ambos campos";
                require_once __DIR__ . '/../views/ajustes.view.php';
                return;
            }

            if ($contra1 != $contra2){ // si no son iguales, error
                $error = "Las contraseñas no coinciden";
                require_once __DIR__ . '/../views/ajustes.view.php';
                return;
            }

            (new Usuario())->cambiarContrasena($_SESSION['jugador'], $contra1);
            $error = "Contraseña actualizada con exito";
            require_once __DIR__ . '/../views/ajustes.view.php';

        }
    }
}