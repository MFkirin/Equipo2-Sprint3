<?php
declare(strict_types=1);
class Database
{
    private PDO $connection;

    public function __construct(array $config)
    {
        try {
            $host = $config['host'];
            $dbName = $config['dbname'];
            $username = $config['username'];
            $password = $config['password'];
            $port = $config['port'] ?? "3306";

            $dsn = "mysql:host=$host;port={3306};dbname=$dbName;charset=utf8";
            $this->connection = new PDO($dsn, $username, $password);


            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

}