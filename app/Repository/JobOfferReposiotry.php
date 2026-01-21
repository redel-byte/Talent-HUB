<?php
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

    public function softDelete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE job_offers SET archived_at = NOW() WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
