<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/core/database.php';

use App\Core\Database;

try {
    $pdo = Database::connection();
    $stmt = $pdo->query('DESCRIBE users');
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Users table columns:\n";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }

    // Test the query
    echo "\nTesting the query:\n";
    $stmt = $pdo->prepare("SELECT id, fullname, email, role FROM users WHERE id = ? LIMIT 1");
    $stmt->execute([1]); // Assuming id 1 exists
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "Query successful: " . json_encode($user) . "\n";
    } else {
        echo "No user with id 1, or query failed.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}