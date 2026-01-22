<?php

namespace App\Repository;

use PDO;

class JobOfferRepository
{
    public function __construct(private PDO $pdo) {}

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
    public function findById(int $jobId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM job_offers WHERE id = ? AND archived_at IS NULL");
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function softDelete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE job_offers SET archived_at = NOW() WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}


// namespace App\Repository;
// use PDO;
// class JobOfferRepository
// {
//     public function __construct(private PDO $pdo) {}

//     public function create(array $data): bool
//     {
//         $stmt = $this->pdo->prepare(
//             "INSERT INTO job_offers (title, description, salary, company_id, category_id, created_at)
//              VALUES (:title, :description, :salary, :company, :category, NOW())"
//         );
//         return $stmt->execute($data);
//     }

//     public function findByCompany(int $companyId): array
//     {
//         $stmt = $this->pdo->prepare("SELECT * FROM job_offers WHERE company_id = ? AND archived_at IS NULL");
//         $stmt->execute([$companyId]);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function softDelete(int $id): bool
//     {
//         $stmt = $this->pdo->prepare(
//             "UPDATE job_offers SET archived_at = NOW() WHERE id = :id"
//         );
//         return $stmt->execute(['id' => $id]);
//     }
// }
