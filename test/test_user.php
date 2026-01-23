<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Middleware/database.php';
require_once __DIR__ . '/../app/Repositories/UserRepository.php';

use App\Middleware\Database;
use App\Repositories\UserRepository;

$pdo = Database::connection();
$repo = new UserRepository($pdo);
$user = $repo->findById(1);
if ($user) {
    echo "User fetched:\n";
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {
    echo "No user found\n";
}
