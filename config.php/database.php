<?php
class Database {
    public static function conectar() {
        $host = "w29ifufy55ljjmzq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $usuario = "htvv7guq3cc1i2yi";
        $password = "b79bapb51asa0mme";
        $nombre_bd = "k9ek3c3nz5ipfihw";

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
