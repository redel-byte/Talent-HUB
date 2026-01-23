<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

echo "Checking company table constraints...\n";

// Check company table structure
$stmt = $pdo->query('DESCRIBE company');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Company table structure:\n";
foreach ($columns as $column) {
    echo "- {$column['Field']} ({$column['Type']}) {$column['Key']} {$column['Null']} {$column['Default']}\n";
}

// Check foreign key constraints
$stmt = $pdo->query('SHOW CREATE TABLE company');
$createTable = $stmt->fetch(PDO::FETCH_ASSOC);
echo "\nCompany table creation SQL:\n";
echo $createTable['Create Table'] . "\n";

// Check which users are recruiters
$stmt = $pdo->query('SELECT u.id, u.fullname, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name = "recruiter"');
$recruiters = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "\nRecruiter users:\n";
foreach ($recruiters as $recruiter) {
    echo "- ID: {$recruiter['id']}, Name: {$recruiter['fullname']}\n";
}
?>
