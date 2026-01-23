<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

echo "Checking auto-increment settings:\n";

// Check roles table
$stmt = $pdo->query('SHOW COLUMNS FROM roles WHERE Field = "id"');
$role_id = $stmt->fetch();
echo "Roles ID: {$role_id['Extra']}\n";

// Check users table
$stmt = $pdo->query('SHOW COLUMNS FROM users WHERE Field = "id"');
$user_id = $stmt->fetch();
echo "Users ID: {$user_id['Extra']}\n";

// Check company table
$stmt = $pdo->query('SHOW COLUMNS FROM company WHERE Field = "id"');
$company_id = $stmt->fetch();
echo "Company ID: {$company_id['Extra']}\n";

// Check job_offers table
$stmt = $pdo->query('SHOW COLUMNS FROM job_offers WHERE Field = "id"');
$job_id = $stmt->fetch();
echo "Job Offers ID: {$job_id['Extra']}\n";

// Check applications table
$stmt = $pdo->query('SHOW COLUMNS FROM applications WHERE Field = "id"');
$app_id = $stmt->fetch();
echo "Applications ID: {$app_id['Extra']}\n";

// Check tags table
$stmt = $pdo->query('SHOW COLUMNS FROM tags WHERE Field = "id"');
$tag_id = $stmt->fetch();
echo "Tags ID: {$tag_id['Extra']}\n";
?>
