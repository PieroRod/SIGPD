<?php

class Jugador {
    private string $nombre;
    private string $contrasena;
    private int $partidasJugadas;
    private int $totalPuntos;

    public function __construct($nombre = '', $contrasena = '', $partidasJugadas = 0, $totalPuntos = 0) {
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->partidasJugadas = $partidasJugadas;
        $this->totalPuntos = $totalPuntos;
    }

    public function getNombre(): string { return $this->nombre; }
    public function getContrasena(): string { return $this->contrasena; }
    public function getPartidasJugadas(): int { return $this->partidasJugadas; }
    public function getTotalPuntos(): int { return $this->totalPuntos; }

    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setContrasena(string $contrasena): void { $this->contrasena = $contrasena; }
}
