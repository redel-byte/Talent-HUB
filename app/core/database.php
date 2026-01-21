<?php

namespace App\Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

// Charger le .env depuis la racine du projet
Dotenv::createImmutable(__DIR__ . '/../../')->load();

class Database
{
    private static ?PDO $conn = null;

    public static function connection(): PDO
    {
        if (self::$conn === null) {

            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
                $_ENV['HOST'],
                $_ENV['PORT'],
                $_ENV['DBNAME']
            );

            try {
                self::$conn = new PDO(
                    $dsn,
                    $_ENV['USER'],
                    $_ENV['PASSWORD'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,

                        // 🔐 SSL AIVEN
                        PDO::MYSQL_ATTR_SSL_CA                 => $_ENV['SSLCA'],
                        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    ]
                );
            } catch (PDOException $e) {
                die('[DB ERROR] ' . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
