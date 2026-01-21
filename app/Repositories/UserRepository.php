<?php

namespace App\Repositories;

use PDO;

class UserRepository extends BaseRepository
{
    protected string $table = 'users';

    public function findByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.name as role 
            FROM users u 
            LEFT JOIN roles r ON u.role_id = r.id 
            WHERE u.email = :email
        ");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByRole(string $roleName)
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.name as role 
            FROM users u 
            LEFT JOIN roles r ON u.role_id = r.id 
            WHERE r.name = :role
        ");
        $stmt->execute(['role' => $roleName]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createWithRole(array $userData, string $roleName)
    {
        // Get role_id from role name
        $roleStmt = $this->pdo->prepare("SELECT id FROM roles WHERE name = :role");
        $roleStmt->execute(['role' => $roleName]);
        $roleData = $roleStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$roleData) {
            return false;
        }
        
        $userData['role_id'] = $roleData['id'];
        unset($userData['role']); // Remove role name if present
        
        return $this->create($userData);
    }

    public function updateProfile(int $id, array $data)
    {
        // Remove sensitive fields that shouldn't be updated directly
        unset($data['password'], $data['role_id'], $data['created_at']);
        
        return $this->update($id, $data);
    }

    public function updatePassword(int $id, string $hashedPassword)
    {
        return $this->update($id, ['password' => $hashedPassword]);
    }

    public function softDelete(int $id)
    {
        return $this->update($id, ['archived_at' => date('Y-m-d H:i:s')]);
    }

    public function restore(int $id)
    {
        return $this->update($id, ['archived_at' => null]);
    }

    public function findActive()
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.name as role 
            FROM users u 
            LEFT JOIN roles r ON u.role_id = r.id 
            WHERE u.archived_at IS NULL
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findArchived()
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.name as role 
            FROM users u 
            LEFT JOIN roles r ON u.role_id = r.id 
            WHERE u.archived_at IS NOT NULL
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search(string $query, int $limit = 10)
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.name as role 
            FROM users u 
            LEFT JOIN roles r ON u.role_id = r.id 
            WHERE (u.fullname LIKE :query OR u.email LIKE :query) 
            AND u.archived_at IS NULL
            LIMIT :limit
        ");
        $stmt->execute([
            'query' => "%{$query}%",
            'limit' => $limit
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
