<?php
class BaseDadesException extends Exception {
    public function __toString() {
        return $this->getMessage();
    }
}

function obtenerConexionPDO() {
    $host = 'mysql-server';
    $dbname = 'db_equip3';
    $user = 'root';
    $pass = 'secret';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        throw new BaseDadesException("Error al conectar a la base de datos: " . $e->getMessage());
    }
}
?>
