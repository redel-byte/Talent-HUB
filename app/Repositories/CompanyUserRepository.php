<?php

namespace App\Repositories;

use PDO;

class CompanyUserRepository extends BaseRepository
{
    protected string $table = 'company_users';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function addUserToCompany(int $companyId, int $userId, string $role = 'recruiter'): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} (company_id, user_id, role) 
             VALUES (:company_id, :user_id, :role)
             ON DUPLICATE KEY UPDATE role = VALUES(role)"
        );
        return $stmt->execute([
            'company_id' => $companyId,
            'user_id' => $userId,
            'role' => $role
        ]);
    }

    public function removeUserFromCompany(int $companyId, int $userId): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM {$this->table} WHERE company_id = :company_id AND user_id = :user_id"
        );
        return $stmt->execute([
            'company_id' => $companyId,
            'user_id' => $userId
        ]);
    }

    public function getCompanyUsers(int $companyId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.*, cu.role, cu.joined_at
             FROM users u
             INNER JOIN {$this->table} cu ON u.id = cu.user_id
             WHERE cu.company_id = :company_id AND u.archived_at IS NULL
             ORDER BY cu.joined_at ASC"
        );
        $stmt->execute(['company_id' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserCompanies(int $userId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT c.*, cu.role, cu.joined_at
             FROM companies c
             INNER JOIN {$this->table} cu ON c.id = cu.company_id
             WHERE cu.user_id = :user_id AND c.archived_at IS NULL
             ORDER BY cu.joined_at DESC"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserRoleInCompany(int $companyId, int $userId): ?string
    {
        $stmt = $this->pdo->prepare(
            "SELECT role FROM {$this->table} 
             WHERE company_id = :company_id AND user_id = :user_id"
        );
        $stmt->execute([
            'company_id' => $companyId,
            'user_id' => $userId
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['role'] : null;
    }

    public function isUserInCompany(int $companyId, int $userId): bool
    {
        return $this->getUserRoleInCompany($companyId, $userId) !== null;
    }

    public function getCompanyOwners(int $companyId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.* FROM users u
             INNER JOIN {$this->table} cu ON u.id = cu.user_id
             WHERE cu.company_id = :company_id AND cu.role = 'owner' AND u.archived_at IS NULL"
        );
        $stmt->execute(['company_id' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserRole(int $companyId, int $userId, string $newRole): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE {$this->table} SET role = :role 
             WHERE company_id = :company_id AND user_id = :user_id"
        );
        return $stmt->execute([
            'company_id' => $companyId,
            'user_id' => $userId,
            'role' => $newRole
        ]);
    }

    public function getCompaniesByUserRole(int $userId, string $role): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT c.*, cu.joined_at
             FROM companies c
             INNER JOIN {$this->table} cu ON c.id = cu.company_id
             WHERE cu.user_id = :user_id AND cu.role = :role AND c.archived_at IS NULL
             ORDER BY cu.joined_at DESC"
        );
        $stmt->execute([
            'user_id' => $userId,
            'role' => $role
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function transferOwnership(int $companyId, int $fromUserId, int $toUserId): bool
    {
        $this->pdo->beginTransaction();
        
        try {
            // Update current owner to admin
            $stmt = $this->pdo->prepare(
                "UPDATE {$this->table} SET role = 'admin' 
                 WHERE company_id = :company_id AND user_id = :from_user_id AND role = 'owner'"
            );
            $stmt->execute([
                'company_id' => $companyId,
                'from_user_id' => $fromUserId
            ]);
            
            // Update new owner
            $stmt = $this->pdo->prepare(
                "UPDATE {$this->table} SET role = 'owner' 
                 WHERE company_id = :company_id AND user_id = :to_user_id"
            );
            $stmt->execute([
                'company_id' => $companyId,
                'to_user_id' => $toUserId
            ]);
            
            $this->pdo->commit();
            return true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
