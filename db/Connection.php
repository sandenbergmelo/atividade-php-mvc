<?php

include_once __DIR__ . '/../env.php';

dotEnv(__DIR__ . '/../.env');

class Connection
{
    private static $instance = null;
    private $connection = null;

    private $host;
    private $dbname;
    private $username;
    private $password;

    private function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASS');

        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados:\n{$e->getMessage()} \n");
        }
    }

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}

$conn = Connection::getConnection();
