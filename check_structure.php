<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

// Check roles table structure
echo "Roles table structure:\n";
$stmt = $pdo->query('DESCRIBE roles');
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($roles as $column) {
    echo "- {$column['Field']} ({$column['Type']})\n";
}

echo "\nUsers table structure:\n";
$stmt = $pdo->query('DESCRIBE users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $column) {
    echo "- {$column['Field']} ({$column['Type']})\n";
}

echo "\nCompany table structure:\n";
$stmt = $pdo->query('DESCRIBE company');
$company = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($company as $column) {
    echo "- {$column['Field']} ({$column['Type']})\n";
}

echo "\nJob offers table structure:\n";
$stmt = $pdo->query('DESCRIBE job_offers');
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($jobs as $column) {
    echo "- {$column['Field']} ({$column['Type']})\n";
}

echo "\nApplications table structure:\n";
$stmt = $pdo->query('DESCRIBE applications');
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($applications as $column) {
    echo "- {$column['Field']} ({$column['Type']})\n";
}
?>
