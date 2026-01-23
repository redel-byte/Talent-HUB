<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Category;
use PDO;

class CategoryRepository
{
    private PDO $db;
    private string $table = 'categories';

    public function __construct()
    {
        $this->db = Database::connection();
    }

    /**
     * @return Category[]
     */
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = new Category(
                (int) $row['id'],
                $row['name']
            );
        }

        return $categories;
    }

    public function find(int $id): ?Category
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Category(
            (int) $row['id'],
            $row['name']
        );
    }

    public function create(Category $category): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name) VALUES (:name)"
        );

        return $stmt->execute([
            'name' => $category->getName(),
        ]);
    }

    public function update(Category $category): bool
    {
        if ($category->getId() === null) {
            throw new \InvalidArgumentException('Category id is required for update');
        }

        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET name = :name WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $category->getId(),
            'name' => $category->getName(),
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
