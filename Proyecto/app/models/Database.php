<?php

class Database {
    private static ?Database $instancia = null;
    private PDO $conexion;

    private function __construct() {
        // Usa las variables de entorno definidas en docker-compose
        $host = getenv('DB_HOST') ?: 'localhost';
        $db = getenv('DB_NAME') ?: 'flowerdraftsystem';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $max_retries = 2;
        $attempt = 0;

        while ($attempt < $max_retries) {
            try {
                $this->conexion = new PDO($dsn, $user, $pass);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                break; // conexión exitosa
            } catch (PDOException $e) {
                if ($attempt == $max_retries - 1) {
                    throw new PDOException($e->getMessage(), (int)$e->getCode());
                }
                $attempt++;
                sleep(2); // espera antes de reintentar
            }
        }
    }

    public static function getInstancia(): Database {
        if (self::$instancia === null) {
            self::$instancia = new Database();
        }
        return self::$instancia;
    }

    public function getConexion(): PDO {
        return $this->conexion;
    }
}

// define('SERVERNAME', 'localhost');
// define('USERNAME', 'root');
// define('PASSWORD', '');
// define('DBNAME', 'flowerdraftsystem');

// class Database{
//     private static ?Database $instancia = null; // Dónde se guarda la única instancia
//     private PDO $conexion; // Objeto de conexión con la BD

//     // Constructor privado para evitar que se creen múltiples instancias de la clase
//     private function __construct() {
//         $host = 'db';
//         $db = 'flowerdraftsystem';
//         $user = 'floweruser';
//         $pass = 'flowerpass';
//         $charset = 'utf8mb4';

//         $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//         $max_retries = 2;
//         $attempt = 0;
//         while ($attempt < $max_retries) {
//             try {
//                 $this->conexion = new PDO($dsn, $user, $pass);
//                 break; // conexión exitosa
//             } catch (PDOException $e) {
//                 if ($attempt == $max_retries - 1) {
//                     throw new PDOException($e->getMessage(), (int)$e->getCode());
//                 }
//                 $attempt++;
//                 sleep(2); // espera 2 segundos y reintenta
//             }
//         }
//     }

//     public static function getInstancia(): Database {
//         if (self::$instancia === null) {
//             self::$instancia = new Database(); // $this->instancia = new Database(); error
//         }
//         return self::$instancia;
//     }

//     public function getConexion(): PDO{
//         return $this->conexion;
//     }
// }

// define('SERVERNAME', getenv('DB_HOST'));
// define('USERNAME', getenv('DB_USER'));
// define('PASSWORD', getenv('DB_PASS'));
// define('DBNAME', getenv('DB_NAME'));



// class Database{
//     private static ?Database $instancia = null; // Dónde se guarda la única instancia
//     private PDO $conexion; // Objeto de conexión con la BD

//     // Constructor privado para evitar que se creen múltiples instancias de la clase
//     private function __construct() {
//         $host = getenv('DB_HOST');
//         $db = getenv('DB_NAME');
//         $user = getenv('DB_USER');
//         $pass = getenv('DB_PASS');
//         $charset = ('utf8mb4');

//         $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//         $max_retries = 10;
//         $attempt = 0;
//         while ($attempt < $max_retries) {
//             try {
//                 $this->conexion = new PDO($dsn, $user, $pass);
//                 break; // conexión exitosa
//             } catch (PDOException $e) {
//                 if ($attempt == $max_retries - 1) {
//                     throw new PDOException($e->getMessage(), (int)$e->getCode());
//                 }
//                 $attempt++;
//                 sleep(2); // espera 2 segundos y reintenta
//             }
//         }
//     }

//     public static function getInstancia(): Database {
//         if (self::$instancia === null) {
//             self::$instancia = new Database(); // $this->instancia = new Database(); error
//         }
//         return self::$instancia;
//     }

//     public function getConexion(): PDO{
//         return $this->conexion;
//     }
// }