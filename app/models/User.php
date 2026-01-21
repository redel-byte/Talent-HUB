<?php

namespace App\Models;

abstract class User
{
    private ?int $id = null;
    private string $email;
    private string $password;  
    protected \PDO $pdo;
    public function __construct($pdo)
    {
      $this->pdo = $pdo;
    }
    abstract public function findByEmail($email);
    abstract public function findById($id);
    abstract public function create($email, $password, $phond_number, $role = 'candidate', $firstName = '', $lastName = '');
    abstract public function verify(string $email, string $password);
}

