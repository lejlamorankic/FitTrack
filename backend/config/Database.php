
<?php

class Database
{
    public static function connect()
    {
        $config = require __DIR__ . '/config.php';

        $host = $config['host'];
        $port = $config['port'];
        $dbname = $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $username, $password);

            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $pdo;

        } catch (PDOException $e) {
            throw new RuntimeException(
                "Database connection failed.",
                0,
                $e
            );
        }
    }
}
