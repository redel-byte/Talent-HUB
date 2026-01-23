<?php

namespace App\Repositories;

use PDO;

class JobOfferTagRepository extends BaseRepository
{
    protected string $table = 'job_offer_tags';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function attachTag(int $jobOfferId, int $tagId): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} (job_offer_id, tag_id) VALUES (:job_offer_id, :tag_id)
             ON DUPLICATE KEY UPDATE job_offer_id = VALUES(job_offer_id)"
        );
        return $stmt->execute([
            'job_offer_id' => $jobOfferId,
            'tag_id' => $tagId
        ]);
    }

    public function detachTag(int $jobOfferId, int $tagId): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM {$this->table} WHERE job_offer_id = :job_offer_id AND tag_id = :tag_id"
        );
        return $stmt->execute([
            'job_offer_id' => $jobOfferId,
            'tag_id' => $tagId
        ]);
    }

    public function getJobOfferTags(int $jobOfferId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT t.* FROM tags t
             INNER JOIN {$this->table} jot ON t.id = jot.tag_id
             WHERE jot.job_offer_id = :job_offer_id
             ORDER BY t.name"
        );
        $stmt->execute(['job_offer_id' => $jobOfferId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaggedJobOffers(int $tagId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT jo.* FROM job_offers jo
             INNER JOIN {$this->table} jot ON jo.id = jot.job_offer_id
             WHERE jot.tag_id = :tag_id AND jo.archived_at IS NULL
             ORDER BY jo.created_at DESC"
        );
        $stmt->execute(['tag_id' => $tagId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function syncJobOfferTags(int $jobOfferId, array $tagIds): bool
    {
        $this->pdo->beginTransaction();
        
        try {
            // Remove all existing tags
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE job_offer_id = :job_offer_id");
            $stmt->execute(['job_offer_id' => $jobOfferId]);
            
            // Attach new tags
            if (!empty($tagIds)) {
                $placeholders = str_repeat('(?,?),', count($tagIds) - 1) . '(?,?)';
                $values = [];
                foreach ($tagIds as $tagId) {
                    $values[] = $jobOfferId;
                    $values[] = $tagId;
                }
                
                $stmt = $this->pdo->prepare(
                    "INSERT INTO {$this->table} (job_offer_id, tag_id) VALUES {$placeholders}"
                );
                $stmt->execute($values);
            }
            
            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function getPopularTags(int $limit = 10): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT t.*, COUNT(jot.job_offer_id) as usage_count
             FROM tags t
             INNER JOIN {$this->table} jot ON t.id = jot.tag_id
             INNER JOIN job_offers jo ON jot.job_offer_id = jo.id AND jo.archived_at IS NULL
             GROUP BY t.id, t.name, t.color, t.created_at
             ORDER BY usage_count DESC, t.name ASC
             LIMIT :limit"
        );
        $stmt->execute(['limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
