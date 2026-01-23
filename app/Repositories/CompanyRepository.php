<?php

namespace App\Repositories;
use PDO;

class CompanyRepository extends BaseRepository
{
    protected string $table = 'company';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function createForUser(int $userId, array $data): bool{
        $stmt = $this->pdo->prepare(
            "INSERT INTO company (user_id, name, address, email, created_at)
             VALUES (:user_id, :name, :address, :email, NOW())"
        );
        $data['user_id'] = $userId;
        return $stmt->execute($data);
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
