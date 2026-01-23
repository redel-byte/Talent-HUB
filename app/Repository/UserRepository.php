<?php


namespace App\repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo) {}
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, fullname, email, role
         FROM users
         WHERE id = :id
         LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && empty($user['role'])) {
            $user['role'] = 'candidate';
        }
        return $user ?: null;
    }


    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, fullname, email, password, role
         FROM users
         WHERE email = :email
         LIMIT 1"
        );

        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && empty($user['role'])) {
            $user['role'] = 'candidate';
        }
        return $user ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (fullname, email, password, phone_number, role, created_at)
             VALUES (:fullname, :email, :password, :phone, :role, NOW())"
        );
        return $stmt->execute($data);
    }
}
