<?php


namespace App\repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo) {}

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM users WHERE email = :email AND archived_at IS NULL"
        );
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (fullname, email, password, phone_number, role_id, created_at)
             VALUES (:fullname, :email, :password, :phone, :role, NOW())"
        );
        return $stmt->execute($data);
    }
}
