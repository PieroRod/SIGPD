<?php

require_once '../app/models/Database.php';
require_once __DIR__ . '/Partida.php';

Class Partidas {
    private $pdo;

    public static function crearPartida(Partida $partida){
        $pdo = Database::getInstancia()->getConexion();

        $sentencia = "INSERT INTO partida (estado, creacion, numero_jugadores) VALUES ('activa', ?, ?)";
        $stmt = $pdo->prepare($sentencia);
        $stmt->execute([
            $partida->getCreacion(),
            $partida->getNumeroJugadores()
        ]);

        $id = $pdo->lastInsertId();

        $numero = $partida->getNumeroJugadores();
        for ($i = 1; $i <= $numero; $i++){
            $nombre = $_SESSION['jugadores'][$i];
            if (str_starts_with($nombre, 'Invitado')) continue; // salta invitados
            $sentencia = "INSERT INTO participa (JugadorNombre, IdPartida) VALUES (?, ?)";
            $stmt = $pdo->prepare($sentencia);
            $stmt->execute([$_SESSION['jugadores'][$i], $id]);
        }

        return $id;
    }

    public function guardarPartida($id, $puntos, $jugador){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "UPDATE partida SET estado = 'terminada' WHERE id = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$id]);

        $sentencia = "UPDATE participa SET  puntos_totales = ? WHERE IdPartida = ? AND JugadorNombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$puntos, $id, $jugador]);

    }

    public function puntosGlobales(){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT nombre, total_puntos FROM jugador 
                    ORDER BY total_puntos DESC LIMIT 5;";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function puntosLocales($id){
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT jugador.nombre, jugador.total_puntos FROM participa
                    JOIN jugador ON participa.JugadorNombre = jugador.nombre
                    WHERE participa.IdPartida = ? ORDER BY jugador.total_puntos DESC;";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}