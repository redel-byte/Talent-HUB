<?php
session_start();
require_once 'vendor/autoload.php';

use App\Middleware\AuthMiddleware;

// Test the middleware directly
$middleware = new AuthMiddleware();
$uri = '/recruiter/company/create';
$method = 'GET';

echo "<h2>Testing AuthMiddleware</h2>";
echo "<p>URI: $uri</p>";
echo "<p>Method: $method</p>";
echo "<p>Session role: " . ($_SESSION['role'] ?? 'NOT SET') . "</p>";
echo "<p>Session user_id: " . ($_SESSION['user_id'] ?? 'NOT SET') . "</p>";

$result = $middleware->handle($uri, $method);
echo "<p>Middleware result: " . ($result ? 'ALLOWED' : 'DENIED') . "</p>";

if (isset($_SESSION['error'])) {
    echo "<p>Error: " . $_SESSION['error'] . "</p>";
}
?>
