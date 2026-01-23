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

    public function getAllActiveJobs(): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT jo.*, c.name as company_name, c.email as company_email, cat.name as category_name
             FROM job_offers jo
             LEFT JOIN company c ON jo.company_id = c.id
             LEFT JOIN categories cat ON jo.category_id = cat.id
             WHERE jo.archived_at IS NULL
             ORDER BY jo.created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchJobs(array $filters = []): array
    {
        $sql = "SELECT jo.*, c.name as company_name, c.email as company_email, cat.name as category_name
                FROM job_offers jo
                LEFT JOIN company c ON jo.company_id = c.id
                LEFT JOIN categories cat ON jo.category_id = cat.id
                WHERE jo.archived_at IS NULL";
        
        $params = [];
        $conditions = [];
        
        if (!empty($filters['search'])) {
            $conditions[] = "(jo.title LIKE ? OR jo.description LIKE ?)";
            $searchParam = '%' . $filters['search'] . '%';
            $params[] = $searchParam;
            $params[] = $searchParam;
        }
        
        if (!empty($filters['category']) && $filters['category'] !== '') {
            $conditions[] = "cat.name = ?";
            $params[] = $filters['category'];
        }
        
        if (!empty($filters['min_salary']) && is_numeric($filters['min_salary'])) {
            $conditions[] = "jo.salary >= ?";
            $params[] = (float)$filters['min_salary'];
        }
        
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
        
        $sql .= " ORDER BY jo.created_at DESC";
        
        // Debug logging
        error_log("SQL: " . $sql);
        error_log("Params: " . json_encode($params));
        error_log("Filters received: " . json_encode($filters));
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
