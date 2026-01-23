<?php
session_start();
echo "<h2>Session Debug</h2>";
echo "<pre>";
echo "Session Data:\n";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Current User Role Check</h2>";
if (isset($_SESSION['user_id'])) {
    require_once 'vendor/autoload.php';
    
    $userModel = new \App\Models\UserModel(\App\Middleware\Database::connection());
    $user = $userModel->findById($_SESSION['user_id']);
    
    echo "<pre>";
    echo "User Data:\n";
    print_r($user);
    echo "</pre>";
    
    echo "<p>Session role: " . ($_SESSION['role'] ?? 'NOT SET') . "</p>";
    echo "<p>Database role: " . ($user['role'] ?? 'NOT FOUND') . "</p>";
} else {
    echo "<p>No user_id in session</p>";
}
?>
