<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=talent_hub;charset=utf8mb4', 'root', '');

echo "Debugging roles table...\n";

// Check if roles table is empty
$stmt = $pdo->query('SELECT COUNT(*) as count FROM roles');
$count = $stmt->fetch();
echo "Roles count: {$count['count']}\n";

// Try to insert one role manually
try {
    $pdo->exec("INSERT INTO roles (name) VALUES ('admin')");
    echo "Admin role inserted\n";
} catch (PDOException $e) {
    echo "Error inserting admin role: " . $e->getMessage() . "\n";
}

// Check what's in roles now
$stmt = $pdo->query('SELECT * FROM roles');
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Current roles:\n";
foreach ($roles as $role) {
    echo "- ID: {$role['id']}, Name: {$role['name']}\n";
}

// Try to insert a user with the existing role
if (!empty($roles)) {
    try {
        $pdo->exec("INSERT INTO users (fullname, email, password, phone_number, role_id, created_at) VALUES 
            ('Test User', 'test@example.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234567890', {$roles[0]['id']}, NOW())");
        echo "Test user inserted with role ID {$roles[0]['id']}\n";
    } catch (PDOException $e) {
        echo "Error inserting test user: " . $e->getMessage() . "\n";
    }
}
?>
