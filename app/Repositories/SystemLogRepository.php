<?php

namespace App\Repositories;

use PDO;

class SystemLogRepository extends BaseRepository
{
    protected string $table = 'system_logs';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function log(?int $userId = null, string $action, ?string $tableName = null, ?int $recordId = null, ?array $oldValues = null, ?array $newValues = null, ?string $ipAddress = null, ?string $userAgent = null): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} (user_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent)
             VALUES (:user_id, :action, :table_name, :record_id, :old_values, :new_values, :ip_address, :user_agent)"
        );
        
        return $stmt->execute([
            'user_id' => $userId,
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent
        ]);
    }

    public function logCreate(int $userId, string $tableName, int $recordId, array $newValues, ?string $ipAddress = null, ?string $userAgent = null): bool
    {
        return $this->log($userId, 'create', $tableName, $recordId, null, $newValues, $ipAddress, $userAgent);
    }

    public function logUpdate(int $userId, string $tableName, int $recordId, array $oldValues, array $newValues, ?string $ipAddress = null, ?string $userAgent = null): bool
    {
        return $this->log($userId, 'update', $tableName, $recordId, $oldValues, $newValues, $ipAddress, $userAgent);
    }

    public function logDelete(int $userId, string $tableName, int $recordId, array $oldValues, ?string $ipAddress = null, ?string $userAgent = null): bool
    {
        return $this->log($userId, 'delete', $tableName, $recordId, $oldValues, null, $ipAddress, $userAgent);
    }

    public function findByUser(int $userId, int $limit = 50): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table} 
             WHERE user_id = :user_id 
             ORDER BY created_at DESC 
             LIMIT :limit"
        );
        $stmt->execute(['user_id' => $userId, 'limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByAction(string $action, int $limit = 50): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table} 
             WHERE action = :action 
             ORDER BY created_at DESC 
             LIMIT :limit"
        );
        $stmt->execute(['action' => $action, 'limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByTable(string $tableName, int $limit = 50): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table} 
             WHERE table_name = :table_name 
             ORDER BY created_at DESC 
             LIMIT :limit"
        );
        $stmt->execute(['table_name' => $tableName, 'limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByRecord(string $tableName, int $recordId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table} 
             WHERE table_name = :table_name AND record_id = :record_id 
             ORDER BY created_at DESC"
        );
        $stmt->execute(['table_name' => $tableName, 'record_id' => $recordId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentLogs(int $limit = 100, int $offset = 0): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT sl.*, u.fullname, u.email 
             FROM {$this->table} sl
             LEFT JOIN users u ON sl.user_id = u.id
             ORDER BY sl.created_at DESC 
             LIMIT :limit OFFSET :offset"
        );
        $stmt->execute(['limit' => $limit, 'offset' => $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLogsByDateRange(string $startDate, string $endDate, int $limit = 100): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT sl.*, u.fullname, u.email 
             FROM {$this->table} sl
             LEFT JOIN users u ON sl.user_id = u.id
             WHERE sl.created_at BETWEEN :start_date AND :end_date
             ORDER BY sl.created_at DESC 
             LIMIT :limit"
        );
        $stmt->execute([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'limit' => $limit
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActionStatistics(?string $startDate = null, ?string $endDate = null): array
    {
        $sql = "SELECT action, COUNT(*) as count 
                FROM {$this->table}";
        $params = [];
        
        if ($startDate && $endDate) {
            $sql .= " WHERE created_at BETWEEN :start_date AND :end_date";
            $params['start_date'] = $startDate;
            $params['end_date'] = $endDate;
        }
        
        $sql .= " GROUP BY action ORDER BY count DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTableStatistics(?string $startDate = null, ?string $endDate = null): array
    {
        $sql = "SELECT table_name, COUNT(*) as count 
                FROM {$this->table}";
        $params = [];
        
        if ($startDate && $endDate) {
            $sql .= " WHERE created_at BETWEEN :start_date AND :end_date";
            $params['start_date'] = $startDate;
            $params['end_date'] = $endDate;
        }
        
        $sql .= " GROUP BY table_name ORDER BY count DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cleanupOldLogs(int $daysToKeep = 90): int
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM {$this->table} WHERE created_at < DATE_SUB(NOW(), INTERVAL :days_to_keep DAY)"
        );
        $stmt->execute(['days_to_keep' => $daysToKeep]);
        return $stmt->rowCount();
    }
}
