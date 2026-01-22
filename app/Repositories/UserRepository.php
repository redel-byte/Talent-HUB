<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function findAllWithRole(): array
    {
        $sql = "
            SELECT 
                u.id,
                u.fullname,
                u.email,
                u.phone_number,
                u.created_at,
                u.archived_at,
                r.name AS role
            FROM users u
            JOIN roles r ON u.role_id = r.id
            ORDER BY u.created_at DESC
        ";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM users");
        return (int) $stmt->fetchColumn();
    }

    public function countByRole(): array
    {
        $sql = "
            SELECT r.name AS role, COUNT(u.id) AS total
            FROM users u
            JOIN roles r ON u.role_id = r.id
            GROUP BY r.name
        ";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $result[$row['role']] = (int) $row['total'];
        }

        return $result;
    }
}
