<?php

namespace App\Repositories;

use PDO;

class JobOfferRepository extends BaseRepository
{
    protected string $table = 'job_offers';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO job_offers (title, description, salary, company_id, category_id, created_at)
             VALUES (:title, :description, :salary, :company, :category, NOW())"
        );
        return $stmt->execute($data);
    }

    public function findByCompany(int $companyId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM job_offers WHERE company_id = ? AND archived_at IS NULL");
        $stmt->execute([$companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById(int $jobId): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM job_offers WHERE id = ? AND archived_at IS NULL");
        $stmt->execute([$jobId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function softDelete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE job_offers SET archived_at = NOW() WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
