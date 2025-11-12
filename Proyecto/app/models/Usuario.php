<?php

require_once '../app/models/Database.php';
require_once __DIR__ . '/Jugador.php';

class Usuario {
    private $pdo;

    public static function crear(Jugador $jugador) {
        // Lógica para crear un usuario
        
        $pdo = Database::getInstancia()->getConexion();

        $sentencia = "INSERT INTO jugador (nombre, contrasena, partidas_jugadas, total_puntos) VALUES (?, ?, ?, ?)";

        $st = $pdo->prepare($sentencia);
        $st->execute([
            $jugador->getNombre(),
            $jugador->getContrasena(),
            $jugador->getPartidasJugadas(),
            $jugador->getTotalPuntos()
        ]);
    }

    public static function buscarPorNombre($nombre): ?Jugador {
        $pdo = Database::getInstancia()->getConexion();

        $stmt = $pdo->prepare("SELECT * FROM jugador WHERE nombre = ?");
        $stmt->execute([$nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Jugador(
                $data['nombre'],
                $data['contrasena'],
                $data['partidas_jugadas'],
                $data['total_puntos']
            );
        } else {
            return null;
        }
    }

    public function cambiarContrasena($nombre, $contrasena){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "UPDATE jugador SET contrasena = ? WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$contrasena, $nombre]);
    }
    
    public function obtenerTopPartidas($jugadorNombre) {
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT partida.id, partida.creacion, participa.puntos_totales FROM participa
                JOIN partida ON participa.IdPartida = partida.id
                WHERE participa.JugadorNombre = ? AND partida.estado = 'terminada' ORDER BY participa.puntos_totales DESC LIMIT 5;";

        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$jugadorNombre]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function puntosJugador($jugador){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT total_puntos FROM jugador WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$jugador]);
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_puntos'];
    }

    public function partidasJugadas($jugador){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT partidas_jugadas FROM jugador WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$jugador]);
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['partidas_jugadas'];
    }

    public function guardarDatosJugador($nombre, $puntos){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "UPDATE jugador SET partidas_jugadas = partidas_jugadas + 1, total_puntos = total_puntos + ? WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        return $stmt->execute([$puntos, $nombre]);
    }
}
