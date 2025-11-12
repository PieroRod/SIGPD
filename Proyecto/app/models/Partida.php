<?php

class Partida {
    private string $estado;
    private string $creacion;
    private int $numeroJugadores;

    public function __construct($estado = 'activa', $creacion = '', $numeroJugadores = 0) {
        $this->estado = $estado;
        $this->creacion = $creacion ?: date('Y-m-d H:i:s');
        $this->numeroJugadores = $numeroJugadores;
    }

    public function getEstado(): string { return $this->estado; }
    public function getCreacion(): string { return $this->creacion; }
    public function getNumeroJugadores(): int { return $this->numeroJugadores; }

    public function setEstado(string $estado): void { $this->estado = $estado; }
    public function setNumeroJugadores(int $num): void { $this->numeroJugadores = $num; }
}
