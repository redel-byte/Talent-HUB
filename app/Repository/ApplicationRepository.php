<?php
namespace App\Repository;
use PDO;
class ApplicationRepository
{
    public function __construct(private PDO $pdo) {}

    public function create(array $data): int|false
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO applications (candidate_id, job_offer_id, cover_letter, status, created_at)
             VALUES (:candidate_id, :job_offer_id, :cover_letter, :status, NOW())"
        );
        $stmt->execute([
            ':candidate_id' => $data['candidate_id'],
            ':job_offer_id' => $data['job_offer_id'],
            ':cover_letter' => $data['cover_letter'] ?? '',
            ':status' => $data['status'] ?? 'pending'
        ]);
        return $this->pdo->lastInsertId() ? (int)$this->pdo->lastInsertId() : false;
    }

    public function findByCandidate(int $candidateId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT a.*, j.title as job_title, c.name as company_name
             FROM applications a
             JOIN job_offers j ON a.job_offer_id = j.id
             JOIN company c ON j.company_id = c.id
             WHERE a.candidate_id = ?
             ORDER BY a.created_at DESC"
        );
        $stmt->execute([$candidateId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByJobOffer(int $jobId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT a.*, u.fullname, u.email
             FROM applications a
             JOIN users u ON a.candidate_id = u.id
             WHERE a.job_offer_id = ?
             ORDER BY a.created_at DESC"
        );
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCandidateAndJob(int $candidateId, int $jobId): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM applications WHERE candidate_id = ? AND job_offer_id = ? LIMIT 1"
        );
        $stmt->execute([$candidateId, $jobId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT a.*, u.fullname, u.email, j.title as job_title
             FROM applications a
             JOIN users u ON a.candidate_id = u.id
             JOIN job_offers j ON a.job_offer_id = j.id
             WHERE a.id = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE applications SET status = ? WHERE id = ?"
        );
        return $stmt->execute([$status, $id]);
    }

    public function apply(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO applications (candidate_id, job_offer_id, cv_path, created_at)
             VALUES (:candidate, :offer, :cv, NOW())"
        );
        return $stmt->execute($data);
    }
}
