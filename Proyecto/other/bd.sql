CREATE DATABASE IF NOT EXISTS flowerdraftsystem;
USE flowerdraftsystem;

CREATE TABLE IF NOT EXISTS jugador (
    partidas_jugadas int,
    nombre varchar(50),
    contrasena varchar(50),
    partidas_ganadas int,
    total_puntos int,
    PRIMARY KEY(nombre)
);

INSERT INTO jugador (nombre, contrasena, partidas_jugadas, partidas_ganadas, total_puntos) VALUES
('admin', '1234', 0, 0, 0);

CREATE TABLE IF NOT EXISTS partida (
    estado varchar(10) CHECK (estado IN ('activa', 'terminada')),
    creacion datetime,
    id int AUTO_INCREMENT,
    numero_jugadores int,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS recinto (
    nombre varchar(50),
    puntos_por_ficha int,
    PRIMARY KEY(nombre)
);

CREATE TABLE IF NOT EXISTS ficha (
    nombre varchar(50),
    tipo varchar(5) CHECK (tipo IN ('comun', 'roja')),
    PRIMARY KEY(nombre)
);

CREATE TABLE recinto_ficha (
    RecintoNombre varchar(50),
    FichaNombre varchar(50),
    CantidadFichas int,
    PRIMARY KEY (RecintoNombre, FichaNombre),
    FOREIGN KEY (RecintoNombre) REFERENCES recinto(nombre),
    FOREIGN KEY (FichaNombre) REFERENCES ficha(nombre)
);

CREATE TABLE participa (
    JugadorNombre VARCHAR(100),
    IdPartida INT,
    PRIMARY KEY (JugadorNombre, IdPartida),
    FOREIGN KEY (JugadorNombre) REFERENCES jugador(nombre),
    FOREIGN KEY (IdPartida) REFERENCES partida(id)
);
