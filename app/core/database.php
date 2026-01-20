<?php

namespace Youcode\WorkshopMvc\Core;

$config = require_once "dbconfig.php";


class Database
{
  private static ?\PDO $conn = null;

  public static function connection():\PDO{
  global $config;
    if(self::$conn === null)
    {
      $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
      try{
      self::$conn = new \PDO($dsn,$config['user'],$config['password'],[
      \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES=>false,
      \PDO::ATTR_PERSISTENT=>true,
        ]);
      }catch(\PDOException $e){
      die("[!] Connection Failed\n".$e->getMessage());
      }
    }
    return self::$conn;
  }
}
