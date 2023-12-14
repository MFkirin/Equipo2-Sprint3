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

            $this->connection = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

}