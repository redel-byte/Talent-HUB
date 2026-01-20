<?php

require_once "../vendor/autoload.php";

use Youcode\WorkshopMvc\Core\Router;
use Youcode\WorkshopMvc\Core\AuthMiddleware;
use Youcode\WorkshopMvc\Controllers\AuthController;
use Youcode\WorkshopMvc\Controllers\HomeController;
use Youcode\WorkshopMvc\Controllers\CandidateController;
use Youcode\WorkshopMvc\Controllers\RecruiterController;
use Youcode\WorkshopMvc\Controllers\AdminController;

// Initialize middleware
$authMiddleware = new AuthMiddleware();

// Get current request info
$uri = str_replace("/Talent-HUB", "", rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"));
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($uri === "") $uri = "/";

// Apply middleware protection
if (!$authMiddleware->handle($uri, $method)) {
    exit(); // Middleware handled redirect
}

$router = new Router();

// Public Routes - Main Home Page
$router->addRouter('GET', '/', [HomeController::class, 'index']);
$router->addRouter('GET', '/home', [HomeController::class, 'index']);
$router->addRouter('GET', '/find-talent', [HomeController::class, 'findTalent']);
$router->addRouter('GET', '/find-jobs', [HomeController::class, 'findJobs']);

// Authentication Routes
$router->addRouter('GET', '/login', [AuthController::class, 'loginForm']);
$router->addRouter('POST', '/login', [AuthController::class, 'login']);
$router->addRouter('GET', '/register', [AuthController::class, 'registerForm']);
$router->addRouter('POST', '/register', [AuthController::class, 'register']);
$router->addRouter('GET', '/logout', [AuthController::class, 'logout']);

// Candidate Routes
$router->addRouter('GET', '/candidate', [CandidateController::class, 'dashboard']);
$router->addRouter('GET', '/candidate/dashboard', [CandidateController::class, 'dashboard']);
$router->addRouter('GET', '/candidate/profile', [CandidateController::class, 'profile']);
$router->addRouter('GET', '/candidate/applications', [CandidateController::class, 'applications']);
$router->addRouter('GET', '/candidate/settings', [CandidateController::class, 'settings']);

// Recruiter Routes
$router->addRouter('GET', '/recruiter', [RecruiterController::class, 'dashboard']);
$router->addRouter('GET', '/recruiter/dashboard', [RecruiterController::class, 'dashboard']);
$router->addRouter('GET', '/recruiter/jobs', [RecruiterController::class, 'jobs']);
$router->addRouter('GET', '/recruiter/candidates', [RecruiterController::class, 'candidates']);
$router->addRouter('GET', '/recruiter/company', [RecruiterController::class, 'company']);
$router->addRouter('GET', '/recruiter/settings', [RecruiterController::class, 'settings']);

// Admin Routes
$router->addRouter('GET', '/admin', [AdminController::class, 'dashboard']);
$router->addRouter('GET', '/admin/dashboard', [AdminController::class, 'dashboard']);
$router->addRouter('GET', '/admin/users', [AdminController::class, 'users']);
$router->addRouter('GET', '/admin/roles', [AdminController::class, 'roles']);
$router->addRouter('GET', '/admin/system', [AdminController::class, 'system']);
$router->addRouter('GET', '/admin/logs', [AdminController::class, 'logs']);

// Error Routes
$router->addRouter('GET', '/403', function() {
    http_response_code(403);
    require_once __DIR__ . '/../app/views/errors/403.php';
});

$router->addRouter('GET', '/404', function() {
    http_response_code(404);
    require_once __DIR__ . '/../app/views/errors/404.php';
});

$router->dispatch();
