<?php

namespace App\Repositories;

use PDO;

class RoleRepository extends BaseRepository
{
    protected string $table = 'roles';

    public function findByName(string $name)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE name = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getRoleWithUsers(int $roleId)
    {
        $stmt = $this->pdo->prepare("
            SELECT r.*, COUNT(u.id) as user_count
            FROM roles r
            LEFT JOIN users u ON r.id = u.role_id AND u.archived_at IS NULL
            WHERE r.id = :role_id
            GROUP BY r.id
        ");
        $stmt->execute(['role_id' => $roleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getAllWithUserCount()
    {
        $stmt = $this->pdo->prepare("
            SELECT r.*, COUNT(u.id) as user_count
            FROM roles r
            LEFT JOIN users u ON r.id = u.role_id AND u.archived_at IS NULL
            GROUP BY r.id
            ORDER BY r.name
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createIfNotExists(string $roleName)
    {
        $existing = $this->findByName($roleName);
        if ($existing) {
            return $existing['id'];
        }

        $this->create(['name' => $roleName]);
        return $this->pdo->lastInsertId();
    }
}
