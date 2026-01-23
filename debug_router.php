<?php
require_once 'vendor/autoload.php';

use App\Core\Router;

$router = new Router();
echo "<h2>Router Debug</h2>";
echo "<p>Request URI: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>Processed URI: " . $router->getUri() . "</p>";
echo "<p>Method: " . ($_SERVER['REQUEST_METHOD'] ?? 'GET') . "</p>";

// Add some test routes to see what's registered
$router->addRouter('GET', '/recruiter/company/create', ['TestController', 'testMethod']);
$router->addRouter('GET', '/', ['TestController', 'home']);

echo "<h3>Registered Routes:</h3>";
echo "<pre>";
// We can't access private routes, but we can show what we expect
echo "Expected routes:\n";
echo "- GET /recruiter/company/create\n";
echo "- GET /\n";
echo "</pre>";
?>
