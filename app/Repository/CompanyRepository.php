<?php

class CompanyRepository
{
    public function __construct(private PDO $pdo) {}

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO company (name, address, email, created_at)
             VALUES (:name, :address, :email, NOW())"
        );
         $stmt->execute($data);
        return (int) $this->pdo->lastInsertId();
    }

    public function findByUser(int $userId): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM company WHERE user_id = :user_id"
        );
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
