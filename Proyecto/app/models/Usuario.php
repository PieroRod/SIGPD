<?php

require_once '../app/models/Database.php';

class Usuario {
    private $pdo;

    public function crear ($nombre, $contrasena) {
        // Lógica para crear un usuario
        
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "INSERT INTO jugador (nombre, contrasena) VALUES (:nombre, :contrasena)";

        $st = $this->pdo->prepare($sentencia);
        $st->bindParam(':nombre', $nombre);
        $st->bindParam(':contrasena', $contrasena);

        return $st->execute();
    }

    public function buscarPorNombre($nombre) {
        // Lógica para buscar un usuario por su nombre
        $this->pdo = Database::getInstancia()->getConexion();

        $sentencia = "SELECT * FROM jugador WHERE nombre = ?";
        $stmt = $this->pdo->prepare($sentencia);
        $stmt->execute([$nombre]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
