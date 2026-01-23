<?php

namespace App\Repository;

use PDO;

class JobOfferRepository
{
    public function __construct(private PDO $pdo) {}

    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO job_offers (title, description, salary, company_id, category_id, created_at)
             VALUES (:title, :description, :salary, :company, :category, NOW())"
        );
        if ($stmt->execute($data)) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE job_offers SET title = :title, description = :description, salary = :salary, category_id = :category, updated_at = NOW() WHERE id = :id"
        );
        $data['id'] = $id;
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

    public function associateTags(int $jobId, array $tagIds): void
    {
        // First, remove existing associations
        $stmt = $this->pdo->prepare("DELETE FROM job_offer_tags WHERE job_offer_id = ?");
        $stmt->execute([$jobId]);

        // Then add new associations
        if (!empty($tagIds)) {
            $stmt = $this->pdo->prepare("INSERT INTO job_offer_tags (job_offer_id, tag_id) VALUES (?, ?)");
            foreach ($tagIds as $tagId) {
                $stmt->execute([$jobId, $tagId]);
            }
        }
    }

    public function getTags(int $jobId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT t.* FROM tags t
            JOIN job_offer_tags jot ON t.id = jot.tag_id
            WHERE jot.job_offer_id = ?
        ");
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
