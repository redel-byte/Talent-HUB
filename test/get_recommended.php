<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Middleware/database.php';
require_once __DIR__ . '/../app/Repositories/BaseRepository.php';
require_once __DIR__ . '/../app/Repositories/CandidateRepository.php';

use App\Middleware\Database;
use App\Repositories\CandidateRepository;

$pdo = Database::connection();
$repo = new CandidateRepository($pdo);

try {
    $jobs = $repo->getRecommendedJobs(1, 3);
    echo "Found " . count($jobs) . " recommended jobs:\n";
    echo json_encode($jobs, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
