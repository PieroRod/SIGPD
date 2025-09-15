<?php

define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'flowerdraftsystem');

class Database{
    private static ?Database $instancia = null; // Dónde se guarda la única instancia
    private PDO $conexion; // Objeto de conexión con la BD

    // Constructor privado para evitar que se creen múltiples instancias de la clase
    private function __construct() {
        $host = 'localhost';
        $db = 'flowerdraftsystem';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->conexion = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public static function getInstancia(): Database {
        if (self::$instancia === null) {
            self::$instancia = new Database(); // $this->instancia = new Database(); error
        }
        return self::$instancia;
    }

    public function getConexion(): PDO{
        return $this->conexion;
    }
}