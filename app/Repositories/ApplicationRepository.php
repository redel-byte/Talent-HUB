<?php
namespace App\Repositories;
use PDO;

class ApplicationRepository extends BaseRepository
{
    protected string $table = 'applications';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function apply(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO applications (candidate_id, job_offer_id, cv_upload, created_at)
             VALUES (:candidate, :offer, :cv, NOW())"
        );
        return $stmt->execute($data);
    }

    public function findByJobOffer(int $jobId): array
    {
        $stmt = $this->pdo->prepare("SELECT a.*, u.fullname, u.email FROM applications a JOIN users u ON a.candidate_id = u.id WHERE a.job_offer_id = ?");
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
