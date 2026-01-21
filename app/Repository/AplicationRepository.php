<?php

class ApplicationRepository
{
    public function __construct(private PDO $pdo) {}

    public function apply(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO applications (candidate_id, job_offer_id, cv_upload, created_at)
             VALUES (:candidate, :offer, :cv, NOW())"
        );
        return $stmt->execute($data);
    }
}
