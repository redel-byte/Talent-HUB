<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Tag;
use PDO;

class TagRepository
{
    private PDO $db;
    private string $table = 'tags';

    public function __construct()
    {
        $this->db = Database::connection();
    }

    /**
     * @return Tag[]
     */
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tag = new Tag(
                (int) $row['id'],
                $row['name']
            );
            $tags[] = $tag;
        }

        return $tags;
    }

    public function find(int $id): ?Tag
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Tag(
            (int) $row['id'],
            $row['name']
        );
    }

public function create(Tag $tag): bool
{
    $stmt = $this->db->prepare(
        "INSERT INTO {$this->table} (name) VALUES (:name)"
    );

    return $stmt->execute([
        'name' => $tag->getName(),
    ]);
}



public function update(Tag $tag): bool
{
    if ($tag->getId() === null) {
        throw new \InvalidArgumentException('Tag id is required for update');
    }

    $stmt = $this->db->prepare(
        "UPDATE {$this->table} SET name = :name WHERE id = :id"
    );

    return $stmt->execute([
        'id'   => $tag->getId(),
        'name' => $tag->getName(),
    ]);
}



    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
