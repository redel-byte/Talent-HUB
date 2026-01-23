<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

echo "Checking categories table...\n";

// Check categories table structure
$stmt = $pdo->query('DESCRIBE categories');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Categories table structure:\n";
foreach ($columns as $column) {
    echo "- {$column['Field']} ({$column['Type']}) {$column['Key']} {$column['Null']} {$column['Default']}\n";
}

// Check if categories exist
$stmt = $pdo->query('SELECT COUNT(*) as count FROM categories');
$count = $stmt->fetch();
echo "\nCategories count: {$count['count']}\n";

// Create sample categories if none exist
if ($count['count'] == 0) {
    $pdo->exec("INSERT INTO categories (name) VALUES 
        ('Technology'),
        ('Marketing'),
        ('Sales'),
        ('Finance'),
        ('HR')");
    echo "Created sample categories\n";
}

// Show categories
$stmt = $pdo->query('SELECT * FROM categories');
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "\nAvailable categories:\n";
foreach ($categories as $category) {
    echo "- ID: {$category['id']}, Name: {$category['name']}\n";
}
?>
