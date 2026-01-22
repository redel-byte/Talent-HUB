<?php
namespace App\Models;

// use App\Core\Database;
use App\Middleware\Hashpassword;
use App\Middleware\Validator;
use App\Models\User;

class UserModel extends User
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
        $stmt = $this->pdo->prepare("SELECT u.*, r.name as role FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.email = :email;");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT u.*, r.name as role FROM users u LEFT JOIN roles r ON u.role_id = r.id WHERE u.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
    public function create($email, $password, $phone_number, $role = 'candidate', $firstName = '', $lastName = '')
    {
      // Validate email and ensure it doesn't already exist
      if (!Validator::validateEmail($email) || $this->findByEmail($email)) {
        return false;
      }

      // Get role_id from role name
      $roleStmt = $this->pdo->prepare("SELECT id FROM roles WHERE name = :role");
      $roleStmt->execute(['role' => $role]);
      $roleData = $roleStmt->fetch(\PDO::FETCH_ASSOC);
      
      if (!$roleData) {
        return false; // Role not found
      }
      
      $roleId = $roleData['id'];
      $fullname = trim($firstName . ' ' . $lastName);

      $stm = $this->pdo->prepare("INSERT INTO users (email, fullname, password, role_id, created_at, phone_number) VALUES (:email, :fullname, :password, :role_id, NOW(), :phone_number)"); 
      return $stm->execute([
        'email' => $email,
        'fullname' => $fullname,
        'password' => (new Hashpassword($password))->getHashedPassword(),
        'phone_number' =>$phone_number,
        'role_id' => $roleId
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

