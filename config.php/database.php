<?php
class Database {
    public static function conectar() {
        $host = 'localhost';
        $dbname = 'ROMEL PONDRA';
        $user = 'root';
        $pass = '';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
        }
    }
}
?>
