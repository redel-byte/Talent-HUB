<?php


namespace App\repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo) {}
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
}
