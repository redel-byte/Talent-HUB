<?php

namespace Youcode\WorkshopMvc\Models;

use Youcode\WorkshopMvc\Core\Database;
use Youcode\WorkshopMvc\Core\Hashpassword;
use Youcode\WorkshopMvc\Core\Validator;

class User
{
    private ?int $id = null;
    private string $email;
    private string $password;  
    protected \PDO $pdo;
    public function __construct($pdo)
    {
      $this->pdo = $pdo;
    }
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
    public function create($email, $password, $role = 'candidate', $firstName = '', $lastName = '')
    {
      // Validate email and ensure it doesn't already exist
      if (!Validator::validateEmail($email) || $this->findByEmail($email)) {
        return false;
      }

      $stm = $this->pdo->prepare("INSERT INTO users (email, first_name, last_name, password, role, created_at) VALUES (:email, :first_name, :last_name, :password, :role, NOW())"); 
      return $stm->execute([
        'email' => $email,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'password' => (new Hashpassword($password))->getHashedPassword(),
        'role' => $role
      ]);
    }
       
    public function verify(string $email, string $password): bool
    {
      $user = $this->findByEmail($email);

      if (!$user) {
         return false;
      }

      return password_verify($password, $user['password']);
    }
}

