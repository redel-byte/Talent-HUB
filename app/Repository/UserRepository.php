<?php


namespace App\repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo) {}
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, fullname, email, phone_number as phone, role, created_at
         FROM users
         WHERE id = :id
         LIMIT 1"
        );

        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && empty($user['role'])) {
            $user['role'] = 'candidate';
        }
        return $user ?: null;
    }


    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, fullname, email, password, role
         FROM users
         WHERE email = :email
         LIMIT 1"
        );

        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && empty($user['role'])) {
            $user['role'] = 'candidate';
        }
        return $user ?: null;
    }

    public function findByRole(string $role): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, fullname, email, phone_number as phone, created_at
             FROM users
             WHERE role = :role
             ORDER BY created_at DESC"
        );

        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $values = [':id' => $id];

        $allowedFields = ['fullname', 'phone_number'];
        
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $values[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
