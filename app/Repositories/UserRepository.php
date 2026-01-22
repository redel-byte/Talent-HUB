<?php


namespace App\Repositories;

use PDO;

class UserRepository extends BaseRepository
{
    protected string $table = 'users';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.id, u.fullname, u.email, u.role_id, r.name AS role
         FROM users u
         LEFT JOIN roles r ON u.role_id = r.id
         WHERE u.id = :id
         LIMIT 1"
        );

        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && empty($user['role']) && !empty($user['role_id'])) {
            // Fallback: map role_id to name if join failed
            $roleMap = [1 => 'admin', 2 => 'recruiter', 3 => 'candidate'];
            $user['role'] = $roleMap[$user['role_id']] ?? 'candidate';
        }
        return $user ?: null;
    }


    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.id, u.email, u.password, u.role_id, r.name AS role
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.id
    WHERE u.email = :email
    LIMIT 1
    "
        );
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && empty($user['role']) && !empty($user['role_id'])) {
            // Fallback: map role_id to name if join failed
            $roleMap = [1 => 'admin', 2 => 'recruiter', 3 => 'candidate'];
            $user['role'] = $roleMap[$user['role_id']] ?? 'candidate';
        }
        return $user ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (fullname, email, password, phone_number, role_id, created_at)
             VALUES (:fullname, :email, :password, :phone, :role_id, NOW())"
        );
        return $stmt->execute($data);
    }

    public function createWithRole(string $email, string $password, string $phoneNumber, string $role = 'candidate', string $firstName = '', string $lastName = ''): bool
    {
        $roleStmt = $this->pdo->prepare("SELECT id FROM roles WHERE name = :role");
        $roleStmt->execute(['role' => $role]);
        $roleData = $roleStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$roleData) {
            return false;
        }
        
        $roleId = $roleData['id'];
        $fullname = trim($firstName . ' ' . $lastName);
        
        $stmt = $this->pdo->prepare("INSERT INTO users (email, fullname, password, role_id, created_at, phone_number) VALUES (:email, :fullname, :password, :role_id, NOW(), :phone_number)");
        return $stmt->execute([
            'email' => $email,
            'fullname' => $fullname,
            'password' => $password,
            'phone_number' => $phoneNumber,
            'role_id' => $roleId
        ]);
    }

    public function verifyPassword(string $email, string $password): bool
    {
        $user = $this->findByEmail($email);
        return $user && password_verify($password, $user['password']);
    }
}
