<?php

namespace App\Models;

use PDO;

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // ======================
    // Auth helpers
    // ======================

    public function findByEmail(string $email): ?array
    {
        $sql = "
            SELECT 
                u.id,
                u.fullname,
                u.email,
                u.password,
                u.phone_number,
                u.role_id,
                r.name AS role,
                u.created_at,
                u.archived_at
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE u.email = :email
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT 
                u.id,
                u.fullname,
                u.email,
                u.phone_number,
                u.role_id,
                r.name AS role,
                u.created_at,
                u.archived_at
            FROM users u
            JOIN roles r ON u.role_id = r.id
            WHERE u.id = :id
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function create(
        string $email,
        string $password,
        string $roleName,
        string $firstName,
        string $lastName
    ): bool {
        // get role_id from roles.name
        $sqlRole = "SELECT id FROM roles WHERE name = :name LIMIT 1";
        $stmtRole = $this->pdo->prepare($sqlRole);
        $stmtRole->execute(['name' => $roleName]);
        $role = $stmtRole->fetch();

        if (!$role) {
            return false;
        }

        $fullname = trim($firstName . ' ' . $lastName);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "
            INSERT INTO users (fullname, email, password, phone_number, role_id)
            VALUES (:fullname, :email, :password, NULL, :role_id)
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'fullname' => $fullname,
            'email'    => $email,
            'password' => $hash,
            'role_id'  => $role['id'],
        ]);
    }
}
