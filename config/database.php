<?php

namespace App\Core;

use PDO;
use Dotenv\Dotenv;

class Database
{
    private static ?\PDO $conn = null;

    public static function connection(): \PDO
    {
        if (self::$conn === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
            
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
          ]);
            } catch (\PDOException $e) {
                die("[!] Connection Failed\n" . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
