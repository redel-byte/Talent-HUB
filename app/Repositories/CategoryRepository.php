<?php

namespace App\Repositories;

use App\Middleware\Database;
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
            $categories[] = new Category($row);
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

        return new Category($row);
    }

    public function createCategory(Category $category): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name) VALUES (:name)"
        );

        return $stmt->execute([
            'name' => $category->getName()
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
        // Check if category is being used by job offers
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM job_offers WHERE category_id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            throw new \Exception("Cannot delete category: it is being used by {$result['count']} job offer(s). Please remove or reassign the job offers first.");
        }
        
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
