<?php

namespace App\Repositories;

use PDO;

class CandidateRepository extends BaseRepository
{
    protected string $table = 'users';
    
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    public function findCandidates(array $filters = [], int $limit = 20, int $offset = 0): array
    {
        $sql = "SELECT u.*, 
                       COUNT(a.id) as application_count,
                       MAX(a.applied_at) as last_application_date
                FROM users u
                LEFT JOIN applications a ON u.id = a.candidate_id
                WHERE u.role_id = (SELECT id FROM roles WHERE name = 'candidate' LIMIT 1)
                  AND u.archived_at IS NULL";
        
        $params = [];
        
        // Add filters
        if (!empty($filters['skills'])) {
            $sql .= " AND EXISTS (
                SELECT 1 FROM applications a2
                INNER JOIN job_offers jo ON a2.job_offer_id = jo.id
                INNER JOIN job_offer_tags jot ON jo.id = jot.job_offer_id
                INNER JOIN tags t ON jot.tag_id = t.id
                WHERE a2.candidate_id = u.id AND t.name IN (:skills)
            )";
            $params['skills'] = $filters['skills'];
        }
        
        if (!empty($filters['location'])) {
            $sql .= " AND (u.phone_number LIKE :location OR u.fullname LIKE :location)";
            $params['location'] = '%' . $filters['location'] . '%';
        }
        
        if (!empty($filters['min_applications'])) {
            $sql .= " AND COUNT(a.id) >= :min_applications";
            $params['min_applications'] = $filters['min_applications'];
        }
        
        $sql .= " GROUP BY u.id
                  ORDER BY u.created_at DESC
                  LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge($params, [
            'limit' => $limit,
            'offset' => $offset
        ]));
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidateProfile(int $candidateId): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.*, r.name as role_name,
                    COUNT(a.id) as total_applications,
                    COUNT(CASE WHEN a.status = 'accepted' THEN 1 END) as accepted_applications,
                    COUNT(CASE WHEN a.status = 'pending' THEN 1 END) as pending_applications,
                    MAX(a.applied_at) as last_application_date
             FROM users u
             LEFT JOIN roles r ON u.role_id = r.id
             LEFT JOIN applications a ON u.id = a.candidate_id
             WHERE u.id = :candidate_id AND u.archived_at IS NULL
             GROUP BY u.id, r.name"
        );
        $stmt->execute(['candidate_id' => $candidateId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function getCandidateApplications(int $candidateId, ?array $status = null): array
    {
        $sql = "SELECT a.*, jo.title, jo.salary, jo.salary_min, jo.salary_max,
                       c.name as company_name
                FROM applications a
                INNER JOIN job_offers jo ON a.job_offer_id = jo.id
                LEFT JOIN company c ON jo.company_id = c.id
                WHERE a.candidate_id = :candidate_id";
        
        $params = ['candidate_id' => $candidateId];
        
        if ($status && !empty($status)) {
            $placeholders = [];
            foreach ($status as $i => $value) {
                $placeholder = ':status_' . $i;
                $placeholders[] = $placeholder;
                $params[$placeholder] = $value;
            }
            $sql .= " AND a.status IN (" . implode(',', $placeholders) . ")";
        }
        
        $sql .= " ORDER BY a.id DESC"; // Using id as fallback since applied_at doesn't exist
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidateSkills(int $candidateId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT DISTINCT t.*, COUNT(jot.job_offer_id) as skill_frequency
             FROM tags t
             INNER JOIN job_offer_tags jot ON t.id = jot.tag_id
             INNER JOIN job_offers jo ON jot.job_offer_id = jo.id
             INNER JOIN applications a ON jo.id = a.job_offer_id
             WHERE a.candidate_id = :candidate_id
             GROUP BY t.id, t.name, t.color, t.created_at
             ORDER BY skill_frequency DESC, t.name ASC"
        );
        $stmt->execute(['candidate_id' => $candidateId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidateStats(int $candidateId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                COUNT(a.id) as total_applications,
                COUNT(CASE WHEN a.status = 'accepted' THEN 1 END) as accepted_count,
                COUNT(CASE WHEN a.status = 'rejected' THEN 1 END) as rejected_count,
                COUNT(CASE WHEN a.status = 'pending' THEN 1 END) as pending_count,
                COUNT(CASE WHEN a.status = 'reviewed' THEN 1 END) as reviewed_count,
                AVG(COALESCE(jo.salary_min, jo.salary)) as avg_min_salary,
                AVG(COALESCE(jo.salary_max, jo.salary)) as avg_max_salary
             FROM applications a
             INNER JOIN job_offers jo ON a.job_offer_id = jo.id
             WHERE a.candidate_id = :candidate_id"
        );
        $stmt->execute(['candidate_id' => $candidateId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        
        // Add default values for missing date fields
        $result['last_application_date'] = null;
        $result['first_application_date'] = null;
        
        return $result;
    }

    public function searchCandidates(string $query, int $limit = 20): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.*, r.name as role_name,
                    COUNT(a.id) as application_count
             FROM users u
             LEFT JOIN roles r ON u.role_id = r.id
             LEFT JOIN applications a ON u.id = a.candidate_id
             WHERE u.role_id = (SELECT id FROM roles WHERE name = 'candidate' LIMIT 1)
               AND u.archived_at IS NULL
               AND (u.fullname LIKE :query OR u.email LIKE :query OR u.phone_number LIKE :query)
             GROUP BY u.id, r.name
             ORDER BY u.fullname ASC
             LIMIT :limit"
        );
        $stmt->execute([
            'query' => '%' . $query . '%',
            'limit' => $limit
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveCandidates(int $days = 30, int $limit = 20): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.*, COUNT(a.id) as recent_applications
             FROM users u
             INNER JOIN applications a ON u.id = a.candidate_id
             WHERE u.role_id = (SELECT id FROM roles WHERE name = 'candidate' LIMIT 1)
               AND u.archived_at IS NULL
               AND a.applied_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
             GROUP BY u.id
             HAVING recent_applications > 0
             ORDER BY recent_applications DESC, u.fullname ASC
             LIMIT :limit"
        );
        $stmt->execute(['days' => $days, 'limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCandidatesBySkill(string $skillName, int $limit = 20): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT DISTINCT u.*, COUNT(a.id) as application_count
             FROM users u
             INNER JOIN applications a ON u.id = a.candidate_id
             INNER JOIN job_offers jo ON a.job_offer_id = jo.id
             INNER JOIN job_offer_tags jot ON jo.id = jot.job_offer_id
             INNER JOIN tags t ON jot.tag_id = t.id
             WHERE u.role_id = (SELECT id FROM roles WHERE name = 'candidate' LIMIT 1)
               AND u.archived_at IS NULL
               AND t.name = :skill_name
             GROUP BY u.id
             ORDER BY application_count DESC, u.fullname ASC
             LIMIT :limit"
        );
        $stmt->execute(['skill_name' => $skillName, 'limit' => $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
