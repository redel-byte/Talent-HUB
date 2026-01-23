<?php

namespace App\Repository;

use PDO;

class TagRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM tags");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM tags");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tags WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $name): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO tags (name, created_at) VALUES (?, NOW())");
        return $stmt->execute([$name]);
    }

    public function addToJobOffer(int $jobId, int $tagId): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO job_offer_tags (job_offer_id, tag_id) VALUES (?, ?)");
        return $stmt->execute([$jobId, $tagId]);
    }

    public function getByJobOffer(int $jobId): array
    {
        $stmt = $this->pdo->prepare("SELECT t.* FROM tags t JOIN job_offer_tags jot ON t.id = jot.tag_id WHERE jot.job_offer_id = ?");
        $stmt->execute([$jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Tag
{
    public int $id;
    public string $name;
}
