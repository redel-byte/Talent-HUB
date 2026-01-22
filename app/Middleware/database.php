<?php

namespace App\Middleware;
use PDO;
use Pdo\Mysql;
use Dotenv\Dotenv;
Dotenv::createImmutable(__DIR__ . '/../../')->load();

class Database
{
    private static ?\PDO $conn = null;

    public static function connection(): \PDO
    {
        if (self::$conn === null) {
            $dsn = "mysql:host={$_ENV['HOST']};port={$_ENV['PORT']};dbname={$_ENV['DBNAME']};charset=utf8mb4";
            
            try {
                self::$conn = new \PDO(
                    $dsn,
                    $_ENV['USER'],
                    $_ENV['PASSWORD'],
                    [
                      PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_ASSOC,
                      PDO::ATTR_EMULATE_PREPARES         => false,
                      Mysql::ATTR_SSL_CA                 => $_ENV['SSLCA'],
                      Mysql::ATTR_SSL_VERIFY_SERVER_CERT => false,
          ]);
            } catch (\PDOException $e) {
                die("[!] Connection Failed\n" . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
